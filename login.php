<?php

$EmailErr=isset($_POST['EmailErr']) ? $_POST['EmailErr']:"";
$PasswordErr=isset($_POST['PasswordErr']) ? $_POST['PasswordErr']:"";
$AllErr=isset($_POST['AllErr']) ? $_POST['AllErr']:"";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require('head.php'); ?>
  </head>
<body>
<!-- Header Begin==================================================================== -->

<?php 
    require('header.php');
    if($logged){
        header("location:index.php");
    }
?>

<!-- Header End====================================================================== -->
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->

	<?php require('sidebar.php'); ?>
    
<!-- Sidebar end=============================================== -->
	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.php">Home</a> <span class="divider">/</span></li>
		<li class="active">Login</li>
    </ul>
	<h3> Login</h3>	
	<hr class="soft"/>
	
	<div class="row">
		<div class="span4">
			<div class="well">
			<h5>CREATE YOUR ACCOUNT</h5><br/>
			If you are not already registered click here to create your account.<br/><br/><br/>
			<form action="register.php">
			  <div class="controls">
			  <button type="submit" class="btn block">Create Your Account</button>
			  </div>
			</form>
		</div>
		</div>
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
			<h5>ALREADY REGISTERED ?</h5>
			<div class="<?php if($AllErr!=NULL) echo "alert alert-block alert-error fade in";?>"><?php echo $AllErr; ?></div>
			<form action="<?php if($logged==false) echo "check_login.php"; else echo "index.php";?>" method="post">
			  <div class="control-group">
				<label class="control-label" for="inputEmail1">Email</label>
				<div class="controls">
				  <input class="span3"  type="text" name="Email" placeholder="Email">
                  <div class="<?php if($EmailErr!=NULL) echo "alert alert-block alert-error fade in";?>"><?php echo $EmailErr; ?></div>  
				</div>
			  </div>
			  <div class="control-group">
				<label class="control-label" for="inputPassword1">Password</label>
				<div class="controls">
				  <input type="password" class="span3"  name="Password" placeholder="Password">
                  <div class="<?php if($PasswordErr!=NULL) echo "alert alert-block alert-error fade in";?>"><?php echo $PasswordErr; ?></div>
				</div>
			  </div>
			  <div class="control-group">
				<div class="controls">
				  <input type="submit" name="Login" value="Login"> <!--<a href="forgottenpass.php">Forgotten password?</a>-->
				</div>
			  </div>
			</form>
		</div>
		</div>
	</div>	
	
</div>
</div></div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
	<?php require('footer.php'); ?>
</body>
</html>