-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/11/2025 às 03:59
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `login_laravel`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `cpf`, `nome`, `telefone`, `email`, `created_at`, `updated_at`, `user_id`) VALUES
(1, '12345678910', 'Carlos Alberto', '5199994444', 'carlos@teste.com.br', '2025-11-13 22:02:27', '2025-11-13 22:02:27', 0),
(2, '12345678902', 'Marcel', '5199994444', 'marcel@teste.com', '2025-11-13 22:42:18', '2025-11-13 22:42:18', 0),
(3, '111.111.111-11', 'Carlos Alberto', '(51) 99999-9999', 'carlos@teste', '2025-11-14 15:47:31', '2025-11-14 16:22:00', 4),
(4, '222.222.222-22', 'Dani', '(11) 11111-1111', 'dani@teste.com', '2025-11-14 16:24:22', '2025-11-14 17:36:46', 4),
(5, '333.333.333-33', 'Luise', '(51) 44444-4432', 'luize@teste.com', '2025-11-14 20:41:00', '2025-11-15 16:34:37', 3),
(6, '444.444.444-44', 'Carlos', '(51) 66666-6663', 'Carlos5@teste.com', '2025-11-14 20:41:46', '2025-11-14 21:16:12', 3),
(7, '666.666.666-66', 'marcela', '(51) 66666-6665', 'marcela@teste.com', '2025-11-14 21:26:05', '2025-11-14 21:26:18', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
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
-- Estrutura para tabela `jobs`
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
-- Estrutura para tabela `job_batches`
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
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_21_180831_create_clientes_table', 1),
(5, '2025_10_21_182217_create_veiculos_table', 1),
(6, '2025_10_21_223402_create_ordem_servicos_table', 2),
(7, '2025_10_23_133224_add_marca_to_veiculos_table', 2),
(8, '2025_10_23_133947_add_cliente_id_to_ordem_servicos_table', 2),
(9, '2025_10_24_112444_alter_veiculo_id_column_on_ordem_servicos_table', 2),
(10, '2025_11_13_184352_add_cpf_to_clientes_table', 3),
(11, '2025_11_13_185703_add_veiculo_placa_to_ordem_servicos_table', 3),
(12, '2025_11_14_143500_add_user_id_to_veiculos_table', 4),
(13, '2025_11_14_173832_recreate_user_id_column_on_clientes_table', 5),
(14, '2025_11_15_144047_add_mao_obra_to_ordem_servicos_table', 6),
(15, '2025_11_15_144427_create_pecas_os_table', 7),
(16, '2025_11_17_000228_remove_cpf_from_ordem_servicos_table', 8),
(17, '2025_11_17_010727_remove_placa_from_ordem_servicos', 9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ordem_servicos`
--

CREATE TABLE `ordem_servicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `veiculo_placa` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `data_servico` date NOT NULL,
  `mao_obra` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `ordem_servicos`
--

INSERT INTO `ordem_servicos` (`id`, `veiculo_placa`, `descricao`, `data_servico`, `mao_obra`, `created_at`, `updated_at`) VALUES
(1, 'dml21111', 'troca de oleo', '2025-11-17', 100.00, '2025-11-17 04:13:12', '2025-11-17 04:13:12'),
(3, 'dml21111', 'troca de oleo', '2025-11-17', 100.00, '2025-11-17 04:22:41', '2025-11-17 04:22:41'),
(4, 'imd22222', 'troca correia alternador \r\ncorreia dentada\r\ntroca de oleo', '2025-11-17', 150.00, '2025-11-17 05:20:57', '2025-11-17 05:32:16');

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pecas_os`
--

CREATE TABLE `pecas_os` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ordem_servico_id` bigint(20) UNSIGNED NOT NULL,
  `nome_peca` varchar(255) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `pecas_os`
--

INSERT INTO `pecas_os` (`id`, `ordem_servico_id`, `nome_peca`, `quantidade`, `preco_unitario`, `created_at`, `updated_at`) VALUES
(2, 4, 'kit correia', 1, 25.00, '2025-11-17 05:32:16', '2025-11-17 05:32:16'),
(3, 4, 'filtro oleo', 1, 30.00, '2025-11-17 05:32:16', '2025-11-17 05:32:16'),
(4, 4, 'oleo sintetico', 3, 25.00, '2025-11-17 05:32:16', '2025-11-17 05:32:16');

-- --------------------------------------------------------

--
-- Estrutura para tabela `sessions`
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
-- Despejando dados para a tabela `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('duDpKfWa66QQiAKX8WYTuj1Gs3FRMENAY5FYtxWJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSGpxaDJnRm9yUlRwOWdmZTVNTTZ2cXhIaGNLZkk2NWtobXhMRlE3QiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1763399256),
('e2Z3ysoUvzoS2XywZ5qYyj4hwIWNyPbZV8vkm6fj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR3hLaHRvYm42aFUyNEM5U0FmTnhDNjRTc3NTbzYzOVJvRktkWXU4RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1763401678);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Danielle', 'danielle@email.com', NULL, '$2y$12$ufmD/lhKlVTWI82RegDvXuT4nlpVMS6tcQt7tpj5YubPtZf2Tk.XO', NULL, '2025-11-13 21:12:01', '2025-11-13 21:12:01'),
(2, 'Marcel', 'marcel@teste.com', NULL, '$2y$12$X/SsTR.H15nNlyyd5rZ8c.c5yOGmjwUrhNjBMY.bzrcdJKbn9X6I6', NULL, '2025-11-13 22:41:12', '2025-11-13 22:41:12'),
(3, 'Marcel Fernando Finavaro', 'marcelfinavaro@gmail.com', NULL, '$2y$12$OLZIXMFcqvl4UP2sGMmJUuQwWUc9z1BK4uVJ8INHSUIJAx4.f0SDC', NULL, '2025-11-14 13:13:23', '2025-11-14 13:13:23'),
(4, 'Carlos Alberto', 'carlos3@teste.com', NULL, '$2y$12$YiVB.kgt1t1FGumT9GC8.u5sBpbQJ2ZgiVsH/Ys3Rvr2lyjHbvbiy', NULL, '2025-11-14 13:15:03', '2025-11-14 13:15:03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `placa` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `ano` year(4) NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `veiculos`
--

INSERT INTO `veiculos` (`placa`, `modelo`, `marca`, `ano`, `cliente_id`, `user_id`, `created_at`, `updated_at`) VALUES
('ddd4512', 'ducato', 'fiat', '2010', 6, 3, '2025-11-17 16:42:11', '2025-11-17 17:35:44'),
('dml21111', 'gol', 'vw', '2021', 7, 3, '2025-11-14 21:27:00', '2025-11-14 21:27:13'),
('dmm44444', 'gol', 'vw', '2015', 6, 3, '2025-11-14 21:20:10', '2025-11-14 21:20:10'),
('imd22222', 'Palio 16v', 'fiat', '2018', 5, 3, '2025-11-14 20:43:44', '2025-11-14 21:21:06');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Índices de tabela `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clientes_email_unique` (`email`),
  ADD UNIQUE KEY `clientes_cpf_unique` (`cpf`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Índices de tabela `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ordem_servicos`
--
ALTER TABLE `ordem_servicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordem_servicos_veiculo_placa_foreign` (`veiculo_placa`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `pecas_os`
--
ALTER TABLE `pecas_os`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pecas_os_ordem_servico_id_foreign` (`ordem_servico_id`);

--
-- Índices de tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Índices de tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`placa`),
  ADD KEY `veiculos_cliente_id_foreign` (`cliente_id`),
  ADD KEY `veiculos_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `ordem_servicos`
--
ALTER TABLE `ordem_servicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `pecas_os`
--
ALTER TABLE `pecas_os`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `ordem_servicos`
--
ALTER TABLE `ordem_servicos`
  ADD CONSTRAINT `ordem_servicos_veiculo_placa_foreign` FOREIGN KEY (`veiculo_placa`) REFERENCES `veiculos` (`placa`) ON DELETE CASCADE;

--
-- Restrições para tabelas `pecas_os`
--
ALTER TABLE `pecas_os`
  ADD CONSTRAINT `pecas_os_ordem_servico_id_foreign` FOREIGN KEY (`ordem_servico_id`) REFERENCES `ordem_servicos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `veiculos`
--
ALTER TABLE `veiculos`
  ADD CONSTRAINT `veiculos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `veiculos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
