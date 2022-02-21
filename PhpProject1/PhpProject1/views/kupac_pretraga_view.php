<?php require_once 'models/Nekretnina.php';?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table>
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
                    <?php echo number_format(Nekretnina_model::prosecna_cena($nekretnina->grad, $nekretnina->opstina, $nekretnina->mikrolokacija),2)?>
                </td>
            </tr>    
            
        <?php
        }
        ?>    
        </table>
        <?php if($_GET['stranica']>1):?>
        <button onclick="location.href='?controller=kupac&akcija=pretraga&stranica=<?php echo $_GET['stranica']-1?>'" >Prethodna</button>
        <?php endif ?>
        <?php if((($_GET['stranica']-1)*10+ count($nekretnine))<count($_SESSION['nekretnine'])):?>
        <button onclick="location.href='?controller=kupac&akcija=pretraga&stranica=<?php echo $_GET['stranica']+1?>'" >Sledeca</button>
        <?php endif ?>
        <?php
        //print_r($_SESSION['nekretnine']);
        ?>
    </body>
</html>
