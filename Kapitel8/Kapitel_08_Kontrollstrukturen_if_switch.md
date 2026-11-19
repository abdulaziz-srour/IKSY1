# Kapitel 8: Kontrollstrukturen – if, elseif, switch

Skript `phpScript.pdf`, Seiten 67–84 · Beispiele: `Vorlesungen/8` · Aufgaben 8.1 und 8.4 (8.2/8.3 entfallen, JavaScript) + 8.5 und 8.6 klausurnah

So gehst du vor: Erst die Vorbereitung, dann Teil A bis F lesen und die „Selbst ausprobieren“-Schritte machen. Danach löst du in Teil G die Aufgaben.

**Warum dieses Kapitel wichtig ist:** Hier lernst du das **Gerüst jeder Klausurlösung**. Die Musterlösung von Probeklausur 2 ist im Kern genau das, was in Kapitel 8 steht:

```php
$PHP_SELF = $_SERVER ['PHP_SELF'];
$REQUEST_METHOD = $_SERVER ['REQUEST_METHOD'];
...
if (! ($REQUEST_METHOD == "POST"))
{
    $smarty->assign ( 'PHP_SELF', $PHP_SELF );          // erster Aufruf: Formular zeigen
}
else
{
    ...                                                  // abgeschickt: prüfen
    if (! $correct)
    {
        $smarty->assign ( 'fehler', true );              // Fehler an das Template melden
    }
    else
    {
        ...                                              // rechnen, Ergebnis übergeben
    }
}
$smarty->display ( 'loesung.tpl' );
```

und im Template:

```smarty
{if (isset($PHP_SELF))}
    <form ... action="{$PHP_SELF}" method="post"> ... </form>
{else}
    {if (isset($fehler))}
        Unzulässige Eingabe.
    {else}
        {$ausgabeText}
    {/if}
{/if}
```

Eine Datei `loesung.php`, ein Template `loesung.tpl`, drei Zustände: **Formular**, **Fehler**, **Ergebnis**. Wenn du das nach diesem Kapitel blind hinschreiben kannst, hast du das Grundgerüst für die Klausur. Dazu kommt Tipp 7 des Dozenten: **„Plausibilitätsprüfung doppelt: im Template (HTML5) und serverseitig in PHP“**. Die serverseitige Hälfte geht erst mit `if`, also ab jetzt.

---

## Vorbereitung

1. Lege in Eclipse im Projekt `IKSY1` den Ordner `Kapitel8/` an, darin `Vorlesungsmaterialien/` und `Loesungen/`.
2. Kopiere aus `Vorlesungen/8/` nach `Kapitel8/Vorlesungsmaterialien/`:
   - `composer.json`
   - alle `.php`-Dateien (`division1.php` … `taschenrechner3.php`, `euro2.php`)
   - die Formulare `division1Php.html`, `division2Php.html`, `division2_1Php.html`
   - den Ordner `includes/` (mit `startTemplate.inc.php`)
   - den Ordner `smarty/templates/` (6 Templates)

   **Nicht** kopieren: `division1.html` und `division2.html` (reines JavaScript, nicht klausurrelevant), den alten Ordner `klassen/` und den Inhalt von `smarty/templates_c/`. Lege stattdessen einen **leeren** Ordner `smarty/templates_c/` an.
   Dazu `formular.css` aus `Kapitel7/Vorlesungsmaterialien/`.
3. Im Terminal:
   ```bash
   cd ~/eclipse-workspace/IKSY1/Kapitel8/Vorlesungsmaterialien
   composer install
   chmod 777 smarty/templates_c
   sed -i 's#\.\./css/formular\.css#formular.css#' *.html smarty/templates/*.tpl
   ```
   Die letzte Zeile ändert in allen Formularen und Templates `href="../css/formular.css"` auf `href="formular.css"` (wie in Kapitel 7, nur alles auf einmal).
4. In `includes/startTemplate.inc.php` die Zeile mit `$ROOT_DIR` ändern auf
   ```php
   $ROOT_DIR='/var/www/html/iks/Kapitel8/Vorlesungsmaterialien';
   ```
   (Im Original steht `/var/www/html/iksy05/Vorlesungen/8`.)
5. In Eclipse `Kapitel8` markieren, **F5**.
6. Test: `http://localhost/iks/Kapitel8/Vorlesungsmaterialien/division3.php` zeigt ein Formular „Division zweier Zahlen“.

Fehler und Ungenauigkeiten im Skript und in den Original-Dateien:

