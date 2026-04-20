
ALTER DATABASE bdd_serv CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE _compte_admin (

    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    mail VARCHAR(80) NOT NULL,
    mdp VARCHAR(80) NOT NULL
);

CREATE TABLE _reduction (

    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    taux_reduction FLOAT NOT NULL
);

CREATE TABLE _categorie (

    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_categorie_sup INTEGER DEFAULT NULL,
    nom_categorie VARCHAR(50) NOT NULL

    CONSTRAINT id_cat_fk_id_cat_sup FOREIGN KEY (id_categorie_sup) REFERENCES _categorie(id)
);

CREATE TABLE _produit (

    id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    reference INTEGER NOT NULL,
    nom VARCHAR(50) NOT NULL,
    prix FLOAT NOT NULL,
    quantite INTEGER DEFAULT 0,
    url_img VARCHAR(80) DEFAULT "url_pas_image.jpg",
    est_local BOOLEAN DEFAULT 0,
    id_reduc INTEGER DEFAULT NULL,
    id_categorie INTEGER DEFAULT NULL,

    CONSTRAINT id_reduc_fk_reduc FOREIGN KEY (id_reduc) REFERENCES _reduction(id),
    CONSTRAINT id_categorie_fk_categorie FOREIGN KEY (id_categorie) REFERENCES _categorie(id)
);

CREATE OR REPLACE VIEW all_produits AS
SELECT
    p.id,
    p.reference,
    p.nom,
    p.prix,
    p.quantite,
    p.url_img,
    p.est_local,
    p.id_reduc,
    p.id_categorie,
    r.date_debut,
    r.date_fin,
    r.taux_reduction,
    c.id_categorie_sup,
    c.nom_categorie
FROM _produit p
LEFT JOIN _categorie c ON p.id_categorie = c.id
LEFT JOIN _reduction r ON p.id_reduc = r.id;