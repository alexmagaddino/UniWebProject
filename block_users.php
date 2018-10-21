<?php
require "connector.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id=isset($_POST['IDUtente']) ? $_POST['IDUtente']: "";
    $result=$conn->query("Select Bloccato From utente Where ID='$user_id'");
    $row=$result->fetch_assoc();
    if($row['Bloccato']==0){
      $result=$conn->query("Update utente Set Bloccato='1' Where ID='$user_id'");
    }elseif($row['Bloccato']==1){
        $result=$conn->query("Update utente Set Bloccato='0' Where ID='$user_id'");            
    }
    header("location:admin.php");
}
?>