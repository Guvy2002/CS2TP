<?php
#if user clicks  login button 
if (isset($_POST['submitted'])) {

    require_once("connectdb.php");
    #htmlspecialchars prevents injection 
    $email = empty($_POST['email']) ? false : htmlspecialchars($_POST['email']);
    $password = empty($_POST['password']) ? false : htmlspecialchars($_POST['password']);
    if (!$email) {
        echo "<p style='color:red;position:relative;top:110px;'>Email required! </p>";
    } elseif (!$password) {
        echo "<p style='color:red;position:relative;top:110px;'>Password required! </p>";
    } else {
        try {
            $stat = $db->prepare("SELECT PasswordHash FROM stancelogins WHERE EmailAddress = ?");
            $stat->execute(array($email));
            if ($stat && $stat->rowCount() > 0) {
                $row = $stat->fetch();
                if (password_verify($password, $row['PasswordHash'])) {
                    session_start();
                    $_SESSION['email'] = $email;
                    header('Location:index.php');
                    exit();
                } else {
                    echo "<p style='color:red;position:relative;top:110px;'>Error logging in, password incorrect! </p>";
                }
            } else {
                echo "<p style='color:red;position:relative;top:110px;'>User not found! </p>";
            }
        } catch (PDOException $ex) {
            echo "Sorry, a database error occurred! <br>";
            echo "Error details: <em>" . $ex->getMessage() . "</em>";
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta charset="UTF-8" />
    <!-- <script defer src='cv.js'></script> -->
</head>

<body>
    <header style="width: 28%;">
        <h2>STANCE</h2>

    </header>
    <!-- Login form -->
    <!-- When login form is submitted, php at the top is run -->
    <form id="login" action="login.php" method="post">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" id="submit" value="Sign in">
        <input type="hidden" name="submitted" value="TRUE">
    </form>
    <!-- When register button is cliked, register.php is run-->
    <!-- <a href="register.php">Register now!</a> -->

    <form action="register.php">
        <input type="submit" value="Register now!">
    </form>
    <a href="reset-password.php">Forgot your password?</a>

</body>

</html>