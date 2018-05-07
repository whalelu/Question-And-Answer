<?php

require 'connect.php';

$questionID = $_GET['id'];
if(isset($questionID) && isset($_POST["askInput"]))
{
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
          $sql = "INSERT INTO answers (answer,fk_questions)
         VALUES ('{$question}','{$questionID}')";

          if (mysqli_query($conn, $sql))
          {
               $sql = "UPDATE questions
                       SET is_answered = 1
                       WHERE pk_questions = '{$questionID}'";
               if (mysqli_query($conn, $sql))
               {
                    echo "<script> alert('Insertion succeed!') </script>";
                    echo "<script>window.location.href = '../detail.php?id={$questionID}' </script>";
               }
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