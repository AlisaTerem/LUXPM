<?php
session_start();
$mysli = require __DIR__ . "/database.php";

require __DIR__ . '/header.php';
?>
<h1 align="center"> прайс-лист салона LUX PM</h1>
<div>
    <table bgcolor="black">
        <tr>
            <td style="color:white;">
                парикмахерские услуги
            </td>
            <td style="color:white;">
                парикмахерские услуги
            </td>
        </tr>
        <tr>
            <td>
                <?php
                $sql = sprintf("SELECT * FROM prais_list WHERE mastera_id='1'");
                $result = $mysli->query($sql);
                $prais_list = $result->fetch_all();
                ?>
                <table>
                    <tr bgcolor="lightgrey">

                        <th>вид услуги</th>
                        <th>стоимость</th>
                    </tr>
                    <?php
                    if ($prais_list) {
                        foreach ($prais_list as $prais) {
                    ?>
                            <tr bgcolor="white" align="center">

                                <td><?= $prais[1]; ?></td>
                                <td><?= $prais[4]; ?></td>
                            </tr>

                    <?php
                        }
                    }
                    ?>
                </table>
            </td>
            <td>
                <?php
                $sql = sprintf("SELECT * FROM prais_list WHERE mastera_id='2'");
                $result = $mysli->query($sql);
                $prais_list = $result->fetch_all();
                ?>
                <table>
                    <tr bgcolor="lightgrey">

                        <th>вид услуги</th>
                        <th>стоимость</th>
                    </tr>
                    <?php
                    if ($prais_list) {
                        foreach ($prais_list as $prais) {
                    ?>
                            <tr bgcolor="white" align="center">

                                <td><?= $prais[1]; ?></td>
                                <td><?= $prais[4]; ?></td>
                            </tr>

                    <?php
                        }
                    }
                    ?>
                </table>
            </td>

        </tr>

    </table>

</div>
<div>
    <p>Консультация бесплатно. Тест-пряди бесплатно. Цена может быть выше или ниже указанной в прайсе в зависимости от густоты волос и сложности исполнения работы.</p>

    <p>Окончательную цену обсуждайте с мастером на консультации. </p>
</div>
</body>

</html>