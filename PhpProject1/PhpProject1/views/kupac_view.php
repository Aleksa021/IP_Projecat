<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table>
            <form method='post' name="forma_pretraga"action="" onsubmit="return provera_pretrage();">
            <tr>
                <td>
                    Tip
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
                    Maksimalna cena
                </td>
                <td>
                    <input type='text' name='cena'>
                </td>
            </tr>
            <tr>
                <td>
                    Minimalna kvadratura (m^2)
                </td>
                <td>
                    <input type='text' name='kvadratura'>
                </td>
            </tr>
            <tr>
                <td>
                    Minimalna broj soba
                </td>
                <td>
                    <input type='text' name='soba'>
                </td>
            </tr>
            <tr>
                <td>
                    <input type='submit' name='dugme_pretraga' value='Pretrazi'>
                </td>
            </tr>
            </form>
        </table>
        <font color='red'><?php if(isset($greska))echo $greska;?></font>
        <font color='green'><?php if(isset($status))echo $status;?></font>
        <?php
        // put your code here
        ?>
    </body>
</html>
