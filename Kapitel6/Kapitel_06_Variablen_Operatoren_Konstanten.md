# Kapitel 6: Grundsätzliches – Kommentare, Variablen, Operatoren, Konstanten

Skript `phpScript.pdf`, Seiten 50–60 · Beispiele: `Vorlesungen/6` · Aufgaben 6.1–6.4 (+ 6.5 klausurnah)

So gehst du vor: Kopiere zuerst die Beispiele (Vorbereitung). Lies dann Teil A bis E und **tippe die PHP-Beispiele selbst ab**. Die „Selbst ausprobieren“-Schritte zeigen dir die Fehler, die du in der Klausur sonst erst unter Zeitdruck kennenlernst. Danach löst du in Teil F die Aufgaben.

**Warum dieses Kapitel wichtig ist:** Zwei Bewertungskriterien des Dozenten stecken direkt in diesem Kapitel: **„Konstanten, wo gefordert und sinnvoll“** und **„sprechende Namen für Variablen, Konstanten, Klassen, Funktionen“**. So sieht das in der Musterlösung von Probeklausur 2 aus:

```php
DEFINE("MIN_GRENZE", 1);
DEFINE("MAX_GRENZE_ENTFERNUNG", 500);
DEFINE("MAX_GRENZE_ARBEITSZEIT", 48);
...
$correct = $correct && Sicherheit::isNumericalInBoundary($entfernung, MIN_GRENZE, MAX_GRENZE_ENTFERNUNG);
```

und in der Berechnungsklasse:

```php
DEFINE('PREIS_KLEIN', 50);
DEFINE('PREIS_KILOMETER', 0.34);
...
$preis = PREIS_KILOMETER * $entfernung + $basispreis * $arbeitszeit;
```

Jeder Preis, jede Grenze, jeder Prozentsatz aus der Aufgabenstellung wird eine **Konstante**. Eine Zahl wie `0.34` mitten in der Rechnung kostet Punkte. Außerdem siehst du oben schon `&&` (Teil D) und gleich bei Kapitel 8 den Vergleich `==`.

**JavaScript:** Fast alle Beispiele des Skripts sind hier JavaScript. Du schaust sie nur an und schreibst in Aufgabe 6.2 die PHP-Fassung.

---

## Vorbereitung

1. Lege in Eclipse im Projekt `IKSY1` den Ordner `Kapitel6/` an, darin `Vorlesungsmaterialien/` und `Loesungen/`.
2. Kopiere den kompletten Inhalt von `Vorlesungen/6/` (11 Dateien) nach `Kapitel6/Vorlesungsmaterialien/`. Kopiere außerdem `formular.css` aus `Kapitel5/Vorlesungsmaterialien/` dazu.
3. In `konstante.html` steht `href="../css/formular.css"`. Ändere das wie in Kapitel 4 und 5 auf `href="formular.css"`.
4. Aufrufen im Browser: `http://localhost/iks/Kapitel6/Vorlesungsmaterialien/…`

Fehler und Ungenauigkeiten in den Original-Dateien, damit du dich nicht wunderst:

| Datei | Was nicht stimmt |
|---|---|
| `tenaer.html` | Der Kommentar `// k ist 6` ist **falsch**. `i` und `j` sind beide 2, also ist `k` gleich **2**. |
| `konstante.php` | `MEHRWERSTEUERSATZ` (es fehlt ein T). Funktioniert, weil der Tippfehler überall gleich ist, ist aber kein guter Name. Außerdem stehen die Werte in Anführungszeichen (`"1.19"`). PHP rechnet trotzdem richtig, weil es den String umwandelt. Schreib Zahlen ohne Anführungszeichen. |
| `konstante2.html` | Mehrwertsteuer `1.21` statt `1.19`. Und im Skript steht danach, man ändere die Umsatzsteuer über die Zeile `GEWINNSPANNE`. Das ist ein Versehen, gemeint ist die Zeile `MEHRWERTSTEUER`. |
| `kommentar.html` | Im Kopfkommentar steht `Dateiname: addition2.html`, die Datei heißt aber `kommentar.html`. Genau so veralten Kommentare, wenn man Dateien kopiert. |
| `plusOperator.php` | Bricht in PHP 8.3 **schon in der ersten Rechnung ab** (siehe Teil C.3). Die Abbildung 6.2 im Skript stammt aus einer älteren PHP-Version. |

---

## Teil A: Kommentare (S. 50–51)

PHP kennt dieselben zwei Kommentarformen wie JavaScript, dazu kommt der HTML-Kommentar außerhalb von `<?php … ?>`:

