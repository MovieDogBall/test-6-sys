<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 07.11.2016
 * Time: 18:03
 */

require_once "src/Building.php";

use Building\Building as Building;

$test = new Building();
$currentFloor = 2;
$floor = 1;
$direction = true;
$door = false;
$active = true;


var_dump($test->callElevator($currentFloor, $floor, $direction, $active, $door));