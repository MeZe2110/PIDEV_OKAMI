<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230302151033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categoriesvehicules CHANGE typecatv typecatv VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE vehicules CHANGE catv_id catv_id INT NOT NULL, CHANGE nomvh nomvh VARCHAR(255) NOT NULL, CHANGE dispovh dispovh TINYINT(1) NOT NULL, CHANGE etatvh etatvh VARCHAR(255) NOT NULL, CHANGE descvh descvh VARCHAR(255) NOT NULL, CHANGE imagesvh imagesvh VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categoriesvehicules CHANGE typecatv typecatv VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicules CHANGE catv_id catv_id INT DEFAULT NULL, CHANGE nomvh nomvh VARCHAR(255) DEFAULT NULL, CHANGE dispovh dispovh TINYINT(1) DEFAULT NULL, CHANGE etatvh etatvh VARCHAR(255) DEFAULT NULL, CHANGE descvh descvh VARCHAR(255) DEFAULT NULL, CHANGE imagesvh imagesvh VARCHAR(255) DEFAULT NULL');
    }
}
