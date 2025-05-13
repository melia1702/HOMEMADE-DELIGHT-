CREATE DATABASE IF NOT EXISTS homemade_db;
USE homemade_db;

CREATE TABLE pesanan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  telepon VARCHAR(20),
  alamat TEXT,
  mode VARCHAR(20),
  rakik INT,
  balado INT,
  jangek INT,
  sanjai INT,
  karak INT,
  total INT,
  waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
