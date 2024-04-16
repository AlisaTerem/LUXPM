<?php
$mysqli = require __DIR__ . "/database.php";
session_start();
if (isset($_SESSION["user_id"])) {
    $sql = "SELECT * FROM  users
    WHERE id={$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
} else {
    header("location: login.php");
    exit;
}

$sql = "SELECT * FROM prais_list WHERE id={$_POST["category_id"]}";
$result = $mysqli->query($sql);
$usluga = $result->fetch_assoc(); // получаем услугу

$dts = $_POST["trip-start"] . " " . $_POST["time"] . ':00'; // время начала услуги
$dtf = date('Y-m-d H:i:s', strtotime($dts) + (int)$usluga['time'] * 60);

$sql = "SELECT COUNT(*) FROM
zayavka WHERE (vremya_nachala<'{$dts}' AND vremya_okonchania > '{$dts}') OR (vremya_nachala<'{$dtf}' AND vremya_okonchania > '{$dtf}') "; // наложение времени выбранное,с тем которое заняли
$result = $mysqli->query($sql);
$count = (int)$result->fetch_row()[0];

if ($count > 0) {
    header("location: zapisat.php?master_id={$_POST['master_id']}&error=Данное время занято! Выбирите другое время!");
    exit;
}

$sql = "INSERT INTO zayavka( prais_id, vremya_nachala,vremya_okonchania, users_id, mastera_id) VALUE(?,?,?,?,?)";

$stmt = $mysqli->stmt_init();
if (!$stmt->prepare($sql)) {
    die("сообщение об ошибке" . $mysqli->error);
}
$stmt->bind_param(
    "sssss",
    $_POST["category_id"],
    $dts,
    $dtf,
    $user["id"],
    $_POST["master_id"]
);


if ($stmt->execute()) {
    header("location: lk.php");
    exit;
} else {
    die($mysqli->error . " " . $mysqli->errno);
}
