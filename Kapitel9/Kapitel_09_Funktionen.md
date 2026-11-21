# Kapitel 9: Funktionen, Wert- und Referenzparameter, Gültigkeitsbereich

Skript `phpScript.pdf`, Seiten 85–109 · Beispiele: `Vorlesungen/9` · Aufgaben 9.1 und 9.2 + 9.3 und 9.4 klausurnah

So gehst du vor: Erst die Vorbereitung, dann Teil A bis E lesen und die „Selbst ausprobieren“-Schritte machen. Danach löst du in Teil F die Aufgaben.

**Warum dieses Kapitel wichtig ist:** In jeder Probeklausur steckt die eigentliche Rechnung in einer **Funktion**. Probeklausur 2 (`klassen/Umzugsgebuehren.inc.php`):

```php
class Umzugsebuehren {
    public static function berechneGebuehr($teamgroesse, $arbeitszeit, $entfernung, $lastenaufzug)
    {
        ...
        return $preis;
    }
}
```

und in `loesung.php`:

```php
$betrag=Umzugsebuehren::berechneGebuehr($teamgroesse, $arbeitszeit, $entfernung, $lastenaufzug);
```

Die Zeilen `class …` und `public static` kommen erst in Kapitel 10. **Alles andere ist Kapitel 9:** eine Funktion mit sprechendem Namen, die ihre Werte über **Parameter** bekommt und das Ergebnis mit **`return`** zurückgibt. Dasselbe gilt für die Prüfungen: `Sicherheit::isNumericalInBoundary($entfernung, MIN_GRENZE, MAX_GRENZE_ENTFERNUNG)` ist eine Funktion, die `true` oder `false` zurückgibt. Genau diese Prüffunktion schreibst du in diesem Kapitel selbst.

Dozenten-Tipp 9 und 10: „Eigene Funktionen in Klassen in einem Unterordner“, „eine vorab erstellte Funktionssammlung ist erlaubt“. Diese Sammlung beginnt jetzt, erst als `.inc.php` mit Funktionen, in Kapitel 10 setzt du nur noch die Klasse drumherum.

---

## Vorbereitung

1. Lege in Eclipse im Projekt `IKSY1` den Ordner `Kapitel9/` an, darin `Vorlesungsmaterialien/` und `Loesungen/`.
2. Kopiere aus `Vorlesungen/9/` nach `Kapitel9/Vorlesungsmaterialien/`:
   - `composer.json`
   - alle `.php`-Dateien (`euro3.php`, `funktionenMax1.php`, `funktionenMax2.php`, `namenSindSchallUndRauch.php`, `produkte1.php`, `produkte2.php`, `variablenAenderung1.php`, `variablenAenderung3.php`, `variablenZuweisung1.php` bis `3.php`)
   - den Ordner `includes/` (9 Dateien)
   - den Ordner `smarty/templates/` (3 Templates)

   **Nicht** kopieren: alle `.html`-Dateien (`funktionen1.html`, `variablenAenderung2.html`, `variablenZuweisungJavaScript1–4.html`, reines JavaScript, nicht klausurrelevant), den alten Ordner `klassen/` und den Inhalt von `smarty/templates_c/`. Lege stattdessen einen **leeren** Ordner `smarty/templates_c/` an.
   Dazu `formular.css` aus `Kapitel8/Vorlesungsmaterialien/`.
3. Im Terminal:
   ```bash
   cd ~/eclipse-workspace/IKSY1/Kapitel9/Vorlesungsmaterialien
   composer install
   chmod 777 smarty/templates_c
   sed -i 's#\.\./css/formular\.css#formular.css#' smarty/templates/*.tpl
   ```
4. In `includes/startTemplate.inc.php` die Zeile mit `$ROOT_DIR` ändern auf
   ```php
   $ROOT_DIR='/var/www/html/iks/Kapitel9/Vorlesungsmaterialien';
   ```
   (Im Original steht `/var/www/html/iksy05/Vorlesungen/9`.)
5. In Eclipse `Kapitel9` markieren, **F5**.
6. Test: `http://localhost/iks/Kapitel9/Vorlesungsmaterialien/funktionenMax1.php` zeigt „Maximum1: 10, Maximum2: 1, Maximum3: 1“.

Fehler und Ungenauigkeiten im Skript und in den Original-Dateien:

