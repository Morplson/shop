-- Datum: 2019-01-25
-- Autor: David
-- Zweck: Kino2#

DROP DATABASE IF EXISTS kino2;
CREATE DATABASE kino2;
USE kino2;

-- DROP TABLE IF EXISTS kino;
CREATE TABLE kino (
       knr     INTEGER AUTO_INCREMENT,
       kname   VARCHAR(20),
       bes     VARCHAR(120),
       strasse  VARCHAR(20),
       haus    INTEGER,
       tuer     INTEGER,
       tnr     VARCHAR(14),
       email   VARCHAR(40),
       PRIMARY KEY (knr)
) ENGINE=INNODB;

INSERT INTO kino VALUES (1, 'Metro Kino / Filmarchiv Austria', 'Kinokulturhaus','Kulturhaus', 4, null, "+43015121803", 'metrokino@filmarchiv.at');

INSERT INTO kino VALUES (2, 'UCI Kinowelt Millennium City','Die United Cinemas International Multiplex GmbH hat die Informationen und sonstigen Inhalte ihres Internetauftritts sorgfältig recherchiert und zusammengestellt.', 'Siebensterngasse', 37, null, "+43133760", 'uci-kinowelt@uci.at');

INSERT INTO kino VALUES (3, 'English Cinema Haydn','http://www.haydnkino.at', 'Mariahilfer Straße', 57, null, "+4315872262", '--');


CREATE TABLE news (
      wann DATE,
      was  VARCHAR(120),
      wer  VARCHAR(20),
      PRIMARY KEY (wann, was)
) ENGINE=INNODB;

INSERT INTO news VALUES ('2019-01-25','HEUTE SOLL ES REGNEN STÜRMAN ODER SCHNEIEN!','Anonnymos');
INSERT INTO news VALUES ('2019-01-25','Willkommen, bei Kino2!','David');

CREATE TABLE user (
      name VARCHAR(20),
      psw VARCHAR(20),
      istAdmin BOOLEAN,
      PRIMARY KEY (name)
) ENGINE=INNODB;

INSERT INTO user VALUES ('3AHIT','ddd',false);

-- bis MySQL 5.7: GRANT ALL ON kino.* TO 'insy3'@'localhost' IDENTIFIED BY 'blabla';
-- ab MySQL 8.0:
CREATE USER IF EXISTS 'insy3'@'localhost' IDENTIFIED BY 'blabla';
GRANT ALL ON kino2.* TO 'insy3'@'localhost';
