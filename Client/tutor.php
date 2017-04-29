<?php
    ob_start();
    include 'includes/header.inc.php';
    $buffer=ob_get_contents();
    ob_end_clean();

    $tutorID = $_GET['id'];
    $sql = "Select * FROM tutor where tutorid='$tutorID'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    $title = "Virtuoso | ".ucfirst($row['name']);
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

    echo $buffer;
?>
    <main>
        <?php
            echo "<h2>".ucfirst($row['name'])."</h2><ul>"
            ."<li>Email: ".$row['email']."</li>
              <li>Address: ".$row['address']."</li>"
            ."<li>Gender: ".$row['gender']."</li>
              <li>Birthday: ".$row['birthday']."</li>
              </ul>";
          	
        ?>        
    </main>
<?php
    include 'includes/footer.inc.php';
?>
