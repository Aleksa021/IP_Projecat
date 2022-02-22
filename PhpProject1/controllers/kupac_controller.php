<?php

require_once ('models/Korisnik.php');
require_once 'models/Opstina.php';
require_once 'models/Mikrolokacija.php';
require_once 'models/Ulica.php';
require_once 'models/Grad.php';
require_once 'models/Nekretnina.php';
require_once 'models/Omiljene.php';
require_once 'models/Slika.php';
class Kupac_controller {
    /*
     * Klasa  Kupac_controller radi poslovnu logiku ako je korisnik ulogovan kao
     * kupac
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
            //if($akcija=='index')
                //$_SESSION['nekretnine']=array();
        }
       
   }
    public function index(){
        /*
         * Prikazuje pocetnu stranu ako je korisnik ulogovan kao kupac i komunicira sa klasom 
         * Nekretnine_model za pretrazivanje nekretnina i prikazuje odgovaraujuce grske
         */
        if(isset($_POST['dugme_pretraga'])){
            $soba=$_POST['soba'];
            if($soba>5)
                $soba=5;
            if($soba<1)
                $soba=1;
            $nekretnine= Nekretnina_model::pretraga_nekretnina($_POST['tip'],
                    $_POST['grad'], $_POST['opstina'], $_POST['mikrolokacija'],
                    $_POST['cena'], $_POST['kvadratura'], $soba);
            if($nekretnine===false){
                $greska='Nepoznata Lokacija';
            }
            else{
                if(empty($nekretnine))
                    $greska='Ne postoji oglas sa izabranim opcijama';
                else{
                    $_SESSION['nekretnine']=$nekretnine;
                    header("Location: ?controller=kupac&akcija=pretraga&stranica=1");
                    
                }
                    
            }
        }
        require_once "views/sablon/header.php";
        require_once "views/sablon/menu.php";
        $gradovi= Grad_model::dohvati_gradove();
        require_once "views/kupac_view.php";
        require_once "views/sablon/footer.php";
    }
    public  function logout() {
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
    public function pretraga(){
        /*
         * Prikazuje stranicu sa formom za osnovnu pretragu i cuva sve nekretnine
         * pronadjene sa tim uslovima u sesiji, ako nije pronadjena nijedna nekretnina
         * prikazuje gresku
         */
        require_once 'views/sablon/header.php';
        require_once 'views/sablon/menu.php';
        $nekretnine= array_slice($_SESSION['nekretnine'], ($_GET['stranica']-1)*10,10);
        require_once 'views/kupac_pretraga_view.php';
        require_once 'views/sablon/footer.php';
    }
    public function pregled_nekretnine() {
        /*
         * Prikazuje stranicu za odredjenu nekretninu
         */
        require_once 'views/sablon/header.php';
        require_once 'views/sablon/menu.php';
        //$nekretnina= Nekretnina_model::dohvati_nekretninu($_GET['id']);
        $slike= Slika_model::dohvati_slike($_GET['id']);
        if($slike==false)
            $slike=array();
        if(isset($_POST['dugme_omiljeno'])){
         $poruka=Omiljene_model::dodaj_omiljene($_SESSION['korisnik']->korisnicko_ime, $_GET['id']);
         if($poruka!==false)
             $status="Uspesno dodato u omiljene";
         else
             $greska="Neuspesno ubacivanje u omiljene";
        }
        $nekretnina= Nekretnina_model::dohvati_nekretninu($_GET['id']);
        if(isset($_POST['dugme_kontakt'])){
            $kontakt=Korisnik_model::dohvati_korisnika($nekretnina->korisnicko_ime_n);
            if(!is_null($kontakt->agencija)){
                $agencija= Agencija_model::dohavti_agenciju($kontakt->agencija);
                if($agencija===false)
                    echo 'jeste';
                $naziv_g= Grad_model::dohvati_naziv_grada($agencija->id_grad);
            }
        }
        $prosek=Nekretnina_model::prosecna_cena_po_kvadratu($nekretnina->grad, $nekretnina->opstina, $nekretnina->mikrolokacija);
        require_once 'views/kupac_pregled_nekretnine_view.php';
        require_once 'views/sablon/footer.php';
        
    }
    public function napredna_pretraga(){
        /*
         * Prikazuje stranicu za naprednu pretragu i cuva sve nekretnine pronadjen 
         * sa tim uslovima u sesiji, ako nije pronadjena nijedna prikazuje gresku
         */
        require_once 'views/sablon/header.php';
        require_once 'views/sablon/menu.php';
        if(isset($_POST['dugme_napredna_pretraga'])){
            if(empty($_POST['stanje'])){
                $greska='Izaberite barem jedno stanje!';
            }
            else{
                $nekretnine=Nekretnina_model::napretna_pretraga($_POST['min_cena'], $_POST['max_cena'],
                        $_POST['min_kvadratura'], $_POST['max_kvadratura'],
                        $_POST['min_soba'], $_POST['max_soba'], 
                        $_POST['min_godina'], $_POST['max_godina'],
                        $_POST['stanje'],$_POST['min_sprat'], $_POST['max_sprat']);
                if(empty($nekretnine))
                    $greska='Ne postoji oglas sa izabranim opcijama';
                else{
                    $_SESSION['nekretnine']=$nekretnine;
                    header("Location: ?controller=kupac&akcija=pretraga&stranica=1");
                }
            }
        }
        require_once 'views/kupac_napredna_pretraga_view.php';
        require_once 'views/sablon/footer.php';
    }
    public function omiljeni() {
        /*
         * Prikazuje stranicu svih omiljenih nekretnina ulogovanog korisnika
         */
        require_once 'views/sablon/header.php';
        require_once 'views/sablon/menu.php';
        if(isset($_POST['dugme_omiljeni'])){
            Omiljene_model::izbrisi_omiljene($_SESSION['korisnik']->korisnicko_ime, $_POST['id_n']);
        }
        $nekretnine=Omiljene_model::dohvati_omiljene($_SESSION['korisnik']->korisnicko_ime);
        
        require_once 'views/kupac_omiljeni_view.php';
        require_once 'views/sablon/footer.php';
    }
}
