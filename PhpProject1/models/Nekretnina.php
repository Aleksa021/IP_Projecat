<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Nekretnina
 *
 * @author Jarvis
 */
class Nekretnina_model {
    private $id_nekretnina;
    private $naziv;
    private $korisnicko_ime_n;
    private $id_grad;
    private $id_opstina;
    private $id_mikrolokacija;
    private $id_ulica;
    private $tip;
    private $soba;
    private $kvadratura;
    private $godina;
    private $stanje;
    private $sprat;
    private $max_sprat;
    private $cena;
    private $opis;
    private $prodato;
    public function __construct($id_nekretnina,$naziv,$korisnicko_ime_n,$id_grad,$id_opstina,$id_mikrolokacija,$id_ulica,
            $tip,$soba,$kvadratura,$godina,$stanje,$sprat,$max_sprat,$cena,$opis,$prodato) {
        $this->id_nekretnina=$id_nekretnina;
        $this->naziv=$naziv;
        $this->korisnicko_ime_n=$korisnicko_ime_n;
        $this->id_grad=$id_grad;
        $this->id_opstina=$id_opstina;
        $this->id_mikrolokacija=$id_mikrolokacija;
        $this->id_ulica=$id_ulica;
        $this->tip=$tip;
        $this->soba=$soba;
        $this->kvadratura=$kvadratura;
        $this->godina=$godina;
        $this->stanje=$stanje;
        $this->sprat=$sprat;
        $this->max_sprat=$max_sprat;
        $this->cena=$cena;
        $this->opis=$opis;
        $this->prodato=$prodato;
    }
     public function __get($ime_atributa) {
        return $this->$ime_atributa;
 }
    public static function dodaj_nekretninu($naziv,$korisnicko_ime_n,$naziv_g,$naziv_o,$naziv_m,$naziv_u,
            $tip,$soba,$kvadratura,$godina,$stanje,$sprat,$max_sprat,$cena,$opis){
        $id_niz=Ulica_model::dohvati_sve_id($naziv_g, $naziv_o, $naziv_m, $naziv_u);

        if(is_array($id_niz)){
            $konekcija=DB::dohvati_instancu();
            $upit="INSERT INTO nekretnina VALUES "
                    . "(NULL,,'$korisnicko_ime_n',$naziv',$id_niz[0],$id_niz[1],$id_niz[2],$id_niz[3],'$tip',"
                    . "$soba,$kvadratura,$godina,'$stanje',$sprat,$max_sprat,$cena,'$opis',FALSE)";
            $rezultat=$konekcija->query($upit);
            return $rezultat->rowCount()>0;
        
        }
        else
            return false;
    }
    public static function dohvati_nekretnine($korisnicko_ime) {
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT * FROM nekretnina WHERE korisnicko_ime_n='$korisnicko_ime'";
        $rezultat=$konekcija->query($upit);
        $niz=[];
        foreach($rezultat->fetchAll() as $red){
            $niz[]=new Nekretnina_model($red['id_nekretnina'],$red['naziv'],$red['korisnicko_ime_n'],$red['id_grad']
                    ,$red['id_opstina'],$red['id_mikrolokacija'],$red['id_ulica'],$red['tip']
                    ,$red['soba'],$red['kvadratura'],$red['godina']
                    ,$red['stanje'],$red['sprat'],$red['max_sprat']
                    ,$red['cena'],$red['opis'],$red['prodato']);
        }
        
        if(empty($niz))
            return FALSE;
        else
            return $niz;
        
        
    }
        public  static function dohvati_nekretninu($korisnicko_ime,$id_nekretnina) {
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT * FROM nekretnina WHERE id_nekretnina=$id_nekretnina and korisnicko_ime_n='$korisnicko_ime'";
        $rezultat=$konekcija->query($upit);
        $red=$rezultat->fetch();
        if($rezultat->rowCount()>0)
            return new Nekretnina_model($red['id_nekretnina'],$red['naziv'],$red['korisnicko_ime_n'],$red['id_grad']
                    ,$red['id_opstina'],$red['id_mikrolokacija'],$red['id_ulica'],$red['tip']
                    ,$red['soba'],$red['kvadratura'],$red['godina']
                    ,$red['stanje'],$red['sprat'],$red['max_sprat']
                    ,$red['cena'],$red['opis'],$red['prodato']);
        else return false;

        
        
    }
    public static function prodaj_nekretninu($id_nekretnina,$korisnicko_ime) {
        $konekcija=DB::dohvati_instancu();
        $upit="UPDATE nekretnina SET prodato=1 WHERE id_nekretnina=$id_nekretnina and korisnicko_ime_n='$korisnicko_ime'";
        $rezultat=$konekcija->query($upit);
        return $rezultat->rowCount()>0;
    }
 
}
