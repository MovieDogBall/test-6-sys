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
     * @param $active
     * @param $door
     * @param $queue
     * 
     * @return string
     */
    public function callElevator($currentFloor, $requestFloor, $direction, $active, $door, $queue)
    {

        $elevator = new Elevator();
        $elevator->addObserver(new Logger());

        $floors = $elevator->addToQueue($requestFloor, $queue);

        $elevator->closeDoor();
        $elevator->setFloors($floors);
        $elevator->setDirection($direction);
        $elevator->setCurrentFloor($currentFloor);
        $elevator->moveElevator($door);

        /*if ($active === false && count($floors) == 1) {
            foreach ($floors as $floor) {
                switch ($floor) {
                    case $currentFloor > $floor:
                        $direction = "down";
                        break;
                    case $currentFloor < $floor:
                        $direction = "up";
                        break;
                    case $currentFloor == $floor:
                        $door = $this->openDoor();
                        break;
                    default:
                        $active = true;
                        break;
                }
            }

            $this->closeDoor();
            $elevator->setFloors($floors);
            $elevator->setDirection($direction);
            $elevator->setCurrentFloor($currentFloor);
            $elevator->moveElevator($door);
        }

        $msg = $elevator->moveElevator($door);*/

        //return $msg;
    }

}
