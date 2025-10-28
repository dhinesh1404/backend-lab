-- create a database --
CREATE DATABASE finalbook;

-- use database --
use finalbook;

-- create a table --
CREATE TABLE final (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    title VARCHAR(50) NOT NULL,
    messageArea TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- create a commentID table
CREATE TABLE comment (
    commentID INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    messageArea TEXT NOT NULL,
    password VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id INT NOT NULL,
    CONSTRAINT FK_id FOREIGN KEY (id)
    REFERENCES final (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