| Wo | Was nicht stimmt |
|---|---|
| Skript S. 69 | „Anstelle dessen wird eine **Warnmeldung** ausgegeben“: Das war PHP 7. In PHP 8 bricht das Script mit `Fatal error: Uncaught DivisionByZeroError: Division by zero` ab. Die Seite ist danach leer bis auf die Meldung. |
| Skript S. 74 | „Der Wert von `$REQUEST_METHOD` ist get oder post“: In Wirklichkeit **`GET`** bzw. **`POST`**, groß geschrieben. Vergleichst du mit `"post"`, klappt nichts (Teil C). |
| Skript S. 76 | Zitiert die Zeile `echo "<form name='division' action='$PHP_SELF' …>";`. Das ist ein Überbleibsel aus einer Version ohne Smarty. Bei uns steht das Formular im Template. |
| `division1Php.html`, `division2Php.html`, Beispiel 8.2/8.6 | `id="i_nenner"` steht am **Absende-Button** statt am Nenner-Feld. Das `label for="i_nenner"` zeigt damit auf den Button. (In `division2_1Php.html` ist es richtig.) |
| `taschenrechner2.php`, `taschenrechner3.php`, Beispiel 8.16/8.18 | Hinter `?>` stehen noch `</body>` und `</html>`. Die werden **zusätzlich** zum Template ausgegeben, Strg+U zeigt das Seitenende doppelt. Lösch die beiden Zeilen. |
| `euro2.tpl` | `lsize=12` (Tippfehler für `size`), ohne Wirkung. |
| `taschenrechner.tpl`, `taschenrechner2.tpl` | Titel „Euro-Dollar Umrechnung Teil 2“ (kopiert), erstes Feld ohne `id`. Kein einziges Formular hat `required`. In deinen Lösungen machst du es besser. |
| `division1.php` | `display('division2.tpl');;` doppeltes Semikolon, harmlos. |
| `Uebung/UebungDebug` | Der Ordner ist **leer**. Das Debuggen üben wir stattdessen mit Xdebug an den Taschenrechnern (Teil E). |
| `Uebung/Loesungen/aufgabe8_4.php` | Die Musterlösung rechnet **falsch**: Zinssätze als Prozent (`4`, `4.5`, `5`), Tilgung als Faktor (`0.01`), dann `($zinssatz+TILGUNG)`. Das ergibt das ~70-Fache der richtigen Belastung. Erst nach deinem eigenen Versuch anschauen, und dann nicht wundern. |

---

## Teil A: if und else (S. 67–72)

### A.1 Das Problem

Bisher lief jedes Script stur von oben nach unten. `division1.php` teilt einfach:

```php
$quotient=$zaehler/$nenner;
```

Gibt jemand als Nenner `0` ein, bricht PHP ab.

### A.2 Die Syntax

```php
if ($nenner==0)
{
    $quotient="Versuch durch Null zu teilen!";
}
else
{
    $quotient=$zaehler/$nenner;
}
```

| Regel | Was passiert sonst |
|---|---|
| Bedingung in **runden Klammern**, Vergleich mit **`==`** | `if ($nenner=0)` ist eine **Zuweisung**: `$nenner` wird 0, die Bedingung ist immer falsch (Selbst ausprobieren 3) |
| **Kein `;`** hinter `if (...)` | `if ($nenner==0);` ist ein leeres if. Der Block `{...}` danach läuft **immer** |
| `else` ist optional | ohne `else`: „sonst tu nichts“ (einseitige Auswahl) |
| **Immer** geschweifte Klammern, auch bei einer Zeile | Wer später eine zweite Zeile ergänzt, hat sie sonst außerhalb des if |
| Einrücken | ohne Einrückung sind verschachtelte ifs nicht lesbar (Teil E) |

Die Bedingung ist ein **logischer Ausdruck** aus Kapitel 6: Vergleiche (`==`, `!=`, `<`, `<=`, `>`, `>=`) und Verknüpfungen (`&&`, `||`, `!`).

> **Selbst ausprobieren (5 Minuten):** Formular `http://localhost/iks/Kapitel8/Vorlesungsmaterialien/division1Php.html`
> 1. Zähler 10, Nenner 0 → `Fatal error: Uncaught DivisionByZeroError`. Das ist der Absturz aus A.1.
> 2. Dasselbe mit `division2Php.html` → „Der Quotient von 10 und 0 ist: Versuch durch Null zu teilen!“. Kein Absturz, aber ein komischer Satz (Teil B repariert das).
> 3. In `division2.php` aus `==` ein `=` machen: `if ($nenner=0)`. Jetzt stürzt **jede** Division ab, auch 10 durch 5. Grund: `$nenner` wird auf 0 gesetzt, die Bedingung ist 0, also falsch, und im `else` wird durch die neue 0 geteilt. Zurückändern.
> 4. In `division2.php` hinter `if ($nenner==0)` ein `;` setzen. Jetzt kommt bei 10 durch 5 „Versuch durch Null zu teilen!“. Zurückändern.
> 5. **Nenner leer lassen** und abschicken (`division2Php.html` hat kein `required`): `Fatal error: Uncaught TypeError: Unsupported operand types: string / string`. Ein leeres Feld kommt als leerer String `""` an, und in PHP 8 ist `"" == 0` **falsch**. Das if schützt also nicht. Gegen leere Felder hilft `required` im Formular, und serverseitig die Prüfung aus Teil F.

---

## Teil B: if in Smarty, isset (S. 73–74)

In `division2.php` hat das Template immer denselben Satz ausgegeben, egal was passiert ist. Besser: **Die PHP-Datei stellt nur fest, was passiert ist, das Template entscheidet, was angezeigt wird.** (`division2_1.php` + `division2_1.tpl`)

```php
if ($nenner==0) {
    $teilenDurchNullFehler=true;
    $smarty->assign('teilenDurchNullFehler', $teilenDurchNullFehler);
}
else {
    $quotient=$zaehler/$nenner;
    $smarty->assign('zaehler', $zaehler);
    ...
}
```

```smarty
{if (isset($teilenDurchNullFehler))}
    Sie haben versucht durch Null zu teilen!
{else}
    Der Quotient von {$zaehler} und {$nenner} ist: {$quotient}
{/if}
```

- `isset($x)` fragt: **Wurde diese Variable überhaupt übergeben?** Der Wert (`true`) ist dabei egal. Im Fehlerfall wird nur `teilenDurchNullFehler` übergeben, sonst nur das Ergebnis.
- Ein solches `true`, das nur „es ist etwas passiert“ meldet, heißt **Fehlervariable** oder Flag. In der Klausur heißt es meistens schlicht `fehler`.
- `isset` gibt es genauso in PHP: `isset($_POST['bindung'])` (Teil F.2).

