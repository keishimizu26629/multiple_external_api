CREATE DATABASE IF NOT EXISTS mockdb;
USE mockdb;

CREATE TABLE sites (
    id INT PRIMARY KEY,
    name VARCHAR(50),
    created_at DATETIME
);

CREATE TABLE api_keys (
    id INT PRIMARY KEY,
    site_name VARCHAR(50),
    key_value VARCHAR(100)
);

CREATE TABLE images (
    key_value VARCHAR(100) PRIMARY KEY,
    image_url VARCHAR(255)
);

-- モックデータの挿入
INSERT INTO sites (id, name, created_at) VALUES
(1234567, 'Site1', NOW()),
(1234568, 'Site2', NOW()),
(1234569, 'Site3', NOW()),
(1234570, 'Site4', NOW()),
(1234571, 'Site5', NOW());

INSERT INTO api_keys (id, site_name, key_value) VALUES
(1, 'Site1', 'Key1'),
(2, 'Site2', 'Key2'),
(3, 'Site3', 'Key3'),
(4, 'Site4', 'Key4'),
(5, 'Site5', 'Key5');

INSERT INTO images (key_value, image_url) VALUES
('Key1', 'images/image1.jpg'),
('Key2', 'images/image2.jpg'),
('Key3', 'images/image3.jpg'),
('Key4', 'images/image4.jpg'),
('Key5', 'images/image5.jpg');
