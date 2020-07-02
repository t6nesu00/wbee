-- Create a new databse --

CREATE DATABASE dbwbee;


-- Creating questionTable for storing the questions --

CREATE TABLE questionTable (
    id int(5) auto_increment NOT NULL PRIMARY KEY,
    question_no VARCHAR(5),
    question VARCHAR(255),
    opt1 VARCHAR(100),
    opt2 VARCHAR(100),
    opt3 VARCHAR(100),
    opt4 VARCHAR(100),
    answer VARCHAR(100),
    category VARCHAR(100)
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

-- result table --
CREATE TABLE exam_result (
    id int(11) auto_increment NOT NULL PRIMARY KEY,
    email VARCHAR(255),
    exam_type VARCHAR(255),
    total_question VARCHAR(11), 
    correct_answer VARCHAR(11),
    wrong_answer VARCHAR(11),
    exam_time varchar(11)
);