Smarty-Syntax:

| Smarty | Bedeutung |
|---|---|
| `{if (Bedingung)}` … `{/if}` | Leerzeichen nach `if`, Abschluss mit `{/if}` |
| `{else}` | optional |
| `{elseif (Bedingung)}` | Mehrfachauswahl (Teil E), in Smarty auch `{else if …}` |
| `{if $quote < 30}`, `{if $format == "A4"}` | Vergleiche wie in PHP; die runden Klammern sind erlaubt, aber nicht nötig |

Smarty kennt **kein `switch`**. Im Template nimmst du immer `{if}/{elseif}`.

> **Selbst ausprobieren (3 Minuten)** in `division2_1.tpl`, jeweils danach zurück:
> 1. Leerzeichen weg: `{if(isset($teilenDurchNullFehler))}` → `Smarty\CompilerException: Syntax error in template "file:division2_1.tpl"`.
> 2. `{/if}` löschen → `Syntax error … unclosed {else} tag`. Die Zeilennummer in der Meldung zeigt auf das **Ende** der Datei, der Fehler steckt aber dort, wo das `{/if}` fehlt.
> 3. In `division2_1.php` den Namen im `assign` ändern (`'teilenDurchNull'`) → bei Nenner 0 kommt „Der Quotient von und ist:“ ohne jede Fehlermeldung. Smarty sagt nichts zu Variablen, die es nicht gibt. Namen in `assign` und `isset` Buchstabe für Buchstabe vergleichen.

---

## Teil C: GET und POST, alles in einer Datei (S. 74–76)

Bisher brauchtest du zwei Dateien: ein `.html`-Formular und eine `.php`-Auswertung. Mit `if` geht es in **einer** Datei. Das ist der Aufbau aller Probeklausuren.

Der Trick: Der Browser sagt bei jeder Anfrage, **wie** er fragt.

| Aufruf | `$_SERVER['REQUEST_METHOD']` |
|---|---|
| Adresse eintippen, Link klicken, F5 | `GET` |
| Formular mit `method="post"` abschicken | `POST` |

`$_SERVER['PHP_SELF']` ist der Pfad der Seite selbst, z. B. `/iks/Kapitel8/Vorlesungsmaterialien/division3.php`. Den trägt das Template als `action` ein, damit das Formular **an dieselbe Seite** geschickt wird.

```
1. Aufruf (GET)                            2. Aufruf (POST, nach "Abschicken")
division3.php                              division3.php
  REQUEST_METHOD != "POST" → wahr            REQUEST_METHOD != "POST" → falsch
  assign('PHP_SELF', …)                      else: $_POST lesen, prüfen, rechnen
  display('division3.tpl')                   assign(Ergebnis ODER Fehler)
                                             display('division3.tpl')
division3.tpl                              division3.tpl
  isset($PHP_SELF) → Formular                isset($PHP_SELF) → falsch
                                             → Fehlermeldung oder Ergebnis
```

`isset($PHP_SELF)` im Template bedeutet also „Formular zeigen“. `PHP_SELF` wird **nur** beim ersten Aufruf übergeben.

Ein Detail, das die Musterlösungen verschieden schreiben, beides ist gleichwertig:

```php
if ($REQUEST_METHOD!="POST")          // Skript
if (! ($REQUEST_METHOD == "POST"))    // Probeklausur 2
```

> **Selbst ausprobieren (5 Minuten):** `http://localhost/iks/Kapitel8/Vorlesungsmaterialien/division3.php`
> 1. Strg+U: Im Formular steht `action='/iks/Kapitel8/Vorlesungsmaterialien/division3.php'`. Das ist `{$PHP_SELF}`.
> 2. 10 durch 4 abschicken, dann **F5** auf der Ergebnisseite: Der Browser fragt, ob er die Daten erneut senden soll. Das ist ein POST. Klick dagegen in die Adresszeile und Enter: Das ist ein GET, das Formular kommt wieder.
> 3. In `division3.php` `"POST"` klein schreiben: `!="post"`. Jetzt kommt nach dem Abschicken **immer wieder das Formular**, weil `"POST" != "post"` wahr ist. Zurückändern.
> 4. Ruf `division2.php` (die Zwei-Dateien-Version) direkt in der Adresszeile auf, ohne Formular: `Warning: Undefined array key "zaehler"`. Mit dem Ein-Datei-Aufbau kann das nicht passieren, weil `$_POST` nur im POST-Zweig gelesen wird.

---

## Teil D: Euro-Dollar mit Zielwährung, `||` und `exit()` (S. 76–78)

`euro2.php` rechnet je nach eingegebener Zielwährung in die eine oder andere Richtung:

```php
if (($zielwaehrung=="Dollar") || ($zielwaehrung=="dollar"))
{
    $umrechnungsBetrag=$kurs*$betrag;
}
else
{
    if (($zielwaehrung=="euro") || ($zielwaehrung=="Euro"))
    {
        $umrechnungsBetrag=(1/$kurs)*$betrag;
    }
    else
    {
        $waehrungFehler=true;
        $smarty->assign('waehrungFehler', $waehrungFehler);
        $smarty->display('euro2.tpl');
        exit();
    }
}
```

Neu sind zwei Dinge:

- **`||` (oder)** verbindet zwei Vergleiche. Jeder Vergleich steht vollständig da: `$zielwaehrung=="Dollar" || "dollar"` wäre falsch (der String `"dollar"` allein ist immer „wahr“).
- **`exit()`** beendet das Script sofort. Deshalb muss **vorher** `display` kommen, sonst sieht der Benutzer nichts.

