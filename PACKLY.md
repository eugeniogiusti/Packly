![Logo](public/img/logo.png)

# Packly — Contesto di Sviluppo

App web open source per la gestione delle liste di packing per i viaggi.
Personale, semplice, utile sia quando si parte che quando si ritorna.

---

## Stack

- **Laravel 13** + **SQLite** (`database/database.sqlite`)
- **SB Admin 2** — template grafico Bootstrap 4, pre-compilato in `public/`
- **Livewire** — per interazioni real-time (checkbox packing list)
- **Alpine.js** — per UI (modali, toggle)
- **Vite** — migrato da Laravel Mix

> Il CSS/JS del template è già compilato in `public/` — non serve `npm run build` per il layout.
> Vite serve solo per custom SCSS/JS in `resources/`.

---

## Moduli

### ✅ Modulo 0 — Setup
- Migrato da Laravel Mix a Vite
- SQLite configurato
- SB Admin 2 pulito (rimossi: About, Alerts, Messages, Settings, Activity Log)
- Dashboard con mock data per Packly
- Route `/` → redirect login

### 🔲 Modulo 1 — Viaggi (Trip)
CRUD viaggi. Migration + Model + Resource Controller + viste.

**Schema `trips`:**
```
id
user_id
name
destination
departure_date
return_date
type          → enum: beach | business | mountain | city
status        → enum: preparing | traveling | done
timestamps
```

**UX:**
- Modale per crea/modifica/elimina viaggio
- Lista viaggi nella dashboard
- Click viaggio → pagina packing list

### 🔲 Modulo 2 — Packing List
Lista item dentro un viaggio, per categoria. Spunta item. Progress bar.

**Schema `packing_items`:**
```
id
trip_id
name
category      → enum: documents | clothes | hygiene | tech | accessories | gear
packed        → boolean
order
timestamps
```

**UX:**
- Pagina dedicata `/trips/{id}`
- Raggruppati per categoria
- Checkbox real-time con Livewire
- Progress bar in cima
- Aggiungi/rimuovi item custom

### 🔲 Modulo 3 — Ritorno (Unpack)
Modalità ritorno per spuntare item rimessi a posto.

**Campo aggiuntivo su `packing_items`:**
```
unpacked → boolean
```

**UX:**
- Switch "Partenza / Ritorno" nella pagina del viaggio
- Stesso layout della packing list, logica invertita

### 🔲 Modulo 4 — Template
Salva lista come template. Crea viaggio da template. Default per tipo viaggio.

**Schema:**
```
templates:      id, user_id, name, type
template_items: id, template_id, name, category
```

**Template di default per tipo:**
- **Mare:** costume, crema solare, infradito, occhiali, telo
- **Business:** blazer, scarpe eleganti, laptop, biglietti da visita
- **Montagna:** scarponi, layers, zaino, kit pronto soccorso
- **Città:** scarpe comode, borsa a tracolla, powerbank

### 🔲 Modulo 5 — Dashboard
Sostituire i mock data con dati reali.

---

## Categorie Item

| Categoria   | Icona FA              | Esempi                                      |
|-------------|----------------------|---------------------------------------------|
| documents   | fa-passport          | Passaporto, carta identità, assicurazione   |
| clothes     | fa-tshirt            | T-shirt, pantaloni, scarpe, felpa           |
| hygiene     | fa-pump-soap         | Spazzolino, shampoo, crema solare           |
| tech        | fa-laptop            | Caricatori, powerbank, adattatori, cuffie   |
| accessories | fa-glasses           | Occhiali, borsa, cintura, orologio          |
| gear        | fa-hiking            | Attrezzatura specifica per attività         |

---

## UX Decisions

- **Modali** per: crea viaggio, modifica viaggio, conferma elimina
- **Pagina dedicata** `/trips/{id}` per la packing list
- **Duplica viaggio** con un click (riusa lista precedente)
- Progress bar per ogni viaggio
- Due stati per item: `packed` (partenza) / `unpacked` (ritorno)

---

## Cosa NON fare

- No subscription
- No feature bloat
- No AI, meteo, integrazioni esterne nel MVP
- Non complicare il flusso di creazione viaggio
- Non forzare troppe schermate

---

## File Chiave

| File | Descrizione |
|------|-------------|
| `routes/web.php` | Route principali |
| `resources/views/layouts/admin.blade.php` | Layout con sidebar e topbar |
| `resources/views/layouts/auth.blade.php` | Layout login/register |
| `resources/views/home.blade.php` | Dashboard (mock, da rendere reale al Modulo 5) |
| `vite.config.js` | Entry: sass/app.scss + js/app.js |
| `.env` | APP_NAME=Packly, DB_CONNECTION=sqlite |
| `database/database.sqlite` | Database SQLite |
