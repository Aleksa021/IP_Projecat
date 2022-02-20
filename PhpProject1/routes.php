<?php

function call($controller,$akcija){
    require_once ('controllers/'.$controller.'_controller.php');
    
    switch($controller){
        case'gost':
            $controller_tek = new Gost_controller($akcija);
            break;
        case 'kupac':
            $controller_tek= new Kupac_controller($akcija);
            break;
        case 'oglasavac':
            $controller_tek= new Oglasavac_controller($akcija);
            break;
        case 'administrator':
            $controller_tek= new Administrator_controller($akcija);
            break;
    }
    $controller_tek->$akcija();
}

$controllers= array('gost'=>['index','login','registracija'],
    'kupac'=>['index','logout','promena_lozinke'],
    'oglasavac'=>['index','logout','promena_lozinke','dodaj_nekretninu','izmeni_podatke','logout'],
    'administrator'=>['index','logout','promena_lozinke','odbij','odobri','pretraga_korisnika','dodaj_korisnika','registracija','promena_lozinke','dodaj_agenciju','dodaj_mesta']);
if (array_key_exists($controller, $controllers)){
    if(in_array($akcija, $controllers[$controller])){

        #echo rand();
        call($controller,$akcija);
    }
    else{
        
        call('gost','greska');
    }
    
}
else{
    call('gost','greska');
}
?>
