<?php
#Once register is clicked
if (isset($_POST["submitted"])) {
    require_once("connectdb.php");
    // $name = empty($_POST["name"]) ? false : htmlspecialchars($_POST["name"]);
    $email = empty($_POST["email"]) ? false : htmlspecialchars($_POST["email"]);
    $password = empty($_POST["password"]) ? false : password_hash($_POST["password"], PASSWORD_DEFAULT);
    // if (!($name)) {
    //     echo "<p style='color:red'> Name cannot be empty </p>";
    // } else
    if (!($email)) {
        echo "<p style='color:red'> Email cannot be empty </p>";
    } elseif (!($password)) {
        echo "<p style='color:red'> Password cannot be empty </p>";
    } elseif ($_POST["password"] != $_POST["confirmpassword"]) {
        echo "<p style='color:red'> Passwords do not match </p>";
    } else {
        try {
            $rgen = GenRecoveryKey();
            $recoverykey = password_hash($rgen, PASSWORD_DEFAULT);
            $stat = $db->prepare("insert into logins values(default,?,?,?)");
            $stat->execute(array($_POST["email"], $password, $recoverykey));

            echo "Recovery Key " . $rgen . "\n";

            echo "Congratulations! your Stance account has been registered.";
        } catch (PDOException $ex) {
            echo "Sorry, a database error occurred! <br>";
            echo "Error details: <em>" . $ex->getMessage() . "</em>";
        }
    }
}

function GenRecoveryKey()
{
    $set = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";      // Character set to pick from
    $len = strlen($set);
    $rkey = "R";
    
    for ($i = 0; $i < 5; $i++)                          // Predefined length 5
        $rkey .= $set[rand(0, $len - 1)];               // .= operator appends string

    return $rkey;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Register page</title>
    <meta charset="UTF-8" />
    <!-- <link href="cv.css" rel='stylesheet' type="text/css" /> -->
</head>

<body>
    <header style='margin: 0px auto;width:28%;'>
        <h2>Stance</h2>
    </header>

    <form id="cvform" method="POST" action="register.php">
        <h4>REGISTER</h4>
        <!-- <input type="text" name="name" placeholder="Name"> -->
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirmpassword" placeholder="Confirm password">

        <input id="submit" type="submit" value="CREATE ACCOUNT">
        <input type="hidden" name="submitted" value="TRUE" />
    </form>
    <a style="margin-left:20%;color:black;font-size:16px;" href="login.php">Sign in</a>
</body>

</html>