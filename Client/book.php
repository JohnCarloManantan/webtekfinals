<?php
    require_once 'includes/functions.php';

    $title = "Virtuoso | Apply";
    generateHtmlHeader($title);
?>
    <main>
        <h2>Service Booking</h2>
        <?php
            include 'dbh.php';
            $serviceid     = $_GET['id'];
            $sql        = "SELECT * FROM service where serviceid=$serviceid";
            $result     = mysqli_query($conn, $sql);
            $row        = mysqli_fetch_assoc($result);

            generateBookingForm($serviceid,$row);
            mysqli_close($conn);
        ?>   
    </main>
<?php
    include 'includes/footer.inc.php';
?>
