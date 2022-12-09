DROP DATABASE IF EXISTS api_agencias;

CREATE DATABASE IF NOT EXISTS api_agencias CHARACTER SET "utf8" COLLATE "utf8_spanish2_ci";

USE api_agencias;

CREATE TABLE IF NOT EXISTS `agencias`(
  `agencia_id` INT(11) NOT NULL AUTO_INCREMENT,
  `agencia_nombre` TEXT NOT NULL,
  `agencia_direccion` TEXT NOT NULL,
  `agencia_telefono` TEXT NOT NULL,
  `created_at` DATETIME,
  `updated_at` DATETIME,
  PRIMARY KEY (`agencia_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_spanish2_ci;
