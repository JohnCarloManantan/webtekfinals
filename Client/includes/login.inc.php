<?php
    $session_lifetime = 3600 * 24 * 2; // 2 days
    session_set_cookie_params ($session_lifetime);
    session_start();
    include '../dbh.php';

    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $sql = "SELECT * FROM customer where email='$email' AND password='$pwd'";
    $result = mysqli_query($conn,$sql);

    if(!$row = mysqli_fetch_assoc($result)){
         header("Location: ../login.php?error=login");
    }else{
        if($row['status'] == 'pending'){
            header("Location: ../login.php?error=unregistered");
        }else{
            $_SESSION['id'] = $row['custid'];
            header("Location: ../home.php");
        }
    }
    mysqli_close($conn);