**Für die Klausur:** Die Musterlösungen kommen **ohne** `exit()` aus. Sie setzen `fehler` und packen die Rechnung in den `else`-Zweig, sodass am Ende genau **ein** `display` steht (siehe Einleitung). Das ist übersichtlicher, und du vergisst kein `display`. `exit()` brauchst du erst wieder in Kapitel 10 nach der PDF-Ausgabe (`$pdf->Output(); exit();`).

> **Selbst ausprobieren (3 Minuten):** `http://localhost/iks/Kapitel8/Vorlesungsmaterialien/euro2.php`
> 1. Kurs 1.08, Zielwährung `Dollar`, Betrag 250 → 270. Dann `Euro` → 231.48148148148.
> 2. `DOLLAR` → „Sie haben eine falsche Währung eingegeben!“. Freitext ist fehleranfällig. In der Klausur nimmst du eine Auswahlliste (Teil F.3).
> 3. Kurs **0**, Zielwährung `Euro` → `DivisionByZeroError` in `(1/$kurs)`. Die Prüfung auf die Währung schützt nicht vor einem unsinnigen Kurs. Deshalb prüft man **alle** Eingaben, bevor man rechnet (Teil F.1).
> 4. In `euro2.php` die Zeile `$smarty->display('euro2.tpl');` vor dem `exit()` auskommentieren → bei falscher Währung kommt eine **weiße Seite**.

---

## Teil E: Mehrfachauswahl, elseif und switch (S. 78–84)

### E.1 Verschachtelt (taschenrechner.php)

Der Taschenrechner unterscheidet fünf Fälle (`+`, `-`, `*`, `/`, falscher Operator). Mit `if/else` allein wird das eine Treppe aus fünf Ebenen, die mit `}//schliesst else zu if +` endet. Schau es dir einmal an und vergiss es.

### E.2 if – elseif – else (taschenrechner2.php)

```php
if ($operator=="+")
{
    $ergebnis=$ersterOperand+$zweiterOperand;
}
elseif ($operator=="-")
{
    $ergebnis=$ersterOperand-$zweiterOperand;
}
elseif (...)
{
    ...
}
else
{
    $falscherOperator=true;
    ...
}
```

PHP prüft die Bedingungen **von oben nach unten** und führt **nur den ersten** Zweig aus, dessen Bedingung stimmt. Danach geht es hinter dem ganzen Block weiter. Das ist genau das, was du für **Staffeln** brauchst (Aufgabe 8.4): Die strengste Grenze kommt zuerst.

```php
if ($quote >= 60)       { ... }    // 75 % landet hier und NUR hier
elseif ($quote >= 50)   { ... }    // erreicht nur, wenn < 60
elseif ($quote >= 30)   { ... }    // erreicht nur, wenn < 50
else                    { ... }    // < 30
```

Dreh die Reihenfolge um (`>= 30` zuerst), dann landen 75 % schon im ersten Zweig. Das ist der häufigste Staffel-Fehler.

PHP versteht `elseif` und `else if`. Im Template heißt es `{elseif …}`.

### E.3 switch (taschenrechner3.php)

```php
switch ($operator)
{
    case "+":
        $ergebnis=$ersterOperand+$zweiterOperand;
        break;
    case "-":
        $ergebnis=$ersterOperand-$zweiterOperand;
        break;
    ...
    default:
        $falscherOperator=true;
        ...
}
```

| Regel | |
|---|---|
| Hinter `case "+"` ein **Doppelpunkt** | |
| Am Ende jedes Falls **`break;`** | ohne `break` läuft PHP in den nächsten `case` weiter |
| `default:` | wenn kein `case` passt (wie das letzte `else`) |
| Marken sind **feste Werte** | `case $grenze:` oder `case >= 60:` geht nicht |

**Wann was?** `switch`, wenn **eine** Variable mit **festen Werten** verglichen wird (Operator, Papierformat, Teamgröße „klein/mittel/groß“). `if/elseif`, sobald `<`, `>=`, `&&` oder mehrere Variablen im Spiel sind (Staffeln, Grenzen). Jeder `switch` lässt sich als `elseif` schreiben, umgekehrt nicht.

> **Selbst ausprobieren (10 Minuten):** `http://localhost/iks/Kapitel8/Vorlesungsmaterialien/taschenrechner3.php`
> 1. Vorher in `taschenrechner2.php` und `taschenrechner3.php` die beiden Zeilen `</body>` und `</html>` hinter `?>` löschen und mit Strg+U prüfen, dass das Seitenende nur noch einmal da ist.
> 2. 5 `+` 3 → 8. Dann in `taschenrechner3.php` das `break;` hinter dem `+`-Fall löschen: 5 `+` 3 ergibt jetzt **2**. PHP rechnet erst `+`, läuft dann ohne `break` in den `-`-Fall und überschreibt das Ergebnis. Zurückändern.
> 3. Operator `x` → „Der Operator wird nicht unterstützt!“ (default-Zweig). 5 `/` 0 → „Sie versuchen durch 0 zu teilen!“.
> 4. **Xdebug** (Ablauf wie in `Einrichtung_Linux_Mint.md`, Schritt 4): Haltepunkt auf die Zeile `switch ($operator)` setzen, einmal `taschenrechner3.php?XDEBUG_SESSION_START=ECLIPSE` aufrufen, dann im normalen Formular 7 `*` 6 abschicken. Mit **F6** Zeile für Zeile weiter: Eclipse springt direkt zu `case "*":` und nach `break;` hinter den `switch`. In **Variables** siehst du `$operator` und `$ergebnis`. Danach `?XDEBUG_SESSION_STOP`. Das ist der schnellste Weg herauszufinden, **welcher Zweig** wirklich läuft, wenn eine Staffel falsche Werte liefert.