```php
<?php
    /*  Autor: Abdulaziz Srour
        Datum: 07.11.2026
        Zweck: Addition zweier Zahlen aus einem Formular
        Dateiname: kommentar.php
    */
    $ersterSummand = $_POST['ersterSummand'];     // aus dem Formular, ist ein String
    // Addieren: PHP wandelt die Strings für + automatisch in Zahlen um
    $summe = $ersterSummand + $zweiterSummand;
?>
<!-- HTML-Kommentar: landet im Quelltext beim Browser -->
```

| Form | Wirkung | Wofür |
|---|---|---|
| `/* … */` | alles dazwischen, auch über mehrere Zeilen | Kopf der Datei: Autor, Datum, Zweck, Dateiname |
| `// …` | bis zum Zeilenende | einzelne Schritte erklären |
| `<!-- … -->` | nur im HTML-Teil | wird **an den Browser geschickt**, jeder kann ihn mit Strg+U lesen |

Was ein guter Kommentar ist:

- Er sagt **warum** oder **was fachlich passiert**, nicht was ohnehin dasteht. `$i++; // i um 1 erhöhen` ist überflüssig. `$summe = 0; // muss vor der Schleife 0 sein, sonst Warning` hilft.
- In der Klausur reicht pro Datei ein Kopfkommentar (Dateiname, Zweck) und ein kurzer Kommentar über jedem Block („Eingaben prüfen“, „Preis berechnen“, „PDF ausgeben“). Mehr kostet Zeit.

> **Selbst ausprobieren (2 Minuten):** Schreib in eine beliebige `.php`-Datei aus Kapitel 5 oberhalb von `<?php` den Kommentar `<!-- Passwort: geheim -->` und innerhalb von `<?php` die Zeile `// Passwort: geheim2`. Lade die Seite und drück Strg+U. Den HTML-Kommentar siehst du, den PHP-Kommentar nicht. **Interna nie in HTML-Kommentare schreiben.** Danach beide Zeilen wieder löschen.

> **Eclipse-Tipp:** Zeilen markieren und **Strg+7** (bzw. Strg+/) kommentiert sie mit `//` aus oder wieder ein. Praktisch beim Fehlersuchen in der Klausur.

---

## Teil B: Variablen (S. 51–53)

### B.1 Beispiel 6.3 – abtippen

`deklarationUndZuweisung.php` liegt schon in deinem Ordner. Öffne sie, lies sie und ruf sie auf. Das Wichtigste daraus:

- In PHP gibt es **keine Deklaration**. Eine Variable entsteht, wenn ihr zum ersten Mal ein Wert zugewiesen wird.
- Der **Typ wechselt** mit dem Wert: `$x = 4.7;` ist ein Float, danach `$x = "Datum";` ein String.
- Werte aus `$_POST` sind **immer Strings**, auch wenn im Formular `type="number"` steht. Dass `$_POST['bisZu'] + 1` trotzdem klappt, liegt daran, dass PHP Zahl-Strings beim Rechnen umwandelt (Teil C.3).

### B.2 Die vier Datentypen

| Typ | Beispiel | Achtung |
|---|---|---|
| Integer | `$anzahlExemplare = 3;` | |
| Float | `$preisProSeite = 0.05;` | **Punkt** statt Komma. `0,05` ist ein Syntaxfehler. |
| Boolean | `$mitBindung = true;` | `echo false;` gibt **nichts** aus, `echo true;` gibt `1` aus (wichtig für Aufgabe 6.3) |
| String | `$nachname = "Srour";` | |

Mit `var_dump($variable);` siehst du Typ **und** Wert, z. B. `float(0.05)` oder `string(1) "6"`. Das ist dein wichtigstes Werkzeug, wenn eine Rechnung komisch aussieht.

### B.3 Regeln für Namen

- `$` + Buchstabe oder `_`, danach Buchstaben, Ziffern, `_`. **Keine Umlaute**, kein `-`, kein Leerzeichen.
- Groß-/Kleinschreibung zählt: `$summe` und `$Summe` sind zwei verschiedene Variablen. Ein Tippfehler erzeugt also einfach eine **neue, leere** Variable → `Warning: Undefined variable $Summe`.
- **Sprechend:** `$preisProSeite`, `$anzahlExemplare`, `$gesamtpreis`. Schreibweise wie im Skript und in den Probeklausuren: **camelCase** (erstes Wort klein, jedes weitere groß). Einzige Ausnahme: Schleifenvariablen heißen `$i`, `$j`, `$k`.

