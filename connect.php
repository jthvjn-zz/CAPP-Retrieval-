<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";


$conn = new mysqli($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}

?>