| Wo | Was nicht stimmt |
|---|---|
| Skript S. 88 | Zitiert die Funktion mit `if($a>$b)`, im Beispiel 9.1 steht `>=`. Und der dritte Aufruf heißt dort `$max1=berechneMaximum($b, $a);`, richtig ist `$max3`. |
| Skript S. 97 | „wird die Variable `$ergebnis` mit dem Wert ‚Falscher Operator‘ belegt“: Im Code steht `"Falsche Zielwährung"` (aus dem Taschenrechner kopiert). |
| Skript S. 99, Beispiel 9.14 | Bindet `euroDollarUmrechnung.inc.php` ein. Die Datei `produkte2.php` in `Vorlesungen/9` bindet `euroDollarUmrechnung2.inc.php` ein. Das ist die bessere Version mit `strtolower` und `trim`, die steht aber nirgends im Skript (Teil B). |
| Skript S. 103, Abb. 9.9 | Zeigt einfach leere Werte. Unter PHP 8 kommt zu jeder fehlenden Variable eine `Warning: Undefined variable $tester1` (Teil D). |
| `euro3.php` | Prüft **nach** der Rechnung, ob das Ergebnis eine Zahl ist. Kurs 0 mit Zielwährung Euro stürzt deshalb immer noch mit `DivisionByZeroError` ab (Teil B). |
| `namenSindSchallUndRauch.php` | Ohne HTML-Gerüst und mit `echo`, nur zum Ausprobieren gedacht. Die Kommentarzeile nennt einen anderen Dateinamen. Harmlos. |
| `variablenAenderung1.php`, `variablenZuweisung*.php` | Ebenfalls ohne Smarty, mit `echo` (Fußnote 12 im Skript). In deinen Lösungen gibt es weiterhin kein `echo`. |
| Musterlösung `Uebung/Loesungen/aufgabe9_2.php` | Definiert die Konstante **im** `else`-Zweig, prüft keine Eingabe, arbeitet mit `exit()`, und die eingebundene `aufgabe9_2.inc.php` fehlt im Ordner. Nicht als Vorbild nehmen. |
| Probeklausur 2, `Umzugsgebuehren.inc.php` | `DEFINE(...)` **innerhalb** der Funktion. Ruft man die Funktion zweimal auf, kommt `Warning: Constant PREIS_KLEIN already defined`. Konstanten gehören an den Dateianfang (Teil E). Außerdem heißt die Klasse `Umzugsebuehren` (Tippfehler), funktioniert nur, weil der Aufruf denselben Tippfehler hat. |

---

## Teil A: Die erste Funktion (S. 85–93)

### A.1 Warum Funktionen

Bis jetzt stand die Rechnung direkt in `loesung.php`. Sobald du dieselbe Rechnung an mehreren Stellen brauchst (drei Produkte umrechnen, zwei Grenzen prüfen, die Rechnung zusätzlich ins PDF), schreibst du sie mehrfach ab. Eine Funktion schreibst du **einmal** und rufst sie beliebig oft auf. Ändert sich die Regel, änderst du nur eine Stelle.

### A.2 Deklarieren und aufrufen

```php
function berechneMaximum($a, $b)        // Kopf: function, Name, (Parameter)
{                                        // Rumpf
    if ($a>=$b)
    {
        $max=$a;
    }
    else
    {
        $max=$b;
    }
    return $max;                         // Ergebnis zurück an den Aufrufer
}

$max1=berechneMaximum($ersteZahl, $zweiteZahl);    // Aufruf
```

| Begriff | Bedeutung |
|---|---|
| **formale Parameter** | die Variablen im Kopf, hier `$a`, `$b` |
| **aktuelle Parameter** | die Werte beim Aufruf, hier `$ersteZahl`, `$zweiteZahl` |
| **Signatur** | Name + Parameterliste: `berechneMaximum($a, $b)` |
| **Rückgabewert** | der Wert hinter `return`. Der Aufruf steht deshalb **rechts** von einem `=` |

Ablauf beim Aufruf: PHP kopiert den Wert von `$ersteZahl` nach `$a` und den von `$zweiteZahl` nach `$b`, führt den Rumpf aus, und bei `return` springt es mit dem Wert zurück in die Zeile des Aufrufs. **Code hinter einem ausgeführten `return` läuft nicht mehr.**

### A.3 Nur die Reihenfolge zählt

Die Namen der aktuellen und der formalen Parameter haben **nichts** miteinander zu tun. Der erste Wert im Aufruf landet im ersten Parameter, der zweite im zweiten, usw. (`namenSindSchallUndRauch.php`).

```php
function namenSindSchallUndRauch($ersterParameter, $zweiterParameter, $dritterParameter)
{
    $ergebnis1=$zweiterParameter/$ersterParameter;
    $ergebnis2=$dritterParameter/$ersterParameter;
    return $ergebnis1+$ergebnis2;
}
namenSindSchallUndRauch($haus, $boot, $pferd);    // 20/10 + 30/10 = 5
namenSindSchallUndRauch($pferd, $boot, $haus);    // 20/30 + 10/30 = 1
```

