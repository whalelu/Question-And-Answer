<?php

require 'connect.php';

$currentAnswer = $_POST['currentAnswer'];
$is_increase = $_POST['is_increase'];
if(isset($currentAnswer) && isset($is_increase))
{
	if($is_increase == 1)
	{
		$sql = "UPDATE answers
	            SET score = score+1
	            WHERE answer = '{$currentAnswer}'";
	}
	else
	{
		$sql = "UPDATE answers
	            SET score = score-1
	            WHERE answer = '{$currentAnswer}'";
	}

	$result = mysqli_query($conn,$sql);

	$sql = "SELECT score
	        FROM answers
	        WHERE answer = '{$currentAnswer}'";

	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);

	mysqli_close($conn);
	echo json_encode($row);
}
else
{
     echo "<script> alert('Unassigned variable!') </script>";
     echo "<script> window.history.back(); </script>";
}

?>