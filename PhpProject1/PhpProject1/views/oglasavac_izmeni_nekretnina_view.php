
<form name='forma_nekretnina'method="post" action="" onsubmit='return provera_nekretnine();'>
    <table>
    <tr>
        <td>
            Naziv oglasa
        </td> 
        <td>
            <input type='text' name='naziv' value="<?php echo $nekretnina->naziv?>">
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
                echo $nekretnina->grad;
                    foreach($gradovi as $grad){
                        if($nekretnina->grad==$grad->naziv_g)
                        echo"<option value = '$grad->naziv_g' selected>$grad->naziv_g</option>";
                        else
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
            <input type='text' name='opstina' value="<?php echo $nekretnina->opstina?>">
        </td>
    </tr>
    <tr>
        <td>
            Mikrolokacija
        </td> 
        <td>
            <input type='text' name='mikrolokacija' value="<?php echo $nekretnina->mikrolokacija?>">
        </td>
    </tr>
    <tr>
        <td>
            Ulica
        </td> 
    <td> 
        <input type='text' name='ulica' value="<?php echo $nekretnina->ulica?>">
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
                        if($nekretnina->tip==$tip)
                            echo"<option value = '$tip' selected>$tip</option>";
                        else
                            echo"<option value = '$tip'>$tip</option>";
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
            <input type='text' name='kvadratura' value="<?php echo $nekretnina->kvadratura?>" > 
        </td>
    </tr>
        <td>
            Broj soba
        </td>
        <td>
            <input type='text' name='soba' value="<?php echo $nekretnina->soba?>"> 
        </td>
    <tr>
        <td>
            Godina izgradnje
        </td>
        <td>
            <input type='text' name='godina' value="<?php echo $nekretnina->godina?>"> 
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
                        if($nekretnina->stanje==$stanje)
                            echo"<option value = '$stanje' selected>$stanje</option>";
                        else
                            echo"<option value = '$stanje'>$stanje</option>";

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
            <input type="text" name='sprat' value="<?php echo $nekretnina->sprat?>">
        </td>
    </tr>
    <tr>
        <td>
            Spratnost
        </td>
        <td>
            <input type="text" name="max_sprat" value="<?php echo $nekretnina->max_sprat?>">
        </td>
    </tr>
    <tr>
        <td>
            Cena
        </td>
        <td>
            <input type='cena' name='cena' value="<?php echo $nekretnina->cena?>">
        </td>
    </tr>
    <tr>
        <td>
            Opis
        </td>
        <td>
            <textarea name="opis" cols="21" rows="20" ><?php echo $nekretnina->opis?></textarea>
        </td>
    </tr>
    <tr>
        <td colspan='2'>
            <input type="submit" name='dugme_nekretnina_izmeni' value='Izmeni nekretninu'>
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
