# Kapitel 4: Erste Beispiele in PHP

Skript `phpScript.pdf`, Seiten 31–45 · Beispiele: `Vorlesungen/4` · Aufgaben 4.1–4.5 plus eine Zusatzaufgabe (4.6)

So gehst du vor: Kopiere zuerst die Beispiele in deinen Workspace (siehe Vorbereitung). Lies dann Teil A bis D und **tippe die PHP-Beispiele selbst ab** (nicht kopieren, beim Abtippen lernst du die Schreibweise). Die „Selbst ausprobieren“-Schritte zeigen dir die typischen Fehler, die du in der Klausur sonst zum ersten Mal siehst. Danach löst du in Teil F die Aufgaben.

**Warum dieses Kapitel wichtig ist:** Hier schreibst du dein erstes PHP. Alles, was in der Klausur passiert, ist eine größere Version von Beispiel 4.8/4.9: **Formular abschicken → PHP liest `$_POST` → PHP rechnet → PHP gibt HTML aus.** Wenn du dieses Muster sicher kannst, ist der Rest (Smarty, Klassen, Datenbank) nur Ausbau.

**JavaScript:** Das Skript zeigt jedes Beispiel zuerst in JavaScript, dann in PHP. JavaScript ist laut Dozent **nicht klausurrelevant**. Die JS-Dateien öffnest du nur einmal im Browser, um den Unterschied zu sehen (Teil A). Abtippen musst du nur die PHP-Beispiele.

---

## Vorbereitung

1. Lege in Eclipse im Projekt `IKSY1` den Ordner `Kapitel4/` an, darin `Vorlesungsmaterialien/` und `Loesungen/` (wie bei `Kapitel3/`).
2. Kopiere aus dem Kursordner `Vorlesungen/4/` **nur** diese Dateien nach `Kapitel4/Vorlesungsmaterialien/`: `helloWorld.html`, `addition2.html` und `formular.css`. Die PHP-Beispiele tippst du in Teil A bis D selbst in denselben Ordner.
3. In `addition2php.html` und den anderen Formularen steht `href="../css/formular.css"`. Die Datei liegt aber direkt daneben. Schreib in deinen Dateien einfach `href="formular.css"`.
4. Aufrufen im Browser: `http://localhost/iks/Kapitel4/Vorlesungsmaterialien/helloWorld.php` usw.

> **Wichtig:** PHP-Dateien funktionieren **nur über `http://localhost/...`**. Öffnest du sie per Doppelklick (`file:///home/...`), siehst du den PHP-Code als Text oder eine leere Seite, weil dann kein Server dazwischen ist. Das ist der häufigste Anfängerfehler.

Zwei Fehler, die in den Original-Beispieldateien stecken (damit du dich nicht wunderst):

- `addition3phpFormel.php` ist nicht als UTF-8 gespeichert. Statt „natürlichen“ erscheint „nat�rlichen“. Deine abgetippte Version hat das Problem nicht, solange Eclipse auf UTF-8 steht.
- In `addition3phpFormel.html` steht `for="i_bisZu"`, aber `id="i_biszu"` (kleines z). Klick auf das Label setzt den Cursor dann **nicht** ins Feld. Groß-/Kleinschreibung zählt.
- Im Skript (Beispiel 4.14, S. 44) ist versehentlich noch einmal die Schleife abgedruckt statt der Formel. Die richtige Formel-Version steht unten in D.3.

---

## Teil A: Client und Server (S. 31–33), das Wichtigste des Kapitels

Das Skript sagt selbst: Die Beispiele musst du noch nicht ganz verstehen, aber **den Unterschied zwischen client- und serverseitig** schon.

### A.1 Hello World in PHP (Beispiel 4.3) – abtippen

`Kapitel4/Vorlesungsmaterialien/helloWorld.php`:

```php
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- helloWorld.php -->
    <title>Hello World</title>
</head>
<body>
    <?php
        echo "<h2> Hello World </h2>";
    ?>
</body>
</html>
```

