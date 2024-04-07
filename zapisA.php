<?php
session_start();
$mysqli = require __DIR__ . "/database.php";
$sql = sprintf("SELECT * FROM prais_list");
$result = $mysqli->query($sql);
$prais_list = $result->fetch_all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="css\style.css">
</head>

<body>
<img src="img\luxPM1.jpg" height="400" width="1300">
    <div  align="center">
    <a href="luxPM.php">
    <button>главная</button></a>
    <a href="onas.php">
    <button> о нас </button> </a>
    <a href="prais.php">
    <button><b>парикмахерские услуги</b></button> </a>
	<a href="praisPM.php">
    <button><b> перманентный макияж</b></button> </a>
    <a href="rabota.php">
    <button>наши работы</button> </a>
    <a href="zapisat.php">
    <button>записаться</button></a>
    <a href="otziv.php">
    <button>отзывы</button></a>
    <a href="lk.php">
    <button>личный кабинет</button></a>
    </div>
	<div class="conteiner">

		<div class="row text-center">

			<div class="col-md-12">
				<h2 class="mb-3">выберите услугу</h2>
				<form action="save.php" method="post">


					<div class="form-group">
						<label for="category_id">Услуга</label>
						<select class="form-control" name="category_id">
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

			</div>

		</div>

	</div>

</body>

</html>