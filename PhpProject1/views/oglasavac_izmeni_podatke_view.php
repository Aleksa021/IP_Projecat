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
        <table>
        <form name="forma_izmeni_oglasavac" method="post" action="" onsubmit="return provera_izmene_oglasavac();">
            <tr>
                <td>
                    Kontakt telefon
                </td>
                <td>    
            <input type="text" name="telefon" value="<?php echo $korisnik->telefon?>">
                </td>
            </tr>
            <tr>
                <td>
                    Email
                </td>
                <td>    
            <input type='text' name='email' value="<?php echo $korisnik->email?>">
                </td>
            </tr>
            <tr>
                <td>
                    Agencija
                </td>
                <td>
                    <select name='agencija' id='agencija'>
                    <option value = 'nije_selektovano'>---</option>
                    <?php
                        foreach($agencije as $agencija){
                            echo Agencija_model::dohvati_id_agencije($agencija->naziv);
                            if($korisnik->agencija==$agencija->naziv)
                            echo"<option value = '$agencija->naziv' selected> $agencija->naziv</option>";
                            else
                                echo"<option value = '$agencija->naziv' > $agencija->naziv</option>";
                            
                        }
                    ?>
                </select>
                </td>
            </tr>
            <tr>
                <td>
                    Broj licence
                </td>
                <td>    
            <input type="text" name="broj_licence" value="<?php echo $korisnik->broj_licence?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">
            <input type='submit' name='dugme_izmeni' value="Izmeni">
                </td>
            </tr>
        </form>
        </table>
        <?php
         
        ?>
    </body>
</html>
