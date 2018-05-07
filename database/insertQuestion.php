<?php

require 'connect.php';

if(isset($_POST["askInput"]))
{
     //trim input
     if ($_SERVER["REQUEST_METHOD"] == "POST")
     {
          $question = trim($_POST["askInput"]);
     }

     if($question == "")
     {
          echo "<script> alert('The input field is null!') </script>";
          echo "<script> window.history.back(); </script>";
     }
     else
     {
          $sql = "INSERT INTO questions (question, createTime)
                  VALUES ('{$question}', now())";

          if (mysqli_query($conn, $sql))
          {
               echo "<script> alert('Insertion succeed!') </script>";
               echo "<script> window.location.href = '../index.php' </script>";
          } 
          else
          {
               echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
          mysqli_close($conn);
     }
}
else
{
     echo "<script> alert('Unassigned variable!') </script>";
     echo "<script> window.history.back(); </script>";
}

?>
