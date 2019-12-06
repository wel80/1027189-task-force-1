CREATE DATABASE yii_taskforce
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;
USE yii_taskforce;

CREATE TABLE city (
    id INT AUTO_INCREMENT PRIMARY KEY,
    city CHAR(100) NOT NULL,
    latitude FLOAT NOT NULL,
    longitude FLOAT NOT NULL
);

CREATE TABLE category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name CHAR(50) NOT NULL UNIQUE,
    icon CHAR(100) NOT NULL UNIQUE
);

CREATE TABLE specialization (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name CHAR(100) NOT NULL UNIQUE,
    icon CHAR(100) NOT NULL UNIQUE
);

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email CHAR(100) NOT NULL UNIQUE,
    name CHAR(100) NOT NULL,
    password CHAR(64) NOT NULL,
    date_registration CHAR(15) NOT NULL,
    city_id INT NOT NULL,
    FOREIGN KEY (city_id)  REFERENCES city (id)
);

CREATE TABLE user_specialization (
    user_id INT NOT NULL,
    specialization_id INT NOT NULL,
    FOREIGN KEY (user_id)  REFERENCES user (id),
    FOREIGN KEY (specialization_id)  REFERENCES specialization (id)
);

CREATE TABLE profile (
    user_id INT NOT NULL UNIQUE,
    avatar CHAR(100),
    address CHAR(100),
    birthday CHAR(15),
    about TEXT,
    phone CHAR(30),
    skype CHAR(100),
    messenger CHAR(100),
    contacts_status TINYINT NOT NULL DEFAULT 0, -- Кому показывать контакты пользователя (Всем - 0, Только заказчику - 1)
    notification_new_message TINYINT NOT NULL DEFAULT 1, -- Уведомлять - 1, Не уведомлять - 0
    notification_new_event_task TINYINT NOT NULL DEFAULT 1, -- Уведомлять - 1, Не уведомлять - 0
    notification_new_review TINYINT NOT NULL DEFAULT 1, -- Уведомлять - 1, Не уведомлять - 0
    FOREIGN KEY (user_id)  REFERENCES user (id)
);

CREATE TABLE task (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created_at CHAR(15) NOT NULL,
    updated_at CHAR(15),
    category_id INT NOT NULL,
    description TEXT NOT NULL,
    expire CHAR(15),
    name CHAR(100) NOT NULL, -- Краткое описание задания
    address CHAR(100),
    budget INT,
    latitude FLOAT NOT NULL,
    longitude FLOAT NOT NULL,
    author_id INT NOT NULL,
    executor_id INT,
    FOREIGN KEY (author_id)  REFERENCES user (id),
    FOREIGN KEY (executor_id)  REFERENCES user (id),
    FOREIGN KEY (category_id)  REFERENCES category (id)
);

CREATE TABLE file (
    id INT AUTO_INCREMENT PRIMARY KEY,
    path CHAR(100) NOT NULL,
    task_id INT NOT NULL,
    FOREIGN KEY (task_id)  REFERENCES task (id)
);

CREATE TABLE opinion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created_at CHAR(15) NOT NULL,
    rate INT,
    description TEXT,
    author_id INT NOT NULL,
    task_id INT NOT NULL,
    FOREIGN KEY (author_id)  REFERENCES user (id),
    FOREIGN KEY (task_id)  REFERENCES task (id)
);

CREATE TABLE reply (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created_at CHAR(15) NOT NULL,
    rate INT,
    description TEXT,
    author_id INT NOT NULL,
    task_id INT NOT NULL,
    FOREIGN KEY (author_id)  REFERENCES user (id),
    FOREIGN KEY (task_id)  REFERENCES task (id)
);
