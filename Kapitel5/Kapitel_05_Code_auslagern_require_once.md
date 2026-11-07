# Kapitel 5: JavaScript und PHP in HTML-Dateien einfügen

Skript `phpScript.pdf`, Seiten 46–49 · Beispiele: `Vorlesungen/5` · Aufgabe 5.1

So gehst du vor: Kopiere zuerst die Beispiele (Vorbereitung). Lies dann Teil A bis C und **tippe die PHP-Beispiele selbst ab**. Die „Selbst ausprobieren“-Schritte zeigen dir die Fehler, die beim Einbinden von Dateien typisch sind. Danach löst du in Teil E die Aufgabe 5.1.

**Warum dieses Kapitel wichtig ist:** Das Kapitel ist kurz, aber es enthält den Befehl, der in der Klausur ganz oben in jeder Lösung steht: **`require_once`**. So sieht der Anfang der Musterlösung von Probeklausur 2 aus:

```php
require_once ("./includes/startTemplate.inc.php");
require_once ("./klassen/Umzugsgebuehren.inc.php");
require_once ("./klassen/Kunde.inc.php");
require_once ("./klassen/Sicherheit.inc.php");
require_once ("./klassen/DbFunctions.inc.php");
```

Fünf ausgelagerte Dateien, alle mit der Endung `.inc.php`, alle in Unterordnern. Genau das lernst du hier, nur mit kleineren Dateien.

**JavaScript:** Teil A zeigt kurz, wie man JavaScript auslagert. Nur ansehen, nicht abtippen.

---

## Vorbereitung

1. Lege in Eclipse im Projekt `IKSY1` den Ordner `Kapitel5/` an, darin `Vorlesungsmaterialien/` und `Loesungen/`.
2. Kopiere aus dem Kursordner `Vorlesungen/5/` nach `Kapitel5/Vorlesungsmaterialien/`: `addition4.html`, den Ordner `javascript/` (mit `addition4.js`) und `addition4php.html`. Kopiere außerdem `formular.css` aus `Kapitel4/Vorlesungsmaterialien/` dazu.
3. In `addition4php.html` steht `href="../css/formular.css"`. Ändere das wie in Kapitel 4 auf `href="formular.css"`.
4. `addition4php.php` und `includes/addition4.inc.php` tippst du in Teil C selbst.
5. Aufrufen im Browser: `http://localhost/iks/Kapitel5/Vorlesungsmaterialien/addition4php.html` usw.

Kleinigkeiten in den Original-Dateien, damit du dich nicht wunderst:

- In `addition4php.html` steht im Kommentar noch `<!-- addition3php.html -->` und `name="addition3"`. Die Datei ist aus Kapitel 4 kopiert, funktioniert aber trotzdem, weil nur `action="./addition4php.php"` zählt.
- Die Beispiele aus Kapitel 5 rechnen dasselbe wie Beispiel 4.11/4.12 (Summe 1 bis n). Neu ist **nur**, wo der Code steht.

---

## Teil A: JavaScript auslagern (S. 46–47), nur ansehen

Bisher stand JavaScript direkt zwischen `<script>` und `</script>`. Man kann den Code aber in eine eigene Datei mit der Endung `.js` legen und mit dem **`src`-Attribut** laden:

```html
<script type='text/javascript' src="./javascript/addition4.js">
</script>
```

```
Vorlesungsmaterialien/
├── addition4.html          lädt ./javascript/addition4.js
└── javascript/
    └── addition4.js        der Code aus Beispiel 4.10, ohne <script>-Tags
```

- `src` ist ein **relativer Pfad** von der HTML-Datei aus, genau wie bei `<img src>` und `<link href>` in Kapitel 3.
- In der `.js`-Datei stehen **keine** `<script>`-Tags, nur der JavaScript-Code.
- Der Browser lädt die Datei nach und tut so, als stünde der Code an dieser Stelle.

> **Selbst ausprobieren (2 Minuten):** Öffne `addition4.html`, gib 4 ein. Ergebnis 10. Strg+U zeigt jetzt nur die `<script src=…>`-Zeile. Klick im Quelltext auf `./javascript/addition4.js`: Der Browser zeigt dir den kompletten Code. **Auslagern versteckt JavaScript nicht**, der Code wird trotzdem zum Browser geschickt.

Das CSS-Gegenstück kennst du schon: `<link rel="stylesheet" href="formular.css">` ist auch „Code in eigene Datei ausgelagert“.

---

## Teil B: PHP-Tags (S. 47–48)

