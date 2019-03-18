CREATE TABLE 'members' 
(
	`memberid` int,
	`name` varchar(255),
	`lastname` varchar(255),
	`mail` varchar(255),
	`state` varchar(255),
	`rights` int,
	`image` varchar(255)
);

CREATE TABLE `question` 
(
	`questionid` int,
	`title` varchar(255),
	`subject` varchar(255),
	`categoryid` int,
	`ownerid` int,
	`creationdate` datetime,
	`state` varchar(255),
	`likes` int
);

CREATE TABLE `category` 
(
	`categoryid` int,
	`name` varchar(255)
);

CREATE TABLE `answer` 
(
	`answerid` int,
	`questionid` int,
	`subject` varchar(255),
	`creationdate` datetime,
	`ownerid` int,
	`likes` int
);

ALTER TABLE `question` ADD FOREIGN KEY (`ownerid`) REFERENCES `member` (`memberid`);

ALTER TABLE `question` ADD FOREIGN KEY (`categoryid`) REFERENCES `category` (`categoryid`);

ALTER TABLE `answer` ADD FOREIGN KEY (`questionid`) REFERENCES `question` (`questionid`);

ALTER TABLE `answer` ADD FOREIGN KEY (`ownerid`) REFERENCES `member` (`memberid`);
