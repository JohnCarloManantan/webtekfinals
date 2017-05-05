<?php
session_start();
include '../dbh.php';

$sessionid = $_SESSION['id'];
$serviceid = $_GET['serviceid'];
$tutorid = $_GET['select_tutor'];
$messg = mysql_real_escape_string($_GET['message']);
$sched = mysql_real_escape_string($_GET['sched']);

$sql = "INSERT INTO booking (schedule,order_message,custid,serviceid,tutorid) VALUES ('$sched','$messg','$sessionid','$serviceid','$tutorid')";
mysqli_query($conn,$sql);

$last_id = mysqli_insert_id($conn);

header("Location: ../bookinfo.php?bid=$last_id");

mysqli_close($conn);