CREATE DATABASE bidfrenzy;

USE bidfrenzy;

CREATE TABLE Users (
  user_id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  role VARCHAR(20) NOT NULL DEFAULT 'user',
  image_path VARCHAR(255),
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  PRIMARY KEY (user_id)
);

INSERT INTO Users (username, email, password, first_name, last_name, role, created_at, updated_at)
VALUES ('admin', 'admin@example.com', 'admin', 'Rapee', 'Khung', 'admin', NOW(), NOW());

CREATE TABLE Auction (
  auction_id INT NOT NULL AUTO_INCREMENT,
  user_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  description VARCHAR(1000) NOT NULL,
  starting_bid INT(10) NOT NULL,
  current_bid INT(10) DEFAULT 0,
  image_url VARCHAR(255) NOT NULL,
  end_time DATETIME NOT NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  PRIMARY KEY (auction_id),
  FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

CREATE TABLE Bid (
  bid_id INT NOT NULL AUTO_INCREMENT,
  auction_id INT NOT NULL,
  user_id INT NOT NULL,
  bid_amount INT(10) NOT NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  PRIMARY KEY (bid_id),
  FOREIGN KEY (auction_id) REFERENCES Auction(auction_id),
  FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

CREATE TABLE Payment (
  payment_id INT NOT NULL AUTO_INCREMENT,
  auction_id INT NOT NULL,
  user_id INT NOT NULL,
  amount DECIMAL(10, 2) NOT NULL,
  status VARCHAR(20) NOT NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  PRIMARY KEY (payment_id),
  FOREIGN KEY (auction_id) REFERENCES Auction(auction_id),
  FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

CREATE TABLE Feedback (
  feedback_id INT NOT NULL AUTO_INCREMENT,
  auction_id INT NOT NULL,
  user_id INT NOT NULL,
  rating INT NOT NULL,
  comment VARCHAR(1000) NOT NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  PRIMARY KEY (feedback_id),
  FOREIGN KEY (auction_id) REFERENCES Auction(auction_id),
  FOREIGN KEY (user_id) REFERENCES Users(user_id)
);
