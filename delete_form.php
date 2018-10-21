<form name="delete-form" action="delete_product.php" method="post">
    
    <?php 
    require "connector.php";
    $IDProd=isset($_POST['IDProd']) ? $_POST['IDProd'] : "";
    $result=$conn->query("Select * from prodotto where ID='$IDProd'");
    $row=$result->fetch_assoc();    
    ?>
    
    <div class="">
        <table>
        <tr>
            <td>Prezzo:<p class="important">€ <?php echo $row['Prezzo'];?></p></td>
            <td>Quantita:<p class="important"> <?php echo $row['Disp'];?></p></td>
            <td>Breve Descrizione:<p class="important"> <?php echo $row['BreveDescrizione'];?></p></td>
            <td>Immagine: <div></br> <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['FileImmagine']).'" alt=""/>';?></div></td>
        </tr>
        </table>
    </div>
   
   <div class="">
        <div class="">
            <input type="hidden" name="IDProd" id="IDProd" value="<?php echo $row['ID'] ?>">
            <input type="submit" name="delete" value="Elimina" class="bottone">
        </div>
   </div>
    
</form>