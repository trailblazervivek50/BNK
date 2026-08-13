<?php

$host = "sql111.infinityfree.com";
$user = "if0_42638493";
$pass = "sI6N9UjADL";
$dbname = "if0_42638493_bnk";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

?>
