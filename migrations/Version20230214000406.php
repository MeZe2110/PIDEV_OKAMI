<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230214000406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoriesequipement (id INT AUTO_INCREMENT NOT NULL, nomcate VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoriesvehicules (id INT AUTO_INCREMENT NOT NULL, typecatv VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, cate_id INT DEFAULT NULL, nomeq VARCHAR(255) NOT NULL, etateq TINYINT(1) NOT NULL, dispoeq TINYINT(1) NOT NULL, INDEX IDX_B8B4C6F37D3008E5 (cate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plannification (id INT AUTO_INCREMENT NOT NULL, salle_id INT DEFAULT NULL, datepl DATE NOT NULL, heuredebutpl TIME NOT NULL, heurefinpl TIME NOT NULL, INDEX IDX_E88A4812DC304035 (salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendezvous (id INT AUTO_INCREMENT NOT NULL, daterv DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roleutilisateur (id INT AUTO_INCREMENT NOT NULL, roleut VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle (id INT AUTO_INCREMENT NOT NULL, numsa INT NOT NULL, etagesa INT NOT NULL, typesa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, stockcat_id INT DEFAULT NULL, nomst VARCHAR(255) NOT NULL, etatst VARCHAR(255) NOT NULL, dateexpirationst VARCHAR(255) NOT NULL, INDEX IDX_4B365660F085592E (stockcat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stockcategories (id INT AUTO_INCREMENT NOT NULL, typecat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, roleut_id INT NOT NULL, nomut VARCHAR(255) NOT NULL, prenomut VARCHAR(255) NOT NULL, emailut VARCHAR(255) NOT NULL, mdput VARCHAR(255) NOT NULL, INDEX IDX_1D1C63B369D7B1C4 (roleut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicules (id INT AUTO_INCREMENT NOT NULL, catv_id INT NOT NULL, nomvh VARCHAR(255) NOT NULL, dispovh TINYINT(1) NOT NULL, etatvh VARCHAR(255) NOT NULL, descvh VARCHAR(255) NOT NULL, INDEX IDX_78218C2D3F9CF094 (catv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F37D3008E5 FOREIGN KEY (cate_id) REFERENCES categoriesequipement (id)');
        $this->addSql('ALTER TABLE plannification ADD CONSTRAINT FK_E88A4812DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660F085592E FOREIGN KEY (stockcat_id) REFERENCES stockcategories (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B369D7B1C4 FOREIGN KEY (roleut_id) REFERENCES roleutilisateur (id)');
        $this->addSql('ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2D3F9CF094 FOREIGN KEY (catv_id) REFERENCES categoriesvehicules (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F37D3008E5');
        $this->addSql('ALTER TABLE plannification DROP FOREIGN KEY FK_E88A4812DC304035');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660F085592E');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B369D7B1C4');
        $this->addSql('ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2D3F9CF094');
        $this->addSql('DROP TABLE categoriesequipement');
        $this->addSql('DROP TABLE categoriesvehicules');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE plannification');
        $this->addSql('DROP TABLE rendezvous');
        $this->addSql('DROP TABLE roleutilisateur');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE stockcategories');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE vehicules');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
