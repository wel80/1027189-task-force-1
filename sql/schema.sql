CREATE DATABASE task_forse_wel80
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;
USE task_forse_wel80;

CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY, -- Первичный ключ
    date_registration DATETIME DEFAULT NOW(), -- Дата и время регистрации пользователя
    e_mail CHAR(100) NOT NULL UNIQUE, -- Адрес электронной почты пользователя
    name_user CHAR(100) NOT NULL, -- Имя пользователя
    city_user_id INT NOT NULL, -- Первичный ключ названия города пользователя
    hash_user CHAR(64) NOT NULL, -- Хэш пароля пользователя
    birthday_user DATETIME, -- Дата рождения пользователя
    description_user TEXT, -- Дополнительная информация о пользователе
    avatar CHAR(100), -- Ссылка на аватар пользователя
    contacts_status TINYINT DEFAULT 0, -- Кому показывать контакты пользователя (Всем - 0, Только заказчику - 1)
    view_count INT, -- Счетчик просмотров аккаунта
    task_count INT, -- Счетчик полученных заданий
    fail_count INT -- Счетчик невыполненных заданий
);

CREATE TABLE tasks (
    id_task INT AUTO_INCREMENT PRIMARY KEY, -- Первичный ключ
    date_create DATETIME DEFAULT NOW(), -- Дата и время формирования задачи
    name_task CHAR(100) NOT NULL, -- Краткое описание задания
    description_task TEXT NOT NULL, -- Подробное описание задания
    cat_id INT NOT NULL, -- Первичный ключ категории задания
    location_task CHAR(15), -- Место проведения работ
    city_task_id INT, -- Первичный ключ названия города, где требуется услуга
    budget DECIMAL, -- Планируемые затраты
    term_execution DATETIME, -- Срок исполнения
    author_task_id INT NOT NULL, -- Первичный ключ пользователя - заказчика устлуги
    status_task CHAR(15) NOT NULL, -- Текущий статус задания
    executor_id INT -- Первичный ключ пользователя - исполнителя
);

CREATE TABLE cities (
    id_city INT AUTO_INCREMENT PRIMARY KEY, -- Первичный ключ
    name_city CHAR(100) NOT NULL UNIQUE -- Название города
);

CREATE TABLE categories (
    id_cat INT AUTO_INCREMENT PRIMARY KEY, -- Первичный ключ
    name_cat CHAR(15) NOT NULL UNIQUE, -- Наименование категории задания
    alias_cat CHAR(15) NOT NULL UNIQUE -- Алиас категории задания
);

CREATE TABLE communications (
    id_com INT AUTO_INCREMENT PRIMARY KEY, -- Первичный ключ
    name_com CHAR(100) NOT NULL UNIQUE, -- Название способа коммуникации
    alias_com CHAR(15) NOT NULL UNIQUE -- Алиас способа коммуникации
);

CREATE TABLE users_communications (
    id_user_com INT AUTO_INCREMENT PRIMARY KEY, -- Первичный ключ
    name_user_com CHAR(100) NOT NULL, -- Контактные данные
    user_com_id INT NOT NULL, -- Первичный ключ пользователя
    com_id INT NOT NULL -- Первичный ключ способа коммуникации
);

CREATE TABLE specializations (
    id_spec INT AUTO_INCREMENT PRIMARY KEY, -- Первичный ключ
    name_spec CHAR(15) NOT NULL UNIQUE, -- Наименование специализации
    alias_spec CHAR(15) NOT NULL UNIQUE -- Алиас специализации
);

CREATE TABLE users_specializations (
    user_spec_id INT NOT NULL, -- Первичный ключ пользователя
    spec_id INT NOT NULL -- Первичный ключ специализации
);

CREATE TABLE file_list (
    id_file INT AUTO_INCREMENT PRIMARY KEY, -- Первичный ключ
    url_file CHAR(100) NOT NULL, -- Адрес файла
    task_file_id INT NOT NULL -- Первичный ключ задания
);

CREATE TABLE reactions (
    id_react INT AUTO_INCREMENT PRIMARY KEY, -- Первичный ключ
    date_react DATETIME DEFAULT NOW(), -- Дата и время откклика
    message_react TEXT NOT NULL, -- Содержание отклика
    servise_cost DECIMAL NOT NULL, -- Стоимость услуги
    author_react_id INT NOT NULL, -- Первичный ключ пользователя - претендента на исполнения заказа
    task_react_id INT NOT NULL -- Первичный ключ задания
);

CREATE TABLE chatroom (
    id_chat INT AUTO_INCREMENT PRIMARY KEY, -- Первичный ключ
    date_chat DATETIME DEFAULT NOW(), -- Дата и время сообщения
    message_chat TEXT NOT NULL, -- Содержание сообщения
    autor_chat_id INT NOT NULL, -- Первичный ключ пользователя - автора сообщения
    recipient_chat_id INT NOT NULL -- Первичный ключ пользователя - получателя сообщения
);