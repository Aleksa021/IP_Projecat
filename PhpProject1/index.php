<?php

require_once './DB.php';
if(isset($_GET['controller'])&& isset($_GET['akcija'])){
    $controller=$_GET['controller'];
    $akcija=$_GET['akcija'];
}
else{
    $controller='gost';
    $akcija='index';
    
}

require ('routes.php');


