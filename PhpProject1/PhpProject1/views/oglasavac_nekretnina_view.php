
<form name='forma_nekretnina'method="post" action="<?php $_SERVER['PHP_SELF']?>?controller=<?php if(isset($_SESSION['korisnik'])) echo $_SESSION['korisnik']->tip;else 'gost'?>&akcija=dodaj_nekretninu" onsubmit='return provera_nekretnine();'>
<table>
    <tr>
        <td>
            Naziv oglasa
        </td> 
        <td>
            <input type='text' name='naziv'>
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
            Opstina
        </td> 
        <td>
            <input type='text' name='opstina'>
        </td>
    </tr>
    <tr>
        <td>
            Mikrolokacija
        </td> 
        <td>
            <input type='text' name='mikrolokacija'>
        </td>
    </tr>
    <tr>
        <td>
            Ulica
        </td> 
    <td> 
        <input type='text' name='ulica'>
    </td>
    </tr>
    <tr> 
        <td>
            Tip nekretnine
        </td> 
        <td>
            <select name='tip' id="tip">
                    <?php
                    $tipovi=array('stan','kuca','vikendica','lokal','magacin');
                    foreach ($tipovi as $tip) {
                    ?>
                    <option value="<?php echo $tip;?>"><?php echo $tip;?></option>   
                        <?php

                    }
                    ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            Kvadratura (m^2)
        </td>
        <td>
            <input type='text' name='kvadratura' > 
        </td>
    </tr>
        <td>
            Broj soba
        </td>
        <td>
            <input type='text' name='soba' > 
        </td>
    <tr>
        <td>
            Godina izgradnje
        </td>
        <td>
            <input type='text' name='godina' > 
        </td>
    </tr>

    <tr>
        <td>
            Stanje
        </td>
        <td>
            <select name='stanje' id="stanje">
                <?php
                $stanja=array('izvorno','renovirano','LUX');
                foreach ($stanja as $stanje) {
                        echo"<option value = '$stanje' >$stanje</option>";

                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>
            Sprat nekretnine
        </td>
        <td>
            <input type="text" name="sprat">
        </td>
    </tr>
    <tr>
        <td>
            Spratnost
        </td>
        <td>
            <input type="text" name="max_sprat">
        </td>
    </tr>
    <tr>
        <td>
            Cena
        </td>
        <td>
            <input type='cena' name='cena'>
        </td>
    </tr>
    <tr>
        <td>
            Opis
        </td>
        <td>
            <textarea name="opis" cols="21" rows="20"></textarea>
        </td>
    </tr>
    <tr>
        <td colspan='2'>
            <input type="submit" name='dugme_nekretnina' value='Dodaj nekretninu'>
        </td>
    </tr>
</table>
<font color='red'><?php if(isset($greska))echo $greska;?></font>
<font color='green'><?php if(isset($status))echo $status;?></font>
</form>

<?php
// put your code here
?>

<hr></hr>
