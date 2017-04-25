<?php


include '../dbh.php';
$img = "";

if(isset($_POST['upload'])){
    $target = "images/". basename($_FILES['serviceimage']['name']);
}

$name = $_POST['servicename'];
$desc = $_POST['servicedesc'];
$price = $_POST['price'];
$image = $_FILES['serviceimage']['name'];

$sql_service_name = "SELECT servicename FROM service WHERE servicename='$name'";
$servicenames = mysqli_query($conn,$sql_service_name);

if($row = mysqli_fetch_assoc($servicenames)){
    echo "Service name already exists!";
}else{
    $sql = "INSERT INTO service (servicename, servicedesc, price, photo) VALUES ('$name','$desc','$price','$image')";
    $result = mysqli_query($conn,$sql);
    header("Location: ../populate.php");
}
