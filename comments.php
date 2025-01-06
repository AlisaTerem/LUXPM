<?php
require_once 'includes/header.php';

if (user::id() && $_SERVER["REQUEST_METHOD"] === "POST") {
    $id = user::id();
    $otziv = database::escape_string($_POST['text']);
    database::basic_query("INSERT INTO otziv( users_id, otziv) VALUE('{$id}', '{$otziv}')");
    header("Location: /comments.php");
}

get_header();
?>

<div class="wrapper flex-col about">
    <?php if (user::id()) : ?>
        <h2>Оставьте пожалуйста ваш отзыв, <?= user::name() ?>!</h2>
        <form action="comments.php" method="post" class="form__large flex-col">
            <textarea type="text" name="text" class="form-block__input" rows="5" placeholder="Отличный мастер! Спасибо большое"></textarea>
            <button class="button link">Оставить</button>
        </form>
    <?php endif; ?>
    <table class="table">
        <thead>
            <tr>
                <th class="table__head-title">Клиент</th>
                <th class="table__head-title">Дата</th>
                <th class="table__head-title">Сообщение</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $comments = database::query("SELECT name,data,otziv FROM otziv LEFT JOIN users ON otziv.users_id = users.id ORDER BY otziv.data DESC");
            if ($comments) {
                foreach ($comments as $comment) {
            ?>
                    <tr>
                        <td class="table__body-row"><?= $comment['name']; ?></td>
                        <td class="table__body-row"><?= $comment['data']; ?></td>
                        <td class="table__body-row"><?= $comment['otziv']; ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php
get_footer();
?>