CREATE DATABASE mock;
USE mock;

CREATE TABlE users (
    userId      INT AUTO_INCREMENT PRIMARY KEY,
    username    VARCHAR(50) NOT NULL UNIQUE,
    password    VARCHAR(100) NOT NULL,
    role        ENUM('admin','faculty'),
    createdAt   TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
    updatedAt   TIMESTAMP
);

INSERT INTO users (userId,username,password,role) VALUES (NULL,'admin','8873c52efa82acbb104231156e1e4cc1','admin');
-- password is admin

CREATE TABLE student (
    studentId   INT AUTO_INCREMENT PRIMARY KEY,
    firstName   VARCHAR(50) NOT NULL,
    lastName    VARCHAR(50) NOT NULL,
    email       VARCHAR(100) NOT NULL UNIQUE,
    department  VARCHAR(50) NOT NULL,
    course      VARCHAR(50),
    createdAt   TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
    updatedAt   TIMESTAMP
);