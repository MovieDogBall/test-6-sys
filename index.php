<?php

require_once "src/Building.php";

use Building\Building as Building;

$test = new Building();
$currentFloor = 2;//Этаж где лифт
$floor = 1;//Этаж с которого вызвали
$direction = "up";//направление
$door = false;//состояние двери
$active = true;//лифт сейчас в движении
$queue = array(4, 5, 6, 8);//очередь из этажей по которым должен проехать лифт

var_dump($test->callElevator($currentFloor, $floor, $direction, $active, $door, $queue));