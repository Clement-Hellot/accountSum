var container;
function aff(){
    container = document.getElementsByTagName('div');

    if(checkNotEmpty()){
        for (let index = container.length; index>= 0; index--) {
            var cont = container[index];
            let element = cont.children;
            let date = element[1].innerText;
            let libelle = element[2].value;
            let op = element[4].innerText;
            let montant = element[5].innerText;
            let type = element[3].value;
    
            $.ajax({
                type: "post",
                url: "./insert.php",
                data: "date="+date+"&libelle="+libelle+"&op="+op+"&montant="+montant+"&type="+type,
                success : function(code_html, statut){ // code_html contient le HTML renvoyé
                    console.log(code_html);
                }
            });
        }
    }else{
        alert();
    }
}


function checkNotEmpty(){
    container = document.getElementsByTagName('div');

    for (let index = 0; index < container.length; index++) {
        let element = container[index].children;
        let date = element[1].innerText;
        let libelle = element[2].value;
        let op = element[4].innerText;
        let montant = element[5].innerText;
        let type = element[3].value;

        if(libelle.length == 0 || type.length == 0)
            return false;
    }
    return true;
}