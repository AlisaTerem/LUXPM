<?php
require_once '../includes/header.php';
if (!user::is_master()) {
    header("Location: /login.php");
    exit;
}
get_header();
?>

<div class="wrapper about flex-col">
    <a class="button" href="/admin/checks/create.php">Добавить</a>
    <table class="table">
        <thead>
            <tr>
                <th class="table__head-title">Дата</th>
                <th class="table__head-title">Мастер</th>
                <th class="table__head-title">Клиент</th>
                <th class="table__head-title">Сумма</th>
                <th class="table__head-title"></th>
                <th class="table__head-title"></th>
            </tr>
        </thead>
        <?php
        $prices = database::query("SELECT checks.id as id, checks.total as total, masters.name as master, users.name as client, checks.date as date FROM checks LEFT JOIN users ON `checks`.user_id=`users`.id LEFT JOIN users as masters ON `checks`.master_id=`masters`.id");
        if ($prices) {
            foreach ($prices as $price) {
        ?>
                <tr>
                    <td class="table__body-row"><a href="/admin/checks/read.php?id=<?= $price['id']; ?>"><?= $price['date'] ?></a></td>
                    <td class="table__body-row"><?= $price['master'] ?></td>
                    <td class="table__body-row"><?= $price['client'] ?></td>
                    <td class="table__body-row"><?= $price['total'] ?></td>
                    <td class="table__body-row"><a href="#?id=<?= $price['id']; ?>">Редактировать</a></td>
                    <td class="table__body-row"><a href="/admin/checks/delete.php?id=<?= $price['id']; ?>">Удалить</a></td>
                </tr>

        <?php
            }
        }
        ?>

    </table>
</div>

<?php
get_footer();
?>