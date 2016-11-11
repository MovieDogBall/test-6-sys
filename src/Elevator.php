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
                        var_dump($msg);
                        $key = array_search($floor, $floors);
                        unset($floors[$key]);

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
                        var_dump($msg);

                        $key = array_search($floor, $floors);
                        unset($floors[$key]);

                        $this->closeDoor();
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
     * @param $queue
     * @return mixed
     */
    public function addToQueue($floor, $queue)
    {

        if (!in_array($floor, $queue)) {
            array_push($queue, $floor);
        }

        return $queue;
    }

}