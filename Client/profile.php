<?php
    session_start();
    if (!isset($_SESSION['id'])){
         header("Location: index.php");
    }
?>
<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Virtuoso | Profile</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
    <?php
        include 'includes/header_inc.php';
    ?>
    <main>
        <?php
            include 'dbh.php';
            $user = $_SESSION['id'];
            $sql = "SELECT * FROM customer where custid='$user'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        
            displayImage();
            echo "<section class='profile'>\n
            <p class='profname'>".$row['name']."</p>
            <p class='email'>".$row['email']."</p>
            <p class='cnumber'>".$row['cnumber']."</p>
            <p class='address'>".$row['address']."</p>
            <p class='birthday'>".$row['birthday']."</p>
        </section>\n
        <a href='editprof.php'>Edit Profile</a>";
            
        
        function displayImage(){
            include 'dbh.php';
            $user = $_SESSION['id'];
            $sql = "SELECT * FROM customer where custid='$user'";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)){
                echo '<img height="300" width="300" src="data:photo;base64, '.$row['photo'].' "> ';
            }
            mysqli_close($conn);
        }
        ?>
    </main>
    <?php
        include 'includes/footer_inc.php';
    ?>
