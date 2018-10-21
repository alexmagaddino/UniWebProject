<!DOCTYPE html>
<html>
<head></head>
<body>
<?php
require "connector.php";
session_start();
$logged=isset($_SESSION['logged']) ? $_SESSION['logged']: "0";
if($logged){
    $Carrello=$_SESSION['Carrello'];// Abbiamo preso l'id del carrello
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $IDProdotto=$_POST['IDProduct'];
        $Prezzo=$_POST['Price'];
        $Numero=$_POST['Number']; 
    }
    $query1="Select * from prodotti_carrello where IDCarrello='$Carrello' and IDProdotto='$IDProdotto'";
    $query2="Update prodotti_carrello Set Quantita=(Quantita +'$Numero') where IDCarrello='$Carrello' and IDProdotto='$IDProdotto'";
    $query3="Insert Into prodotti_carrello (Quantita, IDCarrello, IDProdotto, Prezzo) Values ('$Numero','$Carrello','$IDProdotto','$Prezzo')";
    $query4="Update carrello Set Totale=Totale +('$Prezzo'*'$Numero') where ID='$Carrello'";
    $query5="Update prodotto Set Disp=(Disp - '$Numero') Where ID='$IDProdotto'";
    
    $query6="Select Disp From prodotto Where ID='$IDProdotto'";
    $result=$conn->query($query6);
    $row6=$result->fetch_assoc();
    
    $result=$conn->query($query1);
    $row=$result->fetch_assoc();
    if($row['ID']!=NULL and $row6['Disp']>0){
        $result=$conn->query($query2);
        $result=$conn->query($query4);
        $result=$conn->query($query5);
    }
    if($row['ID']==NULL and $row6['Disp']>0){
        $result=$conn->query($query3);
        $result=$conn->query($query4);
        $result=$conn->query($query5);
    }
    header("location:product_summary.php");
    

}else{?>
    <script type="text/javascript">
        window.alert("Per aggiungere elementi al tuo Carrello devi prima effettuare il login.");
    </script>
    
    <form name="addFr" action="product_summary.php" method="post">   
    </form>
    
    <script type="text/javascript">
        document.addFr.submit();
    </script>

<?php } ?>
</body>
</html>