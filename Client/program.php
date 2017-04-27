<?php
    ob_start();
    include 'includes/header.inc.php';
    $buffer=ob_get_contents();
    ob_end_clean();

    $progID = $_GET['id'];
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
            <p>Minimum Session: ".$row['minsession']."</p>\n";
            
            $sql_tp = "Select tp.tutorid,tp.programid,t.name tutor,p.name program,tutorrate\n"
            . "FROM tutorprogram tp join tutor t on tp.tutorid = t.tutorid join program p on tp.programid = p.programid\n"
            . "WHERE tp.programid ='$progID'";
            $result_tp = mysqli_query($conn,$sql_tp);
            $queryResult = mysqli_num_rows($result_tp);
        
            echo "        <h3>Tutors</h3>\n";
            if($queryResult>0){
                echo "<table>
                <tr>
                <th>Tutor</th>
                <th>Rate</th>
                </tr>";
                while($row = mysqli_fetch_assoc($result_tp)){
                    echo "<tr>
                    <td>".$row['tutor']."</td>
                    <td>".$row['tutorrate']." PHP</td>
                    </tr>";
                }
                echo "</table>";
            }else{
                echo "There are no tutors for this program.";
            }
        ?>        
    </main>
<?php
    include 'includes/footer.inc.php';
?>
