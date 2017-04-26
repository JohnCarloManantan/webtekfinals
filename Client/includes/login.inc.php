<?php
    session_start();
    include '../dbh.php';

    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $sql = "SELECT * FROM customer where email='$email' AND password='$pwd'";
    $result = mysqli_query($conn,$sql);

    if(!$row = mysqli_fetch_assoc($result)){
         header("Location: ../index.php?error=login");
    }else{
        if($row['status'] == 'pending'){
            header("Location: ../index.php?error=unregistered");
        }else{
            $_SESSION['id'] = $row['custid'];
            header("Location: ../home.php");
        }
    }

    mysqli_close($conn);