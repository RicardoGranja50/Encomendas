-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Jan-2021 às 18:22
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `encomendas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `morada` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefone` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `morada`, `telefone`, `email`, `updated_at`, `created_at`) VALUES
(1, 'José Alves', 'Rua 25 de Abril', '913345665', 'jalves@gmail.com', '2020-11-05 00:00:00', '2020-11-05 00:00:00'),
(2, 'Antonio Pereira', 'Rua Nuno Alveres', '913334442', 'apereira@gmail.com', '2020-11-05 00:00:00', '2020-11-05 00:00:00'),
(3, 'Rafael Ferreira', 'Rua Vasco da gama', '913346665', 'rferreira@gmail.com', '2020-11-05 00:00:00', '2020-11-05 00:00:00'),
(4, 'João Manuel', 'Rua da ponte', '918976253', 'jmanuel@gmail.com', '2020-11-05 00:00:00', '2020-11-05 00:00:00'),
(5, 'Inês Fonseca', 'Rua António Palha', '913678925', 'ifonseca@gmail.com', '2020-11-05 00:00:00', '2020-11-05 00:00:00'),
(6, 'Ricardo', 'S.Salvador', '939236400', 'ricapt555@gmail.com', '2021-01-08 16:18:39', '2021-01-08 15:52:41');

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomendas`
--

CREATE TABLE `encomendas` (
  `id_encomenda` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT '0',
  `id_vendedor` int(11) DEFAULT '0',
  `data` date DEFAULT NULL,
  `observacoes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `encomendas`
--

INSERT INTO `encomendas` (`id_encomenda`, `id_cliente`, `id_vendedor`, `data`, `observacoes`, `updated_at`, `created_at`) VALUES
(3, 3, 1, '2020-12-23', 'O Cliente ficou insatisfeito com a última encomenda.', '2020-12-22 00:00:00', '2020-12-31 00:00:00'),
(5, 2, 2, '2021-01-08', NULL, '2021-01-15 16:03:13', '2021-01-15 16:03:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomendas_produtos`
--

CREATE TABLE `encomendas_produtos` (
  `id_enc_prod` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_encomenda` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT '0',
  `preco` double DEFAULT '0',
  `desconto` double DEFAULT '0',
  `obervacoes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `encomendas_produtos`
--

INSERT INTO `encomendas_produtos` (`id_enc_prod`, `id_produto`, `id_encomenda`, `quantidade`, `preco`, `desconto`, `obervacoes`, `updated_at`, `created_at`) VALUES
(3, 3, 3, 3, 11.5, 0, NULL, '2020-12-11 00:00:00', '2020-12-22 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL,
  `designacao` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(9) DEFAULT '0',
  `preco` double DEFAULT '0',
  `observacoes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `designacao`, `stock`, `preco`, `observacoes`, `updated_at`, `created_at`) VALUES
(1, 'TV LG', 100, 150, NULL, '2021-01-15 16:07:34', '2020-12-02 00:00:00'),
(2, 'TV SONY', 200, 50, NULL, '2020-12-25 00:00:00', '2020-12-31 00:00:00'),
(3, 'PC ASUS', 50, 250, NULL, '2020-12-04 00:00:00', '2020-12-30 00:00:00'),
(4, 'Apple iPhone', 200, 2222, NULL, '2021-01-15 16:51:07', '2020-12-31 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendedores`
--

CREATE TABLE `vendedores` (
  `id_vendedor` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `especialidade` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `vendedores`
--

INSERT INTO `vendedores` (`id_vendedor`, `nome`, `especialidade`, `email`, `updated_at`, `created_at`) VALUES
(1, 'Manuel Pacheco', 'eletronica', 'mpacheco@Gmail.com', '2020-11-05 00:00:00', '2020-11-05 00:00:00'),
(2, 'Noé Silva', 'Informática', 'nsilva@gmail.com', '2020-11-05 00:00:00', '2020-11-05 00:00:00'),
(3, 'Luís Gomes', 'eletromecanica', 'lgomes', '2020-11-05 00:00:00', '2020-11-05 00:00:00'),
(4, 'António Filipe', 'Medicina', 'afilipe@gmail.com', '2020-11-05 00:00:00', '2020-11-05 00:00:00'),
(5, 'Tiago Machado', 'Bicicletas', 'tmachado@gmail.com', '2020-11-05 00:00:00', '2020-11-05 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `encomendas`
--
ALTER TABLE `encomendas`
  ADD PRIMARY KEY (`id_encomenda`);

--
-- Indexes for table `encomendas_produtos`
--
ALTER TABLE `encomendas_produtos`
  ADD PRIMARY KEY (`id_enc_prod`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`id_vendedor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `encomendas`
--
ALTER TABLE `encomendas`
  MODIFY `id_encomenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `encomendas_produtos`
--
ALTER TABLE `encomendas_produtos`
  MODIFY `id_enc_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `id_vendedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
