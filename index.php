<?php
session_save_path('./login');
session_start();
require_once('./utils/classeBDD.php');
require_once('./utils/utils.php');


$bdd = new BDD();


function getTabAccount($mois)
{
    global $bdd;
    $sql = "SELECT date,libelle,operation,montant,type from comptes 
    Where DateName( month , DateAdd( month , MONTH(date) , 0 ) - 1 ) like :mois
    order by date";

    $mois = '%'.$mois;

    $cur = $bdd->preparerRequetePDO($sql);
    $bdd->ajouterParamPDO($cur,':mois',$mois);

    $tab = $bdd->LireDonneesPDOPreparee($cur);

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
                if(is_float($value))
                    $value = round($value,2);
                echo '<td>' . $value . '</td>';
            }
            echo "</tr>";
    }
    echo "</tr>
            </tbody>
            </table>";
}

function getSelectMonth(){
    if(isset($_POST['date']))
        return $_POST['date'];
    return "";
}





if(is_logged())
    include('./index.html');
else
    header('location:./login/index.php');
    

?>