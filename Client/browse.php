<?php
    ob_start();
    include 'includes/header.inc.php';
    $buffer=ob_get_contents();
    ob_end_clean();

    $title = "Virtuoso | Browse";
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

    echo $buffer;
?>
    <main>
        <section class="browse-programs">
            <h2>Programs</h2>
            <form method="get" action="search.php" id="programsearch">
                <input type="text" name="keyword" placeholder="Search program">
                <input type="submit" name="search" value="Search">
            </form>
            <section class="browse-avail-programs">
                <div class="program-container">
                    <?php
                        $sql = "Select * from program";
                        $result = mysqli_query($conn, $sql);
                        if ($result = mysqli_query($conn, $sql)) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $program = $row['name'];
                                $desc = $row['desc'];
                                $minsession= $row['minsession'];
                                echo "\n".'                    <div class="browse-prog-entry">
                                <h4><a href="program.php?id='.$row['programid'].'">'.$program.'</a></h4>
                                <p>'.$desc.'</p>
                                <p>Minimum Sessions: '.$minsession.'</p>'."\n"."                    </div><br>"."\n";
                            }
                            mysqli_free_result($result);
                        }
                        mysqli_close($conn);
                ?>
                </div>
            </section>
        </section>
    </main>
<?php
    include 'includes/footer.inc.php';
?>
