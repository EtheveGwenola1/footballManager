DROP DATABASE IF EXISTS footballManager;
CREATE DATABASE IF NOT EXISTS footballManager;

USE footballManager;

#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: equipe
#------------------------------------------------------------

CREATE TABLE equipe(
        id_equipe     int (11) Auto_increment  NOT NULL ,
        nom_equipe    Varchar (25) ,
        points_equipe Int NOT NULL ,
        PRIMARY KEY (id_equipe )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: joueur
#------------------------------------------------------------

CREATE TABLE joueur(
        id_joueur        int (11) Auto_increment  NOT NULL ,
        nom_joueur       Varchar (25) ,
        titulaire_joueur Bool NOT NULL ,
        poste_joueur     Varchar (255) ,
        id_equipe        Int ,
        PRIMARY KEY (id_joueur )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: est_transfere
#------------------------------------------------------------

CREATE TABLE est_transfere(
        montant        Decimal (25) ,
        date_transfert Datetime ,
        id_joueur      Int NOT NULL ,
        id_equipe      Int NOT NULL ,
        PRIMARY KEY (id_joueur ,id_equipe )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: joue_contre
#------------------------------------------------------------

CREATE TABLE joue_contre(
        score       Int ,
        date_match  Datetime ,
        id_equipe   Int NOT NULL ,
        id_equipe_1 Int NOT NULL ,
        PRIMARY KEY (id_equipe ,id_equipe_1 )
)ENGINE=InnoDB;

ALTER TABLE joueur ADD CONSTRAINT FK_joueur_id_equipe FOREIGN KEY (id_equipe) REFERENCES equipe(id_equipe);
ALTER TABLE est_transfere ADD CONSTRAINT FK_est_transfere_id_joueur FOREIGN KEY (id_joueur) REFERENCES joueur(id_joueur);
ALTER TABLE est_transfere ADD CONSTRAINT FK_est_transfere_id_equipe FOREIGN KEY (id_equipe) REFERENCES equipe(id_equipe);
ALTER TABLE joue_contre ADD CONSTRAINT FK_joue_contre_id_equipe FOREIGN KEY (id_equipe) REFERENCES equipe(id_equipe);
ALTER TABLE joue_contre ADD CONSTRAINT FK_joue_contre_id_equipe_1 FOREIGN KEY (id_equipe_1) REFERENCES equipe(id_equipe);

ALTER TABLE joue_contre CHANGE id_equipe_1 id_equipe_adverse Int;


INSERT INTO equipe (id_equipe,nom_equipe, points_equipe) VALUES 
(1,"France",0),
(2,"Allemagne",0),
(3,"Italie",0 ),
(4,"Angleterre",0),
(5,"Espagne",0);

INSERT INTO joueur (nom_joueur,titulaire_joueur,poste_joueur,id_equipe) VALUES 
('Rami',1,'DEF',1),
('Griezmann',1,'MIL',1),
('Pogba',1,'MIL',1),
('Payet',1,'ATT',1),
('Giroud',1,'ATT',1),
('Lloris',1,'GAR',1),
('Evra',0,'DEF',1),
('Sissoko',1,'MIL',1),
('Umtiti',1,'DEF',1),
('Gignac',0,'ATT',1),
('Martial',1,'ATT',1),
('Mandanda',1,'GAR',1),
('Matuidi',1,'MIL',1),
('Costil',0,'GAR',1),
('Sagna',1,'DEF',1),
('Koscielny',1,'DEF',1);

INSERT INTO joueur (nom_joueur,titulaire_joueur,poste_joueur,id_equipe) VALUES 
('Hector',1,'DEF',2),
('Sané',1,'MIL',2),
('Mustafi',1,'MIL',2),
('Schürrle',1,'ATT',2),
('Kimmich',1,'ATT',2),
('Khedira',1,'GAR',2),
('Götze',0,'DEF',2),
('Reus',1,'MIL',2),
('Kroos',1,'DEF',2),
('Podolski',0,'ATT',2),
('Boateng',1,'ATT',2),
('Draxler',1,'GAR',2),
('Hummels',1,'MIL',2),
('Müller',0,'GAR',2),
('Neuer',1,'DEF',2),
('Özil',1,'DEF',2);