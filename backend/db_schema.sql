-- create database
CREATE DATABASE service_management;

USE service_management;

-- create users tables
CREATE TABLE users(
    username VARCHAR(255) NOT NULL,
    mobile VARCHAR(255) NOT NULL,
    usertype INT(255) NOT NULL,
    user_address VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);
-- CREATE ADMIN USER
INSERT INTO users (username, mobile, usertype, user_address, password) VALUES ('admin', '0000000000', 1, 'Admin Address', 'admin');

-- upload service list
CREATE TABLE services(
    servicename VARCHAR(255) NOT NULL,
    service_desc VARCHAR(255) NOT NULL,
    service_id INT(255) PRIMARY KEY,
    service_price INT(255),
    service_img VARCHAR(255) NOT NULL
);



-- service booking
-- CREATE TABLE service_status(
--     servicename VARCHAR(255) NOT NULL,
--     service_id INT(255) PRIMARY KEY,
--     customer_name VARCHAR(255) NOT NULL,
--     customer_number VARCHAR(255) NOT NULL,
--     customer_address VARCHAR(255) NOT NULL,
--     service_status INT(255) NOT NULL
-- );

CREATE TABLE service_status (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_id INT NOT NULL,
    servicename VARCHAR(255) NOT NULL,
    customer_name VARCHAR(255) NOT NULL,
    customer_number VARCHAR(20) NOT NULL,
    customer_address TEXT NOT NULL,
    service_status TINYINT(1) DEFAULT 0,
    UNIQUE KEY unique_service_customer (service_id, customer_number),
    FOREIGN KEY (service_id) REFERENCES services(service_id)
);