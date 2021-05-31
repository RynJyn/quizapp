<?php 
session_start();

if(isSet($_SESSION['userid']))
{
$_SESSION['questions'] = array(); //A session variable used to store the randomly generated questions

require 'dblogin.php';
$sql = "SELECT DISTINCT * FROM questions ORDER BY RAND() LIMIT 10"; //Selects 10 random non-repeating questions from the database
$result = mysql_query($sql);
						if (mysql_num_rows($result) > 0) 
						{
							while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){ 
							$_SESSION['questions'][] = $row;
							for ($id = 0; $id < 10; $id++)
							{
								$_SESSION['questions']['id'] = $id;
							}
							}
						}
						else 
						{
							
						}
}

if(isSet($_SESSION['answers']))
{
	unset($_SESSION['answers']);
}



?>

<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="stylem.css" />
<title>Chemical Conundrum</title>
</head>

<body>
<div class="titleimage">
<img src="title.gif"/>
</div>
<div class="ccimage">
<img src="chem.gif"/>
</div>

<div id="buttoncontainer">
<?php

if(isSet($_SESSION['userid']))
{
echo '<form action="quiz.php?qid=0" method="link">';
echo '<input class="buttons" type="submit" value="Start Quiz">';
echo '</form>';
}
?>
<br>
<form action="leaderboard.php" method="link">
    <input class="buttons" type="submit" value="Top Chemists Club">
</form>
<br>
<?php 
if(isSet($_SESSION['userid']))
{
echo '<form action="logout.php" method="link">';
echo '<input class="buttons" type="submit" value="Log Out">';
echo '</form>';
}
else 
{
echo '<form action="login.php" method="link">';
echo '<input class="buttons" type="submit" value="Log In">';
echo '</form>';
	
}

echo '<br/>';
if(isSet($_SESSION['usertype']))
{
	if($_SESSION['usertype'] == 2)
	{
		echo '<form action="portal.php" method="link">';
		echo '<input class="buttons" type="submit" value="Admin Panel">';
		echo '</form>';
	}
}
?>

</div>
</body>
</html>