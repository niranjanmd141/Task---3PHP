-- Create the database 

CREATE DATABASE blog;

-- Create users table

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin user (username: admin, password: admin123)

INSERT INTO users (username, password) 
VALUES ('admin', '$2y$10$h0EM9C7pQ1gGHFROuv85.eF5T9OXNSIQCNV7qUNpGQW2quX1aVDxe');


-- Create posts table

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Insert sample blog posts

INSERT INTO posts (title, content) VALUES
('Welcome to the Blog', 'This is your first blog post. Feel free to edit or delete it.'),
('CRUD Made Easy', 'Learn how to create, read, update, and delete records using PHP and MySQL.'),
('Secure Your PHP App', 'Always hash passwords and use prepared statements to avoid SQL injection.'),
('PHP + MySQL Tips', 'Use PDO with exception handling and proper session management for security.');


