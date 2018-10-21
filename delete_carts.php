<?php
require "connector.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cart_id=isset($_POST['IDCarrello']) ? $_POST['IDCarrello']: "";
    $result=$conn->query("Delete From prodotti_carrello Where IDCarrello='$cart_id'");
    $result=$conn->query("Delete From carrello Where ID='$cart_id'");
    header("location:admin.php");
}
?>