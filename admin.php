<?php
require_once 'includes/header.php';
if (!user::is_master()) {
    header("Location: /login.php");
    exit;
}
get_header();
?>

<div class="wrapper about flex-col">
    <div><a href="/admin/report.php" class="button link">Отчет</a></div>
    <hr>
    <div><a href="/admin/checks.php" class="button link">Управление чеками</a></div>
    <div><a href="/admin/prices.php" class="button link">Управление товарами и услугами</a></div>
    <hr>
    <div><a href="/logout.php" class="button link red">Выход</a></div>
</div>

<?php
get_footer();
?>