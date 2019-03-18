CREATE TABLE members (
	memberid mediumint NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name varchar(50) NOT NULL,
	lastname varchar(50) NOT NULL,
	mail varchar(100)  NOT NULL,
	state varchar(10) NOT NULL,
	rights mediumint  DEFAULT 0 NOT NULL,
	image varchar(255) NULL DEFAULT 'views/image/ameno.jpg',
	pswd varchar(255)   NOT NULL
);

CREATE TABLE questions (
	questionid mediumint NOT NULL AUTO_INCREMENT PRIMARY KEY,
	title varchar(255) NOT NULL,
	subject varchar(255) NOT NULL,
	categoryid mediumint NOT NULL,
	ownerid int NOT NULL,
	creationdate date NOT NULL,
	state varchar(10) NOT NULL,
	likes mediumint NOT NULL DEFAULT 0
);

CREATE TABLE category (
	categoryid mediumint NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name varchar(20) NOT NULL
);

CREATE TABLE answer (
	answerid mediumint NOT NULL AUTO_INCREMENT PRIMARY KEY,
	questionid mediumint NOT NULL,
	subject varchar(255) NOT NULL,
	creationdate date NOT NULL,
	ownerid mediumint NOT NULL,
	likes mediumint NOT NULL DEFAULT 0
);

ALTER TABLE members ADD UNIQUE (mail);

ALTER TABLE category ADD UNIQUE (name);

ALTER TABLE questions ADD CONSTRAINT fk_QUESTIONS_ownerid FOREIGN KEY (ownerid) REFERENCES member (memberid);

ALTER TABLE questions ADD CONSTRAINT fk_QUESTIONS_categoryid FOREIGN KEY (categoryid) REFERENCES category (categoryid);

ALTER TABLE answer ADD CONSTRAINT fk_ANSWER_questionid FOREIGN KEY (questionid) REFERENCES question (questionid);

ALTER TABLE answer ADD CONSTRAINT fk_ANSWER_ownerid FOREIGN KEY (ownerid) REFERENCES member (memberid);
