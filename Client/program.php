<?php
ob_start();
include 'includes/header.inc.php';
require_once 'includes/functions.php';
$buffer=ob_get_contents();
ob_end_clean();

if(isset($_GET['id'])){
    $_SESSION['progid'] = $_GET['id'];
    $progID = $_SESSION['progid'];
}else{
    $progID = $_SESSION['progid'];
}

$sql = "Select * FROM program where programid='$progID'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$title = "Virtuoso | ".ucfirst($row['name']);
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

echo $buffer;
?>
    <main>
        <?php
    echo "<h2>".ucfirst($row['name'])."</h2>
    <p>".$row['desc']."</p>
    <p>Minimum Session: ".$row['minsession']."</p>\n
    <a href='apply.php?id=".$row['programid']."'>Apply</a>";
    ?>
            <h3>Tutors</h3>
            <form name="filter-prog-tutor" action="program.php">
                <select name="filter-tutor-select">
                    <option value="tutor asc" 
                        <?php if(isset($_GET['filter-tutor-select']) && $_GET['filter-tutor-select'] == 'tutor asc') 
                              echo ' selected="selected"';
                        ?>
                      >A-Z
                      </option>
                  <option value="tutor desc" 
                        <?php if(isset($_GET['filter-tutor-select']) && $_GET['filter-tutor-select'] == 'tutor desc') 
                              echo ' selected="selected"';
                        ?>
                      >Z-A
                </option>
                <option value="tutorrate desc" 
                        <?php if(isset($_GET['filter-tutor-select']) && $_GET['filter-tutor-select'] == 'tutorrate desc') 
                              echo ' selected="selected"';
                        ?>
                      >Highest Rate
                      </option>
                  <option value="tutorrate asc" 
                        <?php if(isset($_GET['filter-tutor-select']) && $_GET['filter-tutor-select'] == 'tutorrate asc') 
                              echo ' selected="selected"';
                        ?>
                      >Lowest Rate
                </option>
               </select>
                <input type="submit" value="Filter" name="filter-tutor-submit">
            </form>
            <?php
            

        if (isset($_GET['filter-tutor-submit'])){
            $filter=$_GET['filter-tutor-select'];
            $sql_tp = "Select tp.tutorid,tp.programid,t.name tutor,p.name program,tutorrate\n"
        . "FROM tutorprogram tp join tutor t on tp.tutorid = t.tutorid join program p on tp.programid = p.programid\n"
        . "WHERE tp.programid ='$progID' order by $filter";
        }else{
           $sql_tp = "Select tp.tutorid,tp.programid,t.name tutor,p.name program,tutorrate\n"
        . "FROM tutorprogram tp join tutor t on tp.tutorid = t.tutorid join program p on tp.programid = p.programid\n"
        . "WHERE tp.programid ='$progID'";

        }


        $result_tp = mysqli_query($conn,$sql_tp);
        $queryResult = mysqli_num_rows($result_tp);


       generateTutorTable($result_tp, $queryResult)
        ?>
    </main>
    <?php
include 'includes/footer.inc.php';
?>