In der Klausur ist das die häufigste Fehlerquelle bei Funktionen mit vier Parametern (`berechneGebuehr($teamgroesse, $arbeitszeit, $entfernung, $lastenaufzug)`): Arbeitszeit und Entfernung vertauscht, und PHP merkt nichts, weil beides Zahlen sind.

### A.4 Funktion in eigene Datei auslagern

Wie in Kapitel 5: Funktion in `includes/mathematischeFunktionen.inc.php`, im Script `require_once("./includes/mathematischeFunktionen.inc.php");`. Danach ist die Funktion so benutzbar, als stünde sie in der Datei selbst (`funktionenMax2.php`).

### A.5 Mehrere return, kürzere Varianten

`mathematischeFunktionen2.inc.php` bis `5.inc.php` zeigen dieselbe Funktion immer kürzer:

```php
if ($a>=$b) { return $a; }      // Version 3: return beendet die Funktion,
return $b;                       //            hier kommt man nur an, wenn $a < $b

return $a>=$b ? $a : $b;         // Version 5: ternärer Operator aus Kapitel 6
```

Und am kürzesten: PHP hat die Funktion schon, `max($a, $b)`. Auch `is_numeric`, `number_format`, `round`, `floor` sind **eingebaute Funktionen** (S. 95). Du hast also die ganze Zeit schon Funktionen aufgerufen, nur nicht selbst geschrieben.

> **Selbst ausprobieren (10 Minuten):**
> 1. `http://localhost/iks/Kapitel9/Vorlesungsmaterialien/namenSindSchallUndRauch.php` → `1-> 5`, `2-> 5`, `3-> 1`.
> 2. In `funktionenMax2.php` statt `mathematischeFunktionen.inc.php` nacheinander `…2.inc.php` bis `…5.inc.php` einbinden. Jedes Mal 10, 1, 1.
> 3. **Beide** einbinden: `require_once` für `mathematischeFunktionen.inc.php` **und** `mathematischeFunktionen2.inc.php` → `Fatal error: Cannot redeclare berechneMaximum()`. Eine Funktion darf es nur **einmal** geben. In der Klausur passiert das, wenn dieselbe Funktion in zwei eingebundenen Dateien steht. Zurückändern.
> 4. In `funktionenMax2.php` einen Aufruf auf `berechneMaximum($ersteZahl)` kürzen → `Fatal error: Uncaught ArgumentCountError: Too few arguments to function berechneMaximum(), 1 passed … and exactly 2 expected`. Zurückändern.
> 5. In `funktionenMax1.php` die Zeile `return $max;` auskommentieren → alle drei Maxima sind **leer**. Ohne `return` gibt eine Funktion `null` zurück, und es kommt **keine** Fehlermeldung. Zurückändern.

---

## Teil B: Euro-Dollar als Funktion (S. 96–99)

`includes/euroDollarUmrechnung.inc.php`:

```php
function euroDollarUmrechnung($zielwaehrung, $betrag, $kurs)
{
    if (($zielwaehrung=="Dollar") || ($zielwaehrung=="dollar"))
    {
        $ergebnis=$kurs*$betrag;
    }
    elseif (($zielwaehrung=="Euro") || ($zielwaehrung=="euro"))
    {
        $ergebnis=(1/$kurs)*$betrag;
    }
    else
    {
        $ergebnis="Falsche Zielwährung";
    }
    return $ergebnis;
}
```

Diese eine Funktion nutzen jetzt **drei** Seiten: der Umrechner `euro3.php` und die Produktseiten `produkte1.php` (Euro → Dollar) und `produkte2.php` (Dollar → Euro):

```php
DEFINE('KURS', 1.1);
$dollarpreisSeife=euroDollarUmrechnung("Dollar", $europreisSeife, KURS);
```

Als aktueller Parameter darf also auch ein fester Wert (`"Dollar"`) oder eine Konstante (`KURS`) stehen.

`euroDollarUmrechnung2.inc.php` macht die Eingabe robuster, mit zwei eingebauten Funktionen:

```php
$zielwaehrung = trim(strtolower($zielwaehrung));   // " DOLLAR " → "dollar"
```

**Kritik, die für die Klausur zählt:** Die Funktion gibt mal eine Zahl, mal einen Text zurück, und `euro3.php` prüft hinterher mit `is_numeric`, was rauskam. Das ist umständlich und schützt nicht vor einem Kurs von 0. Besser ist die Reihenfolge aus Kapitel 8: **erst alle Eingaben prüfen, dann die Funktion aufrufen.** Dann gibt eine Rechenfunktion immer eine Zahl zurück.

