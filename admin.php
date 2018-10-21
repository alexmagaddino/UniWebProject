<?php
    session_start();
    require "connector.php";   
    
    $msg=isset($_POST['Message']) ? $_POST['Message'] : ""; 
    $showMenu=isset($_POST['ShowMenu']) ? $_POST['ShowMenu'] : "0";
    $Admin=isset($_SESSION['admin']) ? $_SESSION['admin'] : false; 
    if($Admin==true){
?>
    

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap/Stile_admin.css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

</head>


<body>

<script type="text/javascript" src="js/jquery/jquery-1.7.2.min.js"></script>

<?php if($msg!=NULL){?>
    <script type="text/javascript">
        window.alert("<?php echo $msg; ?>");
    </script>
<?php } ?>

<div id="Logout">
    <form action="logout.php" method="post">
			<input type="submit" name="Logout" class="bottone" value="Logout">
    </form>
</div>

<ul class="tab">

    <li><a id="add" href="#" class="tablinks" onclick="openMenu(event, 'nuovi-prodotti')">Inserisci nuovi prodotti</a></li>
    <li><a href="#" class="tablinks" onclick="openMenu(event, 'aggiorna-prodotti')">Aggiorna prodotti</a></li>
    <li><a href="#" class="tablinks" onclick="openMenu(event, 'elimina-prodotti')">Elimina prodotti</a></li>
    <li><a href="#" class="tablinks" onclick="openMenu(event, 'visualizza-utenti')">Utenti</a></li>
    <li><a href="#" class="tablinks" onclick="openMenu(event, 'visualizza-carrelli')">Ordini</a></li>

</ul>

<?php if($showMenu==1){?>
    <script type="text/javascript">
        window.alert("Non tutti i campi sono stati riempiti correttamente!");
    </script>
<?php } ?>

<div id="nuovi-prodotti" class="tabcontent">
<?php
    $NomeErr=isset($_POST['NomeErr']) ? $_POST['NomeErr'] : "";
    $PrezzoErr=isset($_POST['PrezzoErr']) ? $_POST['PrezzoErr'] : "";
    $ColoreErr=isset($_POST['ColoreErr']) ? $_POST['ColoreErr'] : "";
    $DispErr=isset($_POST['DispErr']) ? $_POST['DispErr'] : "";
    $BreveDescErr=isset($_POST['BreveDescErr']) ? $_POST['BreveDescErr'] : "";
    $FileErr=isset($_POST['FileErr']) ? $_POST['FileErr'] : "";
    $ImmagineErr=isset($_POST['ImmagineErr']) ? $_POST['ImmagineErr'] : "";
    $IDTipoErr=isset($_POST['IDTipoErr']) ? $_POST['IDTipoErr'] : "";  
?>

  <form action="insert_product.php" method="post" enctype="multipart/form-data">
        <h4>Inserisci i dati del nuovo prodotto da inserire</h4>
        <table>
            <tr>
                <td>
                    <div class="">
                        <label for="inputNomeProdotto">Nome prodotto </label>
                        <div class="controls">
                          <input type="text" name="Nome" id="Nome">
                          <span class="<?php if($NomeErr!=NULL) echo "alert-error";?>"><?php echo $NomeErr; ?></span>
                        </div>
                    </div>
                </td>
                
                <td>                
                    <div class="">
                        <label for="inputPrezzoProdotto">Prezzo </label>
                        <div class="controls">
                          <input type="text" name="Prezzo" id="Prezzo">
                          <span class="<?php if($PrezzoErr!=NULL) echo "alert-error";?>"><?php echo $PrezzoErr; ?></span>
                        </div>
                    </div>
                </td>
                
                <td>
                    <div class="">
                        <label for="inputColoreProdotto">Colore </label>
                        <div class="controls">
                          <input type="text" name="Colore" id="Colore">
                          <span class="<?php if($ColoreErr!=NULL) echo "alert-error";?>"><?php echo $ColoreErr; ?></span>
                        </div>
                    </div>
                </td>
                
                <td>
                    <div class="">
                        <label for="inputDispProdotto">Quantita' </label>
                        <div class="controls">
                          <input type="number" name="Disp" id="Disp">
                          <span class="<?php if($DispErr!=NULL) echo "alert-error";?>"><?php echo $DispErr; ?></span>
                        </div>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td>
                    <div class="">
                        <label for="inputBreveDescProdotto">Breve Descrizione </label>
                        <div class="controls">
                          <input type="text" name="BreveDesc" id="BreveDesc">
                          <span class="<?php if($BreveDescErr!=NULL) echo "alert-error";?>"><?php echo $BreveDescErr; ?></span>
                        </div>
                    </div>
                </td>
           
                <td>
                    <div class="">
                        <label for="inputDescProdotto">Nome file di Descrizione prodotto</label></br></br> 
                        <div class="controls">            
                            <input type="file" name="File" id="File">
                            <span class="<?php if($FileErr!=NULL) echo "alert-error";?>"><?php echo $FileErr; ?></span>
                        </div>
                    </div>
                </td>
                    
                <td>    
                    <div class="">
                        <label for="inputImageProdotto">Nome file imagine del prodotto</label></br></br> 
                        <div class="controls">            
                            <input type="file" name="Immagine" id="Immagine">
                            <span class="<?php if($ImmagineErr!=NULL) echo "alert-error";?>"><?php echo $ImmagineErr; ?></span>
                        </div>
                    </div>
                </td>
                
                <td>
                    <div class="">
                        <label for="inputTipoProdotto">Tipo Prodotto</label>
                        <div class="controls">
                        
                          <select name="IDTipo" id="IDTipo">
                           <option value="0">-</option>
                            <?php
                            $result=$conn->query("Select * from tipo_prodotto");
                            while($row=$result->fetch_assoc()){                        
                            ?>
                            <option value="<?php echo $row['ID'];?>"><?php echo $row['ID'].": ".$row['Nome'];?></option>
                            <?php } ?>
                          </select>
                          
                          <span class="<?php if($IDTipoErr!=NULL) echo "alert-error";?>"><?php echo $IDTipoErr; ?></span>
                        </div>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td>
                    <div class="">
                        <div class="controls">
                          <input id="upload" name="upload" type="submit" value="Inserisci" class="bottone">
                        </div>
                    </div>
                </td>
            </tr>
        </table>     
                
    </form>
</div>

<div id="aggiorna-prodotti" class="tabcontent">

    <h4>Seleziona il prodotto da aggiornare</h4>
    <div>
    <form>
        <select name="selProd" id="selProd">
            <option value="0">-</option>
            
            <?php
            $result=$conn->query("Select ID, Nome from prodotto");
            while($row=$result->fetch_assoc()){ ?>
                    
            <option value="<?php  echo $row['ID'];?>"><?php  echo $row['ID'].":  "; echo $row['Nome'];?></option>
            
            <?php } ?>
        </select>
    </form>
    </div>
    
    
    
    <div id="update-form" >
    
    
    </div>
    
</div>

<div id="elimina-prodotti" class="tabcontent">

<h4>Seleziona il prodotto da eliminare</h4>
    <div>
    <form>
        <select name="selProd2" id="selProd2">
            <option value="0">-</option>
            
            <?php
            $result=$conn->query("Select ID, Nome from prodotto");
            while($row=$result->fetch_assoc()){ ?>
                    
            <option value="<?php  echo $row['ID'];?>"><?php  echo $row['ID'].":  "; echo $row['Nome'];?></option>
            
            <?php } ?>
        </select>
    </form>
    </div>

    <div id="delete-form" >
    
    
    </div>
    
</div>

<div id="visualizza-utenti" class="tabcontent">

<h4>Utenti</h4>
    <div id="see-users" >
		<table>
			<tr>
				<th class="user-cart">ID</th>
				<th class="user-cart">Nome</th>
				<th class="user-cart">Cognome</th>
				<th class="user-cart">Email</th>
				<th class="user-cart">Data Nascita</th>
				<th class="user-cart">Indirizzo</th>
				<th class="user-cart">Città</th>
				<th class="user-cart">Paese</th>
			</tr>
			<?php
			$result=$conn->query("Select * from utente Where SU='0'");
			while($row=$result->fetch_assoc()){ ?>	
				<tr>
					<form name="utenti" action="block_users.php" method="post">
							<td class="user-cart"><?php echo $row['ID'];?></td>
							<td class="user-cart"><?php echo $row['Nome'];?></td>
							<td class="user-cart"><?php echo $row['Cognome'];?></td>
							<td class="user-cart"><?php echo $row['Email'];?></td>
							<td class="user-cart"><?php echo $row['DataNascita'];?></td>
							<td class="user-cart"><?php echo $row['Indirizzo'];?></td>
							<td class="user-cart"><?php echo $row['Citta'];?></td>
							<td class="user-cart"><?php echo $row['Paese'];?></td>
							<td class="user-cart"><input type="submit" name="block" value="<?php if($row['Bloccato']==0) echo "Blocca"; else echo "Sblocca";?>" class="bottone-piccolo"></td>
			
						<input type="hidden" name="IDUtente" id="IDUtente" value="<?php echo $row['ID'] ?>">
					</form>
				</tr>
			<?php } ?>
		</table>
    </div>
</div>


<div id="visualizza-carrelli" class="tabcontent">

<h4>Ordini</h4>
    <div id="see-carts" >
		<table>
			<tr>
				<th class="user-cart">ID</th>
				<th class="user-cart">DataCreazione</th>
				<th class="user-cart">IDUtente</th>
				<th class="user-cart">Contenuto</th>
				<th class="user-cart">Totale</th>
			</tr>
			<?php
				$result1=$conn->query("Select * from carrello where Pagato='1'");
				while($row1=$result1->fetch_assoc()){?>
					<tr> 
						<form name="carrelli" action="delete_carts.php" method="post">
							<td class="user-cart"><?php echo $row1['ID'];?></td> <?php $ID = $row1['ID'];?>
							<td class="user-cart"><?php echo $row1['DataCreazione'];?></td>
							<td class="user-cart"><?php echo $row1['IDUtente'];?></td>
							<td class="user-cart">
								<select>
									<option>Visualizza carrello</option>
										<?php
										$result2=$conn->query("select prodotto.Nome, prodotti_carrello.Prezzo, prodotti_carrello.Quantita from prodotto join prodotti_carrello on prodotti_carrello.IDProdotto=prodotto.ID where prodotti_carrello.IDCarrello='$ID'");
										while($row2=$result2->fetch_assoc()){ ?>
											<option> <?php  echo "Nome: ".$row2['Nome']. " - Prezzo: ".$row2['Prezzo']." - Quantità: "; echo $row2['Quantita'];?></option>
										<?php } ?>
								</select>
							</td>
							<td class="user-cart"><?php echo "€ ".$row1['Totale'];?></td>
							<td class="user-cart"><input type="submit" name="delete" value="Elimina" class="bottone-piccolo"></td>
							
							<input type="hidden" name="IDCarrello" id="IDCarrello" value="<?php echo $row1['ID'] ?>">
						</form>
					</tr>
			<?php } ?>
		</table>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){    
    
    $("#selProd").change(function(){
       var idProd;
       idProd=$(this).val();
       if(idProd!=0){
            $("#update-form").css("display","block");
       }
       else{
           $("#update-form").css("display","block");
       }
      $("#update-form").load("update_form.php", {"IDProd":idProd});
        
    });   
    
    $("#selProd2").change(function(){
        var idProd;
        idProd=$(this).val();
        if(idProd!=0){
            $("#delete-form").css("display","block");
        }else{
            $("#delete-form").css("display","none");
        }
        $("#delete-form").load("delete_form.php",{"IDProd":idProd});
    });
});
</script>

<script type="text/javascript">

function openMenu(evt, Menu) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(Menu).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
<?php 
}else{
?>
    <script type="text/javascript">
        window.alert("Ops non hai i requisiti per entrare qui!");
    </script>
    
    <form action="login_admin.php" name="frErr" method="POST">  
    </form>
            
    <script type='text/javascript'>
        document.frErr.submit();
    </script>
<?php } ?> 
</body>
</html>