-- -----------------------------------------------------
-- Schema db_exemplo
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_exemplo` DEFAULT CHARACTER SET utf8 ;
USE `db_exemplo` ;

-- -----------------------------------------------------
-- Table `db_exemplo`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_exemplo`.`clientes` (
  `id_cliente` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL DEFAULT NULL,
  `cpf` VARCHAR(20) NULL DEFAULT NULL,
  `cidade` VARCHAR(255) NULL DEFAULT NULL,
  `uf` CHAR(2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_cliente`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_exemplo`.`produtos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_exemplo`.`produtos` (
  `id_produto` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL DEFAULT NULL,
  `preco_venda` DOUBLE NULL DEFAULT NULL,
  `qtd_estoque` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_produto`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_exemplo`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_exemplo`.`usuarios` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL DEFAULT NULL,
  `usuario` VARCHAR(255) NULL DEFAULT NULL,
  `senha` VARCHAR(255) NULL DEFAULT NULL,
  `tipo` CHAR(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_exemplo`.`vendas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_exemplo`.`vendas` (
  `id_venda` INT(11) NOT NULL AUTO_INCREMENT,
  `data` DATETIME NULL DEFAULT NULL,
  `valor_total` DOUBLE NULL DEFAULT NULL,
  `quantidade` INT(11) NULL DEFAULT NULL,
  `cancelado` CHAR(1) NULL DEFAULT NULL,
  `id_produto` INT(11) NOT NULL,
  `id_cliente` INT(11) NOT NULL,
  `id_usuario` INT(11) NOT NULL,
  PRIMARY KEY (`id_venda`),
  INDEX `fk_vendas_clientes_idx` (`id_cliente` ASC),
  INDEX `fk_vendas_usuarios_idx` (`id_usuario` ASC),
  INDEX `fk_vendas_produtos` (`id_produto` ASC),
  CONSTRAINT `fk_vendas_clientes`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `db_exemplo`.`clientes` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vendas_produtos`
    FOREIGN KEY (`id_produto`)
    REFERENCES `db_exemplo`.`produtos` (`id_produto`),
  CONSTRAINT `fk_vendas_usuarios`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `db_exemplo`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- INSERTS
INSERT INTO `usuarios` (`id_usuario`,`nome`,`usuario`,`senha`,`tipo`) VALUES (1,'Administrador','admin','123','A');
INSERT INTO `usuarios` (`id_usuario`,`nome`,`usuario`,`senha`,`tipo`) VALUES (2,'Teilor Golunski','teilorg','!@#','N');

INSERT INTO `clientes` (`id_cliente`,`nome`,`cpf`,`cidade`,`uf`) VALUES (1,'Leonardo Porn','123.123.123-12','Seara','SC');
INSERT INTO `clientes` (`id_cliente`,`nome`,`cpf`,`cidade`,`uf`) VALUES (3,'Maria Eduarda','987.987.987-98','Irani','SC');
INSERT INTO `clientes` (`id_cliente`,`nome`,`cpf`,`cidade`,`uf`) VALUES (4,'Uriel Sitta','333.222.111-00','Ipumirim','SC');
INSERT INTO `clientes` (`id_cliente`,`nome`,`cpf`,`cidade`,`uf`) VALUES (5,'Victor Beber','999.888.777-66','Jaborá','SC');

INSERT INTO `produtos` (`id_produto`,`nome`,`preco_venda`,`qtd_estoque`) VALUES (1,'Coca-cola',8.99,500);
INSERT INTO `produtos` (`id_produto`,`nome`,`preco_venda`,`qtd_estoque`) VALUES (2,'Nissin Miojo',3.87,1000);
INSERT INTO `produtos` (`id_produto`,`nome`,`preco_venda`,`qtd_estoque`) VALUES (3,'Batata Caturra',5,40000);
