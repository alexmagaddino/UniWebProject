<?php
$UsernameErr=isset($_POST['UsernameErr']) ? $_POST['UsernameErr']: "";
$PasswordErr=isset($_POST['PasswordErr']) ? $_POST['PasswordErr']: "";

?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap/Stile_admin.css">
</head>
<body>
<a href="index.php"><button type="button">HOME</button></a>
<div class="main">
    <h1>Login Amministratore</h1>
    <form action="check_login_admin.php" method="post">
        <label>Username</label></br>
        <input type="text" name="Username" id="Username">
        <div class="<?php if($UsernameErr!=NULL) echo "alert-error";?>"><?php echo $UsernameErr; ?></div>
        
        </br></br>
        
        <label>Password</label></br>
        <input type="password" name="Password" id="Password">
        <div class="<?php if($PasswordErr!=NULL) echo "alert-error";?>"><?php echo $PasswordErr; ?></div>
        
        </br></br>
        
        <input type="submit" value="Login" class="bottone">
    </form>
</div>

</body>