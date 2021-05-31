<?php

if(isSet($_GET['m']))
{
	$message = $_GET['m'];
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Chemical Conundrum | Login</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>

<div id="loginwrap">
<div id="loginbox">
<form name="loginform" method="post" action="checklogin.php">
<p>Please enter your login details and click login</p>
<p>Username:
<input name="username" class="loginbox" type="text" size="20" value="" required></p>
<p>Password:
<input name="password" class="loginbox" type="password" size="20" value="" required>
</p>
<p><input name="submitbtn" class="loginbutton" type="submit" value="Login"></p>

<?php
if(isSet($message))
{

if ($message == 'incorrect')
{
	echo '<div class="errortext">';
	echo 'Username or Password incorrect. Try again.';
	echo '</div>';
}
}

?>

</form>
</div>
</div>

</body>
</html>