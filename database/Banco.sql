-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/09/2026 às 21:57
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `inovavida`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `profissional_id` int(11) NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `descricao` text DEFAULT NULL,
  `status` enum('pendente','confirmado','cancelado','concluido') DEFAULT 'pendente',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id`, `cliente_id`, `profissional_id`, `data`, `descricao`, `status`, `criado_em`) VALUES
(1, 16, 7, '2026-09-17 12:00:00', 'Teste', 'pendente', '2026-09-16 18:19:28'),
(2, 16, 5, '2026-09-19 15:00:00', 'Uma consulta rapida', 'pendente', '2026-09-16 18:37:43');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `sexo` enum('Masculino','Feminino','Outro') DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `altura` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `senha`, `cpf`, `telefone`, `data_nascimento`, `sexo`, `peso`, `altura`) VALUES
(16, 'Novo', 'totalmente@gmail.com', '$2y$10$ow0Oa9aQ3NTTEhGvlNzU1u9Am8dvbGbjdn3tzNnCK8WxpwDj4kVk.', '222.222.222-22', '(33) 33333-3333', NULL, NULL, 85.00, 1.82),
(17, 'Eduardo', 'dede123@gmail.com', '$2y$10$VFUb/gauOsl4hyEP6EwslO/KDO4VlmPDuqZAl8wJFTPvP3JaiaX12', '888.888.888-88', '(99) 99999-9999', NULL, NULL, 182.00, 1.90),
(18, 'Marselo', 'Marselo@gmail.com', '$2y$10$wdTWvahb7Tf6W/NoX00t7e/.tADUZUlVs8EXEAJxawDIEFWSJuppe', '999.999.999-99', '(88) 88888-8888', NULL, NULL, 85.00, 1.90);

-- --------------------------------------------------------

--
-- Estrutura para tabela `especialidades`
--

CREATE TABLE `especialidades` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `especialidades`
--

INSERT INTO `especialidades` (`id`, `nome`, `descricao`) VALUES
(1, 'Cardiologia', NULL),
(2, 'Psicologia', NULL),
(3, 'Nutrição', NULL),
(4, 'Clínico Geral', NULL),
(5, 'Dermatologia', NULL),
(6, 'Pediatria', NULL),
(7, 'Neurologia', NULL),
(8, 'Ortopedia', NULL),
(9, 'Ginecologia', NULL),
(10, 'Oftalmologia', NULL),
(11, 'Psiquiatria', NULL),
(12, 'Endocrinologia', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `indicadores_saude`
--

CREATE TABLE `indicadores_saude` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `pressao` varchar(20) DEFAULT NULL,
  `indicador` text DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `indicadores_saude`
--

INSERT INTO `indicadores_saude` (`id`, `cliente_id`, `pressao`, `indicador`, `criado_em`) VALUES
(22, 16, '14/9', 'Estou sentindo dores de cabeça ha alguns Dias, Alem disso desconfio possuir um TDAH iniciante', '2026-09-04 17:36:46'),
(23, 17, '15', 'Eu estou Doente', '2026-09-15 19:31:17'),
(24, 18, '10', 'Um Pouco de TDAH', '2026-09-15 19:52:30');

-- --------------------------------------------------------

--
-- Estrutura para tabela `profissionais`
--

CREATE TABLE `profissionais` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `especialidade` varchar(100) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `estado` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `rua` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `profissionais`
--

INSERT INTO `profissionais` (`id`, `nome`, `email`, `senha`, `cpf`, `especialidade`, `telefone`, `estado`, `cidade`, `rua`) VALUES
(5, 'Marcelinho', 'Marcelinho@gmail.com', '$2y$10$B8CzW1vX9aWkZJjEBmmPN..skBXIrJY00At9DsUXCjKXIrDSM9ofe', '444.444.444-44', 'Cardiologia', '(33) 33333-3333', 'PR', 'Matinhos', 'Werner'),
(6, 'Marcelo', 'Marcelo123@gmail.com', '$2y$10$VlxfaUHZefrQxngwGRYDn.5GDYQuLXmGknrFnQrZuNDoX9v/qvGES', '222.222.222-22', 'Cardiologia', '(44) 44444-4444', 'PR', 'Matinhos', 'Werner Guilherme'),
(7, 'Destiny', 'destiny@gmail.com', '$2y$10$O1U5aAE/MLrrJq7SvjAgl.IJm3VLJNOwF5aLuK71uQzbwnhSrwlrG', '333.333.333-33', 'Cardiologia', '(22) 22222-2222', 'AA', 'Maranhao', 'Werner Guilherme Gaedke');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `profissional_id` (`profissional_id`),
  ADD KEY `horario_id` (`data`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD KEY `email` (`email`);

--
-- Índices de tabela `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices de tabela `indicadores_saude`
--
ALTER TABLE `indicadores_saude`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Índices de tabela `profissionais`
--
ALTER TABLE `profissionais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `especialidade_id` (`especialidade`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `indicadores_saude`
--
ALTER TABLE `indicadores_saude`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `profissionais`
--
ALTER TABLE `profissionais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
