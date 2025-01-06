<?php
require_once 'includes/header.php';
if (!user::id()) {
    header("Location: /login.php");
    exit;
}
get_header();
?>

<div class="wrapper about flex-col">
    <h1 style="color: whitesmoke;">Добро пожаловать в свой профиль, <?= user::name(); ?>!</h1>
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
            $checki = database::query("SELECT `zayavka`.`id` as id, zayavka.vremya_nachala as date, mastera.title as master, prais_list.title as title, prais_list.stoimost as price FROM `zayavka` LEFT JOIN prais_list ON `prais_list`.`id` = zayavka.prais_id LEFT JOIN mastera ON mastera.id = zayavka.mastera_id WHERE zayavka.users_id= '" . user::id() . "' ");
            if ($checki) {
                foreach ($checki as $check) {
            ?>
                    <tr>
                        <td class="table__body-row"><?= date("d.m.Y H:i", strtotime($check['date'])); ?></td>
                        <td class="table__body-row"><?= $check['title'] ?></td>
                        <td class="table__body-row"><?= $check['price'] ?></td>
                        <td class="table__body-row"><?= $check['master'] ?></td>
                    </tr>
                <?php
                }
            } else {
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
        <a href="/comments.php" class="button link">Оставить отзыв</a>
    </div>
</div>


<?php
get_footer();
?>