---

## Teil F: Was die Klausur zusätzlich braucht

Das Skript fängt in Kapitel 8 nur Division durch 0 ab („Wir fangen ja noch keinerlei Eingabefehler ab“, Fußnote S. 78). Die Klausur verlangt mehr. Diese drei Bausteine nutzt jede Probeklausur, und alle gehen mit dem, was du jetzt kannst.

### F.1 Serverseitige Plausibilitätsprüfung

HTML5 (`required`, `min`, `max`) prüft nur im Browser. Wer das Formular manipuliert, schickt trotzdem alles. Deshalb prüft `loesung.php` **jede Eingabe noch einmal**, bevor gerechnet wird, mit **denselben Konstanten** wie im Formular:

```php
define("MIN_ANZAHL", 1);
define("MAX_ANZAHL_SEITEN", 500);
...
$anzahlSeiten = $_POST['anzahlSeiten'];

$eingabeKorrekt = is_numeric($anzahlSeiten);
$eingabeKorrekt = $eingabeKorrekt && $anzahlSeiten >= MIN_ANZAHL && $anzahlSeiten <= MAX_ANZAHL_SEITEN;
$eingabeKorrekt = $eingabeKorrekt && ...;                // nächste Eingabe

if (! $eingabeKorrekt)
{
    $smarty->assign('fehler', true);
}
else
{
    ... rechnen und assign ...
}
```

- `is_numeric($x)` ist `true` für `"12"`, `"12.5"`, `"-3"`, und `false` für `""`, `"abc"`, `"12,5"`. Damit fängst du das leere Feld aus Teil A (Selbst ausprobieren 5) ab.
- Die Zeilen `$eingabeKorrekt = $eingabeKorrekt && …` sammeln alle Prüfungen in einer Variablen. Genau so macht es Probeklausur 2 (`$correct = $correct && Sicherheit::…`). In Kapitel 13 wandern die Prüfungen in die Klasse `Sicherheit`, das Muster bleibt.
- Fachliche Regeln gehören auch dazu, z. B. „Eigenkapital nicht größer als der Kaufpreis“.

**So testest du die serverseitige Prüfung:** Schreib vorübergehend `novalidate` in das `<form>`-Tag im Template (`<form … method="post" novalidate>`). Dann schaltet der Browser die HTML5-Prüfung ab und schickt auch leere Felder, `0` oder `99999`. Deine Seite muss dann „Unzulässige Eingabe“ zeigen, nicht abstürzen. Danach `novalidate` wieder löschen.

### F.2 Checkboxen mit isset

Eine **nicht angehakte** Checkbox wird gar nicht mitgeschickt. `$_POST['bindung']` gibt dann `Warning: Undefined array key`. Deshalb immer:

```php
$bindungGewuenscht = isset($_POST['bindung']);     // true oder false
...
if ($bindungGewuenscht)
{
    $kostenBindung = PREIS_BINDUNG_PRO_EXEMPLAR * $anzahlExemplare;
}
else
{
    $kostenBindung = 0;
}
```

(Probeklausur 2: `$lastenaufzug = isset ( $_POST ['lastenaufzug'] );`)

### F.3 Auswahlliste statt Freitext, geprüft mit switch

Statt „Dollar oder dollar“ per Text eintippen zu lassen, gibst du feste Werte vor:

```html
<label for="i_format">Papierformat</label>
<select name="format" id="i_format" required>
    <option value="A4">A4</option>
    <option value="A3">A3</option>
</select>
```

Serverseitig gehört trotzdem ein `default` dazu, denn jemand kann `<option value="A5">` ins Formular schmuggeln (F12 → Inspektor → Wert ändern):

```php
switch ($format)
{
    case "A4":
        $preisProSeite = PREIS_PRO_SEITE_A4;
        break;
    case "A3":
        $preisProSeite = PREIS_PRO_SEITE_A3;
        break;
    default:
        $eingabeKorrekt = false;
}
```

### F.4 Ablehnung ist kein Eingabefehler

In Aufgabe 8.1 gibt es zwei verschiedene „Nein“:

| Fall | Beispiel | Flag | Meldung |
|---|---|---|---|
| Eingabe unzulässig | Feld leer, negativ, Eigenkapital > Preis | `fehler` | „Unzulässige Eingabe.“ |
| Eingabe gültig, fachlich abgelehnt | Eigenkapitalquote 20 % | eigenes Flag, z. B. `eigenkapitalquoteZuGering` | „Die Bank finanziert … nicht.“ |

Im Template wird das ein `{if}/{elseif}/{else}` mit drei Ausgaben im `{else}`-Teil von `isset($PHP_SELF)`.

---

## Teil G: Aufgaben

Alle Lösungen in `~/eclipse-workspace/IKSY1/Kapitel8/Loesungen/`, jede Aufgabe in einem eigenen Ordner wie in Kapitel 7, **ab jetzt im Klausur-Aufbau**: eine `loesung.php`, ein Template `smarty/templates/loesung.tpl`, keine `.html`-Datei mehr. Kommentare sind keine Pflicht. Bewertet wird wie in der Klausur: Konstanten (auch für die Grenzen im Formular), sprechende Namen, HTML5-Validierung **und** serverseitige Prüfung, gültiges HTML, richtige Ausgabe, kein `echo` in der PHP-Datei.

Neuen Aufgabenordner einrichten (am Beispiel 8.1):

