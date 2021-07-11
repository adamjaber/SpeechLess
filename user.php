<?php

session_start();

if (!isset($_SESSION["userid"]))
  header("Location: login.php");
include 'db.php';
$use_id = $_SESSION["userid"];

if (isset($_GET["state"]) && $_GET["state"] == "delete") {
  $query = "DELETE FROM users_207 WHERE id='$use_id'";
  $result = mysqli_query($connection, $query);
  if (!$result)
    die("DB query failed..");
  header("Location: login.php");
}


if (isset($_GET["change"])) {                // if update account name or email

  $name   = mysqli_real_escape_string($connection, $_GET['username_up']);

  $email = mysqli_real_escape_string($connection, $_GET['email_up']);
  $pic = mysqli_real_escape_string($connection, $_GET['profile_pic']);
  $query = "UPDATE users_207  set user_fullname='$name', user_email='$email' ,user_img='$pic' where id='$use_id'";
  $result = mysqli_query($connection, $query);
  if (!$result)
    die("DB query failed..");
}


$query = "SELECT * FROM users_207 WHERE id=" . $_SESSION["userid"];
$result = mysqli_query($connection, $query);
if (!$result)
  die("Cannot find the user.");

// $sql = "SELECT * FROM Meetings_207 WHERE use_id=" . $_SESSION["userid"];
// $result1 = mysqli_query($connection, $sql);
// if (!$result1)
//   die("Cannot find the user.");


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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="includes/css/style.css">

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
    <?php
    // echo "<aside id='aside2'>";
    // echo "<h2>Upcoming Meetings</h2>";
    // echo "<ul>";
    // while ($row1 = mysqli_fetch_assoc($result1)) {
    //   echo       "<li>" . $row1['Title'] . "</li>";
    //   echo                "<p>" . $row1['Date'] . "</p>";
    //   echo                    "<br>";
    // }
    // echo "</ul>";
    // echo '</aside>';

    echo "<aside id='aside2'>";
    echo "<h2>Upcoming Meetings</h2>";
    echo "<ul>";
    while ($row1 = mysqli_fetch_assoc($result1)) {
        echo       "<li>" . $row1['Title']; 
        echo                "<p>" . $row1['Date'] . "</p>";
        echo            '<button class="delete-meeting" value='.$row1['Meet_id'].' ></button>';
        echo                    "</li>";
    }
    echo "</ul>";
    echo '<button type="button" class="btn btn-secondary" id="add-meeting">Add Meeting</button>';
    echo '</aside>';
    ?>
    <main id="main3">

      <?php
      $row = mysqli_fetch_assoc($result);
      if (isset($_GET["state"]) && $_GET["state"] == "update") {
        echo '<div id="form123">';
        echo ' <form action="user.php?state=change">';
        echo 'User Name: <input type="text" name="username_up" class="username_update"  value="' . $row["user_fullname"] . '"><br>';
        echo 'Email:     <input type="text" name="email_up" class="username_update"  value="' . $row["user_email"] . '">';
        echo 'Picture:   <input type="text" name="profile_pic" class="username_update"  value="' . $row["user_img"] . '">';
        echo '<input type="hidden" name="change" value="<?php echo $state; ?>">';
        // echo '<a class="btn btn-primary" href="user.php?state=insert" role="button">Save</a>';
        echo '<input type="submit" value="Save">';
        echo '</form>';
        echo '</div>';
      } else {

        echo '<div class="user_profile">';
        echo '<img src="' . $_SESSION["user_img"] . '"alt="profile_img" id="profile_img" >';
        echo '<h3>User ID : ' . $row["id"] . '</h3>';
        echo '<h3>Full Name : ' . $row["user_fullname"] . '</h3>';
        echo '<h3>Email : ' . $row["user_email"] . '</h3>';
        echo '<h3>User Type : ' . $row["user_Type"] . '</h3>';
        echo '</div>';
        echo '<div class="user-buttons">';
        echo '<a class="btn btn-primary" href="login.php?state=logout" role="button">Log Out  </a>';
        echo '<a class="btn btn-primary" href="user.php?state=update" role="button">Change Name</a>';
        echo '<a class="btn btn-primary" href="user.php?state=delete" role="button">Delete account</a>';
        echo '</div>';
      }
      ?>





    </main>
  </div>
  <footer class="footerr"></footer>
  <?php
  mysqli_close($connection);
  ?>
</body>

</html>