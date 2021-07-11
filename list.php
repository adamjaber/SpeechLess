<?php
session_start();
if (!isset($_SESSION["userid"]))
  header("Location: login.php");
include 'db.php';
$use_id = $_SESSION["userid"];

if (isset($_GET["status"]) && isset($_GET["Record_id"]) && $_GET["status"] == "delete") {     // delete video
  $prod_id  =   $_GET['Record_id'];
  $query = "DELETE FROM Records_207 WHERE Record_id=" . $prod_id;
  $result = mysqli_query($connection, $query);
  if (!$result)
    die("querry faild!!");
}
if (isset($_GET["status"]) && $_GET["status"] == "insert") {           // insert new video

  $name   = mysqli_real_escape_string($connection, $_GET['name']);
  $length  = mysqli_real_escape_string($connection, $_GET['length']);
  $link    = mysqli_real_escape_string($connection, $_GET['link']);
  $description    = mysqli_real_escape_string($connection, $_GET['desc']);
  $state  =   $_GET['status'];
  $prod_id  =   $_GET['Record_id'];

  date_default_timezone_set('Australia/Melbourne');
  $datee = date('m/d/Y', time());
  $query = "INSERT INTO Records_207(title,Record_link,Length,Description,use_id) VALUES
 ('$name','$link','$length','$description','$use_id') ";
  $result = mysqli_query($connection, $query);
  if (!$result)
    die("querry faild!!");
}
if (isset($_GET["status"]) && $_GET["status"] == "edit") {     //  edit a video
  $name   = mysqli_real_escape_string($connection, $_GET['name']);
  $length  = mysqli_real_escape_string($connection, $_GET['length']);
  $link    = mysqli_real_escape_string($connection, $_GET['link']);
  $description    = mysqli_real_escape_string($connection, $_GET['desc']);
  $state  =   $_GET['status'];
  $prod_id  =   $_GET['Record_id'];
  $datee=date("Y-m-d H:i:s");
  //$datee = date('m/d/Y', time());
  $query = "UPDATE Records_207  set Title='$name', length ='$length', Record_link='$link' , Description='$description' , last_edited='$datee' where Record_id='$prod_id'";
  $result = mysqli_query($connection, $query);
  if (!$result)
    die("DB query failed.");
}


if ((isset($_GET["sort"]) && $_GET["sort"] == "sort-length") && ($_SESSION["user_Type"] == "Basic")) {  // if basic  and sort show only his own videos

  $query = "SELECT * FROM Records_207 WHERE use_id=" . $_SESSION['userid'] . " order by Length DESC";
  $result = mysqli_query($connection, $query);
  if (!$result)
    die("DB query failed.");
} else if ((isset($_GET["sort"]) && $_GET["sort"] == "sort-length") && ($_SESSION["user_Type"] == "Admin")) {      // if admin and sort

  $query = "SELECT * FROM Records_207 order by Length DESC";
  $result = mysqli_query($connection, $query);
  if (!$result)
    die("DB query failed.");
} else if ((isset($_GET["sort"]) && $_GET["sort"] == "sort-date") && ($_SESSION["user_Type"] == "Admin")) {      // if admin and sort

  $query = "SELECT * FROM Records_207  order by create_date DESC";
  $result = mysqli_query($connection, $query);
  if (!$result)
    die("DB query failed.");
} else if ((isset($_GET["sort"]) && $_GET["sort"] == "sort-date") && ($_SESSION["user_Type"] == "Basic")) {      // if admin and sort

  $query = "SELECT * FROM Records_207 WHERE use_id=" . $_SESSION["userid"] . " order by create_date DESC";
  $result = mysqli_query($connection, $query);
  if (!$result)
    die("DB query failed.");
} else if ($_SESSION["user_Type"] == "Admin") {                                    ///  if admin show all videos
  $query = "SELECT * FROM Records_207 ";
  $result = mysqli_query($connection, $query);
} else if (($_SESSION["user_Type"] == "Basic")) {                                   /// if basic show noly his own videos
  $query = "SELECT * FROM Records_207 WHERE use_id=" . $_SESSION["userid"];
  $result = mysqli_query($connection, $query);
}


?>


<!DOCTYPE html>
<html>

<head>
  <title>List</title>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Stint+Ultra+Condensed&family=Viaoda+Libre&display=swap" rel="stylesheet">


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="includes/css/style.css">

</head>

<body>
  <header>
    <a id="menu" href="#"></a>
    <a href="index.php" id="logo"></a>
    <a href="user.php" id="profile"> <img src="<?php echo $_SESSION["user_img"] ?>" alt="" width="40px" height="42px"></a>
    <h2 class="titlee">no need for words</h2>
  </header>

  <div class="wrapper2">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a href="index.php" id="logo-mobile"></a>
      <a href="user.php" id="profile-mobile"> <img src="<?php echo $_SESSION["user_img"] ?>" alt="" width="40px" height="42px"></a>
      <div class="collapse navbar-collapse justify-content-center " id="navbarNav">
        <ul class="navbar-nav ">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home </a>
          </li>
          <li class="nav-item  active">
            <a class="nav-link" href="list.php">My Videos<span class="sr-only">(current)</span></a>
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

    <main id="main2">
      <div class="uppersection">
        <img src="includes/images/film-icon.png" id="film-icon">
        <h2>Videos</h2>
        <img src="includes/images/search1.png" id="search-icon">

      </div>
      <hr color="black">
      <select id="sort" name="sort">
        <option value="" disabled selected>Sort by :</option>
        <option value="sort-date" id="date">Date</option>
        <option value="sort-length" id="length">Length</option>
      </select>
     
      <?php

      while ($row = mysqli_fetch_assoc($result)) {
        echo "<section>";
        echo ' <a href="object.php?Record_id=' . $row["Record_id"] . '"> <h3>' . $row["Title"] . '</h3> </a> ';
        echo '<p id="date">' . $row["create_date"] . '</p>';
        echo '<p id="time">' . $row["Length"] .' mins</p>';
        echo ' <a href="object.php?Record_id=' . $row["Record_id"] . '">';
        echo '<img src= "includes/images/play1.png" id="play">';
        echo '</a>';
      ?>
      
        <iframe width="350" height="170" src=" <?php echo $row['Record_link']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <?php echo "</section>";
      } ?>
    </main>
    <script src="includes/js/script2.js"> </script>
  </div>
  <footer class="footerr"></footer>
</body>




</html>