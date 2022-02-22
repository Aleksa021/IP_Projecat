<?php
require_once 'models/Agencija.php';
class Korisnik_model {
    /*
     * Klasa Korisnik_model povezuje se sa tabelom korisnik iz baze podataka
     * nekretnine
     */
    private $ime;
    private $prezime;
    private $korisnicko_ime;
    private $lozinka;
    private $grad;
    private $rodjendan;
    private $telefon;
    private $email;
    private $tip;
    private $agencija;
    private $broj_licence;
    private $status_korisnika;
    public function __construct($ime,$prezime,$korisnicko_ime,$lozinka,$grad,$rodjendan,$telefon,$email,$tip,$agencija,$broj_licence,$status_korisnika) {
        $this->ime=$ime;
        $this->prezime=$prezime;
        $this->korisnicko_ime=$korisnicko_ime;
        $this->lozinka=$lozinka;
        $this->grad=$grad;
        $this->rodjendan=$rodjendan;
        $this->telefon=$telefon;
        $this->email=$email;
        $this->tip=$tip;
        $this->agencija=$agencija;
        $this->broj_licence=$broj_licence;
        $this->status_korisnika=$status_korisnika;
    }
    public function __get($ime_atributa) {
           return $this->$ime_atributa;
    }
    
    //TODO izbaci jer ovo nema smisla
    public static function proveri_korisnika($korisnicko_ime) {
        /**
         * Vraca korisnicko ime ako postoji korisnik sa prosledjenim korisnickim
         * imenom, u slucaju
         * da ne postoji korisnik vraca false
         */
      $konekcija=DB::dohvati_instancu();

      $upit="SELECT * from korisnik WHERE korisnicko_ime='$korisnicko_ime'";
      $rezultat=$konekcija->query($upit);
      $korisnik= $rezultat->fetch();
      if($korisnik)
        return $korisnik['korisnicko_ime'];
      else
          return false;
    }
    
