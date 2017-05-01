<?php
require_once 'includes/functions.php';
$title = "Virtuoso | Profile";
generateHtmlHeader($title);
?>
   
    <main>
<?php
include 'dbh.php';
$user   = $_SESSION['id'];
$sql    = "SELECT * FROM customer where custid='$user'";
$result = mysqli_query($conn, $sql);
$row    = mysqli_fetch_assoc($result);
displayImage();
generateCustomerProfileInfo($row);
mysqli_close($conn);
?>
    </main>
<?php
include 'includes/footer.inc.php';
?>
