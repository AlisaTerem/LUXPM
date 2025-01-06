<?php
require_once '../includes/header.php';
if (!user::is_master()) {
    header("Location: /login.php");
    exit;
}
get_header();
?>

<div class="wrapper about flex-col">
    <a class="button link" href="/admin/prices/create.php">Добавить</a>
    <table class="table">
        <thead>
            <tr>
                <th class="table__head-title">Наименование</th>
                <th class="table__head-title">Тип</th>
                <th class="table__head-title">Себестоимость единицы</th>
                <th class="table__head-title">Цена за единицу</th>
                <th class="table__head-title"></th>
                <th class="table__head-title"></th>
            </tr>
        </thead>
        <?php
        $prices = database::query("SELECT * FROM prices");
        if ($prices) {
            foreach ($prices as $price) {
        ?>
                <tr>
                    <td class="table__body-row"><a href="/admin/prices/read.php?id=<?= $price['id']; ?>"><?= $price['title'] ?></a></td>
                    <td class="table__body-row"><?= $price['type'] === '1' ? 'Товар' : 'Услуга' ?></td>
                    <td class="table__body-row"><?= $price['cost'] ?> руб.</td>
                    <td class="table__body-row"><?= $price['price'] ?> руб.</td>
                    <td class="table__body-row"><a href="/admin/prices/update.php?id=<?= $price['id']; ?>">Редактировать</a></td>
                    <td class="table__body-row"><a href="/admin/prices/delete.php?id=<?= $price['id']; ?>">Удалить</a></td>
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