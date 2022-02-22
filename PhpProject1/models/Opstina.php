<?php


class Opstina_model{
    /*
     * Klasa Opstina_model povezuje se sa tabelom opstina iz baze podataka nekretnine
     */
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
        /*
         * Vraca niz objekata Opstina_model sa popunjenim vrednostima iz tabele
         * opstina gde je naziv grada kao istoimeni prosledjeni argument, u slucaju greske ili nepostojanja
         * vraca false
         */
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
        /*
         * Vraca objekat opstina_model sa popunjenim vrednostima iz tabele opstina
         * gde su naziv grada i opstine istoimeni prosledjeni argumenti, u slucaju greske ili nepostojanja
         * vraca false
         */
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
        /*
         * Vraca id opstine iz tabele opstina gde je naziv grada i opstine 
         * kao istoimeni prosledjeni argumenti, u slucaju greske ili nepostojanja
         * vraca false
         */
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT id_opstina FROM grad,opstina WHERE naziv_g='$naziv_grada'and naziv_o='$naziv_opstine'";
        $rezultat=$konekcija->query($upit);
        if($rezultat->rowCount()>0)         
            return $rezultat->fetch()['id_opstina'];
        else
            return false;
    }
}
