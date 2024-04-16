<?php
session_start();
$mysqli = require __DIR__ . "/database.php";

if (isset($_SESSION["user_id"])) {
    $sql = "SELECT * FROM  users
    WHERE id={$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
} else {
    header("Location: login.php");
    exit;
}
