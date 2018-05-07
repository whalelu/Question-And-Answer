<?php

require 'connect.php';

$searchCondition = $_POST['searchCondition'];
$searchRadio = $_POST['searchRadio'];

if(isset($searchCondition) && isset($searchRadio))
{
	//获取前三个关键字
	if(!empty($searchCondition[0]))
	{
		$key1 = $searchCondition[0];
	}
	if(!empty($searchCondition[1]))
	{
		$key2 = $searchCondition[1];
	}
	if(!empty($searchCondition[2]))
	{
		$key3 = $searchCondition[2];
	}


	//根据radio和关键字个数的不同，执行不同的SQL命令
	if($searchRadio == -1)
	 {
		if(!empty($key3))
		{
			$sql = "SELECT * 
			        FROM questions
			        WHERE question LIKE '%{$key1}%' AND 
			              question LIKE '%{$key2}%' AND 
			              question LIKE '%{$key3}%'
			        ORDER BY createTime DESC" ;
		}
		elseif(!empty($key2))
		{
			$sql = "SELECT * 
			        FROM questions
			        WHERE question LIKE '%{$key1}%' AND 
			              question LIKE '%{$key2}%'
			        ORDER BY createTime DESC" ;
		}
		elseif (!empty($key1))
		{
			$sql = "SELECT * 
			        FROM questions
			        WHERE question LIKE '%{$key1}%'
			        ORDER BY createTime DESC" ;
		}
		else
		{
			$sql = "SELECT * 
			        FROM questions
			        ORDER BY createTime DESC" ;
		}
	}
	else
	{
		if(!empty($key3))
		{
			$sql = "SELECT * 
			        FROM questions
			        WHERE question LIKE '%{$key1}%' AND 
			              question LIKE '%{$key2}%' AND 
			              question LIKE '%{$key3}%' AND
			              is_answered = {$searchRadio}
			        ORDER BY createTime DESC" ;
		}
		elseif(!empty($key2))
		{
			$sql = "SELECT * 
			        FROM questions
			        WHERE question LIKE '%{$key1}%' AND 
			              question LIKE '%{$key2}%' AND
			              is_answered = {$searchRadio}
			        ORDER BY createTime DESC" ;
		}
		elseif (!empty($key1))
		{
			$sql = "SELECT * 
			        FROM questions
			        WHERE question LIKE '%{$key1}%' AND
			              is_answered = {$searchRadio}
			        ORDER BY createTime DESC" ;
		}
		else
		{
			$sql = "SELECT * 
			        FROM questions
			        WHERE is_answered = {$searchRadio}
			        ORDER BY createTime DESC" ;
		}
	}

	$result = mysqli_query($conn,$sql);


	$rownum = mysqli_num_rows($result);//获取result的数据数量  
	for($i=0;$i<$rownum;$i++){  
	    $row[$i] = mysqli_fetch_assoc($result);//获取result的一条数据  
	}
	mysqli_close($conn);
	echo json_encode($row); 
}
else
{
     echo "<script> alert('Unassigned variable!') </script>";
     echo "<script> window.history.back(); </script>";
}



?>