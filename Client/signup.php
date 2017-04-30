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
    <section id="signup">
        <h2>Sign Up</h2>
        <?php
        
            $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        
            if (strpos($url,'error=unregistered') !== FALSE){
                echo 'Your registration has not been approved. ';
            }
        
            if (strpos($url,'error=login') !== FALSE){
                echo 'Your email or password is invalid! ';
            }
        
             if (strpos($url,'account=created') !== FALSE){
                echo 'Your account has been created. Please wait for your account to be approved. ';
            }
        ?>
        <form action="includes/signup.inc.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="size" value="1000000000"><br>
            <input name="name" type="text" placeholder="Name" required><br>
            <input name="email" type="email" placeholder="Email" required><br>
            <input name="address" type="text" placeholder="Home Address" required><br>
            <input name="phone" type="tel" placeholder="Phone (xxxx-xxx-xxxx)" required><br>
            <input name="birthday" type="date"><br>
            <select name="gender" required>
               <option selected value="none">Gender</option>
                <option value="f">Female</option>
                <option value="m">Male</option>
            </select><br>
            <input name="pwd" type="password" placeholder="Password" required><br>
            <input name="pwdconfirm" type="password" placeholder="Re-enter Password" required><br>
            Profile Image <input type="file" name="photo"><br>
            <?php
                if (strpos($url,'error=email') !== FALSE){
                    echo 'Your email or password is invalid! ';
                }
            ?>
            <input type="submit" value="Sign Up" name="submit" required>
        </form>
        
        <a href="login.php">Log in</a>
    </section>
</body>
</html>
