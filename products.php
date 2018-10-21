<?php
//Recupero il valore del parametro IDProduct
$src = isset($_GET['Search']) ? $_GET['Search']: "";
$cat = isset($_GET['IDCategory']) ? $_GET['IDCategory']: "";
$type = isset($_GET['Type']) ? $_GET['Type']: "";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require ('head.php'); ?>
  </head>
<body>
<!-- Header Begin==================================================================== -->

<?php require ('header.php');?>

<!-- Header End====================================================================== -->
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	<?php require('sidebar.php'); ?>
<!-- Sidebar end=============================================== -->
	<div class="span9">
    <?php
        if($src==NULL){
            if ($cat==0){
                $query="select * from prodotto";
            }
            else{
                $query="select prodotto.*
                        from categoria_prodotto 
                        join tipo_prodotto
                        on tipo_prodotto.IDCategoria=categoria_prodotto.ID
                        join prodotto
                        on tipo_prodotto.ID=prodotto.IDTipo
                        where categoria_prodotto.ID=$cat
                        group by (IDTipo)";
            }           
        }else{
            if ($cat==0){
                $query="select * from prodotto where Nome like '$src%'";
            }
            else{
                $query="select prodotto.*
                        from categoria_prodotto 
                        join tipo_prodotto
                        on tipo_prodotto.IDCategoria=categoria_prodotto.ID
                        join prodotto
                        on tipo_prodotto.ID=prodotto.IDTipo
                        where prodotto.Nome like '$src%' and categoria_prodotto.ID=$cat
                        group by (IDTipo)";
            }
        }
        if($type!=null){
        $query="select * from prodotto where IDTipo='$type'";
        }
        $conta=0;
        $result=$conn->query($query);
        while($row=$result->fetch_assoc())
            $conta++;
    ?>
    <ul class="breadcrumb">
		<li><a href="index.php">Home</a> <span class="divider">/</span></li>
		<li class="active">Prodotti</li>
    </ul>
	<h3> <?php echo "Result for: " . $src; ?> <small class="pull-right"> <?php echo "Matching product found:" . $conta; ?> </small></h3>	
	<hr class="soft"/>
	<p>
		The result are reported below.
	</p>
	<hr class="soft"/>
	
	  

<br class="clr"/>

<div class="tab-content">
	<div>
        <?php
        $result=$conn->query($query);
        while($row=$result->fetch_assoc()){
        ?>
		<div class="row">	  
			<div class="span2">
				<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['FileImmagine']).'" alt=""/>';?>
			</div>
			<div class="span4">
				<h3><?php if($row['Disp']==0) echo "Unavailable"; else echo "Available";?></h3>				
				<hr class="soft"/>
				<h5><?php echo $row['Nome']?></h5>
				<p>
				<?php echo $row['BreveDescrizione']?>
				</p>
				<a class="btn btn-small pull-right" href="product_details.php?Product=<?php echo $row["ID"]; ?>">View Details</a>
				<br class="clr"/>
			</div>
			<div class="span3 alignR">
			<form method="post" action="add_to.php" class="form-horizontal qtyFrm">
			<h3>€ <?php echo $row["Prezzo"]; ?></h3>
			
            <input name="IDProduct" type="hidden" value="<?php echo $row['ID'];?>">
            <input name="Price" type="hidden" value="<?php echo $row['Prezzo'];?>">
            <span>Quantity </span>
            <input name="Number" type="number" min="0" max="<?php echo $row['Disp'];?>" class="span1" value="0"/>
            </br></br>
            <input type="submit" class="btn btn-large btn-primary pull-right" value="Add to cart">
			
			</form>
			</div>
		</div>			
		<hr class="soft"/>
        <?php } ?>
	</div>

	
</div>
			<br class="clr"/>
</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
	<?php require('footer.php'); ?>
</body>
</html>