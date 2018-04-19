<?php
  $user = htmlentities($_POST["user"]);
  $comment = htmlentities($_POST["comment"]);
  $server = "127.0.0.1";
  $conn = mysqli_connect($server, "root", "", "bookclub");
  if (mysqli_connect_errno())
  {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  var_dump($user);
  $request = "INSERT INTO comments (user, comment) VALUES ('".$user."', '".$comment."')";
  echo $request;
  mysqli_query($conn, $request);
  
  mysqli_close($conn);
   
?>

