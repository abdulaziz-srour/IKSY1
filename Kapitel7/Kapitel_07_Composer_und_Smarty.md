# Kapitel 7: Template-Systeme – Composer und Smarty

Skript `phpScript.pdf`, Seiten 61–66 · Beispiele: `Vorlesungen/7` · Aufgabe 7.1 (+ 7.2 und 7.3 klausurnah)

So gehst du vor: Erst die Vorbereitung (einmal Composer im Terminal), dann Teil A bis E lesen und die „Selbst ausprobieren“-Schritte machen. Die provozierten Fehler sind genau die, die in der Klausur am meisten Zeit kosten. Danach löst du in Teil F die Aufgaben.

**Warum dieses Kapitel wichtig ist:** Ab jetzt sieht jede Lösung aus wie eine Probeklausur. Die Musterlösung von Probeklausur 2 beginnt so:

```php
require_once ("./includes/startTemplate.inc.php");
...
$smarty->assign ( 'ausgabeText', htmlentities($ausgabeText));
...
$smarty->display ( 'loesung.tpl' );
```

Zwei Tipps des Dozenten gehören direkt zu diesem Kapitel: **„Schreibrechte für `templates_c` setzen“** und **„richtiges Root-Verzeichnis“**. Beides lernst du hier. Und Aufgabe 7.3 ist der **erste Baustein deiner Klausur-Vorlage**.

---

## Vorbereitung

1. Prüfe im Terminal, ob Composer da ist:
   ```bash
   composer --version
   ```
   Erwartet: `Composer version 2.x`. Falls „Befehl nicht gefunden“: `sudo apt install composer`.
2. Lege in Eclipse im Projekt `IKSY1` den Ordner `Kapitel7/` an, darin `Vorlesungsmaterialien/` und `Loesungen/`.
3. Kopiere aus `Vorlesungen/7/` nach `Kapitel7/Vorlesungsmaterialien/`:
   - `composer.json`, `composer.lock`
   - `euro1.html`, `euro1.php`, `helloWorldSmarty.php`, `helloWorldSmarty2.php`
   - den Ordner `includes/` (mit `startTemplate.inc.php`)
   - den Ordner `smarty/templates/` (mit `euro1.tpl`, `helloWorld.tpl`)

   **Nicht** kopieren: `vendor/` (holt Composer gleich selbst) und den Inhalt von `smarty/templates_c/` (alte, vom Server erzeugte Dateien). Lege stattdessen einen **leeren** Ordner `smarty/templates_c/` an.
   Dazu `formular.css` aus `Kapitel6/Vorlesungsmaterialien/` und in `euro1.html` den Link auf `href="formular.css"` ändern, wie in den letzten Kapiteln.
4. Im Terminal:
   ```bash
   cd ~/eclipse-workspace/IKSY1/Kapitel7/Vorlesungsmaterialien
   composer install
   chmod 777 smarty/templates_c
   ```
   `composer install` legt den Ordner `vendor/` mit Smarty an (Teil A). `chmod 777` gibt dem Webserver Schreibrechte auf `templates_c` (Teil B.4).
5. In **`helloWorldSmarty.php`** und **`includes/startTemplate.inc.php`** die Zeile mit `$ROOT_DIR` ändern auf
   ```php
   $ROOT_DIR='/var/www/html/iks/Kapitel7/Vorlesungsmaterialien';
   ```
   (Bei dir zeigt `/var/www/html/iks` auf `~/eclipse-workspace/IKSY1`, siehe Teil C.)
6. In Eclipse den Ordner `Kapitel7` markieren und **F5** (Refresh) drücken, damit `vendor/` auftaucht. Eclipse durchsucht `vendor/` beim ersten Mal ein paar Sekunden lang. Warnungen in `vendor/` ignorierst du.
7. Aufrufen: `http://localhost/iks/Kapitel7/Vorlesungsmaterialien/helloWorldSmarty.php`

Fehler und Ungenauigkeiten im Skript und in den Original-Dateien, damit du dich nicht wunderst:

