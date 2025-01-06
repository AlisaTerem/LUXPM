<?php
require_once '../../includes/header.php';
if (!user::is_master()) {
    header("Location: /login.php");
    exit;
}

$id = database::escape_string($_GET['id']);
$item = database::query("SELECT * FROM prices WHERE id='{$id}'", true);

if (!$item) {
    header("location: /admin/prices.php");
    exit;
}

get_header();
?>

<div class="wrapper about flex-col">
    <div>Наименование: <?=$item['title']?></div>
    <?php 
    $info = database::query("SELECT COUNT(id) as count, SUM(count) as sum FROM checks_positions WHERE prices_id='{$id}'", true);
    ?>
    <div>Количество использований: <?=$info['count']?></div>
    <div>Всего потрачено единиц: <?=$info['sum']?></div>
</div>

<?php
get_footer();
?>