CREATE DATABASE IF NOT EXISTS car_rental;
USE car_rental;

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_email VARCHAR(255) NOT NULL,
    rent_start_date DATE NOT NULL,
    rent_end_date DATE NOT NULL,
    car_id INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'confirmed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Add some indexes for faster searches
CREATE INDEX idx_user_email ON orders (user_email);
CREATE INDEX idx_car_id ON orders (car_id);
