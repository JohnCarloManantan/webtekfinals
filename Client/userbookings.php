<?php
    ob_start();
    include 'includes/header.inc.php';
    $buffer = ob_get_contents();
    ob_end_clean();
    $title  = "Virtuoso | Bookings";
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
    echo $buffer;
?>
<main>

<h2>Bookings</h2>
<?php
    
?>


</main>
<?php
    include 'includes/footer.inc.php';
?>
