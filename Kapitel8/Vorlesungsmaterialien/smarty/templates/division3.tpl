<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- division3.tpl -->
    <title>Division</title>
    <link rel="stylesheet" href="formular.css" type="text/css">
</head>
<body>
    <h2>Division zweier Zahlen</h2>
    {if (isset($PHP_SELF))}
        <form name='division' action='{$PHP_SELF}' method='post'>
            <label for="i_zaehler">Zähler</label>
            <input type="number" name="zaehler" id="i_zaehler" size=12><br>
            <label for="i_nenner">Nenner</label>
            <input type="number" name="nenner" size=12><br>
            <input type="submit" name="Button1" value="Abschicken">
        </form>
    {else}
        {if (isset($teilenDurchNullFehler))}
            Sie haben versucht durch Null zu teilen!
        {else}
            Der Quotient von {$zaehler} und {$nenner} ist: {$quotient}
        {/if}
    {/if}
</body>
</html>