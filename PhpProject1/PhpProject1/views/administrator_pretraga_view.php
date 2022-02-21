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
        <form method='post' action=''>
            <table>
                <tr>
                    <td>
                        Korisnicko ime
                    </td>
                    <td>
                        <input type='text' name='korisnicko_ime'>
                    </td>
                    <td>
                        <input type='submit' name='dugme_pretraga' value='Pretraga'>
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if(isset($greska))
            echo "<font color=red>$greska</font>"
        ?>
        <?php
        if(isset($status))
            echo "<font color=green>$status</font>"
        ?>
    </body>
</html>
