<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$mysli = require __DIR__ . "/database.php";

require __DIR__ . '/user.php';

$sql = sprintf(
    "SELECT `zayavka`.`id`, zayavka.vremya_nachala, mastera.title, prais_list.title, prais_list.stoimost FROM `zayavka` LEFT JOIN prais_list ON `prais_list`.`id` = zayavka.prais_id LEFT JOIN mastera ON mastera.id = zayavka.mastera_id WHERE zayavka.users_id= '%s' ",
    $mysli->real_escape_string($user["id"])
);
$result = $mysli->query($sql);
$checki = $result->fetch_all();

require __DIR__ . '/header.php';

?>

<div class="wrapper about flex-col">
    <h1 style="color: whitesmoke;">Добро пожаловать в свой профиль, <?= $user["name"]; ?>!</h1>
    <h2>Услуги, которые вам оказал салон</h2>
    <table class="table">
        <thead>
            <tr>
                <th class="table__head-title">Дата</th>
                <th class="table__head-title">Услуга</th>
                <th class="table__head-title">Стоимость</th>
                <th class="table__head-title">Мастер</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $rows_added = false;
                if ($checki) {
                    foreach ($checki as $check) {
                        $rows_added = true;
            ?>
            <tr>
                <td><?=date("d.m.Y H:i", strtotime($check[1]));?></td>
                <td class="table__body-row"><?=isset($check[3]) ? $check[3] : '&mdash;';?></td>
                <td class="table__body-row"><?=isset($check[4]) ? $check[4] : '&mdash;';?></td>
                <td class="table__body-row"><?=isset($check[2]) ? $check[2] : '&mdash;';?></td>
            </tr>
            <?php
                    }
                }
                if (!$rows_added) {
            ?>
            <tr>
                <td class="table__body-row">&mdash;</td>
                <td class="table__body-row">&mdash;</td>
                <td class="table__body-row">&mdash;</td>
                <td class="table__body-row">&mdash;</td>
            </tr>
            <?php
                }
            ?>
        </tbody>


    </table>
    <div>
        <a href="otziv.php" class="button link">Оставить отзыв</a>
        <a href="start.php" class="button link red">Выход</a>
    </div>
</div>

<?php
    require __DIR__.'/footer.php'; 
?>
