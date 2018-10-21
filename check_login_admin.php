<?php
require "connector.php";
session_start(); //chiama la variabile $_SESSION
session_unset(); //svuota $_SESSION
session_destroy(); //chiude la sessione
?>

<!DOCTYPE html>
<head></head>
<body>
<?php

$Username="";
$Password="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	if(empty($_POST["Username"])) {
			$UsernameErr = "Username is required";
	} else {
		$Username = test_input($_POST["Username"]);
        $UsernameErr="Username invalid";
	}
	  
	if(empty($_POST["Password"])) {
		$PasswordErr = "Password is required";
	}else {
		$Password = test_input($_POST["Password"]);
		$PasswordErr = "Password invalid";
	}
	
    $query="SELECT * FROM utente WHERE Nome='$Username' and Password='".MD5($Password)."' and SU='1'";
    if($result = $conn->query($query)){
        $i=0;
        while($row=$result->fetch_assoc()){
        $i++;
        }
        if($i==1) {
            session_start();
            $_SESSION['admin']=true;
            $conn->close();
            header("location:admin.php");
        }else{?>
    
            <form name="fr" action="login_admin.php" method="POST">           
                <input type="hidden" name="UsernameErr" value="<?php echo $UsernameErr;?>"> 
                <input type="hidden" name="PasswordErr" value="<?php echo $PasswordErr;?>">
            </form>
            <script type='text/javascript'>
                    document.fr.submit();
            </script>
            <?php
        }
    }else{ 
        echo "could not retrieve data from db";
    }
}


function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
    
?>
</body>