<!DOCTYPE html>
<html>
<head>
	<title>Detail</title>
	<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href= "css/style.css" />
</head>
<body>
	<br><br>
	<h2>Question Detail</h2>
	<br><br>
	<div id="questionDetail">
		<p>
			<?php
			require "database/connect.php";
			$questionID = $_GET['id'];
			if(isset($questionID))
			{
				$sql = "SELECT question 
				        FROM questions
				        WHERE pk_questions = {$questionID}";
		        $result = mysqli_query($conn,$sql);
		        $row = mysqli_fetch_array($result);
		        echo $row[0];
			}
			else
			{
			     echo "<script> alert('Unassigned variable!') </script>";
			     echo "<script> window.history.back(); </script>";
			}
			?>
		</p>
	</div>
	<div id="detailButtons">
		<button id="answerButton">Answer</button>
		<button id="deleteButton">Delete</button>
		<button id="backButton">Back</button>
	</div>
	<br>
	<hr id="cuttingLine">
	<br>
	<?php
	require "database/connect.php";
	$questionID = $_GET['id'];
	$sql = "SELECT answer,score
	        FROM answers
	        WHERE fk_questions = {$questionID}";
	$result = mysqli_query($conn,$sql);
	$rownum = mysqli_num_rows($result);
	for($i=0;$i<$rownum;$i++)
	{
		$row = mysqli_fetch_array($result);
		echo "<div class='answerField' id='answer";
		echo $i + 1;
		echo "'>";
		echo $row[0];
		echo "</div><div class='upAndDown'><span class='score' id='score";
		echo $i + 1;
		echo "'>";
		echo $row[1];
		echo "</span>&nbsp;&nbsp;&nbsp;<button class='upButton' id='upButton";
		echo $i + 1;
		echo "'><span class='glyphicon glyphicon-thumbs-up'></span></button>";
		echo "&nbsp;&nbsp;&nbsp;<button class='downButton' id='downButton";
		echo $i + 1; 
		echo "'><span class='glyphicon glyphicon-thumbs-down'></span></button>";
		echo "</div><br>";
	}
	?>

	<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>