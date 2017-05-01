<?php
require_once 'includes/functions.php';
include 'dbh.php';
$tutorID = $_GET['id'];
$sql     = "Select * FROM tutor where tutorid='$tutorID'";
$result  = mysqli_query($conn, $sql);
$row     = mysqli_fetch_assoc($result);
$title   = "Virtuoso | " . ucfirst($row['name']);
generateHtmlHeader($title);
?>
    <main>
        <?php
        
        generateTutorProfileInfo($row);
        ?>        
    </main>
<?php
    include 'includes/footer.inc.php';
?>
