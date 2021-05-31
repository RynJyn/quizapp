<?php
session_start();
$user=$_POST["username"];
$pass=$_POST["password"];
include("dblogin.php");
$sql="SELECT * FROM login";
$result=mysql_query($sql);

while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
{
if(strtolower($user)==strtolower($row["username"]) && $pass==$row["password"])
{

$_SESSION["userid"]=$row["userID"];
$userid = $row["userID"];
$sql="SELECT * FROM login WHERE `userID` = '$userid' LIMIT 1";
$result=mysql_query($sql);

while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
{
$usertype = $row['type'];
if ($usertype == 2)
{
	$_SESSION['usertype'] = 2;
	header ('Location: portal.php'); //Redirects an admin to the configuration panel
}
else if ($usertype == 1)
{
	$_SESSION['usertype'] = 1;
	header ('Location: index.php'); //If the values match, allow the user to use the app
}

}
}
}

if ($_SESSION["userid"]=="")
{
header ('Location: login.php?m=incorrect');
//Return the user to the login page if either the username or password is wrong, and show an error.
}


?>