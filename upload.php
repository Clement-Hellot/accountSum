<?php
if(isset($_FILES['comptesFile']['name'])){
    $dir = 'E:/WEP_API/comptes/'.basename($_FILES['comptesFile']['name']);
move_uploaded_file($_FILES['comptesFile']['tmp_name'],$dir);
print_r($_FILES);
}


?>