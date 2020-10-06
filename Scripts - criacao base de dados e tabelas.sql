# Host: localhost  (Version 5.7.31)
# Date: 2020-10-06 14:47:25
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "ordem_producao"
#

CREATE TABLE `ordem_producao` (
  `ordem_producao` int(11) NOT NULL AUTO_INCREMENT,
  `cod_produto` int(11) DEFAULT NULL,
  `nome_cliente` varchar(45) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ordem_producao`),
  KEY `fk_status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

#
# Structure for table "producao_liberada"
#

CREATE TABLE `producao_liberada` (
  `id_fabricacao` int(11) NOT NULL AUTO_INCREMENT,
  `ordem_producao` int(11) NOT NULL DEFAULT '1',
  `ordem_fabricacao` int(11) DEFAULT NULL,
  `qntd_requisitada` int(11) DEFAULT NULL,
  `qntd_aproduzir` int(11) DEFAULT NULL,
  `qntd_produzida` int(11) DEFAULT NULL,
  `maquina_utilizada` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_fabricacao`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

#
# Structure for table "produto"
#

CREATE TABLE `produto` (
  `cod_produto` int(11) NOT NULL AUTO_INCREMENT,
  `nome_produto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cod_produto`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

#
# Structure for table "status"
#

CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(35) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Structure for table "usuarios"
#

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

#
# Structure for table "venda"
#

CREATE TABLE `venda` (
  `cod_venda` int(11) NOT NULL AUTO_INCREMENT,
  `ordem_producao` int(11) DEFAULT NULL,
  `cod_produto` int(11) DEFAULT NULL,
  `nome_produto` varchar(45) DEFAULT NULL,
  `nome_cliente` varchar(45) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod_venda`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
