CREATE TABLE `yqc353_4`.`Email_Logs` (
  `idEmail_Logs` INT NOT NULL,
  `emailDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `address` VARCHAR(45) NULL DEFAULT '0000 rue 0000',
  `nameOfCoach` VARCHAR(45) NOT NULL DEFAULT 'x',
  `emailOfCoach` VARCHAR(45) NOT NULL DEFAULT 'x',
  `informationInEmail` VARCHAR(200) NULL DEFAULT 'Information inserted in this section',
  PRIMARY KEY (`idEmail_Logs`));
