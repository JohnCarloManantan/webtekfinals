<?php
    $conn = mysqli_connect("localhost","root","","virtuoso"); //WAMP Server
    //$conn = mysqli_connect("localhost","root","root","virtuoso"); //MAMP Server
    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
}