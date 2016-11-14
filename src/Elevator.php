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

    public $floors, $direction, $currentFloor;
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
            while (!empty($floors)) {
                if ($direction == "up") {
                    sort($floors);
                    $floors = $this->moveUp($floors, $currentFloor);

                    if (!empty($floors)) {
                        $direction = "down";
                    }

                }

                if ($direction = "down") {
                    rsort($floors);

                    $floors = $this->moveDown($floors, $currentFloor);

                    if (!empty($floors)) {
                        $direction = "up";
                    }
                }
            }


            return "Elevator arrived on last floor <br />";

        } else {
            return "Waiting  for closing door <br />";
        }
    }

    /**
     * @param $currentFloor
     *
     * Stop Elevator
     *
     */
    private function stopElevator($currentFloor)
    {
        print_r("Elevator arrived on $currentFloor floor <br />");
        $this->openDoor();
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
            print_r("Elevator move to $currentFloor floor <br />");
            return $currentFloor + 1;
        }
        if ($direction == "down") {
            print_r("Elevator move to $currentFloor floor <br />");
            return $currentFloor - 1;
        }
    }

    /**
     * @param $requestFloor
     * @param $queue
     * @return mixed
     */
    public function addToQueue($requestFloor, $queue)
    {

        if (!in_array($requestFloor, $queue)) {
            array_push($queue, $requestFloor);
        }

        return $queue;
    }

    /**
     * @param $floors
     * @param $currentFloor
     * @return array
     */
    private function moveUp($floors, $currentFloor)
    {
        foreach ($floors as $key => $floor) {
            if ($floor > $currentFloor) {
                while ($currentFloor != $floor) {
                    $currentFloor = $this->moveToNextFloor($currentFloor, "up");
                }

                $this->stopElevator($currentFloor);
                unset($floors[$key]);
                $this->closeDoor();
            }
        }

        return $floors;
    }

    /**
     * @param $floors
     * @param $currentFloor
     * @return array
     *
     * Elevator goes down
     */
    private function moveDown($floors, $currentFloor)
    {
        foreach ($floors as $key => $floor) {
            if ($floor < $currentFloor) {
                var_dump($currentFloor);
                while ($currentFloor != $floor) {
                    $currentFloor = $this->moveToNextFloor($currentFloor, "down");
                }

                $this->stopElevator($currentFloor);
                unset($floors[$key]);
                $this->closeDoor();
            }
        }

        return $floors;
    }

}