- Die Datei endet auf **`.php`**. Daran erkennt Apache, dass er die Datei vorher an PHP geben muss.
- Alles zwischen **`<?php`** und **`?>`** ist PHP-Code. Alles außerhalb ist normales HTML und wird unverändert durchgereicht.
- **`echo`** gibt aus, was dahinter steht. Die Ausgabe landet genau an der Stelle im HTML, wo der PHP-Block stand. Du darfst HTML-Tags mit ausgeben (`<h2>…</h2>`).
- Jede PHP-Anweisung endet mit **`;`**.

### A.2 Was passiert beim Aufruf

```
Browser                         Server (Apache + PHP)
   |  GET helloWorld.php   -->   |
   |                             |  1. liest die Datei
   |                             |  2. führt <?php ... ?> aus
   |                             |  3. ersetzt den Block durch die Ausgabe
   |  <--  reines HTML           |
   |  zeigt HTML an              |
```

Beim Browser kommt **nur das Ergebnis** an:

```html
<body>
    <h2> Hello World </h2>
</body>
```

Bei JavaScript ist es umgekehrt: Der **Programmcode selbst** wird an den Browser geschickt, und der Browser führt ihn aus.

> **Selbst ausprobieren (5 Minuten, dann ist das Kapitel-Ziel erreicht):**
> 1. Öffne `http://localhost/iks/Kapitel4/Vorlesungsmaterialien/helloWorld.php` und drücke **Strg+U** (Seitenquelltext). Kein `<?php`, kein `echo`, nur `<h2> Hello World </h2>`.
> 2. Öffne `helloWorld.html` (die JavaScript-Version) und drücke Strg+U. Hier siehst du den kompletten `<script>`-Block mit `document.write(...)`.
> 3. Öffne `addition2.html` (JavaScript mit Eingabefenstern), gib zwei Zahlen ein und sieh dir auch hier den Quelltext an.

**Was daraus für dich als Programmierer folgt** (wird in Aufgabe 4.5 praktisch ausprobiert):

- Alles in JavaScript (und HTML) kann der Benutzer **lesen und verändern**. Preise, Rabatte, Passwörter oder Prüfregeln, die nur im Browser stehen, sind nicht geschützt.
- PHP-Code und alles, was darin steht (z. B. das Datenbank-Passwort in `DbFunctions` ab Kapitel 12), bleibt auf dem Server.
- Deshalb wird in der Klausur **in PHP gerechnet und in PHP geprüft**. Die HTML5-Prüfung aus Kapitel 3 ist nur Komfort für den Benutzer.

---

## Teil B: Variablen, Rechnen und Ausgabe (S. 33–36)

### B.1 Beispiel 4.5 – abtippen

`Kapitel4/Vorlesungsmaterialien/addition1.php`:

```php
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- addition1.php -->
    <title>Superleichte Addition mit php</title>
</head>
<body>
    <?php
        $ersterSummand = 9;
        $zweiterSummand = 10;
        $summe = $ersterSummand + $zweiterSummand;
        echo("Die Summe von $ersterSummand und $zweiterSummand ist: $summe");
    ?>
</body>
</html>
```

Ausgabe: `Die Summe von 9 und 10 ist: 19`

### B.2 Variablen in PHP

- Eine Variable beginnt **immer mit `$`**: `$summe`, `$ersterSummand`.
- Man **deklariert** sie nicht (anders als `var` in JavaScript). Sie entsteht, sobald man ihr zum ersten Mal einen Wert zuweist.
- **Zuweisung** mit `=`: Erst wird die **rechte Seite** ausgerechnet, dann wird das Ergebnis in die Variable **links** gespeichert. `$summe = $ersterSummand + $zweiterSummand;` heißt also „rechne 9 + 10 und leg 19 in `$summe` ab“.
- Groß-/Kleinschreibung zählt: `$summe` und `$Summe` sind zwei verschiedene Variablen.
- **Sprechende Namen** (S. 45): `$ersterSummand` statt `$a`. Das ist in der Klausur ein Bewertungskriterium. Schreibweise wie im Skript: erstes Wort klein, jedes weitere Wort groß (*camelCase*), keine Umlaute.

