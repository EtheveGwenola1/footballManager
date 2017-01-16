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
        date_transfert Date ,
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

INSERT INTO joueur (nom_joueur,titulaire_joueur,poste_joueur,id_equipe) VALUES 
('Buffon',1,'DEF',3),
('De Rossi',1,'MIL',3),
('Chiellini',1,'MIL',3),
('Bonucci',1,'ATT',3),
('Barzagli',1,'ATT',3),
('Candreva',1,'GAR',3),
('Motta',0,'DEF',3),
('Giaccherini',1,'MIL',3),
('Darmian',1,'DEF',3),
('De Sciglio',0,'ATT',3),
('Parolo',1,'ATT',3),
('El Shaarawy',1,'GAR',3),
('Florenzi',1,'MIL',3),
('Sirigu',0,'GAR',3),
('Immobile',1,'DEF',3),
('Pelle',1,'DEF',3);

INSERT INTO joueur (nom_joueur,titulaire_joueur,poste_joueur,id_equipe) VALUES 
('Rooney',1,'DEF',4),
('Hart',1,'MIL',4),
('Milner',1,'MIL',4),
('Cahill',1,'ATT',4),
('Wilshere',1,'ATT',4),
('Smalling',1,'GAR',4),
('Henderson',0,'DEF',4),
('Lallana',1,'MIL',4),
('Sterling',1,'DEF',4),
('Barkley',0,'ATT',4),
('Sturridge',1,'ATT',4),
('Walker',1,'GAR',4),
('Kane',1,'MIL',4),
('Clyne',0,'GAR',4),
('Alli',1,'DEF',4),
('Dier',1,'DEF',4);

INSERT INTO joueur (nom_joueur,titulaire_joueur,poste_joueur,id_equipe) VALUES 
('Casillas',1,'DEF',5),
('Ramos',1,'MIL',5),
('Iniesta',1,'MIL',5),
('Fabregas',1,'ATT',5),
('Silva',1,'ATT',5),
('Busquets',1,'GAR',5),
('Piqué',0,'DEF',5),
('Pedro',1,'MIL',5),
('Alba',1,'DEF',5),
('Koke',0,'ATT',5),
('Juanfran',1,'ATT',5),
('Azpilicueta',1,'GAR',5),
('De Gea',1,'MIL',5),
('Alcantara',0,'GAR',5),
('Morata',1,'DEF',5),
('Nolito',1,'DEF',5);

SELECT est_transfere.id_joueur, est_transfere.montant, est_transfere.id_equipe, joueur.nom_joueur, equipe.nom_equipe
FROM est_transfere
INNER JOIN joueur ON est_transfere.id_joueur = joueur.nom_joueur
INNER JOIN equipe ON est_transfere.id_equipe = equipe.nom_equipe;


SELECT joueur.nom_joueur, joueur.poste_joueur, joueur.titulaire_joueur, equipe.nom_equipe  
FROM joueur 
INNER JOIN equipe ON joueur.id_equipe = equipe.id_equipe 
ORDER BY equipe.nom_equipe;

SELECT est_transfere.montant, joueur.nom_joueur, equipe.nom_equipe
FROM est_transfere
INNER JOIN joueur ON est_transfere.id_joueur = joueur.id_joueur
INNER JOIN equipe ON joueur.id_equipe = equipe.id_equipe;