| schlecht | gut |
|---|---|
| `$a`, `$b`, `$c` | `$minuend`, `$subtrahend`, `$differenz` |
| `$x = $p * 0.19;` | `$mehrwertsteuer = $nettopreis * MEHRWERTSTEUERSATZ;` |
| `$preis_pro_seite` (geht, aber nicht der Stil des Kurses) | `$preisProSeite` |
| `$größe` (Umlaut, Fehler) | `$groesse` |

---

## Teil C: Operatoren (S. 53–56)

### C.1 Zuweisung

`=` heißt **„bekommt den Wert“**, nicht „ist gleich“. Erst wird die rechte Seite ausgerechnet, dann überschreibt das Ergebnis die Variable links. Deshalb ist `$summe = $summe + $i;` kein Widerspruch.

### C.2 Arithmetische Operatoren und Vorrang

| Operator | Bedeutung | Beispiel | Ergebnis |
|---|---|---|---|
| `+` `-` `*` `/` | Grundrechenarten | `7 / 2` | `3.5` (PHP gibt bei Bedarf einen Float zurück) |
| `%` | Rest der ganzzahligen Division (Modulo) | `7 % 3` | `1` |
| `**` | Potenz (nicht im Skript, aber praktisch) | `2 ** 3` | `8` |
| `intdiv(a, b)` | ganzzahlige Division | `intdiv(7, 2)` | `3` |

Vorrang: **Klammern → `**` → `*` `/` `%` → `+` `-`**, gleicher Rang von links nach rechts. `2 + 3 * 4` ist 14, `(2 + 3) * 4` ist 20, `10 - 4 - 3` ist 3.

Kurzschreibweisen:

```php
$gesamtpreis += $bindungskosten;   // $gesamtpreis = $gesamtpreis + $bindungskosten;
$betrag -= $rabatt;                // $betrag = $betrag - $rabatt;
$betrag *= 2;   $betrag /= 2;   $rest %= 4;
$i++;   $i--;                      // um 1 erhöhen / verringern
$text .= " Euro";                  // String anhängen (C.3)
```

> **Selbst ausprobieren:** Rechne im Kopf, was am Ende ausgegeben wird, und prüfe es dann mit einer kleinen Datei `Kapitel6/Vorlesungsmaterialien/test.php`:
> ```php
> <?php
>     $wert = 10;  $wert += 5;  $wert *= 2;  $wert -= 4;  $wert /= 2;  $wert %= 4;
>     echo $wert;
> ?>
> ```
> (Auflösung: 10 → 15 → 30 → 26 → 13 → **1**.)

### C.3 `+` und `.` bei Strings, Beispiel 6.6

In JavaScript verkettet `+` Strings. In PHP **nie**. PHP verkettet mit dem **Punkt**:

```php
$ausgabeText = "Die Gebühren betragen " . $betrag . " Euro.";
```

Die Regel in PHP 8.3 (dein System):

| Ausdruck | Ergebnis |
|---|---|
| `"ab" . "cd"` | `"abcd"` |
| `"ab" . 5` | `"ab5"` |
| `"6" . 5` | `"65"` |
| `"6" + 5` | `11` (Zahl-String wird umgewandelt) |
| `"ab" + "cd"` | **`Fatal error: Uncaught TypeError: Unsupported operand types: string + string`** |
| `"ab" + 5` | **`Fatal error: Uncaught TypeError: Unsupported operand types: string + int`** |

> **Selbst ausprobieren:** Ruf `plusOperator.php` auf. Du siehst **nur** die Fehlermeldung, nicht einmal `ergebnis1`, denn ein Fatal error bricht die Seite sofort ab. Kommentiere die beiden Zeilen mit `// Fehler!` (und das jeweils folgende `echo`) mit `//` aus und lade neu. Jetzt kommen `ergebnis2: abcd`, `ergebnis4: ab5`, `ergebnis5: 65`, `ergebnis6: 11`. Das ist auch gleich deine Übung zu Teil A.

### C.4 Variablen und Konstanten in Strings

```php
echo "Gesamtpreis: $gesamtpreis Euro";                 // Variable in "…" wird ersetzt
echo 'Gesamtpreis: $gesamtpreis Euro';                 // in '…' NICHT: gibt $gesamtpreis wörtlich aus
echo "Preis pro Seite: PREIS_PRO_SEITE Euro";          // Konstante wird NIE ersetzt!
echo "Preis pro Seite: " . PREIS_PRO_SEITE . " Euro";  // richtig: mit Punkt verketten
```

Die dritte Zeile ist der häufigste Konstanten-Fehler. Konstanten haben kein `$`, darum erkennt PHP sie im String nicht.

### C.5 Vergleichsoperatoren (S. 56)

