<?php

	require("functions.php");
	
	require("class/helper.class.php");
 	$Helper = new Helper();
	
	require ("class/user.class.php");
	$User = new User($mysqli);
	
	// kui kasutaja on sisseloginud, siis suuna data lehele
	if(isset ($_SESSION["userID"])) {
		header("Location: data.php");
		exit();
	}

	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
	
	$signupFirstnameError = "";
	$signupFirstname = "";
	
	//kas on üldse olemas
	if (isset ($_POST ["signupFirstname"])) {
		
		//oli olemas, ehk keegi vajutas nuppu
		//kas oli tühi
		if (empty ($_POST ["signupFirstname"])) {
			
			//oli tõesti tühi
			$signupFirstnameError = "Palun sisesta nimi!"; 
		
		} else {
			
			//kõik korras, email ei ole tühi ja on olemas
			$signupFirstname = $_POST ["signupFirstname"];
			
		}	
		
	}
	
	$signupLastnameError = "";
	$signupLastname = "";
	
	//kas on üldse olemas
	if (isset ($_POST ["signupLastname"])) {
		
		//oli olemas, ehk keegi vajutas nuppu
		//kas oli tühi
		if (empty ($_POST ["signupLastname"])) {
			
			//oli tõesti tühi
			$signupLastnameError = "Palun sisesta perekonnanimi!"; 
		
		} else {
			
			//kõik korras, email ei ole tühi ja on olemas
			$signupLastname = $_POST ["signupLastname"];
			
		}	
		
	}
	
	$signupBirthdayError = "";
	$signupBirthday = "";
	
	//kas on üldse olemas
	if (isset ($_POST ["signupBirthday"])) {
		
		//oli olemas, ehk keegi vajutas nuppu
		//kas oli tühi
		if (empty ($_POST ["signupBirthday"])) {
			
			//oli tõesti tühi
			$signupBirthdayError = "Sisesta sünnikuupäev"; 
		
		} else {
			
			//kõik korras, email ei ole tühi ja on olemas
			$signupBirthday = $_POST ["signupBirthday"];
			
		}	
	}
	
	$genderError = "";
	$gender = "";
	
	//kas on üldse olemas
	if (isset ($_POST ["gender"])) {
		
		//oli olemas, ehk keegi vajutas nuppu
		//kas oli tühi
		if (empty ($_POST ["gender"])) {
			
			//oli tõesti tühi
			$genderError = "See v2li on kohustuslik!"; 
		
		} else {
			
			//kõik korras, email ei ole tühi ja on olemas
			$gender = $_POST ["gender"];
			
		}	
		
	}

	
	$signupEmailError = "";
	$signupEmail = "";
	
	//kas on üldse olemas
	if (isset ($_POST ["signupEmail"])) {
		
		//oli olemas, ehk keegi vajutas nuppu
		//kas oli tühi
		if (empty ($_POST ["signupEmail"])) {
			
			//oli tõesti tühi
			$signupEmailError = "See v2li on kohustuslik!"; 
		
		} else {
			
			//kõik korras, email ei ole tühi ja on olemas
			$signupEmail = $_POST ["signupEmail"];
			
		}	
		
	}
	
	
	
	$signupPasswordError = "";

	//kas on üldse olemas
	if (isset ($_POST ["signupPassword"])) {
		
		//oli olemas, ehk keegi vajutas nuppu
		//kas oli tühi
		if (empty ($_POST ["signupPassword"])) {
			
			//oli tõesti tühi
			$signupPasswordError = "Parool puudulik!"; 
			
		} else {
			//oli midagi, ei olnud tühi
			
			//kas pikkus vähemalt 8
			if (strlen ($_POST ["signupPassword"]) <8 ) {
				
				$signupPasswordError = "Parool peab olema v2hemalt 8 t2hem2rki!";
				
			}
		}
	}
	
		if (empty($signupEmailError) && 
		empty($signupPasswordError) &&
		empty($signupFirstnameError) &&
		empty($signupLastnameError) &&
		empty($signupBirthdayError) &&
		empty($genderError) &&
		isset($_POST["signupEmail"]) &&
		isset($_POST["signupPassword"]) &&
		isset($_POST["signupFirstname"]) &&
		isset($_POST["signupLastname"]) &&
		isset($_POST["signupBirthday"]) &&
		isset($_POST["gender"])) {
		

			//ühtegi viga ei ole, kõik vajalik olemas
			echo "Salvestan...";
			echo "Nimi ".$Firstname."<br>";
			
			$password = hash ("sha512", $_POST ["signupPassword"]);
			
			echo "email ".$signupEmail. "<br>";
			
			//ühendus
			$database = "if16_krisroos_3";
			$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
			
			//käsk
			$stmt = $mysqli->prepare("INSERT INTO Kasutajad_sample (firstname, lastname, birthday, email, password) VALUES(?, ?, ?, ?, ?)");
			
			echo $mysqli->error;
			
			//s- string
			//i- int
			//d-decimal/double
			//iga küsimärgi jaoks üks täht, mis tüüpi on
			$stmt->bind_param("sssss", $signupFirstname, $signupLastname, $signupBirthday, $signupEmail, $password);

			if($stmt->execute()) {
				
				echo "Salvestamine õnnestus! ";
			} else {
				
				echo "Error ".$stmt->error;
			}
			
			}
			
	echo "siin";
	
	$loginemailError = "";
	$loginemail = "";
	
	//kas on üldse olemas
	if (isset ($_POST ["loginemail"])) {
		
		//oli olemas, ehk keegi vajutas nuppu
		//kas oli tühi
		if (empty ($_POST ["loginemail"])) {
			
			//oli tõesti tühi
			$loginemailError = "E-post puudulik!"; 
		
		} else {
			
			//kõik korras, email ei ole tühi ja on olemas
			$loginemail = $_POST ["loginemail"];
			
		}	
		
	}
	
	$loginpasswordError = "";
	$loginpassword = "";
	
	//kas on üldse olemas
	if (isset ($_POST ["loginpassword"])) {
		
		//oli olemas, ehk keegi vajutas nuppu
		//kas oli tühi
		if (empty ($_POST ["loginpassword"])) {
			
			//oli tõesti tühi
			$loginpasswordError = "Sisesta parool!"; 
		
		} else {
			
			//kõik korras, email ei ole tühi ja on olemas
			$loginpassword = $_POST ["loginpassword"];
			
		}	
		
	}

	
	$notice = "";
	// mõlemad login vormi väljad on täidetud
	if (	isset($_POST["loginemail"]) && 
			isset($_POST["loginpassword"]) && 
			!empty($_POST["loginemail"]) && 
			!empty($_POST["loginpassword"]) 
	) {
		$notice = $User->login($_POST["loginemail"], $_POST["loginpassword"]);
		
	
	if(isset($notice->success)){
 			header("Location: login.php");
 			exit();
 		}else {
 			$notice = $notice->error;
 			var_dump($notice->error);
		}
	
	}
	
 ?>

