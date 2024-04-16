
<?php
function shutdown() {
    var_dump(error_get_last());
}
register_shutdown_function('shutdown');

?>
<?php 
if(empty($_POST["name"])){
    die ("введите имя пользователя");
}
if(! filter_var($_POST["e_mail"])){
    die("Eмайл недействителен");
}
if(strlen($_POST["password"]) < 8){
    die("пароль не коррректный");
}
if(!preg_match("/[a-z]/i", $_POST["password"])){
    die("небезопасный пароль");

}
if(!preg_match("/[0-9]/", $_POST["password"])){
    die("небезопасный пароль");
}
if(!preg_match("/[0-9+]/", $_POST["phone"])){
    die("неправильный номер");
}
if($_POST["password"] !==$_POST["password_confimation"]) {
    die("пароли не совпадают");
}
$password_hash= password_hash($_POST["password"],PASSWORD_DEFAULT);



$mysqli= require __DIR__. "/database.php";

$sql= "INSERT INTO users(name, e_mail,phone, password_hash) VALUE(?,?,?,?)";

$stmt=$mysqli->stmt_init();
    if( ! $stmt->prepare($sql)){
        die("сообщение об ошибке". $mysqli->error );
    }
    $stmt->bind_param("ssss",
                        $_POST["name"],
                        $_POST["e_mail"],
                        $_POST["phone"],
                        $password_hash);

  if($stmt->execute()){
    header("location: signal2.php");
    exit;
  }
  else{
    die($mysqli->error . " " . $mysqli->errno);
  }
 
?>
