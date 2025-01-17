CREATE TABLE IF NOT EXISTS users (
    user_id tinyint(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_firstname varchar(25) NOT NULL,
    user_lastname varchar(40) NOT NULL,
    user_login varchar(64) NOT NULL,
    user_password varchar(64) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) 

CREATE TABLE IF NOT EXISTS villes (
    ville_id int(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ville_name varchar(25) NOT NULL,
    ville_txt varchar(512) NOT NULL,
    ville_link varchar(128)
    ) 

CREATE TABLE IF NOT EXISTS search (
    search_id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id tinyint(4) NOT NULL,
    ville_id int(6) UNSIGNED NOT NULL,
    search_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) 

/* To execute the following commands
    root@lggram:~# mysql -u root --database project_villes
*/
CREATE USER 'phpmyadmin'@'localhost' IDENTIFIED BY 'FR@3m:We8!';
GRANT ALL PRIVILEGES ON users TO 'phpmyadmin'@'localhost';
GRANT ALL PRIVILEGES ON villes TO 'phpmyadmin'@'localhost';
FLUSH PRIVILEGES;

CREATE USER 'phpusr'@'localhost' IDENTIFIED BY 'FR@4m:We9!';
GRANT SELECT, INSERT, UPDATE, DELETE, ALTER ON  projet_villes.* TO 'phpusr'@'localhost';
FLUSH PRIVILEGES;

INSERT INTO villes (ville_name, ville_txt, ville_link) VALUES ('Paris', 'Paris, la capitale de la France, est une ville emblématique connue pour son histoire riche, sa culture vibrante et son architecture magnifique. Surnommée \"La Ville Lumière\", Paris est célèbre pour ses monuments emblématiques tels que la Tour Eiffel, la Cathédrale Notre-Dame, l''Arc de Triomphe et le Louvre, qui abrite la célèbre peinture de la Joconde.<br><br>La ville est également réputée pour ses cafés charmants, ses boulevards élégants et ses quartiers pittoresques comme Montmartre et le Marais.', 'img/arc-de-triomphe-5432392_640.jpg');
INSERT INTO villes (ville_name, ville_txt, ville_link) VALUES ('Madrid', 'Madrid, la capitale de l''Espagne, est une ville dynamique et culturelle. Connue pour ses magnifiques places comme la Plaza Mayor et la Puerta del Sol, Madrid offre une riche histoire et une architecture impressionnante. La ville abrite des musées de renommée mondiale tels que le Prado et le Reina Sofía. Madrid est également célèbre pour sa vie nocturne animée, ses délicieux tapas et ses parcs verdoyants comme le Retiro.', 'img/spain-2708993_640.jpg');
INSERT INTO villes (ville_name, ville_txt, ville_link) VALUES ('Rome', 'Rome, la capitale de l''Italie, est une ville historique et culturelle emblématique. Connue comme la \"Ville Éternelle\", elle abrite des monuments célèbres tels que le Colisée, le Panthéon et le Vatican. Rome est un mélange fascinant d''architecture antique et de vie moderne, avec des places animées, des fontaines magnifiques et une cuisine délicieuse. La ville est un centre mondial de l''art, de la culture et de la religion, attirant des millions de visiteurs chaque année.', 'img/spain-2708993_640.jpg');
INSERT INTO villes (ville_name, ville_txt, ville_link) VALUES ('Londre', 'Londres, la capitale du Royaume-Uni, est une métropole dynamique et cosmopolite. Connue pour ses monuments emblématiques tels que le Big Ben, le London Eye, la Tour de Londres et le Palais de Buckingham, Londres est un centre mondial de la finance, de la culture et de la mode. La ville offre une riche histoire, des musées de renommée mondiale, des théâtres célèbres et une scène musicale vibrante. Londres est un mélange fascinant de tradition et de modernité, attirant des millions de visiteurs chaque année.', 'img/tower-bridge-5727975_640.jpg');
INSERT INTO villes (ville_name, ville_txt, ville_link) VALUES ('Berlin', 'Berlin, la capitale de l''Allemagne, est une ville dynamique et cosmopolite, riche en histoire et en culture. Connue pour ses monuments emblématiques tels que la Porte de Brandebourg, le Mur de Berlin et le Reichstag, Berlin est également un centre artistique et technologique. La ville offre une scène musicale vibrante, des musées de renommée mondiale et une vie nocturne animée. Berlin est un mélange fascinant de tradition et de modernité, attirant des visiteurs du monde entier.', 'img/brand-front-of-the-brandenburg-gate-5117579_640.jpg');
INSERT INTO villes (ville_name, ville_txt, ville_link) VALUES ('Genève', 'Capitale de la Suisse, Genève est une ville magnifique située en Suisse, réputée pour son cadre pittoresque au bord du lac Léman, avec une vue imprenable sur les Alpes et le Jura. La ville offre une riche histoire culturelle, avec des musées, des théâtres et des galeries d''art. Le Jet d''Eau, une fontaine emblématique, est l''un des symboles les plus reconnaissables de Genève.', 'img/lake-5317478_640.jpg');


