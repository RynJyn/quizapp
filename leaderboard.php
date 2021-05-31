    <?php
    session_start(); 
	include("dblogin.php"); 	
    ?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="style2.css"> 
	
    <title>Chemical Conundrum | Top Chemists</title> 


	</head>
<body>

    <div id="container">
		
		<div class="Name">
			<img src="title.gif" alt="Chemical Conundrum">
		</div>
	
		<div class="Trophy"> 
			<img src="trophy.png" alt="Picture of Trophy">
		</div>	
		<br>
		<br>
        <div class="Title"> 
			<p>Top Ten Chemists</p>
		</div>
	
		<div class="Leaderboard">
			<ol>
			<?php 
			require 'dblogin.php';
			$sql = "SELECT * FROM results ORDER BY result DESC";
			$result = mysql_query($sql);
			if (mysql_num_rows($result) > 0) 
						{
							while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
							{ 
								echo '<li>';
								echo $row['name'];
								echo ": ";
								echo $row['result'];
								echo '</li>';
							}
						}
						else 
						{
							
						}
						
						?>
			</ol>
		</div>
		
		<center><button class="homeButton" onclick="location.href='index.php'">
			Home
    	</button></center>
		
	</div> 

</body>
</html>