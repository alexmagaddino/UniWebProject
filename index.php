<!DOCTYPE html>
<html lang="en">

<head>
  
<?php require('head.php'); ?>

</head> 
   
<body>
<!-- Header Begin==================================================================== -->

<?php require('header.php') ?>

<!-- Header End====================================================================== -->
<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
		  <?php
          $i=1;
          while($i!=7){
          ?>
          
          <div class="item <?php if($i==1) echo "active";?>">
		  <div class="container">
			<a href="<?php if($logged) echo "index.php"; else echo "register.php";?>"><img style="width:100%" src="themes/images/carousel/<?php echo $i;?>.png" alt="special offers"/></a>
			<div class="carousel-caption">
				  <h4>Second Thumbnail label</h4>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				</div>
		  </div>
		  </div>
		  
          <?php $i++;} ?>
          
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	  </div> 
</div>
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
    <?php require('sidebar.php'); ?>	
<!-- Sidebar end=============================================== -->
		 
		<div class="span9">	
        
			<div class="well well-small">
			<h4>Latest Products</h4>
			<div class="row-fluid">
			<div id="featured" class="carousel slide">
	
            <div class="carousel-inner">
			  <?php   
                    $result2=($conn->query("Select count(ID) as conta from prodotto"));
                    $row2=$result2->fetch_assoc();
                    $i=$row2['conta'];
                    $resto=$i%4;
                    $newbar=0;
                    if($resto!=0) $newbar=1;
                    $i=((int) ($i/4)) + $newbar;
                    $active=1;
                    $result=$conn->query("Select * from prodotto where ID between ((select max(ID) from prodotto)-15) and (select max(ID) from prodotto)");
                    while($i>0){ 
                ?>
             
              <div class=<?php if($active==1) echo "item active"; else echo "item";?>>
			  <ul class="thumbnails">
              <?php 
                    for($x=0;$x<4;$x++){ 
                        $row=$result->fetch_assoc();
                        if ($row!=NULL){
                    ?>
				<li class="span3">
               
                
                  <div class="thumbnail">
				  <i class="tag"></i>
                  
                    
					<a href="product_details.php?Product=<?php echo $row["ID"]; ?>"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['FileImmagine']).'" alt=""/>';?></a>
					<div class="caption">
					  <h5><?php echo $row["Nome"]; ?></h5>
					  <h4><a class="btn" href="product_details.php?Product=<?php echo $row["ID"]; ?>">VIEW</a> <span class="pull-right">€ <?php echo $row["Prezzo"]; ?></span></h4>
					</div>
                    
                    
				  </div>
                  
                  
                </li>
                <?php } } ?>
                </ul>
			  </div>
              <?php  $i--; $active=0; } ?>
              
			  </div>
			  <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
			  <a class="right carousel-control" href="#featured" data-slide="next">›</a>
			  </div>
			  </div>
            </div>
		
        
        
        <!-- Parte inferione con i latest Products-->
              
		<h4>Other Products </h4>
         
			    <ul class="thumbnails">
				
				<?php
                $result = $conn->query("SELECT * from prodotto limit 12");
                while ($row = $result->fetch_assoc()) { 
                ?>
				
				
				<li class="span3">
				  <div class="thumbnail">
					<a  href="product_details.php?Product=<?php echo $row["ID"]; ?>"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['FileImmagine']).'" alt=""/>';?></a>
					<div class="caption">
					  <h5><?php echo $row["Nome"];?></h5>
					  <p> 
						<?php echo $row["BreveDescrizione"];?>
					  </p>
					  <h4 style="text-align:center">
                           
                          <form action="add_to.php" method="post">
                          <input name="IDProduct" type="hidden" value="<?php echo $row['ID'];?>">
                            <input name="Price" type="hidden" value="<?php echo $row['Prezzo'];?>">
                            <input name="Number" type="hidden" value="1"/>
                            <a class="btn" href="product_details.php?Product=<?php echo $row["ID"]; ?>"> <i class="icon-zoom-in"></i></a>
                            <input type="submit" class="btn" value="Add to Cart">
                            <a class="btn btn-primary"><?php echo $row["Prezzo"];?></a>
                          </form>
                          
                      </h4>
					</div>
				  </div>
				</li>
                <?php } ?>
				
			  </ul>	

		</div>
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
	<?php require('footer.php'); ?>
</body>
</html>