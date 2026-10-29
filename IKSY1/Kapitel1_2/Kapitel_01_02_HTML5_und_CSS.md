# Kapitel 1 und 2: HTML5-Grundstruktur und erste Formatierung mit CSS

Skript `phpScript.pdf`, Seiten 3–18 · Beispiele: `Vorlesungen/1_2` und `Vorlesungen/css` · Aufgaben 2.1–2.3

So gehst du vor: Lies Teil A und B, öffne dabei die Beispieldateien, und probiere die kleinen „Selbst ausprobieren“-Schritte aus. Dann löst du in Teil C die drei Aufgaben selbst. Lösungen von mir gibt es erst, wenn du deine Dateien abgelegt hast.

---

## Teil A: Kapitel 1, Einleitung (S. 3–6)

### Was HTML ist

**HTML** (Hypertext Markup Language) ist eine **Auszeichnungssprache**, keine Programmiersprache. Sie rechnet nichts und entscheidet nichts. Sie sagt nur, *was* ein Stück Text **ist**: eine Überschrift, ein Absatz, ein Link, eine Liste.

Das Beispiel im Skript ist ein Zeitungsartikel:

```html
<h1>Professoren schreiben neues HTML Script</h1>
<p>Bochum: Prof. Dr. Blümel und Prof. Dr. Klingspor sind Professoren ...</p>
```

### Die vier Grundbegriffe (klausur- und prüfungsrelevant als Vokabular)

| Begriff | Bedeutung | Beispiel |
|---|---|---|
| **Tag** | Ein „Befehl“ in spitzen Klammern | `<h1>` |
| **Starttag / Endtag** | Öffnet bzw. schließt; der Endtag hat einen `/` vor dem Namen | `<p>` … `</p>` |
| **Element** | Starttag + Inhalt + Endtag zusammen | `<p>Text</p>` |
| **Attribut** | Zusatzinfo im Starttag, immer `name="wert"` | `<a href="seite.html">` |

`h1` steht für *heading* (Überschrift 1. Ordnung, es gibt `h1` bis `h6`), `p` für *paragraph* (Absatz).

### Die wichtigste Idee: Struktur und Aussehen trennen

HTML beschreibt **nur die Struktur** (was ist Überschrift, was ist Text), **nicht** das Aussehen (fett, rot, groß). Warum?

- Ein **Screenreader** für Sehbehinderte liest „Überschrift: …“ vor. Mit „großer fetter Text“ kann er nichts anfangen.
- Ein **Handy** soll die Seite anders darstellen als ein großer Monitor.

Dass Überschriften trotzdem groß und fett erscheinen, liegt an der **Standardformatierung des Browsers**. Die ist in jedem Browser etwas anders (Firefox ≠ Chrome).

Das Aussehen legt man mit **CSS** (Cascading Style Sheets) fest. Beispiel 1.2:

```html
<style type="text/css">
  h1 { color: red; }
  p  { font-family: sans-serif; }
</style>
```

Lies das so: „Alle `h1`-Elemente bekommen rote Schrift. Alle `p`-Elemente bekommen eine Schrift ohne Serifen.“ (Serifen sind die kleinen „Füßchen“ an Buchstaben, wie bei Times New Roman.)

### Ein Detail, das das Skript absichtlich zeigt

In Abbildung 1.2 werden die **Umlaute falsch** dargestellt. Das liegt daran, dass dem verkürzten Beispiel die Angabe der Zeichenkodierung fehlt. Die Lösung (`<meta charset="UTF-8">`) kommt in Kapitel 2. Merke dir: **fehlende Kodierung = kaputte Umlaute.**

### Geschichte in fünf Sätzen (1.1)

1. Anfang der **90er** entwickelt **Tim Berners-Lee** am **CERN** HTML, zuerst für Forschungsergebnisse.
2. Damals kaum Layout: langsames Internet, kaum Farbmonitore.
3. Zweite Hälfte der 90er: **Browserkrieg** Microsoft gegen Netscape. Beide erfinden eigene Layout-Tags, die Dialekte driften auseinander, HTML beschreibt immer mehr Aussehen statt Struktur.
4. Mit **HTML4** kommt **CSS**, um das wieder zu trennen. Richtig durchgesetzt hat sich die Trennung erst mit den **Smartphones**.
5. **HTML5** wird im **Oktober 2014** vom **W3C** (World Wide Web Consortium) verabschiedet; es bringt einheitliche Regeln und Video/Audio.

