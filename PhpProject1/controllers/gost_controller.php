<?php

require_once ('models/ModelAutor.php');
require_once ('models/Korisnik.php');
require_once ('models/Agencija.php');
require_once 'models/Grad.php';
require_once 'models/Nekretnina.php';
require_once 'models/Grad.php';
require_once 'models/Opstina.php';
require_once 'models/Mikrolokacija.php';
require_once 'models/Ulica.php';
class Gost_controller {
    /*
     * Klasa Gost_controller radi poslovnu logiku ako trenutno nije ulogovan
     * nijedan tip korisnika 
     */
   public function __construct($akcija) {
       session_start();
       if($akcija=='greska'){
           $this->greska();
        }
        else{
           if(isset($_SESSION['korisnik'])){
               $tip=$_SESSION['korisnik']->tip;
               header("Location: ?controller=$tip&akcija=index");
            }
        }
    }
    public function index($status=NULL,$greska=NULL){
        /*
         * Prikazuje pocetnu stranu sa formom za login, registraciju i 5 najnovijih
         * nekretnina
         */
       
       require_once("views/sablon/header_gost.php");
       require_once ("views/login.php");
       $greska=NULL;
       $agencije=Agencija_model::dohvati_agencije();
       if(!$agencije)
           $greska="Nije pronadjena nijedana agencija";
       $gradovi=Grad_model::dohvati_gradove();
       if(!$gradovi)
           $greska="Nije pronadjena nijedan grad";
       require_once ("views/registracija.php");
       $nekretnine= Nekretnina_model::dohvati_najnovije();
       require_once 'views/najnovije.php';
       require_once ("views/sablon/footer.php");
   }
   public function pretraga(){
       /*
        * 
        */
       $trazi=$_GET['pretraga'];
       $this->index($trazi);
   }

   public function login($korime=NULL,$poruka=NULL,$porukakorime=NULL,$porukalozinka=NULL){
       /*
        * Komunicira sa klasom Korisnik_model, prosledjuje argumente za logovanje
        * korisnika i na stranici ispisuje odgovarajuce greske i statuse
        */
       if(isset($_POST['dugme_login'])){
           if(empty($_POST['korisnicko_ime'])or empty($_POST['lozinka'])){
               $greska='Nije upisana vrednost za korisnicko ime ili lozinku';
               $this->index($greska);
           }
           else{
            $korisnik=Korisnik_model::dohvati_korisnika($_POST['korisnicko_ime']);
            if($korisnik){
                $_SESSION['korisnicko_ime']=$korisnik->korisnicko_ime;
                $_POST['lozinka']=hash("sha256",$_POST['lozinka']);
                if($korisnik->lozinka==$_POST['lozinka']){
                    if($korisnik->status_korisnika=='odobren'){
                        $_SESSION['korisnik']=$korisnik;
                        switch ($korisnik->tip){
                        case 'kupac':
                            header("Location: ?controller=kupac&akcija=index");
                            break;
                        case 'oglasavac':
                            header('Location: ?controller=oglasavac&akcija=index');
                            break;
                        case 'administrator':
                            header('Location: ?controller=administrator&akcija=index');
                            break;
                        }
                    }
                    else{
                        if($korisnik->status_korisnika=='nerazmotren'){
                            $greska="Korisnicki nalog nije jos odobren";
                        }
                        else{
                            $greska="Korisnicki nalog je odbijen";
                        }
                        $this->index(NULL,$greska);
                    }
                }
                else{
                    $greska="Pogresna sifra";
                    $this->index(NULL,$greska);
                }
            }
            else{
                $greska='Nije prondadjena korisnik sa tim korisnickim imenom';
                $this->index(NULL,$greska);
            }

        }
        
    }
    else{
        $greska='Nije forma nije pravilno submitovana';
        $this->index($greska);
    }
   }
 /*  Ovo je stara funkcija ako ti ne radi login
    public function login($korime=NULL,$poruka=NULL,$porukakorime=NULL,$porukalozinka=NULL){
       if(isset($_POST['dugme_login'])){
           if(empty($_POST['korisnicko_ime'])or empty($_POST['lozinka'])){
               $greska='Nije upisana vrednost za korisnicko ime ili lozinku';
               $this->index($greska);
           }
           else{
            $korisnik=Korisnik_model::proveri_korisnika($_POST['korisnicko_ime']);
            if($korisnik){
                $_SESSION['korisnicko_ime']=$korisnik;
                $korisnik_obj= Korisnik_model:: dohvati_korisnika_sa_lozinkom($_POST['korisnicko_ime'], $_POST['lozinka']);
                if($korisnik_obj){
                    $_SESSION['korisnik']=$korisnik_obj;
                    switch ($korisnik_obj->tip){
                    case 'kupac':
                        header("Location: ?controller=kupac&akcija=index");
                        break;
                    case 'oglasavac':
                        header('Location: ?controller=oglasavac&akcija=index');
                        break;
                    case 'administrator':
                        header('Location: ?controller=administrator&akcija=index');
                        break;
                    }
                }
                else{
                    $greska="Pogresna sifra";
                    $this->index($greska);
                }
            }
            else{
                $greska='Nije prondadjena korisnik sa tim korisnickim imenom';
                $this->index($greska);
            }

        }
        
    }
    else{
        $greska='Nije forma nije pravilno submitovana';
        $this->index($greska);
    }
   }*/
   public function greska() {
       /*
        * Prikazuje stranicu za gresku
        */
       require_once './views/greska.php';   
   }

     public function registracija(){
         /*
          * Komunicira sa klasom Korisnik_model i prosledjuje sve potrebne parametre
          * za registraciju novog korisnika, prikazuje sve potrebne greske
          */
        if(isset($_POST['dugme_registracija'])){
            $_POST['lozinka1']=hash("sha256",$_POST['lozinka1']);
            $_POST['lozinka2']=hash("sha256",$_POST['lozinka2']);
            if($_POST['tip']=='kupac')
                $status=Korisnik_model::dodaj_korisnika($_POST['ime'],$_POST['prezime'],$_POST['korisnicko_ime'],$_POST['lozinka1'],$_POST['grad'],$_POST['rodjendan'],$_POST['telefon'],$_POST['email'],'kupac');
            else{
                if($_POST['agencija']=='nije_selektovano'){
                    $status=Korisnik_model::dodaj_korisnika($_POST['ime'],$_POST['prezime'],$_POST['korisnicko_ime'],$_POST['lozinka1'],$_POST['grad'],$_POST['rodjendan'],$_POST['telefon'],$_POST['email'],'oglasavac');
                    }
                else
                    $status=Korisnik_model::dodaj_korisnika($_POST['ime'],$_POST['prezime'],$_POST['korisnicko_ime'],$_POST['lozinka1'],$_POST['grad'],$_POST['rodjendan'],$_POST['telefon'],$_POST['email'],'oglasavac',$_POST['agencija'],$_POST['broj_licence']);
                }
                if($status===True)
                    $this->index('Uspesna registracija',NULL);
                    
                else
                    $greska=$status;
        }
        else{
            $greska='Nije forma nije pravilno submitovana';
        }
        if(isset($greska))
            $this->index(NULL,$greska);
   }
}
?>