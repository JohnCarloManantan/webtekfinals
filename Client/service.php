<?php
ob_start();
include 'includes/header.inc.php';
require_once 'includes/functions.php';
$buffer=ob_get_contents();
ob_end_clean();

if(isset($_GET['id'])){
    $_SESSION['serviceid'] = $_GET['id'];
    $serviceid = $_SESSION['serviceid'];
}else{
    $serviceid = $_SESSION['serviceid'];
}

$sql = "Select * FROM service where serviceid=$serviceid";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

$title = "Virtuoso | ".ucfirst($row['name']);
$buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

echo $buffer;
?>
    <main>
        <?php
        
            $servicename = ucfirst($row['name']);
            $desc = $row['desc'];
        
echo <<<FRAG
<h2>$servicename</h2>
<p>$desc</p>
<a href="book.php?id=$serviceid">Book</a>
FRAG;
        
        ?>
            <h3>Tutors</h3>
            <form name="filter-prog-tutor" action="service.php">
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
                    $sql_tp = "SELECT ts.tutorid,ts.serviceid,t.name tutor,s.name service,tutorrate
                               FROM tutorservice ts join tutor t on ts.tutorid = t.tutorid join service s on ts.serviceid = s.serviceid
                               WHERE ts.serviceid=$serviceid order by $filter";
                }else{
                   $sql_tp = "SELECT ts.tutorid,ts.serviceid,t.name tutor,s.name service,tutorrate
                              FROM tutorservice ts join tutor t on ts.tutorid = t.tutorid join service s on ts.serviceid = s.serviceid
                              WHERE ts.serviceid=$serviceid";

                }

                $result_tp = mysqli_query($conn,$sql_tp);
                $queryResult = mysqli_num_rows($result_tp);

                generateTutorTable($result_tp, $queryResult)
        ?>
    </main>
    <?php
        include 'includes/footer.inc.php';
    ?>
