<?php 
 
$localhost = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "lista"; 
 
// create connection 
$connect = new mysqli($localhost, $username, $password, $dbname); 
 
// check connection 
if($connect->connect_error) {
    die("Falha na conexão : " . $connect->connect_error);
} else {
  //echo "Banco conectado com sucesso!";
}
 
?>