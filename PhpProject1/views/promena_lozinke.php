<body>
    
    <form method="post" action="<?php echo '?controller='.$_SESSION['korisnik']->tip.'&akcija=promena_lozinke'?>" name='forma_promena_lozinke'onsubmit='return provera_promene_lozinke();'>
        <table>
            <tr>
                <td>
                    Stara lozinka
                </td>
                <td>
                    <input type="text" name="stara_lozinka">   
                </td>
            </tr>
            <tr>
                <td>
                    Nova lozinka
                </td>
                <td>
                    <input type="text" name="lozinka1">   
                </td>
            </tr>
            <tr>
                <td>
                    Potvrdi lozinku
                </td>
                <td>
                    <input type="text" name="lozinka2">   
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="dugme_lozinka" value="Promeni lozinku">
                </td>
            </tr>
        </table>
    </form>
    <font color='red'><?phpif(isset($greska))echo $greska;?>
    </font>
        <?php
        // put your code here
        ?>
</body>
