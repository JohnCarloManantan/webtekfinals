<?php
    ob_start();
    include 'includes/header.inc.php';
    $buffer=ob_get_contents();
    ob_end_clean();

    $title = "Virtuoso | Home";
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

    echo $buffer;
?>
    <main>
        <h2>Dashboard</h2>
        <section class="dashboard">
            
            <section class="dash-ongoing">
                <?php
                $session = $_SESSION['id'];
                
                /*Ongoing Sessions*/
                $sql = "SELECT tr.transactid,tr.custid,tr.programid,tr.tutorid,c.name customer,tu.name tutor,p.name program,tr.status, sessionNum FROM transaction tr join tutorprogram tp on tr.programid = tp.programid and tr.tutorid = tp.tutorid join customer c on tr.custid = c.custid join tutor tu on tr.tutorid = tu.tutorid join program p on p.programid = tr.programid join session s on s.transactid = tr.transactid WHERE tr.custid='$session' and tr.status='on going'";
            
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
            ?>
            </section>
            <section class="dash-pending">
                <?php

                    /*Pending Sessions*/
                    $sql = "SELECT tr.transactid,tr.custid,tr.programid,tr.tutorid,c.name customer,tu.name tutor,p.name program,tr.status, sessionNum FROM transaction tr join tutorprogram tp on tr.programid = tp.programid and tr.tutorid = tp.tutorid join customer c on tr.custid = c.custid join tutor tu on tr.tutorid = tu.tutorid join program p on p.programid = tr.programid LEFT JOIN session s on s.transactid = tr.transactid WHERE tr.custid='$session' and tr.status='pending'";

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
