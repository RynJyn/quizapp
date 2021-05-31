<?php

session_start();

if($_SESSION['userid'] == "")
{
	header ('Location: index.php');
}

if(!isSet($_GET['qid']))
{
	$qid = 1;
}
else 
{
	$qid = $_GET['qid'];
	if ($_GET['qid'] <= 0 || $_GET['qid'] >= 11)
	{
		$qid = 1;
	}
	
}


if(isSet($_POST['question']))
{
	if(!isSet($_SESSION['answers']))
	{
		$_SESSION['answers'] = "";
	}
	$_SESSION['answers'] = $_SESSION['answers'].$_POST['answercheck'].',';
}
?>

<!DOCTYPE html>

<html>
<head>
<title>Chemical Conundrum | The Quiz</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<script src="js/jquery-1.11.2.min.js"></script>


<body>

<?php echo'<form method="post" id="quizform" action="';
if ($qid == 10)
{
	echo 'results.php';
}
else
{
echo 'quiz.php?qid=';
echo $qid+1;
}
echo '">';
?>
<div class="questionswrap">
<div id="question_<?php echo $_SESSION['questions'][$qid]['id'];?>" class="questions">
<p id="questionnumber">Question <?php echo $qid;?></p>
<p id="questiontitle"><?php echo $_SESSION['questions'][$qid-1]['question'];?></p>

<div id="answerboxes">
<label><input type="radio" value="1" id="radio1_<?php echo $_SESSION['questions'][$qid]['id'];?>" name="answercheck" hidden required /><p id="answerbox1"><?php echo $_SESSION['questions'][$qid-1]['answer1'];?></p></label>
<label><input type="radio" value="2" id="radio2_<?php echo $_SESSION['questions'][$qid]['id'];?>" name="answercheck" hidden required /><p id="answerbox2"><?php echo $_SESSION['questions'][$qid-1]['answer2'];?></p></label>
<label><input type="radio" value="3" id="radio3_<?php echo $_SESSION['questions'][$qid]['id'];?>" name="answercheck" hidden required /><p id="answerbox3"><?php echo $_SESSION['questions'][$qid-1]['answer3'];?></p></label>
<label><input type="radio" value="4" id="radio4_<?php echo $_SESSION['questions'][$qid]['id'];?>" name="answercheck" hidden required /><p id="answerbox4"><?php echo $_SESSION['questions'][$qid-1]['answer4'];?></p></label>
<input type="radio" checked="checked" id="radio5_<?php echo $_SESSION['questions'][$qid]['id'];?>" name="<?php echo $_SESSION['questions'][$qid-1]['id'];?>" hidden />
<button class="resultbutton" onclick="location.href='index.php'">Exit Quiz</button>
<input type="submit" class="resultbutton" id="next<?php echo $_SESSION['questions'][$qid]['id'];?>" value="<?php if($qid == 10){echo "Finish";} else {echo "Next";}?>" name="question"/>
</div>
</div>
</div>
<?php
 ?>

</form>





</body>
</html>