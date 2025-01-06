<?php
require_once '../../includes/header.php';
if (!user::is_master()) {
    header("Location: /login.php");
    exit;
}

$id = database::escape_string($_GET['id']);
$item = database::query("SELECT * FROM checks WHERE id='{$id}'", true);

if (!$item) {
    header("location: /admin/checks.php");
    exit;
}

get_header();
?>

<div class="wrapper about flex-col">
    <div>Дата и время: <?=$item['date']?></div>
    <div>Мастер: <?=database::query("SELECT name FROM users WHERE id='{$item['master_id']}'", true)['name']?></div>
    <div>Клиент: <?=database::query("SELECT name FROM users WHERE id='{$item['user_id']}'", true)['name']?></div>
    <div>Сумма: <?=$item['total']?></div>
    <table class="table">
        <thead>
            <tr>
                <th class="table__head-title">Наименование</th>
                <th class="table__head-title">Количество</th>
            </tr>
        </thead>
        <?php
        $prices = database::query("SELECT prices.title as title, checks_positions.count as count FROM checks_positions LEFT JOIN prices ON `checks_positions`.prices_id=`prices`.id WHERE checks_positions.check_id='{$id}'");
        if ($prices) {
            foreach ($prices as $price) {
        ?>
                <tr>
                    <td class="table__body-row"><?= $price['title'] ?></td>
                    <td class="table__body-row"><?= $price['count'] ?></td>
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