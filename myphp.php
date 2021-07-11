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
     
    $username = mysqli_real_escape_string($connection, $_GET['username']);
    $password = mysqli_real_escape_string($connection, $_GET['pass']);
    $sql = "SELECT user_id , user_fullname , user_password FROM users_207" ; 
    $query = "SELECT * FROM users_207" ; // where user_fullname =Alex Rose"; //and user_password = $password" ;
    $result = mysqli_query($connection ,$query); 

    if(!$result) {
        die("Cannot find the user.") ; 
    }
    else {
        echo "<h1> Username is " .$username. "</h1>" ;
        echo "<h1> Passward is " .$password.  "</h1>" ;
    }
?>
     

<!DOCTYPE html>
<html>

<head></head>
<body>

<!-- <?php
echo "<h1> username is " .$username. "</h1>" ;
echo "<h1> username is " .$password.  "</h1>" ;
echo "<h1>  " .$query.  "</h1>" ;
?> -->

</body>
</html>
