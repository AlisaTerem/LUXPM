<?php

$mysqli = require __DIR__ . "/database.php";
session_start();
if (isset($_SESSION["user_id"])) {
    $sql = "SELECT * FROM  	users
    WHERE id={$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
} else {
    header("location: login.php");
    exit;
}
$sql = "INSERT INTO otziv( users_id, otziv) VALUE(?,?)";

$stmt = $mysqli->stmt_init();
if (!$stmt->prepare($sql)) {
    die("сообщение об ошибке" . $mysqli->error);
}
$stmt->bind_param(
    "ss",
    $user["id"],
    $_POST['text']


);


if ($stmt->execute()) {
    header("location:otziv.php");
    exit;
} else {
    die($mysqli->error . " " . $mysqli->errno);
}

