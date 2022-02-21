<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of ModelAutor
 *
 * @author Jarvis
 */
class Autor {
    private $ime;
    private $prezime;
    private $korisnicko_ime;
    private $lozinka;
    private $admin;
    public function __construct($korisnicko_ime,$lozinka,$ime,$prezime,$admin) {
        $this->ime=$ime;
        $this->prezime=$prezime;
        $this->korisnicko_ime=$korisnicko_ime;
        $this->lozinka=$lozinka;
        $this->admin=$admin;
    }
    public function __get($imeAtributa) {
        return $this->$imeAtributa;    
    }
    public static function dohvatiAutora($korisnicko_ime){
        $konekcija= DB::getInstance;
        $rezultat= $konekcija->query("SELECT * FROM autor WHERE korisnicko_ime='$korisnicko_ime'");
        $autor=$rezultat->fetch();
        if($autor!=NULL){
            return new Autor($autor['korisnicko_ime'],$autor['lozinka'],$autor['ime'],$autor['prezime'],autor['admin']);
        }
        else
            return FALSE;
    }
}
?>
