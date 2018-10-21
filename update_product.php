<!DOCTYPE html>
<html>
<head></head>
<body>
<?php
require "connector.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $IDProd=isset($_POST['IDProd']) ? $_POST['IDProd'] : "";

	$Prezzo=isset($_POST["Prezzo"]) ? test_input($_POST["Prezzo"]): "";
	$Disp=isset($_POST["Disp"]) ? test_input($_POST["Disp"]): "";
	$BreveDesc=isset($_POST["BreveDesc"]) ? test_input($_POST["BreveDesc"]): "";
	$content="";
	$content2="";
  
    if(isset($_POST['update']) && $_FILES['File']['size'] > 0){
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
    }	
  
    if(isset($_POST['update']) && $_FILES['Immagine']['size'] > 0){
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
	}
    
    if($Prezzo !=NULL || $Disp != NULL || $BreveDesc != NULL || $content != NULL || $content2 != NULL){ 
                
        $query = "Update prodotto Set ";
        if($Prezzo!=NULL){
            $query=$query." Prezzo='$Prezzo',";
        }
        if($Disp!=NULL){
            $query=$query." Disp='$Disp',";
        }
        if($BreveDesc!=NULL){
            $query=$query." BreveDescrizione='$BreveDesc',";
        }
        if($content!=NULL){
            $query=$query." FileDescrizione='$content',";
        }
        if($content2!=NULL){
            $query=$query." FileImmagine='$content2',";
        }
        $query=substr($query, 0, strlen($query)-1);
        
        $query=$query." Where ID='$IDProd'";
              
      	$result = $conn->query($query) // scrivo sul DB questi valori
			or die ("query di registrazione non riuscita".mysql_error()); // se la query fallisce mostrami questo errore
	  
		if($result){ //se la query è andata a buon fine
			?>
            <form action="admin.php" name="fr2" method="POST"> 
                <input type="hidden" name="Message" value="L'aggiornamento è andato a buon fine!!"> 
            </form>
            
            <script type='text/javascript'>
                document.fr2.submit();
            </script>
            <?php
		}else{
			?>
            <form action="admin.php" name="fr3" method="POST"> 
                <input type="hidden" name="Message" value="L'aggiornamento NON è andato a buon fine. RIPROVA!!"> 
            </form>
            
            <script type='text/javascript'>
                document.fr3.submit();
            </script>
            <?php
		}        
    }else{
        header("location:admin.php");
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