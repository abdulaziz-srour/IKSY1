<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Euro-Dollar Umrechnung Teil 2</title>
    <link rel="stylesheet" href="formular.css" type="text/css">
</head>
<body>
    {if (isset($PHP_SELF))}
        <form name='euro' action='{$PHP_SELF}' method='post'>
            <label for="i_kurs">Kurs</label>
            <input type="number" name="kurs" id="i_kurs" size=12 step="any"><br>
            <label for="i_zielwaehrung">Zielwährung</label>
            <input type="text" name="zielwaehrung" id="i_zielwaehrung" lsize=12><br>
            <label for="i_betrag">Betrag</label>
            <input type="number" name="betrag" id="i_betrag" lsize=12 step="0.01"><br>
            <input type="submit" name="Button1" value="Abschicken">
        </form>
    {else}
        {if (isset($waehrungFehler))}
            Sie haben eine falsche Währung eingegeben!
        {else}
            Der Eingabebetrag {$betrag} entspricht {$umrechnungsBetrag} {$zielwaehrung}.
        {/if}
    {/if}
</body>
</html>