<?php
$is_invalid= false;
if($_SERVER["REQUEST_METHOD"]=== "POST"){
   $mysli = require __DIR__ . "/database.php";
   $sql= sprintf("SELECT * FROM users
   WHERE e_mail= '%s'",
  $mysli->real_escape_string ($_POST["e_mail"]));
  $result= $mysli->query($sql);
  $user=$result->fetch_assoc();
  if($user){
   if(password_verify($_POST["password"] , $user["password_hash"])) {
    

        session_start();
        session_regenerate_id();
        $_SESSION["user_id"]=$user["id"];
        header("Location: luxPM.php");
        exit;

   }
  }
  $is_invalid= true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>login</title>
</head>
<body>
    <h1> LUX PM</h1><br>
    <h2>login</h2>

    <?php if($is_invalid): ?>
    <em>логин недействительный</em>
    <?php endif; ?>
    <form method="post">
    <label for="e_mail">e_mail</label>
    <input type="email" name="e_mail" id="e_mail" value="<?= htmlspecialchars($_POST["e_mail"] ?? "") ?>" >
    
    <label for="password"> password</label>
    <input type="password" name="password" id="password">
    <button>login</button>
    </form>
</body>
</html>

<?php

?>