<?php

namespace Elevator;

/**
 * Class Building
 * @package Building
 */
class Building
{
    /**
     * @param $currentFloor
     * @param $requestFloor
     * @param $direction
     * @param $door
     * @param $queue
     *
     * Call elevator. This function calls when we push any button
     *
     */
    public function callElevator($currentFloor, $requestFloor, $direction, $door, $queue)
    {

        $elevator = new Elevator();
        $elevator->addObserver(new Logger());

        $floors = $elevator->addToQueue($requestFloor, $queue);

        if (count($floors) == 1) {
            if ($currentFloor > $requestFloor) {
                $direction = "down";
            } elseif ($currentFloor < $requestFloor) {
                $direction = "up";
            }
        }

        $elevator->closeDoor();
        $elevator->setFloors($floors);
        $elevator->setDirection($direction);
        $elevator->setCurrentFloor($currentFloor);
        $elevator->moveElevator($door);
    }

}
