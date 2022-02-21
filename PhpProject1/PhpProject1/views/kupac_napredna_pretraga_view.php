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
            <form method='post' name="forma_napredna_pretraga"action="" onsubmit="return provera_napredne_pretrage();">
                <td>
                    Minimalna cena
                </td>
                <td>
                    <input type='text' name='min_cena'>
                </td>
            </tr>
            <tr>
                <td>
                    Maksimalna cena
                </td>
                <td>
                    <input type='text' name='max_cena'>
                </td>
            </tr>
            <tr>
                <td>
                    Minimalna kvadratura (m^2)
                </td>
                <td>
                    <input type='text' name='min_kvadratura'>
                </td>
            </tr>
            <tr>
                <td>
                    Maksimalna kvadratura (m^2)
                </td>
                <td>
                    <input type='text' name='max_kvadratura'>
                </td>
            </tr>
            <tr>
                <td>
                    Minimalna broj soba
                </td>
                <td>
                    <input type='text' name='min_soba'>
                </td>
            </tr>
            <tr>
                <td>
                    Maksimalan broj soba
                </td>
                <td>
                    <input type='text' name='max_soba'>
                </td>
            </tr>
            <tr>
                <td>
                    Minimalna godina izgradnje
                </td>
                <td>
                    <input type='text' name='min_godina'>
                </td>
            </tr>
            <tr>
                <td>
                    Maksimalna godina izgradnje
                </td>
                <td>
                    <input type='text' name='max_godina'>
                </td>
            </tr>
            <tr>
                <td>
                    Stanje
                </td>
                <td>
                    <select name='stanje[]' id="stanje" multiple>
                    <?php
                    $stanja=array("'izvorno'","'renovirano'","'LUX'");
                    foreach ($stanja as $stanje) {
                    ?>
                        <option value="<?php echo $stanje;?>"><?php echo $stanje;?></option>   
                        <?php

                    }
                    ?>
                    </select>
                </td>
            </tr>
                <tr>
                <td>
                    Sprat od
                </td>
                <td>
                    <input type='text' name='min_sprat'>
                </td>
            </tr>
            <tr>
                <td>
                    Sprat do
                </td>
                <td>
                    <input type='text' name='max_sprat'>
                </td>
            </tr>
            <tr>
                <td>
                    <input type='submit' name='dugme_napredna_pretraga' value='Pretrazi'>
                </td>
            </tr>
            </form>
        </table>
        <?php
        // put your code here
        ?>
    <font color='red'><?php if(isset($greska))echo $greska;?></font>
    <font color='green'><?php if(isset($status))echo $status;?></font>
    </body>
</html>