### B.3 Rechnen

| Operator | Bedeutung | Beispiel | Ergebnis |
|---|---|---|---|
| `+` | plus | `9 + 10` | `19` |
| `-` | minus | `10 - 3` | `7` |
| `*` | mal | `4 * 5` | `20` |
| `/` | geteilt | `7 / 2` | `3.5` |
| `( )` | Klammern | `4 * (4 + 1) / 2` | `10` |

Es gilt Punkt vor Strich, wie in Mathe. Kommazahlen schreibst du im Code mit **Punkt**: `0.05`, nicht `0,05`.

### B.4 Ausgabe mit `echo` und Text in Anführungszeichen

```php
echo("Die Summe von $ersterSummand und $zweiterSummand ist: $summe");
echo "Die Summe ist: $summe";                    // Klammern dürfen weg
echo "Die Summe von $ersterSummand und $zweiterSummand" .
     " ist: $summe";                              // . hängt zwei Texte aneinander
echo "<p>Ergebnis: <strong>$summe</strong></p>"; // HTML-Tags mit ausgeben
```

- In **doppelten Anführungszeichen** `"…"` setzt PHP für jede `$variable` deren **Wert** ein. Das ist der große Vorteil gegenüber JavaScript, wo man `"Text " + variable + " Text"` schreiben muss.
- Mit dem **Punkt `.`** hängt PHP Texte aneinander (in JavaScript macht das `+`). So kannst du lange Ausgaben auf mehrere Zeilen verteilen.
- Zeilenumbrüche im Code oder im Text sind egal; für eine neue Zeile **im Browser** brauchst du HTML (`<br>` oder `<p>`).

> **Selbst ausprobieren:**
> 1. Lösch in deiner `addition1.php` das `;` am Ende von `$zweiterSummand = 10` und lade neu. Du bekommst einen `Parse error: syntax error, unexpected variable "$summe"` mit **Zeilennummer**. Die Zeile im Fehler ist oft die Zeile **nach** dem fehlenden `;`. Mach es wieder rückgängig.
> 2. Schreib `$Summe` (großes S) in die `echo`-Zeile. Es erscheint `Warning: Undefined variable $Summe` und die Zahl fehlt. Wieder zurück.
> 3. Ändere die Rechnung auf `$ersterSummand * $zweiterSummand` und auf `($ersterSummand + $zweiterSummand) / 2`.

Wenn bei dir statt einer Fehlermeldung nur eine **weiße Seite** kommt, ist die Fehleranzeige aus. Dann in `/etc/php/8.3/apache2/php.ini` die Zeile `display_errors = On` setzen und `sudo systemctl restart apache2`.

---

## Teil C: Eingaben vom Benutzer, das Zwei-Dateien-Prinzip (S. 36–40)

PHP läuft auf dem Server und kann den Benutzer **nicht** mitten im Programm etwas fragen (es gibt kein `prompt` wie in JavaScript). Die Eingaben müssen **vorher** da sein. Dafür nimmt man das Formular aus Kapitel 3:

1. **Datei 1 (HTML):** Formular mit `action="…php"` und `method="POST"`.
2. **Datei 2 (PHP):** liest die Werte aus `$_POST`, rechnet, gibt das Ergebnis aus.

Das ist genau das Muster der Klausur (dort heißt Datei 1 `index.php` + Smarty-Template, Datei 2 z. B. `loesung.php`).

### C.1 Beispiel 4.8 – abtippen

