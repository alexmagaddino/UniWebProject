<!DOCTYPE html>
<html>
<head></head>
<body>
<?php
require "connector.php";

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
  
	if (empty($_POST["Prezzo"])) {
		$PrezzoErr = "Price is required";
	} else {
		$Prezzo = test_input($_POST["Prezzo"]);
		// check if second name only contains letters and whitespace
		$PrezzoErr = "";
	}
  
	if (empty($_POST["Colore"])) {
		$ColoreErr = "Colore is required";
	} else {
		$Colore = test_input($_POST["Colore"]);
		$ColoreErr = "";  
	}
  
	if (empty($_POST["Disp"])) {
		$DispErr = "Quantita is required";
	} else {
		$Disp = test_input($_POST["Disp"]);
        $DispErr = "";
	}
    
	if (empty($_POST["BreveDesc"])) {
		$BreveDescErr = "A short descrition is required";
	} else {
		$BreveDesc = test_input($_POST["BreveDesc"]);
        $BreveDescErr="";
	}
  
    if(isset($_POST['upload']) && $_FILES['File']['size'] > 0){
        $fileName = $_FILES['File']['name'];
        $tmpName  = $_FILES['File']['tmp_name'];
        $fileSize = $_FILES['File']['size'];
        $fileType = $_FILES['File']['type'];

        $fp      = fopen($tmpName, 'r');
        $content = fread($fp, filesize($tmpName));
        $content = addslashes($content);
        fclose($fp);
        
        if(!get_magic_quotes_gpc()){
            $fileName = addslashes($fileName);
        }
        
        $FileErr = "";
    } else {
        $FileErr = "None source file specified";
    }	
  
    if(isset($_POST['upload']) && $_FILES['Immagine']['size'] > 0){
        $fileName = $_FILES['Immagine']['name'];
        $tmpName  = $_FILES['Immagine']['tmp_name'];
        $fileSize = $_FILES['Immagine']['size'];
        $fileType = $_FILES['Immagine']['type'];

        $fp      = fopen($tmpName, 'r');
        $content2 = fread($fp, filesize($tmpName));
        $content2 = addslashes($content2);
        fclose($fp);
        
        if(!get_magic_quotes_gpc()){
            $fileName = addslashes($fileName);
        }
        
        $ImmagineErr = "";
    } else {
        $ImmagineErr = "None source file specified";
    }	
	
	if (empty($_POST["IDTipo"])) {
		$IDTipoErr = "A type need to be specified";
	} else {
		$IDTipo = $_POST["IDTipo"];
        $IDTipoErr="";
	}
    
    if($NomeErr != NULL || $PrezzoErr !=NULL || $ColoreErr != NULL || $DispErr != NULL || $BreveDescErr != NULL || $FileErr != NULL || $ImmagineErr != NULL || $IDTipoErr != NULL){ ?>
        
        <form action="admin.php" name="fr" method="POST">
            <input type="hidden" name="NomeErr" value="<?php echo $NomeErr;?>">
            <input type="hidden" name="PrezzoErr" value="<?php echo $PrezzoErr;?>">             
            <input type="hidden" name="ColoreErr" value="<?php echo $ColoreErr;?>"> 
            <input type="hidden" name="DispErr" value="<?php echo $DispErr;?>"> 
            <input type="hidden" name="BreveDescErr" value="<?php echo $BreveDescErr;?>">
            <input type="hidden" name="FileErr" value="<?php echo $FileErr;?>"> 
			<input type="hidden" name="ImmagineErr" value="<?php echo $ImmagineErr;?>"> 
            <input type="hidden" name="IDTipoErr" value="<?php echo $IDTipoErr;?>"> 
            <input type="hidden" name="ShowMenu" value="1"> 
        </form>
        <script type='text/javascript'>
                document.fr.submit();
        </script>
        <?php
        
    }else{
                
        $query = "INSERT INTO prodotto (Nome, Prezzo, Colore, Disp, BreveDescrizione, FileDescrizione, FileImmagine, IDTipo) VALUES ('".$Nome."','".$Prezzo."','".$Colore."', '".$Disp."', '".$BreveDesc."', '".$content."','".$content2."','".$IDTipo."')";
  
      	$result = $conn->query($query) // scrivo sul DB questi valori
			or die ("query di registrazione non riuscita".mysql_error()); // se la query fallisce mostrami questo errore
	  
		if(isset($result)){ //se la reg è andata a buon fine
			?>
            <form action="admin.php" name="fr2" method="POST"> 
                <input type="hidden" name="Message" value="L'inserimento è andato a buon fine!!"> 
            </form>
            
            <script type='text/javascript'>
                document.fr2.submit();
            </script>
            <?php
		}else{
			?>
            <form action="admin.php" name="fr3" method="POST"> 
                <input type="hidden" name="Message" value="L'inserimento NON è andato a buon fine. RIPROVA!!"> 
            </form>
            
            <script type='text/javascript'>
                document.fr3.submit();
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