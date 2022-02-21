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
    public function __construct($id_nekretnina,$naziv,$korisnicko_ime_n,$grad,$opstina,$mikrolokacija,$ulica,
            $tip,$soba,$kvadratura,$godina,$stanje,$sprat,$max_sprat,$cena,$opis,$prodato) {
        $this->id_nekretnina=$id_nekretnina;
        $this->naziv=$naziv;
        $this->korisnicko_ime_n=$korisnicko_ime_n;
        $this->grad=$grad;
        $this->opstina=$opstina;
        $this->mikrolokacija=$mikrolokacija;
        $this->ulica=$ulica;
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
                    . "(NULL,'$korisnicko_ime_n','$naziv',$id_niz[0],$id_niz[1],$id_niz[2],$id_niz[3],'$tip',"
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
            $naziv_niz=Ulica_model::dohvati_sve_nazive($red['id_grad'], $red['id_opstina'], $red['id_mikrolokacija'], $red['id_ulica']);
            $niz[]=new Nekretnina_model($red['id_nekretnina'],$red['naziv'],$red['korisnicko_ime_n'],$naziv_niz[0]
                    ,$naziv_niz[1],$naziv_niz[2],$naziv_niz[3],$red['tip']
                    ,$red['soba'],$red['kvadratura'],$red['godina']
                    ,$red['stanje'],$red['sprat'],$red['max_sprat']
                    ,$red['cena'],$red['opis'],$red['prodato']);
        }
        
        if(empty($niz))
            return FALSE;
        else
            return $niz;
        
        
    }
        public  static function dohvati_nekretninu($id_nekretnina) {
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT * FROM nekretnina WHERE id_nekretnina=$id_nekretnina";
        $rezultat=$konekcija->query($upit);
        $red=$rezultat->fetch();
        if($rezultat->rowCount()>0){
            $naziv_niz=Ulica_model::dohvati_sve_nazive($red['id_grad'], $red['id_opstina'], $red['id_mikrolokacija'], $red['id_ulica']);
            return new Nekretnina_model($red['id_nekretnina'],$red['naziv'],$red['korisnicko_ime_n'],$naziv_niz[0]
                    ,$naziv_niz[1],$naziv_niz[2],$naziv_niz[3],$red['tip']
                    ,$red['soba'],$red['kvadratura'],$red['godina']
                    ,$red['stanje'],$red['sprat'],$red['max_sprat']
                    ,$red['cena'],$red['opis'],$red['prodato']);
            
        }
        else return false;

        
        
    }
    public static function prodaj_nekretninu($id_nekretnina) {
        $konekcija=DB::dohvati_instancu();
        $upit="UPDATE nekretnina SET prodato=1 WHERE id_nekretnina=$id_nekretnina";
        $rezultat=$konekcija->query($upit);
        return $rezultat->rowCount()>0;
    }
    public static function izmeni_nekretninu($id_nekretnina,$naziv,$naziv_g,$naziv_o,$naziv_m,$naziv_u,
            $tip,$soba,$kvadratura,$godina,$stanje,$sprat,$max_sprat,$cena,$opis) {
        
        $id_niz=Ulica_model::dohvati_sve_id($naziv_g, $naziv_o, $naziv_m, $naziv_u);
        if(is_array($id_niz)){
            $konekcija=DB::dohvati_instancu();
            $upit="Update nekretnina SET naziv='$naziv',id_grad=$id_niz[0],id_opstina=$id_niz[1],id_mikrolokacija=$id_niz[2],id_ulica=$id_niz[3],"
                    . "tip='$tip',soba=$soba,kvadratura=$kvadratura,godina=$godina,stanje='$stanje',sprat=$sprat,max_sprat=$max_sprat,cena=$cena,opis='$opis'"
                    . " WHERE id_nekretnina =$id_nekretnina";
            $rezultat=$konekcija->query($upit);
            return $rezultat->rowCount()>0;
        
        }
        else
            return false;
        
    }
    public static function pretraga_nekretnina($tip,$grad,$opstina,$mikrolokacija,$cena,$kvadratura,$soba){
        $upit="SELECT * FROM nekretnina WHERE tip='$tip'";
        if($grad!='nije_selektovano'){
            $id_grad= Grad_model::dohvati_id_grada($grad);
            if($id_grad===false)
                return false;
            $upit.=" and id_grad= $id_grad";
        }
        if($opstina!=''){
            $id_opstina= Opstina_model::dohvati_id_opstine($grad, $opstina);
            if($id_opstina===false)
                return false;
            $upit.=" and id_opstina= $id_opstina";
        }
        if($mikrolokacija!=''){
            $id_mikrolokacija= Mikrolokacija_model::dohvati_id_mikrolokacije($grad, $opstina, $mikrolokacija);
            if($id_mikrolokacija===false)
                return false;
            $upit.=" and id_mikrolokacija= $id_mikrolokacija";
        }
        if($cena!=""){
            $upit.=" and cena<=$cena";
        }
        if($kvadratura!=""){
            $upit.=" and kvadratura>=$kvadratura";
        }
        if($soba!=""){
            $upit.=" and soba>=$soba";
        }
        $upit.=" and prodato=0";
        $konekcija=DB::dohvati_instancu();
        $rezultat=$konekcija->query($upit);
        $niz=[];
        foreach($rezultat->fetchAll() as $red){
            $naziv_niz=Ulica_model::dohvati_sve_nazive($red['id_grad'], $red['id_opstina'], $red['id_mikrolokacija'], $red['id_ulica']);
            $niz[]=new Nekretnina_model($red['id_nekretnina'],$red['naziv'],$red['korisnicko_ime_n'],$naziv_niz[0]
                    ,$naziv_niz[1],$naziv_niz[2],$naziv_niz[3],$red['tip']
                    ,$red['soba'],$red['kvadratura'],$red['godina']
                    ,$red['stanje'],$red['sprat'],$red['max_sprat']
                    ,$red['cena'],$red['opis'],$red['prodato']);
        }

        return $niz;
    }
    public static function prosecna_cena($grad,$opstina,$mikrolokacija){
        $id_mikrolokacija=Mikrolokacija_model::dohvati_id_mikrolokacije($grad, $opstina, $mikrolokacija);
        $upit="SELECT AVG(cena) FROM nekretnina WHERE id_mikrolokacija=$id_mikrolokacija";
        $konekcija=DB::dohvati_instancu();
        $rezultat=$konekcija->query($upit);
        //print_r($rezultat->fetch());
        if($rezultat->rowCount()>0)
            return $rezultat->fetch()['AVG(cena)'];
        else
            return false;
        
    }
    public static function napretna_pretraga($min_cena,$max_cena,
            $min_kvadratura,$max_kvadratura,$min_soba,$max_soba,
            $min_godina,$max_godina,$stanje,$min_sprat,$max_sprat) {
        
        $upit="SELECT * FROM nekretnina WHERE stanje in (". implode(',', $stanje).")";
        if($min_cena!='')
            $upit.=" and cena>=$min_cena ";
        if($max_cena!='')
            $upit.=" and cena<=$max_cena ";
        if($min_kvadratura!='')
            $upit.=" and kvadratura>=$min_kvadratura ";
        if($max_kvadratura!='')
            $upit.=" and kvadratura<=$max_kvadratura ";
        if($min_soba!='')
            $upit.=" and soba>=$min_soba ";
        if($max_soba!='')
            $upit.=" and soba<=$max_soba ";
        if($min_godina!='')
            $upit.=" and godina>=$min_godina ";
        if($max_godina!='')
            $upit.=" and godina<=$max_godina ";
        if($min_sprat!='')
            $upit.=" and sprat>=$min_sprat ";
        if($max_sprat!='')
            $upit.=" and sprat<=$max_sprat ";
        $upit.=" and prodato=0";
        $konekcija=DB::dohvati_instancu();
        $rezultat=$konekcija->query($upit);
        $niz=[];
        echo $upit;
        foreach($rezultat->fetchAll() as $red){
            $naziv_niz=Ulica_model::dohvati_sve_nazive($red['id_grad'], $red['id_opstina'], $red['id_mikrolokacija'], $red['id_ulica']);
            $niz[]=new Nekretnina_model($red['id_nekretnina'],$red['naziv'],$red['korisnicko_ime_n'],$naziv_niz[0]
                    ,$naziv_niz[1],$naziv_niz[2],$naziv_niz[3],$red['tip']
                    ,$red['soba'],$red['kvadratura'],$red['godina']
                    ,$red['stanje'],$red['sprat'],$red['max_sprat']
                    ,$red['cena'],$red['opis'],$red['prodato']);
        }

        return $niz;
    }
    public static function prosecna_cena_po_kvadratu($grad,$opstina,$mikrolokacija) {
        $id_mikrolokacija=Mikrolokacija_model::dohvati_id_mikrolokacije($grad, $opstina, $mikrolokacija);
        $upit="SELECT AVG(cena/kvadratura) FROM nekretnina WHERE id_mikrolokacija=$id_mikrolokacija";
        $konekcija=DB::dohvati_instancu();
        $rezultat=$konekcija->query($upit);
        if($rezultat->rowCount()>0)
            return $rezultat->fetch()['AVG(cena/kvadratura)'];
        else
            return false;
        
    }
}
