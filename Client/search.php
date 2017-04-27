<?php
    ob_start();
    include 'includes/header.inc.php';
    $buffer=ob_get_contents();
    ob_end_clean();

    $title = "Virtuoso | Search";
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

    echo $buffer;
?>
    <main>
        <section class="browse-programs">
            <h2>Search</h2>
            <form method="get" action="search.php" id="programsearch">
                
                <input type="text" name="keyword" placeholder="Search">
                <input type="submit" name="search">
            </form>

            <?php
            searchProgram();
            /*Search Program Functionality*/
            function searchProgram(){
                include 'dbh.php';
                if(isset($_GET['search'])){
                $search = mysqli_real_escape_string($conn,$_GET['keyword']);
                $sql = "SELECT * FROM program WHERE name LIKE '%$search%' OR program.desc LIKE '%$search%'";
                $result = mysqli_query($conn,$sql);
                $queryResult = mysqli_num_rows($result);
              
                if($queryResult>0){
                    while($row = mysqli_fetch_assoc($result)){
                        $program = $row['name'];
                        $desc = $row['desc'];
                        $minsession= $row['minsession'];
                        echo "\n".'                    <div class="browse-prog-entry">
                        <h4><a href="program.php?id='.$row['programid'].'">'.$program.'</a></h4>
                        <p>'.$desc.'</p>
                        <p>Minimum Sessions: '.$minsession.'</p>'."\n"."                    </div><br>"."\n";
                    }
                }else{
                    echo "<p class='no-search-result'>No Search Results</p>";
                }
            }
            }
            
        ?>

        </section>
    </main>
    <?php
    include 'includes/footer.inc.php';
?>
