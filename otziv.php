<?php

$mysqli = require __DIR__ . "/database.php";

require __DIR__ . '/user.php';

$sql = sprintf(
    "SELECT * FROM otziv",
);
$result = $mysqli->query($sql);
$checki = $result->fetch_all();
require __DIR__ . '/header.php';
?>
    <form action="savotz.php" method="post">
    
<h2 style="color: white;">оставьте пожалуйста ваш отзыв,<?= $user["name"];?>!</h2>
<input type="text" name="text">
<button>сохранить</button>
    </form>
    <table>
        <tr bgcolor="lightgrey">
        <th>дата</th>
            <th>сообщение</th>
            
        </tr>
        <?php
        if ($checki) {
            foreach ($checki as $check) {
        ?>
                <tr bgcolor="white" align="center">
                <td><?=$check[3];?></td>
                    <td><?=$check[2];?></td>
                   
                </tr>
        <?php
            }
        }
        ?>

    </table>
</body>
</html>