<?php
require_once('Controllers/Conroller.php');
session_set_cookie_params(0);
session_start();
$c = new Controller();
$c->affichereSite();

?>