> **Selbst ausprobieren (5 Minuten):**
> 1. `produkte1.php` → Seife 2 Euro = 2.2 Dollar, Zahnpasta 3.85, Zahnseide 4.95. `produkte2.php` → 1.8181818181818 Euro für 2 Dollar. (Formatieren mit `number_format` könntest du hier selbst ergänzen.)
> 2. In `produkte1.php` `KURS` auf `1.2` setzen → alle drei Dollarpreise ändern sich, an **einer** Stelle geändert.
> 3. `euro3.php`: Kurs 1.08, Zielwährung `DOLLAR`, Betrag 100 → „falsche Währung“. Dann in `euro3.php` auf `euroDollarUmrechnung2.inc.php` umstellen → jetzt 108.
> 4. Kurs **0**, Zielwährung `Euro` → `DivisionByZeroError`, obwohl die Funktion „geprüft“ wird. Siehe Kritik oben.

---

## Teil C: Wert- und Referenzparameter (S. 99–102)

### C.1 Call by value (Standard)

```php
function variablenAenderung($a)
{
    $a=2000;
}
$a=9;
variablenAenderung($a);
// $a ist immer noch 9
```

Die Funktion bekommt eine **Kopie** des Werts. Was sie mit der Kopie macht, sieht der Aufrufer nicht. Dass beide `$a` heißen, spielt keine Rolle (Teil A.3), es sind zwei verschiedene Variablen.

### C.2 Call by reference mit `&`

```php
function variablenAenderung(&$a)
{
    $a=2000;
}
$a=9;
variablenAenderung($a);
// $a ist jetzt 2000
```

Das **`&` im Kopf der Funktion** (nicht beim Aufruf) sagt: Keine Kopie, sondern die Variable des Aufrufers selbst. Jede Änderung in der Funktion wirkt draußen.

| | `return` | Referenzparameter `&` |
|---|---|---|
| Aufruf | `$brutto = berechneBrutto($netto);` | `berechneBrutto($netto, $brutto);` |
| Am Aufruf erkennbar, was rauskommt? | ja, steht links vom `=` | nein, man muss die Signatur kennen |
| Gefahr | keine | vertauschte Reihenfolge überschreibt die falsche Variable (Aufgabe 9.1) |
| In den Probeklausuren | **immer** | nie |

**Für die Klausur:** Ergebnis immer mit `return`. Referenzparameter musst du für Aufgabe 9.1 kennen und erkennen, aber nicht benutzen.

> **Selbst ausprobieren (5 Minuten):**
> 1. `variablenAenderung1.php` → 9 und 21. `variablenAenderung3.php` → 2000 und 2000.
> 2. In `variablenAenderung3.php` zusätzlich `variablenAenderung(5);` aufrufen → `Fatal error: Uncaught Error: variablenAenderung(): Argument #1 ($a) could not be passed by reference`. An einen Referenzparameter kannst du nur eine **Variable** übergeben, keinen festen Wert. Zurückändern.

---

## Teil D: Gültigkeitsbereich von Variablen (S. 102–105)

Im **Hauptprogramm** ist eine Variable überall bekannt, auch wenn sie in einer eingebundenen Datei steht (`variablenZuweisung1.php`). **In einer Funktion nicht:**

```php
$tester3=67;
function variablenGeltung()
{
    $tester5="Hier ein Wert!";
    echo "tester3: $tester3";        // Warning: Undefined variable $tester3
}
variablenGeltung();
echo "tester5: $tester5";            // Warning: Undefined variable $tester5
```

Eine Funktion ist eine **abgeschlossene Kiste**: Rein kommt nur, was über die Parameter übergeben wird, raus nur, was mit `return` zurückgegeben wird. Variablen, die in der Funktion entstehen (**lokale Variablen**), verschwinden nach dem `return`.

`global $tester3;` in der Funktion holt eine Variable des Hauptprogramms herein (`variablenZuweisung3.php`). Das Skript rät selbst davon ab (S. 105): Man sieht der Signatur nicht an, was die Funktion braucht, und sie läuft nur noch in Scripts, die zufällig eine Variable mit genau diesem Namen haben. **In der Klausur nie `global`.**

**Ausnahme, die das Skript nicht erwähnt: Konstanten** (`define`) sind **überall** bekannt, auch in Funktionen:

```php
define("MEHRWERTSTEUERSATZ", 19);
$y = 3;
function test()
{
    return MEHRWERTSTEUERSATZ;       // 19, geht
    // return $y;                    // Warning: Undefined variable $y
}
```

Deshalb dürfen Rechenfunktionen feste Preise und Sätze direkt als Konstante benutzen, so wie `berechneGebuehr` in Probeklausur 2. Eingaben des Benutzers dagegen kommen **immer** über Parameter.

