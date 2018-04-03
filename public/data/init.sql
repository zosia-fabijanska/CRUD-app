CREATE DATABASE test;

use test;

CREATE TABLE books (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    title VARCHAR(50) NOT NULL,
    author VARCHAR(30) NOT NULL,
    genre VARCHAR(30) NOT NULL,
    lang VARCHAR(30) NOT NULL,
    published INT(4),
    date TIMESTAMP
);
