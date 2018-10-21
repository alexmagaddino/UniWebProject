<!DOCTYPE html>
<head></head>
<body>
<?php
require "connector.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	if (empty($_POST["Email"])) {
			$EmailErr = "Email is required";
	} else {
		$Email = test_input($_POST["Email"]);
		// check if e-mail address is well-formed
		if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
			$EmailErr = "Invalid email format"; 
		}else{
			$EmailErr = "";
		}
	}
	  
	if (empty($_POST["Password"])) {
		$PasswordErr = "Password is required";
	}else {
		$Password = test_input($_POST["Password"]);
		if( strlen($Password) < 8 ) {
			$PasswordErr = "Password too short!";
		}else{
			$PasswordErr = "";
		}
		if( strlen($Password) > 20 ) {
			$PasswordErr = "Password too long!";
		}else{
			$PasswordErr = "";
		}
		if( !preg_match("#[0-9]+#", $Password) ) {
			$PasswordErr = "Password must include at least one number!";
		}else{
			$PasswordErr = "";
		}
		if( !preg_match("#[a-z]+#", $Password) ) {
			$PasswordErr = "Password must include at least one letter!";
		}else{
			$PasswordErr = "";
		}
		
	}
	if($EmailErr != NULL || $PasswordErr != NULL){ ?>
		
		
		<form name="fr1" action="login.php" method="POST">           
			<input type="hidden" name="EmailErr" value="<?php echo $EmailErr;?>"> 
			<input type="hidden" name="PasswordErr" value="<?php echo $PasswordErr;?>">
		</form>
		<script type='text/javascript'>
				document.fr1.submit();
		</script>
		<?php
		
	}else{

		$query="SELECT * FROM utente WHERE Email='$Email' and Password='".MD5($Password)."' and SU='0'";

		if ($result = $conn->query($query)) {
			$i=0;
			while($row = $result->fetch_assoc() ){
				$i += 1;
				
				$name = $row['Nome'];
				$id = $row['ID'];
                $isLock = $row['Bloccato'];
			}
			if($i==1){ 
				if($isLock==0){
                    session_start();
                    $_SESSION["user_id"]= $id;
                    $_SESSION["username"]= $name;
                    $_SESSION["logged"] = true;
                    
                    $query1="Select ID from carrello where IDUtente='$id' and Pagato='0'";
                    $query2="Insert Into carrello (IDUtente,Pagato,Totale) Values ('$id','0','0')";
                    $result1=$conn->query($query1);
                    $i=0;
                    while($row1=$result1->fetch_assoc()){
                        $ID=$row1['ID'];
                        $i++;
                    }
                    if($i==1){
                        $_SESSION["Carrello"]=$ID;
                    }else{
                        $result2=$conn->query($query2);
                        $result2=$conn->query($query1);
                        $row2=$result2->fetch_assoc();
                        $_SESSION["Carrello"]=$row2['ID'];
                        
                    }
                    
                    
                    $conn->close();
                    header("location:index.php"); 
                }else{
                   $AllErr="You have been blocked!! You can't login ;(" ;
                }
			} else {
				$AllErr="Email or password invalid";
			}
            ?> 
				
				<form name="fr2" action="login.php" method="POST">           
					<input type="hidden" name="AllErr" value="<?php echo $AllErr;?>"> 
				</form>
				
				<script type='text/javascript'>
						document.fr2.submit();
				</script>
            <?php
		} else {
			echo "could not retrieve data from db";
		}
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