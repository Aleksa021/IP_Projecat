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
        <h1>OVO VIDI OGLASIVAC</h1>
        <table>
            <tr>
                <th>
                Naziv
                </th>
                <th>
                Cena
                </th>
            </tr>
            <?php
            foreach ($nekretnine as $nekretnina) {
                
            ?>
            <tr>
            <form method="post" action="">
                <td>
                    <?php echo $nekretnina->naziv?>
                    <input type="hidden" name='id_nekretnina'value="<?php echo $nekretnina->id_nekretnina ?>">
                </td>
                <td>
                    <?php echo $nekretnina->cena?>
                </td>
                <?php if ($nekretnina->prodato):?>
                <td>Prodato</td>
                <?php endif?>
                <?php if (!$nekretnina->prodato):?>
                <td>
                    <input type="submit" name="dugme_izmeni" value="IZMENI">
                </td>
                <td>
                    <input type="submit" name="dugme_prodaj" value="PRODATO">
                </td>
                <?php endif?>
                
            </form>
            </tr>
            <?php
            }
            ?>
        </table>
        <?php
        // put your code here
        ?>
    </body>
</html>
