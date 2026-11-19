<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Euro-Dollar Umrechnung Teil 2</title>
    <link rel="stylesheet" href="formular.css" type="text/css">
</head>
<body>
    {if (isset($PHP_SELF))}
        <form name='taschenrechner' action='{$PHP_SELF}' method='post'>
            <label for="i_ersterOperand">Erster Operand</label>
            <input type="number" name="ersterOperand" size=12 step="any"><br>
            <label for="i_operator">Operator</label>
            <input type="text" name="operator" id="i_operator" size=12><br>
            <label for="i_zweiterOperand">Zweiter Operand</label>
            <input type="number" name="zweiterOperand" id="i_zweiterOperand" size=12 step="any"><br>
            <input type="submit" name="Button1" value="Abschicken">
        </form>
    {else}
        {if (isset($teilenDurchNull))}
            Sie versuchen durch 0 zu teilen!
        {else}
            {if (isset($falscherOperator))}
                Der Operator wird nicht unterstützt!
            {else}
                Das Ergebnis beträgt: {$ergebnis}
            {/if}
        {/if}
    {/if}
</body>
</html>