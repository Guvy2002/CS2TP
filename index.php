<!DOCTYPE html>
<html>

<head>
    <title>Home page</title>
    <meta charset="UTF-8" />
</head>

<body>
    <header style='margin: 0px auto;width:28%;'>
        <h2>STANCE</h2>
    </header>
    <?php
    session_start();
    //check if the user is not logged in, display login button if not
    if (!isset($_SESSION['email'])) {
    ?>
        <!-- Login button -->
        <form method="POST" action="login.php">
            <input type="submit" value="Login">
        </form>
        <!-- <a href="register.php">Register now!</a> -->
        <form action="register.php">
            <input type="submit" value="Register now!">
        </form>
    <?php
    } else {
    ?>
        <!-- if user is logged in, show logged in user and logout button -->
        <h3><?= $_SESSION['email'] ?></h3>
        <?php
        // require_once("connectdb.php");
        // try {
        //     $stat = $db->prepare("SELECT * FROM cvs WHERE email = ?");
        //     $stat->execute(array($email));
        //     if ($stat && $stat->rowCount() > 0) {
        //         $row = $stat->fetch();
        //     } else {
        //         echo  "<p>No cv in the list.</p>\n"; //no match found
        //     }
        // } catch (PDOexception $ex) {
        //     echo "Sorry, a database error occurred! <br>";
        //     echo "Error details: <em>" . $ex->getMessage() . "</em>";
        // }
        ?>
        <!-- Logout button -->
        <form method="POST" action="logout.php">
            <input type="submit" value="Logout">
        </form>

    <?php } ?>
</body>

</html>