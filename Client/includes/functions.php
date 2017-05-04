<?php
/*Replace the html markup title*/
function generateHtmlHeader($title) {
    ob_start();
    include 'header.inc.php';
    $buffer = ob_get_contents();
    ob_end_clean();
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
    echo $buffer;
}
/* Generate html for dashboard current programs */
function generateCurrentPrograms($session) {
    include 'dbh.php';
    /*On going Sessions*/
    $sql = "SELECT tr.transactid,tr.custid,tr.programid,tr.tutorid,c.name customer,tu.name tutor,p.name program,tr.status, sessionNum FROM transaction tr join tutorprogram tp on tr.programid = tp.programid and tr.tutorid = tp.tutorid join customer c on tr.custid = c.custid join tutor tu on tr.tutorid = tu.tutorid join program p on p.programid = tr.programid LEFT JOIN session s on s.transactid = tr.transactid WHERE tr.custid='$session' and tr.status='on going'";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            echo '<h3>Current Programs</h3>'; //provide better labels
            while ($row = mysqli_fetch_assoc($result)) {
                $program     = $row['program'];
                $tutor       = $row['tutor'];
                $currSession = $row['sessionNum'];
                echo "<section class='dash-entry'>
                                <h4><a href='programinfo.php?pid=" .$row['programid']. "'>".$program."</a></h4>
                                <p class='dash-session'>You've finished " . $currSession . " sessions</p>
                                <p class='dash-tutor'>Tutor: <a href='tutor.php?id=" . $row['tutorid'] . "'>" . $tutor . "</a></p></section><br>";
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($conn);
}
function generatePendingPrograms($session) {
    include 'dbh.php';
    /*Pending Sessions*/
    $sql = "SELECT tr.transactid,tr.custid,tr.programid,tr.tutorid,c.name customer,tu.name tutor,p.name program,tr.status, sessionNum FROM transaction tr join tutorprogram tp on tr.programid = tp.programid and tr.tutorid = tp.tutorid join customer c on tr.custid = c.custid join tutor tu on tr.tutorid = tu.tutorid join program p on p.programid = tr.programid LEFT JOIN session s on s.transactid = tr.transactid WHERE tr.custid='$session' and tr.status='pending'";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            echo '<h3>You have pending programs</h3>'; //provide better labels
            while ($row = mysqli_fetch_assoc($result)) {
                $program     = $row['program'];
                $tutor       = $row['tutor'];
                $currSession = $row['sessionNum'];
                echo "<section class='dash-entry'>
                                    <h4><a href='programinfo.php?pid=" .$row['programid']. "'>".$program."</a></h4>
                                    <p class='dash-tutor'>Tutor: <a href='tutor.php?id=" . $row['tutorid'] . "'>" . $tutor . "</a></p></section><br>";
            }
        }
        mysqli_free_result($result);
    }
    mysqli_close($conn);
}

