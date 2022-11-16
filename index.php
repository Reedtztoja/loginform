<?php
require('class/User.class.php');

$db = new mysqli('localhost', 'root', '', 'loginForm');
$user = new User("jkowalski","tajnehaslo");
$user->register();
//$user->login();
var_dump($db);



?>