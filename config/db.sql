DROP TABLE IF EXISTS fisa_consultatie;
DROP TABLE IF EXISTS programare_consultatie;
DROP TABLE IF EXISTS intervale_de_consultatie;
DROP TABLE IF EXISTS pacient;
DROP TABLE IF EXISTS laborant;
DROP TABLE IF EXISTS medic;
DROP TABLE IF EXISTS admin;
DROP TABLE IF EXISTS utilizator;

CREATE TABLE utilizator (
    id_utilizator int NOT NULL AUTO_INCREMENT,
    email varchar(255) NOT NULL unique,
    parola varchar(255) NOT NULL,
    nume varchar(255) NOT NULL,
    prenume varchar(255) NOT NULL,
    cod_activare varchar(255) NOT NULL,
    este_activ boolean default true,
    PRIMARY KEY (id_utilizator)
);

CREATE TABLE admin
(
    id_utilizator int NOT NULL,

    PRIMARY KEY (id_utilizator),
    FOREIGN KEY (id_utilizator) references utilizator(id_utilizator)
);

CREATE TABLE medic
(
    id_utilizator int NOT NULL,
    specializare varchar(255) NOT NULL,
    PRIMARY KEY (id_utilizator),
    FOREIGN KEY (id_utilizator) references utilizator(id_utilizator)
);

CREATE TABLE laborant
(
    id_utilizator int NOT NULL,
    specializare varchar(255) NOT NULL,
    PRIMARY KEY (id_utilizator),
    FOREIGN KEY (id_utilizator) references utilizator(id_utilizator)
);

CREATE TABLE pacient
(
    id_utilizator int NOT NULL,
    cnp varchar(255) NOT NULL,
    primary key (id_utilizator),
    FOREIGN KEY (id_utilizator) references utilizator(id_utilizator)
);

CREATE TABLE intervale_de_consultatie
(
    id_interval  int NOT NULL AUTO_INCREMENT,
    interval_orar varchar(255) NOT NULL,
    primary key (id_interval)
);

CREATE TABLE programare_consultatie
(
    id_programare int NOT NULL AUTO_INCREMENT,
    id_interval int NOT NULL,
    id_medic int NOT NULL,
    id_pacient int NOT NULL,
    data_programare DATE NOT NULL,
    primary key (id_programare),
    unique(id_interval, id_medic, id_pacient, data_programare),
    foreign key(id_interval) references intervale_de_consultatie(id_interval),
    foreign key(id_medic) references medic(id_utilizator),
    foreign key(id_pacient) references pacient(id_utilizator)
);

CREATE TABLE fisa_consultatie
(
    id_fisa int NOT NULL AUTO_INCREMENT,
    id_programare int NOT NULL,
    diagnostic varchar(255) NOT NULL,
    analize_recomandate varchar(255),
    tratament_medicamentos_recomandat varchar(255),
    investigatii_recomandate varchar(255),
    alergii varchar(255),
    boli_cronice varchar(255),
    primary key(id_fisa),
    foreign key(id_programare) references programare_consultatie(id_programare)
);

INSERT INTO utilizator(email, parola, nume, prenume, cod_activare , este_activ)
VALUES ('alex.pavel2002@gmail.com', '$2y$10$ydQG16CeQE5aX4.l3kexW.N8LZj3/ZEIg/6da5s6H4vPCr0QDSqrW', 'Pavel', 'Alexandru', '12345678', 1);

INSERT INTO admin(id_utilizator) VALUES ((SELECT id_utilizator FROM utilizator WHERE email = 'alex.pavel2002@gmail.com'));

INSERT INTO intervale_de_consultatie(interval_orar)
VALUES('9-9:30');

INSERT INTO intervale_de_consultatie(interval_orar)
VALUES('9:30-10');

INSERT INTO intervale_de_consultatie(interval_orar)
VALUES('10-10:30');

INSERT INTO intervale_de_consultatie(interval_orar)
VALUES('10:30-11');

INSERT INTO intervale_de_consultatie(interval_orar)
VALUES('11-11:30');

INSERT INTO intervale_de_consultatie(interval_orar)
VALUES('11:30-12');
