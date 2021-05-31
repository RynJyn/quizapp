<?php
session_start();

if($_SESSION['userid'] == "")
{
	header ('Location: index.php');
}

if(isSet($_SESSION['usertype']))
{
if ($_SESSION['usertype'] == 1)
{
	header('Location: index.php');
}
}

if(isSet($_GET['m']))
{
	$message = $_GET['m'];
}


require 'dblogin.php';

if(isSet($_POST['modifybtn']))
{
	$questionid = $_POST['modifySelector'];
	$sql = "SELECT * FROM `questions` WHERE `questionID`=$questionid";
	$result = mysql_query($sql);
	if (mysql_num_rows($result) > 0) 
						{
							while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
							{ 
								$questiontemp = $row['question'];
								$answer1temp = $row['answer1'];
								$answer2temp = $row['answer2'];
								$answer3temp = $row['answer3'];
								$answer4temp = $row['answer4'];
								$answertemp = $row['answer'];
								$idtemp = $row['questionID'];
							}
						}
						else 
						{
							
						}
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Chemical Conundrum | Administration Portal</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>

<header>Adminstration Portal</header>

<nav id="menu">
	<ul>
		<li class="titleli"><a href="index.php">Main Page</a></li>
		<li class="titleli">Quiz Settings</li>
			<ul>
				<li><a href="#addQuestion">Add Question</a></li>
				<li><a href="#removeQuestion">Remove Question</a></li>
				<li><a href="#modifyQuestion">Modify Question</a></li>
			</ul>
		<li class="titleli">User Settings</li>
			<ul>
				<li><a href="#createUser">Create User</a></li>
				<li><a href="#deleteUser">Delete User</a></li>
			</ul>
		<li class="titleli">Administrator Settings</li>
			<ul>
				<li><a href="#createAdmin">Create Admin</a></li>
				<li><a href="#deleteAdmin">Delete Admin</a></li>
			</ul>
		<li class="titleli"><a href="logout.php">Logout</a></li>
	<ul>

</nav>

<div id="box">
<div id="addQuestion">
<form method="post" name="questionform" action="question.php">
<p>Enter the question:</p>
<input type="text" name="question" value="" required>
<p>Enter the first answer</p>
<input type="text" name="answer1" value="" required>
<input type="radio" name="qanswer" value="1">
<p>Enter the second answer</p>
<input type="text" name="answer2" value="" required>
<input type="radio" name="qanswer" value="2">
<p>Enter the third answer</p>
<input type="text" name="answer3" value="" required>
<input type="radio" name="qanswer" value="3">
<p>Enter the fourth answer</p>
<input type="text" name="answer4" value="" required>
<input type="radio" name = "qanswer" value="4">
<p><input name="submitbtn" type="submit" value="Add"></p>
<p>Use the radio buttons to choose the text box containing the answer</p>
</form>
</div>

<div id="removeQuestion">
<form method="post" action="question.php">
<p>Select a question to remove:</p>
<select name="questionSelector">
<option value="" selected hidden></option>
<?php
$sql = "SELECT questionID,question FROM questions";
$result = mysql_query($sql);
						if (mysql_num_rows($result) > 0) 
						{
							while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
							{ 
								echo '<option value="';
								echo $row['questionID'];
								echo '">';
								echo $row['question'];
								echo '</option>';
							}
						}
						else 
						{
							
						}

?>
</select>
<br/>
<input type="submit" value="Remove" />
</form>
</div>

<div id="modifyQuestion">
<form method="post" action="portal.php#modifybox">
<p>Select a question to modify:</p>
<select name="modifySelector">
<option value="" selected hidden></option>
<?php
$sql = "SELECT questionID,question FROM questions";
$result = mysql_query($sql);
						if (mysql_num_rows($result) > 0) 
						{
							while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
							{ 
								echo '<option value="';
								echo $row['questionID'];
								echo '">';
								echo $row['question'];
								echo '</option>';
							}
						}
						else 
						{
							
						}

?>
</select>
<br/>
<input type="submit" name="modifybtn" value="Modify" />
</form>
</div>

<div id="modifybox">
<form method="post" action="question.php">
<p>Question:</p>
<input type="text" name="question" value="<?= $questiontemp ?>" required>
<p>First answer</p>
<input type="text" name="answer1" value="<?= $answer1temp ?>" required>
<input type="radio" name="qanswer" value="1" <?php if($answertemp == 1){ echo "checked = 'checked'"; }?>>
<p>Second answer</p>
<input type="text" name="answer2" value="<?= $answer2temp ?>" required>
<input type="radio" name="qanswer" value="2" <?php if($answertemp == 2){ echo "checked = 'checked'"; }?>>
<p>Third answer</p>
<input type="text" name="answer3" value="<?= $answer3temp ?>" required>
<input type="radio" name="qanswer" value="3" <?php if($answertemp == 3){ echo "checked = 'checked'"; }?>>
<p>Fourth answer</p>
<input type="text" name="answer4" value="<?= $answer4temp ?>" required>
<input type="radio" name = "qanswer" value="4" <?php if($answertemp == 4){ echo "checked = 'checked'"; }?>>
<input type="text" name="id" value="<?= $idtemp ?>" hidden>
<p><input name="submitbtn2" type="submit" value="Update"></p>
<p>Use the radio buttons to choose the text box containing the answer</p>
</form>
</div>

<div id="createUser">
<form method="post" action="user.php">
<p>Enter the username:</p>
<input type="text" name="username" value="" required>
<p>Enter the password:</p>
<input type="password" name="password" value="" required>
<p>Confirm the password:</p>
<input type="password" name="confpassword" value="" required>
<input type="radio" name="usertype" checked value="1" hidden >
<br/>
<input type="submit" value="Create" />
<?php
if(isSet($message))
{

if ($message == 'nomatch')
{
	echo '<div class="errortext">';
	echo 'Passwords do not match.';
	echo '</div>';
}
}

?>
</form>
</div>

<div id="deleteUser">
<form method="post" action="user.php">
<p>Select a user to delete:</p>
<select name="userSelector">
<option value="" selected hidden></option>
<?php
$sql = "SELECT userID,username FROM login WHERE type=1";
$result = mysql_query($sql);
						if (mysql_num_rows($result) > 0) 
						{
							while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
							{ 
								echo '<option value="';
								echo $row['userID'];
								echo '">';
								echo $row['userID'].". ".$row['username'];
								echo '</option>';
							}
						}
						else 
						{
							
						}

?>
</select>
<br/>
<input type="submit" value="Delete" />
</form>
</div>

<div id="createAdmin">
<form method="post" action="user.php">
<p>Enter the username:</p>
<input type="text" name="username" value="" required>
<p>Enter the password:</p>
<input type="password" name="password" value="" required>
<p>Confirm the password:</p>
<input type="password" name="confpassword" value="" required>
<input type="radio" name="usertype" value="2" checked hidden >
<br/>
<input type="submit" value="Create" />
</form>
<?
if(isSet($message))
{

if ($message == 'nomatch')
{
	echo '<div class="errortext">';
	echo 'Passwords do not match.';
	echo '</div>';
}
}

?>
</div>

<div id="deleteAdmin">
<form method="post" action="user.php">
<p>Select an admin to delete:</p>
<select name="adminSelector">
<option value="" selected hidden></option>
<?php
$sql = "SELECT userID,username FROM login WHERE type='2'";
$result = mysql_query($sql);
						if (mysql_num_rows($result) > 0) 
						{
							while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
							{ 
								echo '<option value="';
								echo $row['userID'];
								echo '">';
								echo $row['userID'].". ".$row['username'];
								echo '</option>';
							}
						}
						else 
						{
							
						}

?>
</select>
<br/>
<input type="submit" value="Delete" />
</form>
</div>

</div>
</body>
</html>