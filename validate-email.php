<?php 

$mysqli= require __DIR__ . "/database.php";

$sql= sprintf("SELECT * FROM users
   WHERE e_mail= '%s'",
  $mysli->real_escape_string ($_GET["e_mail"]));
  $result= $mysli->query($sql);
  $is_availabel =  $result-> num_rows === 0;

  header("Content-Type: application/json");
  echo json_encode(["availabel => is_availabel "]);

?>