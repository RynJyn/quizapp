<?php
require_once 'dblogin.php';

$result=mysql_query("SELECT * FROM questions LIMIT 10");
	 $i=1;
	 $right_answer=0;
	 $wrong_answer=0;
	 $unanswered=0;
	 while($row=mysql_fetch_array($result)){ 
	       if($row['answer']==$_POST["$i"]){
		       $right_answer++;
		   }
		   else{
		       $wrong_answer++;
		   }
		   $i++;
	 }
	 echo "<div id='answer'>";
	 echo " Right Answers  : <span class='highlight'>". $right_answer."</span><br>";

	 echo " Wrong Answers  : <span class='highlight'>". $wrong_answer."</span><br>";

	 echo "</div>";
?>