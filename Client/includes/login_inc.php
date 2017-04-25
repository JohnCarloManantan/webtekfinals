<?php
session_start();
include '../dbh.php';

$email = $_POST['email'];
$pwd = $_POST['pwd'];

$sql = "SELECT * FROM customer where email='$email' AND password='$pwd'";
$result = mysqli_query($conn,$sql);

if(!$row = mysqli_fetch_assoc($result)){
    echo "Your email or password is incorrect!";
}else{
    if($row['status'] == 'pending'){
        echo "Your registration has not been approved.";
    }else{
        $_SESSION['id'] = $row['custid'];
        header("Location: ../home.php");
    }
}

mysqli_close($conn);