<?php
//Xin Li
// File name controller.php
// This file acts as the go between the view and the model
// Make theDBA available in this PHP file
include "DatabaseAdaptor.php";

$theDBA = new DatabaseAdaptor();

if (isset($_GET['list_type'])) {
    switch ($_GET['list_type']) {
        case "actor":
            echo json_encode($theDBA->getAllActors($_GET['name']));
            break;
        case "movie":
            echo json_encode($theDBA->getAllMovies($_GET['name']));
            break;
        case "role":
            echo json_encode($theDBA->getAllRoles($_GET['name']));
            break;
        case "fullname":
            echo json_encode($theDBA->getAllRolesMovies($_GET['name']));
            break;
    }
}