```bash
cd ~/eclipse-workspace/IKSY1/Kapitel8/Loesungen
mkdir -p Aufgabe8_1/includes Aufgabe8_1/smarty/templates Aufgabe8_1/smarty/templates_c
cp ../../Kapitel7/Loesungen/Aufgabe7_1/{composer.json,composer.lock,formular.css} Aufgabe8_1/
cp ../../Kapitel7/Loesungen/Aufgabe7_1/includes/startTemplate.inc.php Aufgabe8_1/includes/
cd Aufgabe8_1
composer install
chmod 777 smarty/templates_c
```

Dann in `includes/startTemplate.inc.php` den `$ROOT_DIR` auf `/var/www/html/iks/Kapitel8/Loesungen/Aufgabe8_1` setzen. Aufruf: `http://localhost/iks/Kapitel8/Loesungen/Aufgabe8_1/loesung.php`

### Aufgabe 8.1 (Skript): Darlehen mit Mindest-Eigenkapitalquote

> Sie sollen für eine Bank die Errechnung von Darlehenskonditionen für Kunden der Bank über das Internet ermöglichen. Eingegeben werden soll das Eigenkapital und der Preis der Immobilie, die gekauft werden soll. Der Zinssatz ist 5 %, die Tilgung 1 %. Das Programm soll die monatliche Belastung ausgeben. Wenn die Eigenkapitalquote des Kunden kleiner als 30 % ist, soll keine Berechnung durchgeführt werden und anstelle dessen ausgegeben werden, dass die Bank Immobilienerwerb mit einer so geringen Eigenkapitalquote nicht finanziert.

Fachlich: **Eigenkapitalquote = Eigenkapital ÷ Immobilienpreis × 100.** Ab genau 30 % wird finanziert. Rechnung sonst wie 7.1: Darlehensbetrag = Preis − Eigenkapital, monatliche Belastung = Darlehensbetrag × (Zinssatz + Tilgung) ÷ 100 ÷ 12.

Ausgangspunkt ist deine 7.1, umgebaut auf eine Datei:

- `loesung.php`: oben alle Konstanten (Zinssatz, Tilgung, Mindestquote, Monate, kleinster Immobilienpreis). GET-Zweig: `PHP_SELF` und die Formulargrenzen übergeben. POST-Zweig: lesen, **serverseitig prüfen** (F.1: beide numerisch, Preis mindestens die Untergrenze, Eigenkapital nicht negativ und nicht größer als der Preis), dann Quote berechnen und entweder ablehnen (F.4) oder rechnen. Am Ende **ein** `display`.
- `smarty/templates/loesung.tpl`: gültiges HTML5. Formular mit `action="{$PHP_SELF}"`, beide Felder `required`, `type="number"`, `min` aus Konstanten, `step="0.01"`, `label for`. Danach drei Ausgaben: Fehler, Ablehnung (mit der Quote des Kunden und der Mindestquote, beide aus Variablen), Ergebnistabelle wie in 7.1 plus Zeile „Eigenkapitalquote“. Unter allen drei Ausgaben ein Link `<a href="loesung.php">Neue Berechnung</a>`. Ein Link-Klick ist ein GET, also kommt wieder das Formular. (Übergib `PHP_SELF` dafür **nicht** im POST-Zweig, sonst zeigt das Template statt des Ergebnisses wieder das Formular.)

Testwerte:

| Immobilienpreis | Eigenkapital | Quote | Ausgabe |
|---|---|---|---|
| 300000 | 90000 | 30,00 % | Darlehen 210.000,00 €, **1.050,00 €** |
| 250000 | 100000 | 40,00 % | Darlehen 150.000,00 €, **750,00 €** |
| 300000 | 60000 | 20,00 % | **Ablehnung** |
| 300000 | 89999.99 | 29,99999… % | **Ablehnung**, obwohl die Quote mit 2 Nachkommastellen als „30,00 %“ angezeigt wird. Verglichen wird der ungerundete Wert, und das ist richtig so. Nicht vor dem Vergleich runden. |
| 200000 | 250000 | – | **Unzulässige Eingabe** |
| leer (mit `novalidate`) | 50000 | – | **Unzulässige Eingabe**, kein Absturz |
| 0 (mit `novalidate`) | 0 | – | **Unzulässige Eingabe**, kein `DivisionByZeroError` |

Gegenprobe: Mindestquote-Konstante auf 20 setzen → 300000/60000 wird jetzt finanziert (1.200,00 €), und die Ablehnungsmeldung bei 300000/50000 nennt „20 %“. Ohne Änderung am Template. Danach zurück auf 30.

### Aufgaben 8.2 und 8.3 (Skript): entfallen

Taschenrechner in JavaScript. JavaScript ist laut Dozent nicht klausurrelevant. Den Taschenrechner in PHP hast du in Teil E schon ausprobiert, den `switch` übst du in 8.5.

### Aufgabe 8.4 (Skript): Zinssatz nach Eigenkapitalquote

> Sie sollen für eine Bank die Errechnung von Darlehenskonditionen für Kunden der Bank über das Internet ermöglichen. Eingegeben werden soll das Eigenkapital und der Preis der Immobilie, die gekauft werden soll. Bei einer Eigenkapitalquote von 60 % ist der Zinssatz 4 %, bei 50 % Eigenkapitalquote 4,5 %, ansonsten 5 %, die Tilgung beträgt immer 1 %. Das Programm soll die monatliche Belastung ausgeben. Wenn die Eigenkapitalquote des Kunden kleiner als 30 % ist, soll keine Berechnung durchgeführt werden und anstelle dessen ausgegeben werden, dass die Bank Immobilienerwerb mit einer so geringen Eigenkapitalquote nicht finanziert.

