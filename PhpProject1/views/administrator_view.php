<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>OVO VIDI ADMIN</h1>
        <table class="center">
            <tr>
                <th>
                    Ime
                </th>   
                <th>
                    Prezime
                </th>   
                <th>
                    Korisnicko ime
                </th>   
                <th>
                    Tip
                </th>   
                <th>
                    Agencija
                </th>   
                <th>
                    Broj licence
                </th>   
            </tr>
            <?php
            foreach ($korisnici as $korisnik) {
                ?>
            <form method='post' action=''>
                <tr>
                    <td>
                        <?php echo $korisnik->ime?>
                    </td>
                    <td>
                        <?php echo $korisnik->prezime?>
                    </td>
                    <td>
                        <?php echo $korisnik->korisnicko_ime?>
                    </td>
                    <td>
                        <?php echo $korisnik->tip?>
                    </td>
                    <td>
                        <?php echo $korisnik->agencija?>
                    </td>
                    <td>
                        <?php echo $korisnik->broj_licence?>
                    </td>
                    <td>
                        <input type="button" value="Odobri" onclick="location.href=
                        '<?php echo$_SERVER['PHP_SELF'].'?controller='.$_SESSION['korisnik']->tip.'&akcija=odobri&korisnicko_ime='.$korisnik->korisnicko_ime?>'">
                        <input type="button" value="Odbij" onclick="location.href=
                        '<?php echo$_SERVER['PHP_SELF'].'?controller='.$_SESSION['korisnik']->tip.'&akcija=odbij&korisnicko_ime='.$korisnik->korisnicko_ime?>'">
                    </td>
                </tr>
            </form>
                    <?php
            }
            ?>
        </table>
        <?php
        // put your code here
        ?>
    </body>
</html>
