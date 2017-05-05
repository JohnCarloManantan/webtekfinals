<?php
    $session_lifetime = 3600 * 24 * 2; // 2 days
    session_set_cookie_params ($session_lifetime);
    session_start();

    if (!isset($_SESSION['id'])){
         header("Location: index.php?error=nosession");
    }
    
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) { // last request was more than 30 minutes ago
        session_unset();
        mysqli_close($conn);
        session_destroy();   // destroy session data in storage
        header("Location: expiredsession.html");
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
            <a href="userbookings.php">Bookings</a>
            <a href="messages.php">Messages</a>
        </nav>
        <section>
            <div>
                <?php
                    include 'dbh.php';
                    $session =  $_SESSION['id'];

                    $sql = "SELECT name FROM customer WHERE custid='$session'";
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($result);
                    echo "<a href='profile.php' class='welcome'> ".$row['name']. "</a>\n";
                ?>
            </div>
            <div>
                <form action="includes/logout.inc.php">
                    <input type="submit" value="Logout">
                </form>
            </div>
        </section>
    </header>
