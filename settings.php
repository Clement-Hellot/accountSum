<?php
require('./utils/utils.php');
require_once('./utils/classeBDD.php');

session_save_path('./login');
session_start();

$bdd = new BDD();


function getTab($tab)
{


    if ($tab != null && count($tab) > 0) {
        echo "<table class='tbl-account'>
    <thead>";
        $i = 0;

        foreach ($tab as $tab => $line) {
            echo "<tr>";
            if ($i == 0) {
                foreach ($line as $key => $value) {
                    echo '<th>' . strtoupper($key) . '</th>';
                }
                echo "</thead>
                <tbody><tr>";
                $i = 1;
            }
            foreach ($line as $key => $value) {
                echo '<td>' . $value . '</td>';
            }
            echo "</tr>";
        }
        echo "</tr>
    </tbody>
    </table>";
    } else {
        echo "Il n'y a pas encore d'association";
    }
}




if (!empty($_POST['nom'])) {
    $sql = "UPDATE login 
            set prenom = :prenom
            where email = :email";
    $cur = $bdd->preparerRequetePDO($sql);
    $bdd->ajouterParamPDO($cur, ':prenom', $_POST['nom']);
    $bdd->ajouterParamPDO($cur, ':email', $_SESSION["EMAIL"]);
    $bdd->majDonneesPrepareesPDO($cur);
}

if (!empty($_POST['date'])) {
    $sql = "UPDATE login 
            set date_start = :date
            where email = :email";
    $cur = $bdd->preparerRequetePDO($sql);
    $bdd->ajouterParamPDO($cur, ':date', $_POST['date']);
    $bdd->ajouterParamPDO($cur, ':email', $_SESSION["EMAIL"]);
    $bdd->majDonneesPrepareesPDO($cur);
}

if (
    !empty($_POST['libelle']) &&
    !empty($_POST['cat'])
) {
    addCatLib($_POST['cat'], $_POST['libelle']);
}

if (
    !empty($_POST['abrCat']) &&
    !empty($_POST['libelleCat'])
) {
    addCat($_POST['abrCat'], $_POST['libelleCat']);
}

if (is_logged())
    include('settings.html');
else
    header('location:./login/index.php');
