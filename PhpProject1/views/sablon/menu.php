<body>
    <input type="button" value="Pocetna " onclick="location.href='<?php echo$_SERVER['PHP_SELF'].'?controller='.$_SESSION['korisnik']->tip.'&akcija=index'?>'">
    <input type="button" value="Odjava" onclick="location.href='<?php echo$_SERVER['PHP_SELF'].'?controller='.$_SESSION['korisnik']->tip.'&akcija=logout'?>'">
    <?php if($_GET['akcija']!='promena_lozinke'):?>
    <input type="button" value="Promena lozinke" onclick="location.href='<?php echo$_SERVER['PHP_SELF'].'?controller='.$_SESSION['korisnik']->tip.'&akcija=promena_lozinke'?>'">
    <?php endif?>
    <?php if($_GET['controller']=='administrator'):?>
        <?php if($_GET['akcija']!='pretraga_korisnika'):?>
        <input type="button" value="Pretraga korisnika" onclick="location.href='<?php echo$_SERVER['PHP_SELF'].'?controller='.$_SESSION['korisnik']->tip.'&akcija=pretraga_korisnika'?>'">
        <?php endif?>
        <?php if($_GET['akcija']!='dodaj_korisnika'):?>
        <input type="button" value="Dodaj korisnika" onclick="location.href='<?php echo$_SERVER['PHP_SELF'].'?controller='.$_SESSION['korisnik']->tip.'&akcija=dodaj_korisnika'?>'">
        <?php endif?>
        <?php if($_GET['akcija']!='dodaj_agenciju'):?>
        <input type="button" value="Dodaj agenciju" onclick="location.href='<?php echo$_SERVER['PHP_SELF'].'?controller='.$_SESSION['korisnik']->tip.'&akcija=dodaj_agenciju'?>'">
        <?php endif?>
        <?php if($_GET['akcija']!='dodaj_mesta'):?>
        <input type="button" value="Dodaj mikrolokacije i ulice" onclick="location.href='<?php echo$_SERVER['PHP_SELF'].'?controller='.$_SESSION['korisnik']->tip.'&akcija=dodaj_mesta'?>'">
        <?php endif?>
    <?php endif?>
    <?php if($_GET['controller']=='oglasavac'):?>
        <?php if($_GET['akcija']!='dodaj_nekretninu'):?>
        <input type="button" value="Dodaj Nekretninu" onclick="location.href='<?php echo$_SERVER['PHP_SELF'].'?controller='.$_SESSION['korisnik']->tip.'&akcija=dodaj_nekretninu'?>'">
        <?php endif?>
        <?php if($_GET['akcija']!='izmeni_podatak'):?>
        <input type="button" value="Izmeni podatke" onclick="location.href='<?php echo$_SERVER['PHP_SELF'].'?controller='.$_SESSION['korisnik']->tip.'&akcija=izmeni_podatke'?>'">
        <?php endif?>
    <?php endif?>
    <hr>
</body>
<?php