`Kapitel4/Vorlesungsmaterialien/addition2php.html`:

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- addition2php.html -->
    <title>Addition mit Eingabe in php</title>
    <link rel="stylesheet" href="formular.css" type="text/css">
</head>
<body>
    <h2>
        Addition zweier Zahlen
    </h2>
    <form name="addition" action="./addition2php.php" method="POST">
        <label for="i_ersterSummand">Erster Summand</label>
        <input type="number" name="ersterSummand" id="i_ersterSummand" size=12><br>
        <label for="i_zweiterSummand">Zweiter Summand</label>
        <input type="number" name="zweiterSummand" id="i_zweiterSummand" size=12><br>
        <input type="submit" name="Button1" value="Abschicken">
    </form>
</body>
</html>
```

`<input type="submit" value="Abschicken">` ist die ältere Schreibweise für `<button type="submit">Abschicken</button>` aus Kapitel 3. Beides geht.

### C.2 Beispiel 4.9 – abtippen

`Kapitel4/Vorlesungsmaterialien/addition2php.php`:

```php
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- addition2php.php -->
    <title>Addition mit Eingabe in php (Teil 2)</title>
</head>
<body>
    <h2>
        Addition zweier Zahlen: Das Ergebnis
    </h2>
    <?php
        $ersterSummand = $_POST['ersterSummand'];
        $zweiterSummand = $_POST['zweiterSummand'];
        $summe = $ersterSummand + $zweiterSummand;
        echo("Die Summe von $ersterSummand und $zweiterSummand ist: $summe");
    ?>
</body>
</html>
```

Die Verbindung zwischen den beiden Dateien ist das **`name`-Attribut**:

```
<input ... name="ersterSummand">   ──►   $_POST['ersterSummand']
```

`$_POST` ist das Array, das du in Kapitel 3 mit `print_r($_POST)` angesehen hast. Mit `$_POST['schluessel']` holst du **einen** Wert heraus und speicherst ihn in einer eigenen Variablen. Den Schlüssel schreibst du in **einfache Anführungszeichen** und **genau so** wie im `name`-Attribut (Groß-/Kleinschreibung!).

Was aus dem Formular kommt, ist zunächst **Text** (`"5"`). PHP wandelt beim Rechnen automatisch in eine Zahl um, solange der Text wie eine Zahl aussieht. In JavaScript braucht man dafür `parseFloat` (siehe `addition2.html`).

> **Selbst ausprobieren (diese Fehler wirst du wiedersehen):**
> 1. **Richtig:** Formular öffnen, 5 und 9 eingeben, abschicken. Ausgabe: `Die Summe von 5 und 9 ist: 14`.
> 2. **PHP-Datei direkt aufrufen:** Gib `http://localhost/iks/Kapitel4/Vorlesungsmaterialien/addition2php.php` direkt in die Adresszeile ein. Es kommt zweimal `Warning: Undefined array key "…"` und danach `Die Summe von und ist: 0`. Grund: Ohne Abschicken ist `$_POST` leer, die Variablen sind leer, und PHP rechnet mit „nichts“ als 0. **Merke: Die Auswertung immer über das Formular aufrufen.**
> 3. **Feld leer lassen:** Lass den zweiten Summanden leer und schicke ab. Wieder `TypeError`, weil PHP 8 mit einem leeren Text `""` nicht rechnen kann. Abhilfe für jetzt: `required` an beide Felder (Kapitel 3). Die serverseitige Prüfung, die das sauber abfängt, kommt in Kapitel 8.
> 4. **Tippfehler im Schlüssel:** Schreib in der PHP-Datei `$_POST['ErsterSummand']` (großes E). Wieder `Undefined array key`. Wenn du diese Meldung siehst, vergleiche zuerst `name` im Formular mit dem Schlüssel in PHP.
> 5. **Kommazahl:** Gib `2.5` ein. Der Browser lehnt ab, weil ein `number`-Feld ohne `step` nur ganze Zahlen erlaubt. Mit `step="any"` (oder `step="0.01"`) geht es. Im Feld gibst du je nach Browser-Sprache `2,5` ein, bei PHP kommt immer `2.5` an.

