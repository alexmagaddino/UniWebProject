<?php
session_start();
require "connector.php";
$logged=isset($_SESSION["logged"]) ? $_SESSION["logged"]: false;
$cart=isset($_SESSION["Carrello"]) ? $_SESSION["Carrello"]: "0";
$user_id=isset($_SESSION["user_id"]) ? $_SESSION["user_id"]:"";

$nome_mittente = "Web Project";
$mail_mittente = "alex.magaddino@gmail.com";
$Email="";

// definisco il subject ed il body della mail
$mail_oggetto = "CONFERMA PAGAMENTO";
$mail_corpo = "Il pagamento e' andato a buon fine. Ecco il resoconto di quello che hai acquistato:\n\n";

// aggiusto un po' le intestazioni della mail
// E' in questa sezione che deve essere definito il mittente (From)
// ed altri eventuali valori come Cc, Bcc, ReplyTo e X-Mailer
$mail_headers = "From: " .  $nome_mittente . " <" .  $mail_mittente . ">\r\n";
$mail_headers .= "Reply-To: " .  $mail_mittente . "\r\n";
$mail_headers .= "X-Mailer: PHP/" . phpversion();


if($logged){
    $result=$conn->query("Select Email from utente Where ID='$user_id'");
    $row=$result->fetch_assoc();
    $Email=$row['Email'];
    $result=$conn->query("Select prodotto.Nome as Nome, prodotti_carrello.Quantita as Quantita, prodotti_carrello.Prezzo as Prezzo From carrello
    join prodotti_carrello on prodotti_carrello.IDCarrello=carrello.ID 
    join prodotto on prodotti_carrello.IDProdotto=prodotto.ID 
    Where carrello.Pagato='0' and carrello.ID='$cart'");
    $i=1;
    $Totale=0;
    while($row=$result->fetch_assoc()){
        $mail_corpo = $mail_corpo. "$i) Prodotto: ".$row['Nome']. " - Prezzo: ".$row['Prezzo']. " - Quantita': ".$row['Quantita']. "\n";
        $i++;
        $Totale = $Totale + $row['Prezzo'] * $row['Quantita'];
    }
    $mail_corpo .= "\nPer un totale di euro: $Totale\nGrazie per averci scelto.";
    echo $mail_corpo;
    $result=$conn->query("Update carrello Set Pagato='1' Where ID='$cart'");   
    $result=$conn->query("Insert Into carrello (IDUtente,Pagato,Totale) Values ('$user_id','0','0')");
    $result=$conn->query("Select ID from carrello where IDUtente='$user_id' and Pagato='0'");
    $row=$result->fetch_assoc();
    $_SESSION["Carrello"]=$row['ID'];
    
    if (mail($Email, $mail_oggetto, $mail_corpo, $mail_headers)){
        echo "Messaggio inviato con successo a " . $Email;
    }else{
        echo "Errore. Nessun messaggio inviato.";
    }
    
    header("location:index.php");    
}
?>