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
            while (!empty($floors)) {
                if ($direction == "up") {
                    sort($floors);
                    $floors = $this->moveUp($floors, $currentFloor);

                    if (empty($floors)) {
                        $direction = "down";
                    }

                }
                if ($direction = "down") {
                    rsort($floors);

                    $floors = $this->moveDown($floors, $currentFloor);

                    if (empty($floors)) {
                        $direction = "up";
                    }
                }
            }


            return "Elevator arrives on last floor";

        } else {
            return "Waiting  for closing door";
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
        print_r("Elevator arrives on $currentFloor floor");
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
            print_r("Elevator move to up");
            return $currentFloor + 1;
        } else {
            print_r("Elevator move to down");
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
     * @return array
     */
    private function moveUp($floors, $currentFloor)
    {
        foreach ($floors as $key => $floor) {
            if ($floor > $currentFloor) {
                while ($currentFloor != $floor) {
                    $currentFloor = $this->moveToNextFloor($currentFloor, "up");
                }
            }

            $this->stopElevator($currentFloor);
            unset($floors[$key]);
            $this->closeDoor();
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
                while ($currentFloor != $floor) {
                    $currentFloor = $this->moveToNextFloor($currentFloor, "down");
                }
            }

            $this->stopElevator($currentFloor);

            unset($floors[$key]);

            $this->closeDoor();

        }

        return $floors;
    }

}