---

## Teil D: Die erste Schleife (S. 40–44)

Aufgabe: alle natürlichen Zahlen von 1 bis zu einer eingegebenen Zahl addieren, z. B. bis 4: 1 + 2 + 3 + 4 = 10.

### D.1 Beispiel 4.11 und 4.12 – abtippen

`Kapitel4/Vorlesungsmaterialien/addition3php.html`:

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- addition3php.html -->
    <title>Aufsummierung aller natürlichen Zahlen bis zu einer einzugebenden Zahl in php</title>
    <link rel="stylesheet" href="formular.css" type="text/css">
</head>
<body>
    <h2>
        Aufsummierung aller natürlichen Zahlen bis zu einer einzugebenden Zahl
    </h2>
    <form name="addition3" action="./addition3php.php" method="POST">
        <label for="i_bisZu">Zahl, bis zu der summiert werden soll</label>
        <input type="number" name="bisZu" id="i_bisZu" size=12><br>
        <input type="submit" name="Button1" value="Abschicken">
    </form>
</body>
</html>
```

`Kapitel4/Vorlesungsmaterialien/addition3php.php`:

```php
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- addition3php.php -->
    <title>Addition mit Eingabe in php (Teil 2)</title>
</head>
<body>
    <h2>
        Aufsummierung natürlicher Zahlen: Das Ergebnis
    </h2>
    <?php
        $bisZu = $_POST['bisZu'];
        $summe = 0;
        for ($i = 1; $i <= $bisZu; $i++)
        {
            $summe = $summe + $i;
        }
        echo("Die Summe der ersten $bisZu natürlichen Zahlen ist: $summe");
    ?>
</body>
</html>
```

### D.2 So läuft die `for`-Schleife

```php
for ($i = 1; $i <= $bisZu; $i++)
//   Start    Bedingung     nach jedem Durchlauf
{
    // wird wiederholt, solange die Bedingung wahr ist
}
```

1. **Start** `$i = 1` wird **einmal** am Anfang ausgeführt.
2. **Bedingung** `$i <= $bisZu` wird **vor jedem** Durchlauf geprüft. Ist sie wahr, läuft der Block `{ … }`. Ist sie falsch, geht es **hinter** der `}` weiter.
3. **`$i++`** erhöht `$i` nach jedem Durchlauf um 1 (Kurzform für `$i = $i + 1`).

Wertetabelle für `$bisZu = 4` (Tabelle 4.1 im Skript):

| Durchlauf | `$i` | `$summe` danach |
|---|---|---|
| vor der Schleife | – | 0 |
| 1 | 1 | 0 + 1 = 1 |
| 2 | 2 | 1 + 2 = 3 |
| 3 | 3 | 3 + 3 = 6 |
| 4 | 4 | 6 + 4 = 10 |
| Prüfung | 5 | 5 <= 4 ist falsch → Schleife endet |

Drei Regeln, die das Beispiel zeigt:

- **`$summe = 0;` vor der Schleife ist Pflicht.** Eine Variable, die rechts in `$summe = $summe + $i` steht, muss vorher einen Wert haben.
- Eine Variable darf **links und rechts** derselben Zuweisung stehen. Rechts wird der alte Wert benutzt, links landet der neue.
- Schleifenvariablen heißen `$i`, `$j`, `$k`. Das ist die einzige Ausnahme von den sprechenden Namen.

> **Selbst ausprobieren:**
> 1. Setz in die Schleife zusätzlich `echo "i = $i, summe = $summe<br>";` und rechne bis 4. Du siehst die Wertetabelle von oben im Browser. Diese Zwischenausgabe ist der einfachste Debugger.
> 2. Kommentiere `$summe = 0;` aus (`// ` davor). Bei 4 kommt `Warning: Undefined variable $summe`, das Ergebnis stimmt hier zufällig trotzdem. Verlass dich nie darauf, initialisiere immer.
> 3. Mit **Xdebug** (siehe `Einrichtung_Linux_Mint.md`): Breakpoint auf die Zeile `$summe = $summe + $i;` setzen, Formular abschicken und mit **F6** Schritt für Schritt durchgehen. In der Ansicht *Variables* siehst du `$i` und `$summe` wachsen. Das brauchst du ab Kapitel 8 ständig.

