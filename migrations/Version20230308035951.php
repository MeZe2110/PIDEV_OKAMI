<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308035951 extends AbstractMigration
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
        $this->addSql('CREATE TABLE disabled_until (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, nomeq VARCHAR(255) NOT NULL, etateq TINYINT(1) NOT NULL, dispoeq TINYINT(1) NOT NULL, Categoriesequipement INT NOT NULL, INDEX IDX_B8B4C6F3B0074144 (Categoriesequipement), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_EDBFD5ECA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plannification (id INT AUTO_INCREMENT NOT NULL, salle INT NOT NULL, datepl DATE NOT NULL, heuredebutpl TIME NOT NULL, heurefinpl TIME NOT NULL, INDEX IDX_E88A48124E977E5C (salle), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendezvous (id INT AUTO_INCREMENT NOT NULL, daterv DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, rappel TINYINT(1) DEFAULT 1 NOT NULL, end_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, Salle INT NOT NULL, Type INT DEFAULT NULL, INDEX IDX_C09A9BA88F565158 (Salle), INDEX IDX_C09A9BA82CECF817 (Type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendezvous_user (rendezvous_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_C1DEFEC83345E0A3 (rendezvous_id), INDEX IDX_C1DEFEC8A76ED395 (user_id), PRIMARY KEY(rendezvous_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendezvous_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roleuser (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle (id INT AUTO_INCREMENT NOT NULL, numsa INT NOT NULL, etagesa INT NOT NULL, typesa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, nomst VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, dateexpirationst DATE NOT NULL, quantites INT NOT NULL, Stockcategories INT NOT NULL, INDEX IDX_4B36566067373F03 (Stockcategories), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stockcategories (id INT AUTO_INCREMENT NOT NULL, typecat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicules (id INT AUTO_INCREMENT NOT NULL, nomvh VARCHAR(255) NOT NULL, dispovh TINYINT(1) NOT NULL, etatvh VARCHAR(255) NOT NULL, descvh VARCHAR(255) NOT NULL, imagesvh VARCHAR(255) DEFAULT NULL, date DATETIME DEFAULT NULL, Categoriesvehicules INT NOT NULL, INDEX IDX_78218C2DA69B1660 (Categoriesvehicules), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F3B0074144 FOREIGN KEY (Categoriesequipement) REFERENCES categoriesequipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE historique ADD CONSTRAINT FK_EDBFD5ECA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE plannification ADD CONSTRAINT FK_E88A48124E977E5C FOREIGN KEY (salle) REFERENCES salle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA88F565158 FOREIGN KEY (Salle) REFERENCES salle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA82CECF817 FOREIGN KEY (Type) REFERENCES rendezvous_type (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE rendezvous_user ADD CONSTRAINT FK_C1DEFEC83345E0A3 FOREIGN KEY (rendezvous_id) REFERENCES rendezvous (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rendezvous_user ADD CONSTRAINT FK_C1DEFEC8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B36566067373F03 FOREIGN KEY (Stockcategories) REFERENCES stockcategories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES roleuser (id)');
        $this->addSql('ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2DA69B1660 FOREIGN KEY (Categoriesvehicules) REFERENCES categoriesvehicules (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F3B0074144');
        $this->addSql('ALTER TABLE historique DROP FOREIGN KEY FK_EDBFD5ECA76ED395');
        $this->addSql('ALTER TABLE plannification DROP FOREIGN KEY FK_E88A48124E977E5C');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA88F565158');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA82CECF817');
        $this->addSql('ALTER TABLE rendezvous_user DROP FOREIGN KEY FK_C1DEFEC83345E0A3');
        $this->addSql('ALTER TABLE rendezvous_user DROP FOREIGN KEY FK_C1DEFEC8A76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B36566067373F03');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2DA69B1660');
        $this->addSql('DROP TABLE categoriesequipement');
        $this->addSql('DROP TABLE categoriesvehicules');
        $this->addSql('DROP TABLE disabled_until');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE historique');
        $this->addSql('DROP TABLE plannification');
        $this->addSql('DROP TABLE rendezvous');
        $this->addSql('DROP TABLE rendezvous_user');
        $this->addSql('DROP TABLE rendezvous_type');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE roleuser');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE stockcategories');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vehicules');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
