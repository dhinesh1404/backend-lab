--> 1 Create Database
CREATE DATABASE board;

--> 2 use Database
USE board;

--> 3 Create Table (login)
CREATE TABLE login (
    name VARCHAR(100) NOT NULL,
    account VARCHAR(100) NOT NULL UNIQUE,
    pw VARCHAR(100) NOT NULL
)
--> 4 Create Table (board)
CREATE TABLE board (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    title VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
)