### D.3 Dasselbe mit Formel (Beispiel 4.13/4.14)

Für die Summe 1 + 2 + … + n gilt: **n · (n + 1) / 2**. Statt der Schleife reicht eine Zeile. `Kapitel4/Vorlesungsmaterialien/addition3phpFormel.php` (Formular wie D.1, nur `action="./addition3phpFormel.php"`):

```php
    <?php
        $bisZu = $_POST['bisZu'];
        $summe = ($bisZu * ($bisZu + 1)) / 2;
        echo("Die Summe der ersten $bisZu natürlichen Zahlen ist: $summe");
    ?>
```

Bei 4: 4 · 5 / 2 = 10. Gleiches Ergebnis, ohne Schleife, schneller.

---

## Teil E: Programmierstil (S. 45)

Beides wird in der Klausur bewertet, gewöhn es dir ab jetzt an:

- **Einrücken:** Code im `<?php`-Block eine Stufe (Tab) eingerückt, Code in `{ … }` eine weitere Stufe. In Eclipse rückt **Strg+Shift+F** automatisch ein.
- **Sprechende Namen:** `$anzahlSeiten`, `$preisProSeite`, `$gesamtpreis` statt `$a`, `$b`, `$c`.

---

## Teil F: Deine Aufgaben

**Regeln:** Alles kommt nach `~/eclipse-workspace/IKSY1/Kapitel4/Loesungen/`. Speichere als UTF-8. Prüfe jede Seite unter `http://localhost/iks/Kapitel4/Loesungen/…` (nicht per Doppelklick). Pushen machst du in Eclipse. JavaScript brauchst du für keine Aufgabe, alle Programme schreibst du in **PHP**.

Ordnerstruktur:

```
Kapitel4/Loesungen/
├── aufgabe_4_1.php
├── aufgabe_4_2.html
├── aufgabe_4_3.html        (Formular)
├── aufgabe_4_3.php         (Auswertung)
├── aufgabe_4_4.html        (zwei Formulare)
├── aufgabe_4_4_schleife.php
├── aufgabe_4_4_formel.php
├── aufgabe_4_5.html
├── aufgabe_4_5.php
├── aufgabe_4_6.html
├── aufgabe_4_6.php
└── formular.css            (Kopie aus Vorlesungsmaterialien, darf angepasst werden)
```

### Aufgabe 4.1: Name ausgeben
> Schreiben Sie ein Programm, das Ihren Namen im Browser ausgibt.

- Vollständiges HTML5-Gerüst, Ausgabe per `echo` als Überschrift `h1`.
- Speichere deinen Namen zuerst in einer Variablen (`$vorname`, `$nachname`) und gib dann `Mein Name ist Abdulaziz Srour` aus.
- Prüfe mit Strg+U, dass im Quelltext kein PHP mehr steht.

### Aufgabe 4.2: Noch einfacher
> Dies war ja schon eine recht einfache Aufgabe. Können Sie sich ein noch einfacheres Programm vorstellen? Wenn ja, schreiben Sie es :-).

Gemeint ist: Die Ausgabe aus 4.1 braucht gar kein Programm. Schreib dieselbe Seite als **reine HTML-Datei** `aufgabe_4_2.html` (so wie Beispiel 4.2 und 4.6 im Skript). Öffne 4.1 und 4.2 nebeneinander mit Strg+U: Der Quelltext beim Browser ist gleich.

