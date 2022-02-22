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
    <?php if(empty($nekretnine)):?>
    <h1>Nemate nista u omiljene </h1>
    <?php endif?>
    <?php if(!empty($nekretnine)):?>
    <table class="center">
            <tr>
                <th>
                    Naziv oglasa
                </th>
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
                    Kvadratura
                </th>
                <th>
                   Broj soba
                </th>
                <th>
                    Spratnost
                </th>
                <th>
                    Opis
                </th>
                <th>
                    Cena
                </th>
                <th>
                    Prosecna cena na lokaciji
                </th>
            </tr>
        <?php
        foreach ($nekretnine as $nekretnina){
        ?>
            <tr height="20%">
            <form method="post" action="">
                <td>
                    <a href="?controller=kupac&akcija=pregled_nekretnine&id=<?php echo $nekretnina->id_nekretnina?>"><?php echo $nekretnina->naziv?></a>
                </td>
                <td>
                    <?php echo $nekretnina->grad?>
                </td>
                <td>
                    <?php echo $nekretnina->opstina?>
                </td>
                <td>
                    <?php echo $nekretnina->mikrolokacija?>
                </td>
                <td>
                    <?php echo $nekretnina->kvadratura?>
                </td>
                <td>
                    <?php echo $nekretnina->soba?>
                </td>
                <td>
                    <?php echo $nekretnina->max_sprat?>
                </td>
                <td width="30%" >
                    <?php
                    echo implode(" ", array_slice(explode(' ',$nekretnina->opis),0,50));
                    ?>
                    
                </td>
                <td>
                    <?php echo number_format($nekretnina->cena,2)?>
                </td>
                <td>
                    <?php echo number_format(Nekretnina_model::prosecna_cena_po_kvadratu($nekretnina->grad, $nekretnina->opstina, $nekretnina->mikrolokacija),2)?>
                </td>
                <td>
                    <input type="hidden" name="id_n" value="<?php echo $nekretnina->id_nekretnina;?>">
                    <input type="submit" name="dugme_omiljeni" value="Izbaci iz omiljene">
                </td>
            </form>
            </tr>    
            
        <?php
        }
        ?>    
        </table>
    <?php endif?>
</html>
