<?php
$hostName="localhost:3307";
$dbUser= "root";
$dbPassword= '';
$dbName= "users";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("something went wrong");
}
?>