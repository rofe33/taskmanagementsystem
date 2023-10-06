CREATE DATABASE TaskManagementSystem;

USE TaskManagementSystem;

CREATE TABLE Clients (
    Client_ID INT NOT NULL PRIMARY KEY,
    Client_Username VARCHAR(50) NOT NULL
);

CREATE TABLE Tasks (
    Task_ID INT NOT NULL PRIMARY KEY,
    Client_ID INT NOT NULL,
    Task_Status VARCHAR(10) NOT NULL,
    Task TEXT NOT NULL,
    Task_Location VARCHAR(50) NOT NULL,
    FOREIGN KEY (Client_ID) REFERENCES Clients(Client_ID)
);
