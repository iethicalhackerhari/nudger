<?php
include 'db_connect.php';

$msg = $_POST['text'];
$room = $_POST['room'];
$ip = $_POST['ip'];

$sql= "INSERT INTO `mesg` (`msg`, `room`, `ip`, `timestamp`) VALUES ('$msg', '$room', '$ip', CURRENT_TIMESTAMP);";

$result=$conn->query($sql);

?>