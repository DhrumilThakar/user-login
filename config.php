<?php

$host ="localhost";
$username = "root";
$password = "";
$dbname = "user_db";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->conntect_error) {
    die("Connection failed: " .$conn->connect_error());
}
?>