Das Skript nennt vier Schreibweisen für den PHP-Block. **Du benutzt nur eine:**

```php
<?php
    // PHP-Code
?>
```

| Schreibweise | Stand in PHP 8.3 |
|---|---|
| `<?php … ?>` | **die einzige, die wir benutzen** (auch `<?PHP` geht, ist aber unüblich) |
| `<? … ?>` (Kurzform) | nur wenn `short_open_tag = On` in `php.ini`. Bei dir ist sie **aus** |
| `<% … %>` (ASP-Stil) | **gibt es seit PHP 7 nicht mehr** (Skript ist hier veraltet) |
| `<script language="php">` | **gibt es seit PHP 7 nicht mehr** (Skript ist hier veraltet) |

Eine Kurzform, die immer funktioniert und praktisch ist:

```php
<td><?= $gesamtpreis ?> €</td>       <!-- dasselbe wie <?php echo $gesamtpreis; ?> -->
```

`<?=` heißt „gib diesen Wert aus“. Gut für einzelne Werte mitten im HTML (z. B. in deiner Tabelle aus Aufgabe 4.6). Ab Kapitel 7 übernimmt Smarty diese Arbeit mit `{$gesamtpreis}`.

> **Selbst ausprobieren:** Schreib in `addition4php.php` (Teil C) zusätzlich unter die Überschrift `<? echo "Kurzform"; ?>` und lade die Seite. Im Browser siehst du **nichts**, mit Strg+U siehst du `<? echo "Kurzform"; ?>` als Text im Quelltext. PHP hat den Block nicht erkannt und einfach durchgereicht. Ersetze `<?` durch `<?php`, dann erscheint „Kurzform“. Danach die Zeile wieder löschen.

---

## Teil C: PHP auslagern mit `require_once` (S. 48–49), das Wichtigste des Kapitels

### C.1 Beispiel 5.3 und 5.4 – abtippen

`Kapitel5/Vorlesungsmaterialien/addition4php.php` (die Seite, die das Formular aufruft):

```php
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- addition4php.php -->
    <title>Addition mit Eingabe in php (Teil 2)</title>
</head>
<body>
    <h2>
        Aufsummierung natürlicher Zahlen: Das Ergebnis
    </h2>
    <?php
        require_once("./includes/addition4.inc.php");
    ?>
</body>
</html>
```

`Kapitel5/Vorlesungsmaterialien/includes/addition4.inc.php` (Ordner `includes` vorher anlegen):

```php
<?php
    // addition4.inc.php
    $bisZu = $_POST['bisZu'];
    $summe = 0;
    for ($i = 1; $i <= $bisZu; $i++)
    {
        $summe = $summe + $i;
    }
    echo("Die Summe der ersten $bisZu natürlichen Zahlen ist: $summe");
?>
```

Ordnerstruktur danach:

```
Kapitel5/Vorlesungsmaterialien/
├── addition4php.html        Formular, action="./addition4php.php"
├── addition4php.php         HTML-Gerüst + require_once
├── formular.css
└── includes/
    └── addition4.inc.php    der eigentliche PHP-Code
```

Test: `addition4php.html` öffnen, 4 eingeben → `Die Summe der ersten 4 natürlichen Zahlen ist: 10`. Gleiches Ergebnis wie in Kapitel 4.

### C.2 Was `require_once` macht

```
addition4php.php                          includes/addition4.inc.php
<body>                                    <?php
  <h2>…</h2>                                  $bisZu = $_POST['bisZu'];
  <?php                                       …
    require_once("./includes/…") ──────►     echo("Die Summe …");
  ?>                                      ?>
</body>
```

PHP **fügt den Inhalt der Datei an dieser Stelle ein und führt ihn aus**, als hättest du ihn dorthin kopiert. Daraus folgen vier Regeln:

1. **Die eingebundene Datei braucht eigene `<?php … ?>`-Tags.** Ohne sie gibt PHP ihren Inhalt als Text aus, statt ihn auszuführen.
2. **Variablen gelten über die Dateigrenze hinweg.** Was in der `.inc.php` angelegt wird (`$summe`), kannst du in der Hauptdatei **nach** dem `require_once` benutzen, und umgekehrt. Das nutzt du in Aufgabe 5.1 beim Copy-Shop.
3. **Der Pfad ist relativ zur aufgerufenen Seite** (die, die in der Adresszeile steht). `./includes/…` heißt: Ordner `includes` neben `addition4php.php`. Pfad in Anführungszeichen, die runden Klammern sind optional (`require_once "…";` geht auch).
4. **`_once`**: Wird dieselbe Datei ein zweites Mal mit `require_once` eingebunden, ignoriert PHP das. Bei Klassen (ab Kapitel 10) ist das Pflicht, denn eine Klasse zweimal zu deklarieren ist ein Fatal error.

