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
    <title>Virtuoso | Edit Profile</title>
</head>

<?php
    include 'includes/header.inc.php';
?>
    <main>
        <h2>Edit Profile</h2>
    </main>

<?php
    include 'includes/footer.inc.php';
?>
