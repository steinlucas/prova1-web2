CREATE DATABASE  IF NOT EXISTS `faleconosco`;
USE `faleconosco`;

DROP TABLE IF EXISTS `contato`;

CREATE TABLE `contato` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `mensagem` text NOT NULL,
  `arquivo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
);


INSERT INTO `contato` VALUES (30,'João da Silva','joao@email.com','4799998888','Quando o website estará disponível para visualização dos produtos?	',NULL),(31,'José dos Santos','jose@email.com','4799999999','Qual o telefone de contato da empresa?',NULL),(32,'Pink','pink@email.com','48999997777','O que vamos fazer hoje a noite Cérebro?',NULL);



DROP TABLE IF EXISTS `resposta`;

CREATE TABLE `resposta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) NOT NULL,
  `id_contato` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_resposta_contato_idx` (`id_contato`),
  CONSTRAINT `fk_resposta_contato` FOREIGN KEY (`id_contato`) REFERENCES `contato` (`id`)
);



INSERT INTO `resposta` VALUES (13,' A mesma coisa que fazemos todas as noites, Pinky - Tentar dominar o mundo!',32),(14,'O website está disponível para visualização dos produtos a partir do dia 12/04/2023 às 22h30!',30);


