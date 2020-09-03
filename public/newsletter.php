<?php

// database
define('SERVERNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DBNAME', 'hotel');

$pdo = new PDO('mysql:host=' .SERVERNAME. ';dbname=' .DBNAME, USERNAME, PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$email = $_GET['email'];
$sql = "INSERT INTO newsletter (email) VALUES (?)";
$pdo->prepare($sql)->execute([$email]);

echo '
{
    "status": "done"
}
';

?>