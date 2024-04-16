<?php //отвечает за подключение к базе данных
$host="localhost";
$dbname="login_db";
$username="root";
$password="";

    $mysqli= new mysqli(hostname:$host, 
                        username:$username,
                        database:$dbname,
                        password:$password);
    
if($mysqli->connect_errno){
    die("ошибка" . $mysqli->connect_errno);
}
return $mysqli;
?>