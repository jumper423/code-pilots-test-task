CREATE TABLE `Table`
(
    `ID` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `Name` VARCHAR(100) NOT NULL,
    `Access` INT(1) DEFAULT 0 NOT NULL
);

INSERT INTO `Table` (`Name`, `Access`) VALUES ('News', 1) , ('Session', 1);

CREATE TABLE `SessionSpeaker` (
`SessionID`  integer NOT NULL ,
`SpeakerID`  integer NOT NULL ,
PRIMARY KEY (`SessionID`, `SpeakerID`)
);

INSERT INTO `SessionSpeaker` (`SessionID`, `SpeakerID`) VALUES ('1', '2');

ALTER TABLE `Session`
ADD COLUMN `NumberOfPlaces`  integer NOT NULL DEFAULT 0 AFTER `Description`;

CREATE TABLE `Users` (
`ID`  int NOT NULL AUTO_INCREMENT ,
`Email`  varchar(255) NOT NULL ,
PRIMARY KEY (`ID`)
);

INSERT INTO `Users` (`Email`) VALUES ('user1@main.ru'), ('user2@test.ru'), ('user3@test.ru');

INSERT INTO `Session` (`Name`, `TimeOfEvent`, `Description`, `NumberOfPlaces`) VALUES ('DevConf', '2017-10-22 16:00:00', 'DevConf 2017', 5);

CREATE TABLE `SessionUser` (
`SessionID`  integer NOT NULL ,
`UserID`  integer NOT NULL ,
PRIMARY KEY (`SessionID`, `UserID`)
);