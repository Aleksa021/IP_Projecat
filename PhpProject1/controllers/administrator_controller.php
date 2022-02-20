<?php
require_once ('models/ModelAutor.php');
require_once ('models/Korisnik.php');
require_once ('models/Agencija.php');
require_once 'models/Grad.php';
require_once 'models/Opstina.php';
require_once 'models/Mikrolokacija.php';
require_once 'models/Ulica.php';
class Administrator_controller {
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
    public function greska() {
       require_once 'views/greska.php';   
   }
   public function index(){
       $korisnici=Korisnik_model::dohvati_korisnike_za_odobrenje();
       if(empty($korisnici))
           $status="Nema novih korisnika koji za odobrenje!";
       require_once "views/sablon/header.php";
       require_once "views/sablon/menu.php";
       require_once 'views/administrator_view.php';
       require_once "views/sablon/footer.php";
       
   }
   public function logout() {
        session_destroy();
        header("Location: ?controller=gost&akcija=index");
        
    }
    public function odbij() {
     $korisnicko_ime=$_GET['korisnicko_ime'];
     $status=Korisnik_model::pormeni_status($korisnicko_ime,'odbijen');
     if(!$status)
         $greska="Problem pri promeni statusa";
     header("Location: ?controller=administrator&akcija=index");
    }
    public function odobri() {
     $korisnicko_ime=$_GET['korisnicko_ime'];
     $status=Korisnik_model::pormeni_status($korisnicko_ime,'odobren');
     if(!$status)
         $greska="Problem pri promeni statusa";
     header("Location: ?controller=administrator&akcija=index");
    }
    public function pretraga_korisnika($status=NULL,$greska=NULL) {
        require_once 'views/sablon/header.php';
        require_once 'views/sablon/menu.php';
        if(isset($_POST['dugme_izbrisi'])){
            $this->izbrisi_korisnika($status,$greska);
        }
        if(isset($_POST['dugme_izmeni'])){
            $this->izmeni_korisnika($status,$greska);
        }
        if(isset($_POST['dugme_pretraga'])){
            $korisnik=Korisnik_model::dohvati_korisnika($_POST['korisnicko_ime']);
            $agencije=Agencija_model::dohvati_agencije();
            $gradovi= Grad_model::dohvati_gradove();
            if($korisnik)
                require_once 'views/administrator_pretraga_rezultat_view.php';
            else     
                $greska='Nije pronadjen korisnik sa tim korisnickim imenom!';
                require_once 'views/administrator_pretraga_view.php';
        }
        else{
            echo $greska;
            require_once 'views/administrator_pretraga_view.php';
        }
        require_once 'views/sablon/footer.php';

        
    }
    public function izmeni_korisnika(&$status,&$greska){
        if($_POST['tip']=='oglasavac'){
            $status=Korisnik_model::izmeni_korisnika($_POST['staro_korisnicko_ime'], $_POST['ime'],
                    $_POST['prezime'], $_POST['korisnicko_ime'], $_POST['lozinka'], $_POST['grad'],
                    $_POST['rodjendan'], $_POST['telefon'], $_POST['email'], $_POST['tip'], $_POST['agencija'], $_POST['broj_licence']);
        }
        else{
        $status=Korisnik_model::izmeni_korisnika($_POST['staro_korisnicko_ime'], $_POST['ime'],
                $_POST['prezime'], $_POST['korisnicko_ime'], $_POST['lozinka'], $_POST['grad'],
                $_POST['rodjendan'], $_POST['telefon'], $_POST['email'], $_POST['tip']);
        }
        
        if($status)
            $status="Uspesno zamenjen korisnik!";
        else
            $greska="Neuspesna izmena, nema nikakvih promena";
    }

