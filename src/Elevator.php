<?php

namespace Elevator;

require_once "Building.php";

use Building\Building;

interface ElevatorFunc
{
    public function moveElevator();
}

/**
 * Class Elevator
 * @package Elevator
 */
class Elevator extends Building
{

    public $queue;

    /**
     * @param $currentFloor
     * @param $floors
     * @param $door
     * @param $direction
     * @return string
     *
     * Move Elevator
     *
     */
    public function moveElevator($currentFloor, $floors, $door, $direction)
    {
        if ($door === false) {
            if ($direction == "up") {
                sort($floors); // Why did you do this sorting?
                $floors = $this->moveUp($floors, $currentFloor, $direction);

                if (!empty($floors)) { // for what this validation maybe it have sence move it upper on line 40
                    $direction = $this->changeDirection($direction);

                    $this->moveDown($floors, $currentFloor, $direction);
                }

            } else {
                rsort($floors); // Why did you do this sorting?

                $floors = $this->moveDown($floors, $currentFloor, $direction);

                if (!empty($floors)) { // the same
                    $direction = $this->changeDirection($direction);

                    $this->moveUp($floors, $currentFloor, $direction);
                }
            }

            return "Elevator arrives on last floor";

        } else {
            return "Waiting for closing door";
        }
    }

    /**
     * @param $currentFloor
     * @return string
     *
     * Stop Elevator
     *
     */
    private function stopElevator($currentFloor)
    {
        $this->openDoor();

        return "Elevator arrives on $currentFloor floor";
    }

    /**
     * @param $currentFloor
     * @param $direction
     * @return mixed
     *
     * Move Elevator to next Floor
     *
     */
    private function moveToNextFloor($currentFloor, $direction)
    {
        if ($direction == "up") {
            return $currentFloor + 1;
        } else {
            return $currentFloor - 1;
        }
    }

    /**
     * @param $floor
     * @param $queue
     * @return mixed
     *
     * Add chosen floor to Queue
     *
     */
    public function addToQueue($floor, $queue)
    {

        if (!in_array($floor, $queue)) {
            array_push($queue, $floor);
        }

        return $queue;
    }

    /**
     * @param $direction
     * @return bool
     *
     * Change direction
     *
     */
    private function changeDirection($direction)
    {
        return $direction === "up" ? "down" : "up";
    }

    /**
     * @param $floors
     * @param $currentFloor
     * @param $direction
     * @return mixed
     *
     * Elevator goes Up
     */
    private function moveUp($floors, $currentFloor, $direction)
    {
        foreach ($floors as $key => $floor) {
            if ($floor > $currentFloor) {
                while ($currentFloor != $floor) {
                    $currentFloor = $this->moveToNextFloor($currentFloor, $direction);
                }
            }

            if ($floor == $currentFloor) {
                $msg = $this->stopElevator($currentFloor);
                var_dump($msg);
                $key = array_search($floor, $floors);
                unset($floors[$key]);

                $this->closeDoor();
            }
        }

        return $floors;
    }

    /**
     * @param $floors
     * @param $currentFloor
     * @param $direction
     * @return mixed
     *
     * Elevator goes down
     */
    private function moveDown($floors, $currentFloor, $direction)
    {
        foreach ($floors as $key => $floor) {
            if ($floor < $currentFloor) {
                while ($currentFloor != $floor) {
                    $currentFloor = $this->moveToNextFloor($currentFloor, $direction);
                }
            }

            if ($floor == $currentFloor) {
                $msg = $this->stopElevator($currentFloor);
                var_dump($msg);

                $key = array_search($floor, $floors);
                unset($floors[$key]);

                $this->closeDoor();
            }
        }

        return $floors;
    }

}
