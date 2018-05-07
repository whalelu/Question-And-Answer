<?php

require 'connect.php';

$questionID = $_POST['questionID'];
if(isset($questionID))
{
	$sql = "DELETE
		    FROM questions
		    WHERE pk_questions = '{$questionID}'";
	$result = mysqli_query($conn,$sql);

	$sql = "DELETE
	    FROM answers
	    WHERE fk_questions = '{$questionID}'";
	$result = mysqli_query($conn,$sql);
}
else
{
     echo "<script> alert('Unassigned variable!') </script>";
     echo "<script> window.history.back(); </script>";
}

mysqli_close($conn);
?>

