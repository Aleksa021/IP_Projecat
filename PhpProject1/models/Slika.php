<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Slika
 *
 * @author Jarvis
 */
class Slika_model{
    private $id_s;
    private $putanja;
    private $id_n;
    public function __construct($id_s,$putanja,$id_n) {
        $this->id_s=$id_s;
        $this->putanja=$putanja;
        $this->id_n=$id_n;
    }
     public function __get($ime_atributa) {
        return $this->$ime_atributa;
 }
  public static function dodaj_slike($slike,$id_n){
      
     $konekcija=DB::dohvati_instancu();
     $upit_slike=array();
     foreach ($slike as $slika) {
         $upit_slike[]="(NULL,'$slika',$id_n)";
     }
     $upit="INSERT INTO slika VALUES ". implode(',', $upit_slike);
     $rezultat=$konekcija->query($upit);
     return $rezultat->rowCount()>0;
 }
 public static function dohvati_slike($id_n) {
     
    $upit="SELECT * FROM slika WHERE id_nek=$id_n";
     $konekcija=DB::dohvati_instancu();
     $rezultat=$konekcija->query($upit);
     $niz=[];
        foreach($rezultat->fetchAll() as $red){
            $niz[]=new Slika_model($red['id_s'],$red['putanja'],$red['id_nek']);
        }
        if(empty($niz))
            return FALSE;
        else
            return $niz;
 }
}
