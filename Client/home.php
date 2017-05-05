<?php
    require_once 'includes/functions.php';
    $title = "Virtuoso | Home";

    generateHtmlHeader($title);
?>
    <main>
        <h2>Dashboard</h2>
        <section>
            <section>
                <?php
                    $session = $_SESSION['id'];
                    generateCurrentBookings($session);
                ?>
            </section>
            <section >
                <?php
                    generatePendingBookings($session);
                ?>
            </section>
                <?php
                    if(($_SESSION['usercurrentbooking'] || $_SESSION['userpendingbooking']) == FALSE){
                        echo "You have no booked services. <a href='browse.php'>Book Now!</a>";
                    }
                ?>
        </section>
    </main>

<?php
    include 'includes/footer.inc.php';
?>