---

## Teil B: Kapitel 2, Die HTML5-Grundstruktur (S. 7–18)

### B.1 Das vollständige Gerüst (Beispiel 2.1)

Öffne dazu das Beispiel aus `Vorlesungen/1_2` (im Skript heißt die Datei `beispiel.html`) im Browser **und** in Eclipse nebeneinander.

Jedes HTML5-Dokument hat dieses Gerüst. Das solltest du irgendwann auswendig hinschreiben können:

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Webseitengestaltung mit HTML und CSS</title>
</head>
<body>
    ... sichtbarer Inhalt ...
</body>
</html>
```

Zeile für Zeile:

- **`<!DOCTYPE html>`** muss ganz oben stehen. Er sagt dem Browser „das ist HTML5“. Es gibt keine Versionsnummer, weil HTML5 als letzte Version gilt und nur noch fortlaufend weiterentwickelt wird.
- **`<html>` … `</html>`** ist das **Wurzelelement**. Alles andere steckt darin. Es hat genau zwei Kinder: `head` und `body`.
- **`<head>`** beschreibt das Dokument selbst. Sein Inhalt wird **nicht** im Fenster angezeigt; er ist für Browser und Suchmaschinen.
  - **`<title>`** erscheint in der Titelleiste bzw. im Tab, und Suchmaschinen zeigen ihn als Überschrift des Treffers.
  - **`<meta charset="UTF-8">`** sagt, in welcher Kodierung die Datei gespeichert ist. UTF-8 kann alle Schriftzeichen der Welt (auch Umlaute, Griechisch, Chinesisch) und ist der Standard im Netz. **Wichtig:** Die Datei muss dann auch wirklich als UTF-8 gespeichert sein. In Eclipse hast du das bei der Einrichtung eingestellt (Window → Preferences → General → Workspace → Text file encoding: UTF-8). Für eine einzelne Datei prüfst du es mit Rechtsklick → **Properties** → „Text file encoding“.
- **`<meta>` ist ein leeres Element**: es hat keinen Inhalt und keinen Endtag. Man darf es auch `<meta charset="UTF-8" />` schreiben (Kurzschreibweise mit Schrägstrich am Ende). Beides ist in HTML5 korrekt; das Skript benutzt beide Varianten.
- **`<body>`** enthält alles, was man sieht.

> **Selbst ausprobieren:** Lösche in einer Kopie (in deinem Lösungsordner, nicht im Original!) die `meta charset`-Zeile und lade neu. Sieh dir an, was mit „Einführung“ passiert. Je nach Browser und Server siehst du vielleicht keinen Unterschied, weil Apache die Kodierung oft mitschickt. Öffne die Datei dann einmal direkt per Doppelklick (file://) statt über localhost.

### B.2 Die semantischen Strukturelemente

„Semantisch“ heißt: das Element hat eine **Bedeutung**. So sieht der `body` des Beispiels als Baum aus:

```
body
├── header.banner        Kopfbereich: Banner, Firmenname
├── nav                  Navigationsbereich (Menü)
│   ├── h1               "Navigationsbereich"
│   └── ul               ungeordnete Liste
│       └── li × 5       je ein Listeneintrag mit einem <a>-Link
├── main                 der eigentliche Seiteninhalt (höchstens 1× pro Seite!)
│   └── article          ein in sich geschlossener Artikel
│       ├── header       Kopf des Artikels mit h1
│       ├── section      Abschnitt "Auszeichnungssprache" (h2 + p)
│       ├── section      Abschnitt "Standard" (h2 + p mit <em>)
│       └── aside        Randnotiz "Quellenangaben" (h2 + ul mit Links)
└── footer               Fußzeile
    ├── div#impress      "Impressum"
    └── div#design       "Design"
