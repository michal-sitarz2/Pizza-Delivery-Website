CREATE DATABASE IF NOT EXISTS delivery_system_cw;

USE delivery_system_cw;

CREATE TABLE IF NOT EXISTS Person
(
    ID INT UNSIGNED UNIQUE NOT NULL,
    Forename VARCHAR(255) NOT NULL,
    Surname VARCHAR(255) NOT NULL,
    DOB DATE NOT NULL,
    Telephone VARCHAR(20) NOT NULL,
    Email TEXT(2083) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS Item 
(
    Name VARCHAR(255) UNIQUE NOT NULL,
    Price DOUBLE UNSIGNED,
    Category ENUM('Pizza', 'Pasta', 'Salad', 'Dessert'),
    PRIMARY KEY (Name)
);

CREATE TABLE IF NOT EXISTS Staff
(
    Staff_ID INT UNSIGNED UNIQUE NOT NULL,
    Start_Time TIME DEFAULT '10:00:00',
    End_Time TIME DEFAULT '22:00:00',
    Salary DOUBLE UNSIGNED NOT NULL,
    PRIMARY KEY (Staff_ID),
    FOREIGN KEY (Staff_ID) REFERENCES Person(ID)
);

CREATE TABLE IF NOT EXISTS Working_Day
(
    Worker_ID INT UNSIGNED NOT NULL,
    Day ENUM('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday') NOT NULL,
    PRIMARY KEY (Worker_ID, Day),
    FOREIGN KEY (Worker_ID) REFERENCES Staff(Staff_ID)
);

CREATE TABLE IF NOT EXISTS Cook
(
    Staff_ID INT UNSIGNED UNIQUE NOT NULL,
    Item VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (Staff_ID),
    FOREIGN KEY (Staff_ID) REFERENCES Staff(Staff_ID),
    FOREIGN KEY (Item) REFERENCES Item(Name)
);

CREATE TABLE IF NOT EXISTS Delivery_Person
(
    Staff_ID INT UNSIGNED UNIQUE NOT NULL,
    Vehicle ENUM('Honda Civic Coupe 5th Generation','Keeway Kee 125 E3', 'Roketa 150cc 06') NOT NULL,
    PRIMARY KEY (Staff_ID),
    FOREIGN KEY (Staff_ID) REFERENCES Staff(Staff_ID)
);

CREATE TABLE IF NOT EXISTS Customer
(
    Customer_ID INT UNSIGNED UNIQUE NOT NULL,
    Address TEXT(2083) NOT NULL,
    Credit_Card_Number BIGINT UNSIGNED UNIQUE NOT NULL,
    Card_Type ENUM('Visa', 'Mastercard', 'Discover', 'American Express'),
    PRIMARY KEY (Customer_ID),
    FOREIGN KEY (Customer_ID) REFERENCES Person(ID)
);

CREATE TABLE IF NOT EXISTS Ingredient
(
    Item_Name VARCHAR(255) NOT NULL,
    Ingredient VARCHAR(255),
    PRIMARY KEY (Item_Name, Ingredient),
    FOREIGN KEY (Item_Name) REFERENCES Item(Name)
);



CREATE TABLE IF NOT EXISTS Customer_Order
(
    Order_Number INT UNSIGNED UNIQUE NOT NULL AUTO_INCREMENT,
    Order_Size INT UNSIGNED,
    Order_Status ENUM('Being Prepared in the Kitchen', 'Being Delivered', 'Done') DEFAULT 'Being Prepared in the Kitchen',
    Time_Ordered TIME,
    Total_Price DOUBLE UNSIGNED,
    Delivery_ID INT UNSIGNED,
    Customer INT UNSIGNED NOT NULL,
    PRIMARY KEY (Order_Number),
    FOREIGN KEY (Delivery_ID) REFERENCES Delivery_Person(Staff_ID),
    FOREIGN KEY (Customer) REFERENCES Customer(Customer_ID)
);


CREATE TABLE IF NOT EXISTS Item_Order
(
    Item_Name VARCHAR(255) NOT NULL,
    Order_Number INT UNSIGNED NOT NULL,
    Quantity INT UNSIGNED,
    PRIMARY KEY (Item_Name, Order_Number),
    FOREIGN KEY (Item_Name) REFERENCES Item(Name),
    FOREIGN KEY (Order_Number) REFERENCES Customer_Order(Order_Number)
);

-- Inserting People with random names into the database

INSERT INTO Person VALUES(1000, 'Gwendolyn', 'Phillips', '1995-01-12', '07911 078562', 'gwen.phil@gmail.com');
INSERT INTO Person VALUES(1001, 'Earnest', 'Blake', '1989-02-08', '07911 658327', 'earny.blake@gmail.com');
INSERT INTO Person VALUES(1002, 'Sean', 'Lane', '1986-03-17', '07911 897864', 'lane.sean@gmail.com');
INSERT INTO Person VALUES(1003, 'Bethany', 'Yates', '1991-04-23', '07911 856392', 'bethy@gmail.com');
INSERT INTO Person VALUES(1004, 'Connie', 'Horton', '1993-05-22', '07911 781300', 'horton_connie@gmail.com');
INSERT INTO Person VALUES(1005, 'Edward', 'Nottingham', '1985-06-06', '07911 098765', 'nottingham.ed@yahoo.com');
INSERT INTO Person VALUES(2000, 'Gustavo', 'Wise', '1987-07-23', '07911 032303', 'gustavothewise@gmail.com');
INSERT INTO Person VALUES(2001, 'Ellen', 'Williams', '1975-09-01', '07911 875609','ellen123@gmail.com');
INSERT INTO Person VALUES(2002, 'Kerry', 'James', '1979-10-10', '07911 123098', 'jamesk98@gmail.com');
INSERT INTO Person VALUES(2003, 'Bernard', 'Warren', '1985-11-29', '07911 767676', 'warrenberny89@gmail.com');
INSERT INTO Person VALUES(2004, 'Tomas', 'Beck', '1990-12-25', '07911 738291', 'tomasbeck@gmail.com');
INSERT INTO Person VALUES(2005, 'James', 'Bond', '1998-01-01', '07911 000000', 'bond_jamesBond@gmail.com');

-- Inserting into Staff

INSERT INTO Staff VALUES(1000, '10:00:00', '16:00:00', 15000);
INSERT INTO Staff VALUES(1001, '10:00:00', '16:00:00', 20000);
INSERT INTO Staff VALUES(1002, '10:00:00', '16:00:00', 20000);
INSERT INTO Staff VALUES(1003, '16:10:00', '22:30:00', 16000);
INSERT INTO Staff VALUES(1004, '16:10:00', '22:30:00', 21000);
INSERT INTO Staff VALUES(1005, '16:10:00', '22:30:00', 21000);
INSERT INTO Staff VALUES(2000, '10:00:00', '16:00:00', 30000);
INSERT INTO Staff VALUES(2001, '10:00:00', '16:00:00', 35000);
INSERT INTO Staff VALUES(2002, '10:00:00', '16:00:00', 35000);
INSERT INTO Staff VALUES(2003, '16:10:00', '22:30:00', 31000);
INSERT INTO Staff VALUES(2004, '16:10:00', '22:30:00', 37000);
INSERT INTO Staff VALUES(2005, '16:10:00', '22:30:00', 37000);

-- Inserting into Working_day

INSERT INTO Working_Day VALUES(1000, 'Monday');
INSERT INTO Working_Day VALUES(1000, 'Tuesday');
INSERT INTO Working_Day VALUES(1000, 'Wednesday');
INSERT INTO Working_Day VALUES(1000, 'Thursday');
INSERT INTO Working_Day VALUES(1001, 'Monday');
INSERT INTO Working_Day VALUES(1001, 'Tuesday');
INSERT INTO Working_Day VALUES(1001, 'Wednesday');
INSERT INTO Working_Day VALUES(1001, 'Thursday');
INSERT INTO Working_Day VALUES(1001, 'Friday');
INSERT INTO Working_Day VALUES(1001, 'Saturday');
INSERT INTO Working_Day VALUES(1002, 'Monday');
INSERT INTO Working_Day VALUES(1002, 'Tuesday');
INSERT INTO Working_Day VALUES(1002, 'Wednesday');
INSERT INTO Working_Day VALUES(1002, 'Thursday');
INSERT INTO Working_Day VALUES(1002, 'Friday');
INSERT INTO Working_Day VALUES(1002, 'Saturday');
INSERT INTO Working_Day VALUES(1003, 'Monday');
INSERT INTO Working_Day VALUES(1003, 'Tuesday');
INSERT INTO Working_Day VALUES(1003, 'Wednesday');
INSERT INTO Working_Day VALUES(1003, 'Thursday');
INSERT INTO Working_Day VALUES(1004, 'Monday');
INSERT INTO Working_Day VALUES(1004, 'Tuesday');
INSERT INTO Working_Day VALUES(1004, 'Wednesday');
INSERT INTO Working_Day VALUES(1004, 'Thursday');
INSERT INTO Working_Day VALUES(1004, 'Friday');
INSERT INTO Working_Day VALUES(1004, 'Saturday');
INSERT INTO Working_Day VALUES(1005, 'Monday');
INSERT INTO Working_Day VALUES(1005, 'Tuesday');
INSERT INTO Working_Day VALUES(1005, 'Wednesday');
INSERT INTO Working_Day VALUES(1005, 'Thursday');
INSERT INTO Working_Day VALUES(1005, 'Friday');
INSERT INTO Working_Day VALUES(1005, 'Saturday');

INSERT INTO Working_Day VALUES(2000, 'Monday');
INSERT INTO Working_Day VALUES(2000, 'Tuesday');
INSERT INTO Working_Day VALUES(2000, 'Wednesday');
INSERT INTO Working_Day VALUES(2000, 'Thursday');
INSERT INTO Working_Day VALUES(2001, 'Monday');
INSERT INTO Working_Day VALUES(2001, 'Tuesday');
INSERT INTO Working_Day VALUES(2001, 'Wednesday');
INSERT INTO Working_Day VALUES(2001, 'Thursday');
INSERT INTO Working_Day VALUES(2001, 'Friday');
INSERT INTO Working_Day VALUES(2001, 'Saturday');
INSERT INTO Working_Day VALUES(2002, 'Monday');
INSERT INTO Working_Day VALUES(2002, 'Tuesday');
INSERT INTO Working_Day VALUES(2002, 'Wednesday');
INSERT INTO Working_Day VALUES(2002, 'Thursday');
INSERT INTO Working_Day VALUES(2002, 'Friday');
INSERT INTO Working_Day VALUES(2002, 'Saturday');
INSERT INTO Working_Day VALUES(2003, 'Monday');
INSERT INTO Working_Day VALUES(2003, 'Tuesday');
INSERT INTO Working_Day VALUES(2003, 'Wednesday');
INSERT INTO Working_Day VALUES(2003, 'Thursday');
INSERT INTO Working_Day VALUES(2004, 'Monday');
INSERT INTO Working_Day VALUES(2004, 'Tuesday');
INSERT INTO Working_Day VALUES(2004, 'Wednesday');
INSERT INTO Working_Day VALUES(2004, 'Thursday');
INSERT INTO Working_Day VALUES(2004, 'Friday');
INSERT INTO Working_Day VALUES(2004, 'Saturday');
INSERT INTO Working_Day VALUES(2005, 'Monday');
INSERT INTO Working_Day VALUES(2005, 'Tuesday');
INSERT INTO Working_Day VALUES(2005, 'Wednesday');
INSERT INTO Working_Day VALUES(2005, 'Thursday');
INSERT INTO Working_Day VALUES(2005, 'Friday');
INSERT INTO Working_Day VALUES(2005, 'Saturday');

-- Inserting into Delivery_Person

INSERT INTO Delivery_Person VALUES(1000, 'Honda Civic Coupe 5th Generation');
INSERT INTO Delivery_Person VALUES(1001, 'Keeway Kee 125 E3');
INSERT INTO Delivery_Person VALUES(1002, 'Roketa 150cc 06');
INSERT INTO Delivery_Person VALUES(1003, 'Roketa 150cc 06');
INSERT INTO Delivery_Person VALUES(1004, 'Keeway Kee 125 E3');
INSERT INTO Delivery_Person VALUES(1005, 'Honda Civic Coupe 5th Generation');

-- Inserting into Cook
-- For simplicity let's assume that a single cook can focus on a single item and initially at the start of the day, they don't have any orders

INSERT INTO Cook VALUES(2000, null);
INSERT INTO Cook VALUES(2001, null);
INSERT INTO Cook VALUES(2002, null);
INSERT INTO Cook VALUES(2003, null);
INSERT INTO Cook VALUES(2004, null);
INSERT INTO Cook VALUES(2005, null);

-- Inserting into Item (the menu)

INSERT INTO Item VALUES("PIZZA Margherita", 10.5, "Pizza");
INSERT INTO Item VALUES("PIZZA Peperoni", 12.0, "Pizza");
INSERT INTO Item VALUES("PIZZA Vegetarian", 10.0, "Pizza");
INSERT INTO Item VALUES("PIZZA Mexicana", 13.0, "Pizza");
INSERT INTO Item VALUES("PIZZA Funghi", 11.5, "Pizza");
INSERT INTO Item VALUES("PIZZA Capricciosa", 11.5, "Pizza");

INSERT INTO Item VALUES("Spaghetti Bolognese", 9.5, "Pasta");
INSERT INTO Item VALUES("Carbonara", 10.0, "Pasta");
INSERT INTO Item VALUES("Beef Lasagna", 10.5, "Pasta");

INSERT INTO Item VALUES("Greek Salad", 3.5, "Salad");
INSERT INTO Item VALUES("Mixed Salad", 2.5, "Salad");
INSERT INTO Item VALUES("Chicken Caesar Salad", 6.0, "Salad");

INSERT INTO Item VALUES("Pancakes with Chocolate", 4.5, "Dessert");
INSERT INTO Item VALUES("Pancakes with Jam", 4.5, "Dessert");
INSERT INTO Item VALUES("Triple Chocolate Cookies", 2.0, "Dessert");
INSERT INTO Item VALUES("Profiteroles", 4.5, "Dessert");

-- Inserting into Ingredients

INSERT INTO Ingredient VALUES("PIZZA Margherita", "Mozzarella");
INSERT INTO Ingredient VALUES("PIZZA Margherita", "Tomato Sauce");
INSERT INTO Ingredient VALUES("PIZZA Margherita", "Basil");

INSERT INTO Ingredient VALUES("PIZZA Peperoni", "Mozzarella");
INSERT INTO Ingredient VALUES("PIZZA Peperoni", "Tomato Sauce");
INSERT INTO Ingredient VALUES("PIZZA Peperoni", "Peperoni");

INSERT INTO Ingredient VALUES("PIZZA Vegetarian", "Mozzarella");
INSERT INTO Ingredient VALUES("PIZZA Vegetarian", "Tomato Sauce");
INSERT INTO Ingredient VALUES("PIZZA Vegetarian", "Spinach");
INSERT INTO Ingredient VALUES("PIZZA Vegetarian", "Mushrooms");
INSERT INTO Ingredient VALUES("PIZZA Vegetarian", "Onions");
INSERT INTO Ingredient VALUES("PIZZA Vegetarian", "Fresh Tomatoes");
INSERT INTO Ingredient VALUES("PIZZA Vegetarian", "Zucchini");
INSERT INTO Ingredient VALUES("PIZZA Vegetarian", "Garlic");

INSERT INTO Ingredient VALUES("PIZZA Mexicana", "Mozzarella");
INSERT INTO Ingredient VALUES("PIZZA Mexicana", "Tomato Sauce");
INSERT INTO Ingredient VALUES("PIZZA Mexicana", "Green Chilis");
INSERT INTO Ingredient VALUES("PIZZA Mexicana", "Red Onions");
INSERT INTO Ingredient VALUES("PIZZA Mexicana", "Fresh Cilantro");
INSERT INTO Ingredient VALUES("PIZZA Mexicana", "Refried Beans");
INSERT INTO Ingredient VALUES("PIZZA Mexicana", "Chicken");

INSERT INTO Ingredient VALUES("PIZZA Funghi", "Mozzarella");
INSERT INTO Ingredient VALUES("PIZZA Funghi", "Tomato Sauce");
INSERT INTO Ingredient VALUES("PIZZA Funghi", "Mushrooms");

INSERT INTO Ingredient VALUES("PIZZA Capricciosa", "Mozzarella");
INSERT INTO Ingredient VALUES("PIZZA Capricciosa", "Tomato Sauce");
INSERT INTO Ingredient VALUES("PIZZA Capricciosa", "Mushrooms");
INSERT INTO Ingredient VALUES("PIZZA Capricciosa", "Ham");
INSERT INTO Ingredient VALUES("PIZZA Capricciosa", "Artichokes");

INSERT INTO Ingredient VALUES("Spaghetti Bolognese", "Beef");
INSERT INTO Ingredient VALUES("Spaghetti Bolognese", "Onions");
INSERT INTO Ingredient VALUES("Spaghetti Bolognese", "Tomato Sauce");
INSERT INTO Ingredient VALUES("Spaghetti Bolognese", "Garlic");
INSERT INTO Ingredient VALUES("Spaghetti Bolognese", "Spaghetti");


INSERT INTO Ingredient VALUES("Carbonara", "Spaghetti");
INSERT INTO Ingredient VALUES("Carbonara", "Bacon");
INSERT INTO Ingredient VALUES("Carbonara", "Egg");
INSERT INTO Ingredient VALUES("Carbonara", "Pancetta");

INSERT INTO Ingredient VALUES("Beef Lasagna", "Beef");
INSERT INTO Ingredient VALUES("Beef Lasagna", "Garlic");
INSERT INTO Ingredient VALUES("Beef Lasagna", "Mozarella");

INSERT INTO Ingredient VALUES("Greek Salad", "Tomatoes");
INSERT INTO Ingredient VALUES("Greek Salad", "Cucumbers");
INSERT INTO Ingredient VALUES("Greek Salad", "Onion");
INSERT INTO Ingredient VALUES("Greek Salad", "Feta Cheese");
INSERT INTO Ingredient VALUES("Greek Salad", "Olives");

INSERT INTO Ingredient VALUES("Mixed Salad", "Lettuce");
INSERT INTO Ingredient VALUES("Mixed Salad", "Red Swiss Chard");
INSERT INTO Ingredient VALUES("Mixed Salad", "Cucumber");
INSERT INTO Ingredient VALUES("Mixed Salad", "Plum Tomatoes");
INSERT INTO Ingredient VALUES("Mixed Salad", "Onions");

INSERT INTO Ingredient VALUES("Chicken Caesar Salad", "Lettuce");
INSERT INTO Ingredient VALUES("Chicken Caesar Salad", "Chicken");
INSERT INTO Ingredient VALUES("Chicken Caesar Salad", "Ciabatta Loaf");
INSERT INTO Ingredient VALUES("Chicken Caesar Salad", "Green Salad");
INSERT INTO Ingredient VALUES("Chicken Caesar Salad", "Parmesan Cheese");


INSERT INTO Ingredient VALUES("Pancakes with Chocolate", "Chocolate");

INSERT INTO Ingredient VALUES("Pancakes with Jam", "Strawberry Jam");

INSERT INTO Ingredient VALUES("Triple Chocolate Cookies", "Milk Chocolate");
INSERT INTO Ingredient VALUES("Triple Chocolate Cookies", "Dark Chocolate");
INSERT INTO Ingredient VALUES("Triple Chocolate Cookies", "White Chocolate");

INSERT INTO Ingredient VALUES("Profiteroles", "Cream Puff");
INSERT INTO Ingredient VALUES("Profiteroles", "Cocoa Sauce");
INSERT INTO Ingredient VALUES("Profiteroles", "Vanilla");

-- Creating a Person who will be responsible for the database a.k.a. the admin

INSERT INTO Person VALUES(9100, 'Michal', 'Sitarz', '1987-02-22', '07911 123456', 'michalsitarz2001@gmail.com');

    



