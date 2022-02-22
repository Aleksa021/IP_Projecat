<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1> <?php echo $nekretnina->naziv?></h1>
        <h3> <?php echo ($nekretnina->grad." - ".$nekretnina->opstina." - ".$nekretnina->mikrolokacija." - ".$nekretnina->ulica);?></h3>
        <?php foreach ($slike as $slika) {
            ?>
        <img src="slike\<?php echo $slika->putanja?>">
        <?php } ?>
             </br>
        <?php if($nekretnina->cena/$nekretnina->kvadratura>$prosek):?>
        <font color="red"> <?php echo $nekretnina->cena; ?> &euro;</font>
        <?php endif?>
        <?php if($nekretnina->cena/$nekretnina->kvadratura<=$prosek):?>
        <font color="green"> <?php echo $nekretnina->cena; ?> &euro;</font>
        <?php endif?>
        <form method="post" action=''>
            <input type="submit"  name="dugme_omiljeno"value="Dodaj u omiljene">
        </form>
        <form method="post" action="">
            <input type="submit" name="dugme_kontakt" value="+">
        </form>
        <?php if(isset($_POST['dugme_kontakt'])):?>
            <?php if(is_null($kontakt->agencija)):?>
        <table class="center">
            <tr>
                <td>
                    Ime
                </td>
                <td>
                    <?php echo $kontakt->ime?>
                </td>
            </tr>
            <tr>
                <td>
                    Prezime
                </td>
                <td>
                    <?php echo $kontakt->prezime?>
                </td>
            </tr>
            <tr>
                <td>
                    Kontakt telefon
                </td>
                <td>
                    <?php echo $kontakt->telefon?>
                </td>
            </tr>
        </table>
            <?php endif ?>
        
            <?php if(!is_null($kontakt->agencija)):?>
                <table class="center">
            <tr>
                <td>
                    Naziv agnecije
                </td>
                <td>
                    <?php echo $agencija->naziv?>
                </td>
            </tr>
            <tr>
                <td>
                    Adresa
                </td>
                <td>
                    <?php echo $agencija->adresa?>
                </td>
            </tr>
            <tr>
                <td>
                   Grad
                </td>
                <td>
                    <?php echo $naziv_g?>
                </td>
            </tr>
            <tr>
                <td>
                   PIB
                </td>
                <td>
                    <?php echo $agencija->PIB?>
                </td>
            </tr>
            <tr>
                <td>
                    Ime 
                </td>
                <td>
                    <?php echo $kontakt->ime?>
                </td>
            </tr>
            <tr>
                <td>
                    Prezime
                </td>
                <td>
                    <?php echo $kontakt->prezime?>
                </td>
            </tr>
            <tr>
                <td>
                    Broj licence
                </td>
                <td>
                    <?php echo $kontakt->broj_licence?>
                </td>
            </tr>
            <tr>
                <td>
                    Kontakt telefon
                </td>
                <td>
                    <?php echo $kontakt->telefon?>
                </td>
            </tr>
        </table>
            <?php endif ?>

        <?php endif ?>
        <font color='red'><?php if(isset($greska))echo $greska;?></font>
    <font color='green'><?php if(isset($status))echo $status;?></font>
    </body>
</html>
