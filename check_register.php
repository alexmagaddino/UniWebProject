<!DOCTYPE html>
<html>
<head></head>
<body>
<?php
require "connector.php";


$nome_mittente = "Web Project";
$mail_mittente = "alex.magaddino@gmail.com";

// definisco il subject ed il body della mail
$mail_oggetto = "VERIFICA REGISTRAZIONE";
$mail_corpo = "Il processo di registrazione e' andato a buon fine. ";
							  

// aggiusto un po' le intestazioni della mail
// E' in questa sezione che deve essere definito il mittente (From)
// ed altri eventuali valori come Cc, Bcc, ReplyTo e X-Mailer
$mail_headers = "From: " .  $nome_mittente . " <" .  $mail_mittente . ">\r\n";
$mail_headers .= "Reply-To: " .  $mail_mittente . "\r\n";
$mail_headers .= "X-Mailer: PHP/" . phpversion();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["Nome"])) {
        $NomeErr = "Name is required";
	} else {
		$Nome = test_input($_POST["Nome"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$Nome)) {
			$NomeErr = "Only letters and white space allowed";
		}else{
            $NomeErr = "";
        }
	}
  
	if (empty($_POST["Cognome"])) {
		$CognomeErr = "Second name is required";
	} else {
		$Cognome = test_input($_POST["Cognome"]);
		// check if second name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$Cognome)) {
			$CognomeErr = "Only letters and white space allowed";
		}else{
            $CognomeErr = "";
        }
	}
  
	if (empty($_POST["Email"])) {
		$EmailErr = "Email is required";
	} else {
		$Email = test_input($_POST["Email"]);
		// check if e-mail address is well-formed
		if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
			$EmailErr = "Invalid email format"; 
		}else{
            $EmailErr = "";
        }
	}
  
	if (empty($_POST["Password"])) {
		$PasswordErr = "Password is required";
	} else {
		$Password = test_input($_POST["Password"]);
		if( strlen($Password) < 8 ) {
			$PasswordErr = "Password too short!";
		}else{
            $PasswordErr = "";
        }
        if( strlen($Password) > 20 ) {
			$PasswordErr = "Password too long!";
		}else{
            $PasswordErr = "";
        }
        if( !preg_match("#[0-9]+#", $Password) ) {
			$PasswordErr = "Password must include at least one number!";
		}else{
            $PasswordErr = "";
        }
        if( !preg_match("#[a-z]+#", $Password) ) {
			$PasswordErr = "Password must include at least one letter!";
		}else{
            $PasswordErr = "";
        }
        
	}
    
	if (empty($_POST["DataNascita"])) {
		$DataNascitaErr = "Date is required";
	} else {
		$DataNascita = $_POST["DataNascita"];
        $DataNascitaErr="";
	}
  
	if (empty($_POST["Paese"])) {
		$PaeseErr = "Country is required";
	} else {
		$Paese = test_input($_POST["Paese"]);
        $PaeseErr="";
	}
  
	if (empty($_POST["Citta"])) {
		$CittaErr = "Città is required";
	} else {
		$Citta = test_input($_POST["Citta"]);
        $CittaErr="";
	}
  
	if (empty($_POST["Indirizzo"])) {
		$IndirizzoErr = "Name is required";
	} else {
		$Indirizzo = test_input($_POST["Indirizzo"]);
        $IndirizzoErr="";
	}
    
    if($NomeErr != NULL || $CognomeErr !=NULL || $EmailErr != NULL || $PasswordErr != NULL || $DataNascitaErr != NULL || $PaeseErr != NULL || $CittaErr != NULL || $IndirizzoErr != NULL){ ?>
        
        
        <form name="fr" action="register.php" method="POST">
            <input type="hidden" name="NomeErr" value="<?php echo $NomeErr;?>">
            <input type="hidden" name="CognomeErr" value="<?php echo $CognomeErr;?>">             
            <input type="hidden" name="EmailErr" value="<?php echo $EmailErr;?>"> 
            <input type="hidden" name="PasswordErr" value="<?php echo $PasswordErr;?>"> 
            <input type="hidden" name="DataNascitaErr" value="<?php echo $DataNascitaErr;?>"> 
            <input type="hidden" name="PaeseErr" value="<?php echo $PaeseErr;?>"> 
            <input type="hidden" name="CittaErr" value="<?php echo $CittaErr;?>"> 
            <input type="hidden" name="IndirizzoErr" value="<?php echo $IndirizzoErr;?>"> 
        </form>
        <script type='text/javascript'>
                document.fr.submit();
        </script>
        <?php
        
    }else{
        $query1="Select Email from utente where Email='$Email'";
        
        $query2 = "INSERT INTO utente (Nome, Cognome, Email, Password, DataNascita, Paese, Citta, Indirizzo) VALUES ('".$Nome."','".$Cognome."','".$Email."', '".MD5($Password)."', '".$DataNascita."', '".$Paese."', '".$Citta."', '".$Indirizzo."')";
  
      
        $result1=$conn->query($query1);
        if(!($result1->fetch_assoc())){
                
            $result2 = $conn->query($query2) // scrivo sul DB questi valori
                or die ("query di registrazione non riuscita".mysql_error()); // se la query fallisce mostrami questo errore
          
            if(isset($result2)){ //se la reg è andata a buon fine
                $mail_corpo .="Benevenuto su WebProject, $Nome. I Responsabili ti augurano tanti bei acquisti ;)\n\nAntonino Aiuto,\nAlessandro Magaddino.";
                if (mail($Email, $mail_oggetto, $mail_corpo, $mail_headers)){
                    echo "Messaggio inviato con successo a " . $Email;
                }else{
                    echo "Errore. Nessun messaggio inviato.";
                }
                
                $query3="SELECT * FROM utente WHERE Email='$Email' and Password='".MD5($Password)."' and SU='0'";
                if ($result3 = $conn->query($query3)){
                    $i=0;
                    while($row3 = $result3->fetch_assoc() ){
                        $i += 1;
                        
                        $name = $row3['Nome'];
                        $id = $row3['ID'];
                    }
                    if($i==1){
                        session_start();
                        $_SESSION["user_id"]= $id;
                        $_SESSION["username"]= $name;
                        $_SESSION["logged"] = true;
                        $query4="Select ID from carrello where IDUtente='$id' and Pagato='0'";
                        $query5="Insert Into carrello (IDUtente,Pagato,Totale) Values ('$id','0','0')";
                        $result=$conn->query($query4);
                        if($row=$result->fetch_assoc()<=0){
                            $result=$conn->query($query5);
                            $result=$conn->query($query4);
                            $row=$result->fetch_assoc();
                        }
                        $_SESSION["Carrello"]=$row['ID'];
                        $conn->close();
                    }
                }
                header("location:index.php");
            }else{
                echo "non ti sei registrato con successo"; // altrimenti esce scritta a video questa stringa
            }
            
        }else{ ?>
            
            <form name="fr2" action="register.php" method="POST">
                
                <input type="hidden" name="ExistingReg" value="<?php echo "Esiste già una registrazione con l'email: $Email";?>">
                
            </form>
            <script type='text/javascript'>
                    document.fr2.submit();
            </script>
        
        <?php
        }
    }
  
	
}
  
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>
</body>
</html>