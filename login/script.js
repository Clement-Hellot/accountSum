document.getElementById('pass2').addEventListener('input',function ()
{
    document.getElementById('divProgress').style.opacity = "1";


    if(document.getElementById('pass2').value == (document.getElementById('pass1').value))
    {
        document.getElementById('passCheck').removeAttribute('class');
        document.getElementById('passCheck').setAttribute('class','progress-bar bg-success');
    }else{
        document.getElementById('passCheck').removeAttribute('class');
        document.getElementById('passCheck').setAttribute('class','progress-bar bg-danger');
    }
});


