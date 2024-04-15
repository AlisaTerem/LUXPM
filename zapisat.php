<?php
$mysqli = require __DIR__ . "/database.php";

require __DIR__ . '/user.php';

require __DIR__ . '/header.php';
?>
<div class="conteiner">

	<div class="row text-center">

		<div class="col-md-12">
			<?php if (!isset($_GET['master_id'])) : ?>
				<h2 class="mb-3">выберите мастера</h2>
				<table>
					<tr>
						<td style="width:50%;">
							парикмахерские услуги<br>
							<a href="zapisat.php?master_id=1"><img src="img\Alisa.jpg" alt=""height="159" width="130"></a>
						</td>
						<td style="width:50%;">
							перманентный макияж<br>
							<a href="zapisat.php?master_id=2"><img src="img\geka.jpg" height="159" width="130" alt=""></a>
						</td>
					</tr>
				</table>
			<?php else : ?>
				<h2 class="mb-3">выберите услугу</h2>
				<form action="save.php" method="post">
					<div class="form-group">
						<label for="category_id">Услуга</label>
						<select class="form-control" name="category_id">
							<?php
							$sql = sprintf("SELECT * FROM prais_list WHERE mastera_id='{$_GET['master_id']}'");
							$result = $mysqli->query($sql);
							$prais_list = $result->fetch_all();
							?>
							<?php foreach ($prais_list as $item) : ?>
								<option value="<?= $item[0]; ?>"><?= $item[1]; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="start">выберите дату:</label>
						<input type="date" id="start" name="trip-start">
					</div>
					<div class="form-group">
						<label for="time">Время: </label>
						<input type="time" id="time" name="time" />
					</div>
					<button class="btn btn-success" type="submit">сохранить</button>
				</form>
			<?php endif; ?>

		</div>

	</div>

</div>

</body>

</html>