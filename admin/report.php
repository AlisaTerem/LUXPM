<?php
require_once '../includes/header.php';
if (!user::is_master()) {
    header("Location: /login.php");
    exit;
}

$level = $_POST['level'] ?? 1;
$master = $_POST['master'] ?? 0;
$client = $_POST['client'] ?? 0;

get_header();
?>

<div class="wrapper about flex-col">
    <form method="post" class="flex-col form__large">
        <div class="flex-col form-block">
            <select name="level" class="form-block__input">
                <option value="0" <?= $level == 0 ? 'selected' : '' ?>>Год</option>
                <option value="1" <?= $level == 1 ? 'selected' : '' ?>>Месяц</option>
                <option value="2" <?= $level == 2 ? 'selected' : '' ?>>День</option>
            </select>
        </div>
        <div class="flex-col form-block">
            <select name="master" class="form-block__input">
                <option value="0">Все мастера</option>
                <?php
                foreach (database::query("SELECT * FROM users WHERE is_master=1") as $user) {
                    echo '<option value="' . $user['id'] . '" ' . ($master == $user['id'] ? 'selected' : '') . '>' . $user['name'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="flex-col form-block">
            <select name="client" class="form-block__input">
                <option value="0">Все клиенты</option>
                <?php
                foreach (database::query("SELECT * FROM users WHERE is_master=0") as $user) {
                    echo '<option value="' . $user['id'] . '" ' . ($client == $user['id'] ? 'selected' : '') . '>' . $user['name'] . '</option>';
                }
                ?>
            </select>
        </div>
        <button class="button link">Применить</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th class="table__head-title">Год</th>
                <?php
                if ($level > 0) {
                    echo '<th class="table__head-title">Месяц</th>';
                }
                if ($level > 1) {
                    echo '<th class="table__head-title">День</th>';
                }
                ?>
                <th class="table__head-title">Сумма</th>
            </tr>
        </thead>
        <?php

        $query  = "SELECT YEAR(date) as year";

        if ($level > 0) {
            $query .= ", MONTH(date) as month";
        }
        if ($level > 1) {
            $query .= ", DAY(date) as day";
        }

        $query .= ", SUM(cost) as sum_cost, SUM(total) as sum_total  FROM checks";
        
        if ($master > 0 || $client > 0) {
            $query .= " WHERE";
        }

        if ($master > 0) {
            $query .= " master_id='{$master}'";
        }
        
        if ($master > 0 && $client > 0) {
            $query .= " AND";
        }

        if ($client > 0) {
            $query .= " user_id='{$client}'";
        }

        $query .= " GROUP BY YEAR(date)";

        if ($level > 0) {
            $query .= ", MONTH(date)";
        }
        if ($level > 1) {
            $query .= ", DAY(date)";
        }

        $query .= " ORDER BY date DESC";

        $prices = database::query($query);
        if ($prices) {
            foreach ($prices as $price) {
        ?>
                <tr>
                    <td class="table__body-row"><?= $price['year'] ?></td>
                    <?php
                    if ($level > 0) {
                        echo '<td class="table__body-row">' . month($price['month']) . '</td>';
                    }
                    if ($level > 1) {
                        echo '<td class="table__body-row">' . $price['day'] . '</td>';
                    }
                    ?>
                    <td class="table__body-row"><?= $price['sum_total'] - $price['sum_cost'] ?></td>
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