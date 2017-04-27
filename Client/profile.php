<?php
    ob_start();
    include 'includes/header.inc.php';
    $buffer=ob_get_contents();
    ob_end_clean();

    $title = "Virtuoso | Profile"; //page title
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

    echo $buffer;
?>
   
    <main>
        <?php
            include 'dbh.php';
            $user = $_SESSION['id'];
            $sql = "SELECT * FROM customer where custid='$user'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        
            displayImage();
        
            echo "<section class='profile'>\n
            <p class='profname'>".$row['name']."</p>
            <p class='email'>".$row['email']."</p>
            <p class='cnumber'>".$row['cnumber']."</p>
            <p class='address'>".$row['address']."</p>
            <p class='birthday'>".$row['birthday']."</p>
            </section>\n
            <a href='editprofile.php'>Edit Profile</a>";
        
            /*Display profile image from base64 encoding*/
            function displayImage(){
                include 'dbh.php';
                $user = $_SESSION['id'];
                $sql = "SELECT photo FROM customer where custid='$user'";
                $sql_photo = "SELECT photo FROM customer where custid='$user' and photo is not null";
                $result = mysqli_query($conn, $sql);
                $result_photo = mysqli_query($conn, $sql_photo);
                
                if(mysqli_num_rows($result_photo)==0){
                    echo 'No Profile Image';
                }else{
                    while($row = mysqli_fetch_array($result)){
                        echo '<img height="300" width="300" src="data:photo;base64, '.$row['photo'].' "> ';
                    }
                }
            }
            mysqli_close($conn);
        ?>
    </main>
    <?php
        include 'includes/footer.inc.php';
    ?>
