<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>OVO VIDI KUPAC</h1>
        <table>
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
                    <input type='text' name='grad'>
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
                    Maksimalna Cena
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
        </table>
        <?php
        // put your code here
        ?>
    </body>
</html>
