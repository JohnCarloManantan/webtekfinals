<?php

/*Replace the html markup title*/
function generateHtmlHeader($title) {
    ob_start();
    require 'header.inc.php';
    $buffer = ob_get_contents();
    ob_end_clean();
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
    echo $buffer;
}

/* Generate html for dashboard current programs */
function generateCurrentBookings($session) {
    include 'dbh.php';
    
    /*Current Bookings*/
    $sql = "SELECT b.bookid,b.custid,b.serviceid,b.tutorid,c.name customer,tu.name tutor,s.name service,b.status
    FROM booking b join tutorservice ts on b.serviceid = ts.serviceid and b.tutorid = ts.tutorid join customer c on b.custid = c.custid join tutor tu on b.tutorid = tu.tutorid join service s on s.serviceid = b.serviceid
    WHERE b.custid=$session and b.status='accepted'";
    
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['usercurrentbooking'] = true;
            echo "<h3>Current Bookings</h3>"; //provide better labels
            while ($row = mysqli_fetch_assoc($result)) {
                $progid      = $row['serviceid'];
                $program     = $row['service'];
                $tutorid     = $row['tutorid'];
                $tutor       = $row['tutor'];
echo  <<<FRAG
    <section>
        <h3><a href="bookinfo.php?bid=$progid">$program</a></h3>
        <p>Tutor: <a href="tutor.php?id=$tutorid">$tutor</a>
        <p>This booking is scheduled on ___ </p>
    </section>
FRAG;
            }
        }else{
            $_SESSION['usercurrentbooking'] = false;
        }
    }
    mysqli_close($conn);
}

/* Generate html for dashboard current programs */
function generatePendingBookings($session) {
    include 'dbh.php';
    
    /*Pending Bookings*/
    $sql = "SELECT b.bookid,b.custid,b.serviceid,b.tutorid,c.name customer,tu.name tutor,s.name service,b.status
    FROM booking b join tutorservice ts on b.serviceid = ts.serviceid and b.tutorid = ts.tutorid join customer c on b.custid = c.custid join tutor tu on b.tutorid = tu.tutorid join service s on s.serviceid = b.serviceid
    WHERE b.custid=$session and b.status='pending'";
    
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['userpendingbooking'] = true;
            echo "<h3>Pending Bookings</h3>"; //provide better labels
            while ($row = mysqli_fetch_assoc($result)) {
                $progid      = $row['serviceid'];
                $program     = $row['service'];
                $tutorid     = $row['tutorid'];
                $tutor       = $row['tutor'];
echo  <<<FRAG
    <section>
        <h3><a href="bookinfo.php?bid=$progid">$program</a></h3>
        <p>Tutor: <a href="tutor.php?id=$tutorid">$tutor</a>
    </section>
FRAG;
            }
        }else{
            $_SESSION['userpendingbooking'] = false;
        }
    }
    mysqli_close($conn);
}