| Wo | Was nicht stimmt |
|---|---|
| Skript, Beispiel 7.1 und 7.3 | `require_once("$ROOT_DIR/vendor/autoload.php;");` hat ein **Semikolon im String**. So abgetippt gibt es `Failed opening required '…/autoload.php;'`. Richtig: `"$ROOT_DIR/vendor/autoload.php"`. Die Dateien im Ordner sind korrekt. |
| Skript, Beispiel 7.1 | Dort steht `$ROOT_DIR='/var/www/html/iksy05/7'`, im Text darunter `…/iksy05/Vorlesungen/7`. Bei dir ist beides falsch, du nimmst den Pfad aus Schritt 5. |
| Skript S. 63 | „Diese Verzeichnisse müssen existieren“: Wirklich nötig sind nur `templates/` und `templates_c/`. `configs/` und `cache/` benutzt Smarty erst, wenn man Konfigurationsdateien bzw. Caching einschaltet. Das tun wir nie. |
| Skript S. 62 | Die `composer.json` im Skript (aus `composer init`) sieht anders aus als die im Ordner. Beides funktioniert, entscheidend ist der Block `"require"`. |
| `euro1.html` | Kein `required`, kein `lang="de"`. `size=12` hat bei `type="number"` keine Wirkung. In deinen Lösungen machst du es besser. |
| `Vorlesungen/7/smarty/templates_c/` | Enthält kompilierte Dateien vom Rechner des Dozenten. Die gehören nie in eine Abgabe oder ins Git (stehen schon in deiner `.gitignore`). |

---

## Teil A: Composer (S. 61–62)

Smarty ist **kein Teil von PHP**, sondern eine Bibliothek, die jemand anderes geschrieben hat. Composer holt solche Bibliotheken aus dem Internet und legt sie in dein Projekt.

| Datei/Ordner | Was es ist | Ins Git? | Auf den USB-Stick? |
|---|---|---|---|
| `composer.json` | **Wunschliste**: welche Pakete in welcher Version (`"smarty/smarty": "^5.5"`) | ja | ja |
| `composer.lock` | genau installierte Versionen (z. B. `v5.5.2`) | ja | ja |
| `vendor/` | die heruntergeladenen Bibliotheken | **nein** | **ja!** |
| `vendor/autoload.php` | die eine Datei, die du einbindest, damit alle Klassen aus `vendor/` verfügbar sind | (in vendor) | (in vendor) |

`^5.5` heißt „Version 5.5 oder neuer, aber unter 6“.

Die Befehle (immer **im Projektordner** ausführen, also da, wo `composer.json` liegt oder liegen soll):

| Befehl | Wann |
|---|---|
| `composer init` | neues Projekt, erzeugt `composer.json` per Fragen (Werte aus der Tabelle S. 62) |
| `composer require smarty/smarty` | Paket **hinzufügen**: trägt es in `composer.json` ein **und** installiert es |
| `composer install` | `composer.json`/`composer.lock` sind schon da (kopiert, aus Git geholt) → `vendor/` herstellen |

Für dich reicht meistens: **`composer.json` kopieren, `composer install`**. Ein neues leeres Projekt geht noch schneller ohne `composer init`: Im leeren Ordner einfach `composer require smarty/smarty` aufrufen, dann entsteht die `composer.json` automatisch.

> **Klausur:** Ab Klausurstart ist das **Internet gesperrt**. `composer install` geht dann nicht mehr. Deine Vorlage muss also **mit fertigem `vendor/`-Ordner** (Smarty, TCPDF, SVGGraph) auf den USB-Stick. Die Ordner `Probeklausur2` bis `7` haben genau so einen `vendor/` schon drin. Das bauen wir in Aufgabe 7.3.

