
<?php
// put your code here
?>
<table>
    <form name='forma_mikrolokacije'method="post" action="" onsubmit="return provera_mikrolokacije()">
    <tr>
        <th>
            Grad
        </th>
        <th>
            Opstina
        </th>
        <th>
            Mikrolokacija
        </th>
    </tr>
    <tr>
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
        <td>
            <input type='text' name='opstina' >
        </td>
        <td>
            <input type='text' name='mikrolokacija' >
        </td>
        <td>
            <input type='submit' name='dugme_mikrolokacija_dodaj' value='Dodaj mikrolokaciju'>
        </td>
        <td>
            <input type='submit' name='dugme_mikrolokacija_izbrisi' value='Izbrisi mikrolokaciju'>
        </td>
    </tr>
    </form>
</table>
        <font color='red'><?php if(isset($greska_mikro))echo $greska_mikro;?></font>
    <font color='green'><?php if(isset($status_mikro))echo $status_mikro;?></font>
    <hr>
    
    
    
    <table>
    <form name='forma_ulica'method="post" action="" onsubmit="return provera_ulice()">
    <tr>
        <th>
            Grad
        </th>
        <th>
            Opstina
        </th>
        <th>
            Mikrolokacija
        </th>
        <th>
            Ulica
        </th>
    </tr>
    <tr>
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
        <td>
            <input type='text' name='opstina' >
        </td>
        <td>
            <input type='text' name='mikrolokacija' >
        </td>
        <td>
            <input type='text' name='ulica' >
        </td>
        <td>
            <input type='submit' name='dugme_ulica_dodaj' value='Dodaj ulicu'>
        </td>
        <td>
            <input type='submit' name='dugme_ulica_izbrisi' value='Izbrisi ulicu'>
        </td>
    </tr>
    </form>
</table>
        <font color='red'><?php if(isset($greska_ulica))echo $greska_ulica;?></font>
    <font color='green'><?php if(isset($status_ulica))echo $status_ulica;?></font>
    <hr>