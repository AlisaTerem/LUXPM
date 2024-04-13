<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$mysli = require __DIR__ . "/database.php";

require __DIR__ . '/user.php';

$sql = sprintf(
    "SELECT * FROM checki   WHERE users_id= '%s'",
    $mysli->real_escape_string($user["id"])
);
$result = $mysli->query($sql);
$checki = $result->fetch_all();

require __DIR__ . '/header.php';

?>

<h1 style="color: whitesmoke;">добро пожаловать в свой профиль,<?= $user["name"]; ?>!</h1>
<h2>услуги, которые вам  оказали салон</h2>
<table>
        <tr bgcolor="lightgrey">
        <th>дата</th>
            <th>услуга</th>
            <th>стоимость</th>
        </tr>
        <?php
        if ($checki) {
            foreach ($checki as $check) {
        ?>
                <tr bgcolor="white" align="center">
                <td><?=$check[2];?></td>
                    <td><?=$check[3];?></td>
                    <td><?=$check[4];?></td>
                </tr>
        <?php
            }
        }
        ?>

    </table>
    <a href="otziv.php">
    <button>оставить отзыв</button></a>
    <a href="start.php">
    <button>выход</button></a>






</body>

</html>