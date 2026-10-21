CREATE DATABASE IF NOT EXISTS db_lsp;
use db_lsp;

CREATE TABLE IF NOT EXISTS user (
    id int auto_increment primary key,
    username varchar(50) NOT NULL UNIQUE,
    password varchar(255) NOT NULL
); 
INSERT INTO user (username, password) VALUES ('admin', '12345');