<?php


require_once('./utils/classeBDD.php');
require_once('./utils/utils.php');
$bdd = new BDD();

$soldeDate = getMaxDate();

$sql = "SELECT max(date) FROM comptes";
$bdd->LireDonneesPDO1($sql,$tab);

$comptesDate = $tab[0]["DATE"];



?>