### Aufgabe 4.3: Subtraktion
> Das nächste Programm soll 2 Zahlen einlesen und die zweite von der ersten abziehen! Das Ergebnis soll im Browser ausgegeben werden!

- `aufgabe_4_3.html`: Formular mit den Feldern **Minuend** und **Subtrahend**, beide Pflicht, **Kommazahlen mit zwei Nachkommastellen** erlaubt, Labels mit `for`, Cursor startet im ersten Feld. Schickt per `post` an `aufgabe_4_3.php`.
- `aufgabe_4_3.php`: liest beide Werte, rechnet, gibt aus: `10 minus 3 ergibt 7`.
- Testwerte: 10 und 3 → 7; 3 und 10 → -7; 5,5 und 2,25 → 3.25.

### Aufgabe 4.4: Summe der ersten n negativen Zahlen
> Dieses Programm soll die Summe der ersten n negativen Zahlen bilden. Die Zahl n wird eingelesen. Die Summe soll im Browser ausgegeben werden! Erstellen Sie eine Lösung mit einer Schleife und eine ohne.

Gemeint ist (-1) + (-2) + … + (-n).

- `aufgabe_4_4.html`: **zwei Formulare** auf einer Seite (jedes Formular hat sein eigenes `action`), eins schickt an `aufgabe_4_4_schleife.php`, eins an `aufgabe_4_4_formel.php`. n ist Pflicht, ganze Zahl von 1 bis 1000.
- `aufgabe_4_4_schleife.php`: mit `for`-Schleife.
- `aufgabe_4_4_formel.php`: ohne Schleife, mit einer Formel (leite sie aus D.3 ab).
- Ausgabe: `Die Summe der ersten 4 negativen Zahlen ist: -10`
- Testwerte: n = 1 → -1; n = 4 → -10; n = 100 → -5050. Beide Dateien müssen dasselbe liefern.

### Aufgabe 4.5: JavaScript und PHP im Quelltext
> Wie Sie in diesem Kapitel gesehen haben, wird der JavaScript-Code an den Browser übertragen, der PHP-Code nicht. Dadurch können sich die Benutzer den JavaScript-Code im Browser ansehen, den PHP-Code nicht. Welche Konsequenzen hat das für Sie als Programmierer?

Statt die Frage zu beantworten, probierst du es aus. Ein Shop gibt Stammkunden einen **geheimen Rabatt von 15 %**:

- `aufgabe_4_5.html`: Formular mit dem Feld **Warenwert in €** (Pflicht, größer 0, zwei Nachkommastellen), schickt an `aufgabe_4_5.php`.
- `aufgabe_4_5.php`: Der Rabatt steht **nur hier** in einer Variablen `$rabattProzent = 15;`. Ausgabe: `Warenwert: 200 €, Rabatt: 30 €, zu zahlen: 170 €`.
- Öffne die Ergebnisseite mit Strg+U und suche nach „15“. Du findest es nicht: Der Rabattsatz bleibt auf dem Server. In einer JavaScript-Lösung stünde er für jeden lesbar im Quelltext (das musst du nicht programmieren).
- Zweiter Test: Mach im Browser mit F12 aus dem Feld `min="0.01"` ein `min="-100"` und schicke -100 ab. Die Seite rechnet mit einem negativen Warenwert. Das zeigt, warum Eingaben ab Kapitel 8 zusätzlich in PHP geprüft werden.

### Aufgabe 4.6 (Zusatz, klausurnah): Copy-Shop
Ein Copy-Shop berechnet den Preis für gebundene Kopien. Eine Seite kostet 0,05 €, die Bindung kostet 2,50 € pro Exemplar.

