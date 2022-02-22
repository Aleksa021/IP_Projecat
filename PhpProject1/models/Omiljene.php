<?php


class Omiljene_model {
    /*
     * Klasa Omiljene_model povezuje se sa tabelom omiljene iz baze podataka
     * nekretnine
     */
    private $id_o;
    private $korisnicko_ime;
    private $id_n;
    public function __construct($id_o,$korisnicko_ime,$id_n) {
        $this->id_o=$id_o;
        $this->korisnicko_ime=$korisnicko_ime;
        $this->id_n=$id_n;
    }
     public function __get($ime_atributa) {
        return $this->$ime_atributa;
 }
 public static function dodaj_omiljene($korisnicko_ime,$id_n){
     /*
      * Ubacuje novi red u tabelu oiljene sa vrednostima prosledjenih argumenata, u slucaju greske vraca false
      */
     $konekcija=DB::dohvati_instancu();
     $upit= "SELECT * FROM omiljene WHERE korisnicko_ime_o='$korisnicko_ime' and id_n=$id_n";
     $rezultat=$konekcija->query($upit);
     if($rezultat->rowCount()>0)
         return false;
     $upit= "SELECT * FROM omiljene WHERE korisnicko_ime_o='$korisnicko_ime'";
     $rezultat=$konekcija->query($upit);
    if($rezultat->rowCount()>=5)
         return false;
     $upit="INSERT INTO omiljene VALUES(NULL,'$korisnicko_ime',$id_n)";
     $rezultat=$konekcija->query($upit);
     return $rezultat->rowCount()>0;
 }
 public static function dohvati_omiljene($korisnicko_ime) {
     /*
      * Vraa niz objekata_model sa korisnickim imenom kao prosledjenim argumentom, u slucaju greske vraca false
      */
     $upit="SELECT * FROM nekretnina,omiljene WHERE nekretnina.id_nekretnina=omiljene.id_n";
     $konekcija=DB::dohvati_instancu();
     $rezultat=$konekcija->query($upit);
     $niz=[];
        foreach($rezultat->fetchAll() as $red){
            $naziv_niz=Ulica_model::dohvati_sve_nazive($red['id_grad'], $red['id_opstina'], $red['id_mikrolokacija'], $red['id_ulica']);
            $niz[]=new Nekretnina_model($red['id_nekretnina'],$red['naziv'],$red['korisnicko_ime_n'],$naziv_niz[0]
                    ,$naziv_niz[1],$naziv_niz[2],$naziv_niz[3],$red['tip']
                    ,$red['soba'],$red['kvadratura'],$red['godina']
                    ,$red['stanje'],$red['sprat'],$red['max_sprat']
                    ,$red['cena'],$red['opis'],$red['prodato']);
        }
        if(empty($niz))
            return FALSE;
        else
            return $niz;
     
 }
  public static function izbrisi_omiljene($korisnicko_ime,$id_n){
      /*
       * Brise red iz tabele omiljeni gde je korisnicko ime i id nekretnine kao
       * prosledjeni argument, u slucaju greske ili nepostojanja reda u tabeli omiljene, vraca false
       */
     $upit="DELETE FROM omiljene WHERE korisnicko_ime_o='$korisnicko_ime' and id_n=$id_n";
     $konekcija=DB::dohvati_instancu();
     $rezultat=$konekcija->query($upit);
     return $rezultat->rowCount()>0;
 }
}
