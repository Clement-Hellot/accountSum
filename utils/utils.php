<?php

function is_logged()
{
    if (isset($_SESSION["EMAIL"]))
        return true;
    return false;
}

function getMaxDate()
{
    global $bdd;
    $sql = "SELECT max(date) as date from solde";

    $bdd->LireDonneesPDO1($sql, $tab);
    return $tab[0]["date"];
}

function getLogin()
{
    global $bdd;
    $sql = "SELECT  * from login
            where email = :email";
    $cur = $bdd->preparerRequetePDO($sql);
    $bdd->ajouterParamPDO($cur, 'email', $_SESSION['EMAIL']);
    $tab = $bdd->LireDonneesPDOPreparee($cur);

    return $tab[0];
}

function getSolde($date)
{
    global $bdd;
    $sql = "SELECT montant from solde
            Where date = :date";
    $cur = $bdd->preparerRequetePDO($sql);
    $bdd->ajouterParamPDO($cur, ':date', $date);
    $tab = $bdd->LireDonneesPDOPreparee($cur);

    if (count($tab) > 0)
        return round($tab[0]["montant"], 2);
    else
        return null;
    echo "Erreur : pas de montant a cette date";
}

function getMois()
{
    global $bdd;

    $sql = "SELECT  DateName( month , DateAdd( month , MONTH(date) , 0 ) - 1 ) as mois from comptes 
    GROUP by MONTH(Date)
    order by MONTH(date)  ";

    $bdd->LireDonneesPDO1($sql, $tab);
    return $tab;
}

function getCat()
{
    global $bdd;
    $sql = "SELECT  * from code_type ";
    $bdd->LireDonneesPDO1($sql, $tab);
    return $tab;
}


function getCatByName($name)
{
    global $bdd;
    $sql = "SELECT libelle,cat as categorie from code_type 
    where libelle = :lib
    order by libelle";

    $cur = $bdd->preparerRequetePDO($sql);
    $bdd->ajouterParamPDO($cur, ':lib', $name);
    $tab = $bdd->LireDonneesPDOPreparee($cur);
    return $tab;
}
function getCatByAbr($name){
    global $bdd;
    $sql = "SELECT libelle,cat as categorie from code_type 
    where cat   = :cat
    order by libelle";

    $cur = $bdd->preparerRequetePDO($sql);
    $bdd->ajouterParamPDO($cur, ':cat', $name);
    $tab = $bdd->LireDonneesPDOPreparee($cur);
    return $tab;
}

function remplirOption($tab, $nbLignes, $col, $default)
{

    for ($i = 0; $i < $nbLignes; $i++) {
        $value = $tab[$i][$col];
        echo $default;
        echo $value;
        if (!empty($default) && $default == $value)
            echo '<option value="' . $value . '" selected="selected">' . $value . '</option>';
        else
            echo '<option value="' . $value . '">' . $value . '</option>';
    }
}

function getCatLib()
{
    global $bdd;
    $sql = "SELECT libelle,cat as categorie from cat_libelle 
    order by libelle";

    $bdd->LireDonneesPDO1($sql, $tab);
    return $tab;
}

function getCatLibByName($name)
{
    global $bdd;
    $sql = "SELECT libelle,cat as categorie from cat_libelle 
    where libelle = :lib
    order by libelle";

    $cur = $bdd->preparerRequetePDO($sql);
    $bdd->ajouterParamPDO($cur, ':lib', $name);
    $tab = $bdd->LireDonneesPDOPreparee($cur);
    return $tab;
}

function addCatLib($cat, $lib)
{
    global $bdd;

    if (count(getCatLibByName($lib)) == 0) {
        $sql = "INSERT into cat_libelle(cat,libelle) VALUES (:cat,upper(:lib))";
        $cur = $bdd->preparerRequetePDO($sql);

        $bdd->ajouterParamPDO($cur, ':cat', $cat);
        $bdd->ajouterParamPDO($cur, ':lib', $lib);
        $bdd->majDonneesPrepareesPDO($cur);
    }
}
function addCat($cat, $lib)
{
    global $bdd;

    if (count(getCatByName($lib)) == 0) {
        $sql = "INSERT into code_type(cat,libelle) VALUES (upper(:cat),upper(:lib))";
        $cur = $bdd->preparerRequetePDO($sql);

        $bdd->ajouterParamPDO($cur, ':cat', $cat);
        $bdd->ajouterParamPDO($cur, ':lib', $lib);
        $bdd->majDonneesPrepareesPDO($cur);
    }
}