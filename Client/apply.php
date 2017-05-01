<?php
require_once 'includes/functions.php';
$title = "Virtuoso | Apply";
generateHtmlHeader($title);
?>
    <main>
        <h2>Program Application</h2>
        <?php
        include 'dbh.php';
        $progid     = $_GET['id'];
        $sql        = "SELECT * FROM program where programid='$progid'";
        $result     = mysqli_query($conn, $sql);
        $row        = mysqli_fetch_assoc($result);
        generateApplicationForm($progid,$row);
        ?>   
    </main>

<?php
    include 'includes/footer.inc.php';
?>
