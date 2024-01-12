<?php
define('HOST', 'localhost');
define('USER', 'root');//skynet
define('PASS', '');//IJp37zkzeVAS4HM
define('DATABASE', 'food');//skynet
define('PDODATABASE', 'mysql:dbname=food');//skynet

$db = mysqli_connect(HOST, USER, PASS, DATABASE);
$db_pdo = new PDO(PDODATABASE, USER, PASS);
//$db_pdo = new PDO('mysql:host=skynet.proj.vts.su.ac.rs;dbname=skynet',USER,PASS);
// Check connection
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
