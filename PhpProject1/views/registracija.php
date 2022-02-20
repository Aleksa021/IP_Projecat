<form name='forma_registracija'method="post" action="<?php $_SERVER['PHP_SELF']?>?controller=<?php if(isset($_SESSION['korisnik'])) echo $_SESSION['korisnik']->tip;else echo 'gost'?>&akcija=registracija" onsubmit='return provera_registracije();'>
    <table>
        <tr>
            <td>
                Ime
            </td> 
            <td>
                <input type='text' name='ime'>
            </td>
        </tr>
        <tr>
            <td>
                Prezime
            </td> 
        <td> 
            <input type='text' name='prezime'>
        </td>
        </tr>
        <tr> 
            <td>
                Korisnicko ime
            </td> 
            <td>
                <input type='text' name='korisnicko_ime'>
            </td>
        </tr>
        <tr>
            <td>
                Lozinka
            </td>
            <td>
                <input type='password' name='lozinka1' > 
            </td>
        </tr>
        <tr>
            <td>
                Potvrda lozinke
            </td>
            <td>
                <input type='password' name='lozinka2' > 
            </td>
        </tr>
        <tr>
            <td>
                Grad
            </td> 
            <td>
                <select name='grad' id="grad">
                    <option value = 'nije_selektovano'>---</option>
                    <?php
                        foreach($gradovi as $grad){
                            echo"<option value = '$grad->naziv_g'>$grad->naziv_g</option>";
                            
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                Dan rodjenja
            </td>
            <td>
                <input type="date" name="rodjendan" required="True">
            </td>
        </tr>
        <tr>
            <td>
                Kontakt telefon
            </td>
            <td>
                <input type="tel" name="telefon" required="True">
            </td>
        </tr>
        <tr>
            <td>
                Email
            </td>
            <td>
                <input type='text' name='email'>
            </td>
        </tr>
        <tr>
            <td>
                Tip
            </td>
            <td>
                <select name="tip" id="tip">
                    <option value = 'kupac'>Kupac</option>
                    <option value = 'oglasavac'>Oglasavac</option>
                    <?php if($_SESSION['korisnik']->tip=='administrator'):?>
                    <option value = 'administrator'>Administrator</option>
                    <?php endif?>
                </select>
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
                            echo"<option value = '$agencija->naziv'> $agencija->naziv</option>";
                            
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                Broj Licence
            </td>
            <td>
                <input type='text' name='broj_licence'>
            </td>
        </tr>
        <tr>
            <td colspan='2'>
                <input type="submit" name='dugme_registracija' value='<?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->tip=='administrator') echo 'Dodaj korisnika';else echo'Registruj se';?>'>
            </td>
        </tr>
    </table>
    <font color='red'><?php if(isset($greska))echo $greska;?></font>
    <font color='green'><?php if(isset($status))echo $status;?></font>
</form>
<hr></hr>