| Operator | Bedeutung |
|---|---|
| `==` | gleich (Typ egal: `"1" == 1` ist `true`) |
| `===` | gleich **und** gleicher Typ (`"1" === 1` ist `false`) |
| `!=` | ungleich |
| `<` `>` `<=` `>=` | kleiner, größer, kleiner gleich, größer gleich |

Das Ergebnis ist immer `true` oder `false`. Richtig gebraucht werden die Vergleiche ab Kapitel 8 im `if`. **Vorsicht:** `=` statt `==` ist kein Vergleich, sondern eine Zuweisung, und das ist kein Syntaxfehler, sondern ein stiller Logikfehler.

---

## Teil D: Logische Operatoren und der ternäre Operator (S. 56–58)

### D.1 `&&`, `||`, `!`

| Operator | Ergebnis `true`, wenn … |
|---|---|
| `$a && $b` | beide `true` sind |
| `$a \|\| $b` | mindestens einer `true` ist |
| `!$a` | `$a` `false` ist |

Vorrang: `!` vor `&&` vor `||`. Also ist `true || false && false` gleich `true || (false && false)` = `true`. Im Zweifel Klammern setzen.

So prüft die Klausur alle Eingaben auf einmal (Probeklausur 2):

```php
$correct = Sicherheit::isCorrectNumericalString($kundennummer);
$correct = $correct && Sicherheit::isNumericalInBoundary($entfernung, MIN_GRENZE, MAX_GRENZE_ENTFERNUNG);
```

Sobald **eine** Prüfung `false` liefert, bleibt `$correct` für immer `false`. Genau das ist die und-Wertetabelle, die du in Aufgabe 6.3 verifizierst.

PHP kennt auch `and` und `or` als Wörter. **Nimm sie nicht**: Sie haben einen niedrigeren Vorrang als `=`. `$x = true and false;` setzt `$x` auf `true`. Immer `&&` und `||`.

### D.2 Der ternäre Operator `? :` (Beispiel 6.7)

```php
$ergebnis = (Bedingung) ? WertWennTrue : WertWennFalse;
```

```php
$rabattProzent = ($anzahlExemplare >= MINDESTANZAHL_RABATT) ? RABATT_PROZENT : 0;
$textWahrheitswert = $wert ? "true" : "false";     // macht true/false lesbar ausgebbar
```

Das ist ein kleines `if … else`, das einen **Wert** liefert. Für zwei Möglichkeiten ist es ideal, für mehr nimmst du ab Kapitel 8 `if`/`elseif`.

---

## Teil E: Konstanten (S. 58–60), das Wichtigste des Kapitels

### E.1 Warum

Im Beispiel 6.8 steht zweimal `1.19`: einmal als Gewinnspanne, einmal als Mehrwertsteuer. Ändert sich die Mehrwertsteuer, findest du mit „Suchen und Ersetzen“ beide Stellen und änderst versehentlich auch die Gewinnspanne. Mit Konstanten steht jeder Wert **einmal** mit **Namen** im Programm.

### E.2 Beispiel 6.9/6.10 – abtippen, aber verbessert

Tippe `konstante.php` **neu** in `Kapitel6/Vorlesungsmaterialien/konstante.php` (die Kopie überschreiben), mit Kommentaren und sauberen Namen:

```php
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- konstante.php -->
    <title>Konstantendemonstration</title>
</head>
<body>
    <h2>
        Konstantendemonstration
    </h2>
    <?php
        // Konstanten: jeder feste Wert genau einmal, mit Namen
        define("MEHRWERTSTEUERSATZ", 1.19);
        define("GEWINNSPANNE", 1.19);

        // Eingabe aus dem Formular konstante.html
        $einkaufspreis = $_POST['einkaufspreis'];

        // Berechnung
        $nettoVerkaufspreis = GEWINNSPANNE * $einkaufspreis;
        $bruttoVerkaufspreis = MEHRWERTSTEUERSATZ * $nettoVerkaufspreis;

        // Ausgabe: Konstanten und Variablen
        echo "Netto-Verkaufspreis: $nettoVerkaufspreis<br>";
        echo "Brutto-Verkaufspreis: $bruttoVerkaufspreis<br>";
        echo "Gerechnet mit Mehrwertsteuerfaktor " . MEHRWERTSTEUERSATZ;
    ?>
</body>
</html>
```

Test: `konstante.html` öffnen, 100 eingeben → Netto `119`, Brutto `141.61`.

### E.3 Die Regeln

```php
define("PREIS_PRO_SEITE", 0.05);      // Variante 1: define (so in allen Musterlösungen)
const PREIS_BINDUNG_PRO_EXEMPLAR = 2.5;  // Variante 2: const (geht auch, nur auf oberster Ebene)

$kopierkosten = PREIS_PRO_SEITE * $anzahlSeiten;   // ohne $ benutzen
```

