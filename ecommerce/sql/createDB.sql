CREATE TABLE IF NOT EXISTS users (
    user_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_firstname VARCHAR(25) NOT NULL,
    user_lastname VARCHAR(40) NOT NULL,
    user_login VARCHAR(64) NOT NULL,
    user_password VARCHAR(64) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) 

CREATE TABLE IF NOT EXISTS products (
    product_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(50) NOT NULL,
    product_txt VARCHAR(512) NOT NULL,
    product_img VARCHAR(64) NOT NULL,
    product_price FLOAT NOT NULL
    ) 

CREATE TABLE IF NOT EXISTS cart (
    cart_id VARCHAR(16) NOT NULL,
    user_id INT UNSIGNED ,
    product_id INT UNSIGNED NOT NULL,
    date_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(product_id)
    ) 


/* To execute the following commands
    root@lggram:~# mysql -u root --database projet_ecommerce
*/
CREATE USER 'phpmyadmin'@'localhost' IDENTIFIED BY 'FR@3m:We8!';
GRANT ALL PRIVILEGES ON users TO 'phpmyadmin'@'localhost';
GRANT ALL PRIVILEGES ON products TO 'phpmyadmin'@'localhost';
GRANT ALL PRIVILEGES ON cart TO 'phpmyadmin'@'localhost';
FLUSH PRIVILEGES;

CREATE USER 'phpusr'@'localhost' IDENTIFIED BY 'FR@4m:We9!';
GRANT SELECT, INSERT, UPDATE, DELETE, ALTER ON  projet_ecommerce.* TO 'phpusr'@'localhost';
FLUSH PRIVILEGES;

INSERT INTO products (product_name, product_txt, product_img, product_price) VALUES('PRODUIT_A','Description du produit A','img/TonyPi.jpg',9);
INSERT INTO products (product_name, product_txt, product_img, product_price) VALUES('PRODUIT_B','Description du produit B','img/ROSmaster.jpeg',19);
INSERT INTO products (product_name, product_txt, product_img, product_price) VALUES('PRODUIT_C','Description du produit C','img/rcar.jpg',79);
INSERT INTO products (product_name, product_txt, product_img, product_price) VALUES('PRODUIT_D','Description du produit D','img/osoyoo.jpg',5);
INSERT INTO products (product_name, product_txt, product_img, product_price) VALUES('PRODUIT_E','Description du produit E','img/R2.jpg',45);
INSERT INTO products (product_name, product_txt, product_img, product_price) VALUES('PRODUIT_F','Description du produit F','img/hw2L.jpg',29);
INSERT INTO products (product_name, product_txt, product_img, product_price) VALUES('PRODUIT_G','Description du produit G','img/dog.jpg',10);