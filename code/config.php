<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "students_db"; // your database name

$conn = mysqli_connect($server, $username, $password, $dbname);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>
