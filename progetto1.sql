-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Lug 23, 2025 alle 14:51
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progetto1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `avvisi`
--

CREATE TABLE `avvisi` (
  `id_avviso` bigint(20) UNSIGNED NOT NULL,
  `categoria` enum('Richiesta','Avviso') NOT NULL,
  `messaggio` text NOT NULL,
  `data_invio` datetime NOT NULL,
  `id_cliente` bigint(20) UNSIGNED NOT NULL,
  `id_lavoratore` bigint(20) UNSIGNED DEFAULT NULL,
  `oggetto` enum('Ritiro rifiuti speciali','Invia ticket','Supporto tecnico','Altro','Avviso rifiuto non conforme') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `avvisi`
--

INSERT INTO `avvisi` (`id_avviso`, `categoria`, `messaggio`, `data_invio`, `id_cliente`, `id_lavoratore`, `oggetto`) VALUES
(1, 'Richiesta', 'efgbn', '2025-07-22 13:37:58', 1, 1, 'Ritiro rifiuti speciali'),
(2, 'Richiesta', 'erghnm', '2025-07-22 13:43:37', 1, 1, 'Supporto tecnico'),
(3, 'Richiesta', 'defrgbvfcdsvfh', '2025-07-22 13:43:40', 3, 1, 'Ritiro rifiuti speciali'),
(4, 'Richiesta', 'fgnhd', '2025-07-22 13:43:42', 1, 1, 'Invia ticket'),
(5, 'Richiesta', 'dfnb ghrty5ehrdfxndgmfht', '2025-07-22 13:43:46', 1, 1, 'Ritiro rifiuti speciali'),
(6, 'Richiesta', 'dfvgbhm11111', '2025-07-23 08:08:35', 1, 1, 'Ritiro rifiuti speciali'),
(7, 'Richiesta', 'ciao 123', '2025-07-23 08:39:59', 1, 1, 'Invia ticket'),
(8, 'Avviso', 'dfghm', '2025-07-23 11:19:35', 1, 1, 'Avviso rifiuto non conforme'),
(9, 'Avviso', 'dwefrgthjm11324356', '2025-07-23 11:19:57', 3, 1, 'Avviso rifiuto non conforme'),
(10, 'Avviso', '/avvisi/cliente/crea', '2025-07-23 11:20:49', 2, 2, 'Avviso rifiuto non conforme'),
(11, 'Richiesta', 'defrghm', '2025-07-23 12:06:29', 1, 1, 'Altro'),
(12, 'Richiesta', 'aa24567', '2025-07-23 12:31:53', 1, 1, 'Altro'),
(13, 'Avviso', 'swdefrgthmj,k.l.1', '2025-07-23 12:40:09', 1, 2, 'Avviso rifiuto non conforme');

-- --------------------------------------------------------

--
-- Struttura della tabella `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-mario.rossi@example.com|127.0.0.1', 'i:1;', 1753260111),
('laravel-cache-mario.rossi@example.com|127.0.0.1:timer', 'i:1753260111;', 1753260111);

-- --------------------------------------------------------

--
-- Struttura della tabella `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `calendario`
--

CREATE TABLE `calendario` (
  `giorno` varchar(255) NOT NULL,
  `rifiuto` varchar(255) DEFAULT NULL,
  `fascia_oraria` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `calendario`
--

INSERT INTO `calendario` (`giorno`, `rifiuto`, `fascia_oraria`) VALUES
('Lunedì', NULL, NULL),
('Martedì', 'Carta', '23:30:00'),
('Mercoledì', 'Plastica', '04:04:00'),
('Giovedì', 'Indifferenziato', '05:00:00'),
('Venerdì', 'Carta', '01:03:00'),
('Sabato', 'Vetro', '00:00:00'),
('Domenica', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `lavoratori`
--

CREATE TABLE `lavoratori` (
  `id_lavoratore` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `lavoratori`
--

INSERT INTO `lavoratori` (`id_lavoratore`, `nome`, `cognome`, `admin`, `email`, `password`) VALUES
(1, 'Mario', 'Rossi', 1, 'francescotria26@gmail.com', '$2y$12$MwFli5zuu/4KmQcUweMS9ejoirKMg2b7juuKb/ohWGlRl6tL9WLGi'),
(2, 'Mario', 'Neri', 0, 'mario.rossi@example.com', '$2y$12$MwFli5zuu/4KmQcUweMS9ejoirKMg2b7juuKb/ohWGlRl6tL9WLGi'),
(3, 'Francesco', 'Tria', 0, 'francescotria78@gmail.com', '$2y$12$NGj1AWndDp1DSTDg4NLJtuJEsnUlm5xZQbiZV/0z4ttDr3k029jiy');

-- --------------------------------------------------------

--
-- Struttura della tabella `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_07_21_150652_cognome_to_users', 1),
(6, '2025_07_22_082926_create_calendario_table', 2),
(7, '2025_07_22_141349_create_calendario_only_table', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('jrAiSWNf8NqGWmk6OfcQuWpOO9RjayiFH7LTuOgf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaUVMZmRmREV1ZVY1c0tzSXFoS1FVT1JhN1lwMnUyUVpQcld4ZGJSQSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1753274946);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `nome`, `cognome`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Francesco', 'Tria', 'francescotria26@gmail.com', NULL, '$2y$12$MwFli5zuu/4KmQcUweMS9ejoirKMg2b7juuKb/ohWGlRl6tL9WLGi', 'B3tL1h4pHEnljueq8jkdsrxPM8pSbdRBKnovKP5QHGliqKBtrVt5n4rD21JP', '2025-07-22 08:34:19', '2025-07-22 08:34:19'),
(2, 'edfg', 'sdfnm', 'f.tria8@studenti.uniba.it', NULL, '$2y$12$0d22FtPPoN6C.AqpNHvouuNltn9Z.3HHs/W4aCS8t2THGlr3aQs6W', NULL, '2025-07-22 10:58:12', '2025-07-22 10:58:12'),
(3, 'Margherita', 'Lorusso', 'a@gmail.com', NULL, '$2y$12$7NFNn9Ct..qMwc1GJfmfSOJMuF5FLwMGH9yiEAg5Ndbkft7nj0Hoq', NULL, '2025-07-23 09:02:13', '2025-07-23 09:02:13');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `avvisi`
--
ALTER TABLE `avvisi`
  ADD PRIMARY KEY (`id_avviso`),
  ADD KEY `avvisi_id_cliente_foreign` (`id_cliente`),
  ADD KEY `fk_avvisi_lavoratore` (`id_lavoratore`);

--
-- Indici per le tabelle `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indici per le tabelle `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indici per le tabelle `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indici per le tabelle `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indici per le tabelle `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `lavoratori`
--
ALTER TABLE `lavoratori`
  ADD PRIMARY KEY (`id_lavoratore`),
  ADD UNIQUE KEY `lavoratori_email_unique` (`email`);

--
-- Indici per le tabelle `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indici per le tabelle `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `avvisi`
--
ALTER TABLE `avvisi`
  MODIFY `id_avviso` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `lavoratori`
--
ALTER TABLE `lavoratori`
  MODIFY `id_lavoratore` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `avvisi`
--
ALTER TABLE `avvisi`
  ADD CONSTRAINT `avvisi_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_avvisi_lavoratore` FOREIGN KEY (`id_lavoratore`) REFERENCES `lavoratori` (`id_lavoratore`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
