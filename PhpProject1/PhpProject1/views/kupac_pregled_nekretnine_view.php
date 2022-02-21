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
        <h1> <?php echo $nekretnina->naziv?></h1>
        <h3> <?php echo ($nekretnina->grad." - ".$nekretnina->opstina." - ".$nekretnina->mikrolokacija." - ".$nekretnina->ulica);?></h3>
        
        <?php if($nekretnina->cena/$nekretnina->kvadratura>$prosek):?>
        <font color="red"> <?php echo $nekretnina->cena; ?> &euro;</font>
        <?php endif?>
        <?php if($nekretnina->cena/$nekretnina->kvadratura<=$prosek):?>
        <font color="green"> <?php echo $nekretnina->cena; ?> &euro;</font>
        <?php endif?>
    </body>
</html>