    public static function dohvati_korisnike_za_odobrenje() {
        /**
         * Vraca niz objekata korisnik_model sa popunjenim vrednostima iz baze,
         * gde je status korisnika "nerazmotren", u slucaju
         * greske vraca false
         */
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT * FROM korisnik WHERE status_korisnika='nerazmotren'";
        $rezultat=$konekcija->query($upit);
        $niz=[];
        foreach($rezultat->fetchAll() as $korisnik){
            $niz[]=new Korisnik_model($korisnik['ime'],$korisnik['prezime'],
                $korisnik['korisnicko_ime'],$korisnik['lozinka'], Grad_model::dohvati_naziv_grada($korisnik['id_grad']),
                $korisnik['rodjendan'],$korisnik['telefon'],$korisnik['email'],
                $korisnik['tip'], Agencija_model::dohvati_naziv_agencije($korisnik['id_agencija']),$korisnik['broj_licence'],$korisnik['status_korisnika']);
        }
        return $niz;
        
    }
    public static function dohvati_korisnika_sa_lozinkom($korisnicko_ime,$lozinka) {
        /*
         * Vraca objekat korisnik_model pod uslovom da postoji korisnik sa 
         * prosledjenim korisnickim imenom i lozinkom, u slucaju
         * greske vraca false
         */
      $konekcija=DB::dohvati_instancu();

      $upit="SELECT * from korisnik WHERE korisnicko_ime='$korisnicko_ime' and lozinka='$lozinka'";
      $rezultat=$konekcija->query($upit);
      $korisnik= $rezultat->fetch();
      if($korisnik)
        return new Korisnik_model($korisnik['ime'],$korisnik['prezime'],
                $korisnik['korisnicko_ime'],$korisnik['lozinka'], Grad_model::dohvati_naziv_grada($korisnik['id_grad']),
                $korisnik['rodjendan'],$korisnik['telefon'],$korisnik['email'],
                $korisnik['tip'],Agencija_model::dohvati_naziv_agencije($korisnik['id_agencija']),$korisnik['broj_licence'],$korisnik['status_korisnika']);
      else
          return false;

    }
    public static function dohvati_korisnika($korisnicko_ime) {
        /*
         * Vraca objekat korisnika popunjen vrednostima iz tabele nekretnina gde
         * je korisnicko ime kao prosledjen argument, u slucaju
         * greske vraca false
         */
      $konekcija=DB::dohvati_instancu();

      $upit="SELECT * from korisnik WHERE korisnicko_ime='$korisnicko_ime'";
      $rezultat=$konekcija->query($upit);
      $korisnik= $rezultat->fetch();
      if($korisnik)
        return new Korisnik_model($korisnik['ime'],$korisnik['prezime'],
                $korisnik['korisnicko_ime'],$korisnik['lozinka'], Grad_model::dohvati_naziv_grada($korisnik['id_grad']),
                $korisnik['rodjendan'],$korisnik['telefon'],$korisnik['email'],
                $korisnik['tip'],Agencija_model::dohvati_naziv_agencije($korisnik['id_agencija']),$korisnik['broj_licence'],$korisnik['status_korisnika']);
      else
          return false;

    }
    public static function dodaj_korisnika($ime,$prezime,$korisnicko_ime,$lozinka,
            $grad,$rodjendan,$telefon,$email,$tip,$agencija='NULL',$broj_licence=NULL,$status_korisnika='nerazmotren'){
        /*
         * Ubacuje novi red u tabelu korisnik sa podacima koji su prosledjeni
         * napomena: ako nije izabrana agencija, naziv agencije i broj licence
         * su NULL, u slucaju greske vraca false
         */
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT email FROM korisnik WHERE email='$email'";
        $rezulta=$konekcija->query($upit);
        if($rezulta->rowCount()){
            $greska="Vec postoji korisnik sa takvim email-om!";
            return $greska;
        }
        $upit="SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime='$korisnicko_ime'";
        $rezulta=$konekcija->query($upit);
        if($rezulta->rowCount()){
            $greska="Vec postoji korisnik sa takvim korisnickim imenom!";
            return $greska;
        }
        else{
            if($broj_licence=="")
                $broj_licence="NULL";
            else
                $broj="'".broj_licence."'";
            $id_grad= Grad_model::dohvati_id_grada($grad);
            if($agencija!='NULL')
                $id_agencija= Agencija_model::dohvati_id_agencije($agencija);
            else
                $id_agencija="NULL";
            $upit="INSERT INTO korisnik VALUES ('$korisnicko_ime','$ime','$prezime',"
                    . "'$lozinka',$id_grad,'$rodjendan','$telefon','$email','$tip',$id_agencija,$broj_licence,'$status_korisnika')";
            $status=$konekcija->query($upit);
            if(!$status){
                $greska="Nije lepo unet korisnik u bazu!";
                return $greska;
            }
            else
                return true;
        }
        
    }
    public static function promeni_lozinku($korisnicko_ime,$stara_lozinka,$nova_lozinka) {
        /*
         * Menja korisniku sifru u tabeli korisnik, u slucaju greske ili
         *  ne postoji korisnik, vraca false
         */
        
        $konekcija=DB::dohvati_instancu();
        $upit="SELECT lozinka FROM korisnik WHERE korisnicko_ime='$korisnicko_ime' and lozinka='$stara_lozinka'";
        $rezultat=$konekcija->query($upit);
        if($rezultat->rowCount()){
            $upit="UPDATE korisnik SET lozinka='$nova_lozinka' WHERE korisnicko_ime='$korisnicko_ime'";
            $status=$konekcija->query($upit);
            if(!$status){
                $greska="Nije uspesna zamena lozinke";
                return $greska;
            }
            else{
                return true;
            }
        }
        else{
            $greska="Pogresna stara loznika!";
            return $greska;
        }
    }
    public static function pormeni_status($korisnicko_ime,$novi_status) {
        /*
         * Menja stats korisnika u tabeli korisnik sa argumentom $novi_status,
         *  u slucaju greske vraca false
         */
        $konekcija=DB::dohvati_instancu();
        $upit="UPDATE korisnik SET status_korisnika='$novi_status' WHERE korisnicko_ime='$korisnicko_ime'";
        $status=$konekcija->query($upit);
        return $status;
        
    }
    public static function izmeni_korisnika($staro_korisnicko_ime,$ime,$prezime,
            $korisnicko_ime,$lozinka,$grad,$rodjendan,$telefon,$email,
            $tip,$agencija='NULL',$broj_licence='NULL') {
        /**
         * Menja sve vrednosti korisnika u tabeli korisnik kao one sa prosledjenim
         * argumentima, u slucaju greske vraca false
         */
        
        $konekcija=DB::dohvati_instancu();
        $id_grad=Grad_model::dohvati_id_grada($grad);
        $id_agencija= Agencija_model::dohvati_id_agencije($agencija);
        $upit_lozinka="";
        if($lozinka!=hash("sha256",""))
            $upit_lozinka="lozinka='$lozinka',";
        if($broj_licence=="")
            $broj_licence="NULL";
        else
            $broj="'".$broj_licence."'";
        $upit="UPDATE korisnik SET ime='$ime', prezime='$prezime', korisnicko_ime='$korisnicko_ime',"
                . " $upit_lozinka id_grad='$id_grad', rodjendan='$rodjendan', telefon='$telefon',"
                . " email='$email', tip='$tip', id_agencija=$id_agencija, broj_licence=$broj_licence"
                . " WHERE korisnicko_ime='$staro_korisnicko_ime'";
        $rezultat=$konekcija->query($upit);
        return $rezultat->rowCount()>0;
    }
    public static function izmeni_korisnika_oglasavac($korisnicko_ime,$telefon,
            $email,$agencija='NULL',$broj_licence='NULL') {
        /*
         * Menja informacije vezane za agenciju u tabeli korisnik, sa onim koji
         * su prosledjeni kao argumenti, u slucaju greske vraca false
         */
        $konekcija=DB::dohvati_instancu();
        if(!$agencija!='NULL')
            $id_agencija= Agencija_model::dohvati_id_agencije($agencija);
        else
            $id_agencija='NULL';
        if($broj_licence=="")
            $broj_licence="NULL";
        else
            $broj="'".broj_licence."'";
        $upit="UPDATE korisnik SET telefon='$telefon',email='$email', id_agencija=$id_agencija, broj_licence=$broj_licence WHERE korisnicko_ime='$korisnicko_ime'";
        $rezultat=$konekcija->query($upit);
        return $rezultat->rowCount()>0;
    }
    public static function izbrisi_korisnika($korisnicko_ime) {
        /*
         * Brise korisnika iz tabele korisnik, u slucaju greske vraca false
         */
        $konekcija=DB::dohvati_instancu();
        $upit="DELETE FROM korisnik WHERE korisnicko_ime='$korisnicko_ime'";
        $rezultat=$konekcija->query($upit);
        return $rezultat->rowCount()>0;
    }
}
