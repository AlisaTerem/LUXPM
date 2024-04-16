<?php

$mysqli = require __DIR__ . "/database.php";

require __DIR__ . '/user.php';

$sql = sprintf(
    "SELECT * FROM otziv",
);
$result = $mysqli->query($sql);
$checki = $result->fetch_all();
require __DIR__ . '/header.php';
?>

<div class="wrapper flex-col about">   
    <h2>Оставьте пожалуйста ваш отзыв, <?= $user["name"];?>!</h2>
    <form action="savotz.php" method="post" class="form__large flex-col">
        <textarea type="text" name="text" class="form-block__input" rows="5" placeholder="Отличный мастер! Спасибо большое"></textarea>
        <button class="button link">Оставить</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th class="table__head-title">Дата</th>
                <th class="table__head-title">Сообщение</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($checki) {
                    foreach ($checki as $check) {
            ?>
                <tr>
                    <td class="table__body-row"><?=$check[3];?></td>
                    <td class="table__body-row"><?=$check[2];?></td>
                </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

    
<?php
    require __DIR__.'/footer.php'; 
?>
