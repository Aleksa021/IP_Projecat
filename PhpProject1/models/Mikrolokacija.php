<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Mikrolokacija
 *
 * @author Jarvis
 */
class Mikrolokacija_model{
    private $id_mikrolokacija;
    private $id_opstina;
    private $naziv_m;
    public function __construct($id_mikrolokacija,$id_opstina,$naziv_m) {
        $this->id_mikrolokacija=$id_mikrolokacija;
        $this->id_opstina=$id_opstina;
        $this->naziv_m=$naziv_m;
    }
     public function __get($ime_atributa) {
        return $this->$ime_atributa;
 }
    public static function dohvati_mikrolokacije($naziv_opstine) {
        $konekcija=DB::dohvati_instancu();
        $id_opstina= Opstina_model::dohvati_id_opstine($naziv_opstine);
        $upit="SELECT * FROM mikrolokacija WHERE id_opstina=$id_opstina";
        $rezultat=$konekcija->query($upit);
        $niz=[];
        foreach($rezultat->fetchAll() as $red){
            $niz[]=new Mikrolokacija_model($red['id_mikrolokacija'],$red['id_opstina'],$red['naziv_m']);
        }
        
        if(empty($niz))
            return FALSE;
        else
            return $niz;
    }
    public static function dohvati_mikrolokaciju($naziv_grada,$naziv_opstine,$naziv_mikrolokacije) {
    $konekcija=DB::dohvati_instancu();
    $upit="SELECT * FROM grad, opstina, mikrolokacija WHERE naziv_g='$naziv_grada' and naziv_o='$naziv_opstine' and naziv_m='$naziv_mikrolokacije'";
    $rezultat=$konekcija->query($upit);
    
    if($rezultat->rowCount()>0){
        $red=$rezultat->fetch();
        return new Mikrolokacija_model ($red['id_mikrolokacija'], $red['id_opstina'], $red['naziv_m']);
    }
    else
        return FALSE;
    }
    
    public static function dohvati_id_mikrolokacije($naziv_grada,$naziv_opstine,$naziv_mikrolokacije){
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT id_mikrolokacija FROM grad,opstina,mikrolokacija WHERE naziv_g='$naziv_grada'and naziv_o='$naziv_opstine' and naziv_m='$naziv_mikrolokacije'";
        $rezultat=$konekcija->query($upit);
        if($rezultat->rowCount()>0)         
            return $rezultat->fetch()['id_mikrolokacija'];
        else
            return false;
    }
    
    
/*    public static function dohvati_id_mikrolokacije($naziv_mikrolokacije){
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT id_mikrolokacija FROM mikrolokacija WHERE naziv_m='$naziv_mikrolokacije'";
        $rezultat=$konekcija->query($upit);
        if($rezultat->rowCount()>0)         
            return $rezultat->fetch()['id_mikrolokacija'];
        else
            return false;
    }*/
    public static function dodaj_mikrolokaciju($naziv_grada,$naziv_opstine,$naziv_mikrolokacije) {
        $id= Opstina_model::dohvati_id_opstine($naziv_grada, $naziv_opstine);
        if($id!==false){
            $konekcija=DB::dohvati_instancu();
            $upit="INSERT INTO mikrolokacija VALUES (NULL,$id,'$naziv_mikrolokacije')";
            $status=$konekcija->query($upit);
            return $status->rowCount()>0;
        }
        else
            return false;
        
    }
    public static function izbrisi_mikrolokaciju($naziv_grada,$naziv_opstine,$naziv_mikrolokacije) {
        $id= Opstina_model::dohvati_id_opstine($naziv_grada, $naziv_opstine);
        if($id!==false){
            $konekcija=DB::dohvati_instancu();
            $upit="DELETE FROM mikrolokacija WHERE id_opstina=$id and naziv_m='$naziv_mikrolokacije'";
            $status=$konekcija->query($upit);
            return $status->rowCount()>0;
        }
        else
            return false;
        
    }
}