<!DOCTYPE html>

<link rel="stylesheet" href="Style/loginstyle.css">
<html>
	<head>
		<title>Sisselogimise leht</title>
		<div class="login-page">
	</head>
	<h1> Tere tulemast Töömehe Abisse versioon 1.1!</h1>
	
<body>
	<label style= "color:white">Logi sisse</label>
	<form class="form" method="POST"> 
		<p style="color:red;"><?php echo $notice; ?></p>
		<div class="input">
		<label>
		<div class="required">E-post:</div>
		<input name= "loginemail" type= "email" value="<?php echo $loginemail;?>"> <?php echo $loginemailError; ?>
		</label>
		</div>
			
		<div class="input">
		<label>
		<div class="required">Parool: </div>
		<input name="loginpassword" type="password" value="<?php echo $loginpassword;?>" /> <?php echo $loginpasswordError; ?>
		</label>
		</div>
		<div class="input">
		<button class="button">Esita</button>
		</div>
	</form>

</body>
	<label style= "color:white">Registreeri</label>	
 <form class="form" method="POST"> 
		
		<label>
		<div class="required">Eesnimi:</div>
		<input type= "text" name="firstname" />
		</label>
	
		<label>
		<div class="required">Perekonnanimi:</div>
	    <input type="text" name="lastname" />
		</label>
			
	
		<label>
		<div class="required">Sünnikuupäev:</div>
		<input type="date" name="birthday">
		</label>
			
			
		<div class="required">Sinu sugu:</div>
		<?php 
		if ($gender == "male")  {
		echo '<input type="radio" name="gender" value="male" checked> Mees<br>';
		} else { 
		echo '<input type="radio" name="gender" value="male"> Mees<br>';
		 } 
		if ($gender == "female") { 
		echo '<input type="radio" name="gender" value="female"checked> Naine<br>';
		} else { 
		echo '<input type="radio" name="gender" value="female"> Naine<br>';
		} 
		?>
		
			
			
	<label>
	<div class="required">Sinu email:</div>
	<input name= "signupEmail" type= "email" value="<?php echo $signupEmail; ?>"> <?php echo $signupEmailError; ?>
	</label>
		
			
	<label>
	<div class="required">Loo parool:</div>
	<input name="signupPassword" type="password"> <?php echo $signupPasswordError; ?>
	</label>
			
	<button class="button">Loo kasutaja</button>
			
	</form>
</body>
</html>