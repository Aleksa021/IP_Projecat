<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Ulica
 *
 * @author Jarvis
 */
class Ulica_model {
    private $id_ulica;
    private $id_mikrolokacija;
    private $naziv_u;
    public function __construct($id_ulica,$id_mikrolokacija,$naziv_u) {
        $this->id_ulica=$id_ulica;
        $this->id_mikrolokacija=$id_mikrolokacija;
        $this->naziv_u=$naziv_u;
    }
     public function __get($ime_atributa) {
        return $this->$ime_atributa;
 }
    public static function dodaj_ulicu($naziv_grada,$naziv_opstine,$naziv_mikrolokacije,$naziv_ulice){
        $id= Mikrolokacija_model::dohvati_id_mikrolokacije($naziv_grada, $naziv_opstine,$naziv_mikrolokacije);
        if($id!==false){
            $konekcija=DB::dohvati_instancu();
            $upit="INSERT INTO ulica VALUES (NULL,$id,'$naziv_ulice')";
            $status=$konekcija->query($upit);
            return $status->rowCount()>0;
        }
        else
            return false;
    }
    public static function izbrisi_ulicu($naziv_grada,$naziv_opstine,$naziv_mikrolokacije,$naziv_ulice) {
        $id= Mikrolokacija_model::dohvati_id_mikrolokacije($naziv_grada, $naziv_opstine,$naziv_mikrolokacije);
        if($id!==false){
            $konekcija=DB::dohvati_instancu();
            $upit="DELETE FROM ulica WHERE id_mikrolokacija=$id and naziv_u='$naziv_ulice'";
            $status=$konekcija->query($upit);
            return $status->rowCount()>0;
        }
        else
            return false;
        
    }
    public static function dohvati_sve_id($naziv_grada,$naziv_opstine,$naziv_mikrolokacije,$naziv_ulice){

        $konekcija=DB::dohvati_instancu();
        $upit="SELECT grad.id_grad,opstina.id_opstina,mikrolokacija.id_mikrolokacija,ulica.id_ulica FROM grad,opstina,mikrolokacija,ulica WHERE "
                . "naziv_g='$naziv_grada' and naziv_o='$naziv_opstine' and "
                . "naziv_m='$naziv_mikrolokacije' and naziv_u='$naziv_ulice'";
        $rezulta=$konekcija->query($upit);
        if($rezulta->rowCount()>0){
            $red=$rezulta->fetch();
            return array($red['id_grad'],$red['id_opstina'],$red['id_mikrolokacija'],$red['id_ulica']);
        }
        else
            return false;

    }
}
