<?php

/**
 *
 * This file needs only for test
 *
 */

set_include_path('Elevator');
spl_autoload_extensions(".php");
spl_autoload_register();

use Elevator\Building as Building;

$test = new Building();
$currentFloor = 2; //Floor where elevator stay on this moment
$requestFloor = 1; //Floor where somebody call elevator
$direction = "up"; //Elevator direction on this moment
$door = false; //Status door
$queue = array(1, 7, 8); //Queue of the floors. You can add or remove floors, than testing elevator

print_r($test->callElevator($currentFloor, $requestFloor, $direction, $door, $queue));