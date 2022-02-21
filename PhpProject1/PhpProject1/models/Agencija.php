<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Agencija
 *
 * @author Jarvis
 */
class Agencija_model {
    private $id;
    private $naziv;
    private $adresa;
    private $id_grad;
    private $PIB;
    private $telefon;
    public function __construct($id,$naziv,$adresa=NULL,$id_grad=NULL,$PIB=NULL,$telefon=NULL) {
        $this->id=$id;
        $this->naziv=$naziv;
        $this->adresa=$adresa;
        $this->id_grad=$id_grad;
        $this->PIB=$PIB;
        $this->telefon=$telefon;
    }
     public function __get($ime_atributa) {
        return $this->$ime_atributa;
 }
    public static function dohvati_agencije() {
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT * FROM agencija";
        $rezultat=$konekcija->query($upit);
        $niz=[];
        foreach($rezultat->fetchAll() as $red){
            $niz[]=new Agencija_model($red['id_agencija'],$red['naziv'],$red['adresa'],
                    $red['id_grad'],$red['PIB'],$red['telefon']);
        }
        if(empty($niz))
            return FALSE;
        else
            return $niz;
    }
    public static function dodaj_agenciju($naziv,$adresa,$grad,$PIB,$telefon) {
        $konekcija=DB::dohvati_instancu();
        $id_grad= Grad_model::dohvati_id_grada($grad);
        $upit="INSERT INTO agencija VALUES (NULL,'$naziv','$adresa',$id_grad,'$PIB','$telefon')";
        $status=$konekcija->query($upit);
        return $status;
        
    }
    public static function dohvati_id_agencije($naziv) {
        $konekcija=DB::dohvati_instancu();
        if ($naziv=='nije_selektovano' || $naziv=='NULL')
            return 'NULL';
        $upit="SELECT id_agencija FROM agencija WHERE naziv='$naziv'";
        $rezultat=$konekcija->query($upit);
        return $rezultat->fetch()['id_agencija'];
        
    }
    public static function dohvati_naziv_agencije($id_agnecija) {
        if (is_null($id_agnecija))
            return NULL;
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT naziv FROM agencija WHERE id_agencija=$id_agnecija";
        $rezultat=$konekcija->query($upit);
        return $rezultat->fetch()['naziv'];
        
    }
}
