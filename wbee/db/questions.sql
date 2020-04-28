-- Create a new databse --

CREATE DATABASE dbwbee;

-- Creating questionTable for storing the questions --

CREATE TABLE questionTable (
    id int auto_increment NOT NULL PRIMARY KEY,
    questions VARCHAR(255),
    qid int(11)
);

-- Creating answers table --

CREATE TABLE answerTable (
    id int(11) auto_increment not null PRIMARY KEY,
    answers VARCHAR(255),
    aid int(11)
);

-- Table for those who attended exam --
CREATE TABLE estudents (
    id int(11) auto_increment NOT NULL PRIMARY KEY,
    emailid VARCHAR(255),
    totalques int(255), 
    answercorrect int(255)
);

-- exam category table --

CREATE TABLE exam_category (
    id INT(5) NOT NULL auto_increment PRIMARY KEY,
    category VARCHAR(100),
    exam_time_in_minutes VARCHAR(5)
);