    public function izbrisi_korisnika(&$status,&$greska) {
       $status=Korisnik_model::izbrisi_korisnika($_POST['staro_korisnicko_ime']);
            if($status)
                $status="Uspesno izbrisan korisnik!";
            else
                $greska="Neuspesno brisanje";
    }
    public function dodaj_korisnika($status=NULL,$greska=NULL) {
        $gradovi= Grad_model::dohvati_gradove();
        $agencije= Agencija_model::dohvati_agencije();
        require_once 'views/sablon/header.php';
        require_once 'views/sablon/menu.php';
        require_once 'views/registracija.php';
        require_once 'views/sablon/footer.php';
    }
    public function registracija() {
        $status=NULL;
        $greska=NULL;
        if(isset($_POST['dugme_registracija'])){
            if($_POST['tip']=='kupac')
                $status=Korisnik_model::dodaj_korisnika($_POST['ime'],$_POST['prezime'],$_POST['korisnicko_ime'],$_POST['lozinka1'],$_POST['grad'],$_POST['rodjendan'],$_POST['telefon'],$_POST['email'],'kupac');
            else{
                if($_POST['agencija']=='nije_selektovana')
                    $status=Korisnik_model::dodaj_korisnika($_POST['ime'],$_POST['prezime'],$_POST['korisnicko_ime'],$_POST['lozinka1'],$_POST['grad'],$_POST['rodjendan'],$_POST['telefon'],$_POST['email'],'oglasavac');
                else
                    $status=Korisnik_model::dodaj_korisnika($_POST['ime'],$_POST['prezime'],$_POST['korisnicko_ime'],$_POST['lozinka1'],$_POST['grad'],$_POST['rodjendan'],$_POST['telefon'],$_POST['email'],'oglasavac',$_POST['agencija'],$_POST['broj_licence']);
                }
                if($status===True){
                    $status="Uspesna registracija!";
                    $this->dodaj_korisnika($status,$greska);
                }
                else
                    $greska=$status;
                    $status=NULL;
                    $this->dodaj_korisnika($status,$greska);
        }
        else{
            $greska='Nije forma nije pravilno submitovana';
            $this->dodaj_korisnika($status,$greska);
        }
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
    public function dodaj_agenciju() {
        require_once 'views/sablon/header.php';
        require_once 'views/sablon/menu.php';
        $gradovi= Grad_model::dohvati_gradove();
        if(isset($_POST['dugme_dodaj_agenciju'])){
            $status=Agencija_model::dodaj_agenciju($_POST['naziv'], $_POST['adresa'],$_POST['grad'], $_POST['pib'], $_POST['telefon']);
            if(!$status){
                $greska="Nije uspesno uneta agencija!";
                $status=NULL;
            }
            else{
                $status="Uspesno uneta agnecija!";
                $greska=NULL;
                        
            }
        }
        require_once 'views/administrator_agencija_view.php';
        require_once 'views/sablon/footer.php';
        
    }
    public function dodaj_mesta() {
        require_once 'views/sablon/header.php';
        require_once 'views/sablon/menu.php';
        if(isset($_POST['dugme_mikrolokacija_dodaj'])){
            $status=Mikrolokacija_model::dodaj_mikrolokaciju($_POST['grad'], $_POST['opstina'],$_POST['mikrolokacija']);
            if($status!==false){
                
                $status_mikro="Uspesno dodata mikrolokacija";
            }
            else
                $greska_mikro="Nije prondjena opstina!";  
            
        }
        if(isset($_POST['dugme_ulica_dodaj'])){
            $status= Ulica_model::dodaj_ulicu($_POST['grad'], $_POST['opstina'],$_POST['mikrolokacija'],$_POST['ulica']);
            if($status!==false){
                $status_ulica="Uspesno dodata ulica!";
            }
            else
                $greska_ulica="Nije prondjena mikrolokacija!";  
            
        }
        if(isset($_POST['dugme_mikrolokacija_izbrisi'])){
            $status=Mikrolokacija_model::izbrisi_mikrolokaciju($_POST['grad'], $_POST['opstina'],$_POST['mikrolokacija']);
            if($status!==false){
                
                $status_mikro="Uspesno izbrisana mikrolokacija";
            }
            else
                $greska_mikro="Nije prondjena opstina ili mikrolokacija!";  
            
        }
        
        if(isset($_POST['dugme_ulica_izbrisi'])){
            $status=Ulica_model::izbrisi_ulicu($_POST['grad'], $_POST['opstina'],$_POST['mikrolokacija'],$_POST['ulica']);
            if($status!==false){
                $status_ulica="Uspesno izbrisana ulica!";
            }
            else
                $greska_ulica="Nije prondjena opstina, mikrolokacija ili ulica!";  
            
        }
        $gradovi= Grad_model::dohvati_gradove();
        require_once 'views/administrator_mesta_view.php';
        
        
        require_once 'views/sablon/footer.php';
    }
}
