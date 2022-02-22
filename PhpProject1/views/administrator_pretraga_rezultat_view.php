<table class="center">
    <tr>
        <th>
            Ime
        </th>
        <th>
            Prezime
        </th>
        <th>
            Korisnicko ime
        </th>
        <th>
            Lozinka
        </th>
        <th>
            Grad
        </th>
        <th>
            Rodjenda
        </th>
        <th>
            Kontakt telefon
        </th>
        <th>
            Email
        </th>
        <th>
            Tip korisnika
        </th>
        <th>
            Agencija
        </th>
        <th>
            Broj Licence
        </th>
    </tr>
    <tr>
        <form name="forma_izmeni" method="post" action='' onsubmit="return provera_izmene_korisnika();">
            <td>
                <input type='text' name='ime' value="<?php echo $korisnik->ime?>">
            </td>
            <td>
                <input type='text' name='prezime' value="<?php echo $korisnik->prezime?>">
            </td>
            <td>
                <input type='text' name='korisnicko_ime' value="<?php echo $korisnik->korisnicko_ime ?>">
            </td>
            <td>
                <input type='text' name='lozinka'>
            </td>
            <td>
                    <select name='grad' id="grad">
                        <?php
                            foreach($gradovi as $grad){
                                if($grad->naziv_g==$korisnik->grad)
                                    echo"<option value = '$grad->naziv_g' selected>$grad->naziv_g</option>";
                                else
                                    echo"<option value = '$grad->naziv_g'>$grad->naziv_g</option>";

                            }
                        ?>
                    </select>
            </td>
            <td>
                <input type='date' name='rodjendan' value="<?php echo $korisnik->rodjendan?>">
            </td>
            <td>
                <input type='tel' name='telefon' value="<?php echo $korisnik->telefon?>">
            </td>
            <td>
                <input type='text' name='email' value="<?php echo $korisnik->email?>">
            </td>
            <td>
                <select name="tip" id="tip" >
                        <option value = 'oglasavac'  <?php if($korisnik->tip=='oglasavac') echo 'selected'?>>Oglasavac</option>
                    <option value = 'kupac' <?php if($korisnik->tip=='kupac') echo 'selected';?>>Kupac</option>
                </select>
            </td>
            <td>
                    <select name='agencija' id='agencija'>
                        <option value = 'nije_selektovano'>---</option>
                        <?php
                            foreach($agencije as $agencija){
                                if($agencija->naziv==$korisnik->agencija)
                                    echo"<option value = '$agencija->naziv' selected> $agencija->naziv</option>";
                                else
                                    echo"<option value = '$agencija->naziv'> $agencija->naziv</option>";

                            }
                        ?>
                    </select>
            </td>
            <td>
                <input type='text' name='broj_licence' value="<?php echo $korisnik->broj_licence?>">
            </td>
            <td>
                
        <input type='submit' name='dugme_izmeni' value='Izmeni'>
            </td>
            <td>
                
                <input type="hidden" name='staro_korisnicko_ime' value="<?php echo $korisnik->korisnicko_ime?>">
            </td>
            <td>
            <input type='submit' name='dugme_izbrisi' value='Izbrisi'>
        </td>
    </form>
    </tr>
</table>
