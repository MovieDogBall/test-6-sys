<?php

namespace Elevator;

/**
 * Class Elevator
 * @package Elevator
 */
class Elevator implements IObservable
{

    const DIRECTION_UP = 'up';
    const DIRECTION_DOWN = 'down';

    public $floors = [];
    public $direction = '';
    public $currentFloor = 1;
    /** @var IObserver */
    private $objObserver;

    /**
     * @param $door
     * @return string
     *
     * Move Elevator
     *
     */
    public function moveElevator($door)
    {

        if ($door === false) {
            while (!empty($this->floors)) {
                if ($this->direction == Elevator::DIRECTION_UP) {
                    sort($this->floors);
                    $this->moveToDefinedDirection();

                    if (!empty($this->floors)) {
                        $this->setDirection(Elevator::DIRECTION_DOWN);
                    }
                }

                if ($this->direction == Elevator::DIRECTION_DOWN) {
                    rsort($this->floors);
                    $this->moveToDefinedDirection();

                    if (!empty($this->floors)) {
                        $this->setDirection(Elevator::DIRECTION_UP);
                    }
                }
            }
            $this->fireEvent("Elevator stopped at last floor in queue");
        } else {
            $this->fireEvent("Waiting  for closing door");
        }
    }

    /**
     * Stop Elevator
     */
    private function stopElevator()
    {
        $this->fireEvent("stayOn");
        $this->openDoor();
    }

    /**
     * Move Elevator to next Floor
     *
     */
    private function moveToNextFloor()
    {
        if ($this->direction == Elevator::DIRECTION_UP) {
            $this->currentFloor++;
        }
        if ($this->direction == Elevator::DIRECTION_DOWN) {
            --$this->currentFloor;
        }
        $this->fireEvent("movedTo");
    }

    /**
     * @param $requestFloor
     * @param $queue
     * @return array
     */
    public function addToQueue($requestFloor, $queue)
    {
        if (!in_array($requestFloor, $queue)) {
            array_push($queue, $requestFloor);
        }

        return $queue;
    }

    private function moveToDefinedDirection()
    {
        foreach ($this->floors as $key => $floor) {
            if ($floor > $this->currentFloor && $this->direction == Elevator::DIRECTION_UP) {
                $this->run($floor, $key);
            } elseif ($floor < $this->currentFloor && $this->direction == Elevator::DIRECTION_DOWN) {
                $this->run($floor, $key);
            } elseif ($floor == $this->currentFloor) {
                $this->run($floor, $key);
            }
        }
    }


    /**
     * @return array
     */
    public function getFloors()
    {
        return $this->floors;
    }

    /**
     * @param array $floors
     */
    public function setFloors($floors)
    {
        $this->floors = $floors;
    }

    /**
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param string $direction
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;
    }

    /**
     * @return int
     */
    public function getCurrentFloor()
    {
        return $this->currentFloor;
    }

    /**
     * @param int $currentFloor
     */
    public function setCurrentFloor($currentFloor)
    {
        $this->currentFloor = $currentFloor;
    }

    /**
     * @param $floor
     * @param $key
     */
    private function run($floor, $key)
    {
        while ($this->currentFloor != $floor) {
            $this->moveToNextFloor();
        }

        $this->stopElevator();
        unset($this->floors[$key]);
        $this->closeDoor();
    }

    /**
     * @return bool
     */
    public function openDoor()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function closeDoor()
    {
        return false;
    }

    /**
     * @param IObserver $objObserver
     * @return void
     */
    public function addObserver(IObserver $objObserver)
    {
        $this->objObserver = $objObserver;
    }

    /**
     * @param $strEventType
     */
    public function fireEvent($strEventType)
    {
        $this->objObserver->notify($this, $strEventType);
    }
}
