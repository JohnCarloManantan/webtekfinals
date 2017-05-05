<?php
    session_start();
    session_unset();
    mysqli_close($conn);
    session_destroy();
    
    header("Location: ../index.php");