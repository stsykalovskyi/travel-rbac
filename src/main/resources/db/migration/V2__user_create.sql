CREATE SCHEMA IF NOT EXISTS rbac;
ALTER DATABASE rbac SET search_path=rbac;
DROP TABLE IF EXISTS "user";
CREATE TABLE "user" (
    id SERIAL,
    username VARCHAR (32) NOT NULL,
    password varchar (32) NOT NULL,
    active bool DEFAULT TRUE,
    roles varchar (255) NOT NULL,
    firstname varchar(255),
    lastname varchar(255),
    PRIMARY KEY (id)
);
INSERT INTO "user"(username, password, roles) values ('admin', 'admin', 'ROLE_ADMIN');
INSERT INTO "user"(username, password, roles) values ('user', 'user', 'ROLE_USER');