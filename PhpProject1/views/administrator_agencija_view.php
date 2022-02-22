<form name='forma_agencija'method="post" action="<?php $_SERVER['PHP_SELF']?>?controller=<?php if(isset($_SESSION['korisnik'])) echo $_SESSION['korisnik']->tip;else 'gost'?>&akcija=dodaj_agenciju" onsubmit='return provera_agencije();'>
    <table class="center">
        <tr>
            <td>
                Naziv
            </td> 
            <td>
                <input type='text' name='naziv'>
            </td>
        </tr>
        <tr>
            <td>
                Adresa
            </td> 
        <td> 
            <input type='text' name='adresa'>
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
                Kontakt telefon
            </td>
            <td>
                <input type="tel" name="telefon" required="True">
            </td>
        </tr>
        <tr>
            <td>
                PIB
            </td>
            <td>
                <input type='text' name='pib'>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="dugme_dodaj_agenciju" value="Dodaj agenciju">
            </td>
        </tr>
    </table>
    <font color='red'><?php if(isset($greska))echo $greska;?></font>
    <font color='green'><?php if(isset($status))echo $status;?></font>
</form>
<hr></hr>