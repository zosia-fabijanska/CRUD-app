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

CREATE TABLE shops (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    shop_location VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone INT(12) NOT NULL,
    shop_owner VARCHAR(30) NOT NULL,
    date_created TIMESTAMP
);

CREATE TABLE book_shops (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    books_id INT(10) NOT NULL,
    shops_id INT (10) NOT NULL,
    quantity INT(10) NOT NULL,
    date_created TIMESTAMP
);