„Bei 60 %“ heißt **ab 60 %**, „bei 50 %“ heißt **ab 50 % und unter 60 %**. Ordner `Aufgabe8_4/`, Aufbau wie 8.1 (kopier deine 8.1 und vergiss den `$ROOT_DIR` nicht).

- Staffel mit `if/elseif/else` (E.2). Für **jede** Grenze und **jeden** Zinssatz eine Konstante, auch die 30 %, die du aus 8.1 schon hast.
- Die Ergebnistabelle zeigt zusätzlich den **angewendeten Zinssatz** (z. B. „4,5 %“).
- Achte darauf, dass Zinssatz und Tilgung in **derselben Einheit** gerechnet werden (beide in Prozent oder beide als Faktor). Die Musterlösung macht hier einen Fehler (siehe Tabelle oben).

Testwerte (Immobilienpreis immer 300000, außer letzte Zeile):

| Eigenkapital | Quote | Zinssatz | Darlehensbetrag | monatliche Belastung |
|---|---|---|---|---|
| 180000 | 60,00 % | 4 % | 120.000,00 € | **500,00 €** |
| 179970 | 59,99 % | 4,5 % | 120.030,00 € | **550,14 €** |
| 150000 | 50,00 % | 4,5 % | 150.000,00 € | **687,50 €** |
| 120000 | 40,00 % | 5 % | 180.000,00 € | **900,00 €** |
| 90000 | 30,00 % | 5 % | 210.000,00 € | **1.050,00 €** |
| 60000 | 20,00 % | – | – | **Ablehnung** |
| Preis 400000, EK 400000 | 100,00 % | 4 % | 0,00 € | **0,00 €** |

Wenn ein Wert nicht stimmt: Haltepunkt auf das `if` der Staffel und mit F6 nachsehen, in welchem Zweig du landest (Teil E, Xdebug).

### Aufgabe 8.5 (Zusatz, klausurnah): Copy-Shop mit Optionen

Dein Copy-Shop aus 7.2 wird eine echte Klausurlösung: eine Datei, serverseitige Prüfung, Checkbox, Auswahlliste, Staffel.

Ordner `Aufgabe8_5_copyshop/` mit `loesung.php`, `includes/startTemplate.inc.php`, `includes/copyshopKonstanten.inc.php`, `smarty/templates/loesung.tpl`, `formular.css`.

Anforderungen:

- Eingaben: Anzahl Seiten (1–500), Anzahl Exemplare (1–100), **Papierformat** als Auswahlliste A4/A3, Checkbox **„Bindung gewünscht“**.
- Preise: A4 **0,05 €** pro Seite, A3 **0,10 €** pro Seite, Bindung **2,50 €** pro Exemplar (nur wenn angehakt), **19 %** MwSt.
- **Mengenrabatt:** Ab **1000 Kopien** (Seiten × Exemplare) gibt es **10 %** Rabatt auf die Kopierkosten (nicht auf die Bindung).
- Alle Preise, Grenzen, die Rabattgrenze und der Rabattsatz als Konstanten in `copyshopKonstanten.inc.php`. Die Formulargrenzen kommen per `assign` ins Template.
- Format mit `switch` und `default` (F.3), Bindung mit `isset` (F.2), alle Zahlen mit `is_numeric` und Grenzen geprüft (F.1). Bei Fehler: „Unzulässige Eingabe.“ und Link `Neue Berechnung`.
- Ausgabe als Tabelle: Kopierkosten (nach Rabatt), Bindung, Netto, MwSt., **Brutto**, darunter, ob Rabatt gewährt wurde. Alles mit Modifier formatiert.

Testwerte:

| Format | Seiten | Exemplare | Bindung | Kopierkosten | Bindung | Netto | MwSt. | Brutto |
|---|---|---|---|---|---|---|---|---|
| A4 | 40 | 3 | ja | 6,00 | 7,50 | 13,50 | 2,57 | **16,07** |
| A4 | 40 | 3 | nein | 6,00 | 0,00 | 6,00 | 1,14 | **7,14** |
| A4 | 333 | 3 | ja | 49,95 | 7,50 | 57,45 | 10,92 | **68,37** (999 Kopien, kein Rabatt) |
| A4 | 250 | 4 | ja | 45,00 | 10,00 | 55,00 | 10,45 | **65,45** (1000 Kopien, Rabatt) |
| A3 | 250 | 4 | ja | 90,00 | 10,00 | 100,00 | 19,00 | **119,00** |
| A3 | 500 | 100 | nein | 4.500,00 | 0,00 | 4.500,00 | 855,00 | **5.355,00** |
| `A5` (per F12 eingeschmuggelt) | 40 | 3 | – | | | | | **Unzulässige Eingabe** |
| 501 (mit `novalidate`) | | | | | | | | **Unzulässige Eingabe** |

### Aufgabe 8.6 (Klausur-Vorlage, Schritt 2): das Gerüst

Deine `Klausur_Vorlage` aus 7.3 zeigt bisher nur ein Formular. Bau `loesung.php` und `loesung.tpl` auf den Ablauf aus der Einleitung um, sodass du in der Klausur nur noch Felder, Prüfungen und Rechnung einsetzen musst:

