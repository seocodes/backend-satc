-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 12/03/2025 às 20h39min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `escola1`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `fone` varchar(15) NOT NULL,
  `codcurso` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codcurso` (`codcurso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`codigo`, `nome`, `fone`, `codcurso`) VALUES
(1, 'Carlos Pereira', '1234-5678', 1),
(2, 'Ana Souza', '9876-5432', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `coordenador`
--

CREATE TABLE IF NOT EXISTS `coordenador` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `coordenador`
--

INSERT INTO `coordenador` (`codigo`, `nome`) VALUES
(1, 'João Silva'),
(2, 'Maria Oliveira'),
(3, 'Max Webber'),
(6, 'JoÃ£o Vitor Abused');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `codcoordenador` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codcoordenador` (`codcoordenador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`codigo`, `nome`, `codcoordenador`) VALUES
(1, 'Ciência da Computação', 1),
(2, 'Engenharia de Software', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`codigo`, `login`, `senha`) VALUES
(1, 'admin', '123');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`codcurso`) REFERENCES `curso` (`codigo`);

--
-- Restrições para a tabela `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`codcoordenador`) REFERENCES `coordenador` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
