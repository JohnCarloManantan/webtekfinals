<?php
ob_start();
include 'includes/header.inc.php';
$buffer = ob_get_contents();
ob_end_clean();
$title  = "Virtuoso | Messages";
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
echo $buffer;
?>
<main>

<h2>Your Programs</h2>



</main>
<?php
include 'includes/footer.inc.php';
?>
