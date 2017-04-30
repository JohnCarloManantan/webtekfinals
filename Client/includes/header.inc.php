<?php
    $session_lifetime = 3600 * 24 * 2; // 2 days
    session_set_cookie_params ($session_lifetime);
    session_start();

    if (!isset($_SESSION['id'])){
         header("Location: index.html?error=nosession");
    }
    
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) { // last request was more than 30 minutes ago
        session_unset();     
        session_destroy();   // destroy session data in storage
        header("Location: errorsession.html");
    }
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Virtuoso</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
    <header>
        <h1>Virtuoso</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="browse.php">Browse</a>
            <a href="#">Programs</a>
            <a href="#">Messages</a>
        </nav>
        <section class="profile-logout">
            <div class="greeting">
                <?php
                    include 'dbh.php';
                    $session =  $_SESSION['id'];

                    $sql = "SELECT name FROM customer WHERE custid='$session'";
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($result);
                    echo "<a href='profile.php' class='welcome'> ".$row['name']. "</a>\n";
                ?>
            </div>
            <div class="logout">
                <form action="includes/logout.inc.php">
                    <input type="submit" value="Logout">
                </form>
            </div>
        </section>
    </header>