```

| Element | Bedeutung | Hinweis |
|---|---|---|
| `header` | Kopfbereich | darf auch in `article`/`section` vorkommen (siehe Artikel-Header) |
| `nav` | Navigation, Menü | Screenreader finden so sofort das Menü |
| `main` | Hauptinhalt | **einziges Element, das nur einmal pro Seite erlaubt ist** |
| `article` | eigenständiger Inhalt (Artikel, Beitrag) | darf weitere `article` enthalten |
| `section` | thematischer Abschnitt, meist mit Überschrift | darf auch außerhalb von `article` stehen |
| `aside` | Randnotiz, Nebeninfo | |
| `footer` | Fußbereich | |
| `div` | **ohne Bedeutung**, reiner Container | nur verwenden, wenn kein semantisches Element passt |
| `em` | betont (*emphasis*), meist kursiv dargestellt | |
| `ul` / `li` | ungeordnete Liste / Listeneintrag | geordnete Liste wäre `ol` |

Die Struktur ist **nicht vorgeschrieben**. Du darfst Elemente verschachteln und wiederholen (Ausnahme: `main`). `article`, `section`, `nav` und `aside` bilden eigene Inhaltsbereiche, deshalb setzen viele Browser Überschriften darin kleiner.

### B.3 Links mit `<a>`

```html
<a href="http://www.hochschule-bochum.de" target="_blank">Hochschule Bochum</a>
```

- **`href`** ist das Ziel (eine URL):
  - **absolut**: mit Protokoll und Server, z. B. `http://www.hochschule-bochum.de`
  - **relativ** zur aktuellen Datei, z. B. `tabellen.html` (gleicher Ordner) oder `../css/style.css` (`..` = eine Ebene hoch)
- **`target="_blank"`** öffnet das Ziel in neuem Tab/Fenster. Ohne das Attribut ersetzt die neue Seite die aktuelle.
- Der **Inhalt** („Hochschule Bochum“) ist der klickbare Text.

### B.4 `class` und `id`, die Haken für CSS

- **`class="banner"`**: ein Name, den **beliebig viele** Elemente tragen dürfen. In CSS mit einem **Punkt**: `.banner`
- **`id="impress"`**: ein Name, der auf der Seite **nur einmal** vorkommen darf. In CSS mit einer **Raute**: `#impress`

Das ist die Brücke zwischen HTML und CSS. Später in PHP/JavaScript brauchst du `id` übrigens ständig.

---

### B.5 CSS einbinden (S. 12–13)

Man **könnte** CSS in ein `<style>`-Element schreiben (wie in Kapitel 1). Besser ist eine **eigene Datei**, damit mehrere Seiten dasselbe Layout teilen. Dazu kommt eine Zeile in den `head`:

```html
<link rel="stylesheet" href="../css/style.css" type="text/css">
```

- `link` bindet eine andere Datei ein (leeres Element),
- `rel="stylesheet"` sagt, welche Art Datei,
- `href` ist der Pfad. `../css/style.css` heißt: eine Ebene hoch, dann in den Ordner `css`. Deshalb liegen die Beispiele in `Vorlesungen/1_2` und das Stylesheet in `Vorlesungen/css`.
- `type="text/css"` ist der Medientyp (in HTML5 optional).

> **Häufigster Anfängerfehler:** falscher relativer Pfad, dann sieht die Seite „nackt“ aus. Prüfen: F12 → Reiter **Netzwerk** (oder **Konsole**) → steht dort `style.css` mit **404**? Dann stimmt der Pfad nicht.

### B.6 Aufbau einer CSS-Regel

```css
html { font-family: sans-serif; }
```

```
selektor { eigenschaft: wert; eigenschaft: wert; }
   │           └────── Deklaration ──────┘
   └ welche Elemente
```

- **Selektor**: welche Elemente formatiert werden.
- **Deklaration**: `Eigenschaft: Wert;` (Semikolon nicht vergessen).
- **Vererbung**: Die Schrift von `html` „vererbt“ sich an alle Kinder, deshalb ist dann die ganze Seite serifenlos. (Nicht alle Eigenschaften vererben sich: `color` und `font-*` ja, `border`, `padding`, `margin` nein.)

