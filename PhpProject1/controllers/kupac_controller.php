<?php

require_once ('models/Korisnik.php');
require_once 'models/Opstina.php';
require_once 'models/Mikrolokacija.php';
require_once 'models/Ulica.php';
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
        }
       
   }
    public function index(){
        //require_once ("views/sablon/header_kupac.php");
        require_once "views/sablon/header.php";
        require_once "views/sablon/menu.php";
        require_once "views/kupac_view.php";
        require_once "views/sablon/footer.php";
    }
    public  function logout() {
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
