-- MySQL Script generated by MySQL Workbench
-- Fri Dec 13 10:39:40 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema taketec-pdo-version-1
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema taketec-pdo-version-1
-- -----------------------------------------------------
drop DATABASE if exists `taketec-pdo-version-1`;
CREATE DATABASE IF NOT EXISTS `taketec-pdo-version-1` DEFAULT CHARACTER SET utf8 ;
USE `taketec-pdo-version-1` ;

-- -----------------------------------------------------
-- Table `taketec-pdo-version-1`.`category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `taketec-pdo-version-1`.`category` ;

CREATE TABLE IF NOT EXISTS `taketec-pdo-version-1`.`category` (
  `catId` INT(11) NOT NULL,
  `description` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`catId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `taketec-pdo-version-1`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `taketec-pdo-version-1`.`user` ;

CREATE TABLE IF NOT EXISTS `taketec-pdo-version-1`.`user` (
  `userId` INT(11) NOT NULL,
  `FirstName` VARCHAR(45) NOT NULL,
  `surname` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `gender` VARCHAR(1) NOT NULL,
  `DOB` DATE NOT NULL,
  `country` VARCHAR(2) NOT NULL,
  `phone` VARCHAR(45) NOT NULL,
  `eMail` VARCHAR(256) NOT NULL,
  `permission` TINYINT(4) NULL DEFAULT NULL,
  PRIMARY KEY (`userId`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `taketec-pdo-version-1`.`news`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `taketec-pdo-version-1`.`news` ;

CREATE TABLE IF NOT EXISTS `taketec-pdo-version-1`.`news` (
  `newsId` INT(11) NOT NULL,
  `creation` DATE NOT NULL,
  `update` DATE NULL DEFAULT NULL,
  `userId` INT(11) NOT NULL,
  `content` TEXT NOT NULL,
  `copyright` VARCHAR(100) NULL DEFAULT NULL,
  `paidNew` TINYINT(4) NOT NULL DEFAULT 0,
  `price` DECIMAL(5,2) NULL DEFAULT NULL,
  PRIMARY KEY (`newsId`),
  INDEX `fk_NEWS_USER1_idx` (`userId` ASC),
  CONSTRAINT `fk_NEWS_USER1`
    FOREIGN KEY (`userId`)
    REFERENCES `taketec-pdo-version-1`.`user` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `taketec-pdo-version-1`.`category_has_news`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `taketec-pdo-version-1`.`category_has_news` ;

CREATE TABLE IF NOT EXISTS `taketec-pdo-version-1`.`category_has_news` (
  `catId` INT(11) NOT NULL,
  `newsId` INT(11) NOT NULL,
  INDEX `fk_CATEGORY_has_NEWS_NEWS1_idx` (`newsId` ASC),
  INDEX `fk_CATEGORY_has_NEWS_CATEGORY1_idx` (`catId` ASC),
  CONSTRAINT `fk_CATEGORY_has_NEWS_CATEGORY1`
    FOREIGN KEY (`catId`)
    REFERENCES `taketec-pdo-version-1`.`category` (`catId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CATEGORY_has_NEWS_NEWS1`
    FOREIGN KEY (`newsId`)
    REFERENCES `taketec-pdo-version-1`.`news` (`newsId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `taketec-pdo-version-1`.`comment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `taketec-pdo-version-1`.`comment` ;

CREATE TABLE IF NOT EXISTS `taketec-pdo-version-1`.`comment` (
  `commentId` INT(11) NOT NULL,
  `content` TEXT NOT NULL,
  `newsId` INT(11) NOT NULL,
  `userId` INT(11) NOT NULL,
  PRIMARY KEY (`commentId`),
  INDEX `fk_COMMENT_NEWS1_idx` (`newsId` ASC),
  INDEX `fk_COMMENT_USER1_idx` (`userId` ASC),
  CONSTRAINT `fk_COMMENT_NEWS1`
    FOREIGN KEY (`newsId`)
    REFERENCES `taketec-pdo-version-1`.`news` (`newsId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_COMMENT_USER1`
    FOREIGN KEY (`userId`)
    REFERENCES `taketec-pdo-version-1`.`user` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `taketec-pdo-version-1`.`image`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `taketec-pdo-version-1`.`image` ;

CREATE TABLE IF NOT EXISTS `taketec-pdo-version-1`.`image` (
  `imageId` INT(11) NOT NULL,
  `imagePath` VARCHAR(200) NOT NULL,
  `copyright` VARCHAR(100) NULL DEFAULT NULL,
  `newsId` INT(11) NOT NULL,
  PRIMARY KEY (`imageId`),
  INDEX `fk_IMAGE_NEWS1_idx` (`newsId` ASC),
  CONSTRAINT `fk_IMAGE_NEWS1`
    FOREIGN KEY (`newsId`)
    REFERENCES `taketec-pdo-version-1`.`news` (`newsId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `taketec-pdo-version-1`.`order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `taketec-pdo-version-1`.`order` ;

CREATE TABLE IF NOT EXISTS `taketec-pdo-version-1`.`order` (
  `orderId` INT(11) NOT NULL,
  `user'Id` INT(11) NOT NULL,
  `orderDate` DATETIME NOT NULL,
  PRIMARY KEY (`orderId`),
  INDEX `fk_ORDER_USER1` (`user'Id` ASC),
  CONSTRAINT `fk_ORDER_USER1`
    FOREIGN KEY (`user'Id`)
    REFERENCES `taketec-pdo-version-1`.`user` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `taketec-pdo-version-1`.`payment_method`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `taketec-pdo-version-1`.`payment_method` ;

CREATE TABLE IF NOT EXISTS `taketec-pdo-version-1`.`payment_method` (
  `paymentMethodId` INT(11) NOT NULL,
  `userId` INT(11) NOT NULL,
  `cardType` TINYINT(4) NOT NULL COMMENT '1 = Credit card\n0 = Debit card',
  `cardNumber` VARCHAR(30) NOT NULL,
  `CVV` VARCHAR(3) NULL DEFAULT NULL,
  `nameOnCard` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`paymentMethodId`),
  INDEX `USERID_idx` (`userId` ASC),
  CONSTRAINT `USERID`
    FOREIGN KEY (`userId`)
    REFERENCES `taketec-pdo-version-1`.`user` (`userId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `taketec-pdo-version-1`.`news_has_orders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `taketec-pdo-version-1`.`news_has_orders` ;

CREATE TABLE IF NOT EXISTS `taketec-pdo-version-1`.`news_has_orders` (
  `shoppingCartId` INT(11) NOT NULL,
  `newsId` INT(11) NOT NULL,
  `orderId` INT(11) NOT NULL,
  PRIMARY KEY (`shoppingCartId`),
  INDEX `fk_SHOPPING_CAR_ORDER1_idx` (`orderId` ASC),
  INDEX `fk_SHOPPING_CAR_NEWS1_idx` (`newsId` ASC),
  CONSTRAINT `fk_SHOPPING_CAR_NEWS1`
    FOREIGN KEY (`newsId`)
    REFERENCES `taketec-pdo-version-1`.`news` (`newsId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SHOPPING_CAR_ORDER1`
    FOREIGN KEY (`orderId`)
    REFERENCES `taketec-pdo-version-1`.`order` (`orderId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
