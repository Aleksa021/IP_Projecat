<?php
class Grad_model {
    private $id;
    private $naziv_g;
    public function __construct($id,$naziv_g) {
        $this->id=$id;
        $this->naziv_g=$naziv_g;
    }
     public function __get($ime_atributa) {
        return $this->$ime_atributa;
 }
    public static function dohvati_gradove() {
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT * FROM grad";
        $rezultat=$konekcija->query($upit);
        $niz=[];
        foreach($rezultat->fetchAll() as $red){
            $niz[]=new Grad_model($red['id_grad'],$red['naziv_g']);
        }
        
        if(empty($niz))
            return FALSE;
        else
            return $niz;
    }
    public static function dohvati_id_grada($naziv_g){
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT id_grad FROM grad WHERE naziv_g='$naziv_g'";
        $rezultat=$konekcija->query($upit);
        if($rezultat->rowCount()>0)
            
            return $rezultat->fetch()['id_grad'];
        else
            return false;
    }
    public static function dohvati_naziv_grada($id_grad){
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT naziv_g FROM grad WHERE id_grad=$id_grad";
        $rezultat=$konekcija->query($upit);
        if($rezultat->rowCount()>0)
            
            return $rezultat->fetch()['naziv_g'];
        else
            return false;
    }
}
