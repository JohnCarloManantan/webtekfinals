<?php
    session_start();
    if (isset($_SESSION['id'])){
         header("Location: home.php");
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Virtuoso</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
    <h1>Virtuoso</h1>

    <section id="login">
        <h2>Login</h2>
        <form action="includes/login.inc.php" method="POST">
            <input name="email" type="email" placeholder="Email" required><br>
            <input name="pwd" type="password" placeholder="Password" required><br>
            <input type="submit" value="Login">
        </form>
        
        <?php
        
            $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        
            if (strpos($url,'error=unregistered') !== FALSE){
                echo 'Your registration has not been approved. ';
            }
        
            if (strpos($url,'error=login') !== FALSE){
                echo 'Your email or password is invalid! ';
            }
        
            if (isset($_SESSION['id'])){
                echo $_SESSION['id'];
            }else{
                echo 'You are not logged in.';
            }
        ?>
        
    </section>
</body>
</html>
