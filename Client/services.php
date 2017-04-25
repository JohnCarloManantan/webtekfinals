<?php
include 'includes/header_inc.php';
?>
    <main>
    <?php
            include 'dbh.php';
            
            $sql = "SELECT * FROM service";
            if ($result = mysqli_query($conn, $sql)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $servicename = $row['servicename'];
                    
                    echo "<section class='services' id='$servicename'><h3>".$row['servicename']."</h3> ". $row['servicedesc']."<br><strong> P".$row['price']."</strong></section>";
                    
                }
                mysqli_free_result($result);
            }
        ?>
        </main>
<?php
include 'includes/footer_inc.php';
?>