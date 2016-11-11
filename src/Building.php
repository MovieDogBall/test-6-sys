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

    public function callElevator($currentFloor, $floor, $direction, $active, $door)
    {
        $Elevator = new Elevator();

        $floors = $Elevator->addToQueue($floor);

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

            $msg = $Elevator->moveElevator($currentFloor, $floors, $door, $direction);
        }

        $msg = $Elevator->moveElevator($currentFloor, $floors, $door, $direction);

        return $msg;
    }

    protected function openDoor()
    {
        return true;
    }

    protected function closeDoor()
    {
        return false;
    }
}