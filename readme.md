in the name of Allah


# Folder Structure
bismi_allah.php                 incha2Allah will be the index of the website                                        | index for other websites
account/                        incha2Allah will conatin the user's actions to his own account
 |_ bismi_allah.php             incha2Allah will be the main page                                                   | has account info and form to write another blog
 |_ login.php                   incha2Allah will be the page to login                                               | logins to new account
 |_ register.php                incha2Allah will be the page to register and make an account                        | creates an account by the will of Allah
browse/                         incha2Allah will be the page to browse blogs of others
 |_ bismi_allah.php             incha2Allah will have it here                                                       | has a single post in the body
res/                            incha2Allah will have the resources needed
 |_ bismi_allah.css

# Database Structure

## USERS
    bismi_allah_browser 'bismi_allah'
        PRIVILAGES SELECT on bismi_allah_users, bismi_allah_blogs;
    bismi_allah_user 'bismi_allah'
        PRIVILAGES SELECT, UPDATE, INSERT on bismi_allah_users, bismi_allah_blogs;

## DATABASES
    CREATE DATABASE bismi_allah_blog;
    CREATE TABLE bismi_allah_users(user_id INT PRIMARY KEY AUTO_INCREMENT,
                                    user_name VARCHAR(16) UNIQUE,
                                    user_password_salt VARCHAR(12) NOT NULL,
                                    user_password_hash VARCHAR(226) NOT NULL);
    CRAETE TABLE bismi_allah_blogs(blog_id INT PRIMARY KEY AUTO_INCREMENT,
                                    blog_text TEXT,
                                    user_id INT,
                                    blog_next_id INT,
                                    blog_previous_id INT,
                                    creation_date DATETIME DEFAULT NOW(),
                                    FOREIGN_KEY(user_id) REFERENCES bismi_allah_users(user_id));

