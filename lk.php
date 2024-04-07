<?php
session_start();
$mysli = require __DIR__ . "/database.php";

if (isset($_SESSION["user_id"])) {
    $sql = "SELECT * FROM  users
    WHERE id={$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}

$sql = sprintf(
    "SELECT * FROM checki   WHERE users_id= '%s'",
    $mysli->real_escape_string($user["id"])
);
$result = $mysli->query($sql);
$checki = $result->fetch_all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="css\style.css">
    <title>Document</title>
</head>

<body>
<img src="img\EA (2).jpg" height="400" width="1300">
    <div  align="center">
    <a href="luxPM.php">
    <button>главная</button></a>
    <a href="onas.php">
    <button> о нас </button> </a>
    <a href="prais.php">
    <button><b>парикмахерские услуги</b></button> </a>
    <a href="praisPM.php">
    <button><b> перманентный макияж</b></button> </a>
    <a href="rabota.php">
    <button>наши работы</button> </a>
    <a href="zapisat.php">
    <button>записаться</button></a>
    <a href="otziv.php">
    <button>отзывы</button></a>
    <a href="lk.php">
    <button>личный кабинет</button></a>
    </div>

<h1 style="color: whitesmoke;">добро пожаловать в свой профиль,<?= $user["name"]; ?>!</h1>
<h2>услуги, которые вам  оказали салон</h2>
<table>
        <tr bgcolor="lightgrey">
        <th>дата</th>
            <th>услуга</th>
            <th>стоимость</th>
        </tr>
        <?php
        if ($checki) {
            foreach ($checki as $check) {
        ?>
                <tr bgcolor="white" align="center">
                <td><?=$check[2];?></td>
                    <td><?=$check[3];?></td>
                    <td><?=$check[4];?></td>
                </tr>
        <?php
            }
        }
        ?>

    </table>
    <a href="otziv.php">
    <button>оставить отзыв</button></a>






</body>

</html>