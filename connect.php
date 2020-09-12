<?php
$conn = new mysqli('localhost', 'root', '', 'basic');

if($conn->connect_errno) {
    die("Connection failed" . $conn->connect_error);
}
?>