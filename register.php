<?php 
if(isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
    require_once('config.php');
    require_once('class/User.class.php');
    $user = new User($_REQUEST['login'], $_REQUEST['password']);
    $user->setFirstName($_REQUEST['firstName']);
    $user->setLastName($_REQUEST['lastName']);
    if($user->register()) {
        echo "Zarejestrowano poprawnie";
    } else {
        echo "Błąd rejestracji użytkownika";
    }
}
?>