function generateUserProgramInfo($row1,$row2){
    echo "<h2>".ucfirst($row1['progname'])."</h2><ul>"
            ."<li>Description: ".$row1['desc']."</li>"
            ."<li>Tutor: " .$row1['tutorname']. "</li>"
            ."<li>Minimum Session: ".$row1['minsession']."</li>"
            ."<li>Number of Sessions done: " .$row2['sessionNum']. "</li>"
            ."<li>Date Started: " .$row2['date_start']. "</li>"
            ."<li>Date Finished: " .$row2['date_fin']. "</li>"
            ."<li>Status: " .$row2['status']. "</li>"
            ."<li>Total payments made: " .$row2['totalpaymentmade']. "</li>"
            ."</ul>";         
}
/*Display profile image from base64 encoding*/
function displayImage() {
    include 'dbh.php';
    $user         = $_SESSION['id'];
    $sql          = "SELECT photo FROM customer where custid='$user'";
    $sql_photo    = "SELECT photo FROM customer where custid='$user' and photo is not null";
    $result       = mysqli_query($conn, $sql);
    $result_photo = mysqli_query($conn, $sql_photo);
    if (mysqli_num_rows($result_photo) == 0) {
        echo 'No Profile Image';
    } else {
        while ($row = mysqli_fetch_array($result)) {
            echo '<img height="300" width="300" src="data:photo;base64, ' . $row['photo'] . ' "> ';
        }
    }
    mysqli_close($conn);
}
/* Generate html for customer profile */
function generateCustomerProfileInfo($row) {
    echo "<section class='profile'>\n
            <ul>
            <li class='profname'>" . $row['name'] . "</li>
            <li class='gender'>" . $row['gender'] . "</li>
            <li class='email'>" . $row['email'] . "</li>
            <li class='cnumber'>" . $row['cnumber'] . "</li>
            <li class='address'>" . $row['address'] . "</li>
            <li class='birthday'>" . $row['birthday'] . "</li>
            </ul>
            </section>\n
            <a href='editprofile.php'>Edit Profile</a>";
}
/* Generate html for tutor profile*/
function generateTutorProfileInfo($row) {
    echo "<h2>" . ucfirst($row['name']) . "</h2><ul>" . "<li>Email: " . $row['email'] . "</li>
              <li>Address: " . $row['address'] . "</li>" . "<li>Gender: " . $row['gender'] . "</li>
              <li>Birthday: " . $row['birthday'] . "</li>
              </ul>";
}
/* Generate html for application of program */
function generateApplicationForm($progid, $row) {
    include 'dbh.php';
    $program    = $row['name'];
    $desc       = $row['desc'];
    $minsession = $row['minsession'];
    echo "\n" . '                    <div class="apply-program">
                <h4><a href="program.php?id=' . $row['programid'] . '">' . $program . '</a></h4>
                <p>' . $desc . '</p>
                <p>Minimum Sessions: ' . $minsession . '</p>' . "\n" . "                    </div><br>" . "\n";
    $sql_tp      = "Select tp.tutorid,tp.programid,t.name tutor,p.name program,tutorrate\n" . "FROM tutorprogram tp join tutor t on tp.tutorid = t.tutorid join program p on tp.programid = p.programid\n" . "WHERE tp.programid ='$progid'";
    $result_tp   = mysqli_query($conn, $sql_tp);
    $queryResult = mysqli_num_rows($result_tp);
    if ($queryResult > 0) {
        echo "<form action='includes/apply.inc.php' method='get'>
            <input type='hidden' value='" . $progid . "' name='progid'>"; //hidden input for program id
        while ($row = mysqli_fetch_assoc($result_tp)) {
            echo "<input type='radio' name='select_tutor' value='" . $row['tutorid'] . "'>" . $row['tutor'] . "<span class='select-tutor-rate'>" . $row['tutorrate'] . " PHP</span><br>";
        }
        // echo "<input type='' name='' placeholder='Number of Sessions'>";
        echo " <input type='submit' value='Apply'>
            </form>";
    } else {
        echo "Applications are currently not available for this program.";
    }
    mysqli_close($conn);
}
/* Generate tutor table for programs (tutorprogram) */
function generateTutorTable($result_tp, $queryResult) {
    if ($queryResult > 0) {
        echo "<table>
            <tr>
            <th>Tutor</th>
            <th>Rate</th>
            </tr>";
        while ($row = mysqli_fetch_assoc($result_tp)) {
            echo "<tr>
                <td><a href='tutor.php?id=" . $row['tutorid'] . "'>" . $row['tutor'] . "</a></td>
                <td>" . $row['tutorrate'] . " PHP</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "There are no tutors for this program.";
    }
}
/* Generate html for browsing of programs */
function generateBrowseProgEntry($sql) {
    include 'dbh.php';
    $result = mysqli_query($conn, $sql);
    if ($result = mysqli_query($conn, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $program    = $row['name'];
            $desc       = $row['desc'];
            $minsession = $row['minsession'];
            echo "\n" . '                    <div class="browse-prog-entry">
                                <h4><a href="program.php?id=' . $row['programid'] . '">' . $program . '</a></h4>
                                <p>' . $desc . '</p>
                                <p>Minimum Sessions: ' . $minsession . '</p>' . "\n" . "                    </div><br>" . "\n";
        }
        mysqli_free_result($result);
    }
    mysqli_close($conn);
}
/* Generate html for browsing of tutors */
function generateBrowseTutorEntry($sql) {
    include 'dbh.php';
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
}
/*Search Program Functionality*/
function searchProgram() {
    include 'dbh.php';
    if (isset($_GET['search'])) {
        $search      = mysqli_real_escape_string($conn, $_GET['keyword']);
        $sql         = "SELECT * FROM program WHERE name LIKE '%$search%' OR program.desc LIKE '%$search%' order by name";
        $result      = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);
        if ($queryResult > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $program    = $row['name'];
                $desc       = $row['desc'];
                $minsession = $row['minsession'];
                echo "\n" . '                    <div class="browse-prog-entry">
                                <h4><a href="program.php?id=' . $row['programid'] . '">' . $program . '</a></h4>
                                <p>' . $desc . '</p>
                                <p>Minimum Sessions: ' . $minsession . '</p>' . "\n" . "                    </div><br>" . "\n";
            }
        } else {
            echo "<p class='no-search-result'>No Search Results</p>";
        }
    }
    mysqli_close($conn);
}
/*Search Tutor Functionality*/
function searchTutor() {
    include 'dbh.php';
    if (isset($_GET['search'])) {
        $search      = mysqli_real_escape_string($conn, $_GET['keyword']);
        $sql         = "SELECT * FROM tutor WHERE name LIKE '%$search%' order by name";
        $result      = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);
        if ($queryResult > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $tutor = $row['name'];
                echo "\n" . '                    <div class="browse-prog-entry">
                                <h4><a href="tutor.php?id=' . $row['tutorid'] . '">' . $tutor . '</a></h4>
                                Insert Rating here. Other info</div><br>';
            }
        } else {
            echo "<p class='no-search-result'>No Search Results</p>";
        }
    }
    mysqli_close($conn);
}
/*Search Tutor and Program Functionality*/
function searchProgTutor() {
    include 'dbh.php';
    if (isset($_GET['search'])) {
        $search            = mysqli_real_escape_string($conn, $_GET['keyword']);
        $sql_program       = "SELECT * FROM program WHERE name LIKE '%$search%' OR program.desc LIKE '%$search%'";
        $result_prog       = mysqli_query($conn, $sql_program);
        $queryResult_prog  = mysqli_num_rows($result_prog);
        $sql_tutor         = "SELECT * FROM tutor WHERE name LIKE '%$search%'";
        $result_tutor      = mysqli_query($conn, $sql_tutor);
        $queryResult_tutor = mysqli_num_rows($result_tutor);
        if ($queryResult_tutor || $queryResult_prog > 0) {
            /*Search results for program*/
            if ($queryResult_prog > 0) {
                echo "<h3>Programs</h3>";
                while ($row = mysqli_fetch_assoc($result_prog)) {
                    $program    = $row['name'];
                    $desc       = $row['desc'];
                    $minsession = $row['minsession'];
                    echo "\n" . '                    <div class="browse-prog-entry">
                                    <h4><a href="program.php?id=' . $row['programid'] . '">' . $program . '</a></h4>
                                    <p>' . $desc . '</p>
                                    <p>Minimum Sessions: ' . $minsession . '</p>' . "\n" . "                    </div><br>" . "\n";
                }
            }
            /*Search results for tutor*/
            if ($queryResult_tutor > 0) {
                echo "<h3>Tutors</h3>";
                while ($row = mysqli_fetch_assoc($result_tutor)) {
                    $tutor = $row['name'];
                    echo "\n" . '                    <div class="browse-prog-entry">
                                    <h4><a href="tutor.php?id=' . $row['tutorid'] . '">' . $tutor . '</a></h4>
                                    Insert Rating here</div><br>';
                }
            }
        } else {
            echo "No Search Results";
        }
    }
    mysqli_close($conn);
}
