<?php


include '../dbh.php';

$name = $_POST['areaname'];
$desc = $_POST['areadesc'];
$photo = $_POST['areaimage'];

$sql_area_name = "SELECT areaname FROM area WHERE areaname='$name'";
$areanames = mysqli_query($conn,$sql_area_name);

if($row = mysqli_fetch_assoc($areanames)){
    echo "Area name already exists!";
}else{
    $sql = "INSERT INTO area (areaname, areadesc, photo) VALUES ('$name','$desc','$photo')";
    $result = mysqli_query($conn,$sql);
    header("Location: ../populate.php");
}
