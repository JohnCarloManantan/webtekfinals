<body>
    <header>
        <h1>Virtuoso</h1>
        <nav>
            <a href="home.php">Home</a>
            <a href="browse.php">Browse</a>
            
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