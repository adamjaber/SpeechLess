<?php

session_start();
if (!isset($_SESSION["userid"]) )
    header("Location: login.php");
include 'db.php';
     $prod=$_GET["Record_id"];
     $query = "SELECT * FROM Records_207 WHERE Record_id =".$prod ;
     $result = mysqli_query($connection ,$query); 
 
     if(!$result) 
         die("Cannot find the user.") ; 
         
    $row = mysqli_fetch_assoc($result) ;
    
    $sql = "SELECT * FROM Meetings_207 WHERE use_id=" . $_SESSION["userid"];
    $result1 = mysqli_query($connection, $sql);
    if (!$result1)
        die("Cannot find the user.");
 
?>

<!DOCTYPE html>
<html>

<head>
    <title>Object Page</title>
    <link rel="stylesheet" href="includes/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <header>
    <a id="menu" href="#"></a>
        <a href="index.php" id="logo"></a>
        <a href="user.php" id="profile"> <img src="<?php echo $_SESSION["user_img"] ?>" alt="" width="40px"
        height="42px"></a>
        <h2 class="titlee">no need for words</h2>
    </header>
    <div class="wrapper2">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a href="index.php" id="logo-mobile"></a>
  <a href="#" id="profile-mobile"> <img src="<?php echo $_SESSION["user_img"] ?>" alt="" width="40px"
    height="42px"></a>
  <div class="collapse navbar-collapse justify-content-center " id="navbarNav">
    <ul class="navbar-nav ">
      <li class="nav-item ">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
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
        <main class="mainOBJ">

         <?php
            
                echo "<h2>" .$row['Title']. "</h2>";
                echo "<div id='images1'>";
                ?>
                    <iframe width="700" height="500" src=" <?php echo $row['Record_link'] ; ?>"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            <?php  echo "</div>"; 
             ?> 

            <section id="DB">

                

                <a href=' <?php echo "list.php?status=delete&Record_id=" .$row["Record_id"] ?>' id="delete-icon"></a>
                <a href=' <?php echo "create.php?Record_id=" .$row["Record_id"] ?>' id="settings-icon"></a> 
                <?php
                    echo '<p id="Date"> Date : ' .$row["create_date"]. '</p>';
                    echo '<p id="Last"> Last edited : ' .$row["last_edited"]. '</p>';
                    echo '<p id="Length"> Length : ' .$row["Length"]. '</p>';
                    echo '<p id="Com"> Description :</p>';
                    echo '<section id="Comment"> ';
                    echo '<p>' .$row["Description"]. '</p> </section>';
                ?>
            </section>
        </main>
        
        <!-- <?php
        echo "<aside id='aside2'>";
        echo "<h2>Upcoming Meetings</h2>";
        echo "<ul>";
        while ($row1 = mysqli_fetch_assoc($result1)) {
            echo       "<li>" . $row1['Title'] . "</li>";
            echo                "<p>" . $row1['Date'] . "</p>";
            echo                    "<br>";
        }
        echo "</ul>";
        echo '</aside>';
        ?> -->
      
    </div>

    <footer class="footerr"> </footer>
</body>

<?php
    mysqli_close($connection) ; 
?>

</html>