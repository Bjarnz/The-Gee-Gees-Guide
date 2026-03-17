CREATE DATABASE IF NOT EXISTS geegees_guide;
USE geegees_guide;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE tutors (
    tutor_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    program VARCHAR(100),
    subjects VARCHAR(255),
    email VARCHAR(100)
);

CREATE TABLE messages (
    message_id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT,
    receiver_id INT,
    message_text TEXT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, email, password) VALUES
('student1','student1@email.com','password123'),
('alex_tutor','alex@email.com','password123');

INSERT INTO tutors (name, program, subjects, email) VALUES
('Alex Johnson','Business Technology Management','ADM 2350','alex@email.com'),
('Jamie Lee','Computer Science','CSC 148','jamie@email.com');

INSERT INTO messages (sender_id, receiver_id, message_text) VALUES
(1,2,'Hi! Are you available for tutoring this week?'),
(2,1,'Yes! I can help with ADM 2350.');