Die erste Zeile der Datei, `@CHARSET "UTF-8";`, ist die Kodierungsangabe für die CSS-Datei, genau wie `meta charset` beim HTML.

### B.7 Die vier Selektorarten aus dem Kapitel

| Selektor | Wählt aus | Beispiel aus `style.css` |
|---|---|---|
| `element` | alle Elemente dieses Typs | `nav`, `main`, `article`, `aside`, `footer` |
| `element.klasse` | nur Elemente dieses Typs **mit** dieser Klasse | `header.banner` (der Banner, aber nicht der Artikel-Header) |
| `#id` | das eine Element mit dieser ID | `#impress`, `#design` |
| `a b` (Leerzeichen) | `b`, das **irgendwo innerhalb** von `a` liegt (Nachfahre) | `nav h1`, `nav ul`, `nav ul li` |

Die Kombination ist das Mächtige: `nav ul li` trifft nur Listeneinträge im Menü, **nicht** die Liste mit den Quellenangaben im `aside`.

### B.8 Das Box-Modell: `padding`, `border`, `margin`

Jedes Element ist ein Rechteck aus Schichten, von innen nach außen:

```
┌──────────── margin (Außenabstand, zu den Nachbarn) ────────────┐
│  ┌──────────── border (Rahmen) ────────────────────────────┐   │
│  │  ┌──────── padding (Innenabstand) ──────────────────┐   │   │
│  │  │              Inhalt (content)                    │   │   │
│  │  └──────────────────────────────────────────────────┘   │   │
│  └─────────────────────────────────────────────────────────┘   │
└────────────────────────────────────────────────────────────────┘
```

**Die Uhrzeiger-Regel** für `padding` und `margin` (oben, rechts, unten, links; fehlende Werte nimmt man von der Gegenseite):

| Schreibweise | oben | rechts | unten | links |
|---|---|---|---|---|
| `padding: 10px;` | 10 | 10 | 10 | 10 |
| `padding: 30px 0px;` | 30 | 0 | 30 | 0 |
| `padding: 1px 2px 3px;` | 1 | 2 | 3 | 2 |
| `padding: 1px 2px 3px 4px;` | 1 | 2 | 3 | 4 |
| `margin-right: 10px;` | – | 10 | – | – |

Eine einzelne Seite (`margin-right`) **überschreibt** einen vorher gesetzten Gesamtwert, wenn sie danach kommt. Das passiert in `nav ul li`: erst `margin: 0;`, dann `margin-right: 10px;`.

`border: grey solid 3px;` ist Kurzschreibweise für Farbe, Linienart (`solid` = durchgehend, sonst z. B. `dashed`, `dotted`) und Stärke. Die Reihenfolge ist egal.

### B.9 `style.css` Regel für Regel

Öffne `Vorlesungen/css/style.css` neben dem Browser. Für jede Regel: was sie bewirkt und warum.

**`header.banner`**
```css
width: 100%;                                  /* volle Breite des umgebenden Elements (body) */
background-image: url("../css/background.JPG"); /* Bild als Hintergrund */
font-size: 200%;                              /* doppelt so groß wie normal */
color: red;                                   /* SCHRIFTfarbe! nicht Hintergrund */
text-align: center;                           /* Text mittig */
padding: 30px 0px;                            /* oben/unten 30px Luft, links/rechts 0 */
```
Merke: **`color` ist immer die Schriftfarbe**, Hintergrund heißt `background-color`.

**`nav`**: hellgrauer Hintergrund, volle Breite, `margin: 0`, damit keine Lücke zum Banner entsteht (der Browser setzt sonst Standardabstände).

**`nav h1 { display: none; }`**: Die Überschrift „Navigationsbereich“ verschwindet **komplett, samt ihrem Platz**. Sie steht aber weiter im HTML, die Struktur der Seite bleibt also sauber. (Der Unterschied zu `visibility: hidden`: das macht unsichtbar, aber der Platz bleibt.)

