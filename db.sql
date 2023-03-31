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
    PRIMARY KEY(id)
);

-- CREATE TABLE doctors(
--     id int(10) NOT NULL AUTO_INCREMENT,
--     email VARCHAR(255) NOT NULL,
--     password VARCHAR(255) NOT NULL,
--     profilePicture VARCHAR(255) NOT NULL,
--     name VARCHAR(255) NOT NULL,
-- )