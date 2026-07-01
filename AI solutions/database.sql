-- AI-Solutions Database Schema
-- Run this script to initialize the database and seed initial tables.

CREATE DATABASE IF NOT EXISTS `ai_solutions` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `ai_solutions`;

-- 1. Table: Inquiries
CREATE TABLE IF NOT EXISTS `inquiries` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `company` VARCHAR(100) NOT NULL,
  `country` VARCHAR(50) NOT NULL,
  `job_title` VARCHAR(100) NOT NULL,
  `job_details` TEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Table: Events
CREATE TABLE IF NOT EXISTS `events` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(150) NOT NULL,
  `description` TEXT NOT NULL,
  `event_date` DATE NOT NULL,
  `location` VARCHAR(100) NOT NULL,
  `image_path` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Table: Gallery
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(150) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `image_path` VARCHAR(255) NOT NULL,
  `category` VARCHAR(50) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Table: Feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `client_name` VARCHAR(100) NOT NULL,
  `company` VARCHAR(100) NOT NULL,
  `rating` INT NOT NULL DEFAULT 5,
  `comment` TEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Seed Data: Events
INSERT INTO `events` (`title`, `description`, `event_date`, `location`, `image_path`, `created_at`) VALUES
('Sunderland Tech Innovators Expo 2026', 'AI-Solutions will showcase our latest digital employee experience (DEX) prototyping tools and run live interactive demonstrations.', '2026-07-15', 'Sunderland Software Centre, Sunderland', 'assets/images/event1.jpg', CURRENT_TIMESTAMP),
('AI-Powered Workspace Workshop', 'Join our engineering team for a hands-on session on integrating virtual AI assistants into standard business communication streams.', '2026-08-04', 'St. Peter\'s Campus, University of Sunderland', 'assets/images/event2.jpg', CURRENT_TIMESTAMP),
('DEX Summit 2026', 'A global gathering of digital workplace leaders discussing proactive IT monitoring, AI-based software solution designs, and employee engagement.', '2026-09-20', 'Virtual Conference (UK Main Office)', 'assets/images/event3.jpg', CURRENT_TIMESTAMP);

-- Seed Data: Gallery
INSERT INTO `gallery` (`title`, `description`, `image_path`, `category`, `created_at`) VALUES
('Sunderland Office Launch', 'Ribbon-cutting ceremony at our new headquarters in Sunderland.', 'assets/images/gallery1.jpg', 'Launch', CURRENT_TIMESTAMP),
('Designing the AI Chatbot Engine', 'Our team whiteboard session mapping out user inquiries response trees.', 'assets/images/gallery2.jpg', 'Workshop', CURRENT_TIMESTAMP),
('Sunderland Software Showcases', 'Presenting our employee experience software prototype to industrial partners.', 'assets/images/gallery3.jpg', 'Expo', CURRENT_TIMESTAMP),
('Hackathon for Proactive IT Solutions', '24-hour sprint designing proactive diagnostics widgets for business networks.', 'assets/images/gallery4.jpg', 'Workshop', CURRENT_TIMESTAMP),
('Community AI Presentation', 'Inviting local students in Sunderland to learn about software development careers in AI.', 'assets/images/gallery5.jpg', 'Expo', CURRENT_TIMESTAMP);

-- Seed Data: Feedback
INSERT INTO `feedback` (`client_name`, `company`, `rating`, `comment`, `created_at`) VALUES
('Liam Sterling', 'Sunderland Tech Hub', 5, 'AI-Solutions completely changed how our IT support operates. Their proactive monitoring widgets identify system slowdowns before employees notice, reducing our ticket count by 40%!', CURRENT_TIMESTAMP),
('Jane Bennett', 'Innovate UK Ltd', 5, 'The virtual assistant prototyping they created was incredibly affordable and fast. In just two weeks, we had a functional demo to present to our investors.', CURRENT_TIMESTAMP),
('Dr. Marcus Thorne', 'Northern Engineering Group', 4, 'Excellent software solutions tailored specifically to our industrial engineering workflows. The employee experience has improved drastically since we implemented their dashboards.', CURRENT_TIMESTAMP);