1. `loesung.php`: Konstanten oben (`MIN_GRENZE`, `MAX_GRENZE`), Smarty einbinden, `$ueberschrift` immer übergeben. GET-Zweig: `PHP_SELF` und die Grenzen übergeben. POST-Zweig: das Feld `zahl` lesen, serverseitig prüfen (numerisch, zwischen den Grenzen), bei Fehler `fehler` übergeben, sonst als Platzhalter-Rechnung `$ergebnis = $zahl * 2` und `ergebnis` übergeben. Genau ein `display` am Ende.
2. `loesung.tpl`: die drei Zustände Formular / Fehler / Ergebnis, `action="{$PHP_SELF}"`, `min` und `max` aus den Konstanten.
3. Test: `http://localhost/iks/Klausur_Vorlage/loesung.php`. 21 → „42“, mit `novalidate` leer → „Unzulässige Eingabe.“, W3C-Validator ohne Fehler für Formular- **und** Ergebnisseite.

---

Wenn du fertig bist (gern auch nach jeder Aufgabe), schreib mir „fertig“ im Thread. Ich lese deine Dateien direkt in `~/eclipse-workspace/IKSY1/Kapitel8/Loesungen/` und `Klausur_Vorlage/`, korrigiere sie und erkläre Fehler. Erst danach gibt es eine Musterlösung.

---

## Spickzettel Kapitel 8 (für die Klausur-Mappe)

### if / elseif / else

```php
if ($quote >= GRENZE_HOCH)          // strengste Grenze zuerst
{
    $zinssatz = ZINSSATZ_NIEDRIG;
}
elseif ($quote >= GRENZE_MITTEL)
{
    $zinssatz = ZINSSATZ_MITTEL;
}
else
{
    $zinssatz = ZINSSATZ_HOCH;
}
```

`==` vergleicht, `=` weist zu. Kein `;` hinter `if (...)`. Immer `{ }`.

### switch

```php
switch ($format)
{
    case "A4":
        $preis = PREIS_A4;
        break;                      // nie vergessen
    case "A3":
        $preis = PREIS_A3;
        break;
    default:
        $eingabeKorrekt = false;    // Manipulation abfangen
}
```

Nur für **eine Variable gegen feste Werte**. Für `<`, `>=`, `&&` → `elseif`.

### Gerüst loesung.php

```php
<?php
    define("MIN_GRENZE", 1);
    define("MAX_GRENZE", 100);
    require_once("./includes/startTemplate.inc.php");

    $PHP_SELF = $_SERVER['PHP_SELF'];
    $REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];

    if ($REQUEST_METHOD != "POST")                       // "POST" groß!
    {
        $smarty->assign('PHP_SELF', $PHP_SELF);
        $smarty->assign('minGrenze', MIN_GRENZE);
        $smarty->assign('maxGrenze', MAX_GRENZE);
    }
    else
    {
        $eingabe = $_POST['eingabe'];
        $option = isset($_POST['option']);              // Checkbox

        $eingabeKorrekt = is_numeric($eingabe);
        $eingabeKorrekt = $eingabeKorrekt && $eingabe >= MIN_GRENZE && $eingabe <= MAX_GRENZE;

        if (! $eingabeKorrekt)
        {
            $smarty->assign('fehler', true);
        }
        else
        {
            $ergebnis = ...;
            $smarty->assign('ergebnis', $ergebnis);
        }
    }
    $smarty->display('loesung.tpl');                     // genau einmal
?>
```

### Gerüst loesung.tpl

```smarty
{if (isset($PHP_SELF))}
    <form name="formular" action="{$PHP_SELF}" method="post">
        <label for="i_eingabe">Eingabe</label>
        <input type="number" name="eingabe" id="i_eingabe"
               min="{$minGrenze}" max="{$maxGrenze}" required>
        <input type="submit" value="Abschicken">
    </form>
{else}
    {if (isset($fehler))}
        Unzulässige Eingabe.
    {elseif (isset($abgelehnt))}
        ... fachliche Ablehnung ...
    {else}
        {$ergebnis|number_format:2:",":"."} €
    {/if}
{/if}
```

Leerzeichen nach `{if`, Abschluss `{/if}`. Smarty hat kein `switch`.

### Prüfen

| Was | Wie |
|---|---|
| Zahl? | `is_numeric($x)` (`""`, `"abc"`, `"12,5"` → false) |
| Grenzen | `$x >= MIN_GRENZE && $x <= MAX_GRENZE` (dieselben Konstanten wie im Formular) |
| Checkbox angehakt? | `isset($_POST['name'])` |
| Auswahlliste | `switch` mit `default` → Fehler |
| Serverseitige Prüfung testen | vorübergehend `novalidate` ins `<form>` |

### Fehlermeldungen

| Meldung / Symptom | Ursache |
|---|---|
| `Uncaught DivisionByZeroError: Division by zero` | durch 0 geteilt, Nenner/Preis/Kurs vorher prüfen |
| `Uncaught TypeError: Unsupported operand types: string / string` | leeres Feld (`""`) in einer Rechnung → `is_numeric` prüfen |
| `Warning: Undefined array key "…"` | Checkbox nicht angehakt (→ `isset`) oder `$_POST` beim GET-Aufruf gelesen |
| Nach Abschicken kommt immer wieder das Formular | `"post"` klein geschrieben, oder `PHP_SELF` auch im POST-Zweig unter demselben Namen übergeben |
| Weiße Seite im Fehlerfall | `exit()` ohne vorheriges `display` |
| Jede Eingabe landet im selben Zweig | `=` statt `==`, `;` hinter `if (...)`, oder Staffel in falscher Reihenfolge |
| Falsches Ergebnis im `switch` | `break` vergessen |
| `Syntax error in template … ` | `{if(` ohne Leerzeichen, `{/if}` fehlt |
| Meldung fehlt, **keine** Fehlermeldung | Name in `assign` ≠ Name in `isset(...)` im Template |
