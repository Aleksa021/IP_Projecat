function provera_login(){
    var korisnicko_ime = document.forma_login.korisnicko_ime.value;
    var kor_reg=/^[A-Za-z0-9_]{6,}$/;
    var lozinka = document.forma_login.lozinka.value;
    var loz_reg=/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    //var loz_reg=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])([A-Za-z]{1,})([A-Za-z\d@$!%*?&]{7,})$/;
    if(korisnicko_ime=="" || lozinka==""){
        alert("Nisu popunjena sva polja");
        return false;
    }
}

function provera_registracije(){
    var ime = document.forma_registracija.ime.value;
    var prezime = document.forma_registracija.prezime.value;
    var tekst_reg=/^\w{1,}$/;
    var korisnicko_ime = document.forma_registracija.korisnicko_ime.value;
    var kor_reg=/^[A-Za-z0-9_]{6,}$/;
    var lozinka1 = document.forma_registracija.lozinka1.value;
    var lozinka2 = document.forma_registracija.lozinka2.value;
    var loz_reg=/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    //var loz_reg=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])([A-Za-z]{1,})([A-Za-z\d@$!%*?&]{7,})$/;
    var grad= document.getElementById("grad").value;
    if(grad=='nije_selektovano'){
        alert("Nije selektovan grad!")
        return false;
    }
    var telefon =document.forma_registracija.telefon.value;
    var telefon_reg=/^[\d]{1,}$/;
    //var telefon_reg=/^[\d]{9,10}$/;
    if(!telefon_reg.test(telefon)){
        alert("Neispravan broj telefona dozvoljene su samo cifre");
        return false;
    }
    var email=document.forma_registracija.email.value;
    var email_reg=/^[a-zA-Z\d]{2,}@([a-zA-Z\d]{1,}\.){1,}[a-z]{2,3}$/; 
    if(ime=="" || prezime=="" || korisnicko_ime=="" || lozinka1==""||lozinka2==""||email==""){
        alert("Nisu popunjena sva polja");
        return false;
    }
    if(lozinka1!=lozinka2){
        alert('Nisu iste lozinke!');
        return false;
    }
    if(!tekst_reg.test(ime)||!tekst_reg.test(prezime)){
        alert('Nevalidno ime ili prezime');
        return false;
    }
    if (!kor_reg.test(korisnicko_ime)){
        alert('Lose uneta sifra!');
        return false;
    }
    if(!loz_reg.test(lozinka1)||!loz_reg.test(lozinka2)){
        alert('Lose uneta lozinka!');
        return false;
    }
    
    if(!email_reg.test(email) ){
        alert('Lose uneta email!');
        return false;
    }
    var tip= document.getElementById("tip").value;
    var agencija=document.forma_registracija.agencija.value;
    var broj_licence=document.forma_registracija.broj_licence.value;
    if(tip=='oglasavac' && agencija!='nije_selektovano' && broj_licence==''){
        alert('Morate popuniti broj licence');
        return false;
    }
    if(tip=='oglasavac' && agencija=='nije_selektovano' && broj_licence!=''){
        alert('Morate izabrati agenciju');
        return false;
    }
}
function provera_promene_lozinke(){
    var stara_lozinka =document.forma_promena_lozinke.stara_lozinka.value;
    var lozinka1 = document.forma_promena_lozinke.lozinka1.value;
    var lozinka2 = document.forma_promena_lozinke.lozinka2.value;
    var loz_reg=/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    //var loz_reg=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])([A-Za-z]{1,})([A-Za-z\d@$!%*?&]{7,})$/;
    if(stara_lozinka=="" || lozinka1=="" || lozinka2==""){
        alert("Nisu popunjena sva polja");
        return false;
    }
    if(lozinka1!=lozinka2){
        alert('Lozinke nisu iste!');
        return false;
    }
    if(lozinka1==stara_lozinka){
        alert('Nova je ista kao i stara!');
        return false;
    }
    if(!loz_reg.test(lozinka1) || !loz_reg.test(lozinka1)){
        alert('Nevalidna lozinka!');
        return false;
    }
}

function provera_agencije(){
    var naziv =document.forma_agencija.naziv.value;
    var adresa = document.forma_agencija.adresa.value;
    
    var telefon = document.forma_agencija.telefon.value;
    var grad = document.forma_agencija.grad.value;
    var broj_reg=/^[\d]{1,}$/;
    var pib = document.forma_agencija.pib.value;
    if(naziv=="" || adresa=="" || telefon==""|| pib=="" || grad=="nije_selektovano"){
        alert("Nisu popunjena sva polja");
        return false;
    }
    if(!broj_reg.test(telefon)){
        alert('Nevalidan format broja telefona!');
        return false;
    }
    if(!broj_reg.test(pib)){
        alert('Nevalidan format PIB-a!');
        return false;
    }
}
function provera_mikrolokacije(){
    var grad=document.forma_mikrolokacije.grad.value;
    var opstina=document.forma_mikrolokacije.opstina.value;
    var mikro=document.forma_mikrolokacije.mikrolokacija.value;
    if(opstina=="" || mikro=="" || grad=="nije_selektovano"){
        alert("Nisu popunjena sva polja");
        return false;
    }
}
function provera_nekretnine(){
    var naziv=document.forma_nekretnina.naziv.value;
    var grad=document.forma_nekretnina.grad.value;
    var opstina=document.forma_nekretnina.opstina.value;
    var mikro=document.forma_nekretnina.mikrolokacija.value;
    var ulica=document.forma_nekretnina.ulica.value;
    var tip=document.forma_nekretnina.tip.value;
    var kvadratura=document.forma_nekretnina.kvadratura.value;
    var soba=document.forma_nekretnina.soba.value;
    var godina=document.forma_nekretnina.godina.value;
    var stanje=document.forma_nekretnina.stanje.value;
    var sprat=document.forma_nekretnina.sprat.value;
    var max_sprat=document.forma_nekretnina.max_sprat.value;
    var cena=document.forma_nekretnina.cena.value;
    if(naziv=="" || grad=="nije_selektovano" || opstina=="" || mikro==""  ||ulica=="" 
            || kvadratura=="" || soba ==""|| godina=="" ||stanje==""
            || sprat=="" ||max_sprat==""|| cena==""){
        alert("Nisu popunjena sva polja");
        return false;
    }
    var broj_reg=/^[\d]{1,}$/;
    var dec_reg=/^([\d]{0,}\.[\d]{0,}|[\d]{1,})$/;
    if(!broj_reg.test(kvadratura)||!dec_reg.test(soba)||!broj_reg.test(godina)||!broj_reg.test(sprat)||!broj_reg.test(max_sprat)||!dec_reg.test(cena)){
        alert('Losa format broja');
        return false;
    }
}
function provera_ulice(){
    var grad=document.forma_ulica.grad.value;
    var opstina=document.forma_ulica.opstina.value;
    var mikro=document.forma_ulica.mikrolokacija.value;
    var ulica=document.forma_ulica.ulica.value;
    if(opstina=="" || mikro=="" || grad=="nije_selektovano" || ulica==""){
        alert("Nisu popunjena sva polja");
        return false;
    }
}

