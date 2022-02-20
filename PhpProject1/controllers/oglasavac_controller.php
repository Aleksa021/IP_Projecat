<?php
require_once ('models/Korisnik.php');
require_once ('models/Agencija.php');
require_once 'models/Nekretnina.php';
require_once 'models/Grad.php';
require_once 'models/Opstina.php';
require_once 'models/Mikrolokacija.php';
require_once 'models/Ulica.php';
class Oglasavac_controller {
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
       
       if(isset($_POST['dugme_izmeni']))
           header ("Location: ?controller=oglasavac&akcija=izmeni");
       require_once 'views/sablon/header.php';
       require_once 'views/sablon/menu.php';
       if(isset($_POST['dugme_prodaj']))
           Nekretnina_model::prodaj_nekretninu($_POST['id_nekretnina'],$_SESSION['korisnik']->korisnicko_ime);
       
       $nekretnine= Nekretnina_model::dohvati_nekretnine($_SESSION['korisnik']->korisnicko_ime);
       require_once 'views/oglasavac_view.php';
       require_once 'views/sablon/footer.php';
   }
   public function dodaj_nekretninu() {
       if(isset($_POST['dugme_nekretnina'])){

           $nekretnina=Nekretnina_model::dodaj_nekretninu($_POST['naziv'],$_SESSION['korisnik']->korisnicko_ime,$_POST['grad'],
                   $_POST['opstina'],$_POST['mikrolokacija'],$_POST['ulica'],$_POST['tip'],
                   $_POST['soba'],$_POST['kvadratura'],$_POST['godina'],$_POST['stanje'],$_POST['sprat'],
                   $_POST['max_sprat'],$_POST['cena'],$_POST['opis']);

           if($nekretnina!==false)
               $status='Uspenso dadata nekretnina!';
           else
               $greska="Neuspesna registracija nekretnine!";
       }
       require_once 'views/sablon/header.php';
       require_once 'views/sablon/menu.php';
       $gradovi= Grad_model::dohvati_gradove();
        //$opstine=Opstina::dohvati_opstine($selektovan_grad);

       require_once 'views/oglasavac_nekretnina_view.php';
       
   }
   public function izmeni(){
       
   }
   public function izmeni_podatke(){
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
        session_destroy();
        header("Location: ?controller=gost&akcija=index");
        
    }
    public function promena_lozinke(){
        if(isset($_POST['dugme_lozinka'])){
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
