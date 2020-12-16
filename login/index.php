<?php

session_start();
require_once('../utils/classeBDD.php');


session_unset();


$bdd = new BDD();

function login($email,$pass){
    global $bdd;

    $sql = "SELECT * from login where email = :email";
    $cur = $bdd->preparerRequetePDO($sql);
    $bdd->ajouterParamPDO($cur,':email',$email);

    $tab = $bdd->LireDonneesPDOPreparee($cur);

    if(count($tab) == 1){
        if(password_verify($pass,$tab[0]["password"])){
            $_SESSION["EMAIL"] = $email;
            header("location:../index.php"); //nous envoie sur la page login
        }        
    }
    echo "Identifiants incorrect";
    
}

if(!empty($_POST['email']) &&
    !empty($_POST['password']))
{
    $email = htmlspecialchars($_POST['email']);

    echo login($email,$_POST['password']);
}

print_r($_SESSION);

include('./index.html');

?>