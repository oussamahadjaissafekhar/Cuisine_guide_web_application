<?php
require_once('../Controllers/Conroller.php');
session_start();
$c = new Controller();
$c->affichereParametre();

?>