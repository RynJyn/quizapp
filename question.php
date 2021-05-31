<?php 
session_start();

require 'dblogin.php';

if(isSet($_POST['submitbtn']))
{
	$question = $_POST['question'];
	$answer1 = $_POST['answer1'];
	$answer2 = $_POST['answer2'];
	$answer3 = $_POST['answer3'];
	$answer4 = $_POST['answer4'];
	$answer = $_POST['qanswer'];
	
	$sql = "INSERT INTO questions (`questionID`,`question`,`answer1`,`answer2`,`answer3`,`answer4`,`answer`) VALUES (NULL,'$question','$answer1','$answer2','$answer3','$answer4','$answer')";
	$result = mysql_query($sql) or die(mysql_error());
			echo '<script>alert("Question was successfully added.");';
			echo 'document.location="portal.php#addQuestion";';
			echo '</script>';
	
}

if(isSet($_POST['questionSelector']))
{
	$questionID = $_POST['questionSelector'];
	$sql = "DELETE from `questions` WHERE `questionID`=$questionID";
	$result = mysql_query($sql) or die (mysql_error());
	echo '<script>alert("Question was successfully removed.");';
			echo 'document.location="portal.php#removeQuestion";';
			echo '</script>';
}

if(isSet($_POST['submitbtn2']))
{
	$question = $_POST['question'];
	$answer1 = $_POST['answer1'];
	$answer2 = $_POST['answer2'];
	$answer3 = $_POST['answer3'];
	$answer4 = $_POST['answer4'];
	$answer = $_POST['qanswer'];
	$id = $_POST['id'];
	
	$sql = "UPDATE `questions` SET `question` = '$question', `answer1` = '$answer1', `answer2` = '$answer2', `answer3` = '$answer3', `answer4` = '$answer4', `answer` = '$answer' WHERE `questionID` = '$id'";
	$result = mysql_query($sql) or die(mysql_error());
			echo '<script>alert("Question was successfully modified.");';
			echo 'document.location="portal.php#modifyQuestion";';
			echo '</script>';
}

?>