**`nav ul { padding: 0; }`**: Listen haben standardmäßig links Innenabstand für die Aufzählungspunkte; der wird entfernt.

**`nav ul li`**
```css
display: inline;           /* nebeneinander statt untereinander, Aufzählungspunkte fallen weg */
margin: 0;
margin-right: 10px;        /* etwas Abstand zwischen den Menüpunkten */
text-transform: uppercase; /* immer GROSSBUCHSTABEN, egal wie im HTML geschrieben */
```

Hier steckt das wichtigste Konzept des Kapitels, **block vs. inline**:

| | **block** | **inline** |
|---|---|---|
| Anordnung | untereinander, jedes auf neuer Zeile | nebeneinander im Textfluss |
| Breite | nimmt volle verfügbare Breite | so breit wie der Inhalt, `width` wirkt nicht |
| Standard bei | `p`, `h1`–`h6`, `div`, `ul`, `li`, `header`, `nav`, `section` … | `a`, `em`, `span`, `strong` … |

Mit `display` kann man das umschalten. Genau so wird aus der senkrechten Liste die waagerechte Menüleiste.

**`main { margin: 0; }`**: kein Abstand zur Navigation.

**`article` und `aside`: die Randspalte rechts (der schwierigste Teil)**

```css
article {
    padding-right: 31%;     /* rechte 31 % frei halten für die Randnotiz (1 % Luft) */
    position: relative;     /* "Anker werfen": hierauf beziehen sich absolute Positionen */
    border: grey solid 3px;
}
aside {
    background-color: #EEEEEE;
    position: absolute;     /* raus aus dem normalen Fluss */
    top: 0; right: 0;       /* oben rechts im ANKER (dem article) */
    width: 30%; height: 100%;
    padding-left: 10px;
}
```

So funktioniert `position`:

- **`static`** (Standard): normaler Fluss, `top`/`left` usw. wirken nicht.
- **`relative`**: Das Element bleibt, wo es ist, wird aber zum **Bezugspunkt** für absolut positionierte Nachfahren. Das ist der „Anker“.
- **`absolute`**: Das Element wird aus dem Fluss genommen (die anderen tun so, als gäbe es es nicht) und mit `top`/`right`/`bottom`/`left` relativ zum **nächsten Vorfahren mit `position` ≠ static** platziert.

Die Logik in zwei Sätzen: Der Artikel lässt rechts 31 % leer. Das `aside` wird absolut genau in diese leere Ecke oben rechts gelegt, 30 % breit und so hoch wie der Artikel.

**Farben**: `lightgrey`, `salmon`, `red` sind Farbnamen. `#EEEEEE` ist **hexadezimal RGB**: je zwei Stellen Rot, Grün, Blau, von `00` bis `FF`. Gleiche Werte ergeben Grau; je höher, desto heller. `#000000` = schwarz, `#FFFFFF` = weiß, `#FF0000` = rot.

**`footer`, `#impress`, `#design`**: dasselbe Muster noch einmal. Der `footer` ist mit `position: relative` der Anker; die beiden `div`s werden absolut 15 % vom linken bzw. rechten Rand gesetzt.
Warum nicht einfach mit `margin`? Weil die `div`s `display: inline` sind und **inline-Elemente immer genau so breit wie ihr Inhalt** sind; man könnte sie so nicht sauber links und rechts verteilen.

### B.10 Einheiten

- **`px`**: feste Pixel.
- **`%`**: relativ zum umgebenden Element. Weil fast alle Breiten im Beispiel in % angegeben sind, passt sich die Seite an jede Fenstergröße an. Zieh das Fenster mal schmal und breit.

> **Selbst ausprobieren (sehr empfohlen):** Öffne die Beispielseite, drück **F12**, wähle mit dem Pfeil-Werkzeug oben links das `aside`. Rechts siehst du die CSS-Regeln und unten das **Box-Modell** als bunte Grafik. Schalte per Häkchen einzelne Eigenschaften ab (z. B. `position: absolute` oder `padding-right: 31%` beim `article`) und schau, was passiert. So verstehst du in 5 Minuten mehr als durch Lesen.

