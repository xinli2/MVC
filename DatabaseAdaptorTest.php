<?php
//Xin Li
include "DatabaseAdaptor.php";

$theDBA = new DatabaseAdaptor();
$arr = $theDBA->getAllMovies("will");
print_r($arr);
