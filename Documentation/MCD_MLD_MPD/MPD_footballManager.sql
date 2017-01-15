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
        points_equipe Int ,
        PRIMARY KEY (id_equipe )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: joueur
#------------------------------------------------------------

CREATE TABLE joueur(
        id_joueur        int (11) Auto_increment  NOT NULL ,
        nom_joueur       Varchar (25) ,
        titulaire_joueur Bool ,
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

ALTER TABLE joue_contre CHANGE id_equipe_1 ID_EQUIPE_ADVERSE Int;
ALTER TABLE joue_contre CHANGE id_equipe ID_EQUIPE Int;
ALTER TABLE est_transfere CHANGE id_joueur ID_JOUEUR Int;
ALTER TABLE est_transfere CHANGE id_equipe ID_EQUIPE Int;
ALTER TABLE joueur CHANGE id_equipe ID_EQUIPE Int;