<?php
session_start();

if($_SESSION['userid'] == "")
{
	header ('Location: index.php');
}

if(isSet($_POST['answercheck']))
{
$_SESSION['answers'] = $_SESSION['answers'].$_POST['answercheck'].',';
}

if(isSet($_SESSION['answers']))
{
	$results = explode(",",$_SESSION['answers']);
	$score = 0;	
	for ($i = 0; $i < 10; $i++)
	{
		if ($results[$i] == $_SESSION['questions'][$i]['answer'])
		{
			$score = $score + 1;
		}
	}
		
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Chemical Conundrum | Results</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body>

<div id="resultswrap">
<div id="resultsbox">

<h2>You scored</h2>
<h1><?= $score ?></h1>
<h2>out of 10</h2>

<p class="clear">
<?php
require 'dblogin.php';
$sql = "SELECT * FROM messages";
$result = mysql_query($sql);
						if (mysql_num_rows($result) > 0) 
						{
							while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
							{ 
								if ($score >= $row['start_num'] && $score <= $row['end_num'])
								{
									echo $row['message'];
								}
							}
						}
						else 
						{
							
						}

?>
</p>

<button class="resultbutton" onclick="location.href='index.php'">Home</button>
<button class="resultbutton" onclick="location.href='leaderboard.php'">View Leaderboard</button>
</div>
</div>

</body>
</html>