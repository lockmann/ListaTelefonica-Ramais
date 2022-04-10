-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 14-Nov-2021 às 01:07
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u783167293_listatel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `branch_line`
--

DROP TABLE IF EXISTS `branch_line`;
CREATE TABLE IF NOT EXISTS `branch_line` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(4) NOT NULL,
  `description` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `complement` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `num` varchar(15) CHARACTER SET utf8 NOT NULL,
  `status` int(1) NOT NULL,
  `private` int(1) NOT NULL,
  `type` int(1) NOT NULL,
  `insert_by` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `delete_by` int(11) DEFAULT NULL,
  `dt_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `branch_line`
--

INSERT INTO `branch_line` (`id`, `section_id`, `description`, `complement`, `num`, `status`, `private`, `type`, `insert_by`, `dt`, `delete_by`, `dt_delete`) VALUES
(1, 18, NULL, 'recepÃƒÂ§ÃƒÂ£o', '1238', 0, 1, 0, 1, '2021-11-14 00:21:00', NULL, NULL),
(2, 1, NULL, 'recepÃƒÂ§ÃƒÂ£o', '1238', 0, 1, 0, 1, '2021-11-14 00:22:00', NULL, NULL),
(3, 1, NULL, 'pedidos', '1234', 0, 1, 0, 1, '2021-11-14 00:24:00', NULL, NULL),
(4, 2, NULL, 'supervisor', '1235', 0, 1, 0, 1, '2021-11-14 00:24:00', NULL, NULL),
(5, 3, NULL, 'Supervisor', '1236', 0, 1, 0, 1, '2021-11-14 00:25:00', NULL, NULL),
(6, 5, NULL, 'PortÃƒÂ£o 1', '1237', 0, 1, 0, 1, '2021-11-14 00:25:00', NULL, NULL),
(7, 5, '', 'PortÃƒÂ£o 2', '1245', 0, 1, 0, 1, '2021-11-14 00:28:00', NULL, NULL),
(8, 5, NULL, 'PortÃƒÂ£o 3', '1248', 0, 1, 0, 1, '2021-11-14 00:26:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `private`
--

DROP TABLE IF EXISTS `private`;
CREATE TABLE IF NOT EXISTS `private` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `private`
--

INSERT INTO `private` (`id`, `name`) VALUES
(1, 'Público'),
(2, 'Privado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `restricted`
--

DROP TABLE IF EXISTS `restricted`;
CREATE TABLE IF NOT EXISTS `restricted` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `insert_by` varchar(100) NOT NULL,
  `dt` datetime NOT NULL,
  `delete_by` int(11) DEFAULT NULL,
  `dt_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `restricted`
--

INSERT INTO `restricted` (`id`, `name`, `status`, `insert_by`, `dt`, `delete_by`, `dt_delete`) VALUES
(1, 'Henrique Lockmann', 0, '1', '2021-11-14 00:27:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `restricted_num`
--

DROP TABLE IF EXISTS `restricted_num`;
CREATE TABLE IF NOT EXISTS `restricted_num` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_restricted` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `num` varchar(15) CHARACTER SET utf8 NOT NULL,
  `type` int(1) NOT NULL,
  `insert_by` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  `delete_by` int(11) DEFAULT NULL,
  `dt_delete` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `restricted_num`
--

INSERT INTO `restricted_num` (`id`, `id_restricted`, `status`, `num`, `type`, `insert_by`, `dt`, `delete_by`, `dt_delete`) VALUES
(1, 1, 0, '(11) 0000-0000', 0, 1, '2021-11-14 00:27:00', NULL, NULL),
(2, 1, 0, '(11) 99999-9999', 1, 1, '2021-11-14 00:27:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `section`
--

INSERT INTO `section` (`id`, `name`) VALUES
(1, 'Almoxarifado'),
(2, 'Estoque 1'),
(3, 'Estoque 2'),
(4, 'Gerencia'),
(5, 'Segurança'),
(6, 'Manutenção'),
(7, 'Limpeza');

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_user`
--

DROP TABLE IF EXISTS `status_user`;
CREATE TABLE IF NOT EXISTS `status_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `status_user`
--

INSERT INTO `status_user` (`id`, `name`) VALUES
(1, 'Ativo'),
(2, 'Inativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `accesslevel` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `login` varchar(15) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) NOT NULL,
  `insert_by` int(11) NOT NULL,
  `dt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `name`, `role`, `accesslevel`, `status`, `login`, `password`, `insert_by`, `dt`) VALUES
(1, 'Desenvolvedor', 'Administrador', 1, 1, 'dev', 'd42d0ac94b49920b9db773905fa3069c', 1, '2020-08-01 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
