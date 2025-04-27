CREATE DATABASE FitLab;
USE FitLab;

CREATE TABLE IF NOT EXISTS Contact_form_sub (
    contact_form_sub_ID INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(45) NOT NULL,
    last_name VARCHAR(45) NOT NULL,
    email VARCHAR(45) NOT NULL,
    message VARCHAR(255) NOT NULL,
    sub_date VARCHAR(45),
    Users_user_ID INT,
    FOREIGN KEY (Users_user_ID) REFERENCES Users(user_ID) ON DELETE CASCADE
    );

CREATE TABLE IF NOT EXISTS Orders (
    order_ID VARCHAR(10) PRIMARY KEY,
    total_cost VARCHAR(45) NOT NULL,
    order_date VARCHAR(45) NOT NULL,
    Users_user_ID INT,
    FOREIGN KEY (Shipping_ID) REFERENCES Shipping_and_Payment(Shipping_ID) ON DELETE CASCADE
    );

CREATE TABLE IF NOT EXISTS Products (
    product_ID INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(45) NOT NULL,
    description VARCHAR(45),
    price VARCHAR(45) NOT NULL,
    stock_quantity VARCHAR(45) NOT NULL,
    Orders_order_ID VARCHAR(10),
    FOREIGN KEY (Orders_order_ID) REFERENCES Orders(order_ID) ON DELETE SET NULL
    );

CREATE TABLE IF NOT EXISTS Shipping_and_Payment (
    Shipping_ID INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(45) NOT NULL,
    phone_number VARCHAR(45) NOT NULL,
    address VARCHAR(255) NOT NULL,
    payment_type VARCHAR(45) NOT NULL,
    confirmation VARCHAR(45) NOT NULL,
    Orders_order_ID VARCHAR(10),
    FOREIGN KEY (Orders_order_ID) REFERENCES Orders(order_ID) ON DELETE CASCADE
    );

CREATE TABLE Users (
    user_ID INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);