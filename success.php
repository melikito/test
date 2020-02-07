<?php
session_start();
include("config.inc.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$insertPayment = "INSERT INTO shop_payment(order_id, payment_status, payment_response) VALUES('".$order_id."', '".$payment_status."', '".$payment_response."')";
$updateOrder = "UPDATE shop_order set order_status = 'PAID' WHERE id=".$_SESSION["orderID"];
mysqli_query(mysqli_conn, $updateOrder) or die("database error: ". mysqli_error($mysqli_conn));
?>