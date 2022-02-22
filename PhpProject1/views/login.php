<form name='forma_login' method='post' action=<?php echo $_SERVER['PHP_SELF'];?>?controller=gost&akcija=login onsubmit="return provera_login()">
    <table class="center">
        <tr>
            <td>
                Korisnicko ime:
            </td>
            <td>
                <input type='text' name='korisnicko_ime' value="<?php if(isset($_SESSION['korisnicko_ime'])) echo $_SESSION['korisnicko_ime'];?>">
            </td>
        </tr>
        <tr>
            <td>
                Lozinka:
            </td>

            <td>
                <input type='password' name='lozinka'>
            </td>
        </tr>
        <tr>
            <td colspan='2'> <input type="submit" name="dugme_login" value='LOGIN'></td>
        </tr>
    </table>
    <font color='red'><?php if(isset($greska))echo $greska;?></font>
</form>
<hr></hr>