/* Generate html for browsing of programs */
function generateBrowseServiceEntry($sql) {
    
    include 'dbh.php';
    $result = mysqli_query($conn, $sql);
    if ($result = mysqli_query($conn, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $serviceid  = $row['serviceid'];
            $service    = $row['name'];
            $desc       = $row['desc'];
echo <<<FRAG
    <section> 
        <h4><a href="service.php?id=$serviceid">$service</a></h4>
        <p>$desc</p>
    </section>

FRAG;

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
/* Generate tutor table for programs (tutorprogram) */
function generateTutorTable($result_tp, $queryResult) {
    
    if ($queryResult > 0) {
echo <<<FRAG
<table>
    <tr>
        <th>Tutor</th>
        <th>Rate</th>
    </tr>
FRAG;
        while ($row = mysqli_fetch_assoc($result_tp)) {
            echo "<tr>
                <td><a href='tutor.php?id=" . $row['tutorid'] . "'>" . $row['tutor'] . "</a></td>
                <td>" . $row['tutorrate'] . " PHP</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "There are currently no tutors for this service.";
    }
}

/* Generate html for tutor profile*/
function generateTutorProfileInfo($row) {
    $tutorname = ucfirst($row['name']);
    $email = $row['email'];
    $address = $row['address'];
    $gender = $row['gender'];
    $bday = $row['birthday'];
    
echo <<<FRAG
<h2>$tutorname</h2>
<ul>
  <li>$email</li>
  <li>$address</li>
  <li>$gender</li>
  <li>$bday</li>
</ul>
FRAG;
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

/*Search Service Functionality*/
function searchService() {
    include 'dbh.php';
    if (isset($_GET['search'])) {
        $search      = mysqli_real_escape_string($conn, $_GET['keyword']);
        $sql         = "SELECT * FROM service WHERE name LIKE '%$search%' OR service.desc LIKE '%$search%' order by name,service.desc";
        $result      = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);
        if ($queryResult > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $serviceid  = $row['serviceid'];
                $service    = $row['name'];
                $desc       = $row['desc'];
echo <<<FRAG
    <section>
        <h4><a href="service.php?id=$serviceid">$service</a></h4>
        <p>$desc</p>
    </section>
FRAG;
            }
        } else {
            echo "<p>No Search Results</p>";
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
                $tutorid = $row['tutorid'];
echo <<<FRAG
<div>
    <h4><a href="tutor.php?id=$tutorid">$tutor</a></h4>
</div>
FRAG;
            }
        } else {
            echo "<p>No Search Results</p>";
        }
    }
    mysqli_close($conn);
}

/*Search Tutor and Service Functionality*/
function searchServiceTutor() {
    include 'dbh.php';
    if (isset($_GET['search'])) {
        $search            = mysqli_real_escape_string($conn, $_GET['keyword']);
        $sql_program       = "SELECT * FROM service WHERE name LIKE '%$search%' OR service.desc LIKE '%$search%'";
        $result_prog       = mysqli_query($conn, $sql_program);
        $queryResult_prog  = mysqli_num_rows($result_prog);
        $sql_tutor         = "SELECT * FROM tutor WHERE name LIKE '%$search%'";
        $result_tutor      = mysqli_query($conn, $sql_tutor);
        $queryResult_tutor = mysqli_num_rows($result_tutor);
        if ($queryResult_tutor || $queryResult_prog > 0) {
            if ($queryResult_prog > 0) { //program search results
                echo "<h3>Services</h3>";
                while ($row = mysqli_fetch_assoc($result_prog)) {
                    $serviceid    = $row['serviceid'];
                    $service    = $row['name'];
                    $desc       = $row['desc'];
                  
echo <<<FRAG
    <section>
        <h4><a href="service.php?id=$serviceid">$service</a></h4>
        <p>$desc</p>
    </section>
FRAG;
                }
            }
            
          
            if ($queryResult_tutor > 0) { //tutor search results
                echo "<h3>Tutors</h3>";
                while ($row = mysqli_fetch_assoc($result_tutor)) {
                    $tutor = $row['name'];
                    $tutorid = $row['tutorid'];
                    
echo <<<FRAG
<div>
    <h4><a href="tutor.php?id=$tutorid">$tutor</a></h4>
    <p>Insert Information Here.</p>
</div>
FRAG;
                }
            }
        } else {
            echo "No Search Results";
        }
    }
    mysqli_close($conn);
}

/* Generate html for booking of service */
function generateBookingForm($serviceid, $row) {
    include 'dbh.php';
    $serviceid = $row['serviceid'];
    $service    = $row['name'];
    $desc       = $row['desc'];
    
echo <<<FRAG
<div>
    <h4><a href="service.php?id=$serviceid">$service</a></h4>
    <p>$desc</p>
</div>
FRAG;
    
    $sql_tp      = "Select ts.tutorid,ts.serviceid,t.name tutor,s.name service,tutorrate
FROM tutorservice ts join tutor t on ts.tutorid = t.tutorid join service s on ts.serviceid = s.serviceid
WHERE ts.serviceid = $serviceid";
    $result_tp   = mysqli_query($conn, $sql_tp);
    $queryResult = mysqli_num_rows($result_tp);
    
    if ($queryResult > 0) {
        
echo <<<FRAG
<form action="includes/book.inc.php" method="get">
    <input type="hidden" value="$serviceid" name="serviceid">
    <input type="datetime-local" name="sched" required><br>
    <textarea placeholder="What do you want to learn?" name="message"></textarea><br><br>
FRAG;
       
        while ($row = mysqli_fetch_assoc($result_tp)) {
            $tutorid = $row['tutorid'];
            $tutor = $row['tutor'];
            $tutorrate = $row['tutorrate'];
echo <<<FRAG
    <input type="radio" name="select_tutor" value="$tutorid"><span>$tutor</span><span>$tutorrate</span><br>
FRAG;
        }
        
echo <<<FRAG
    <input type="submit" value="Book">
</form>
FRAG;
        
    } else {
        echo "Bookings are currently not available for this service.";
    }
    mysqli_close($conn);
}
