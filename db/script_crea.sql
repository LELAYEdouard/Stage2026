
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
    nom_categorie VARCHAR(50) NOT NULL,

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
    ROUND(r.taux_reduction*100) AS taux_reduction,
    ROUND(p.prix * (1 - r.taux_reduction),2) AS prix_reduit,
    c.id_categorie_sup,
    c.nom_categorie
FROM _produit p
LEFT JOIN _categorie c ON p.id_categorie = c.id
LEFT JOIN _reduction r ON p.id_reduc = r.id;


INSERT INTO _categorie (nom_categorie, id_categorie_sup) VALUES
('BOISSONS', NULL),
('PRODUITS LAITIERS & FROMAGES', NULL),
('EPICERIE SALEE', NULL),
('EPICERIE SUCREE', NULL),
('FRAIS', NULL),
('ANIMAUX', NULL),
('HYGIENE / ENTRETIEN', NULL),
('MAISON / CUISINE / OUTILLAGE', NULL),
('FRUITS ET LEGUMES', NULL);

SET @boissons_id = (SELECT id FROM _categorie WHERE nom_categorie = 'BOISSONS');

INSERT INTO _categorie (nom_categorie, id_categorie_sup) VALUES
('ALCOOL', @boissons_id),
('SANS ALCOOL', @boissons_id);

SET @alcool_id = (SELECT id FROM _categorie WHERE nom_categorie = 'ALCOOL');

INSERT INTO _categorie (nom_categorie, id_categorie_sup) VALUES
('VINS', @alcool_id),
('BIERES', @alcool_id),
('SPIRITUEUX', @alcool_id),
('APERITIFS & LIQUEURS', @alcool_id);

SET @sans_alcool_id = (SELECT id FROM _categorie WHERE nom_categorie = 'SANS ALCOOL');

INSERT INTO _categorie (nom_categorie, id_categorie_sup) VALUES
('SODAS', @sans_alcool_id),
('JUS DE FRUITS', @sans_alcool_id),
('EAUX', @sans_alcool_id),
('THES & BOISSONS ENERGISANTES', @sans_alcool_id);

SET @lait_id = (SELECT id FROM _categorie WHERE nom_categorie = 'PRODUITS LAITIERS & FROMAGES');

INSERT INTO _categorie (nom_categorie, id_categorie_sup) VALUES
('LAIT', @lait_id),
('CREME', @lait_id),
('BEURRE', @lait_id),
('FROMAGES', @lait_id),
('YAOURTS & DESSERTS', @lait_id);   

SET @sale_id = (SELECT id FROM _categorie WHERE nom_categorie = 'EPICERIE SALEE');

INSERT INTO _categorie (nom_categorie, id_categorie_sup) VALUES
('CHARCUTERIE', @sale_id),
('CONSERVES & PLATS PREPARES', @sale_id),
('PATES / RIZ / FECULENTS', @sale_id),
('SAUCES & CONDIMENTS', @sale_id),
('APERITIF SALE', @sale_id);

SET @sucre_id = (SELECT id FROM _categorie WHERE nom_categorie = 'EPICERIE SUCREE');

INSERT INTO _categorie (nom_categorie, id_categorie_sup) VALUES
('CHOCOLATS & CONFISERIES', @sucre_id),
('BISCUITS & GATEAUX', @sucre_id),
('PETIT DEJEUNER', @sucre_id),
('AIDES PATISSERIE', @sucre_id);

SET @frais_id = (SELECT id FROM _categorie WHERE nom_categorie = 'FRAIS');

INSERT INTO _categorie (nom_categorie, id_categorie_sup) VALUES
('TRAITEUR', @frais_id),
('VIANDES FRAICHES', @frais_id),
('POISSONS FRAIS', @frais_id);

SET @animaux_id = (SELECT id FROM _categorie WHERE nom_categorie = 'ANIMAUX');

INSERT INTO _categorie (nom_categorie, id_categorie_sup) VALUES
('CHIEN', @animaux_id),
('CHAT', @animaux_id);

SET @hygiene_id = (SELECT id FROM _categorie WHERE nom_categorie = 'HYGIENE / ENTRETIEN');

INSERT INTO _categorie (nom_categorie, id_categorie_sup) VALUES
('HYGIENE CORPORELLE', @hygiene_id),
('ENTRETIEN MAISON', @hygiene_id),
('PAPIER & MENAGER', @hygiene_id),
('VAISSELLE', @hygiene_id);

SET @maison_id = (SELECT id FROM _categorie WHERE nom_categorie = 'MAISON / CUISINE / OUTILLAGE');

INSERT INTO _categorie (nom_categorie, id_categorie_sup) VALUES
('USTENSILES CUISINE', @maison_id),
('OUTILLAGE', @maison_id),
('CONSOMMABLES MAISON', @maison_id);

SET @fruits_id = (SELECT id FROM _categorie WHERE nom_categorie = 'FRUITS ET LEGUMES');

INSERT INTO _categorie (nom_categorie, id_categorie_sup) VALUES
('LEGUMES', @fruits_id),
('LEGUMINEUSES', @fruits_id),
('FRUITS SECS', @fruits_id);