1. **Kein `$`.** Weder beim Definieren noch beim Benutzen.
2. **GROSSBUCHSTABEN_MIT_UNTERSTRICH.** Nicht vorgeschrieben, aber überall so üblich, und der Dozent bewertet sprechende Namen.
3. **Zahlen ohne Anführungszeichen**: `define("RABATT_PROZENT", 15);`, nicht `"15"`.
4. **Nie links von `=`.** `PREIS_PRO_SEITE = 0.1;` → `Parse error: syntax error, unexpected token "="`.
5. **Einmal definieren.** Ein zweites `define` mit demselben Namen gibt `Warning: Constant PREIS_PRO_SEITE already defined` und der **alte Wert bleibt**. (Darum gehört `define` in eine Datei, die mit `require_once` eingebunden wird, nicht in eine Funktion, die mehrmals aufgerufen wird.)
6. **Nicht in `"…"` ersetzt** (Teil C.4).
7. Eine Konstante, die es nicht gibt (Tippfehler), ist ein `Fatal error: Uncaught Error: Undefined constant "PREIS_PRO_SETE"`. Das ist gut: Der Fehler fällt sofort auf, anders als bei einer falsch geschriebenen Variable.

`define` oder `const`? In der Klausur **`define`**, so steht es in allen Musterlösungen und im Skript. In Kapitel 10 kommt `const` innerhalb von Klassen dazu.

### E.4 Was wird in der Klausur eine Konstante?

Alles, was in der Aufgabenstellung als **fester Wert** steht und sich **nicht** durch die Eingabe des Benutzers ändert:

| Aufgabenstellung sagt | Konstante |
|---|---|
| „Ein kleines Team kostet 50 € pro Stunde“ | `define("PREIS_KLEIN", 50);` |
| „Die Entfernung darf zwischen 1 und 500 km liegen“ | `define("MIN_GRENZE", 1);` `define("MAX_GRENZE_ENTFERNUNG", 500);` |
| „Ab 10 Exemplaren gibt es 5 % Rabatt“ | `define("MINDESTANZAHL_RABATT", 10);` `define("RABATT_PROZENT", 5);` |
| Zeichensatz fürs PDF | `define("ENCODING", "UTF-8");` |

**Keine** Konstante: Eingaben aus dem Formular und alles, was daraus berechnet wird. Das sind Variablen.

> **Selbst ausprobieren (die Fehler aus E.3):** In deiner neuen `konstante.php`:
> 1. Schreib unter die beiden `define` die Zeile `GEWINNSPANNE = 2;` → Parse error, die Seite bleibt leer. Wieder löschen.
> 2. Schreib stattdessen `define("GEWINNSPANNE", 2);` darunter → Warning, gerechnet wird weiter mit 1.19. Wieder löschen.
> 3. Schreib in der Rechnung `GEWINSPANNE` (ein N weniger) → Fatal error `Undefined constant`. Zurück.
> 4. Ändere die letzte Ausgabe zu `echo "Gerechnet mit Mehrwertsteuerfaktor MEHRWERTSTEUERSATZ";` → im Browser steht das Wort statt der Zahl. Zurück.

---

## Teil F: Deine Aufgaben

**Regeln für alle Aufgaben:**

- Alles kommt nach `~/eclipse-workspace/IKSY1/Kapitel6/Loesungen/`. UTF-8, Aufruf über `http://localhost/iks/Kapitel6/Loesungen/…`.
- Jede PHP-Datei beginnt mit einem **Kopfkommentar** `/* … */` (Dateiname, Zweck, Autor) und hat kurze `//`-Kommentare über jedem Block.
- **Sprechende Namen** in camelCase, **Konstanten** in GROSSBUCHSTABEN mit `define`.
- Jede feste Zahl aus der Aufgabenstellung wird eine Konstante. In den Rechnungen steht **keine** nackte Zahl (Ausnahme: `0` als Startwert und `100` beim Umrechnen von Prozent).
- Formulare (`.html`) mit Labels, `required` und passenden `min`-Werten wie in Kapitel 3. `formular.css` kopierst du aus Kapitel 5.

Ordnerstruktur am Ende:

