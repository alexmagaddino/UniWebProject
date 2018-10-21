<?php
require ('connector.php');
$EmailErr=isset($_POST['EmailErr']) ? $_POST['EmailErr']:"";
$PasswordErr=isset($_POST['PasswordErr']) ? $_POST['PasswordErr']:"";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require('head.php'); ?>
  </head>
<body>

<!-- Header Begin====================================================================== -->
<?php require ('header.php'); ?>
<!-- Header End======================================================================== -->

<div id="mainBody">
	<div class="container">
	<div class="row">
    
<!-- Sidebar ================================================== -->
	<?php require ('sidebar.php'); ?>
<!-- Sidebar end=============================================== -->

	<?php
    $query="Select count(ID) as conta from prodotti_carrello where IDCarrello='$cart'";
    if($result=$conn->query($query)){
        $row=$result->fetch_assoc();
    }
    ?>
    
    <div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.php">Home</a> <span class="divider">/</span></li>
		<li class="active"> SHOPPING CART</li>
    </ul>
	<h3>  SHOPPING CART [ <small><?php echo $row['conta'];?> Item(s) </small>]<a href="products.php" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
	<hr class="soft"/>
    <?php if(!$logged){ ?>
	<table class="table table-bordered">
		<tr><th> I AM ALREADY REGISTERED  </th></tr>
		 <tr> 
		 <td>
			<form action="check_login.php" method="post" class="form-horizontal">
				<div class="control-group">
				  <label class="control-label" for="inputUsername">Email</label>
				  <div class="controls">
					<input type="text" name="Email" placeholder="Email">
                    <div class="<?php if($EmailErr!=NULL) echo "alert alert-block alert-error fade in";?>"><?php echo $EmailErr; ?></div> 
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="inputPassword1">Password</label>
				  <div class="controls">
					<input type="password" name="Password" placeholder="Password">
                    <div class="<?php if($PasswordErr!=NULL) echo "alert alert-block alert-error fade in";?>"><?php echo $PasswordErr; ?></div>
				  </div>
				</div>
				<div class="control-group">
				  <div class="controls">
					<button type="submit" class="btn">Sign in</button> OR <a href="register.php" class="btn">Register Now!</a>
				  </div>
				</div>
			</form>
		  </td>
		  </tr>
	</table>		
	<?php } ?>	
	<table class="table table-bordered">
             <?php
                $query2="Select Totale From carrello Where ID='$IDCarrello'";
                $result2=$conn->query($query2);
                $row2=$result2->fetch_assoc();
                if($row2['Totale']>0){
             ?>
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Description</th>
                  <th>Quantity/Update</th>
				  <th>Price</th>
                  <th>IVA</th>
                  <th>Total</th>
				</tr>
              </thead>
                <?php }?>
              <tbody>
			  
				<?php
				$query3="Select * from prodotti_carrello where IDCarrello='$cart'";
				if($result3=$conn->query($query3)){
					$i=0;
					while($row3=$result3->fetch_assoc()){
						$IDProdotto[$i] = $row3["IDProdotto"];
						$Quantita[$i] = $row3["Quantita"];
						$Prezzo[$i] = $row3["Prezzo"];
						$i++;
					}
				}
				$i=0;
				while($i!=$row["conta"]){
					$query4="Select * from prodotto where ID='$IDProdotto[$i]'";
					if($result4=$conn->query($query4)){
						$row4=$result4->fetch_assoc();
						$Immagine[$i] = $row4["FileImmagine"];
						$Descrizione[$i] = $row4["BreveDescrizione"];
                        $Disp[$i]=$row4['Disp'];
						$i++;
					}
				}
				?>
                <tr>
				<?php
				$i=0;
				$j=0;
				$p=0;
				while($p!=$row["conta"]){
				?>
				
					  <td> <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($Immagine[$j]).'" alt=""/>';?> </td>
					  <td> <?php echo $Descrizione[$j];?> </td>
					  <td>
						<div class="input-append">
                            <form action="update_cart.php" method="post">
                                <input class="span1" style="max-width:34px" value= <?php echo $Quantita[$i];?> id="appendedInputButtons" size="16" type="text">
                                <input type="hidden" name="IDProdotto" value="<?php echo $IDProdotto[$i];?>">
                                <input type="hidden" name="Prezzo" value="<?php echo $Prezzo[$i];?>">
                                <input type="hidden" name="Quantita" value="<?php echo $Quantita[$i];?>">
                                <input type="submit" class="btn" value="-" style="font-size:28px" name="minus">
                                <input type="submit" class="btn" value="+" style="font-size:28px" name="plus">
                                <input type="submit" class="btn btn-danger" value="x" style="font-size:28px" name="delete">
                            </form>
                        </div>
					  </td>
					  <td>€ <?php echo $Prezzo[$i];?></td>
					  <td>included</td>
					  <td>€ <?php echo $Prezzo[$i] * $Quantita[$j];?> </td>
					</tr>
				
					<?php 
					$i++; 
					$j++; 
					$p++;
				} 
                $query5="select Totale from carrello where ID='$cart'";
                if($result5=$conn->query($query5)){
                $row5=$result5->fetch_assoc();
                }
                if($row5["Totale"]!=0){
				?>
				
                    <tr>
                        <td colspan="6" style="text-align:right">Total Price:	</td>
                        
                      
                        <td> € <?php echo $row5["Totale"];?> </td>
                    </tr>
                    <tr>
                      <td colspan="6" style="text-align:right">Spedition:	</td>
                      <td> $18.00</td>
                    </tr>
                    <tr>
                      <td colspan="6" style="text-align:right"><strong>TOTAL (€ <?php echo $row5["Totale"];?> + €18) =</strong></td>
                      <td class="label label-important" style="display:block"> <strong> € <?php echo $row5["Totale"] + 18;?> </strong></td>
                    </tr>
                
                <?php } ?>
                
				</tbody>
            </table>
                <?php
                $query6="Select Totale From carrello Where ID='$IDCarrello'";
                $result6=$conn->query($query6);
                $row6=$result6->fetch_assoc();
                if($row6['Totale']>0){
                ?>
                <div style="padding:10px;text-align:right">
                    <form action="<?php if($row6['Totale']>0) echo "https://www.sandbox.paypal.com/cgi-bin/webscr";?>" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="business" value="GM7YSE885TYPW">
                        <input type="hidden" name="lc" value="IT">
                        <input type="hidden" name="item_name" value="WebProject">
                        <input type="hidden" name="amount" value="<?php echo $row6['Totale']?>">
                        <input type="hidden" name="currency_code" value="EUR">
                        <input type="hidden" name="button_subtype" value="services">
                        <input type="hidden" name="no_note" value="1">
                        <input type="hidden" name="no_shipping" value="2">
                        <input type="hidden" name="rm" value="1">
                        <input type="hidden" name="return" value="http://localhost/WebProject/paid.php">
                        <input type="hidden" name="cancel_return" value="http://localhost/WebProject/">
                        <input type="hidden" name="shipping" value="18.00">
                        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
                        <input type="image" src="https://www.sandbox.paypal.com/it_IT/IT/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal è il metodo rapido e sicuro per pagare e farsi pagare online.">
                        <img alt="" border="0" src="https://www.sandbox.paypal.com/it_IT/i/scr/pixel.gif" width="1" height="1">
                    </form>  
                </div>
             <?php }?>
	<a href="products.php" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
	
    <?php
        $result7=$conn->query("Select count(ID) as righe From carrello Where IDUtente='$user_id' and Pagato='1'");
        $row7=$result7->fetch_assoc();
        if($row7['righe']>0){
    ?>
    <div>
    <h3>Orders History</h3>
    <table class="table table-bordered">
              <thead>
                <tr>
                  <th>DataCreazione</td>
                  <th>Prodotti in carrello</th>
                  <th>Total</th>
				</tr>
              </thead>
              <tbody>
			  
				<?php
				$query8="Select * from carrello where IDUtente='$user_id' and Pagato='1'";
				if($result8=$conn->query($query8)){
					$i=0;
					while($row8=$result8->fetch_assoc()){
						$ID[$i] = $row8["ID"];
						$DataCreazione[$i] = $row8["DataCreazione"];
						$Totale[$i] = $row8["Totale"];
						$i++;
					}
				}
				
				?>
                <tr>
                    <?php
                    $j=0;
                    while($j<$i){
                    ?>
				
					  <td><?php echo $DataCreazione[$j];?></td>
					  <td>
                      <ul>
                      <?php
                      
                          $query9="Select prodotto.Nome as Nome, prodotti_carrello.Prezzo as Prezzo, prodotti_carrello.Quantita as Quantita from prodotto
                          join prodotti_carrello 
                          on prodotti_carrello.IDProdotto=prodotto.ID
                          where prodotti_carrello.IDCarrello='$ID[$j]'";
                          $result9=$conn->query($query9);
                          while($row9=$result9->fetch_assoc()){
                            echo "<li>Prodotto: ".$row9['Nome']." - Prezzo: ".$row9['Prezzo']." - Quantità: ".$row9['Quantita']."</li>" ;
                          }
                      ?>    
                      </ul>
                      </td>
					  <td><?php echo $Totale[$j];?></td>
					  
					  
				</tr>
				
					
                    <?php $j++; } ?>
                
                               
				</tbody>
            </table>
    
    </div>
    <?php } ?>    
        
</div>
</div></div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
    <?php require('footer.php'); ?>
</body>
</html>