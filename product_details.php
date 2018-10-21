<?php 

//Recupero il valore del parametro IDProduct
$IDPro = $_GET['Product'];
?>

<!DOCTYPE html>
<html lang="en">

 <head>
  
  <?php require('head.php'); ?>

</head> 

<body>
<!-- Header Begin====================================================================== -->

<?php require('header.php') ?>

<!-- Header End====================================================================== -->
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	<?php require ('sidebar.php')?>
<!-- Sidebar end=============================================== -->

	<div class="span9">
    <ul class="breadcrumb">
    <li><a href="index.php">Home</a> <span class="divider">/</span></li>
    <li><a href="products.php">Products</a> <span class="divider">/</span></li>
    <li class="active">product Details</li>
    </ul>
    <!--Phpiamo-->
            <?php
            $result=$conn->query("Select * From Prodotto where ID=".$IDPro);
            while($row=$result->fetch_assoc()){
            ?>
	<div class="row">	  
			<div id="gallery" class="span3">
            <a href=<?php echo '"data:image/jpeg;base64,'.base64_encode($row['FileImmagine']).'"';?> title="<?php echo $row['Nome'];?>">
				<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['FileImmagine']).'" alt=""/>';?>
            </a>
			
			</div>
            
			<div class="span6">
				<h3><?php echo $row['Nome'];?></h3>
				<small>- <?php echo $row['BreveDescrizione'];?></small>
				<hr class="soft"/>
				<form method="post" action="add_to.php" class="form-horizontal qtyFrm">
				  <div method="post" action="add_to.php" class="control-group">
					<label class="control-label"><span>€ <?php echo $row['Prezzo'];?></span></label>
					<div class="controls">
                        <input name="IDProduct" type="hidden" value="<?php echo $row['ID'];?>">
                        <input name="Price" type="hidden" value="<?php echo $row['Prezzo'];?>">
                        <input name="Number" type="number" min="0" max="<?php echo $row['Disp'];?>" class="span1" placeholder="Q.ty"/>
                        <input type="submit" class="btn btn-large btn-primary pull-right" value="Add to cart">
					</div>
				  </div>
				</form>
                <hr class="soft"/>
				<h4><?php echo $row['Disp']; ?> items in stock</h4>
				<p>Color: <?php echo $row['Colore'];?> </p>
				<hr class="soft clr"/>
				<p>
                <?php
                echo($row['FileDescrizione']);
                ?>
				</p>
			</div>
			
			

	</div>
    <?php } ?>
</div>
</div> </div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
	<?php require ('footer.php');?>
</body>
</html>