```
Kapitel6/Loesungen/
├── formular.css
├── aufgabe_6_1/                        Kopie deines Copy-Shops aus 5.1 d, kommentiert
├── aufgabe_6_2_addition.html
├── aufgabe_6_2_addition.php
├── aufgabe_6_2_operatoren.php
├── aufgabe_6_2_ternaer.php
├── aufgabe_6_2_konstante.html
├── aufgabe_6_2_konstante.php
├── aufgabe_6_3_wahrheitstabellen.php
├── aufgabe_6_4_fahrradverleih.html
├── aufgabe_6_4_fahrradverleih.php
├── aufgabe_6_5_copyshop.html
├── aufgabe_6_5_copyshop.php
└── includes/
    └── copyshopKonstanten.inc.php
```

### Aufgabe 6.1: Kommentare einfügen

> *Fügen Sie Kommentare in Ihre bisherigen Programme ein!*

Kopiere den Copy-Shop aus Kapitel 5 (`aufgabe_5_1_copyshop.html`, `aufgabe_5_1_copyshop.php`, `includes/copyshopPreise.inc.php`, `includes/copyshopBerechnung.inc.php`, `includes/fusszeile.inc.php`) nach `Kapitel6/Loesungen/aufgabe_6_1/` (mit Unterordner `includes/` und `formular.css`). Die Kapitel-5-Dateien bleiben unverändert.

- Jede `.php`-Datei bekommt den Kopfkommentar mit `/* … */`.
- In `copyshopBerechnung.inc.php` erklärt **je eine** `//`-Zeile jede Rechnung **fachlich** (z. B. „Kopierkosten: alle Seiten aller Exemplare mal Seitenpreis“), nicht technisch.
- In der `.html` ein `<!-- … -->` mit Dateiname und Zweck, **nichts** Internes.
- Die Seite muss danach genauso funktionieren wie vorher (40 Seiten, 3 Exemplare → 6 / 7,5 / 13,5).

### Aufgabe 6.2: Die JavaScript-Beispiele in PHP

> *Einige der Beispiele dieses Kapitels zeigen nur JavaScript-Lösungen. Entwickeln Sie die entsprechenden php-Lösungen!*

**a) Addition mit Kommentaren** (aus `kommentar.html`)
- `aufgabe_6_2_addition.html`: Formular mit `ersterSummand` und `zweiterSummand` (`type="number"`, `step="any"`, `required`).
- `aufgabe_6_2_addition.php`: liest beide Werte, addiert, gibt aus: `Die Summe von 2.5 und 4 ist: 6.5`. Kommentare wie im Original (Kopf + jeder Schritt), aber mit dem **richtigen** Dateinamen. Die Ausgabe einmal mit `"…$variable…"` und darunter dieselbe Ausgabe mit dem Punkt-Operator `"…" . $variable . "…"` bauen.
- Test: 2.5 und 4 → 6.5; -3 und 3 → 0.

**b) Arithmetische Operatoren** (aus `arithmetischeOperatoren.html`)
- `aufgabe_6_2_operatoren.php`, ohne Formular. Dieselben Variablen und Rechnungen wie im Original, Ausgabe je Zeile mit `echo`.
- **Zusätzlich:** Zeig jede Kurzschreibweise aus Teil C.2 einmal (`+=`, `-=`, `*=`, `/=`, `%=`, `++`, `--`, `.=`) und gib nach jeder Zeile den neuen Wert aus. Schreib als Kommentar dahinter, welches Ergebnis du **erwartest**, und vergleiche mit dem Browser.
- Erwartete erste Zeilen: `l1: 5`, `l2: -1`, `l3: 1`, `l4: 6`, `t: 1.5`, dann `8` und `12`.

**c) Ternärer Operator** (aus `tenaer.html`)
- `aufgabe_6_2_ternaer.php`, ohne Formular. Wie das Original, aber mit **korrektem** Kommentar zum Wert von `$k`.
- Darunter ein zweites Beispiel mit sprechenden Namen: `$alter = 17;` und `$status = …` per ternärem Operator `"volljährig"` oder `"minderjährig"`, die Grenze 18 als Konstante `VOLLJAEHRIGKEITSALTER`. Ausgabe: `Mit 17 Jahren ist man minderjährig.` Teste auch mit 18 und 30.

**d) Konstanten** (aus `konstante1.html` / `konstante2.html`)
- `aufgabe_6_2_konstante.html` + `.php`: Einkaufspreis eingeben, Netto- **und** Bruttoverkaufspreis ausgeben (das Original-PHP gibt nur den Brutto aus).
- Gewinnspanne 25 %, Mehrwertsteuer 19 %. Beide als Konstanten **in Prozent** (`25`, `19`), umgerechnet wird in der Rechnung (`/ 100`).
- In der Ausgabe stehen auch die beiden Prozentsätze, aus den Konstanten gelesen: `Netto-Verkaufspreis (Gewinnspanne 25 %): 125`.
- Test: Einkaufspreis 100 → Netto 125, Brutto 148.75. Danach Mehrwertsteuer in **einer** Zeile auf 7 ändern → Brutto 133.75. Wieder auf 19.

