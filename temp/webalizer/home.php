<?php 
session_start();
if (isset($_SESSION["user_id"])){
    $mysqli= require __DIR__ . "/database.php";
    $sql="SELECT * FROM  users
    WHERE id={$_SESSION["user_id"]}";
    $result=$mysqli->query($sql);
   $user= $result->fetch_assoc();
}

 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Home</title>
</head>
<body>
    <h1> вы вошли в систему LUX PM</h1>

    <?php if (isset($user)):?>
        <p>добро пожаловать <?=htmlspecialchars( $user["name"]) ?></p>
        <a href="luxPM.php">вперед<a> <br>
         <a href="logout.php">назад</a>

    <?php else: ?>
         <a href="login.php"> войти в систему</a> или <a href="signal.html">зарегистрируйся</a>
    ]<?php endif; ?>
</body>
</html>
