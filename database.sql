-- Student Experiment Portal Database
-- Database: student_experiments

CREATE DATABASE IF NOT EXISTS student_experiments;
USE student_experiments;

-- Students Table
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    qid VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100),
    password VARCHAR(255) NOT NULL,
    google_id VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Experiments Table
CREATE TABLE IF NOT EXISTS experiments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    experiment_no INT NOT NULL,
    experiment_name VARCHAR(255) NOT NULL,
    code TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_experiment_no (experiment_no)
);

-- Insert initial experiments
INSERT INTO experiments (experiment_no, experiment_name, code) VALUES
(1, 'Create Menu using HTML and CSS', ''),
(2, 'Build PHP MySQL 5 Star rating System using AJAX', ''),
(3, 'Sort associative array by value of key in PHP', ''),
(4, 'Create Sign Up form with server-side validation', ''),
(5, 'Implement basic File System functions in PHP', ''),
(6, 'Create CAPTCHA in PHP contact form', ''),
(7, 'Upload multiple images to MySQL database', ''),
(8, 'CRUD Operations with MySQL in PHP', ''),
(9, 'Build Login and User Authentication System', ''),
(10, 'Manage sessions in PHP', '');

