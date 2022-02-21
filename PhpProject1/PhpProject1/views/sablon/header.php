<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="provera11.js"></script>
    <script src="update.js"></script>

</head>

<body>
    <h1 align="center">Nekretnine</h1>
    Ulogovan kao:
    <?php if($_SESSION['korisnik']) echo $_SESSION['korisnik']->ime." ". $_SESSION['korisnik']->prezime;?>
    </br>
    <?php
    // put your code here
    ?>
    <hr>
</body>
