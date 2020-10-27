<?php
session_start();
require_once('connect_db.php');
if (isset($_GET['id'])) {
    $itemId = $_GET['id'];
    $sqlProduct = "SELECT * FROM tbl_item WHERE item_id='" . $itemId . "'";
    if ($result = $connect->query($sqlProduct)) {
        $item = $result->fetch_array();
        $sqlCartM = "SELECT * FROM tbl_cart_master WHERE c_id";
    } else {
        if ($connect->error) {
            echo $connect->error;
        }
    }
}