### Aufgabe 6.3: Wahrheitstabellen verifizieren

> *Verifizieren Sie Tabelle 6.3 bis Tabelle 6.5!*

`aufgabe_6_3_wahrheitstabellen.php` gibt die drei Tabellen aus dem Skript (and, or, not) als **HTML-Tabellen** aus, aber jeder Eintrag in der Mitte wird von PHP **berechnet**, nicht abgetippt.

- Variablen `$wahr = true;` und `$falsch = false;`. Jede Zelle rechnet z. B. `$wahr && $falsch`.
- Weil `echo false` nichts ausgibt (Teil B.2), wandelst du jedes Ergebnis mit dem ternären Operator in den Text `true` oder `false` um.
- Aufbau wie im Skript: and- und or-Tabelle mit Zeilen `true`/`false` und Spalten `true`/`false`, not-Tabelle mit den Spalten `a` und `not a`. Überschrift über jeder Tabelle. Tabellen-HTML kennst du aus Kapitel 3, du darfst `<?= … ?>` aus Kapitel 5 benutzen.
- **Zusatz:** Eine vierte Tabelle mit den Vergleichen `"1" == 1`, `"1" === 1`, `5 != 5`, `3 <= 3` und `true || false && false`, jeweils mit dem Ausdruck als Text in der linken Spalte und dem Ergebnis rechts. Überlege vorher, was rauskommt.
- Kontrolle: Die Ergebnisse müssen genau den Tabellen 6.3–6.5 im Skript (S. 57) entsprechen.

### Aufgabe 6.4: Sprechende Namen und Konstanten (Refactoring)

> *In vielen Beispielen dieses Kapitels waren die Variablennamen nicht gerade sprechend.*

Statt das zu diskutieren, reparierst du es. Ein Kollege hat für einen **Fahrradverleih** dieses Programm geschrieben. Es rechnet richtig, ist aber unlesbar:

```html
<form action="./aufgabe_6_4_fahrradverleih.php" method="post">
    <input type="number" name="a"> <input type="number" name="b">
    <input type="submit" value="OK">
</form>
```

```php
<?php
    $a = $_POST['a'];
    $b = $_POST['b'];
    $x = $a * $b * 12;
    $y = ($a >= 3 ? $x * 0.1 : 0);
    $z = $x - $y + 5 * $b;
    echo "Ergebnis: " . $x . " / " . $y . " / " . $z;
?>
```

Die Geschäftsregeln dahinter: Ein Fahrrad kostet **12 € pro Tag**. Ab einer Mietdauer von **3 Tagen** gibt es **10 % Rabatt** auf den Mietpreis. Pro Fahrrad kommt eine **Reinigungspauschale von 5 €** dazu (ohne Rabatt). `a` ist die Mietdauer in Tagen, `b` die Anzahl der Fahrräder.

Schreib `aufgabe_6_4_fahrradverleih.html` und `.php` neu:

- Formularfelder mit sprechenden `name`s, Labels, `required`, `min="1"`.
- Alle vier festen Werte als Konstanten. Der Rabatt als Prozentwert `10`.
- Alle Variablen sprechend, Kommentare nach den Regeln oben.
- Ausgabe als **Tabelle** mit drei Zeilen: Mietpreis, Rabatt, Reinigung und einer Zeile Gesamtpreis (die Reinigungskosten brauchst du dafür als eigene Variable).
- Test: 2 Tage, 1 Rad → 24 / 0 / 5 / **29**. 4 Tage, 2 Räder → 96 / 9.6 / 10 / **96.4**. 3 Tage, 3 Räder → 108 / 10.8 / 15 / **112.2**.

### Aufgabe 6.5 (Zusatz, klausurnah): Copy-Shop mit Konstanten und Mehrwertsteuer

Dein Copy-Shop aus 5.1 d) hatte die Preise als **Variablen** in `copyshopPreise.inc.php`. In der Klausur wären das Konstanten. Mach daraus die Klausurfassung:

