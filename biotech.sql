CREATE DATABASE IF NOT EXISTS biotech;
USE biotech;

-- YOU MUST USE THIS TABLE AS IS (or at least the 3 defined fields name, email, and password)
-- parent_resource
CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(200) NOT NULL,
    password VARCHAR(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE usersw (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(200) NOT NULL,
    password VARCHAR(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `categories` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `c_name` VARCHAR(100) NOT NULL,
  `image` VARCHAR(200) NOT NULL,
   UNIQUE (`c_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `categories` (`c_name`,`image`) VALUES 
	('Reagants','reagents.png'), 
    ('Growth Mediums','growth.png'),
	('Lab Equipment','equipment.png'), 
	('Plasmids','plasmid.png'), 
	('Enzymes','enzyme.png'), 
    ('Cell Lines','cell.png'), 
    ('Human Resources','human.png');

CREATE TABLE `products` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `p_name` VARCHAR(100) NOT NULL,
    `price` DEC(7,2) NOT NULL,
    `category_id` INT NOT NULL,
    UNIQUE (`p_name`, `category_id`),
    FOREIGN KEY (`category_id`) REFERENCES `categories` (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `products` (`p_name`,`price`,`category_id`) VALUES 
	('0.25% Trypsin 0.02% EDTA','16.04','1'), 
    ('Agarose','24.90','1'),
    ('40g of LB Agar','12.71','2'), 
    ('L-Arabinose','28.20','2'), -- food source
    ('Murashige and Skoog media','28.20','2'), -- plant cell culture
    ('Gamborgs’S B5 medium','28.20','2'), -- plant cell culture
    ('Kinetin','28.20','2'), -- plant hormone,cell division
    ('Myo-inositol','28.20','2'), -- growth factor (plant/eukaryote)
    ('NAA (Naptheleneacetic acid)','28.20','2'), -- plant growth regulator
    ('6-BAP(6-Benzylaminopurine)','28.20','2'),
    ('2,4 D(2,4 diphenoxy acetic acid)','38.20','2'), -- plant callus
    ('G418 Sulfate','38.20','2'),  -- antibiotic / marker / cell culture
    ('Streptomycin Sulfate','38.20','2'), -- antibiotic / cell culture
    ('Gel Electrophoresis','114.60','3'), 
    ('Polymerase Chain Reaction machine','353.00','3'), 
    ('Pipette Set','72.27','3'), 
    ('Centrifuge','161.80','3'), 
    ('Colorimeter','117.38','3'),
    ('Glass Petri plates * 20','60.60','3'), 
	('Bioluminescent plasmid pJE202','15.70','4'), 
    ('Human Myostatin Knock-Out','14.80','4'),
    ('E. coli DH5a','8.88','4'), -- cell that makes plasmids
	('Taq Polymerase','9.63','5'), -- used in PCR
    ('HEK 293 Human Embryonic Kidney','127.10','6'),
    ('Laboratory Technician', '23.23','7'),
    ('Cytotechnologists ', '46.46','7'),
    ('Post-doc geneticist', '47.47','7');

CREATE TABLE `resources` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `r_name` VARCHAR(100) NOT NULL,
    `price` DEC(7,2) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- https://financesonline.com/how-to-do-payment-gateway-integration-in-php-java-and-c/
CREATE TABLE `orders` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `_user_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
 `user_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `card_num` bigint(20) NOT NULL,
 `card_cvc` int(5) NOT NULL,
 `card_exp` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
 `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `item_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
 `item_price` float(10,2) NOT NULL,
 `item_price_currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'usd',
 `paid_amount` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
 `paid_amount_currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
 `txn_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
 `payment_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
 `created` datetime NOT NULL,
 `modified` datetime NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- SELECT * FROM resources;
-- -- Total
-- -- SELECT SUM(price) FROM resources;

-- -- -- SELECT * FROM usersw;
-- DROP DATABASE biotech;
-- DROP TABLE orders;