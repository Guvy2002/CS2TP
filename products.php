<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    
<?php
    require_once("connectdb.php");

    $stat = $db->prepare("SELECT * FROM product");
    $stat->execute();
    $data = $stat->fetchAll();

    echo "<table><tr><th>Name</th><th>Price</th><th>Size</th><th>Stock</th></tr>";
    foreach($data as $item) 
    {
        echo 
        "<tr>". 
        "<td>".$item['name']."</td>".
        "<td>".$item['price']."</td>".
        "<td>".$item['size']."</td>".
        "<td>".$item['stock']."</td>".
        "<td><input type='button' name='addToCart[]' value='".$item['productID']."'></td>".
        "</td>";
    }
    echo "</table>";
?>

</body>
</html>