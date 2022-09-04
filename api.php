<?php

require_once 'Helpers/Helpers.php';

$type = $_GET['type'];

switch ($type) {

    case 'city':
        echo Helper_City::getCityByName($_GET['city_name']);
        break;

    default:
        die(json_encode(['status' => 'error', 'message' => "Nothing found by the type $type"]));
        break;

}