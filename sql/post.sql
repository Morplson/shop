DROP DATABASE IF EXISTS shop;
CREATE DATABASE shop;
USE shop;

CREATE TABLE user (
  uid INT auto_increment,
  uname VARCHAR(20) UNIQUE,
  email VARCHAR(100) UNIQUE,
  psw VARCHAR(20), -- bitte NUR hash SIMON!!!!



  -- VVVVVVVVVVVVVVVVVVVVVVVVVV
  -- V Wenn du noch spaß hast V
  -- VVVVVVVVVVVVVVVVVVVVVVVVVV

  -- description varchar(2200),

  -- location varchar(10),
  -- tel varchar(100),
  -- vname varchar(100),
  -- nname varchar(100),

  -- created datetime,
  -- modified datetime,
  -- permission int,




  PRIMARY KEY (uid)
)ENGINE=INNODB;

INSERT INTO user(uname,email,psw) VALUES ("superuser","super@user.com","2234");


CREATE TABLE post(
  pid INT auto_increment,
  uid INT,
  title VARCHAR(20),
  preis VARCHAR(20),
  description VARCHAR(100),
  gewicht INT,
  anzahl INT NOT NULL,
  einheit VARCHAR(20),
  imgsrc VARCHAR(40),
  
  featured boolean Default false, 
  primary key (pid),
  foreign key (uid) references user(uid) on update cascade on delete cascade
)ENGINE=INNODB;

INSERT INTO post(uid, title, preis, description, gewicht, anzahl, einheit, imgsrc) VALUES (1,"test","10","test",4,3,"Stk.","0dcf0ad6c6da4c08441adeb1843540b8") ;

create table vote(

  pid integer,
  vote tinyint,
  uid integer,
  
  primary key (pid, uid),
  foreign key (uid) references user(uid) on delete cascade,
  foreign key (pid) references post(pid) on delete cascade
)engine = innodb;

create table liked(
  
  pid integer,
  uid integer,
  
  primary key (pid, uid),
  foreign key (uid) references user(uid) on delete cascade,
  foreign key (pid) references post(pid) on delete cascade
)engine = innodb;

create table comment(
  
  cid integer auto_increment,
  pid integer,
  uid integer,

  title varchar(100),
  description varchar(2200),
  
  primary key (cid),
  foreign key (uid) references user(uid) on delete cascade,
  foreign key (pid) references post(pid) on delete cascade
)engine = innodb;

CREATE TABLE `crypto_payments` (
  `paymentID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `boxID` int(11) unsigned NOT NULL DEFAULT '0',
  `boxType` enum('paymentbox','captchabox') NOT NULL,
  `orderID` varchar(50) NOT NULL DEFAULT '',
  `userID` varchar(50) NOT NULL DEFAULT '',
  `countryID` varchar(3) NOT NULL DEFAULT '',
  `coinLabel` varchar(6) NOT NULL DEFAULT '',
  `amount` double(20,8) NOT NULL DEFAULT '0.00000000',
  `amountUSD` double(20,8) NOT NULL DEFAULT '0.00000000',
  `unrecognised` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `addr` varchar(34) NOT NULL DEFAULT '',
  `txID` char(64) NOT NULL DEFAULT '',
  `txDate` datetime DEFAULT NULL,
  `txConfirmed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `txCheckDate` datetime DEFAULT NULL,
  `processed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `processedDate` datetime DEFAULT NULL,
  `recordCreated` datetime DEFAULT NULL,
  PRIMARY KEY (`paymentID`),
  KEY `boxID` (`boxID`),
  KEY `boxType` (`boxType`),
  KEY `userID` (`userID`),
  KEY `countryID` (`countryID`),
  KEY `orderID` (`orderID`),
  KEY `amount` (`amount`),
  KEY `amountUSD` (`amountUSD`),
  KEY `coinLabel` (`coinLabel`),
  KEY `unrecognised` (`unrecognised`),
  KEY `addr` (`addr`),
  KEY `txID` (`txID`),
  KEY `txDate` (`txDate`),
  KEY `txConfirmed` (`txConfirmed`),
  KEY `txCheckDate` (`txCheckDate`),
  KEY `processed` (`processed`),
  KEY `processedDate` (`processedDate`),
  KEY `recordCreated` (`recordCreated`),
  KEY `key1` (`boxID`,`orderID`),
  KEY `key2` (`boxID`,`orderID`,`userID`),
  UNIQUE KEY `key3` (`boxID`, `orderID`, `userID`, `txID`, `amount`, `addr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


CREATE USER 'shop'@'localhost' IDENTIFIED BY 'shop';
GRANT ALL ON shop.* TO 'shop'@'localhost';


 select * from post;


 