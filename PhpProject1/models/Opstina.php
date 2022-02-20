<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Opstina
 *
 * @author Jarvis
 */
class Opstina_model{
    private $id_opstina;
    private $id_grad;
    private $naziv_o;
    public function __construct($id_opstina,$id_grad,$naziv_o) {
        $this->id_opstina=$id_opstina;
        $this->id_grad=$id_grad;
        $this->naziv_o=$naziv_o;
    }
     public function __get($ime_atributa) {
        return $this->$ime_atributa;
 }
    public static function dohvati_opstine($naziv_grada) {
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT * FROM grad,opstina WHERE naziv_g='$naziv_grada'";
        $rezultat=$konekcija->query($upit);
        $niz=[];
        foreach($rezultat->fetchAll() as $red){
            $niz[]=new Opstina_model($red['id_opstina'],$red['id_grad'],$red['naziv_o']);
        }
        
        if(empty($niz))
            return FALSE;
        else
            return $niz;
    }
    public static function dohvati_opstinu($naziv_grada,$naziv_opstine) {
    $konekcija=DB::dohvati_instancu();
    $upit="SELECT * FROM grad, opstina WHERE naziv_g='$naziv_grada' and naziv_o='$naziv_opstine'";
    echo $upit;
    $rezultat=$konekcija->query($upit);
    
    if($rezultat->rowCount()>0){
        $red=$rezultat->fetch();
        return new Opstina_model ($red['id_opstina'], $red['id_grad'], $red['naziv_o']);
    }
    else
        return FALSE;
    }
    public static function dohvati_id_opstine($naziv_grada,$naziv_opstine){
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT id_opstina FROM grad,opstina WHERE naziv_g='$naziv_grada'and naziv_o='$naziv_opstine'";
        $rezultat=$konekcija->query($upit);
        if($rezultat->rowCount()>0)         
            return $rezultat->fetch()['id_opstina'];
        else
            return false;
    }
}
