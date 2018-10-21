<!DOCTYPE html>
<html>
<head></head>
<body>
<?php
require "connector.php";

$IDProd=isset($_POST['IDProd']) ? $_POST['IDProd'] : "";
                
$query = "Delete From prodotto Where ID='$IDProd';";

$result = $conn->query($query) // scrivo sul DB questi valori
    or die ("query di registrazione non riuscita".mysql_error()); // se la query fallisce mostrami questo errore

if(isset($result)){ //se la query è andata a buon fine
    ?>
    <form action="admin.php" name="fr2" method="POST"> 
        <input type="hidden" name="Message" value="L'eliminazione è andata a buon fine!!"> 
    </form>
    
    <script type='text/javascript'>
        document.fr2.submit();
    </script>
    <?php
}else{
    ?>
    <form action="admin.php" name="fr3" method="POST"> 
        <input type="hidden" name="Message" value="L'eliminazione NON è andata a buon fine. RIPROVA!!"> 
    </form>
    
    <script type='text/javascript'>
        document.fr3.submit();
    </script>
    <?php   
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