-- 1. 데이터베이스 생성
CREATE DATABASE board;

-- 2. 데이터베이스 사용
USE board;

-- 3. 테이블 생성 (로그인)
-- col이름 자료형 etc
-- PRIMARY KEY: NOT NULL(무조건 값이 있어야 함) + UNIQUE(유일해야 함)
CREATE TABLE login (
    name VARCHAR(100) NOT NULL,
    account VARCHAR(100) NOT NULL UNIQUE,
    pw VARCHAR(100) NOT NULL
)

---------------------------------------------------------------------------------
-- 4. 테이블 생성 (게시판)
-- id, autor_name, text, 
CREATE TABLE board (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    title VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
)
