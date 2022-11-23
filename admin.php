<?php
require_once("connectdb.php");
session_start();
# Has submitted?
if (isset($_POST["submitted"])) {
    $name = empty($_POST["name"]) ? false : htmlspecialchars($_POST["name"]);
    $price = empty($_POST["price"]) ? false : htmlspecialchars($_POST["price"]);
    $size = empty($_POST["size"]) ? false : htmlspecialchars($_POST["size"]);
    $stock = empty($_POST["stock"]) ? false : htmlspecialchars($_POST["stock"]);

    if (!($name)) echo "<p style='color:red'> name cannot be empty </p>";
    elseif (!($price)) echo "<p style='color:red'> price cannot be empty </p>";
    elseif (!($size)) echo "<p style='color:red'> size cannot be empty </p>";
    else {
        try {
            $stat = $db->prepare("SELECT uid FROM logins WHERE Email = ?");
            $stat->execute(array($_SESSION['email']));
            $data = $stat->fetch();

            $stat = $db->prepare("insert into product values(default,?,?,?,?,?,default)");
            $stat->execute(array($data['uid'], $name, $price, $size, $stock));
            echo "Product Added!";
            // unset($_POST["submitted"]);
        } catch (PDOException $ex) {
            echo "Sorry, a database error occurred! <br>";
            echo "Error details: <em>" . $ex->getMessage() . "</em>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<!--
    TODO:
     - Admin check
     - Add Image Filepath
     - Image Validation
     - Price Validation
-->

<body>
    <title>Stance</title>

    <?php
    if (!isset($_SESSION['email'])) : ?>
        <p>not signed in wow</p>
    <?php else :
        $stat = $db->prepare("SELECT uid FROM logins WHERE Email = ?");
        $stat->execute(array($_SESSION['email']));
        $email = $stat->fetch();

        $stat = $db->prepare("SELECT * FROM product WHERE userID = ?");
        $stat->execute(array($email['uid']));
        $data = $stat->fetchAll();

        echo "<table><tr><th>Name</th><th>Price</th><th>Size</th><th>Stock</th></tr>";
        foreach ($data as $item) {
            echo "<tr>" .
                "<td>" . $item['name'] . "</td>" .
                "<td>" . $item['price'] . "</td>" .
                "<td>" . $item['size'] . "</td>" .
                "<td>" . $item['stock'] . "</td>" .
                "</td>";
        }
        echo "</table>";
    ?>
        <p>signed in for admin panel</p>
        <form id="cvform" method="POST" action="admin.php">
            <h4>Add Product</h4>
            <input type="text" name="name" placeholder="Name">
            <input type="number" name="price" placeholder="Price" min="0.00" max="100000.00" step="0.01">
            <input type="number" name="stock" placeholder="Stock" min="0.00" max="100000.00">
            <input type="range" name="size" min="1" max="20" value="12" oninput="this.nextElementSibling.value = 'Size: '+this.value">
            <output>Size: 12</output>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Add Product" name="submit">
            <input type="hidden" name="submitted" value="TRUE" />
        </form>
    <?php endif; ?>
</body>

</html>