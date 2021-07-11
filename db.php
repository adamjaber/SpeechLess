<?php
$dbhost = "182.50.133.173";
$dbuser = "studDB21a";
$dbpass = "stud21DB1!";
$dbname = "studDB21a";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
//testing connection success
if(mysqli_connect_errno()) {
    die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"
     );
     }
     ?>