> **Selbst ausprobieren (5 Minuten):**
> 1. `variablenZuweisung1.php` → alle vier Werte.
> 2. `variablenZuweisung2.php` → vier leere Werte in der Funktion und ein leerer `tester5`, dazu fünf `Warning: Undefined variable`. (Siehst du die Warnings nicht, ist `display_errors` aus, siehe `Einrichtung_Linux_Mint.md`.)
> 3. `variablenZuweisung3.php` → mit `global` sind tester1 bis 4 da, `tester5` fehlt draußen trotzdem.
> 4. In `variablenZuweisung2.php` ganz oben `define("TESTKONSTANTE", 42);` und in der Funktion `echo "Konstante: " . TESTKONSTANTE;` → 42, ohne `global`.

---

## Teil E: Was die Klausur zusätzlich braucht

### E.1 Regeln für eine gute Funktion

| Regel | Warum |
|---|---|
| Name = Verb + Was: `berechneEigenkapitalquote`, `istZahlImBereich`, `ermittlePreisProSeite` | sprechende Namen werden bewertet (Tipp 6) |
| Alle Eingaben über **Parameter**, Ergebnis mit **`return`** | Funktion ist unabhängig und wiederverwendbar |
| **Kein** `$_POST`, **kein** `$smarty`, **kein** `echo`, **kein** `global` in der Funktion | Lesen, Ausgeben und Template bleiben in `loesung.php`, die Funktion rechnet nur |
| **Kein** `define` in der Funktion | beim zweiten Aufruf `Warning: Constant … already defined`. Konstanten an den Anfang von `loesung.php` oder in eine Konstanten-Datei |
| Eine Funktion = eine Aufgabe, ein Rückgabewert | lieber `berechneDarlehensbetrag` und `berechneMonatlicheBelastung` als eine Funktion, die beides „irgendwie“ liefert |
| Rechenfunktion gibt **immer eine Zahl** zurück | Prüfen passiert vorher (Teil B, Kritik) |

### E.2 Prüffunktionen geben true oder false zurück

Das Muster `$eingabeKorrekt = $eingabeKorrekt && …` aus Kapitel 8 wird mit einer Funktion kurz und lesbar:

```php
function istZahlImBereich($wert, $minimum, $maximum)
{
    return is_numeric($wert) && $wert >= $minimum && $wert <= $maximum;
}
```

```php
$eingabeKorrekt = istZahlImBereich($anzahlSeiten, MIN_ANZAHL, MAX_ANZAHL_SEITEN);
$eingabeKorrekt = $eingabeKorrekt && istZahlImBereich($anzahlExemplare, MIN_ANZAHL, MAX_ANZAHL_EXEMPLARE);
```

Das ist fast wörtlich `Sicherheit::isNumericalInBoundary(...)` aus Probeklausur 2. `&&` wertet übrigens von links aus und hört beim ersten `false` auf, deshalb kommt `is_numeric` zuerst: Bei `""` wird gar nicht erst mit `>=` verglichen.

### E.3 Dateiaufbau ab jetzt

```
AufgabeX/
├── loesung.php                       Konstanten, Smarty, lesen, prüfen, Funktionen aufrufen, assign, display
├── includes/
│   ├── startTemplate.inc.php
│   ├── pruefFunktionen.inc.php       istZahlImBereich, …
│   └── darlehenFunktionen.inc.php    berechne…, ermittle…
└── smarty/templates/loesung.tpl
```

In Kapitel 10 wird aus `pruefFunktionen.inc.php` die Klasse `Sicherheit` im Ordner `klassen/`, aus `darlehenFunktionen.inc.php` eine Klasse `Darlehen`. Aus `istZahlImBereich($x, …)` wird dann `Sicherheit::istZahlImBereich($x, …)`. Wenn deine Funktionen jetzt sauber sind (E.1), ist das in fünf Minuten erledigt.

Dozenten-Tipp 11 gilt schon jetzt sinngemäß: **Binde nur Dateien ein, aus denen du auch etwas benutzt.**

---

## Teil F: Aufgaben

Alle Lösungen in `~/eclipse-workspace/IKSY1/Kapitel9/Loesungen/`, jede Aufgabe in einem eigenen Ordner, im Klausur-Aufbau wie in Kapitel 8 (eine `loesung.php`, ein Template `smarty/templates/loesung.tpl`, kein `echo` in der PHP-Datei). Kommentare sind keine Pflicht. Bewertet wird wie in der Klausur, dazu jetzt: **Funktionen in `includes/…Funktionen.inc.php`, sprechende Funktionsnamen, Regeln aus E.1.**

Neuen Aufgabenordner einrichten (am Beispiel 9.1):

