<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 10.11.2016
 * Time: 22:55
 */


namespace Building;

require_once "Elevator.php";

use Elevator\Elevator as Elevator;

/**
 * Class Building
 * @package Building
 */
class Building
{

    /**
     * @param $currentFloor
     * @param $floor
     * @param $direction
     * @param $active
     * @param $door
     * @return string
     */
    public function callElevator($currentFloor, $floor, $direction, $active, $door)
    {
        $Elevator = new Elevator();

        $queue = array(4, 5, 7, 3);

        $floors = $Elevator->addToQueue($floor, $queue);

        if ($active === false && count($floors) == 1) {
            foreach ($floors as $floor) {
                switch ($floor) {
                    case $currentFloor > $floor:
                        $direction = false;
                        break;
                    case $currentFloor < $floor:
                        $direction = true;
                        break;
                    case $currentFloor == $floor:
                        $door = $this->openDoor();
                }
            }

            $this->closeDoor();
            $msg = $Elevator->moveElevator($currentFloor, $floors, $door, $direction);
        }

        $msg = $Elevator->moveElevator($currentFloor, $floors, $door, $direction);

        return $msg;
    }

    /**
     * @return bool
     */
    protected function openDoor()
    {
        return true;
    }

    /**
     * @return bool
     */
    protected function closeDoor()
    {
        sleep(5);
        return false;
    }
}