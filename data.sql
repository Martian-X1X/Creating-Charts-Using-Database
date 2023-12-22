CREATE DATABASE IF NOT EXISTS Dashboard;
USE Dashboard;

-- Table 1: Names and Phone Numbers
CREATE TABLE IF NOT EXISTS customer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    phone_number VARCHAR(15) NOT NULL
);

-- Table 2: Employee Information
CREATE TABLE IF NOT EXISTS employee (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_name VARCHAR(255) NOT NULL,
    type VARCHAR(255),
    address VARCHAR(255),
    salary DECIMAL(10, 2)
);

-- Table 3: Logistic Items
CREATE TABLE IF NOT EXISTS logistic (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(255) NOT NULL,
    category VARCHAR(255),
    quantity INT
);

-- Inserting some dummy data into the tables for illustration
-- Table 1
INSERT INTO customer (name,city,phone_number) VALUES
    ('Abdullah','Dhaka','0170412585'),
    ('Sowad Ali','Dhaka', '016478500'),
    ('Rahman','Rajshahi', '01944105'),
    ('Motin','Sylhet', '01958752'),
    ('Neela Khan','Sylhet', '016447100'),
    ('Hania Amir','Sylhet', '015445100'),
    ('Jamal Bhuiyan','Dhaka', '018747100'),
    ('Rehan Matin','Barishal', '016474100'),
    ('Zawad hussain','Chattogram', '016447100'),
    ('Alamgir','Chattogram', '015577100'),
    ('Nayla Nuren','Dhaka', '012345678');

-- Table 2
INSERT INTO employee (employee_name,type, address, salary) VALUES
    ('Akibur Rahman','Marketing', '783 Wall St', 60000.00),
    ('Liton Das','Sales', '406 Gulshan St', 75000.00),
    ('Ahsan Khan','Sales', 'Banani ', 80000.00),
    ('Akash Roy','Software Developer', '406 Gulshan St', 105000.00),
    ('Ayesha Begum','Sales', 'Bashundhara R/A', 75000.00),
    ('Samantha','Sales', 'Baridhara DOHS', 80000.00),
    ('Patrick Jelberg','Marketing', 'Baridhara DOHS', 60000.00),
    ('Samira Jinnat','Jr Software Developer', 'Bashundhara R/A', 50000.00),
    ('Osman khawaja','Accounts', 'Badda', 90000.00);

-- Table 3
INSERT INTO logistic (item_name, category, quantity) VALUES
    ('Chair','Furniture', 30),
    ('Laptop','Electronic', 10),
    ('Tissue paper','Supplies', 200),
    ('Coffee','Supplies', 150),
    ('Projectors','Electronic', 2),
    ('Monitors','Electronic', 5),
    ('Suger','Supplies', 150),
    ('Podium','Furniture', 4),
    ('Office Chair','Furniture', 150),
    ('Coffee Table','Furniture', 3),
    ('Air Freshner','Supplies', 20),
    ('Pens','Supplies', 200),
    ('Desk','Furniture', 25);