```bash
cd ~/eclipse-workspace/IKSY1/Kapitel9/Loesungen
mkdir -p Aufgabe_9_1/includes Aufgabe_9_1/smarty/templates Aufgabe_9_1/smarty/templates_c
cp ../../Kapitel8/Loesungen/Aufgabe_8_1/{composer.json,composer.lock,formular.css} Aufgabe_9_1/
cp ../../Kapitel8/Loesungen/Aufgabe_8_1/includes/startTemplate.inc.php Aufgabe_9_1/includes/
cd Aufgabe_9_1
composer install
chmod 777 smarty/templates_c
```

Dann in `includes/startTemplate.inc.php` den `$ROOT_DIR` auf `/var/www/html/iks/Kapitel9/Loesungen/Aufgabe_9_1` setzen. Aufruf: `http://localhost/iks/Kapitel9/Loesungen/Aufgabe_9_1/loesung.php`

### Aufgabe 9.1 (Skript): Vier Netto-Brutto-Funktionen

> Schreiben Sie vier Funktionen, die zu einem eingegebenen Nettobetrag einen Bruttobetrag ausgeben. Zwei Funktionen sollen das Ergebnis mittels des return-Statements zurückgeben. Bei der ersten Implementierung benennen Sie den Übergabeparameter für den Nettobetrag mit dem Namen dieser Variablen im Hauptprogramm. Bei der zweiten Realisierung wählen Sie einen anderen Namen. Die beiden anderen Funktionen sollen das Ergebnis über die Parameterliste zurückgeben. Realisieren Sie dies zunächst fehlerhaft, indem Sie das „kaufmännische Und“ in der Parameterliste weglassen. Im nächsten Schritt programmieren Sie eine korrekte Lösung. Rufen Sie die vier Funktionen aus dem Hauptprogramm in korrekter Form auf. Zum Schluss rufen Sie die korrekte Funktion mit den zwei Übergabeparametern falsch auf, indem Sie beim Aufruf die Übergabeparameter in falscher Reihenfolge angeben. Stellen Sie alle Ergebnisse im Browserfenster dar. Den umzurechnenden Nettobetrag können Sie im Hauptprogramm einer Variablen direkt zuweisen, z. B. `$netto=1000;`

Ordner `Aufgabe_9_1/` mit `loesung.php`, `includes/startTemplate.inc.php`, `includes/bruttoFunktionen.inc.php`, `smarty/templates/loesung.tpl`. **Ohne Formular**: `$netto = 1000;` steht fest in `loesung.php`.

- Konstante für den Mehrwertsteuersatz (19), die Funktionen benutzen sie direkt (Teil D, Konstanten).
- Funktion 1 mit Parameter `$netto`, Funktion 2 mit anderem Namen (z. B. `$nettobetrag`), beide mit `return`.
- Funktion 3: zwei Parameter (Netto, Brutto), **ohne** `&`, setzt den Brutto-Parameter, kein `return`.
- Funktion 4: wie 3, **mit** `&`.
- Vor dem Aufruf von Funktion 3 die Ergebnisvariable auf `0` setzen, sonst gibt es `Warning: Undefined variable` beim Anzeigen.
- **Ganz zum Schluss** der vertauschte Aufruf von Funktion 4: eine neue Variable, z. B. `$bruttoVertauscht = 0;`, dann `funktion4($bruttoVertauscht, $netto);`. Danach **auch `$netto` noch einmal** ans Template übergeben.
- Das Template zeigt eine Tabelle mit sechs Zeilen: Netto vorher, Ergebnis 1 bis 4, Ergebnis vertauscht, Netto nachher. Alle Beträge mit `number_format`.

Erwartete Ausgabe:

| Zeile | Wert | Warum |
|---|---|---|
| Netto vorher | 1.000,00 € | |
| Funktion 1 (return, gleicher Name) | 1.190,00 € | |
| Funktion 2 (return, anderer Name) | 1.190,00 € | Namen sind Schall und Rauch |
| Funktion 3 (ohne `&`) | **0,00 €** | Kopie geändert, Original bleibt 0 |
| Funktion 4 (mit `&`) | 1.190,00 € | |
| Vertauscht: Ergebnis | **0,00 €** | |
| Vertauscht: **Netto nachher** | **0,00 €** | Die Funktion hat `0 × 1,19` in `$netto` geschrieben, weil `$netto` jetzt am Referenzparameter steht |

Die letzte Zeile ist der Grund, warum es in der Klausur nur `return` gibt.

### Aufgabe 9.2 (Skript): Darlehen mit Funktionen

