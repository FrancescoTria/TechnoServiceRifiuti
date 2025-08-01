# TechnoService

<p align="center">
  <a href="#" target="_blank">
    <img src="public/logo no bg.png" width="300" alt="TechnoService Logo">
  </a>
</p>

## Descrizione

**TechnoService** è una web application sviluppata con [Laravel](https://laravel.com/), pensata per la gestione del ritiro porta a porta dei rifiuti. Il progetto include autenticazione, gestione profili, e funzionalità di calendario e altro ancora.

## Funzionalità principali

- Registrazione e login utenti
- Gestione profili lavoratori
- Visualizzazione e modifica del calendario
- Sistema di autenticazione sicuro
- Dashboard personalizzata per ogni utente

## Requisiti

- PHP >= 8.1
- Composer
- MySQL o altro database supportato da Laravel
- Node.js e npm (per asset frontend)

## Installazione

1. **Clona il repository**
   ```bash
   git clone https://github.com/tuo-utente/technoservice.git
   cd technoservice
   ```

2. **Installa le dipendenze PHP**
   ```bash
   composer install
   ```

3. **Installa le dipendenze JavaScript**
   ```bash
   npm install
   ```

4. **Configura l’ambiente**
   - Copia `.env.example` in `.env` e modifica le variabili secondo le tue esigenze.
   - Genera la chiave dell’app:
     ```bash
     php artisan key:generate
     ```

5. **Esegui le migrazioni**
   ```bash
   php artisan migrate
   ```

6. **Avvia il server di sviluppo**
   ```bash
   php artisan serve
   ```

## Struttura delle cartelle principali

- `app/Http/Controllers/` — Controller per la logica di business e le rotte
- `app/Models/` — Modelli Eloquent per l’accesso ai dati
- `resources/views/` — Template Blade per il frontend
- `routes/web.php` — Definizione delle rotte web

## Contribuire

Le pull request sono benvenute! Per bug, suggerimenti o richieste di nuove funzionalità, apri una issue.

## Licenza

Questo progetto è open-source e distribuito sotto licenza [MIT](https://opensource.org/licenses/MIT).

---

> Sviluppato con ❤️ usando Laravel.

