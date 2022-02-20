<?php

require_once ('models/ModelAutor.php');
require_once ('models/Korisnik.php');
require_once ('models/Agencija.php');
require_once 'models/Grad.php';
class Gost_controller {
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
       require_once ("views/sablon/footer.php");
   }
   public function pretraga(){
       $trazi=$_GET['pretraga'];
       $this->index($trazi);
   }
   public function autori(){
       $autori=Autori::dohvatiAutore();
       require_once ("views/sablon/header_gost.php");
       require_once ("views/autori.php");
       require_once ("views/sablon/footer.php");
   }
   public function login($korime=NULL,$poruka=NULL,$porukakorime=NULL,$porukalozinka=NULL){
       if(isset($_POST['dugme_login'])){
           if(empty($_POST['korisnicko_ime'])or empty($_POST['lozinka'])){
               $greska='Nije upisana vrednost za korisnicko ime ili lozinku';
               $this->index($greska);
           }
           else{
            $korisnik=Korisnik_model::dohvati_korisnika($_POST['korisnicko_ime']);
            if($korisnik){
                $_SESSION['korisnicko_ime']=$korisnik->korisnicko_ime;
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
       require_once './views/greska.php';   
   }

     public function registracija(){
        if(isset($_POST['dugme_registracija'])){
            if($_POST['tip']=='kupac')
                $status=Korisnik_model::dodaj_korisnika($_POST['ime'],$_POST['prezime'],$_POST['korisnicko_ime'],$_POST['lozinka1'],$_POST['grad'],$_POST['rodjendan'],$_POST['telefon'],$_POST['email'],'kupac');
            else{
                if($_POST['agencija']=='nije_selektovano'){
                    echo 'ovde je';
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