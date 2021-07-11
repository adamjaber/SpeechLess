<?php
include 'db.php';
session_start();
$use_id=$_SESSION["userid"];



$name 	= mysqli_real_escape_string($connection, $_GET['name']);

$length  = mysqli_real_escape_string($connection, $_GET['length']);
$link  	= mysqli_real_escape_string($connection, $_GET['link']);
$description  	= mysqli_real_escape_string($connection, $_GET['desc']);
$state  =   $_GET['status'];
$prod_id  =   $_GET['Record_id'];

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="includes/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>


<title>create</title>
</head>

<body>
    <header>
        <a id="menu" href="#"></a>
        <a href="index.html" id="logo"></a>
        <a href="#" id="profile"></a>
        <h2 class ="titlee">no need for words</h2>
    </header>


    <div class="wrapper2">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a href="index.html" id="logo-mobile"></a>
  <a href="#" id="profile-mobile"></a>
  <div class="collapse navbar-collapse justify-content-center " id="navbarNav">
    <ul class="navbar-nav ">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="list.php">My Videos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="create.php">Transalte</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Add Sign</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Friend list</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">User guide</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Settings</a>
      </li>
    </ul>
  </div>
</nav>


        <aside id="aside2">
            <h2>Upcoming Meetings</h2>
            <ul>
                <li>Second presentation</li>
                <p>20/03/2021</p>
                <br>

                <li>Directors meeting</li>
                <p>23/04/2021</p>
                <br>

                <li>Private lesson</li>
                <p>27/04/2021</p>
                <br>

                <li>Speech about physics</li>
                <p>03/05/2021</p>
                <br>

                <li>Third presentation</li>
                <p>09/05/2021</p>
                <br>

                <li>Final presentation</li>
                <p>11/05/2021</p>
                <br>

                <li>The big test</li>
                <p>20/05/2021</p>
                <br>

            </ul>
        </aside>
        <main id="main3">
   
        <?php
        if ($state == "insert"){
         date_default_timezone_set('Australia/Melbourne');
         $datee = date('m/d/Y', time());
         $query = "INSERT INTO Records_207(title,Record_link,Length,Description,create_date,use_id) VALUES ('$name','$link','$length','$description','$datee','$use_id') " ;
        $result=mysqli_query($connection, $query);
        if(!$result)
            die("querry faild!!");
        else
            echo "<h1 class='saved'>Your video has been saved</h1>";
        }
        else{
            $datee = date('m/d/Y', time());
            $query = "UPDATE Records_207  set Title='$name', length ='$length', Record_link='$link' , Description='$description' , last_edited='$datee' where Record_id='$prod_id'";
            $result = mysqli_query($connection, $query);
            if(!$result) 
                die("DB query failed.");
            else
                echo "<h1 class='saved' >Your video has been updated</h1>";
        }


?>

        </main>
    </div>
    <footer class="footerr"></footer>
    <?php
    mysqli_close($connection) ; 
?>
</body>

</html>