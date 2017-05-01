<?php
require_once 'includes/functions.php';
$title = "Virtuoso | Search";
generateHtmlHeader($title);
?>
    <main>
        <section class="browse-programs">
            <h2>Search</h2>
            <form method="get" action="search.php" id="programsearch">
                <select name="filter-browse">
                    <option value="all" 
                        <?php
if (isset($_GET['filter-browse']) && $_GET['filter-browse'] == 'all')
    echo ' selected="selected"';
?>
                      >All
                      </option>
                    <option value="program" 
                        <?php
if (isset($_GET['filter-browse']) && $_GET['filter-browse'] == 'program')
    echo ' selected="selected"';
?>
                      >Program
                      </option>
                 <option value="tutor" 
                        <?php
if (isset($_GET['filter-browse']) && $_GET['filter-browse'] == 'tutor')
    echo ' selected="selected"';
?>
                      >Tutor
                      </option>
               </select>
                <input type="text" name="keyword" placeholder="Search">
                <input type="submit" name="search" value="Search">
            </form>
<?php
if (isset($_GET['filter-browse'])) {
    if ($_GET['filter-browse'] == 'program') {
        searchProgram();
    } else if ($_GET['filter-browse'] == 'tutor') {
        searchTutor();
    } else {
        searchProgTutor();
    }
}
?>
        </section>
    </main>
<?php
include 'includes/footer.inc.php';
?>