> **Selbst ausprobieren (3 Minuten):**
> 1. Benenne `Kapitel7/Vorlesungsmaterialien/vendor` in `vendor_weg` um und lade `helloWorldSmarty.php` neu. Du bekommst
>    `Failed opening required '/var/www/html/iks/Kapitel7/Vorlesungsmaterialien/vendor/autoload.php'`.
>    Das ist die Meldung, wenn `vendor/` fehlt **oder** `$ROOT_DIR` falsch ist.
> 2. Lösch `vendor_weg` und führ im Ordner `composer install` aus. Seite neu laden: geht wieder. So holst du `vendor/` jederzeit aus `composer.json` + `composer.lock` zurück.

---

## Teil B: Smarty, das Prinzip (S. 63–64)

### B.1 Zwei Dateien statt einer

Bisher hat deine PHP-Seite gerechnet **und** HTML ausgegeben. Mit Smarty wird das getrennt:

```
Browser ──POST──▶ euro1.php                       smarty/templates/euro1.tpl
                  rechnet, KEIN HTML               nur HTML, KEINE Rechnung
                  $smarty->assign('kurs', $kurs) ─▶ {$kurs}
                  $smarty->display('euro1.tpl') ──▶ Smarty füllt das Template
Browser ◀──────────────────── fertiges HTML ◀────┘
```

| In der `.php` | In der `.tpl` |
|---|---|
| `$_POST` lesen, Konstanten, Rechnung | HTML-Grundgerüst, Tabellen, Formular |
| `$smarty->assign('name', $wert);` für jeden Wert, der angezeigt werden soll | `{$name}` an der Stelle, wo er erscheinen soll |
| am Ende **genau ein** `$smarty->display('datei.tpl');` | |
| **kein** `echo`, kein HTML | **keine** Rechnung |

Der erste Parameter von `assign` ist der Name im Template, der zweite der Wert. Gleiche Namen (`'kurs', $kurs`) sind Konvention im Kurs und in den Musterlösungen. Halte dich daran.

### B.2 Die Smarty-Einrichtung Zeile für Zeile

```php
$ROOT_DIR='/var/www/html/iks/Kapitel7/Vorlesungsmaterialien';  // Wurzel des Projekts (Teil C)
require_once("$ROOT_DIR/vendor/autoload.php");                    // Bibliotheken aus Composer laden
$smarty=new Smarty\Smarty();                                      // ein Smarty-Objekt erzeugen (Kapitel 10 erklärt new)
$smarty->setTemplateDir("$ROOT_DIR/smarty/templates/");           // hier liegen deine .tpl
$smarty->setCompileDir("$ROOT_DIR/smarty/templates_c/");          // hier schreibt Smarty hin
$smarty->setConfigDir("$ROOT_DIR/smarty/configs/");               // brauchen wir nicht
$smarty->setCacheDir("$ROOT_DIR/smarty/cache/");                  // brauchen wir nicht
```

`new` und `->` musst du noch nicht verstehen (Kapitel 10). Diese sieben Zeilen schreibst du nie wieder neu, du kopierst sie und änderst nur `$ROOT_DIR`.

