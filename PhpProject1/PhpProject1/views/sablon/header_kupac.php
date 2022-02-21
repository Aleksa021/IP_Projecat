<html>
    <head>
        <title>Nekretnine</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <a href='index.php?controller=kupac&akcija=oglasi' >Oglasi svoj oglas</a><a href='index.php?controller=kupac&akcija=logout' > LOGOUT</a>
        <?php echo $_SESSION['korisinik']->ime;?>
        </br>
        <?php echo $_SESSION['korisinik']->prezime;?>
        <hr></hr>
    </body>
</html>