<?php
set_include_path('Elevator');
spl_autoload_extensions(".php");
spl_autoload_register();

use Elevator\Building as Building;

$test = new Building();
$currentFloor = 2; //Этаж где лифт
$requestFloor = 2; //Этаж с которого вызвали
$direction = "up"; //направление
$door = false; //состояние двери
$active = true; //лифт сейчас в движении
$queue = array(1, 4, 5, 6, 8); //очередь из этажей по которым должен проехать лифт

print_r($test->callElevator($currentFloor, $requestFloor, $direction, $active, $door, $queue));