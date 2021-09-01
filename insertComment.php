<?php
require 'config/dbconfig.php';

$buyer_name= $_POST['buyer_name'];
$buyer_number= $_POST['buyer_number'];
$buyer_bid_price= $_POST['buyer_bid_price'];
$product_id= $_POST['product_id'];

$sql="insert into `buyer`( `buyer_name`, `buyer_number`, `buyer_bid_price`, `product_id`) values('" . $buyer_name . "','" . $buyer_number . "','" . $buyer_bid_price . "','" . $product_id . "')";
if ($con->query($sql)) {
    echo "hello";
}



