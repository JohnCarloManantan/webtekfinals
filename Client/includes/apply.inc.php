<?php
session_start();
include '../dbh.php';

$sessionid = $_SESSION['id'];
$progid = $_GET['progid'];
$tutorid = $_GET['select_tutor'];

$sql = "INSERT INTO transaction (custid,programid,tutorid) VALUES ('$sessionid','$progid','$tutorid')";
mysqli_query($conn,$sql);
mysqli_close($conn);

header("Location: ../user_programs.php");