/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.13-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: angolaw
-- ------------------------------------------------------
-- Server version	10.11.13-MariaDB-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `artigos`
--

DROP TABLE IF EXISTS `artigos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `artigos` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `usuario` int(100) DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `titulo` varchar(100) NOT NULL DEFAULT 'Titulo',
  `descricao` varchar(200) DEFAULT NULL,
  `data` date NOT NULL DEFAULT curdate(),
  PRIMARY KEY (`id`),
  KEY `artigos_usuarios_FK` (`usuario`),
  CONSTRAINT `artigos_usuarios_FK` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `documentos`
--

DROP TABLE IF EXISTS `documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `documentos` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `usuario` int(100) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `titulo` varchar(100) NOT NULL DEFAULT 'Titulo',
  `tipo` varchar(100) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `documento` varchar(100) DEFAULT NULL,
  `data` date DEFAULT curdate(),
  PRIMARY KEY (`id`),
  KEY `documentos_usuarios_FK` (`usuario`),
  CONSTRAINT `documentos_usuarios_FK` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `playlists`
--

DROP TABLE IF EXISTS `playlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `playlists` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `usuario` int(100) DEFAULT NULL,
  `url` varchar(200) NOT NULL DEFAULT 'Url',
  `titulo` varchar(100) DEFAULT 'Titulo',
  `descricao` varchar(200) DEFAULT NULL,
  `data` date DEFAULT curdate(),
  PRIMARY KEY (`id`),
  KEY `playlists_usuarios_FK` (`usuario`),
  CONSTRAINT `playlists_usuarios_FK` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `publicacoes`
--

DROP TABLE IF EXISTS `publicacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `publicacoes` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `usuario` int(100) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `titulo` varchar(100) NOT NULL DEFAULT 'Titulo',
  `tipo` varchar(100) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `data` date DEFAULT curdate(),
  PRIMARY KEY (`id`),
  KEY `publicacoes_usuarios_FK` (`usuario`),
  CONSTRAINT `publicacoes_usuarios_FK` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL DEFAULT 'Usuario',
  `email` varchar(100) NOT NULL DEFAULT 'admin@vconnect.com',
  `contacto` char(12) DEFAULT NULL,
  `biografia` text DEFAULT NULL,
  `acesso` enum('Administrador','Advogado','Cliente') NOT NULL DEFAULT 'Cliente',
  `localizacao` varchar(100) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `genero` enum('Masculino','Feminino') NOT NULL DEFAULT 'Masculino',
  `profissao` varchar(100) DEFAULT NULL,
  `idiomas` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT 'Ativo',
  `senha` varchar(254) DEFAULT NULL,
  `data` date NOT NULL DEFAULT curdate(),
  `login` date DEFAULT curdate(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_unique` (`contacto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'angolaw'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-08  5:34:26
