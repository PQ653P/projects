CREATE TABLE products(
    id INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(250) NOT NULL, 
    stock INT NOT NULL,
    price INT NOT NULL,

    CONSTRAINT PK_products PRIMARY KEY(id),
);

CREATE TABLE delivery(
    id INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(250) NOT NULL, 
    price INT NOT NULL,

    CONSTRAINT PK_products PRIMARY KEY(id),
);

CREATE TABLE felhasznalok(
id INT NOT NULL AUTO_INCREMENT,
name varchar(20) NOT NULL,
password varchar(20) NOT NULL,
permission int(1) UNSIGNED NOT NULL DEFAULT '0',

CONSTRAINT PK_user PRIMARY KEY(id)
);

CREATE TABLE soldoutproducts(
    id INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(250) NOT NULL, 
    stock INT NOT NULL DEFAULT 0,

    CONSTRAINT PK_products PRIMARY KEY(id),
);

CREATE TABLE specialofferproduct(
    id INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(250) NOT NULL, 
    stock INT NOT NULL,
    offer INT NOT NULL,

    CONSTRAINT PK_products PRIMARY KEY(id),
);

CREATE TABLE television(
    id INT NOT NULL AUTO_INCREMENT, 
    name VARCHAR(250) NOT NULL, 
    stock INT NOT NULL,
    price INT NOT NULL,

    CONSTRAINT PK_products PRIMARY KEY(id),
);