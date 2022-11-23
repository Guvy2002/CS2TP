<?php
require_once("connectdb.php");
session_start();

if (isset($_POST['add-to-cart'])) {
    try {
        // echo "id is set";
        // echo
        // $id = htmlspecialchars($_POST['hidden_name']);
        // echo $id;
        #check if any product is already in the cart
        if (isset($_SESSION['cart'])) {
            // check if the item is in the array, if it is, do not add
            $product_array_id = array_column($_SESSION['cart'], "product_id"); # get array of all product ids of items in cart
            // for ($i = 0; $i < count($product_array_id); $i++) {
            //     echo $product_array_id[$i];
            // }
            // echo '<pre>';
            // var_dump($_SESSION);
            // echo '</pre>';
            if (!in_array($_POST["hidden_id"], $product_array_id)) { # if the product id is not in the array of product ids
                $count = count($_SESSION['cart']); # get the number of items in the cart
                // echo " count is " . $count . " ";
                $product_array = array(
                    'product_id' => $_POST["hidden_id"],
                    'product_name' => $_POST["hidden_name"],
                    'product_price' => $_POST["hidden_price"],
                    // 'item_quantity' => $_POST["quantity"]
                ); # create an array of the product details
                // $_SESSION['cart'][$count] = $product_array; # add the product details to the cart at index $count
                array_push($_SESSION['cart'], $product_array); # add the product details to the cart at index $count
                // echo '<script>window.location="products.php"</script>';
            } else {
                echo '"Product is already Added to Cart"';
                // echo '<script>window.location="products.php"</script>';
            }
        }
        #if no product is in the cart, create the cart session variable
        else {
            $product_array = array(
                'product_id' => $_POST["hidden_id"],
                'product_name' => $_POST['hidden_name'],
                'product_price' => $_POST['hidden_price'],
                // 'item_quantity' => $_POST['quantity']
            );
            $_SESSION['cart'][0] = $product_array;
            // print_r($_SESSION['cart']);
        }
    } catch (PDOexception $ex) {
        echo "Sorry, a database error occurred! <br>";
        echo "Error details: <em>" . $ex->getMessage() . "</em>";
    }
} else {
}


if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["cart"] as $keys => $values) {
            if ($values["product_id"] == $_GET["id"]) { #
                // echo "key is " . $keys;
                unset($_SESSION["cart"][$keys]);
                echo 'Product has been Removed...!"';
                // echo '<script>window.location="products.php"</script>';
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>

<body>

    <?php
    require_once("connectdb.php");

    $stat = $db->prepare("SELECT * FROM product ");
    $stat->execute();
    $data = $stat->fetchAll();

    ?>

    <div>
        <table>

            <h3>Products</h3>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Size</th>
                <th>Stock</th>
            </tr>
            <?php
            foreach ($data as $item) {
                echo
                "<form method='POST' action='products.php'>" .
                    "<tr>" .
                    "<td>" . $item['productID'] . "</td>" .
                    "<td>" . $item['name'] . "</td>" .
                    "<td>" . $item['price'] . "</td>" .
                    "<td>" . $item['size'] . "</td>" .
                    "<td>" . $item['stock'] . "</td>" .
                    // echo  "<tr id='cvrow' onclick=\"window.location='clickedcv.php?id=" . $row['id'] . "';\"><td id='rowname'>" . $row['name'] . "</td>";

                    // "<td><input type='submit' onclick=\"window.location='products.php?id=" . $item['name'] . "'\" value='" . $item['productID'] . "'></td>" .
                    "<td><input type='submit' value='Add to cart'></td>" .
                    "<input type='hidden' name='hidden_id' value='" . $item['productID'] . "' />" .
                    "<input type='hidden' name='hidden_name' value='" . $item['name'] . "' />" .
                    "<input type='hidden' name='hidden_price' value='" . $item['price'] . "' />" .
                    "<input type='hidden' name='hidden_stock' value='" . $item['stock'] . "' />" .
                    "<input type='hidden' name='add-to-cart' value='TRUE'>" .
                    "</tr> 
                </form>";
                // "<tr>" .
                //     "<td>" . $item['name'] . "</td>" .
                //     "<td>" . $item['price'] . "</td>" .
                //     "<td>" . $item['size'] . "</td>" .
                //     "<td>" . $item['stock'] . "</td>" .
                //     "<td><input type='submit' name='addToCart[]' value='" . $item['productID'] . "'></td>" .
                //     "</tr>";
            }
            echo "</table>";
            ?>
    </div>

    <div>
        <h3>Cart</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <?php
            if (!empty($_SESSION['cart'])) {
                $total = 0;
                echo (count($_SESSION['cart']));
                foreach ($_SESSION['cart'] as $key => $value) {
                    echo
                    "<tr>" .
                        "<td>" . $value['product_name'] . "</td>" .
                        "<td>" . $value['product_price'] . "</td>" .
                        "<td><input type='text' name='quantity' value='1' class='quantity'></td>" .
                        "<td>" . number_format($value['product_price'], 2) . "</td>" .
                        "<td><a href='products.php?action=delete&id=" . $value['product_id'] . "'><span>Remove</span></a></td>" .
                        "</tr>";
                    $total = $total + (float)$value['product_price'] * 1;
                }
                echo
                "<tr>" .
                    "<td colspan='3' align='right'>Total</td>" .
                    "<td align='right'>" . number_format($total, 2) . "</td>" .
                    "<td></td>" .
                    "</tr>";
            }
            ?>
    </div>
</body>

</html>