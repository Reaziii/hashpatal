CREATE TABLE IF NOT EXISTS admins (
    id int(10) NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    profilePicture VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);

INSERT INTO
    admins (email, profilePicture, name, password)
SELECT
    'admin@hp.com',
    '/uploads/default.jpeg',
    'Hashpatal Admin',
    '6a204bd89f3c8348afd5c77c717a097a'
WHERE
    NOT EXISTS(
        SELECT
            1
        FROM
            admins
        WHERE
            email = 'admin@hp.com'
    );

CREATE TABLE IF NOT EXISTS specialities (
    id int(10) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY(id, name)
);

CREATE TABLE IF NOT EXISTS doctors(
    id int(10) NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    profilePicture VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    specialization int(10) NOT NULL,
    FOREIGN KEY(specialization) REFERENCES specialities(id),
    education VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    gender VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS assistants(
    id int(10) NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    profilePicture VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    docid int(10) NOT NULL,
    FOREIGN KEY(docid) REFERENCES doctors(id),
    education VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    gender VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS users(
    id int(10) NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    profilePicture VARCHAR(255) DEFAULT "/uploads/user.svg",
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    gender VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    dob DATE NOT NULL,
    active BOOLEAN DEFAULT 0,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS appointments(
    id int(10) NOT NULL AUTO_INCREMENT,
    docid int(10) NOT NULL,
    FOREIGN KEY(docid) REFERENCES doctors(id),
    date DATE,
    userid int(10) NOT NULL,
    FOREIGN KEY(userid) REFERENCES users(id),
    title VARCHAR(255) NOT NULL,
    status VARCHAR(10) DEFAULT "pending",
    checked int(10) DEFAULT 0,
    time VARCHAR(10) DEFAULT "00:00",
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS verifyCode(
    id int(10) NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    userid int(10) NOT NULL,
    FOREIGN KEY(userid) REFERENCES users(id),
    code VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);