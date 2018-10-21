<?php
session_start();
require('connector.php');

$user_id=isset($_SESSION["user_id"]) ? $_SESSION["user_id"]:"";
$username=isset($_SESSION["username"]) ? $_SESSION["username"]:"User";
$logged=isset($_SESSION["logged"]) ? $_SESSION["logged"]: false;
$cart=isset($_SESSION["Carrello"]) ? $_SESSION["Carrello"]: "0";

$query="Select count(ID) as conta from prodotti_carrello where IDCarrello='$cart'";
$query2="select Totale from carrello where ID='$cart'";
if($result=$conn->query($query)){
    $row=$result->fetch_assoc();
}
if($result=$conn->query($query2)){
$row2=$result->fetch_assoc();
}
?>
<div id="header">
<div class="container">
<div id="welcomeLine" class="row">
	<div class="span6">Welcome <strong><?php echo $username;?></strong></div>
	<div class="span6">
	<div class="pull-right">
		<span class="btn btn-mini">Total: € <?php echo $row2['Totale']; ?></span>
		<a href="product_summary.php"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ <?php echo $row['conta']; ?> ] Itemes in your cart </span> </a> 
	</div>
	</div>
</div>
<!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
    <a class="brand" href="index.php"><img src="themes/images/logo.png" alt="WebProject"/></a>
		<form class="form-inline navbar-search" method="get" action="products.php" >
		<input id="srchFld" class="srchTxt" type="text" name="Search" placeholder="Search"/>
            <select name="IDCategory" class="srchTxt">
                <option value="0">All</option>
                <?php 
                    $result=$conn->query("Select * from categoria_prodotto");
                    while($row=$result->fetch_assoc()){
                ?>
                <option value="<?php echo $row['ID'];?>"><?php echo $row['Nome'];?></option>
                <?php } ?>
            </select>
		  <input type="submit" value="Search" id="submitButton" class="btn btn-primary"></input>
    </form>
    <ul id="topMenu" class="nav pull-right">
	 <li class=""><a href="contact.php">Contact Us</a></li>
	 <li>
	 <div>
		</br>
		<form action=<?php if($logged==true) echo "logout.php"; else echo "login.php";?> method="post">
			<input class="btn btn-large btn-success" type="submit" name="Login" value=<?php if($logged==true) echo "Logout"; else echo "Login";?>>
		</form>
	 </div>
	</li>
    </ul>
  </div>
</div>
</div>
</div>