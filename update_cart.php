<?php
require "connector.php";
session_start();
$logged=isset($_SESSION['logged']) ? $_SESSION['logged']: "0";
if($logged){
    $Carrello=$_SESSION['Carrello'];// Abbiamo preso l'id del carrello
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $IDProdotto=$_POST['IDProdotto'];
        $Prezzo=$_POST['Prezzo'];
        $Quantita=$_POST['Quantita'];
        $query="Select Disp From prodotto Where ID='$IDProdotto'";
        $result=$conn->query($query);
        $row=$result->fetch_assoc();
        if(isset($_POST['minus'])) {
           $query1="Update prodotti_carrello Set Quantita=(Quantita - 1) Where IDCarrello='$Carrello' and IDProdotto='$IDProdotto'";
           $query2="Update carrello Set Totale=(Totale - '$Prezzo') where ID='$Carrello'";
           $query3="Update prodotto Set Disp=(Disp + 1) Where ID='$IDProdotto'";
           if($Quantita>0){
               $result=$conn->query($query1);
               $result=$conn->query($query2);
               $result=$conn->query($query3);
           }
        }

        if(isset($_POST['plus'])) {
           $query1="Update prodotti_carrello Set Quantita=(Quantita + 1) Where IDCarrello='$Carrello' and IDProdotto='$IDProdotto'";
           $query2="Update carrello Set Totale=(Totale + '$Prezzo') where ID='$Carrello'";
           $query3="Update prodotto Set Disp=(Disp - 1) Where ID='$IDProdotto'";
           if($row['Disp']>0){
               $result=$conn->query($query1);
               $result=$conn->query($query2);
               $result=$conn->query($query3);
           }
        }

        if(isset($_POST['delete'])) {
           $query1="Delete From prodotti_carrello Where IDCarrello='$Carrello' and IDProdotto='$IDProdotto'";
           $query2="Update carrello Set Totale=(Totale - '$Prezzo'*'$Quantita') where ID='$Carrello'";
           $query3="Update prodotto Set Disp=(Disp + '$Quantita') Where ID='$IDProdotto'";
           $result=$conn->query($query1);
           $result=$conn->query($query2);
           $result=$conn->query($query3);
        }
    }
    header("location:product_summary.php");
}
?>