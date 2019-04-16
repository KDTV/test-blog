CREATE DATABASE IF NOT EXISTS `blog`;
USE blog;
DROP TABLE IF EXISTS post;
CREATE TABLE IF NOT EXISTS `post`
(
`id` INT(10) PRIMARY KEY AUTO_INCREMENT,
`title` VARCHAR(255) NOT NULL,
`author` VARCHAR(255) NOT NULL,
`content` TEXT NOT NULL,
`tags` VARCHAR(255),
`created_at` TIMESTAMP NOT NULL
);