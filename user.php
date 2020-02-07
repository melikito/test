<?php
session_start();
setlocale(LC_MONETARY, "es_ES");
var_dump($_SESSION);
include_once 'config.inc.php';
if(!empty($_POST["proceedPayment"])) {
$member_id ="4" ;
$firstName = $_POST ['firstName'];
$lastName = $_POST ['lastName'];
$address = $_POST ['address'];
$contactNumber = $_POST ['contactNumber'];
$emailAddress = $_POST ['emailAddress'];
$insertOrderSQL = "INSERT INTO shop_order(member_id, name, address, mobile, email, order_status, order_at, payment_type)VALUES('".$member_id."', '".$firstName." ".$lastName."', '".$address."', '".$contactNumber."', '".$emailAddress."', 'PENDING', '".date("Y-m-d H:i:s")."', 'PAYPAL')";
mysqli_query($conn, $insertOrderSQL) or die("database error:". mysqli_error($conn));
$order_id = mysqli_insert_id($conn);
}
?>
<h2>Customer Shipping Details</h2>
<div class="col-md-8">
<form class="form-horizontal" method="post" enctype="multipart/form-data" action="payment.php">
<div class="form-group">
<div class="col-sm-6">
<input type="text" class="form-control" placeholder="nombre" name="firstName" required />
</div>
</div>
<div class="form-group">
<div class="col-sm-6">
<input type="text" class="form-control" placeholder="apellidos" name="lastName" required />
</div>
</div>
<div class="form-group">
<div class="col-sm-6">
<textarea class="form-control" rows="5" placeholder="dirección" name="address" required ></textarea>
</div>
</div>
<div class="form-group">
<div class="col-sm-8">
<input type="number" class="form-control" min="9" placeholder="numero" name="contactNumber" required />
</div>
</div>
<div class="form-group">
<div class="col-sm-6">
<input type="email" class="form-control" placeholder="Email" name="correo" required />
</div>
</div>
<div class="form-group">
<div class="col-sm-4">
<input class="btn btn-primary" type="submit" name="proceedPayment" value="pagar"/>
</div>
</div>
</form>
</div>
<?php
if($order_id) {
if(isset($_SESSION["products"]) && count($_SESSION["products"])>0) {
foreach($_SESSION["products"] as $product){
$insertOrderItem = "INSERT INTO shop_order_item(order_id, product_id, item_price, quantity)VALUES('".$order_id."', '".$product["product_code"]."', '". $product["product_price"]."', '".$product["product_qty"]."')";
mysqli_query($conn, $insertOrderItem) or die("database error:". mysqli_error($conn));
}
}
}
?>