### C.3 Warum `.inc.php` und nicht `.inc`

- **`.inc`** zeigt dir und anderen: „Diese Datei wird eingebunden, sie ist nicht allein gedacht.“
- **`.php`** am Ende ist der Sicherheitsteil: Apache gibt nur Dateien auf `.php` an PHP weiter. Eine Datei `passwort.inc` würde beim direkten Aufruf **als Text ausgeliefert**, also mit Quellcode und Passwort. `passwort.inc.php` wird dagegen **ausgeführt**, der Code bleibt auf dem Server.
- In der Klausur steht das Datenbank-Passwort in `klassen/DbFunctions.inc.php`. Deshalb diese Endung.

> **Selbst ausprobieren (die Fehler wirst du wiedersehen):**
> 1. **Include direkt aufrufen:** Gib `http://localhost/iks/Kapitel5/Vorlesungsmaterialien/includes/addition4.inc.php` in die Adresszeile ein. Du bekommst `Warning: Undefined array key "bisZu"` und `Die Summe der ersten natürlichen Zahlen ist: 0`. Der Code wurde **ausgeführt**, nicht angezeigt. Strg+U: kein PHP-Code sichtbar.
> 2. **Die gefährliche Variante:** Kopiere die Datei in Eclipse als `includes/addition4.inc` (ohne `.php`) und ruf `…/includes/addition4.inc` auf. Der Browser zeigt den Code als Text oder bietet ihn zum Download an. Beides heißt: **jeder kann ihn lesen.** Danach die Kopie wieder löschen.
> 3. **Tippfehler im Pfad:** Schreib in `addition4php.php` `./include/addition4.inc.php` (ohne s). Du bekommst
>    `Warning: require_once(./include/addition4.inc.php): Failed to open stream: No such file or directory` und
>    `Fatal error: Uncaught Error: Failed opening required './include/addition4.inc.php'`.
>    Die Seite bricht an dieser Stelle ab, alles danach fehlt. Wenn du diese Meldung siehst: Ordnername, Dateiname und Groß-/Kleinschreibung prüfen (Linux unterscheidet `Includes` und `includes`!). Wieder zurück.
> 4. **`require` gegen `include`:** Ersetze im falschen Pfad aus 3. `require_once` durch `include_once`. Jetzt kommen nur zwei **Warnings**, und die Seite läuft weiter (das `</body></html>` wird noch ausgegeben). `include` meckert, `require` bricht ab. Wir nehmen **immer `require_once`**: Wenn eine nötige Datei fehlt, soll das Programm nicht mit halben Daten weiterrechnen.
> 5. **`_once` sehen:** Schreib die `require_once`-Zeile zweimal untereinander. Die Ausgabe kommt **einmal**. Ändere beide auf `require` (ohne `_once`): Die Ausgabe kommt **zweimal**. Wieder auf eine Zeile `require_once` zurück.
> 6. **Tags vergessen:** Lösch in `addition4.inc.php` die erste Zeile `<?php`. Die Seite zeigt jetzt den PHP-Code als Text an. Wieder einfügen.

### C.4 Merke für später: Pfade, wenn ein Include ein anderes Include lädt

`./` bezieht sich immer auf die **aufgerufene Seite**, nicht auf die Datei, in der das `require_once` steht. Solange nur die Hauptseite einbindet (wie in der Klausur-`loesung.php`), ist das egal. Bindet eine Datei in `includes/` selbst eine weitere ein, nimm `__DIR__` (= Ordner der aktuellen Datei):

```php
require_once(__DIR__ . "/andereDatei.inc.php");
```

Die Klausur-Vorlage löst das mit einem festen Wurzelpfad in `includes/startTemplate.inc.php`:

```php
$ROOT_DIR = '/var/www/html/iksy05/Probeklausur2';
require_once("$ROOT_DIR/vendor/autoload.php");
```

Deshalb nennt der Dozent „richtiges Root-Verzeichnis“ als Bewertungskriterium. Das richten wir in Kapitel 7 (Smarty) ein.

---

## Teil D: Was wird ausgelagert? (S. 47 und 49)

Das Skript nennt Vor- und Nachteile. Für dich als Faustregel:

| Auslagern | Drin lassen |
|---|---|
| Code, den **mehrere Seiten** brauchen (Kopf/Fuß, Preise, Datenbankzugang, Sicherheitsprüfungen) | ein paar Zeilen, die nur diese eine Seite braucht |
| Werte, die sich ändern können (Preise, Prozentsätze) | |
| Code mit **Geheimnissen** (Passwörter): nur in `.inc.php` | |

In der Klausur ist die Aufteilung immer gleich:

```
DeinName/
├── loesung.php              Steuerung: require_once, Formular auswerten, Smarty aufrufen
├── includes/
│   └── startTemplate.inc.php    Smarty einrichten
├── klassen/
│   ├── DbFunctions.inc.php      Datenbankzugriff (mit Passwort!)
│   ├── Sicherheit.inc.php       Eingaben prüfen, XSS/CSRF
│   └── <Berechnung>.inc.php     deine Rechenfunktionen
└── smarty/templates/loesung.tpl HTML-Ausgabe
```

Und Regel 11 des Dozenten: **Nur einbinden, was genutzt wird, und alles einbinden, was genutzt wird.** Jedes `require_once` ohne Nutzen kostet Punkte, jedes fehlende ergibt einen Fatal error.

---

## Teil E: Deine Aufgabe

> **Aufgabe 5.1:** Lagern Sie Ihren Code in den von Ihnen gelösten Aufgaben in eigenen Dateien aus!

Du nimmst deine **Lösungen aus Kapitel 4** und lagerst den PHP-Code in `includes/` aus. Die Kapitel-4-Dateien bleiben unverändert, du arbeitest mit Kopien.

**Regeln:**

- Alles kommt nach `~/eclipse-workspace/IKSY1/Kapitel5/Loesungen/`. UTF-8, Aufruf über `http://localhost/iks/Kapitel5/Loesungen/…`.
- Jede ausgelagerte Datei heißt `<sprechenderName>.inc.php`, liegt in `includes/` und beginnt mit `<?php` und einem Kommentar mit ihrem Dateinamen (wie `// addition4.inc.php`).
- In den Seiten (`aufgabe_5_1_….php`) steht im PHP-Teil **nur noch `require_once`** (Ausnahme: die Copy-Shop-Tabelle, siehe 5.1 d).
- Nur `require_once`, kein `include`.
- Die Formulare (`.html`) kopierst du aus Kapitel 4 und passt nur Titel und `action` an.

Ordnerstruktur:

```
Kapitel5/Loesungen/
├── formular.css
├── aufgabe_5_1_subtraktion.html
├── aufgabe_5_1_subtraktion.php
├── aufgabe_5_1_negativ.html            (zwei Formulare wie 4.4)
├── aufgabe_5_1_negativ_schleife.php
├── aufgabe_5_1_negativ_formel.php
├── aufgabe_5_1_rabatt.html
├── aufgabe_5_1_rabatt.php
├── aufgabe_5_1_copyshop.html
├── aufgabe_5_1_copyshop.php
└── includes/
    ├── fusszeile.inc.php
    ├── subtraktion.inc.php
    ├── negativeSummeSchleife.inc.php
    ├── negativeSummeFormel.inc.php
    ├── rabatt.inc.php
    ├── copyshopPreise.inc.php
    └── copyshopBerechnung.inc.php
```

### a) Gemeinsame Fußzeile (Code für mehrere Seiten)

`includes/fusszeile.inc.php` gibt aus:

```html
<footer><p>IKS 1 · Lösung von Abdulaziz Srour</p></footer>
```

Name als Variablen (`$vorname`, `$nachname`) wie in 4.1, Ausgabe per `echo`. **Alle vier Ergebnisseiten** (`subtraktion`, beide `negativ`, `rabatt`, `copyshop`) binden sie vor `</body>` ein. Test: Ändere einmal den Text in der Fußzeile und lade alle Seiten neu. Er ändert sich überall. Das ist der Grund fürs Auslagern.

### b) Subtraktion (aus 4.3)

- `aufgabe_5_1_subtraktion.php`: Gerüst mit `<h1>Ergebnis</h1>`, dann `require_once` für `subtraktion.inc.php`, dann für die Fußzeile.
- `includes/subtraktion.inc.php`: liest Minuend und Subtrahend, rechnet, gibt aus.
- Testwerte wie in 4.3: 10 und 3 → 7; 3 und 10 → -7; 5,5 und 2,25 → 3.25.

### c) Negative Summe (aus 4.4) und Rabatt (aus 4.5)

