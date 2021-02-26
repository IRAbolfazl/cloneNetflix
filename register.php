<?php
	require_once ("includes/classes/FormSanitizer.php");
	require_once ("includes/classes/Constants.php");
	require_once ("includes/config.php");
	require_once ("includes/classes/Account.php");

	$account = new Account($con);
	if (isset($_POST["submit"])) {
		$firstName = FormSanitizer::sanitizingstr($_POST["firstName"]);
		$lastName = FormSanitizer::sanitizingstr($_POST["lastName"]);
		$userName = FormSanitizer::sanitizingstr($_POST["userName"]);
		$email1 = FormSanitizer::sanitizingemail($_POST["email1"]);
		$email2 = FormSanitizer::sanitizingemail($_POST["email2"]);
		$password1 = FormSanitizer::sanitizingpassword($_POST["password1"]);
		$password2 = FormSanitizer::sanitizingpassword($_POST["password2"]);

		$success = $account-> register ($firstName,$lastName,$userName,$email1,$email2,$password1,$password2);
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
                <h3>Sign Up</h3>
                <span>to continue to MySite</span>
            </div>
            <form method="post">
				<?php echo $account->getError(Constants::$FirstNameCharachters)?>
                <input type="text" , placeholder="First name" name="firstName"  value= "<?php getInput("firstName"); ?>" required />

				<?php echo $account->getError(Constants::$LastNameCharachters)?>
                <input type="text" , placeholder="Last name" name="lastName" value= "<?php getInput("lastName"); ?>" required />

				<?php echo $account->getError(Constants::$UserNameCharachters)?>
				<?php echo $account->getError(Constants::$UserNameTaken)?>
                <input type="text" , placeholder="User name" name="userName" value= "<?php getInput("userName"); ?>" required />

				<?php echo $account->getError(Constants::$EmailsDontMatch)?>
				<?php echo $account->getError(Constants::$EmailsInvalid)?>
				<?php echo $account->getError(Constants::$EmailTaken)?>
                <input type="email" , placeholder="Email" name="email1" value= "<?php getInput("email1"); ?>" />
                <input type="email" , placeholder="confirm Email" name="email2" value= "<?php getInput("email2"); ?>" required />

				<?php echo $account->getError(Constants::$PasswordDontMatch)?>
				<?php echo $account->getError(Constants::$PasswordCharachters)?>
                <input type="password" , placeholder="password" name="password1" required />
                <input type="password" , placeholder="confirm password" name="password2" required />
                <input type="submit" , value="submit" name="submit" />

            </form>
            <a class="signinmessage" href="login.php">already have a acount </a>
        </div>
    </div>

</body>



</html> 