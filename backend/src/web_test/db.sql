-- create a database --
CREATE DATABASE finalbook;

-- use database --
use finalbook;

-- create a table --
CREATE TABLE final (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    messageArea TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
