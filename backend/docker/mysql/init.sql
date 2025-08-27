-- Create the database (if it does not already exist)
CREATE DATABASE IF NOT EXISTS gsc CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Use the gsc database
USE gsc;

-- Create the student table
CREATE TABLE IF NOT EXISTS student (
    no INT AUTO_INCREMENT PRIMARY KEY,           -- Number (auto increment)
    std_id VARCHAR(20) NOT NULL UNIQUE,          -- Student ID (unique)
    id VARCHAR(20) NOT NULL UNIQUE,              -- Login ID (unique)
    password VARCHAR(100) NOT NULL,              -- Password (should be hashed)
    name VARCHAR(50) NOT NULL,                   -- Name
    age INT,                                     -- Age
    birth DATE                                   -- Date of Birth
);


-- Example of another database setup (commented out)

-- Create database
-- CREATE DATABASE IF NOT EXISTS myapp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Create user (password is 'password123')
-- CREATE USER IF NOT EXISTS 'myuser'@'%' IDENTIFIED BY 'password123';

-- Grant privileges
-- GRANT ALL PRIVILEGES ON myapp.* TO 'myuser'@'%';
-- FLUSH PRIVILEGES;

-- Use the myapp database
-- USE myapp;

-- Create the users table
-- CREATE TABLE IF NOT EXISTS users (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     username VARCHAR(50) NOT NULL UNIQUE,
--     email VARCHAR(100),
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- Insert initial data
-- INSERT INTO users (username, email) VALUES
-- ('alice', 'alice@example.com'),
-- ('bob', 'bob@example.com');