<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230211112628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoriesvehicules (id INT AUTO_INCREMENT NOT NULL, typecatv VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicules (id INT AUTO_INCREMENT NOT NULL, catv_id INT NOT NULL, nomvh VARCHAR(255) NOT NULL, dispovh TINYINT(1) NOT NULL, etatvh VARCHAR(255) NOT NULL, descvh VARCHAR(255) NOT NULL, INDEX IDX_78218C2D3F9CF094 (catv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2D3F9CF094 FOREIGN KEY (catv_id) REFERENCES categoriesvehicules (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2D3F9CF094');
        $this->addSql('DROP TABLE categoriesvehicules');
        $this->addSql('DROP TABLE vehicules');
    }
}
