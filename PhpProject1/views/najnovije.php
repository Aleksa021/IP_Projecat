<?php require_once 'models/Slika.php'; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php if(empty($nekretnine)):?>
    <h1>Trenutno ne postoje oglasi</h1>
    <?php endif?>
    <?php if(!empty($nekretnine)):?>
    <table class="center">
            <tr>
                <th>
                    Naziv oglasa
                </th>
                <th>
                    Slika
                </th>
                <th>
                    Cena
                </th>
            </tr>
        <?php
        foreach ($nekretnine as $nekretnina){
        ?>
            <tr height="20%">
            <form method="post" action="">
                <td>
                    <?php echo $nekretnina->naziv?>
                </td>
                <td>
                    <?php 
                    $slike= Slika_model::dohvati_slike($nekretnina->id_nekretnina);
                    if($slike===false)
                        $slike=array();
                    if(!empty($slike)){
                        echo "<img src='"."slike\\".$slike[0]->putanja."'>";
                    }
                    ?>
                </td>
                <td>
                    <?php echo number_format($nekretnina->cena,2)?>
                </td>
            </form>
            </tr>    
            
        <?php
        }
        ?>    
        </table>
    <?php endif?>
    <hr>
    </body>
</html>
