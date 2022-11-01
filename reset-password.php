<?php
#Once register is clicked
if (isset($_POST["submitted"])) {
    require_once("connectdb.php");
    // $name = empty($_POST["name"]) ? false : htmlspecialchars($_POST["name"]);
    $email = empty($_POST["email"]) ? false : htmlspecialchars($_POST["email"]);
    $recoverykey = empty($_POST["recoverykey"]) ? false : $_POST["recoverykey"];
    $password = empty($_POST["password"]) ? false : password_hash($_POST["password"], PASSWORD_DEFAULT);

    if (!($email)) {
        echo "<p style='color:red'> Email cannot be empty </p>";
    } elseif (!($recoverykey)) {
        echo "<p style='color:red'> Recovery key cannot be empty </p>";
    } elseif (!($password)) {
        echo "<p style='color:red'> Password cannot be empty </p>";
    } elseif ($_POST["password"] != $_POST["confirmpassword"]) {
        echo "<p style='color:red'> Passwords do not match </p>";
    } else {
        try {
            
            // Find email, check rhash is equal, update phash with new, regen rkey
            $stat = $db->prepare("SELECT * FROM logins WHERE Email=?");
            $stat->execute([$email]); 
            $user = $stat->fetch();

            if (password_verify($recoverykey, $user['RecoveryHash'])) {
                $stat = $db->prepare("UPDATE logins SET PasswordHash=? WHERE uid=?");
                $stat->execute([$password, $user['uid']]); 
                echo "Updated password";
            }
            else {
                echo "Incorrect Recovery Key";
            }
        } catch (PDOException $ex) {
            echo "Sorry, a database error occurred! <br>";
            echo "Error details: <em>" . $ex->getMessage() . "</em>";
        }
        exit;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Reset password</title>
    <meta charset="UTF-8" />
</head>

<body>
    <header style='margin: 0px auto;width:28%;'>
        <h2>Stance</h2>
    </header>
    <h1>Reset your password</h1>
    <p>Fill in recovery key to reset your password</p>
    <form method="POST" action="reset-password.php">
        <!-- <input type="text" name="name" placeholder="Name"> -->
        <input type="email" name="email" placeholder="Email">
        <input type="text" name="recoverykey" placeholder="Recovery key">
        <input type="password" name="password" placeholder="New password">
        <input type="password" name="confirmpassword" placeholder="Confirm password">

        <input id="submit" type="submit" value="RESET PASSWORD">
        <input type="hidden" name="submitted" value="TRUE" />
    </form>
    <a style="margin-left:20%;color:black;font-size:16px;" href="login.php"> Sign in</a>
</body>

</html>