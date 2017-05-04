<?php
require_once 'includes/functions.php';
$title = "Virtuoso | Home";
generateHtmlHeader($title);
?>
    <main>
        <h2>Dashboard</h2>
        <section class="dashboard">
            
            <section class="dash-ongoing">
                <?php
                $session = $_SESSION['id'];
                generateCurrentPrograms($session);
                ?>
            </section>
            <section class="dash-pending">
                <?php
                generatePendingPrograms($session);
                ?>
            </section>
        </section>
    </main>

<?php
    include 'includes/footer.inc.php';
?>