Smarty 5 (unsere Version) schreibt die Klasse `Smarty\Smarty`. In älteren Anleitungen im Internet steht `new Smarty()` ohne `Smarty\` davor: das ist Smarty 3/4 und gibt bei dir `Class "Smarty" not found`.

### B.3 Abtippen: Beispiele 7.1 bis 7.4

Öffne `helloWorldSmarty.php` und `smarty/templates/helloWorld.tpl` nebeneinander und ruf die Seite auf. Dann `helloWorldSmarty2.php`: gleiche Ausgabe, aber die Einrichtung steht in `includes/startTemplate.inc.php`. **So machst du es ab jetzt immer.**

Drück im Browser **Strg+U**: Der Browser sieht nur fertiges HTML, kein `{$ausgabe}` und kein PHP.

### B.4 Was ist `templates_c`?

Smarty übersetzt jedes `.tpl` beim ersten Aufruf in eine PHP-Datei und speichert sie in `templates_c/`. Schau nach dem Aufruf in Eclipse (F5) hinein: Da liegt jetzt eine Datei wie `…_0.file_helloWorld.tpl.php`. Weil **der Webserver** (Benutzer `www-data`) diese Datei schreibt und nicht du, braucht er Schreibrechte auf den Ordner. Fehlen sie, kommt:

```
Fatal error: Uncaught --> Smarty: unable to write file …/templates_c/…
```

Abhilfe (genau das meint der Dozent mit „Schreibrechte für templates_c setzen“):

```bash
chmod 777 smarty/templates_c
```

oder in der Dateiverwaltung: Rechtsklick auf `templates_c` → Eigenschaften → Zugriffsrechte → für Besitzer, Gruppe **und** Andere „Dateien erstellen und löschen“.

> **Selbst ausprobieren (5 Minuten), jeweils danach rückgängig machen:**
> 1. **Schreibrechte weg:** `chmod 555 smarty/templates_c`, dann in Eclipse den Inhalt von `templates_c` löschen und `helloWorldSmarty2.php` neu laden → `unable to write file`. Zurück mit `chmod 777 smarty/templates_c`.
> 2. **Template-Name falsch:** in `helloWorldSmarty2.php` `display('helloworld.tpl')` (kleines w) → `Unable to load 'file:helloworld.tpl'`. Linux unterscheidet Groß-/Kleinschreibung auch bei Dateinamen.
> 3. **Tippfehler im Template:** in `helloWorld.tpl` `{$ausgab}` statt `{$ausgabe}` → die Seite ist einfach **leer**, ohne jede Fehlermeldung. Das ist der gemeinste Smarty-Fehler: Wenn ein Wert fehlt, vergleiche den Namen im `assign` mit dem im Template, Buchstabe für Buchstabe.
> 4. **Leerzeichen:** `{ $ausgabe }` → im Browser steht wörtlich `{ $ausgabe }`. Nach `{` darf kein Leerzeichen kommen.

---

## Teil C: Das Root-Verzeichnis (S. 64–65)

`$ROOT_DIR` ist der **Dateipfad** (nicht die URL) zu deinem Projektordner. Bei dir:

| Wo | `$ROOT_DIR` |
|---|---|
| Vorlesungsbeispiele | `/var/www/html/iks/Kapitel7/Vorlesungsmaterialien` |
| Aufgabe 7.1 | `/var/www/html/iks/Kapitel7/Loesungen/aufgabe_7_1` |
| Klausur | `/var/www/html/iksy05/<DeinName>` (steht in der Aufgabenstellung) |

`/var/www/html/iks` ist deine Verknüpfung auf `~/eclipse-workspace/IKSY1`, deshalb funktioniert auch `/home/themachine/eclipse-workspace/IKSY1/Kapitel7/...`. Nimm trotzdem die `/var/www/html/…`-Form, die entspricht der Klausur.

Wichtig für die Klausur: **Es gibt genau eine Stelle mit dem Pfad**, die Zeile `$ROOT_DIR` in `startTemplate.inc.php`. Kopierst du dein Projekt in einen anderen Ordner, änderst du nur diese Zeile (und setzt die Rechte auf `templates_c`). Steht der Pfad noch irgendwo anders, ist das ein Fehler.

> **Selbst ausprobieren:** Ändere in `startTemplate.inc.php` `Kapitel7` in `kapitel7`. `helloWorldSmarty2.php` → `Failed opening required …/vendor/autoload.php`. Dieselbe Meldung wie bei fehlendem `vendor/` (Teil A). Wenn du sie siehst, prüf zuerst den `$ROOT_DIR`. Zurückändern.

---

## Teil D: Euro-Dollar-Umrechnung (S. 65–66)

Das ist das Muster für Aufgabe 7.1. Drei Dateien:

| Datei | Inhalt |
|---|---|
| `euro1.html` | Formular, `action="./euro1.php"`, reines HTML, braucht kein Template |
| `euro1.php` | `require_once` Einrichtung → `$_POST` lesen → rechnen → 3× `assign` → `display` |
| `smarty/templates/euro1.tpl` | HTML mit `{$eurobetrag}`, `{$kurs}`, `{$dollarbetrag}` |

Probier es aus: Kurs `1.08`, Euros `250` → `250 Euro entspricht bei einem Kurs von 1.08 270 Dollar!`

> **Selbst ausprobieren (Trennung von Logik und Darstellung):** Bau **nur `euro1.tpl`** so um, dass das Ergebnis als Tabelle erscheint (Zeilen „Eurobetrag“, „Kurs“, „Dollarbetrag“). `euro1.php` fasst du dabei nicht an. Genau das ist der Sinn von Smarty, und genau so baust du in der Klausur die Ausgabe-Tabelle.

---

## Teil E: Was du in Templates sonst noch brauchst

Das Skript zeigt in Kapitel 7 nur `{$variable}`. Für saubere Ausgaben brauchst du schon jetzt diese Dinge:

### E.1 Zahlen formatieren: Modifier

Hinter einen Wert kann ein `|` mit einem **Modifier** kommen. Für Beträge:

```smarty
{$monatlicheBelastung|number_format:2:",":"."} €
```

Das macht dasselbe wie `number_format($monatlicheBelastung, 2, ",", ".")` aus Kapitel 6: `1200` → `1.200,00`. Die Parameter werden mit `:` statt mit `,` getrennt. Damit bleibt die Formatierung im Template und die PHP-Datei rechnet nur.

Achtung: `number_format` stürzt bei einem **leeren** Wert ab (`must be of type ?float, string given`), z. B. wenn jemand das Formular ohne Eingabe abschickt. Deshalb `required` im Formular. Die serverseitige Prüfung kommt mit `if` in Kapitel 8.

### E.2 Konstanten im Template

Konstanten gibst du wie Variablen mit `assign` weiter:

```php
define("ZINSSATZ_PROZENT", 5);
...
$smarty->assign('zinssatzProzent', ZINSSATZ_PROZENT);
```

```smarty
Zinssatz: {$zinssatzProzent} %
```

(Smarty kann Konstanten auch direkt mit `{$smarty.const.ZINSSATZ_PROZENT}` lesen. Die Musterlösungen machen es mit `assign`, bleib dabei.)

### E.3 Geschweifte Klammern in CSS

Smarty hält alles mit `{` für sich. In einem `<style>`-Block im Template geht `body { color: red; }` gut (Leerzeichen nach `{`), aber `body {color:red;}` nicht. Am einfachsten: CSS immer in eine eigene `.css`-Datei und mit `<link>` einbinden, wie in der Klausur.

### E.4 Pfade im Template

Ein Link im Template (`<link href="formular.css">`, `<a href="index.php">`) bezieht sich auf die **URL der aufgerufenen PHP-Seite**, nicht auf den Ordner `smarty/templates/`. `formular.css` liegt also neben der `.php`, nicht neben der `.tpl`.

### E.5 Vorschau

Im Template von Probeklausur 2 siehst du schon `{if}`, `{else}` und `{foreach}`. Die kommen mit Kapitel 8 und 11.

---

## Teil F: Aufgaben

Alle Lösungen in `~/eclipse-workspace/IKSY1/Kapitel7/Loesungen/`, jede Aufgabe in **einem eigenen Ordner** mit eigener `composer.json`, eigenem `vendor/` und eigenem `smarty/`, so wie später in der Klausur. Kommentare sind keine Pflicht. Bewertet wird wie in der Klausur: Konstanten, sprechende Namen, HTML5-Validierung, gültiges HTML, richtige Ausgabe, keine HTML-Ausgabe in der PHP-Datei.

Neuen Aufgabenordner einrichten (jedes Mal gleich):

```bash
cd ~/eclipse-workspace/IKSY1/Kapitel7/Loesungen
mkdir -p aufgabe_7_1/includes aufgabe_7_1/smarty/templates aufgabe_7_1/smarty/templates_c
cd aufgabe_7_1
composer require smarty/smarty
chmod 777 smarty/templates_c
```

Dann `startTemplate.inc.php` aus den Vorlesungsmaterialien nach `includes/` kopieren und den `$ROOT_DIR` anpassen.

### Aufgabe 7.1 (Skript): Darlehen mit Smarty

> Sie sollen für eine Bank die Errechnung von Darlehenskonditionen für Kunden der Bank über das Internet ermöglichen. Eingegeben werden soll das Eigenkapital und der Preis der Immobilie, die gekauft werden soll. Der Zinssatz ist 5 %, die Tilgung 1 %. Das Programm soll die monatliche Belastung ausgeben.

Fachlich: **Darlehensbetrag = Immobilienpreis − Eigenkapital.** Zins und Tilgung beziehen sich auf den Darlehensbetrag und gelten **pro Jahr**. Die monatliche Belastung ist also Darlehensbetrag × (Zinssatz + Tilgung) ÷ 12.

Dateien in `Loesungen/aufgabe_7_1/`:

- `aufgabe_7_1.html`: Formular mit Immobilienpreis und Eigenkapital. HTML5-Validierung: beide `required`, `type="number"`, sinnvolles `min` und `step` (Euro mit Cent). `<html lang="de">`, `label for` zu jedem Feld, `formular.css` eingebunden.
- `aufgabe_7_1.php`: **ganz oben** die Konstanten für Zinssatz und Tilgung (sprechende Namen, Zahlen ohne Anführungszeichen) und, wenn du sie brauchst, für die 12 Monate. Danach Einrichtung einbinden, `$_POST` lesen, rechnen, `assign`, `display`. **Kein `echo`, kein HTML** in dieser Datei.
- `includes/startTemplate.inc.php` mit dem richtigen `$ROOT_DIR`.
- `smarty/templates/aufgabe_7_1.tpl`: gültiges HTML5. Eine Tabelle mit Immobilienpreis, Eigenkapital, Darlehensbetrag, Zinssatz, Tilgung und monatlicher Belastung. Beträge mit zwei Nachkommastellen und Komma (Modifier aus E.1). Zinssatz und Tilgung kommen aus den Konstanten, nicht als Text ins Template geschrieben.

Testwerte:

| Immobilienpreis | Eigenkapital | Darlehensbetrag | monatliche Belastung |
|---|---|---|---|
| 300000 | 60000 | 240.000,00 € | **1.200,00 €** |
| 250000 | 50000 | 200.000,00 € | **1.000,00 €** |
| 185000 | 37000 | 148.000,00 € | **740,00 €** |
| 199999.99 | 20000 | 179.999,99 € | **900,00 €** |

Gegenprobe: Ändere nur die Zinssatz-Konstante auf 4. Dann muss bei 300000/60000 **1.000,00 €** herauskommen und in der Tabelle „4 %“ stehen, ohne dass du an Template oder Rechnung etwas änderst. Danach zurück auf 5.

HTML prüfen: Ergebnisseite aufrufen, **Strg+U**, Quelltext kopieren und bei https://validator.w3.org/#validate_by_input einfügen. Ziel: keine Fehler.

(Was passiert, wenn das Eigenkapital größer ist als der Preis? Abfangen kannst du das erst mit `if` in Kapitel 8. Dort bauen wir genau diese Aufgabe weiter aus.)

### Aufgabe 7.2 (Zusatz, klausurnah): Copy-Shop im Klausur-Aufbau

Dein Copy-Shop aus 6.5 bekommt jetzt den Aufbau einer Klausurlösung: **auch das Formular ist ein Template**, und die Grenzen im Formular kommen aus Konstanten.

Ordner `Loesungen/aufgabe_7_2_copyshop/`:

```
aufgabe_7_2_copyshop/
├── index.php                      zeigt das Formular
├── loesung.php                    rechnet und zeigt das Ergebnis
├── formular.css
├── includes/
│   ├── startTemplate.inc.php
│   └── copyshopKonstanten.inc.php
└── smarty/
    ├── templates/
    │   ├── index.tpl              Formular
    │   └── loesung.tpl            Ergebnistabelle
    └── templates_c/
```

- `copyshopKonstanten.inc.php`: die drei Preise aus 6.5 **plus** die Grenzen für das Formular: `MIN_ANZAHL` (1), `MAX_ANZAHL_SEITEN` (500), `MAX_ANZAHL_EXEMPLARE` (100).
- `index.php`: Konstanten und Smarty einbinden, die drei Grenzen per `assign` übergeben, `index.tpl` anzeigen. Sonst nichts.
- `index.tpl`: dein Formular aus 6.5 mit `action="loesung.php"`. In `min` und `max` steht **keine Zahl**, sondern `{$…}` aus den Konstanten.
- `loesung.php`: Konstanten und Smarty einbinden, rechnen wie in 6.5, alle Werte per `assign` übergeben, `loesung.tpl` anzeigen. Kein `echo`, kein HTML.
- `loesung.tpl`: die Tabelle aus 6.5 und die Zeile `Preise: 0,05 € pro Seite, 2,50 € Bindung pro Exemplar, 19 % MwSt.`, alle Zahlen per Modifier formatiert. Darunter ein Link `Neue Berechnung` zurück auf `index.php`.
- Aufruf: `http://localhost/iks/Kapitel7/Loesungen/aufgabe_7_2_copyshop/index.php`

Test wie in 6.5: 40 Seiten, 3 Exemplare → 6,00 / 7,50 / 13,50 / 2,57 / **16,07**. 250 Seiten, 4 Exemplare → 50,00 / 10,00 / 60,00 / 11,40 / **71,40**.

Gegenprobe: `MAX_ANZAHL_SEITEN` auf 300 setzen. Im Formular wird 301 jetzt abgelehnt, ohne dass du `index.tpl` anfasst (Strg+U zeigt `max="300"`). Danach zurück auf 500.

### Aufgabe 7.3 (Klausur-Vorlage, Schritt 1): Grundgerüst mit allen Bibliotheken

Jetzt beginnt deine Vorlage für den USB-Stick. Sie wächst mit jedem Kapitel (Kapitel 10: Berechnungsklasse und TCPDF, Kapitel 12: DbFunctions, Kapitel 13: Sicherheit).

1. Lege `~/eclipse-workspace/IKSY1/Klausur_Vorlage/` an, darin `includes/`, `klassen/` (bleibt vorerst leer), `css/`, `smarty/templates/`, `smarty/templates_c/`.
2. Kopiere `composer.json` und `composer.lock` aus `Probeklausur2/`. Die haben schon **Smarty, TCPDF und SVGGraph** drin, also alles, was eine Klausur braucht. Dann im Ordner `composer install` und `chmod 777 smarty/templates_c`.
3. `includes/startTemplate.inc.php` mit `$ROOT_DIR = '/var/www/html/iks/Klausur_Vorlage'`.
4. `css/formular.css` (deine aus Kapitel 6).
5. `loesung.php`: oben eine Beispielkonstante (z. B. `define("MAX_GRENZE", 100);`), dann Smarty einbinden, eine Variable `$ueberschrift = "Klausur-Vorlage";` und die Konstante per `assign` übergeben, `loesung.tpl` anzeigen.
6. `smarty/templates/loesung.tpl`: gültiges HTML5-Grundgerüst (`lang="de"`, `charset`, `title`, `<link>` auf `css/formular.css`), `<h2>{$ueberschrift}</h2>` und ein Formular mit einem Zahlenfeld, dessen `max` aus der Konstanten kommt. `action` ist vorerst `loesung.php`, das Auswerten kommt in Kapitel 8.
7. Test: `http://localhost/iks/Klausur_Vorlage/loesung.php` zeigt Überschrift und Formular, der W3C-Validator meldet keine Fehler.

**Umzugsprobe (das ist die Klausur-Situation):** Kopiere in Eclipse den ganzen Ordner `Klausur_Vorlage` als `Klausur_Test`. Was musst du ändern, damit `http://localhost/iks/Klausur_Test/loesung.php` läuft? Es sind höchstens **zwei Dinge**. Mach es, teste es, schreib mir, was du ändern musstest, in deiner Antwort und lösch `Klausur_Test` danach wieder.

---

Wenn du fertig bist (gern auch nach jeder Aufgabe), schreib mir „fertig“ im Thread. Ich lese deine Dateien direkt in `~/eclipse-workspace/IKSY1/Kapitel7/Loesungen/` und `Klausur_Vorlage/`, korrigiere sie und erkläre Fehler. Erst danach gibt es eine Musterlösung.

---

## Spickzettel Kapitel 7 (für die Klausur-Mappe)

### Ordneraufbau

```
<Projekt>/
├── composer.json, composer.lock
├── vendor/                          (auf den USB-Stick, nicht ins Git)
├── loesung.php
├── css/
├── includes/startTemplate.inc.php
├── klassen/
└── smarty/templates/loesung.tpl
    smarty/templates_c/              chmod 777 !
```

### Composer

```bash
composer require smarty/smarty    # Paket hinzufügen + installieren (neues Projekt)
composer install                  # vendor/ aus composer.json/.lock herstellen
```

In der Klausur kein Internet: `vendor/` muss schon da sein.

### startTemplate.inc.php

```php
<?php
    $ROOT_DIR='/var/www/html/iksy05/DeinName';          // NUR hier steht der Pfad
    require_once("$ROOT_DIR/vendor/autoload.php");

    $smarty=new Smarty\Smarty();
    $smarty->setTemplateDir("$ROOT_DIR/smarty/templates/");
    $smarty->setCompileDir("$ROOT_DIR/smarty/templates_c/");
    $smarty->setConfigDir("$ROOT_DIR/smarty/configs/");
    $smarty->setCacheDir("$ROOT_DIR/smarty/cache/");
?>
```

### PHP-Seite

```php
<?php
    define("ZINSSATZ_PROZENT", 5);                       // Konstanten ganz oben
    require_once("./includes/startTemplate.inc.php");

    $eingabe = $_POST['eingabe'];
    $ergebnis = $eingabe * ZINSSATZ_PROZENT / 100;

    $smarty->assign('eingabe', $eingabe);
    $smarty->assign('ergebnis', $ergebnis);
    $smarty->assign('zinssatzProzent', ZINSSATZ_PROZENT);
    $smarty->display('loesung.tpl');                     // als Letztes, kein echo
?>
```

### Template

```smarty
{$ergebnis}                                   Wert ausgeben (kein Leerzeichen nach {)
{$betrag|number_format:2:",":"."} €           1234.5 → 1.234,50 €
<input type="number" name="x" min="{$minGrenze}" max="{$maxGrenze}" required>
```

### Fehlermeldungen

| Meldung | Ursache |
|---|---|
| `Failed opening required '…/vendor/autoload.php'` | `$ROOT_DIR` falsch (Groß-/Kleinschreibung!) oder `vendor/` fehlt → `composer install` |
| `Failed opening required '…/autoload.php;'` | Semikolon im String (Tippfehler aus dem Skript) |
| `Smarty: unable to write file …templates_c…` | `chmod 777 smarty/templates_c` |
| `Smarty: Unable to load 'file:x.tpl'` | Template-Name falsch oder `.tpl` liegt nicht in `smarty/templates/` |
| `Class "Smarty" not found` | `new Smarty()` statt `new Smarty\Smarty()` (Smarty 5) |
| Wert fehlt im Browser, **keine** Meldung | Name in `assign` und `{$…}` unterschiedlich geschrieben |
| `{ $wert }` steht wörtlich im Browser | Leerzeichen nach `{` |
| `… number_format(): Argument #1 ($num) must be of type ?float, string given` | leerer Wert, z. B. Formular ohne Eingabe abgeschickt |
| CSS kaputt, Smarty-Syntaxfehler im `<style>` | `{` ohne Leerzeichen in CSS → CSS in eigene Datei |
