<?php

require_once "src/Building.php";

use Building\Building as Building;

$test = new Building();
$currentFloor = 2;
$floor = 1;
$direction = true;
$door = false;
$active = true;
$queue = array_push(4, 5, 6, 8);

var_dump($test->callElevator($currentFloor, $floor, $direction, $active, $door, $queue));