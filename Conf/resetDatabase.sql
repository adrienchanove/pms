-- SQLite

-- Pragma
PRAGMA foreign_keys = ON;

-- Drop tables
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS housing;
DROP TABLE IF EXISTS booking;
DROP TABLE IF EXISTS season;
DROP TABLE IF EXISTS pricing;
DROP TABLE IF EXISTS bookingLine;
DROP TABLE IF EXISTS logs;

-- Create tables
-- 		User
CREATE TABLE IF NOT EXISTS user ( 
	id            INTEGER         PRIMARY KEY AUTOINCREMENT,
	username         VARCHAR(250),
	password       VARCHAR(250),
	is_admin       BOOLEAN
);
-- 		Housing
CREATE TABLE IF NOT EXISTS housing ( 
	id            INTEGER         PRIMARY KEY AUTOINCREMENT,
	name          VARCHAR(250),
	description   TEXT,
	nbPlaces      INTEGER
);
-- 		Booking
CREATE TABLE IF NOT EXISTS booking ( 
	id            INTEGER         PRIMARY KEY AUTOINCREMENT,
	name		  VARCHAR(250),
	nbPlaces      INTEGER,
	dateStart     DATE,
	dateEnd       DATE,
	idHousing     INTEGER,
	paid		  FLOAT,
	FOREIGN KEY (idHousing) REFERENCES housing(id)
);
-- 		Season
CREATE TABLE IF NOT EXISTS season ( 
	id            INTEGER         PRIMARY KEY AUTOINCREMENT,
	name          VARCHAR(250),
	startMonth    INTEGER,
	endMonth      INTEGER
);
-- 		Pricing
CREATE TABLE IF NOT EXISTS pricing ( 
	id            INTEGER         PRIMARY KEY AUTOINCREMENT,
	price         FLOAT,
	idSeason      INTEGER,
	idHousing     INTEGER,
	FOREIGN KEY (idSeason) REFERENCES season(id),
	FOREIGN KEY (idHousing) REFERENCES housing(id)
);
-- 		BookingLine
CREATE TABLE IF NOT EXISTS bookingLine (
	id            INTEGER         PRIMARY KEY AUTOINCREMENT,
	idBooking     INTEGER,
	libelle       VARCHAR(250),
	quantity      INTEGER,
	htPrice       FLOAT,
	FOREIGN KEY (idBooking) REFERENCES booking(id)
);
-- 		Logs
CREATE TABLE IF NOT EXISTS logs ( 
	id            INTEGER         PRIMARY KEY AUTOINCREMENT,
	date          DATETIME,
	message       TEXT
);


-- Insert data
-- 		User
INSERT INTO user (username, password, is_admin) VALUES ('admin', 'chamallow', 1);
INSERT INTO user (username, password, is_admin) VALUES ('user', 'kinder', 0);
-- 		Housing
INSERT INTO housing (name, description, nbPlaces) VALUES ('chalet marmotte', 'chalet confort avec vue sur des rocher', 4);
INSERT INTO housing (name, description, nbPlaces) VALUES ('chalet renard', 'chalet rustique avec vue sur la foret', 6);
INSERT INTO housing (name, description, nbPlaces) VALUES ('chalet ours', 'chalet moderne avec vue sur la montagne', 8);
-- 		Season
INSERT INTO season (name, startMonth, endMonth) VALUES ('hiver', 12, 2);
INSERT INTO season (name, startMonth, endMonth) VALUES ('printemps', 3, 5);
INSERT INTO season (name, startMonth, endMonth) VALUES ('ete', 6, 8);
INSERT INTO season (name, startMonth, endMonth) VALUES ('automne', 9, 11);
-- 		Pricing
INSERT INTO pricing (price, idSeason, idHousing) VALUES (100, 1, 1);
INSERT INTO pricing (price, idSeason, idHousing) VALUES (150, 2, 1);
INSERT INTO pricing (price, idSeason, idHousing) VALUES (200, 3, 1);
INSERT INTO pricing (price, idSeason, idHousing) VALUES (120, 1, 2);
INSERT INTO pricing (price, idSeason, idHousing) VALUES (170, 2, 2);
INSERT INTO pricing (price, idSeason, idHousing) VALUES (220, 3, 2);
INSERT INTO pricing (price, idSeason, idHousing) VALUES (140, 1, 3);
INSERT INTO pricing (price, idSeason, idHousing) VALUES (190, 2, 3);
INSERT INTO pricing (price, idSeason, idHousing) VALUES (240, 3, 3);
-- 		Booking
INSERT INTO booking (name, nbPlaces, dateStart, dateEnd, idHousing, paid) VALUES ('reservation1', 4, '2020-01-01', '2020-01-08', 1, 100);
INSERT INTO booking (name, nbPlaces, dateStart, dateEnd, idHousing, paid) VALUES ('reservation2', 6, '2020-02-01', '2020-02-08', 2, 150);
INSERT INTO booking (name, nbPlaces, dateStart, dateEnd, idHousing, paid) VALUES ('reservation3', 8, '2020-03-01', '2020-03-08', 3, 200);
-- 		BookingLine
INSERT INTO bookingLine (idBooking, libelle, quantity, htPrice) VALUES (1, 'location chalet', 1, 100);
INSERT INTO bookingLine (idBooking, libelle, quantity, htPrice) VALUES (2, 'location chalet', 1, 150);
INSERT INTO bookingLine (idBooking, libelle, quantity, htPrice) VALUES (3, 'location chalet', 1, 200);
INSERT INTO bookingLine (idBooking, libelle, quantity, htPrice) VALUES (3, 'Supplement chien', 1, 30);