<?php
class DB {
    private static $instanca=NULL;
    
    private function __construct() {}
    private function __clone() {}
    public  static function dohvati_instancu() {
        if(!isset(self::$instanca)){
                   
            $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
            self::$instanca = new PDO('mysql:host=localhost;dbname=nekretnine','root','',$pdo_options);
            }
        return self::$instanca;
    }
}
?>