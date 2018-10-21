<?php
require('connector.php'); 

$NomeErr=isset($_POST['NomeErr']) ? $_POST['NomeErr']: ""; 
$CognomeErr=isset($_POST['CognomeErr']) ? $_POST['CognomeErr']:"";
$EmailErr=isset($_POST['EmailErr']) ? $_POST['EmailErr']:"";
$PasswordErr=isset($_POST['PasswordErr']) ? $_POST['PasswordErr']:"";
$DataNascitaErr=isset($_POST['DataNascitaErr']) ? $_POST['DataNascitaErr']:"";
$IndirizzoErr=isset($_POST['IndirizzoErr']) ? $_POST['IndirizzoErr']:"";
$CittaErr=isset($_POST['CittaErr']) ? $_POST['CittaErr']:"";
$PaeseErr=isset($_POST['PaeseErr']) ? $_POST['PaeseErr']:"";

$ExistingReg=isset($_POST['ExistingReg']) ? $_POST['ExistingReg']:"";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require ('head.php'); ?>
  </head>
<body>

<?php if($ExistingReg){ ?>
   <script type="text/javascript">
    window.alert("<?php echo $ExistingReg; ?>")
   </script>
<?php } ?>
<!-- Header Begin==================================================================== -->

    <?php require ('header.php'); ?>

<!-- Header End====================================================================== -->
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	
    <?php require ('sidebar.php'); ?>
    
<!-- Sidebar end=============================================== -->
	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.php">Home</a> <span class="divider">/</span></li>
		<li class="active">Registration</li>
    </ul>
	<h3> Registration</h3>	
	<div class="well">
	<!--
	<div class="alert alert-info fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
	 </div>
	<div class="alert fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
	 </div>
	 <div class="alert alert-block alert-error fade in">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Lorem Ipsum is simply</strong> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
	 </div> -->
	<form class="form-horizontal" action="check_register.php" method="post">
		<h4>Your personal information</h4>
		
		<div class="control-group">
			<label class="control-label" for="inputFname1">First name <sup>*</sup></label>
			<div class="controls">
			  <input type="text" name="Nome" placeholder="First Name">
              <span class="<?php if($NomeErr!=NULL) echo "alert alert-block alert-error fade in";?>"><?php echo $NomeErr; ?></span>
			</div>
		 </div>
		 <div class="control-group">
			<label class="control-label" for="inputLnam">Last name <sup>*</sup></label>
			<div class="controls">
			  <input type="text" name="Cognome" placeholder="Last Name">
              <span class="<?php if($CognomeErr!=NULL) echo "alert alert-block alert-error fade in";?>"><?php echo $CognomeErr; ?></span>
			</div>
		 </div>
		<div class="control-group">
		<label class="control-label" for="input_email">Email <sup>*</sup></label>
		<div class="controls">
		  <input type="text" name="Email" placeholder="Email">
          <span class="<?php if($EmailErr!=NULL) echo "alert alert-block alert-error fade in";?>"><?php echo $EmailErr; ?></span>
		</div>
	  </div>	  
	<div class="control-group">
		<label class="control-label" for="inputPassword1">Password <sup>*</sup></label>
		<div class="controls">
		  <input type="password" name="Password" placeholder="Password">
          <span class="<?php if($PasswordErr!=NULL) echo "alert alert-block alert-error fade in";?>"><?php echo $PasswordErr; ?></span>
		</div>
	</div>
	  
    <div class="control-group">
		<label class="control-label">Date of Birth <sup>*</sup></label>
            <input type="date" name="DataNascita">
		<span class="<?php if($DataNascitaErr!=NULL) echo "alert alert-block alert-error fade in";?>"><?php echo $DataNascitaErr; ?></span>
	</div>

		
		
		
		
		
		<div class="control-group">
			<label class="control-label" for="address">Address<sup>*</sup></label>
			<div class="controls">
			  <input type="text" name="Indirizzo" placeholder="Address"/> <span>e.g.: Via Roma, 81 </span>
              <span class="<?php if($IndirizzoErr!=NULL) echo "alert alert-block alert-error fade in";?>"><?php echo $IndirizzoErr; ?></span>
			</div>
		</div>
		
		
		<div class="control-group">
			<label class="control-label" for="city">City and Cap<sup>*</sup></label>
			<div class="controls">
			  <input type="text" name="Citta" placeholder="city"/> <span>e.g.: Valderice 91019 </span>
              <span class="<?php if($CittaErr!=NULL) echo "alert alert-block alert-error fade in";?>"><?php echo $CittaErr; ?></span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="state">Country<sup>*</sup></label>
			<div class="controls">
                <input type="text" name="Paese" placeholder="country"/> 
                <span class="<?php if($PaeseErr!=NULL) echo "alert alert-block alert-error fade in";?>"><?php echo $PaeseErr; ?></span>
			</div>
		</div>		
		
		
	<p><sup>*</sup>Required field	</p>
	
	<div class="control-group">
			<div class="controls">
				<input type="hidden" name="email_create" value="1">
				<input type="hidden" name="is_new_customer" value="1">
				<input class="btn btn-large btn-success" type="submit" value="Register" />
			</div>
		</div>		
	</form>
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