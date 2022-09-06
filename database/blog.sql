CREATE TABLE IF NOT EXISTS posts (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, post_title VARCHAR(255), post_desc TEXT, 
    post_img VARCHAR(255), post_cat VARCHAR(255), post_date VARCHAR(255), 
    user_id INT);

CREATE TABLE IF NOT EXISTS users (id INT PRIMARY KEY AUTO_INCREMENT, user_name VARCHAR(20), user_pass VARCHAR(255), user_avatar VARCHAR(255));