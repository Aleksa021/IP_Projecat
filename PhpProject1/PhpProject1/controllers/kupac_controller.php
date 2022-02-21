<?php

require_once ('models/Korisnik.php');
require_once 'models/Opstina.php';
require_once 'models/Mikrolokacija.php';
require_once 'models/Ulica.php';
require_once 'models/Grad.php';
require_once 'models/Nekretnina.php';
class Kupac_controller {
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
        session_destroy();
        header("Location: ?controller=gost&akcija=index");
        
    }
    public function promena_lozinke(){
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
        require_once 'views/sablon/header.php';
        require_once 'views/sablon/menu.php';
        $nekretnine= array_slice($_SESSION['nekretnine'], ($_GET['stranica']-1)*10,10);
        require_once 'views/kupac_pretraga_view.php';
        require_once 'views/sablon/footer.php';
    }
    public function pregled_nekretnine() {
        require_once 'views/sablon/header.php';
        require_once 'views/sablon/menu.php';
        //$nekretnina= Nekretnina_model::dohvati_nekretninu($_GET['id']);
        $nekretnina= Nekretnina_model::dohvati_nekretninu($_GET['id']);
        $prosek=Nekretnina_model::prosecna_cena_po_kvadratu($nekretnina->grad, $nekretnina->opstina, $nekretnina->mikrolokacija);
        require_once 'views/kupac_pregled_nekretnine_view.php';
        require_once 'views/sablon/footer.php';
        
    }
    public function napredna_pretraga(){
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
}
