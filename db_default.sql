

DROP DATABASE PDO_1;

CREATE DATABASE PDO_1;
USE PDO_1;

CREATE TABLE users_1(
	id INT NOT NULL AUTO_INCREMENT,
	first VARCHAR(100),
	last VARCHAR(100),
	uid VARCHAR(100),
	age INT(3),
	PRIMARY KEY(id)
);

CREATE TABLE users_2(
	id INT NOT NULL AUTO_INCREMENT,
	first VARCHAR(100),
	last VARCHAR(100),
	uid VARCHAR(100),
	age INT(3),
	PRIMARY KEY(id)
);

INSERT INTO users_1 (first, last, uid, age) VALUES
	('Paul', 'Jobs', 'paul', 100),
	('Steve', 'Jobs', 'steve', 55),
	('Steve', 'Wozniak', 'wozniak', 60);

INSERT INTO users_2 (first, last, uid, age) VALUES
	('Steve','Jobs','steve', 55),
	('Carl','Sagan','carl', 88),
	('Richard','Feynman','feyman', 111),
	('Steve','Wozniak','Wozniak', 60);



