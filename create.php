<?php
session_start();
if (!isset($_SESSION["userid"]))
  header("Location: login.php");
include 'db.php';

$_SESSION["userid"];

$state = "insert";
if (isset($_GET["Record_id"])) {
  $Record_id = $_GET["Record_id"];
  $query = "SELECT * FROM Records_207 WHERE Record_id=" . $Record_id;
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($result);
  $state = "edit";
}

if ($_SESSION["user_Type"] == "Admin") {                            // if admin show all meetings
  $sql = "SELECT * FROM Meetings_207";
  $result1 = mysqli_query($connection, $sql);
} else {

  $sql = "SELECT * FROM Meetings_207 WHERE use_id=" . $_SESSION["userid"];
  $result1 = mysqli_query($connection, $sql);
  if (!$result1)
    die("Cannot find the user.");
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="includes/css/style.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  <title>create</title>
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
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav ">
          <li class="nav-item ">
            <a class="nav-link" href="index.php">Home </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="list.php">My Videos</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="create.php">Transalte <span class="sr-only">(current)</span></a>
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

    <?php

    echo "<aside id='aside2'>";
    echo "<h2>Upcoming Meetings</h2>";
    echo "<ul>";
    while ($row1 = mysqli_fetch_assoc($result1)) {
      echo       "<li>" . $row1['Title'];
      echo                "<p>" . $row1['Date'] . "</p>";
      echo            '<button class="delete-meeting" value=' . $row1['Meet_id'] . ' ></button>';
      echo                    "</li>";
    }
    echo "</ul>";
    echo '<button type="button" class="btn btn-secondary" id="add-meeting">Add Meeting</button>';
    echo '</aside>';
    ?>



    <main id="main3">

      <div id="form123">
        <form action="list.php">

          <label for="fname">Title</label>
          <input type="text" id="name" required="required" name="name" placeholder="video title" value="<?php if (isset($row)) echo $row["Title"]; ?>">

          <label for="length">length</label>
          <input type="text" id="fname" name="length" required="required" placeholder="length" value="<?php if (isset($row)) echo $row["Length"]; ?>">
          <label for="length">Link</label>
          <input type="text" id="fname" name="link" required="required" placeholder="youtube link" value="<?php if (isset($row)) echo $row["Record_link"]; ?>">

          <label for="country">language</label>
          <select id="country" name="country">
            <option value="australia">English</option>
            <option value="canada">Spanish</option>
            <option value="usa">French</option>
            <option value="usa">Russion</option>
            <option value="usa">Chinese</option>
          </select>
          <label for="fname">Description</label>
          <textarea name="desc"><?php if (isset($row)) echo $row["Description"]; ?> </textarea>

          <input type="hidden" name="status" value="<?php echo $state; ?>">
          <input type="hidden" name="Record_id" value="<?php echo $Record_id; ?>">
          <input type="submit" value="Save">
        </form>
      </div>


    </main>
  </div>
  <footer class="footerr"></footer>
</body>

</html>