<form name="update-form" action="update_product.php" method="post" enctype="multipart/form-data">
    
    <?php 
    require "connector.php";
      
    $IDProd=isset($_POST['IDProd']) ? $_POST['IDProd'] : "";
    $result=$conn->query("Select * from prodotto where ID='$IDProd'");
    $row=$result->fetch_assoc();    
    ?>
    <div>
    <table>
            <tr>
            <td>
                <h6>Prezzo</h6>
                <p>Prezzo attuale:</p>
                <p class="important">€ <?php echo $row['Prezzo'];?></p>
                <p>Inserisci nuovo prezzo </p>
                <div class="">
                  <input type='text' name='Prezzo' id='Prezzo'>
                </div>
            </td>
            
            <td>    
                <h6>Quantità</h6>
                <p>Q.tà attuale:</p>
                <p class="important"> <?php echo $row['Disp'];?></p>
                <p>Aggiungi nuova quantita'</p>
                <div class="">
                  <input type='number' name='Disp' id='Disp'>
                </div>
            </td>
                
            <td>
                <h6>Breve Descrizione</h6>
                <p>Attuale Breve Descrizione:</p>
                <p class="important"><?php echo $row['BreveDescrizione'];?></p>
                <p>Inserisci la nuova breve descrizione </p>
                <div class="">
                  <input type='text' name='BreveDesc' id='BreveDesc'>
                </div>
            </td>          
            
            <td>
                <h6>Immagine</h6>
                <p>Attuale Immagine:</p>
                <div><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['FileImmagine']).'" alt=""/>';?></div>
                <p>Inserisci file della nuova immagine</p>
                <div class="">            
                    <input type='file' name='Immagine' id='Immagine'>
                </div>
            </td> 
            </tr>
            </table>
            
            <div> 
                <h6>File di descrizione</h6>
                <p>Attuale file di Descrizione:</p>
                <div><p class="important"><?php echo $row['FileDescrizione']; ?></p></div>
                <p>Inserisci nuovo file descrizione</p>
                <div class="">            
                    <input type='file' name='File' id='File'>
                </div>
            </div>
            </br> 
            
            <div>
                <input type="hidden" name="IDProd" id="IDProd" value="<?php echo $row['ID'] ?>">
            </div>
            
            <div class="">
              <input type="submit" name="update" value="Modifica" class="bottone">
            </div>
            
    
   </div>
</form>