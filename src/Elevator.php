<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 10.11.2016
 * Time: 20:31
 */


namespace Elevator;

require_once "Building.php";

use Building\Building;


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
     */
    public function moveElevator($currentFloor, $floors, $door, $direction)
    {
        if ($door === false) {
            if ($direction === true) {
                sort($floors);

                foreach ($floors as $key => $floor) {
                    if ($floor > $currentFloor) {
                        while ($currentFloor != $floor) {
                            $currentFloor = $this->moveToNextFloor($currentFloor, $direction);
                        }
                    }

                    if ($floor == $currentFloor) {
                        $msg = $this->stopElevator($currentFloor);

                        $key = array_search($floor, $floors);
                        unset($floors[$key]);

                        sleep(5);
                        $this->closeDoor();
                    }
                }
            } else {
                rsort($floors);

                foreach ($floors as $key => $floor) {
                    if ($floor < $currentFloor) {
                        while ($currentFloor != $floor) {
                            $currentFloor = $this->moveToNextFloor($currentFloor, $direction);
                        }
                    }

                    if ($floor == $currentFloor) {
                        $msg = $this->stopElevator($currentFloor);
                        $key = array_search($floor, $floors);
                        unset($floors[$key]);
                    }
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
     */
    private function moveToNextFloor($currentFloor, $direction)
    {
        if ($direction === true) {
            return $currentFloor + 1;
        } else {
            return $currentFloor - 1;
        }
    }

    /**
     * @param $floor
     * @return mixed
     */
    public function addToQueue($floor)
    {
        return array_push($this->queue, $floor);
    }

    /**
     * @return mixed
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * @param $queue
     */
    public function setQueue($queue)
    {
        $this->queue = $queue;
    }

}