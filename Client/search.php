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
                <select name="filter-browse">
                    <option value="all" 
                        <?php if(isset($_GET['filter-browse']) && $_GET['filter-browse'] == 'all') 
                              echo ' selected="selected"';
                        ?>
                      >All
                      </option>
                    <option value="program" 
                        <?php if(isset($_GET['filter-browse']) && $_GET['filter-browse'] == 'program') 
                              echo ' selected="selected"';
                        ?>
                      >Program
                      </option>
                 <option value="tutor" 
                        <?php if(isset($_GET['filter-browse']) && $_GET['filter-browse'] == 'tutor') 
                              echo ' selected="selected"';
                        ?>
                      >Tutor
                      </option>
               </select>
                <input type="text" name="keyword" placeholder="Search">
                <input type="submit" name="search" value="Search">
            </form>
            <?php
                
                if(isset($_GET['filter-browse'])){
                    if($_GET['filter-browse'] == 'program'){
                    searchProgram();
                }else if($_GET['filter-browse'] == 'tutor'){
                    searchTutor();
                    
                }else{
                    searchProgTutor();
                }
                }
                

                /*Search Program Functionality*/

                function searchProgram(){
                    include 'dbh.php';
        
                    if(isset($_GET['search'])){
                        $search = mysqli_real_escape_string($conn,$_GET['keyword']);
                        $sql = "SELECT * FROM program WHERE name LIKE '%$search%' OR program.desc LIKE '%$search%' order by name";

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

                 /*Search Tutor Functionality*/

                function searchTutor(){
                    include 'dbh.php';
                    if(isset($_GET['search'])){
                        $search = mysqli_real_escape_string($conn,$_GET['keyword']);
                        $sql = "SELECT * FROM tutor WHERE name LIKE '%$search%' order by name";
                        $result = mysqli_query($conn,$sql);
                        $queryResult = mysqli_num_rows($result);

                        if($queryResult>0){
                            while($row = mysqli_fetch_assoc($result)){
                                $tutor = $row['name'];
                                echo "\n".'                    <div class="browse-prog-entry">
                                <h4><a href="tutor.php?id='.$row['tutorid'].'">'.$tutor.'</a></h4>
                                Insert Rating here. Other info</div><br>';
                            }
                        }else{
                            echo "<p class='no-search-result'>No Search Results</p>";
                        }
                    }
                }

                 function searchProgTutor(){
                    include 'dbh.php';
                    if(isset($_GET['search'])){
                        $search = mysqli_real_escape_string($conn,$_GET['keyword']);
                            
                        $sql_program = "SELECT * FROM program WHERE name LIKE '%$search%' OR program.desc LIKE '%$search%'";
                        $result_prog = mysqli_query($conn,$sql_program);
                        $queryResult = mysqli_num_rows($result_prog );

                        if($queryResult>0){
                            echo "<h3>Programs</h3>";
                            while($row = mysqli_fetch_assoc($result_prog)){
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
                        
                        $sql_tutor = "SELECT * FROM tutor WHERE name LIKE '%$search%'";
                        $result_tutor = mysqli_query($conn,$sql_tutor);
                        $queryResult = mysqli_num_rows($result_tutor);

                        if($queryResult>0){
                            echo "<h3>Tutors</h3>";
                            while($row = mysqli_fetch_assoc($result_tutor)){
                                $tutor = $row['name'];
                                echo "\n".'                    <div class="browse-prog-entry">
                                <h4><a href="program.php?id='.$row['tutorid'].'">'.$tutor.'</a></h4>
                                Insert Rating here</div><br>';
                        }
                    }
                }
            }
        ?>
        </section>
    </main>
    <?php
    include 'includes/footer.inc.php';
?>
