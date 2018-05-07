<!DOCTYPE HTML>
<html>
<head>
	<title>Ask</title>
	<link rel="stylesheet" type="text/css" href= "css/style.css" />
</head>

<body>
	<br><br>

	<?php
	$is_ask = $_GET['is_ask'];
	if(isset($is_ask))
	{
		if($is_ask == 1)
			echo "<h2>Ask Question</h2>";
		else
			echo "<h2>Answer Question</h2>";
	}
	else
	{
	     echo "<script> alert('Unassigned variable!') </script>";
	     echo "<script> window.history.back(); </script>";
	}
	?>

	<br><br>

	<?php
	if($is_ask == 0)
	{
		if(isset($_GET['id']))
		{
			echo "<div id='questionDetail'><p>";
			require "database/connect.php";
			$questionID = $_GET['id'];
			$sql = "SELECT question 
			        FROM questions
			        WHERE pk_questions = {$questionID}";
	        $result = mysqli_query($conn,$sql);
	        $row = mysqli_fetch_array($result);
	        echo $row[0];
			echo "</p></div>";
		}
		else
		{
		     echo "<script> alert('Unassigned variable!') </script>";
		     echo "<script> window.history.back(); </script>";
		}
	}
	?>

	<div class="askDiv">

		<?php
		if($is_ask == 1)
		{
			echo "<form action='database/insertQuestion.php' method='post'>";
			echo "<textarea name='askInput' maxlength='500' id='askInput' placeholder='What is your question?'></textarea>";
		}
		else
		{
			echo "<form action='database/insertAnswer.php?id={$questionID}' method='post'>";
			echo "<textarea name='askInput' maxlength='500' id='askInput' placeholder='What is your answer?'></textarea>";
		}
		?>

			<br>
			<p class="remainingCharacters"><span id="num">500</span> characters left</p><br>
			<input type="submit" value="Submit" id="submitQ">
			<input type="button" value="Cancel" id="cancelQ">
		</form>
    </div>

    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/main.js"></script>
 
</body>
</html>