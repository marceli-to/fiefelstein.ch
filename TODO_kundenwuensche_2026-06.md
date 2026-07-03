# Kundenwünsche – Umsetzung (Stand 2026-06-29)

Quelle: E-Mail des Kunden + Design-PDF `FS0002_WEB_Desktop_260614.pdf` (5 Seiten).

Kurzfassung aus dem PDF:
- **S.1/S.3** Menü-Overlay: `Produkte` (fett) mit Produkt-Untermenü → `Brocante` (fett) → `Idee` → `Kontakt`. **Kein** `Boutique` mehr.
- **S.2** Produkte-Übersicht, Titel `Produkte: Alle / Accessoire / Buch / Möbel` (statt `Boutique:`).
- **S.4** Brocante-Übersicht (gleiches Karten-Layout wie Produkte), Titel `Brocante`.
- **S.5** Brocante Bild-Lightbox / Galerie.

---

## Frontend

### 1. Menüpunkt «Produkte» führt zur Produkte-Übersicht
- [ ] `resources/views/components/menu/wrapper.blade.php`: Der `Produkte`-Eintrag verlinkt aktuell auf `route('home')`. Stattdessen auf `route('product.listing')` verlinken (inkl. `:current` auf `product.listing`).

### 2. Navigationspunkt «Boutique» entfällt
- [ ] `resources/views/components/menu/wrapper.blade.php`: Das `<li>` mit `title="Boutique"` (→ `product.listing`) entfernen. Die Übersicht ist neu über «Produkte» erreichbar (siehe Punkt 1).
- [ ] Prüfen, ob `Boutique` an weiteren Stellen als Label auftaucht (z.B. Komponenten-Ordner `components/product/filters/boutique.blade.php`, `cards/boutique.blade.php` – Dateinamen können bleiben, aber sichtbare Texte prüfen).

### 3. Bild in Produkte-Übersicht → Produkt-Detailseite
- [ ] `resources/views/components/product/cards/boutique.blade.php`: `<x-media.picture>` in einen Link auf `route('product.show', ['product' => $product->slug])` einbetten.
- [ ] **Achtung Varianten:** In `listing.blade.php` werden auch `$product->variations` als Boutique-Karte gerendert. Klären, ob Varianten eine eigene Detailseite/Slug haben oder auf das Hauptprodukt verlinken sollen. Link nur setzen, wo ein gültiger Slug existiert.

### 4. Produkt-Detailseite: «Produkte:» im Titel entfällt
- [ ] `resources/views/pages/product/show.blade.php` (Zeile ~3): `Produkte: {{ $product->group_title }}` → nur `{{ $product->group_title }}`.

### 5. Übersichtstitel «Boutique» → «Produkte»
- [ ] `resources/views/pages/product/listing.blade.php`: `<h1>` Text `Boutique` → `Produkte` (Doppelpunkt + Filter-Liste bleiben). Entspricht PDF S.2.

### 6. Zusätzlicher Navigationspunkt «Brocante» nach den Produkten
- [ ] `resources/views/components/menu/wrapper.blade.php`: Den auskommentierten `Brocante`-`<li>` (→ `route('brocante')`, `:current` auf `brocante`) wieder aktivieren, **nach** dem Produkt-Untermenü und **vor** `Idee` platzieren (siehe PDF S.1).

### 7. Brocante-Übersichtsseite aufbauen (PDF S.4 / S.5)
> Route `GET /brocante` → `PageController@brocante` existiert, View `pages/brocante.blade.php` ist leer.
- [ ] **Entscheidung Datenmodell nötig** (siehe «Offene Fragen»): Woher kommen die Brocante-Artikel?
- [ ] `pages/brocante.blade.php` analog zu `pages/product/listing.blade.php` aufbauen (Titel `Brocante`, gleiches Karten-Grid).
- [ ] `PageController@brocante` mit Daten füllen (Action analog `GetProducts`).
- [ ] Bild-Lightbox/Galerie für Brocante-Detail prüfen (PDF S.5 – evtl. gleiche Swiper-Logik wie Produkt-Detail).

---

## Backend (Filament)

### 8. «Kategorien» umbenennen in «Produktkategorien»
- [ ] `app/Filament/Resources/ProductCategoryResource.php`:
  - `$navigationLabel = 'Kategorien'` → `'Produktkategorien'`
  - ggf. `$modelLabel` / `$pluralModelLabel` anpassen (`Kategorie`/`Kategorien` → `Produktkategorie`/`Produktkategorien`).
  - Navigationsgruppe bleibt `Einstellungen`.

### 9. Modul zur Anzeige der Brocante auf der Startseite
> Startseite rendert Karten aus `LandingPage->cards` via `App\Actions\Landing\GetCards` (Typen aktuell: `Produkt`, Text).
- [ ] Neuen Card-Typ «Brocante» einführen (oder Brocante-Artikel als wählbare Produkte), damit der Kunde sie in `LandingPageResource` der Startseite hinzufügen kann.
- [ ] `GetCards::execute()` um den neuen Typ erweitern.
- [ ] Entsprechende Karten-Komponente für die Startseite (`components/product/cards/...`).

### 10. Brocante-Verwaltung im Backend
> Abhängig von Entscheidung beim Datenmodell (siehe Offene Fragen).
- [ ] Falls eigene Entität: Model + Migration + `BrocanteResource` (analog `ProductResource`).
- [ ] Falls Produkt-Kategorie/Flag: Filter/Toggle im bestehenden `ProductResource`.

---

## Offene Fragen / Entscheidungen

1. **Brocante-Datenmodell:** Eigene Tabelle/Model `Brocante`, oder eine spezielle `ProductCategory` «Brocante», oder ein Flag auf `Product`?
   - Karten-Layout (Titel, Attribute, Preis, Lager, «Erwerben») ist identisch zu Produkten → spricht für Wiederverwendung der Product-Struktur.
   - Brocante ist im Menü aber **gleichrangig** zu «Produkte» und erscheint **nicht** in der Produkte-Übersicht → braucht eine klare Abgrenzung (eigenes Model **oder** ausgeschlossene Kategorie/Flag).
   - **Empfehlung:** Flag/dedizierte Kategorie auf `Product` + Scopes (`->produkte()` / `->brocante()`), damit `GetProducts`/Listing und Menü-Untermenü Brocante ausschliessen.
2. **Varianten-Verlinkung** (Punkt 3): Eigene Detailseite oder Link aufs Hauptprodukt?
3. **Brocante-Untermenü:** Soll «Brocante» im Menü ebenfalls Artikel-Unterpunkte zeigen (wie «Produkte») oder nur ein einzelner Link sein? (PDF S.1 zeigt nur den einzelnen Link.)
4. **Warenkorb/Bestellung** für Brocante-Artikel: gleicher Checkout-Flow wie Produkte?

---

## Betroffene Dateien (Übersicht)
- `resources/views/components/menu/wrapper.blade.php` (Punkte 1, 2, 6)
- `resources/views/components/product/cards/boutique.blade.php` (Punkt 3)
- `resources/views/pages/product/show.blade.php` (Punkt 4)
- `resources/views/pages/product/listing.blade.php` (Punkt 5)
- `resources/views/pages/brocante.blade.php` + `app/Http/Controllers/PageController.php` (Punkt 7)
- `app/Filament/Resources/ProductCategoryResource.php` (Punkt 8)
- `app/Actions/Landing/GetCards.php` + `LandingPageResource` + Startseiten-Karte (Punkt 9)
- neu/anzupassen je nach Datenmodell: Model/Migration/`BrocanteResource` oder `ProductResource` (Punkt 10)
