<?php
session_start();
$dbServerName = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName = "football";
$conn = mysqli_connect($dbServerName,$dbUserName,$dbPassword,$dbName);

?>