<?php
require_once('connect_db.php');

// logic 
// when someone clicks add button to cart ✅
// select item from cart using id ✅
// them select cart master by using user id ✅
// use cart master id to add item in cart child ✅
// after that fetchs the cart child using cart master id, iterates and finds total price of the cart ✅
// updates it in cart master along with incrementing total items count ✅

// next check is ✅
// if the item is already in cart increase count of the item in cart child and price too  ✅
// in master total price
if (isset($_GET['id'])) {
    $itemId = $_GET['id'];
    $sqlProduct = "SELECT * FROM tbl_item WHERE item_id='" . $itemId . "'";
    if ($result = $connect->query($sqlProduct)) {
        $item = $result->fetch_array();
        // fetch cart master
        $sqlCartM = "SELECT * FROM tbl_cart_master WHERE c_id='{$_SESSION["userId"]}'";
        if ($cartMRes = $connect->query($sqlCartM)) {
            $cartM = $cartMRes->fetch_array();
            $datetime = date('Ymd');

            $sqlCheckCart = "SELECT * FROM tbl_cart_child WHERE cartm_id='{$cartM["cartm_id"]}' AND item_id='$itemId'";
            $cartCheck = $connect->query($sqlCheckCart) or die($connect->error);

            // i['']f cart has the item hm?
            if ($cartCheck->num_rows > 0) {
                $cartCCheckRes = $cartCheck->fetch_array();
                $itemId = $cartCCheckRes['item_id'];
                $itemPrice = $cartCCheckRes['item_price'];
                // increase count in cart child and price
                $sqlUpdateCartC = "UPDATE tbl_cart_child SET `item_count`=`item_count`+1, `item_price`=`item_price`+${itemPrice} WHERE item_id='${itemId}'";
                $connect->query($sqlUpdateCartC) or die($connect->error);
                // hmm!
                $cartMUpdate = "UPDATE tbl_cart_master SET `items_count`=`items_count`+1, `total_price`=`total_price`+${itemPrice} WHERE c_id='{$_SESSION["userId"]}'";
                $connect->query($cartMUpdate) or die($connect->error);
            } else {

                // usual shit ig
                $sqlCartCInsert = "INSERT INTO tbl_cart_child (`cartm_id`, `added_time`, `item_id`, `item_price`, `item_count`) VALUES ({$cartM['cartm_id']},{$datetime},{$item['item_id']},{$item['item_offerprice']},1) ";

                if ($connect->query($sqlCartCInsert)) {

                    $sqlCartCSelect = "SELECT * FROM tbl_cart_child WHERE cartm_id='{$cartM["cartm_id"]}'";
                    if ($res = $connect->query($sqlCartCSelect)) {
                        $totalItems =  $res->num_rows;
                        $totalPrice = 0;
                        while ($cartC = $res->fetch_assoc()) {
                            $totalPrice += $cartC["item_price"];
                        }
                        $updateCartM = "UPDATE tbl_cart_master SET `items_count`=`items_count`+1, `total_price`={$totalPrice} WHERE cartm_id='{$cartM["cartm_id"]}'";
                        $connect->query($updateCartM) or die($connect->error);
                    } else {
                        printf($connect->error);
                    }
                } else {
                    printf($connect->error);
                }
                echo "Item Added To Cart";
            }
        } else {
            printf("Error message: %s\n", $connect->error);
        }
    } else {
        if ($connect->error) {
            echo $connect->error;
        }
    }
    $connect->close();
}
