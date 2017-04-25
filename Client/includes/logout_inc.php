<?php
session_start();
session_destroy();
mysql_close($conn);
header("Location: ../index.php");