


<!-------------- floww  ---------------------------
user ToniVer@gmail.com  pass: 123456789   is admin user can see other user's video's and meetings
user TheRose@gmail.com  pass: 123456789   is basic user can see only his videos and meetings
log in as basic user and add video from basic user and change name of other video
log in admin user and see the new video and delete it
basic user can make changes ion the video and admin can see it and delete it from his account

CRUD on video's 
CRUD on user's


we used json the lower section in index page 

and used ajax to delete meetings on the minus icon next to every meeting
-->





<?php

session_start();
if (!isset($_SESSION["userid"]))
    header("Location: login.php");

include 'db.php';
$_SESSION["userid"];




$query = "SELECT * FROM users_207 WHERE id =" . $_SESSION["userid"];
$result = mysqli_query($connection, $query);
if (!$result)
    die("Cannot find the user.");

$row = mysqli_fetch_assoc($result);

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

    <title>home</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Stint+Ultra+Condensed&family=Viaoda+Libre&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
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
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list.php">My Videos </a>
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
            <?php
            echo "<h3>Welcome " . $row["user_fullname"] . "</h3>";
            ?>
            <h3>A daily sign for you to learn :</h3>
            <div class="carousel">
                <div class="carousel__item carousel__item--visible">
                    <a href="#">
                        <img src="includes/images/ice-cream.png" /></a>

                </div>
                <div class="carousel__item">
                    <a href="#">
                        <img src="includes/images/apple.png" /></a>
                </div>
                <div class="carousel__item">
                    <a href="#">
                        <img src="includes/images/galaxy.png" /></a>
                </div>

                <div class="carousel__actions">
                    <button id="carousel__button--prev" aria-label="Previous slide">
                        < </button>
                            <button id="carousel__button--next" aria-label="Next slide">></button>
                </div>
            </div>

            <a href="list.php" class="button">My videos</a>
            <a href="create.php" class="button">Start <br> translation</a>

            <section class="Online">

            </section>
            <!-- <div id="dialog" style="display: none" >
                         This is a jQuery Dialog.
                </div> -->
            <div id="aass"></div>
        </main>
        <script src="includes/js/script2.js"> </script>
    </div>
    <footer class="footerr"></footer>
</body>

<?php
mysqli_free_result($result);
mysqli_close($connection);
?>

</html>