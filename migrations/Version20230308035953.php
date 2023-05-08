<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308035953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql(" INSERT INTO `categoriesvehicules` (`id`, `typecatv`) VALUES
        (DEFAULT, 'Vehicule de catégorie A (ASSU)'),
        (DEFAULT, 'Véhicule de catégorie B (VSAB)'),
        (DEFAULT, 'Véhicule de catégorie C'); ");

        $this->addSql(" INSERT INTO `stockcategories` (`id`, `typecat`) VALUES
        (DEFAULT, 'Antiagrégant plaquettaire'),
        (DEFAULT, 'Anti-ulcéreux'),
        (DEFAULT, 'Hypolipémiant\r\n'),
        (DEFAULT, 'Hypoglycémiant oral'),
        (DEFAULT, 'Hypoglycémiant injectable'),
        (DEFAULT, 'Hormone thyroïdienne'),
        (DEFAULT, ' Hypnotique'),
        (DEFAULT, 'Céphalosporine'),
        (DEFAULT, 'Antipyrétique'),
        (DEFAULT, 'analgésique'); ");

        $this->addSql(" INSERT INTO categoriesequipement (id, nomcate) VALUES
        (NULL, 'DIAGNOSTIC SPECIALISE'), 
        (NULL, 'DIAGNOSTIC GENERAL'), 
        (NULL, 'MOBILIER - EQUIPEMENT DU CABINET'), 
        (NULL, 'HYGIENE - PROTECTION'), 
        (NULL, 'INSTRUMENTATION - PETIT MATERIEL'), 
        (NULL, 'SOINS PANSEMENT INJECTION'), 
        (NULL, 'ACCESSOIRES ET PIECES DETACHEES'), 
        (NULL, 'VETEMENT ET MALLETTE MEDICALE'); ");

        $this->addSql(" INSERT INTO `rendezvous_type` (`id`, `type`) VALUES 
        (DEFAULT, 'Administratif'), 
        (DEFAULT, 'Médical'), 
        (DEFAULT, 'Opération'),
        (DEFAULT, 'Informatif'), 
        (DEFAULT, 'Autre'); ");

        $this->addSql(" INSERT INTO `roleuser` (`id`, `role`) VALUES 
        (DEFAULT, 'Administrateur'), 
        (DEFAULT, 'Employé'), 
        (DEFAULT, 'Utilisateur'); ");

        $this->addSql(" INSERT INTO `salle` (`id`, `numsa`, `etagesa`, `typesa`) VALUES 
        (DEFAULT, '1', '1', 'Administratif'),
        (DEFAULT, '2', '1', 'Administratif'),
        (DEFAULT, '1', '3', 'Opération'),
        (DEFAULT, '1', '4', 'Consultation'),
        (DEFAULT, '1', '2', 'Opération'),
        (DEFAULT, '2', '2', 'Opération'),
        (DEFAULT, '2', '3', 'Consultation'),
        (DEFAULT, '2', '4', 'Consultation'),
        (DEFAULT, '3', '2', 'Repos'),
        (DEFAULT, '1', '3', 'Administratif'),
        (DEFAULT, '2', '3', 'Chambre'),
        (DEFAULT, '3', '3', 'Chambre'),
        (DEFAULT, '4', '3', 'Chambre'),
        (DEFAULT, '5', '3', 'Chambre'); ");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
