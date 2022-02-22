<?php


/**
 * Klasa Agencija_model povezuje se sa tabelom agencija iz baze podataka nekretnine
 *
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
        /**
         * Funkcija vraca sve agencije iz baze u vidu niza, ako dodje do greske,
         * vraca false
         */
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
        /** 
         * Ubacuje red u bazu agencija sa prosledjenim argumentima, u slucaju
         * greske vraca false
         */
        $konekcija=DB::dohvati_instancu();
        $id_grad= Grad_model::dohvati_id_grada($grad);
        $upit="INSERT INTO agencija VALUES (NULL,'$naziv','$adresa',$id_grad,'$PIB','$telefon')";
        $status=$konekcija->query($upit);
        return $status;
        
    }
    public static function dohvati_id_agencije($naziv) {
        /** 
         * Vraca ID agencije koji ima naziv kao argument $naziv , u slucaju
         * greske vraca false
         */
        $konekcija=DB::dohvati_instancu();
        if ($naziv=='nije_selektovano' || $naziv=='NULL')
            return 'NULL';
        $upit="SELECT id_agencija FROM agencija WHERE naziv='$naziv'";
        $rezultat=$konekcija->query($upit);
        return $rezultat->fetch()['id_agencija'];
        
    }
    public static function dohvati_naziv_agencije($id_agnecija) {
        /**
         * Vraca naziv agencije koji ima ID u bazi kao argument $id_agencije,
         * u slucaju greske vraca false
         *
         */
        if (is_null($id_agnecija))
            return NULL;
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT naziv FROM agencija WHERE id_agencija=$id_agnecija";
        $rezultat=$konekcija->query($upit);
        return $rezultat->fetch()['naziv'];
        
    }
    public static function dohavti_agenciju($naziv) {
        /**
         * Vraca objekat agencije sa popunjenim parametrima iz baze, ako je
         * naziv kao prodjeni argument $naziv, u slucaju
         * greske vraca false
         */
        $id=Agencija_model::dohvati_id_agencije($naziv);
        $upit="SELECT * FROM agencija WHERE id_agencija=$id";
        echo $upit;
        $konekcija=DB::dohvati_instancu();
        $rezultat=$konekcija->query($upit);
        $red=$rezultat->fetch();
        return new Agencija_model($red['id_agencija'],$red['naziv'],$red['adresa'],
                    $red['id_grad'],$red['PIB'],$red['telefon']);
    }
}
