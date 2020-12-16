<?php 

require_once('../utils.php');
require_once('../classeBDD.php');

session_start();
print_r($_SESSION);
$bdd = new BDD();

function register($email,$pass){
    global $bdd;

    $sql = "SELECT * from login where email = :email";
    $cur = $bdd->preparerRequetePDO($sql);
    $bdd->ajouterParamPDO($cur,':email',$email);

    $tab = $bdd->LireDonneesPDOPreparee($cur);
    echo count($tab);
    if(count($tab) == 0){
        $email = htmlspecialchars($email);
        $pass = password_hash($pass,PASSWORD_BCRYPT);
        if(empty($_POST['name'])){
            $prenom = "";
        }else{
            $prenom  = $_POST['name'];
        }
        $sql ="INSERT into login(email,password,prenom) VALUES (:email,:pass,:prenom)";
        $cur = $bdd->preparerRequetePDO($sql);

        $bdd->ajouterParamPDO($cur,':email',$email);
        $bdd->ajouterParamPDO($cur,':pass',$pass);
        $bdd->ajouterParamPDO($cur,':prenom',$prenom);

        $res=  $bdd->majDonneesPrepareesPDO($cur);
        if($res == 1){
            header("location:index.php");
        }

        
    }else{
        echo "Identifiants indisponible";
    }
}

if(!empty($_POST['email']) && !empty($_POST['email'])){
        register($_POST['email'],$_POST['pass']);
    }


include_once('./register.html');

?>