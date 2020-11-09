<?php
require_once(realpath(dirname(__FILE__) . "/../services/connect_db.php"));
$getCartM = "SELECT * FROM tbl_cart_master WHERE c_id='{$_SESSION["userId"]}'";
$resCM = $connect->query($getCartM) or die($connect->error);
$cartM = $resCM->fetch_array();
$getCartC = "SELECT * FROM tbl_cart_child WHERE cartm_id='{$cartM["cartm_id"]}'";
$resCartC = $connect->query($getCartC) or die($connect->error);
if (isset($_POST["id"])) {
    $itemId = $_POST["id"];
    $itemPrice = $_POST["price"];
    $type = $_POST["type"];
    // type ['inc', 'dec'];
    if ($type == "inc") {
        $incCM = "UPDATE tbl_cart_master SET `total_price`=`total_price`+$itemPrice, `items_count`=`items_count`+1 WHERE c_id='{$_SESSION["userId"]}'";
        $incCC = "UPDATE tbl_cart_child SET `item_price`=`item_price`+$itemPrice, `item_count`=`item_count`+1 WHERE cartm_id='{$cartM["cartm_id"]}' AND item_id='$itemId'";
        $connect->query($incCM) or die($connect->error);
        $connect->query($incCC) or die($connect->error);
        exit();
    } else {
        $decCM = "UPDATE tbl_cart_master SET `total_price`=`total_price`-$itemPrice, `items_count`=`items_count`-1 WHERE c_id='{$_SESSION["userId"]}'";
        $decCC = "UPDATE tbl_cart_child SET `item_price`=`item_price`-$itemPrice, `item_count`=`item_count`-1 WHERE cartm_id='{$cartM["cartm_id"]}' AND item_id='$itemId'";
        $connect->query($decCM) or die($connect->error);
        $connect->query($decCC) or die($connect->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <!--jQuery library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/css/mdb.min.css" rel="stylesheet">
    <!-- Bootstrap Core -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Bootstrap Glyphs -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/cart.css">
</head>
<main>

    <body>
        <?php include '../components/navbar.php'; ?>
        <div class="cart-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="main-heading">Shopping Cart</div>
                        <div class="table-cart">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($cartC = $resCartC->fetch_assoc()) {
                                        $sqlFetchItem = "SELECT * FROM tbl_item WHERE item_id='{$cartC["item_id"]}'";
                                        $prodRes = $connect->query($sqlFetchItem) or die($connect->error);
                                        $prod = $prodRes->fetch_array();
                                        echo '<tr>
                                                <td>
                                                    <div class="display-flex align-center">
                                                        <div class="img-product">
                                                            <img src="' . $prod["image"] . '" alt="" class="mCS_img_loaded">
                                                        </div>
                                                        <div class="name-product">
                                                            ' . $prod["item_name"] . '
                                                        </div>
                                                        <div class="price">
                                                        ₹' . $prod["item_price"] . '
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="product-count">
                                                    <form action="#" class="count-inlineflex">
                                                        <div class="qtyminus" onclick="decrementCart(' . $cartC["item_id"] . ',' . $prod["item_price"] . ')">-</div>
                                                        <input type="text" style="font-size:15px;" name="quantity" value="' . $cartC["item_count"] . '" class="qty">
                                                        <div class="qtyplus" onclick="incrementCart(' . $cartC["item_id"] . ',' . $prod["item_price"] . ')">+</div>
                                                    </form>
                                                </td>
                                                <td>
                                                    <div class="total">
                                                    ₹' . $cartC["item_price"] . '
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" title="">
                                                        <img src="images/icons/delete.png" alt="" class="mCS_img_loaded">
                                                    </a>
                                                </td>
                                            </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-cart -->
                    </div>
                    <!-- /.col-lg-8 -->
                    <div class="col-lg-4">
                        <div class="cart-totals">
                            <h3>Cart Totals</h3>
                            <form action="#" method="get" accept-charset="utf-8">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="font-size:15px;">Subtotal</td>
                                            <td class="subtotal">₹<?php echo $cartM["total_price"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:15px;">Shipping</td>
                                            <td class="free-shipping">Free Shipping</td>
                                        </tr>
                                        <tr class="total-row">
                                            <td style="font-size:15px;">Total</td>
                                            <td class="price-total">₹<?php echo $cartM["total_price"]; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="btn-cart-totals">
                                    <a href="/miniproject/index.php" class="update round-black-btn" title="">Go Back To Shopping</a>
                                    <a href="#" class="checkout round-black-btn" title="">Proceed to Checkout</a>
                                </div>
                                <!-- /.btn-cart-totals -->
                            </form>
                            <!-- /form -->
                        </div>
                        <!-- /.cart-totals -->
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
            </div>
        </div>

    </body>
</main>
<!-- Bootstrap, Popper and jQuery cdn -->
<script src="../js/incrementcart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<?php include '../components/footer.php'; ?>

</html>