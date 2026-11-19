<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Division (Teil 2)</title>
</head>
<body>
    <h2>
        Division zweier Zahlen: Das Ergebnis
    </h2>
    {if (isset($teilenDurchNullFehler))}
        Sie haben versucht durch Null zu teilen!
    {else}
        Der Quotient von {$zaehler} und {$nenner} ist: {$quotient}
    {/if}
</body>
</html>