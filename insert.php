<?php

require_once('./utils/classeBDD.php');
require_once('./utils/utils.php');


$date = $_POST['date'];
$libelle = $_POST['libelle'];
$op = $_POST['op'];
$type = $_POST['type'];
$montant = $_POST['montant'];
$bdd = new BDD();

function isInBase($date, $libelle, $op, $type, $montant)
{
    global $bdd;

    $sql = "SELECT * from comptes
            WHERE date = :date and libelle =:libelle and operation = :op and montant = :montant and type = :typ";

    $cur = $bdd->preparerRequetePDO($sql);
    $bdd->ajouterParamPDO($cur, ':date', $date);
    $bdd->ajouterParamPDO($cur, ':libelle', $libelle);
    $bdd->ajouterParamPDO($cur, ':op', $op);
    $bdd->ajouterParamPDO($cur, ':montant', $montant);
    $bdd->ajouterParamPDO($cur, ':typ', $type);

    $tab = $bdd->LireDonneesPDOPreparee($cur);
    if (count($tab) > 0) {
        return true;
    } else {
        return false;
    }
}



if (!isInBase($date, $libelle, $op, $type, $montant)) {


    $type = getCatByName($type)[0]["categorie"];


$sql = "INSERT INTO comptes(date,libelle,Operation,montant,type,email)
            VALUES(:date,:libelle,:op,:montant,:typ,'clement.hellot@yahoo.fr')";
     
     
    $cur = $bdd->preparerRequetePDO($sql);
    $bdd->ajouterParamPDO($cur, ':date', $date);
    $bdd->ajouterParamPDO($cur, ':libelle', $libelle);
    $bdd->ajouterParamPDO($cur, ':op', $op);
    $bdd->ajouterParamPDO($cur, ':montant', $montant);
    $bdd->ajouterParamPDO($cur, ':typ', $type);
    $bdd->majDonneesPrepareesPDO($cur);

} else {
    echo "abc";
}
