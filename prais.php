<?php
session_start();
$mysli = require __DIR__ . "/database.php";
$sql = sprintf(
    "SELECT * FROM prais_list "
    
);
$result = $mysli->query($sql);
$prais_list = $result->fetch_all();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<img src="img\luxPM1.jpg" height="400" width="1300">
    <div  align="center">
    <a href="luxPM.php">
    <button>главная</button></a>
    <a href="onas.php">
    <button> о нас</button> </a>
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
    <h1 align="center"> прайс-лист салона LUX PM</h1>
   <div>
    <table bgcolor="black">
       
    <caption style="text-align: center; color: #fff;">парикмахерские услуги</caption>
    <tr bgcolor="lightgrey">

        <th>вид услуги</th>
        <th>стоимость</th>
   </tr>
    <?php
        if ($prais_list) {
            foreach ($prais_list as $prais) {
        ?>
                <tr bgcolor="white" align="center">
                
                    <td><?=$prais[1];?></td>
                    <td><?=$prais[4];?></td>
                </tr>
                
        <?php
            }
        }
        ?>





    </table>
   
</div>
<div> <p>Консультация бесплатно. Тест-пряди бесплатно. Цена может быть выше или ниже указанной в прайсе в зависимости от густоты волос и сложности исполнения работы.</p>

<p>Окончательную цену обсуждайте с мастером на консультации. </p>
</div>
</body>
</html>