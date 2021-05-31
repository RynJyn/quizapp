<?php 
session_start();

require 'dblogin.php';

if(isSet($_POST['userSelector']))
{
	$userid = $_POST['userSelector'];
	$sql = "DELETE from `login` WHERE `userid`=$userid";
	$result = mysql_query($sql) or die (mysql_error());
	echo '<script>alert("User was successfully deleted.");';
			echo 'document.location="portal.php#deleteUser";';
			echo '</script>';
}
	
	
if(isSet($_POST['adminSelector']))
{
	$adminid = $_POST['adminSelector'];
	$sql = "DELETE from `login` WHERE `userid`=$adminid";
	$result = mysql_query($sql) or die (mysql_error());
	echo '<script>alert("Admin was successfully deleted.");';
			echo 'document.location="portal.php#deleteAdmin";';
			echo '</script>';
}

if(isSet($_POST['usertype']))
{
	
	if (isSet($_POST['username']) && isSet($_POST['password']) && isSet($_POST['confpassword']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$confirm = $_POST['confpassword'];
		$usertype = $_POST['usertype'];
		if ($usertype == 1)
		{
			if ($password != $confirm)
		{
			echo '<script>alert("Passwords do not match.");';
			echo 'document.location="portal.php#createUser";';
			echo '</script>';
		}
		else
		{
			//Create user
			$sql = "INSERT INTO login (`userid`,`username`,`password`,`type`) VALUES (NULL,'$username','$password','1')";
			$result = mysql_query($sql) or die(mysql_error());
			echo '<script>alert("User was successfully created.");';
			echo 'document.location="portal.php#createUser";';
			echo '</script>';
		}
		}
		else if ($usertype == 2)
		{
			if ($password != $confirm)
		{
			echo '<script>alert("Passwords do not match.");';
			echo 'document.location="portal.php#createAdmin";';
			echo '</script>';
		}
		else
		{
			//Create admin
			
			$sql = "INSERT INTO login (`userid`,`username`,`password`,`type`) VALUES (NULL,'$username','$password','2')";
			$result = mysql_query($sql) or die(mysql_error());
			echo '<script>alert("Admin was successfully created.");';
			echo 'document.location="portal.php#createAdmin";';
			echo '</script>';
		}
		}
	}
}

?>

<!DOCTYPE html>
<head>
<title>user</title>
</head>