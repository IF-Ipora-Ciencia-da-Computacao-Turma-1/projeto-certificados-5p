-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Jul-2022 às 00:00
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `certifica`
--
CREATE DATABASE IF NOT EXISTS `certifica` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `certifica`;

DELIMITER $$
--
-- Funções
--
DROP FUNCTION IF EXISTS `valida_usuario`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `valida_usuario` (`p_login` VARCHAR(20), `p_senha` VARCHAR(70)) RETURNS INT(1) BEGIN  
 DECLARE l_ret            INT(1) DEFAULT 0;  
     SET l_ret = IFNULL((SELECT DISTINCT 1  
                       FROM user  
                      WHERE username = p_login  
                       AND password = MD5(p_senha)),0);                           
 RETURN l_ret;  
 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `certificados`
--

DROP TABLE IF EXISTS `certificados`;
CREATE TABLE `certificados` (
  `id` int(11) NOT NULL,
  `token` varchar(150) NOT NULL,
  `link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(70) NOT NULL,
  `token` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `token`) VALUES
(1, 'admin', 'bced6fd149cfcdb85741768da12e41c6', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6ImFkbWluIiwic3ViIjoiMSJ9.7IhH11Ctt2Y1pt3Bpwb1em_XkmBrZ0piCetjMymyK7o');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `certificados`
--
ALTER TABLE `certificados`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`username`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `certificados`
--
ALTER TABLE `certificados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
