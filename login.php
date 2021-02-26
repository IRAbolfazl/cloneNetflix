<?php

	require_once ("includes/classes/FormSanitizer.php");
	require_once ("includes/classes/Constants.php");
	require_once ("includes/config.php");
	require_once ("includes/classes/Account.php");

	$account = new Account($con);

		if (isset($_POST["submit"])) {
			$userName = FormSanitizer::sanitizingstr($_POST["userName"]);
			$password1 = FormSanitizer::sanitizingpassword($_POST["password"]);
			$success = $account->login ($userName,$password1);
			if($success){
				$_SESSION["userLoggedIn"] = $userName;
				header("Location: index.php");
		}
	}

	function getInput ($name){
		if (isset($_POST["$name"])){
			echo $_POST["$name"];
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Netflix</title>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css" />
</head>
<body>

    <div class="signIncontainer">

        <div class="column">
            <div class="header">
                <img src="assets/images/logo1.png" title="logo" alt="Site logo" width="150" />
                <h3>Login</h3>
                <span>to continue to MySite</span>
            </div>
            <form method="post">

				<?php echo $account->getError(Constants::$Loginfailed)?>
                <input type="text" , placeholder="User name" name="userName" value= "<?php getInput("userName"); ?>" required />
                <input type="password" , placeholder="password" name="password" required />
                <input type="submit" , value="submit" name="submit" />

            </form>
            <a class="signinmessage" href="register.php">need an account? sign up </a>
        </div>
    </div>

</body>



</html> 