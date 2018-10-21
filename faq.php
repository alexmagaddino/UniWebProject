<!DOCTYPE html>
<html lang="en">
  <head>
   <?php require "head.php"; ?>
  </head>
<body>

<!-- Header Begin==================================================================== -->
<?php require('header.php') ?>
<!-- Header End====================================================================== -->

<div id="mainBody">
<div class="container">
<h1>FAQ</h1>
<hr class="soften"/>	
<div class="accordion" id="accordion2">
	<div class="accordion-group">
	  <div class="accordion-heading">
		<h4><a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
		  Qui ci andrebbe la prima FAQ
		</a></h4>
	  </div>
	  <div id="collapseOne" class="accordion-body collapse"  >
		<div class="accordion-inner">
			Ma invece non c'è niente xD
		</div>
	  </div>
	</div>
	
  </div>
</div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
	<?php require('footer.php'); ?>
</body>
</html>