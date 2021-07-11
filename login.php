<?php
session_start();
include 'db.php';
include 'config.php';

if (isset($_GET["state"]) && $_GET["state"] == "logout") {    // sign out
    $_SESSION["userid"] = 0;
    session_destroy();
}
if (!empty($_POST["Acctype"])) {                                                    ///   if signup
    $queryy = "SELECT * FROM users_207 WHERE user_email='" . $_POST["email"] . "'";
    $result = mysqli_query($connection, $queryy);
    $roww = mysqli_fetch_assoc($result);
    if (is_array($roww)) {
        $message =   "User aleady in use!";
    } else {
        $query = "INSERT INTO users_207 (user_fullname ,user_password ,user_img ,user_Type ,user_email)
        VALUES ('" . $_POST["fullname"] . "','" . $_POST["pass"] . "','" . $_POST["user_img"] . "','" . $_POST["Acctype"] . "','" . $_POST["email"] . "')";
        $result = mysqli_query($connection, $query);
        if (!$result)
            die("connection problem!");
        else {
            $_SESSION["userid"] = $_POST["email"];
            header('location: login.php');
        }
    }
}

if (!empty($_POST["email"]) && empty($_POST["Acctype"])) {              /// if login

    $query = "SELECT * FROM users_207 WHERE user_email='"
        . $_POST["email"]
        . "' AND user_password ='" . $_POST["pass"] . "'";

    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);

    if (is_array($row)) {
        if (session_status() != PHP_SESSION_ACTIVE)
            session_start();

        $_SESSION["userid"] = $row["id"];
        $_SESSION["user_img"] = $row["user_img"];
        $_SESSION["user_Type"] = $row["user_Type"];
        header('location: index.php');
    } else
        $message = "Wrong username or password , insert again";
}




?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="includes/css/style.css">

</head>

<body id="body-form">
    <header id="header-form">
        <a id="menu" href="#"></a>
        <a href="index.php" id="logo"></a>

        <h2 class="titlee">no need for words</h2>
    </header>

        <div class="Form1">
            <div class="row">
                <div class="col-md-6 mx-auto p-0">
                    <div class="card">
                        <div class="login-box">
                            <div class="login-snip"> <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label> <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
                                <div class="login-space">
                                    <?php if (!empty($_post["email"]))
                                        echo "<h1>Form sent</h1>";
                                    ?>
                                    <form action="#" method="post" id="login">
                                        <div class="login">
                                            <div class="group"> <label for="email" class="label">Email Address</label> <input id="email" required="required" type="text" name="email" class="input" placeholder="Email address"> </div>
                                            <div class="group"> <label for="pass" class="label">Password</label> <input id="pass" required="required" type="password" name="pass" class="input" data-type="password" placeholder="Password"> </div>
                                            <div class="group"> <input id="check" type="checkbox" class="check" checked> <label for="check"><span class="icon"></span> Keep me Signed in</label> </div>
                                            <div class="group"> <input type="submit" class="button" value="Log In"> </div>
                                            <div class="error-message"><?php if (isset($message)) {
                                                                            echo $message;
                                                                        } ?></div>
                                            <div class="hr"></div>
                                            <div class="foot"> <a href="#">Forgot Password?</a> </div>
                                        </div>
                                    </form>
                                    <form action="#" method="post" id="sign-up">
                                        <div class="sign-up-form">
                                            <div class="group"> <label for="user" class="label">Full name</label> <input id="user" required="required" type="text" name="fullname" class="input" placeholder="Insert your full name"> </div>
                                            <div class="group"> <label for="pass" class="label">Password</label> <input id="pass" required="required" type="text" name="pass" class="input" data-type="password" placeholder="Create your password"> </div>
                                            <div class="group"> <label for="pic" class="label">Picture link</label> <input id="pic" type="URL" name="user_img" class="input" placeholder="link for profile picture"> </div>
                                            <div class="group"> <label for="pass" class="label">Email Address</label> <input id="email" required="required" type="Email" name="email" class="input" placeholder="Email address"> </div>
                                            <div class="group"> <label for="Speaking language" class="label">Account type</label> <select id="Acctype" required="required" name="Acctype" type="text" class="input" placeholder="Choose youre account type"> </div>

                                            <option value="Basic">Basic</option>
                                            <option value="Admin">Admin</option>
                                            </select>
                                            <br>
                                            <div class="group"> <input type="submit" class="button" value="Sign Up"> </div>
                                            <div class="hr"></div>
                                            <div class="foot"> <label for="tab-1" href="#">Already Member?</label> </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
</body>

</html>