> Sie sollen für eine Bank die Errechnung von Darlehenskonditionen für Kunden der Bank über das Internet ermöglichen. Eingegeben werden soll das Eigenkapital und der Preis der Immobilie, die gekauft werden soll. Der Zinssatz ist 5 %, die Tilgung 1 %. Das Programm soll die monatliche Belastung ausgeben. Wenn die Eigenkapitalquote des Kunden kleiner als 30 % ist, soll keine Berechnung durchgeführt werden und anstelle dessen ausgegeben werden, dass die Bank Immobilienerwerb mit einer so geringen Eigenkapitalquote nicht finanziert.
> **Berechnung der Eigenkapitalquote und Berechnung der monatlichen Belastung sollen in eigene Funktionen ausgelagert werden!**

Das ist deine 8.1 mit Funktionen. Ordner `Aufgabe_9_2/`: Kopier deine `Aufgabe_8_1` (ohne `vendor/` und `templates_c/`-Inhalt, dann `composer install`, `chmod`, `$ROOT_DIR`).

- `includes/darlehenFunktionen.inc.php` mit mindestens
  - `berechneEigenkapitalquote($eigenkapital, $immobilienpreis)`
  - `berechneDarlehensbetrag($immobilienpreis, $eigenkapital)`
  - `berechneMonatlicheBelastung($darlehensbetrag, $zinssatzProzent, $tilgungProzent)`
- `includes/pruefFunktionen.inc.php` mit `istZahlImBereich($wert, $minimum, $maximum)` (E.2). Für die Untergrenze ohne Obergrenze darfst du eine zweite Funktion `istZahlAbMinimum($wert, $minimum)` schreiben, oder du definierst eine sinnvolle Obergrenze als Konstante (z. B. `MAX_IMMOBILIENPREIS` 100.000.000) und gibst sie auch als `max` ins Formular.
- `loesung.php`: Konstanten oben, **keine Rechnung mehr direkt in `loesung.php`**, nur Aufrufe. Zinssatz und Tilgung als Parameter übergeben, nicht in der Funktion fest eintippen. Alles andere (GET/POST, Prüfung, Ablehnung, ein `display`) wie in 8.1.
- Template: unverändert aus 8.1.

Testwerte (dieselben wie 8.1, das ist dein Regressionstest):

| Immobilienpreis | Eigenkapital | Ausgabe |
|---|---|---|
| 300000 | 90000 | Quote 30,00 %, Darlehen 210.000,00 €, **1.050,00 €** |
| 250000 | 100000 | Quote 40,00 %, Darlehen 150.000,00 €, **750,00 €** |
| 300000 | 60000 | **Ablehnung** (20,00 %) |
| 300000 | 89999.99 | **Ablehnung** |
| 200000 | 250000 | **Unzulässige Eingabe** |
| leer (mit `novalidate`) | 50000 | **Unzulässige Eingabe**, kein Absturz |
| 0 (mit `novalidate`) | 0 | **Unzulässige Eingabe**, kein `DivisionByZeroError` |

Gegenprobe Wiederverwendung: Ruf in `loesung.php` zusätzlich `berechneMonatlicheBelastung($darlehensbetrag, ZINSSATZ_PROZENT + 1, TILGUNG_PROZENT)` auf und zeig im Template eine Zeile „bei 1 % mehr Zins: …“ (300000/90000 → **1.225,00 €**). Eine Zeile Aufruf, keine neue Rechnung. Danach darf die Zeile bleiben oder wieder raus.

### Aufgabe 9.3 (Zusatz, klausurnah): Copy-Shop mit Funktionen

Deine 8.5 umgebaut, sodass `loesung.php` nur noch liest, prüft, aufruft und übergibt. Ordner `Aufgabe_9_3_copyshop/`, Kopie von `Aufgabe_8_5_copyshop`.

- `includes/pruefFunktionen.inc.php`: `istZahlImBereich` (dieselbe Datei wie in 9.2, einfach kopieren) und `istGueltigesFormat($format)`, gibt `true` für `"A4"` und `"A3"` zurück, sonst `false`.
- `includes/copyshopFunktionen.inc.php`:
  - `ermittlePreisProSeite($format)` mit `switch` (wird nur nach erfolgreicher Prüfung aufgerufen, braucht also keinen Fehlerfall mehr, aber ein `default` schadet nicht)
  - `berechneKopierkosten($anzahlSeiten, $anzahlExemplare, $preisProSeite)` inklusive Mengenrabatt
  - `berechneBindungskosten($anzahlExemplare, $bindungGewuenscht)`
  - `berechneMehrwertsteuer($nettobetrag)`
  - `istRabattGewaehrt($anzahlSeiten, $anzahlExemplare)` (die Kopierkosten-Funktion darf diese Funktion selbst aufrufen: eine Funktion darf andere Funktionen aufrufen)
