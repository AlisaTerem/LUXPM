<?php
require_once '../../includes/header.php';
if (!user::is_master()) {
    header("Location: /login.php");
    exit;
}
database::basic_query("DELETE FROM prices WHERE id=" . $_GET['id']);
header("location: /admin/prices.php");