- `aufgabe_4_6.html`: Formular mit **Anzahl Seiten** (Pflicht, ganze Zahl von 1 bis 500) und **Anzahl Exemplare** (Pflicht, ganze Zahl von 1 bis 100), Button „Berechnen“. Formatiere es mit `formular.css`.
- `aufgabe_4_6.php`: Die beiden Preise stehen als Variablen mit sprechenden Namen am Anfang des PHP-Blocks. Gib eine **Tabelle** aus (Kapitel 3, per `echo`) mit den Zeilen Kopierkosten, Bindung und Gesamtpreis.
- Testwerte: 40 Seiten, 3 Exemplare → Kopierkosten 6 €, Bindung 7,5 €, Gesamtpreis 13,5 €. Dass PHP `7.5` statt `7,50` ausgibt, ist in diesem Kapitel in Ordnung. Schöne Beträge kommen später.

---

Wenn du fertig bist (gern auch nach jeder Aufgabe einzeln), schreib mir „fertig“ im Thread. Ich lese deine Dateien direkt in `~/eclipse-workspace/IKSY1/Kapitel4/Loesungen/`, korrigiere sie und erkläre Fehler. Erst danach gibt es eine Musterlösung.

---

## Spickzettel Kapitel 4 (für die Klausur-Mappe)

### Grundgerüst einer PHP-Seite

```php
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Titel</title>
</head>
<body>
    <?php
        $variable = 5;                 // Variable: $ davor, keine Deklaration, ; am Ende
        echo "<p>Wert: $variable</p>"; // in "..." wird $variable durch den Wert ersetzt
    ?>
</body>
</html>
```

- Datei muss auf **`.php`** enden und über **`http://localhost/...`** aufgerufen werden.
- Beim Browser kommt nur die **Ausgabe** an, nie der PHP-Code (Strg+U zum Prüfen).

### Formular → PHP (Zwei-Dateien-Prinzip)

```html
<!-- eingabe.html -->
<form action="auswertung.php" method="POST">
    <label for="i_zahl">Zahl</label>
    <input type="number" name="zahl" id="i_zahl" min="1" step="1" required>
    <button type="submit">Berechnen</button>
</form>
```

```php
<?php
    // auswertung.php
    $zahl = $_POST['zahl'];            // Schlüssel = name-Attribut, exakt gleich geschrieben
    $ergebnis = $zahl * 2;
    echo "Das Doppelte von $zahl ist $ergebnis";
?>
```

### Rechnen und Texte

| | PHP |
|---|---|
| Grundrechenarten | `+  -  *  /`, Klammern `( )`, Punkt vor Strich |
| Kommazahl im Code | `0.05` (Punkt!) |
| Texte verbinden | `"Text " . $variable . " Text"` |
| Variable im Text | `"Summe: $summe"` (nur in doppelten Anführungszeichen) |
| HTML ausgeben | `echo "<td>$betrag</td>";` |

### Schleife und Formel

```php
$summe = 0;                            // vor der Schleife initialisieren!
for ($i = 1; $i <= $n; $i++)
{
    $summe = $summe + $i;
}
// ohne Schleife: 1 + 2 + ... + n
$summe = ($n * ($n + 1)) / 2;
```

### Fehlermeldungen und was sie meistens heißen

| Meldung | Ursache |
|---|---|
| `Parse error: syntax error, unexpected ...` | `;`, `)` oder `"` fehlt, oft in der Zeile **davor** |
| `Warning: Undefined variable $x` | Tippfehler im Namen (Groß/klein!) oder Variable nicht initialisiert |
| `Warning: Undefined array key "x"` | PHP-Datei direkt aufgerufen statt über das Formular, oder `name` im Formular ≠ Schlüssel in `$_POST` |
| `Fatal error: Uncaught TypeError: Unsupported operand types` | mit leerem oder nicht-numerischem Text gerechnet (Feld leer gelassen) |
| PHP-Code steht im Browser / leere Seite | Datei per Doppelklick geöffnet statt über `http://localhost/...` |
| weiße Seite ohne Meldung | `display_errors = On` in `php.ini`, Apache neu starten |