- Konstanten bleiben in `copyshopKonstanten.inc.php`.

Testwerte: **genau die Tabelle aus 8.5** (Kapitel_08, Teil G). Jeder Wert muss gleich bleiben, inklusive `A5` per F12 und `501` mit `novalidate`.

### Aufgabe 9.4 (Klausur-Vorlage, Schritt 3): Funktionssammlung anlegen

In deiner `Klausur_Vorlage`:

1. `includes/pruefFunktionen.inc.php` mit `istZahlImBereich` anlegen und in `loesung.php` die Prüfung damit schreiben.
2. `includes/berechnungsFunktionen.inc.php` mit einer Platzhalter-Funktion `berechneErgebnis($zahl)`, die `$zahl * 2` zurückgibt. `loesung.php` ruft nur noch diese Funktion auf.
3. Test wie 8.6: 21 → 42, mit `novalidate` leer → „Unzulässige Eingabe.“

In der Klausur benennst du dann nur noch die Funktion um und schreibst die echte Rechnung hinein. In Kapitel 10 wandern beide Dateien als Klassen nach `klassen/`.

---

Wenn du fertig bist (gern auch nach jeder Aufgabe), schreib mir „fertig“ im Thread. Ich lese deine Dateien direkt in `~/eclipse-workspace/IKSY1/Kapitel9/Loesungen/` und `Klausur_Vorlage/`, korrigiere sie und erkläre Fehler. Erst danach gibt es eine Musterlösung.

---

## Spickzettel Kapitel 9 (für die Klausur-Mappe)

### Funktion schreiben und aufrufen

```php
// includes/darlehenFunktionen.inc.php
<?php
    function berechneMonatlicheBelastung($darlehensbetrag, $zinssatzProzent, $tilgungProzent)
    {
        return $darlehensbetrag * ($zinssatzProzent + $tilgungProzent) / 100 / MONATE_PRO_JAHR;
    }
?>
```

```php
// loesung.php
require_once("./includes/darlehenFunktionen.inc.php");
...
$monatlicheBelastung = berechneMonatlicheBelastung($darlehensbetrag, ZINSSATZ_PROZENT, TILGUNG_PROZENT);
```

Reihenfolge der Parameter beim Aufruf = Reihenfolge im Kopf. Namen egal.

### Prüffunktion

```php
function istZahlImBereich($wert, $minimum, $maximum)
{
    return is_numeric($wert) && $wert >= $minimum && $wert <= $maximum;
}

$eingabeKorrekt = istZahlImBereich($eingabe, MIN_GRENZE, MAX_GRENZE);
$eingabeKorrekt = $eingabeKorrekt && istZahlImBereich($eingabe2, MIN_GRENZE, MAX_GRENZE2);
```

### Regeln

| Ja | Nein |
|---|---|
| Eingaben über Parameter | `$_POST`, `global` in der Funktion |
| Ergebnis mit `return` | `&`-Referenzparameter, `echo`, `$smarty` in der Funktion |
| Konstanten benutzen | `define` in der Funktion |
| erst prüfen, dann rechnen | Text statt Zahl zurückgeben, um Fehler zu melden |
| nur Dateien einbinden, die benutzt werden | dieselbe Funktion in zwei eingebundenen Dateien |

### Wert vs. Referenz

```php
function f($a)  { $a = 2000; }    // Kopie: draußen unverändert
function g(&$a) { $a = 2000; }    // Original: draußen 2000
```

### Fehlermeldungen

| Meldung / Symptom | Ursache |
|---|---|
| `Fatal error: Cannot redeclare berechne…()` | Funktion zweimal definiert (zwei Dateien mit derselben Funktion, oder `require` statt `require_once`) |
| `Uncaught ArgumentCountError: Too few arguments to function …` | Aufruf mit zu wenigen Parametern |
| `Uncaught Error: Call to undefined function berechne…()` | Datei nicht eingebunden oder Name falsch geschrieben |
| `Warning: Undefined variable $…` **in der Funktion** | Variable des Hauptprogramms benutzt statt als Parameter übergeben |
| `Warning: Constant … already defined` | `define` in einer Funktion, die mehrmals läuft |
| `Argument #1 (…) could not be passed by reference` | fester Wert an einen `&`-Parameter übergeben |
| Ergebnis leer, **keine** Fehlermeldung | `return` vergessen |
| Ergebnis falsch, keine Fehlermeldung | Parameter beim Aufruf vertauscht (Signatur nachlesen, Xdebug: Haltepunkt in der Funktion, **F5** springt beim Aufruf hinein, in **Variables** siehst du, welcher Wert in welchem Parameter gelandet ist) |
