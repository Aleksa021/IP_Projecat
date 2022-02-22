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
        <?php if(!empty($nekretnine)):?>
        <table class="center">
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
                    <?php echo number_format($nekretnina->cena,2)?>
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
        <?php endif?> 
        <?php if(empty($nekretnine)):?>
        <h2>
            Nemate nijedan oglas
        </h2>
        <?php endif?>
        <?php
        // put your code here
        ?>
    </body>
</html>
