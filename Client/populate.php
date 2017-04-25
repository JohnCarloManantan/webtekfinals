<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Virtuoso | Populate </title>
</head>

<body>
    <h1>Virtuoso</h1>
    <h2>Service</h2>
    <form action="includes/servicepop_inc.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="servicename" placeholder="Service Name" required><br>
        <textarea type="text" name="servicedesc" placeholder="Service Description" required></textarea><br>
        <input type="number" name="price" placeholder="Service Price" required><br>
        <input type="submit" value="submit">
    </form>
    <hr>

    <h2>Users</h2>
    <h3>Pending</h3>
    <p>Check all you the users your want approved.</p>
    <form action="includes/pending_inc.php" method="POST">
        <?php
        include 'dbh.php';
        $sql = "SELECT * FROM customer where status='Pending'";
        $result = mysqli_query($conn, $sql);
        
         if ($result = mysqli_query($conn, $sql)) {
                while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['custid'];
                        echo "<br/><input type='checkbox' name=\"students[]\" value='$id' />".$row['name']."<br>";
                }
                mysqli_free_result($result);
            }
        echo "<input type='submit' value='register'>";
    ?>
    </form>
</body>

</html>
