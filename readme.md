in the name of Allah


# Routed structure
public/
 |_ bismi_allah.php             incha2Allah requests will be routed to this file
 |res/
 ||_ bismi_allah.css             incha2Allah will have the style of the page
 ||_ bismi_allah_logo.png/.jpeg  incha2Allah will have logo of site
src/
 |_ bismi_allah.php             incha2Allah will have needed scripts (if any)

# Database Structure

## USERS
    bismi_allah_browser 'bismi_allah'
        PRIVILAGES SELECT on bismi_allah_users, bismi_allah_blogs;
    bismi_allah_user 'bismi_allah'
        PRIVILAGES SELECT, UPDATE, INSERT on bismi_allah_users, bismi_allah_blogs;

## DATABASES and TABLES
    CREATE DATABASE bismi_allah_blog;
    CREATE TABLE bismi_allah_users(user_id INT PRIMARY KEY AUTO_INCREMENT,
                                    user_name VARCHAR(16) UNIQUE,
                                    user_password_salt VARCHAR(12) NOT NULL,
                                    user_password_hash VARCHAR(226) NOT NULL);
    CRAETE TABLE bismi_allah_blogs(blog_id INT PRIMARY KEY AUTO_INCREMENT,
                                    blog_title VARCHAR(256),
                                    blog_text TEXT,
                                    user_id INT,
                                    blog_next_id INT,
                                    blog_previous_id INT,
                                    creation_date DATETIME DEFAULT NOW(),
                                    FOREIGN_KEY(user_id) REFERENCES bismi_allah_users(user_id));

