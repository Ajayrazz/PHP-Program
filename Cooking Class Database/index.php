1. Create Database and Tables
sql
Copy
Edit
-- Create the database
CREATE DATABASE CookingClasses;

-- Use the database
USE CookingClasses;

-- Create Classes table
CREATE TABLE Classes (
    class_id INT PRIMARY KEY AUTO_INCREMENT,
    class_name VARCHAR(255),
    class_date DATE,
    class_fee DECIMAL(10,2)
);

-- Create Instructors table
CREATE TABLE Instructors (
    instructor_id INT PRIMARY KEY AUTO_INCREMENT,
    class_id INT,
    instructor_name VARCHAR(255),
    experience_year INT,
    FOREIGN KEY (class_id) REFERENCES Classes(class_id)
);
2. SQL Query to Find Instructors Teaching Classes with Fees > $50
sql
Copy
Edit
SELECT 
    Instructors.instructor_name,
    Classes.class_name,
    Classes.class_fee
FROM 
    Instructors
INNER JOIN 
    Classes 
ON 
    Instructors.class_id = Classes.class_id
WHERE 
    Classes.class_fee > 50;