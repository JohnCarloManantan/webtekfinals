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
    <title>Virtuoso | Browse</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<?php
        include 'includes/header.inc.php';
?>
    <main>
        <section class="browse-programs">
           <!-- Continue search functionality-->
            <h2>Programs</h2>
            <form method="post" action="includes/search.php?go" id="programsearch">
                <input type="text" name="program" placeholder="Enter program">
                <input type="submit" name="submit" value="Search">
            </form>
            <section class="browse-avail-programs">
                <?php
                include 'dbh.php';
                $sql = "Select * from program";
                $result = mysqli_query($conn, $sql);
                if ($result = mysqli_query($conn, $sql)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $program = $row['name'];
                        $desc = $row['desc'];
                        $minsession= $row['minsession'];
                        echo '<section class="browse-prog-entry">
                        <h4><a href="">'.$program.'</a></h4>
                        <p>'.$desc.'</p>
                        <p>Minimum Sessions: '.$minsession.'</p></section><br>';
                    }
                    mysqli_free_result($result);
                }
                mysqli_close($conn);
            ?>
            </section>
        </section>
    </main>
    <?php
        include 'includes/footer.inc.php';
    ?>