### B.11 Merkliste Kapitel 2

1. Gerüst: `<!DOCTYPE html>`, `html`, `head` (mit `meta charset="UTF-8"` und `title`), `body`
2. Semantische Elemente: `header`, `nav`, `main` (nur 1×), `article`, `section`, `aside`, `footer`; `div` nur als Notlösung
3. Link: `<a href="…" target="_blank">Text</a>`, absolute vs. relative URL
4. CSS extern: `<link rel="stylesheet" href="…">`
5. Selektoren: `element`, `.klasse`, `#id`, `vorfahre nachfahre`
6. Box-Modell: Inhalt → `padding` → `border` → `margin`, Uhrzeiger-Regel
7. `display`: `block` / `inline` / `none`
8. `position`: `relative` als Anker, `absolute` mit `top`/`right`/…
9. `color` = Schriftfarbe, `background-color` = Hintergrund, Hex-Farben `#RRGGBB`

---

## Teil C: Deine Aufgaben

**Regeln:** Alles kommt in den Ordner `Loesungen_Kapitel_02/` im IKS-Ordner. Die Originaldateien in `Vorlesungen/` bleiben unverändert (Kopieren zum Spielen ist erlaubt, aber nur in deinen Ordner). Speichere als UTF-8. Prüfe jede Seite im Browser unter `http://localhost/iks/Loesungen_Kapitel_02/…`.

Vorschlag für die Ordnerstruktur:

```
Loesungen_Kapitel_02/
├── aufgabe_2_1.html
├── aufgabe_2_2.html
├── aufgabe_2_3.html      (oder du baust 2.3 direkt in 2.2 ein, sag mir dann Bescheid)
└── css/
    └── style.css
```

### Aufgabe 2.1
> Erstellen Sie ein HTML-Dokument mit Ihrem Namen als Titel.

Prüfe: Steht dein Name im **Browser-Tab**? Ist das Gerüst vollständig (alle Pflichtteile aus B.1)?

### Aufgabe 2.2
> Erstellen Sie ein HTML-Dokument mit Kopf- und Fußbereich, Navigation und einer Section. Platzieren Sie die Navigation an den linken Fensterrand. Füllen Sie das Dokument mit beliebigem Inhalt und verwenden Sie die Möglichkeiten von CSS, um das Layout zu verändern.

Achtung, das ist **nicht** einfach eine Kopie des Beispiels: Im Beispiel liegt das Menü **oben als Leiste**, du sollst es **links als Spalte** haben. Überlege, welche Technik aus dem Kapitel du dafür umbauen kannst (Tipp: Schau dir genau an, wie das `aside` nach rechts kommt). Das CSS gehört in eine **eigene Datei**.

### Aufgabe 2.3
> Erstellen Sie eine Liste mit Links zu Ihren Lieblingsdozenten im Navigationsbereich.

Mindestens ein Link soll in einem **neuen Tab** öffnen. Überlege, ob die Einträge in der linken Spalte untereinander oder nebeneinander stehen sollten, und ob du dafür `display` ändern musst oder nicht.

### Verständnisfragen (kurz schriftlich beantworten, z. B. in `Loesungen_Kapitel_02/antworten.md`)

1. Warum soll HTML nur die Struktur beschreiben und nicht das Aussehen? Nenne zwei Gründe.
2. Was ist der Unterschied zwischen Tag und Element?
3. Was passiert, wenn `<meta charset="UTF-8">` fehlt?
4. Wann nimmst du `class`, wann `id`? Wie sprichst du sie in CSS an?
5. Welche Elemente trifft `nav ul li`, und welche **nicht**?
6. `margin: 5px 20px;`: wie groß ist der Außenabstand links?
7. Warum braucht das `article` `position: relative`, obwohl es selbst gar nicht verschoben wird?
8. Was ist der Unterschied zwischen `display: none` und `visibility: hidden`?

Wenn du fertig bist, schreib mir einfach „fertig“ im Thread. Ich lese dann deine Dateien, korrigiere sie und erkläre Fehler. Erst danach zeige ich dir eine Musterlösung.
