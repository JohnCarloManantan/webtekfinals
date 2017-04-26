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
    <title>Virtuoso | Home</title>
    <style>
        h4 {
            text-transform: uppercase;
            margin: 0;
        }
        
        p {
            margin: 0;
        }

    </style>

</head>

<?php
    include 'includes/header.inc.php';
?>
    <main>
        <h2>Dashboard</h2>
        <section class="dashboard">
            
            <section class="dash-ongoing">
                <?php
                include 'dbh.php';
                $session = $_SESSION['id'];
                
                /*Ongoing Sessions*/
                $sql = "SELECT transactid,tr.custid,tr.programid,tr.tutorid,c.name customer,tu.name tutor,p.name program,tr.status,tr.sessionNum FROM transaction tr join tutorprogram tp on tr.programid = tp.programid and tr.tutorid = tp.tutorid join customer c on tr.custid = c.custid join tutor tu on tr.tutorid = tu.tutorid join program p on p.programid = tr.programid where tr.custid='$session' and tr.status='on going'";
            
                if ($result = mysqli_query($conn, $sql)) {
                    if(mysqli_num_rows($result)>0){
                        echo '<h3>Current Programs</h3>'; //provide better labels
                            while ($row = mysqli_fetch_assoc($result)) {
                                $program = $row['program'];
                                $tutor= $row['tutor'];
                                $currSession= $row['sessionNum'];
                                echo '<section class="dash-entry">
                                <h4>'.$program.'</h4>
                                <p class="dash-tutor">Tutor: '.$tutor.'</p>
                                <p class="dash-session">You\'ve finished '.$currSession.' sessions </p></section><br>';
                        }
                    }else{
                        echo '<h3>You are currently not on any programs.</h3>'; //provide better labels
                    }        
                    mysqli_free_result($result);
                }
                mysqli_close($conn);
            ?>
            </section>
            <section class="dash-pending">
                <?php
                include 'dbh.php';
                $session = $_SESSION['id'];
                
                /*Pending Sessions*/
                $sql = "SELECT transactid,tr.custid,tr.programid,tr.tutorid,c.name customer,tu.name tutor,p.name program,tr.status,tr.sessionNum FROM transaction tr join tutorprogram tp on tr.programid = tp.programid and tr.tutorid = tp.tutorid join customer c on tr.custid = c.custid join tutor tu on tr.tutorid = tu.tutorid join program p on p.programid = tr.programid where tr.custid='$session' and tr.status='pending'";
                
                if ($result = mysqli_query($conn, $sql)) {
                    if(mysqli_num_rows($result)>0){
                        echo '<h3>You have pending programs</h3>';//provide better labels
                            while ($row = mysqli_fetch_assoc($result)) {
                                $program = $row['program'];
                                $tutor= $row['tutor'];
                                $currSession= $row['sessionNum'];
                                echo '<section class="dash-entry">
                                <h4>'.$program.'</h4>
                                <p class="dash-tutor">Tutor: '.$tutor.'</p></section><br>';
                            }
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
