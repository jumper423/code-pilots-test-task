CREATE TABLE `Table`
(
    `ID` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `Table` VARCHAR(100) NOT NULL,
    `Access` INT(1) DEFAULT 0 NOT NULL
);

INSERT INTO `Table` (`Table`, `Access`) VALUES ('News', 1) , ('Session', 1);