- `includes/copyshopKonstanten.inc.php`: nur `define`s: `PREIS_PRO_SEITE` (0.05), `PREIS_BINDUNG_PRO_EXEMPLAR` (2.5), `MEHRWERTSTEUER_PROZENT` (19). Keine Variablen, keine Ausgabe.
- `aufgabe_6_5_copyshop.php`: bindet die Konstanten mit `require_once` ein, liest die beiden Formularwerte, berechnet Kopierkosten, Bindungskosten, Nettopreis, Mehrwertsteuer und Bruttopreis, gibt alles als Tabelle aus. Diesmal darf die Rechnung direkt in der Seite stehen (eine Datei Konstanten, eine Seite).
- Beträge mit **zwei Nachkommastellen und Komma** ausgeben. Dafür gibt es eine fertige PHP-Funktion: `number_format($betrag, 2, ",", ".")` macht aus `16.065` den Text `16,07`. (Funktionen kommen in Kapitel 9, diese hier benutzt du einfach.)
- Unter der Tabelle eine Zeile `Preise: 0,05 € pro Seite, 2,50 € Bindung pro Exemplar, 19 % MwSt.` Die Zahlen kommen aus den Konstanten.
- Test: 40 Seiten, 3 Exemplare → 6,00 / 7,50 / 13,50 / 2,57 / **16,07**. 250 Seiten, 4 Exemplare → 50,00 / 10,00 / 60,00 / 11,40 / **71,40**.
- Gegenprobe: Ändere `PREIS_PRO_SEITE` auf 0.06. Alles, inklusive der Zeile unter der Tabelle, muss sich anpassen, ohne dass du `aufgabe_6_5_copyshop.php` anfasst. Danach zurück auf 0.05.

---

Wenn du fertig bist (gern auch nach jeder Aufgabe), schreib mir „fertig“ im Thread. Ich lese deine Dateien direkt in `~/eclipse-workspace/IKSY1/Kapitel6/Loesungen/`, korrigiere sie und erkläre Fehler. Erst danach gibt es eine Musterlösung.

---

## Spickzettel Kapitel 6 (für die Klausur-Mappe)

### Konstanten

```php
define("PREIS_PRO_SEITE", 0.05);         // GROSS, ohne $, Zahl ohne ""
define("MIN_GRENZE", 1);
define("MAX_GRENZE_ENTFERNUNG", 500);
define("ENCODING", "UTF-8");

$kosten = PREIS_PRO_SEITE * $anzahlSeiten;                  // benutzen ohne $
echo "Preis: " . PREIS_PRO_SEITE . " €";                     // in Strings nur mit .
```

- Jeder feste Wert aus der Aufgabe (Preis, Grenze, Prozentsatz) → Konstante. Eingaben und Ergebnisse → Variablen.
- Nie links von `=`, nicht zweimal `define`n, nicht in `"…"`.

### Operatoren

| Zweck | PHP |
|---|---|
| rechnen | `+ - * /`, Rest `%`, Potenz `**` |
| kurz | `+= -= *= /= %= .=`, `$i++` `$i--` |
| Strings verketten | **`.`** (nie `+`) |
| vergleichen | `==` `===` `!=` `<` `>` `<=` `>=` |
| logisch | `&&` `\|\|` `!` (nicht `and`/`or`) |
| ternär | `$x = (Bedingung) ? wennJa : wennNein;` |
| alle Prüfungen sammeln | `$correct = $correct && pruefung(…);` |

Vorrang: `()` → `**` → `!` → `* / %` → `+ -` → `.` → Vergleiche → `&&` → `||` → `? :` → `=`. Im Zweifel Klammern.

### Ausgabe

```php
echo "Summe: $summe";                              // Variable in "…" wird ersetzt
echo 'Summe: $summe';                              // in '…' nicht
echo $wert ? "true" : "false";                     // Boolean lesbar ausgeben
echo number_format($betrag, 2, ",", ".");          // 1234.5 → 1.234,50
var_dump($variable);                               // Typ und Wert ansehen (Fehlersuche)
```

### Kommentare

```php
/*  Dateiname: loesung.php
    Zweck: …
*/
// Eingaben prüfen
<!-- HTML-Kommentar: für jeden im Quelltext sichtbar -->
```

### Fehlermeldungen

| Meldung | Ursache |
|---|---|
| `Unsupported operand types: string + string` | Strings mit `+` statt `.` verkettet |
| `Undefined constant "X"` | Konstante falsch geschrieben oder (noch) nicht definiert / Datei nicht eingebunden |
| `Constant X already defined` | `define` zweimal ausgeführt, der alte Wert bleibt |
| `syntax error, unexpected token "="` bei einer Konstanten | Konstante links von `=` |
| `Undefined variable $x` | Tippfehler (Groß-/Kleinschreibung!) oder Variable noch nicht zugewiesen |
| Konstantenname steht als Text im Browser | Konstante in `"…"` statt mit `.` verkettet |
| `syntax error` bei `0,05` | Komma statt Punkt als Dezimaltrenner |
| Leere Stelle statt `false` | `echo false` gibt nichts aus → ternär `? "true" : "false"` |
