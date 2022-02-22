<?php
require_once ('models/Korisnik.php');
require_once ('models/Agencija.php');
require_once 'models/Nekretnina.php';
require_once 'models/Grad.php';
require_once 'models/Opstina.php';
require_once 'models/Mikrolokacija.php';
require_once 'models/Ulica.php';
require_once 'models/Slika.php';
class Oglasavac_controller {
    /*
     * Klasa Oglasavac_controller radi poslovnu logiku ako je korisnik ulogvan
     * kao oglasivac
     */
    public function __construct($akcija) {
       session_start();
       if($akcija=='greska'){
           $this->greska();
        }
        else{
           if(!isset($_SESSION['korisnik'])){
               header("Location: ?controller=gost&akcija=index");
            }
        }
       
   }
   public function index(){
       /*
        * Prikazuje pocetnu stranicu ako je korisnik ulogovan kao oglasivac sa svim
        * njegogvim nekretninama i mogucnost izmene i prodaje
        */
       
       if(isset($_POST['dugme_izmeni'])){
           $id=$_POST['id_nekretnina'];
           header ("Location: ?controller=oglasavac&akcija=izmeni_nekretninu&id=$id");
       }
       require_once 'views/sablon/header.php';
       require_once 'views/sablon/menu.php';
       if(isset($_POST['dugme_prodaj']))
           Nekretnina_model::prodaj_nekretninu($_POST['id_nekretnina']);
       
       $nekretnine= Nekretnina_model::dohvati_nekretnine($_SESSION['korisnik']->korisnicko_ime);
       if($nekretnine===false)
           $nekretnine=array();
       require_once 'views/oglasavac_view.php';
       require_once 'views/sablon/footer.php';
   }
   public function dodaj_nekretninu() {
       /*
        * Prikazuje stranicu za dodaanje njene nekretnine i komunicira sa klasom
        * Nekretnine_model za prenos podataka i ispisuje odgovarajucu gresku
        */
       if(isset($_POST['dugme_nekretnina'])){
           $nekretnina=Nekretnina_model::dodaj_nekretninu($_POST['naziv'],$_SESSION['korisnik']->korisnicko_ime,$_POST['grad'],
                   $_POST['opstina'],$_POST['mikrolokacija'],$_POST['ulica'],$_POST['tip'],
                   $_POST['soba'],$_POST['kvadratura'],$_POST['godina'],$_POST['stanje'],$_POST['sprat'],
                   $_POST['max_sprat'],$_POST['cena'],$_POST['opis']);

           if($nekretnina!==false){
               if(count($_POST['slike'])>=3 &&count($_POST['slike'])<=6){
                   Slika_model::dodaj_slike($_POST['slike'], $nekretnina);
                   $status='Uspesno dodata nekretnina!';
               }
               else
                   $greska="Neuspesna registracija nekretnine nepravalin broj slika!";
           }
           else
               $greska="Neuspesna registracija nekretnine probelm sa podacima!";

       }
       require_once 'views/sablon/header.php';
       require_once 'views/sablon/menu.php';
       $gradovi= Grad_model::dohvati_gradove();
        //$opstine=Opstina::dohvati_opstine($selektovan_grad);

       require_once 'views/oglasavac_nekretnina_view.php';
       require 'views/sablon/footer.php';
       
   }
   public function izmeni_nekretninu(){
       /*
        * Prikazuje stranicu sa formom za dodavanje nekretnine sa vec popunjenim
        * podacima iz baze za nekretnine i radi komunikaciju sa klasom Nekretnine_model 
        * za izmenu prikupljenih podataka
        */
       require_once 'views/sablon/header.php';
       require_once 'views/sablon/menu.php';
       if(isset($_POST['dugme_nekretnina_izmeni'])){
           $poruka=Nekretnina_model::izmeni_nekretninu($_GET['id'],$_POST['naziv'],$_POST['grad'],
                   $_POST['opstina'],$_POST['mikrolokacija'],$_POST['ulica'],$_POST['tip'],
                   $_POST['soba'],$_POST['kvadratura'],$_POST['godina'],$_POST['stanje'],$_POST['sprat'],
                   $_POST['max_sprat'],$_POST['cena'],$_POST['opis']);
           if($poruka===false)
               $greska="Neuspesna izmena";
            
       }
       $nekretnina=Nekretnina_model::dohvati_nekretninu($_GET['id']);
       $gradovi= Grad_model::dohvati_gradove();
       require_once 'views/oglasavac_izmeni_nekretnina_view.php';
       require_once 'views/sablon/footer.php';
       
   }
   public function izmeni_podatke(){
       /*
        * Prikazuje stranicu za izmenu podataka vrzanih za agenciju i komunicira
        * sa klasom Agencija_model za prenos prikupljenih podataka i prikazuje 
        * gresku
        */
       require_once 'views/sablon/header.php';
       require_once 'views/sablon/menu.php';
       if(isset($_POST['dugme_izmeni'])){
           if($_POST['agencija']=='nije_selektovano')
               Korisnik_model::izmeni_korisnika_oglasavac($_SESSION['korisnik']->korisnicko_ime,$_POST['telefon'],$_POST['email']);
           else
               Korisnik_model::izmeni_korisnika_oglasavac($_SESSION['korisnik']->korisnicko_ime,$_POST['telefon'],$_POST['email'],$_POST['agencija'],$_POST['broj_licence']);
           $_SESSION['korisnik']=Korisnik_model::dohvati_korisnika($_SESSION['korisnik']->korisnicko_ime);
       }
       $agencije=Agencija_model::dohvati_agencije();
       $korisnik=$_SESSION['korisnik'];
       require_once 'views/oglasavac_izmeni_podatke_view.php';
       require_once 'views/sablon/footer.php';
   }
   public function logout() {
       /*
        * Izloguje odgovarajuceg korisnika i vraca ga na pocetnu stranicu kao gosta
        */
        session_destroy();
        header("Location: ?controller=gost&akcija=index");
        
    }
    public function promena_lozinke(){
        /*
         * Ako prikazuje stranicu za promenu lozinke, ako je kliknuto dugme
         * promeni_lozinku komunicira sa klasom Nekretnina_model za izmenu lozinke
         * ako je uspesno poziva se funkcija logout
         */
        if(isset($_POST['dugme_lozinka'])){
            $_POST['lozinka1']=hash("sha256",$_POST['lozinka1']);
            $_POST['stara_lozinka']=hash("sha256",$_POST['stara_lozinka']);
            $status=Korisnik_model::promeni_lozinku($_SESSION['korisnik']->korisnicko_ime, $_POST['stara_lozinka'], $_POST['lozinka1']);
            if($status!==true){
                $greska=$status;
            }
            else
               $this->logout();
        }
        require_once 'views/sablon/header.php';
        require_once 'views/sablon/menu.php';
        require_once 'views/promena_lozinke.php';
        require_once 'views/sablon/footer.php';
    }
}
