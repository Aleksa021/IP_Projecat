<?php


class Ulica_model {
    /*
     * Klasa Ulica_model povezuje tabelu ulica sa bazom podataka nekretnine
     */
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
        /*
         * Ubacuje red u tabelu ulice gde je naziv grada opstine mikrolokacije i ulice
         * kao istoieni prosledjeni argumenti, u slucaju greske vraca false
         */
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
       /*
        * Brise red ulice iz tabele ulica gde su nziv grada opstine mikrolokacije 
        * i ulice kao kao istoimeni prosledjeni argumenti, u slucaju greske vraca false
        */
        
        $id_mikrolokacija= Mikrolokacija_model::dohvati_id_mikrolokacije($naziv_grada, $naziv_opstine,$naziv_mikrolokacije);
        $id_ulica= Ulica_model::dohvati_id_ulice($naziv_grada, $naziv_opstine, $naziv_mikrolokacije, $naziv_ulice);
        if($id_mikrolokacija!==false && $id_ulica!==false){
            $konekcija=DB::dohvati_instancu();
            $upit="SELECT id_nekretnina FROM nekretnina WHERE id_ulica=$id_ulica";
            $rezultat=$konekcija->query($upit);
            if($rezultat->rowCount()>0){
                echo 'Postoje nekretnine na ulici';
                return false;
            }
            $upit="DELETE FROM ulica WHERE id_mikrolokacija=$id_mikrolokacija and id_ulica='$id_ulica'";
            $status=$konekcija->query($upit);
            return $status->rowCount()>0;
        }
        else
            return false;
        
    }

    public static function dohvati_sve_id($naziv_grada,$naziv_opstine,$naziv_mikrolokacije,$naziv_ulice){
        /*
         *Vraca niz svih id-jeva grada, opstine, mikrolokacije, ulice nazivima istoimenih
         * argmenata, u slucaju greske vraca false
         */

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
    public static function dohvati_sve_nazive($id_grada,$id_opstina,$id_mikrolokacija,$id_ulica){
        /*
         * Vraca niz svih naziva grada, opstine, mikrolokacije, ulie id-jevima istoimenih
         * argumenata, u slucaju greske vraca false
         */
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT grad.naziv_g,opstina.naziv_o,mikrolokacija.naziv_m,ulica.naziv_u FROM grad,opstina,mikrolokacija,ulica WHERE "
                . "grad.id_grad='$id_grada' and opstina.id_opstina='$id_opstina' and "
                . "mikrolokacija.id_mikrolokacija='$id_mikrolokacija' and ulica.id_ulica='$id_ulica'";
        $rezulta=$konekcija->query($upit);
        if($rezulta->rowCount()>0){
            $red=$rezulta->fetch();
            //print_r(array($red['naziv_g'],$red['naziv_o'],$red['naziv_m'],$red['naziv_u']));
            //return array($red['naziv_g'],$red['naziv_o'],$red['naziv_m'],$red['naziv_u']);
            return array($red[0],$red[1],$red[2],$red[3]);
        }
        else
            return false;

    }
    public static function dohvati_id_ulice($naziv_grada,$naziv_opstine,$naziv_mikrolokacije,$naziv_ulice){
        /*
         * Vraza id ulice iz tabele ulica gde je nazi grada opstine mikrolokacije
         * i ulice kao istoimeni prosledjeni argumenti, u slucaju greske vraca false 
         */
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT id_ulica FROM grad,opstina,mikrolokacija,ulica WHERE naziv_g='$naziv_grada'and naziv_o='$naziv_opstine' and naziv_m='$naziv_mikrolokacije' and naziv_u='$naziv_ulice';";
        $rezultat=$konekcija->query($upit);
        if($rezultat->rowCount()>0)         
            return $rezultat->fetch()['id_ulica'];
        else
            return false;
    }
}