function provera_izmene_korisnika(){
    var ime = document.forma_izmeni.ime.value;
    var prezime = document.forma_izmeni.prezime.value;
    var tekst_reg=/^\w{1,}$/;
    var korisnicko_ime = document.forma_izmeni.korisnicko_ime.value;
    var kor_reg=/^[A-Za-z0-9_]{6,}$/;
    var lozinka = document.forma_izmeni.lozinka.value;
    var loz_reg=/^((?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,})|()$/;
    //var loz_reg=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])([A-Za-z]{1,})([A-Za-z\d@$!%*?&]{7,})$/;
    var grad= document.getElementById("grad").value;
    if(grad=='nije_selektovano'){
        alert("Nije selektovan grad!")
        return false;
    }
    var telefon =document.forma_izmeni.telefon.value;
    var telefon_reg=/^[\d]{1,}$/;
    //var telefon_reg=/^[\d]{9,10}$/;
    if(!telefon_reg.test(telefon)){
        alert("Neispravan broj telefona dozvoljene su samo cifre");
        return false;
    }
    var email=document.forma_izmeni.email.value;
    var email_reg=/^[a-zA-Z\d]{2,}@([a-zA-Z\d]{1,}\.){1,}[a-z]{2,3}$/; 
    if(ime=="" || prezime=="" || korisnicko_ime=="" ||email==""){
        alert("Nisu popunjena sva polja");
        return false;
    }
    if(!tekst_reg.test(ime)||!tekst_reg.test(prezime)){
        alert('Nevalidno ime ili prezime');
        return false;
    }
    
    if(!email_reg.test(email) ){
        alert('Lose uneta email!');
        return false;
    }
    var tip= document.getElementById("tip").value;
    var agencija=document.forma_izmeni.agencija.value;
    var broj_licence=document.forma_izmeni.broj_licence.value;
    if(tip=='oglasavac' && agencija!='nije_selektovano' && broj_licence==''){
        alert('Morate popuniti broj licence');
        return false;
    }
    if(tip=='oglasavac' && agencija=='nije_selektovano' && broj_licence!=''){
        alert('Morate izabrati agenciju');
        return false;
    }
}
function provera_izmene_oglasavac(){
    var telefon =document.forma_izmeni_oglasavac.telefon.value;
    var telefon_reg=/^[\d]{1,}$/;
    //var telefon_reg=/^[\d]{9,10}$/;
    if(!telefon_reg.test(telefon)){
        alert("Neispravan broj telefona dozvoljene su samo cifre");
        return false;
    }
    var email=document.forma_izmeni_oglasavac.email.value;
    var email_reg=/^[a-zA-Z\d]{2,}@([a-zA-Z\d]{1,}\.){1,}[a-z]{2,3}$/; 
    if(!email_reg.test(email) ){
        alert('Lose uneta email!');
        return false;
    }
    var agencija=document.forma_izmeni_oglasavac.agencija.value;
    var broj_licence=document.forma_izmeni_oglasavac.broj_licence.value;
    if(agencija!='nije_selektovano' && broj_licence==''){
        alert('Morate popuniti broj licence');
        return false;
    }
}
function provera_pretrage(){
    var grad =document.forma_pretraga.grad.value;
    var opstina =document.forma_pretraga.opstina.value;
    var mikrolokacija =document.forma_pretraga.mikrolokacija.value;
    var cena =document.forma_pretraga.cena.value;
    var kvadratura =document.forma_pretraga.kvadratura.value;
    var soba =document.forma_pretraga.grad.value;
    if(mikrolokacija!='' &&(opstina=='' ||grad=='nije_selektovano')){
        alert('Neprecizna mikrolokacija, popunite opstinu i grad!');
        return false;
    }
    if(opstina!='' && grad=='nije_selektovano'){
        alert('Neprecizna opstina, izaberite grad!');
        return false;
    }
    var broj_reg=/^[\d]{0,}$/;
    var dec_reg=/^([\d]{0,}\.[\d]{0,}|[\d]{1,})|$/;
    if(!broj_reg.test(kvadratura)||!dec_reg.test(soba)||!dec_reg.test(cena)){
        alert('Losa format broja');
        return false;
    }

    
}