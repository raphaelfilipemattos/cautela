-- phpMyAdmin SQL Dump
-- version 4.9.5deb2~bpo10+1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 27/03/2024 às 20:53
-- Versão do servidor: 8.0.21
-- Versão do PHP: 7.3.19-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cautela`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cautela`
--

CREATE TABLE `cautela` (
  `idcautela` int NOT NULL,
  `idpessoacriou` int NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `nome_cautelador` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `nome_guerra_cautelador` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `cpf_cautelador` varchar(11) COLLATE latin1_spanish_ci NOT NULL,
  `om_cautelador` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `datahora_retorno` timestamp NULL DEFAULT NULL,
  `flagbaixa` tinyint(1) NOT NULL DEFAULT '0',
  `idpessoa_recebeu` int DEFAULT NULL,
  `obs` text COLLATE latin1_spanish_ci,
  `telefone` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `hash` varchar(40) COLLATE latin1_spanish_ci NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cautelaitens`
--

CREATE TABLE `cautelaitens` (
  `idcautelaitens` int NOT NULL,
  `idcautela` int NOT NULL,
  `idmaterial` int NOT NULL,
  `descricaoitem` varchar(200) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `dependencias`
--

CREATE TABLE `dependencias` (
  `id` int NOT NULL,
  `nome` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `iddetentor_direto` int NOT NULL,
  `iddetentor_indireto` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `material`
--

CREATE TABLE `material` (
  `idmaterial` int NOT NULL,
  `num_patrimonio` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `num_ficha` int DEFAULT NULL,
  `cod_material` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `contacontabil` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `descricao` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `iddependencias` int NOT NULL,
  `valoruni` float NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `idpessoa` int NOT NULL,
  `nome` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `nome_guerra` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `identidade` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `senha` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `postograd` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `cautela`
--
ALTER TABLE `cautela`
  ADD PRIMARY KEY (`idcautela`),
  ADD KEY `fk_cautela_pessoa_recebeu` (`idpessoa_recebeu`),
  ADD KEY `fk_cautela_pessoa_criou` (`idpessoacriou`);

--
-- Índices de tabela `cautelaitens`
--
ALTER TABLE `cautelaitens`
  ADD PRIMARY KEY (`idcautelaitens`),
  ADD KEY `fk_cautelaitens_cautela` (`idcautela`),
  ADD KEY `fk_cautelaitens_material` (`idmaterial`);

--
-- Índices de tabela `dependencias`
--
ALTER TABLE `dependencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dependencia_detentor` (`iddetentor_direto`),
  ADD KEY `fk_dependencia_detentorindireto` (`iddetentor_indireto`);

--
-- Índices de tabela `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`idmaterial`),
  ADD UNIQUE KEY `num_patrimonio` (`num_patrimonio`),
  ADD KEY `fk_material_dependencia` (`iddependencias`);

--
-- Índices de tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`idpessoa`),
  ADD UNIQUE KEY `identidade` (`identidade`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `cautela`
--
ALTER TABLE `cautela`
  MODIFY `idcautela` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cautelaitens`
--
ALTER TABLE `cautelaitens`
  MODIFY `idcautelaitens` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `dependencias`
--
ALTER TABLE `dependencias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `material`
--
ALTER TABLE `material`
  MODIFY `idmaterial` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `idpessoa` int NOT NULL AUTO_INCREMENT;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `cautela`
--
ALTER TABLE `cautela`
  ADD CONSTRAINT `fk_cautela_pessoa_criou` FOREIGN KEY (`idpessoacriou`) REFERENCES `pessoa` (`idpessoa`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_cautela_pessoa_recebeu` FOREIGN KEY (`idpessoa_recebeu`) REFERENCES `pessoa` (`idpessoa`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `cautelaitens`
--
ALTER TABLE `cautelaitens`
  ADD CONSTRAINT `fk_cautelaitens_cautela` FOREIGN KEY (`idcautela`) REFERENCES `cautela` (`idcautela`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cautelaitens_material` FOREIGN KEY (`idmaterial`) REFERENCES `material` (`idmaterial`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Restrições para tabelas `dependencias`
--
ALTER TABLE `dependencias`
  ADD CONSTRAINT `fk_dependencia_detentor` FOREIGN KEY (`iddetentor_direto`) REFERENCES `pessoa` (`idpessoa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dependencia_detentorindireto` FOREIGN KEY (`iddetentor_indireto`) REFERENCES `pessoa` (`idpessoa`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Restrições para tabelas `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `fk_material_dependencia` FOREIGN KEY (`iddependencias`) REFERENCES `dependencias` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
