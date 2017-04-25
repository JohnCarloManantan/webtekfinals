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
    <title>Virtuoso | Home</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<?php
    include 'includes/header_inc.php';
?>
    <main>
        <h2>Dashboard</h2>
        <?php
            include 'dbh.php';
            $session = $_SESSION['id'];
            $sql = "SELECT * FROM transaction where custid='$session'";
            if ($result = mysqli_query($conn, $sql)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    
                }
                mysqli_free_result($result);
            }
            mysqli_close($conn);
        ?>
    </main>
<?php
    include 'includes/footer_inc.php';
?>