- Schleife und Formel kommen in **zwei** Include-Dateien, die beiden Seiten binden jeweils ihre ein.
- `includes/rabatt.inc.php` enthält `$rabattProzent = 15;` und die Rechnung.
- Testwerte: n = 4 → -10 (beide Varianten), n = 100 → -5050; Warenwert 200 → Rabatt 30, zu zahlen 170.
- Prüfe danach: Ruf `…/includes/rabatt.inc.php` direkt auf. Der Rabattsatz darf **nirgends** im Browser oder im Quelltext stehen.

### d) Copy-Shop (aus 4.6), klausurnah

Hier teilst du in **drei** Teile, so wie später in der Klausur (Konstanten / Berechnung / Ausgabe):

- `includes/copyshopPreise.inc.php`: **nur** die beiden Preise (`$preisProSeite`, `$preisBindungProExemplar`). Sonst nichts, keine Ausgabe.
- `includes/copyshopBerechnung.inc.php`: liest die beiden Formularwerte und berechnet Kopierkosten, Bindung und Gesamtpreis. **Keine Ausgabe** (kein `echo`).
- `aufgabe_5_1_copyshop.php`: bindet **zuerst** die Preise, **dann** die Berechnung ein und gibt danach die Tabelle aus. Die Tabelle bleibt im HTML der Seite, die drei Beträge setzt du mit `<?= … ?>` in die `<td>` (Teil B).
- Testwerte wie in 4.6: 40 Seiten, 3 Exemplare → 6 €, 7,5 €, 13,5 €.
- Gegenprobe: Vertausch die Reihenfolge der beiden `require_once`. Was passiert und warum? (Nicht aufschreiben, nur ansehen, und dann wieder richtig herum.)

---

Wenn du fertig bist (gern auch nach jedem Teil), schreib mir „fertig“ im Thread. Ich lese deine Dateien direkt in `~/eclipse-workspace/IKSY1/Kapitel5/Loesungen/`, korrigiere sie und erkläre Fehler. Erst danach gibt es eine Musterlösung.

---

## Spickzettel Kapitel 5 (für die Klausur-Mappe)

### PHP-Datei einbinden

```php
<?php
    require_once("./includes/datei.inc.php");    // relativ zur aufgerufenen Seite
    require_once("./klassen/Klasse.inc.php");
    require_once(__DIR__ . "/datei.inc.php");     // relativ zur aktuellen Datei
?>
```

```php
<?php
    // datei.inc.php  ← eigene <?php-Tags sind Pflicht
    $preisProSeite = 0.05;
?>
```

| Befehl | Datei fehlt | zweimal eingebunden |
|---|---|---|
| **`require_once`** (immer diesen) | Fatal error, Abbruch | wird nur einmal ausgeführt |
| `require` | Fatal error, Abbruch | wird zweimal ausgeführt |
| `include_once` | Warning, läuft weiter | einmal |
| `include` | Warning, läuft weiter | zweimal |

### Regeln

- Endung **`.inc.php`**, nie nur `.inc` (sonst ist der Code im Browser lesbar).
- Variablen aus der eingebundenen Datei gelten danach in der Hauptdatei. **Reihenfolge zählt:** erst einbinden, was gebraucht wird.
- Nur Klassen einbinden, die genutzt werden, und alle, die genutzt werden (Dozent, Regel 11).
- Nur `<?php … ?>` benutzen. `<?= $wert ?>` gibt einen Wert aus.

### JavaScript und CSS auslagern

```html
<link rel="stylesheet" href="formular.css">
<script src="./javascript/datei.js"></script>     <!-- Code bleibt für den Benutzer lesbar -->
```

### Fehlermeldungen

| Meldung | Ursache |
|---|---|
| `Failed to open stream: No such file or directory` + `Failed opening required '…'` | Pfad oder Dateiname falsch, Groß-/Kleinschreibung, falscher Ordner (`./` = Ordner der aufgerufenen Seite) |
| PHP-Code steht als Text im Browser | `<?php` in der eingebundenen Datei fehlt, oder Datei endet nicht auf `.php` |
| `Undefined variable $x` nach dem Einbinden | Variable wird erst in einer Datei angelegt, die **später** eingebunden wird, oder Tippfehler |
| `Cannot declare class X, because the name is already in use` (ab Kap. 10) | Klasse mit `require` statt `require_once` doppelt eingebunden |
| Ausgabe erscheint doppelt | `require` statt `require_once` und Datei zweimal eingebunden |
