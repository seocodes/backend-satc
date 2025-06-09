-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 09/06/2025 às 18h54min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `livraria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `autor`
--

CREATE TABLE IF NOT EXISTS `autor` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `pais` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `autor`
--

INSERT INTO `autor` (`codigo`, `nome`, `pais`) VALUES
(1, 'Machado De Assis', 'Brasil'),
(2, 'Eichiiro Oda', 'JapÃ£o'),
(3, 'Albert Camus', 'Franco-argelino'),
(4, 'Sun Tzu', 'JapÃ£o'),
(5, 'Eliana Alves Cruz', 'Brasil'),
(6, 'David Goggins', 'EUA'),
(7, 'Stephen Chbosky', 'EUA'),
(8, 'FiÃ³dor DostoiÃ©vski', 'Russo'),
(9, 'Aldous Leonard Huxley', 'Inglaterra');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE IF NOT EXISTS `carrinho` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `codigo` int(5) NOT NULL,
  `preco` double(9,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `foto` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `nome`, `codigo`, `preco`, `quantidade`, `foto`) VALUES
(2, 'One Piece vol. 1', 2, 199.99, 1, 'c69318262586e417bfedf36fd70c600a'),
(3, 'A Cartomante', 3, 69.99, 1, '25566ad34d6217b3d8e9e349f6603556'),
(4, 'Crime e castigo', 10, 86.80, 1, 'b2fc3a453bb1d893b5dfd19418b4537b');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`codigo`, `nome`) VALUES
(1, 'Romance'),
(2, 'FicÃ§Ã£o CietÃ­fica'),
(3, 'AÃ§Ã£o'),
(4, 'FicÃ§Ã£o Existencialista'),
(5, 'NÃ£o-ficÃ§Ã£o'),
(6, 'FicÃ§Ã£o'),
(7, 'Autoajuda'),
(8, 'Romance Epistolar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `editora`
--

CREATE TABLE IF NOT EXISTS `editora` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `editora`
--

INSERT INTO `editora` (`codigo`, `nome`) VALUES
(1, 'Saraiva'),
(3, 'Panini'),
(4, 'Toei Animation'),
(5, 'Best Seller'),
(6, 'Novo SÃ©culo'),
(7, 'Companhia das Letras'),
(8, 'Editora Sextante'),
(9, 'Rocco Jovens Leitores'),
(10, 'Editora 34'),
(11, 'Biblioteca Azul');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro`
--

CREATE TABLE IF NOT EXISTS `livro` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `nrpaginas` int(5) NOT NULL,
  `ano` int(5) NOT NULL,
  `codautor` int(5) NOT NULL,
  `codcategoria` int(5) NOT NULL,
  `codeditora` int(5) NOT NULL,
  `resenha` text,
  `preco` decimal(6,2) NOT NULL,
  `fotocapa1` varchar(100) DEFAULT NULL,
  `fotocapa2` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codautor` (`codautor`),
  KEY `codcategoria` (`codcategoria`),
  KEY `codeditora` (`codeditora`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `livro`
--

INSERT INTO `livro` (`codigo`, `titulo`, `nrpaginas`, `ano`, `codautor`, `codcategoria`, `codeditora`, `resenha`, `preco`, `fotocapa1`, `fotocapa2`) VALUES
(2, 'One Piece vol. 1', 1000, 1999, 2, 3, 4, 'Muito bom melhor anime e mangÃ¡ do mundo!!!!!!!!!!!!!', '199.99', 'c69318262586e417bfedf36fd70c600a', '3af050b7cbbcf62beb9c66e7969af14b'),
(3, 'A Cartomante', 156, 1899, 1, 1, 1, 'Insano', '69.99', '25566ad34d6217b3d8e9e349f6603556', 'd1232ac6053062c11257a68f429e79b6'),
(4, 'O Estrangeiro', 112, 2010, 3, 4, 5, 'Uma das melhores ficÃ§Ãµes existencialistas da histÃ³ria.', '59.99', 'b9b1937da48d702d40d67f326daa343a', '6d25bc90ecf562c094f6edd66de7485c'),
(5, 'Arte da Guerra', 152, 2015, 4, 5, 6, 'Disciplina......', '49.99', 'b7eaa0d734a7883afd8ff34816c8e454', 'c3f7ac607ec0acb33b940f053bda9b81'),
(6, 'SolitÃ¡ria', 168, 2022, 5, 6, 7, 'Triste demais mano...', '50.40', '6a6ed6b013710dd4364bfcb5bedeb488', '958c8dff2dd1cd237cbc6a2582c7668a'),
(7, 'Nada pode me ferir', 320, 2023, 6, 7, 8, 'Sai da depressÃ£o.', '44.90', 'f35687ca3dbc0d09ef53b53f6caf1071', 'a484221cfcbc5a1f1605bbcce2b862d6'),
(9, 'As vantagens de ser invisÃ­vel', 288, 2021, 7, 8, 9, 'Trata de temas nÃ£o muito abordados em histÃ³rias convencionais. Muito bom.', '39.55', 'e6e22a4e7e0fee4a473bbe0d1c914ece', '436aef7a98c32fb20dd15d6628fe2e8d'),
(10, 'Crime e castigo', 592, 1866, 8, 1, 10, 'Parece pica.', '86.80', 'b2fc3a453bb1d893b5dfd19418b4537b', 'd10cf4eb22bacd0fe33d3a400ff59334'),
(12, 'AdmirÃ¡vel mundo novo', 312, 1932, 9, 2, 11, 'Uma das distopias mais inteligentes e perturbadoras da literatura.', '42.91', 'f6560af02d7f7752ebaf1af13a10d9c3', '20a5dc1449139334fa5c9620c874a6fd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`codigo`, `nome`, `senha`) VALUES
(1, 'augusto', '0404');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `livro`
--
ALTER TABLE `livro`
  ADD CONSTRAINT `livro_ibfk_1` FOREIGN KEY (`codautor`) REFERENCES `autor` (`codigo`),
  ADD CONSTRAINT `livro_ibfk_2` FOREIGN KEY (`codcategoria`) REFERENCES `categoria` (`codigo`),
  ADD CONSTRAINT `livro_ibfk_3` FOREIGN KEY (`codeditora`) REFERENCES `editora` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
