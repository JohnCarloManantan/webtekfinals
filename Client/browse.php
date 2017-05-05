<?php
    require_once 'includes/functions.php';
    $title = "Virtuoso | Browse";
    generateHtmlHeader($title);
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
                <option value="service"
                    <?php if (isset($_GET['filter-browse']) && $_GET['filter-browse'] == 'program')
                        echo ' selected="selected"';
                    ?>
                >Service
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

        <section>
            <div>
                <h3>Services</h3>
                <form method="get" action="browse.php#browse-prog">
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
                    </select>
                    <input type="submit" name="filter-prog-button" value="Filter">
                </form>
                <?php
                
                    if (isset($_GET['filter-prog-button'])) {
                        $filter = $_GET['filter-prog'];
                        $sql    = "SELECT * FROM service order by " . $filter;
                    } else {
                        $sql = "SELECT * FROM service";
                    }

                    generateBrowseServiceEntry($sql);
                
                ?>
            </div>
        </section>

        <section>
            <div>
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
                    </select>
                    <input type="submit" name="filter-tutor-button" value="Filter">
                </form>
                <?php
                
                    if (isset($_GET['filter-tutor-button'])) {
                        $filter = $_GET['filter-tutor'];
                        $sql    = "SELECT * FROM tutor order by " . $filter;
                    } else {
                        $sql = "SELECT * FROM tutor";
                    }
                
                    generateBrowseTutorEntry($sql);
                ?>
            </div>
        </section>
    </section>
</main>
<?php
    include 'includes/footer.inc.php';
?>
