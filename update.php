<?php
require_once('./XLSXReader/XLSXReader.php');
require_once('./utils/classeBDD.php');
require_once('./utils/utils.php');

$bdd = new BDD();
$name = 'CA20201115_233905.xlsx';

$xlsx = new XLSXReader('./comptes/' . $name);
$sheet = $xlsx->getSheetNames()[1];

$data = $xlsx->getSheetData($sheet);

$libelle = "";


function init(){
    global $data,$libelle;
    $i = 0;

    foreach ($data as $key) {

    if ($i > 10) {
        $date = $key[0];
        $libelle = $key[1];
        if ($key[2] != null)
            $montant = $key[2] * -1;
        else
            $montant  = $key[3];

        $type  = getOp($libelle);
        $libelle = ltrim($libelle);
        display($date, $type, $libelle, $montant);

        echo '<br>';
    }

    $i++;
}
}


function display($date, $type, $libelle, $montant)
{
    echo '<div>';
    $cat = "";
    if (preg_match('/PAYPAL/', $libelle) || preg_match('/AMAZON/', $libelle)) {
        echo '<img src="./images/cancel-24px.svg" style="background-color:red">';
    } else {
        echo '<img src="./images/check_box-24px.svg" style="background-color:green">';
    }

    if($montant>0)
        $cat = 'REVENU';

    $tab = getCatLib();
    foreach($tab as $key){
        $search = '/'.$key['libelle'].'/';
        if(preg_match($search,strtoupper($libelle))){
            $cat = getCatByAbr($key['categorie'])[0]['libelle'];
        }
    }

    echo '<label>' . $date . '</label>';
    echo '<input type="text" style="width:50rem;margin:0.5% 1%;" value="' . $libelle . '">';

    echo '<select><option value="">--------</option>';
    remplirOption(getCat(), count(getCat()), "Libelle", $cat);
    echo '</select>';

    echo '<label>' . $type . '</label>';
    echo '<label>' . $montant . '<label>';
    echo '</div>';
}

function getOp($libelle)
{
    global $libelle;
    $type = explode("  ", $libelle);
    $type = $type[0];
    if (preg_match('/VIREMENT EN VOTRE FAVEUR/', $type)) {
        $libelle = substr($libelle, strlen('VIREMENT EN VOTRE FAVEUR'));
        return 'VRMT';
    } else {
        switch ($type) {
            case 'PRELEVEMENT':
                $libelle = substr($libelle, strlen('PRELEVEMENT'));
                return 'PRLVMT';
            case 'PAIEMENT PAR CARTE':
                $libelle = substr($libelle, strlen('PAIEMENT PAR CARTE'));
                return 'CB';
            case 'VIREMENT EMIS':
                $libelle = substr($libelle, strlen('VIREMENT EMIS'));
                return 'VRMT';
            case "VERSEMENT D'ESPECES":
                return "VRMT";
            default:
                echo "<br><br><br>--------------------------<br>ERROR TYPE :";
                echo $type;
                exit();
        }
    }
    return $type;
}

include('./update.html');