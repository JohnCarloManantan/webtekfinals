<?php
    require_once 'includes/functions.php';
    include 'dbh.php';
    /**
    $programID = $_GET['bid'];
    $sql1 = "select p.programid,p.name as progname,p.desc,p.minsession, t.name as tutorname from program p join tutorprogram tp on p.programid=tp.programid join tutor t on tp.tutorid=t.tutorid where p.programid='$programID'";
    $sql2 = "select sessionNum, concat(monthname(time_start),' ',day(time_start),',',year(time_start)) as date_start, concat(monthname(time_start),' ',day(time_start),',',year(time_start)) as date_fin,t.status, concat(monthname(t.timestamp),' ',day(t.timestamp),',',year(t.timestamp)) as paydate, (sessionNum * tp.tutorrate) as totalpaymentmade from session s join transaction t on s.transactid=t.transactid join customer c on t.custid=c.custid join tutorprogram tp on t.tutorid=tp.tutorid where t.programid='$programID'";
    $result1 = mysqli_query($conn,$sql1);
    $result2 = mysqli_query($conn,$sql2);
    $row1 = mysqli_fetch_assoc($result1);
    $row2 = mysqli_fetch_assoc($result2);
    
    $title = "Virtuoso | ".ucfirst($row1['progname']);
    generateHtmlHeader($title);
    **/
?>
    <main>
        Fix table names.        
    </main>
    
<?php
    include 'includes/footer.inc.php';
?>
