CREATE DATABASE TaskManagementSystem
CHARACTER SET utf8mb4
COLLATE utf8_unicode_520_ci;

USE TaskManagementSystem;

CREATE TABLE Clients (
    Client_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Client_Username VARCHAR(50) NOT NULL
)
CHARACTER SET utf8mb4
COLLATE utf8_unicode_520_ci;

CREATE TABLE Tasks (
    Task_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Client_ID INT NOT NULL,
    Task_Status VARCHAR(15) NOT NULL,
    Task TEXT NOT NULL,
    Task_Location VARCHAR(50) NOT NULL,
    FOREIGN KEY (Client_ID) REFERENCES Clients(Client_ID)
)
CHARACTER SET utf8mb4
COLLATE utf8_unicode_520_ci;
