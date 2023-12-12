-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 08-Dez-2023 às 08:11
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

DROP TABLE IF EXISTS `pagamento`;
CREATE TABLE IF NOT EXISTS `pagamento` (
  `pagamento_id` int NOT NULL AUTO_INCREMENT,
  `produto_id` int NOT NULL,
  `pedido_id` int NOT NULL,
  PRIMARY KEY (`pagamento_id`),
  KEY `produto_id` (`produto_id`,`pedido_id`),
  KEY `produto_id_2` (`produto_id`,`pedido_id`),
  KEY `pedido_id` (`pedido_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `pedido_id` int NOT NULL AUTO_INCREMENT,
  `u_id` int NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pedido_status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`pedido_id`),
  KEY `u_id` (`u_id`),
  KEY `u_id_2` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `produto_id` int NOT NULL AUTO_INCREMENT,
  `produto_nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `produto_preco` decimal(10,2) NOT NULL,
  `produto_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`produto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`produto_id`, `produto_nome`, `descricao`, `produto_preco`, `produto_img`) VALUES
(1, 'oi', 'tchau', '12.90', 'img/teste.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `u_id` int NOT NULL AUTO_INCREMENT,
  `nomeusuario` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `1nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `2nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `endereco` text COLLATE utf8mb4_general_ci NOT NULL,
  `permissao` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`u_id`, `nomeusuario`, `1nome`, `2nome`, `email`, `telefone`, `senha`, `endereco`, `permissao`) VALUES
(1, 'clodo', 'clodo', 'mar', 'clodo@gmail.com', '555555555555', '0b5de470bdace90bd6cfb2541eb79f99', 'rua dos pirulitos bairro dos doces', 1),
(2, 'clodomirlderson', 'clodo', 'clodo', 'clodo@gmail.comm', '1111111111', 'e11170b8cbd2d74102651cb967fa28e5', 'rua pai casa mae', 1),
(3, 'clodomar', 'clodos', 'omar', 'colodomar@gmail.com', '55999284953', '0b5de470bdace90bd6cfb2541eb79f99', 'sei la oq sei la oq', 1),
(4, 'luiza', 'luiza', 'baioco', 'luiza@gmail.com', '555991599813', '56495e672b8332e461cdba35e2dab886', 'asopfkjqopfjqwffsa', 1);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD CONSTRAINT `pagamento_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`produto_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pagamento_ibfk_2` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`pedido_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
