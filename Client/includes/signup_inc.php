<?php
session_start();
include '../dbh.php';

$name = $_POST['name'];
$email = $_POST['email'];
$addr = $_POST['address'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$bday = $_POST['birthday'];
$pwd = $_POST['pwd'];

$sql_users = "SELECT email FROM customer WHERE email='$email'";
$emails = mysqli_query($conn,$sql_users);

if($row = mysqli_fetch_assoc($emails)){
    echo "Email already registered";
}else{
        if(isset($_POST['submit'])){
            if(getimagesize($_FILES['photo']['tmp_name']) == FALSE){
                echo 'no profile image. please upload one.';
            }else{
                $photo = addslashes($_FILES['photo']['tmp_name']);
                $photo = file_get_contents($photo);
                $photo = base64_encode($photo);
            }
            $sql = "INSERT INTO customer (email,name,address,cnumber,gender,birthday,password,photo) VALUES ('$email','$name','$addr','$phone','$gender','$bday','$pwd','$photo')";
            $result = mysqli_query($conn,$sql);
        }
    header("Location: ../index.php");
    header("Location: ../index.php");
    
}

