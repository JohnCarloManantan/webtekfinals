<?php
ob_start();
include 'includes/header.inc.php';
$buffer = ob_get_contents();
ob_end_clean();

$title = "Virtuoso | Browse";
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

echo $buffer;


?>
<main>
    <section class="browse-programs">
        <h2>Browse</h2>
        <form method="get" action="search.php" id="programsearch">
            <select name="filter-browse">
                <option value="all"
                    <?php if (isset($_GET['filter-browse']) && $_GET['filter-browse'] == 'all')
                        echo ' selected="selected"';
                    ?>
                >All
                </option>
                <option value="program"
                    <?php if (isset($_GET['filter-browse']) && $_GET['filter-browse'] == 'program')
                        echo ' selected="selected"';
                    ?>
                >Program
                </option>
                <option value="tutor"
                    <?php if (isset($_GET['filter-browse']) && $_GET['filter-browse'] == 'tutor')
                        echo ' selected="selected"';
                    ?>
                >Tutor
                </option>
            </select>
            <input type="text" name="keyword" placeholder="Search">
            <input type="submit" name="search" value="Search">
        </form>

        <section id="browse-prog" class="browse-avail-programs">
            <div class="program-container">
                <h3>Programs</h3>
                <form method="get" action="browse.php#browse-prog" id="programfilter">
                    <select name="filter-prog">
                        <option value="name asc"
                            <?php if (isset($_GET['filter-prog']) && $_GET['filter-prog'] == 'name asc')
                                echo ' selected="selected"';
                            ?>
                        >A-Z
                        </option>
                        <option value="name desc"
                            <?php if (isset($_GET['filter-prog']) && $_GET['filter-prog'] == 'name desc')
                                echo ' selected="selected"';
                            ?>
                        >Z-A
                        </option>
                        <option value="minsession desc"
                            <?php if (isset($_GET['filter-prog']) && $_GET['filter-prog'] == 'minsession desc')
                                echo ' selected="selected"';
                            ?>
                        >Most sessions
                        </option>
                        <option value="minsession asc"
                            <?php if (isset($_GET['filter-prog']) && $_GET['filter-prog'] == 'minsession asc')
                                echo ' selected="selected"';
                            ?>
                        >Most sessions
                        </option>

                    </select>
                    <input type="submit" name="filter-prog-button" value="Filter">
                </form>
                <?php
                if (isset($_GET['filter-prog-button'])) {
                    $filter = $_GET['filter-prog'];
                    $sql = "SELECT * FROM program order by " . $filter;
                } else {
                    $sql = "SELECT * FROM program";

                }

                $result = mysqli_query($conn, $sql);
                if ($result = mysqli_query($conn, $sql)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $program = $row['name'];
                        $desc = $row['desc'];
                        $minsession = $row['minsession'];
                        echo "\n" . '                    <div class="browse-prog-entry">
                                <h4><a href="program.php?id=' . $row['programid'] . '">' . $program . '</a></h4>
                                <p>' . $desc . '</p>
                                <p>Minimum Sessions: ' . $minsession . '</p>' . "\n" . "                    </div><br>" . "\n";
                    }
                    mysqli_free_result($result);
                }

                ?>
            </div>
        </section>

        <section id="browse-tutor" class="browse-avail-tutor">
            <div class="tutor-container">
                <h3>Tutors</h3>
                <form method="get" action="browse.php#browse-tutor" id="tutorfilter">
                    <select name="filter-tutor">

                        <option value="name asc"
                            <?php if (isset($_GET['filter-tutor']) && $_GET['filter-tutor'] == 'name asc')
                                echo ' selected="selected"';
                            ?>
                        >A-Z
                        </option>
                        <option value="name desc"
                            <?php if (isset($_GET['filter-tutor']) && $_GET['filter-tutor'] == 'name desc')
                                echo ' selected="selected"';
                            ?>
                        >Z-A
                        </option>
                        <!--<option value="minsession desc">Most sessions</option>
                        <option value="minsession asc">Least sessions</option>-->
                    </select>
                    <input type="submit" name="filter-tutor-button" value="Filter">
                </form>
                <?php
                if (isset($_GET['filter-tutor-button'])) {
                    $filter = $_GET['filter-tutor'];
                    $sql = "SELECT * FROM tutor order by " . $filter;
                } else {
                    $sql = "SELECT * FROM tutor";
                }

                $result = mysqli_query($conn, $sql);
                if ($result = mysqli_query($conn, $sql)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $tutor = $row['name'];
                        echo "\n" . '                    <div class="browse-prog-entry">
                                <h4><a href="tutor.php?id=' . $row['tutorid'] . '">' . $tutor . '</a></h4>Insert rating.other info</div><br>';
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
