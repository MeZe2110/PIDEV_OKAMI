<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230211113141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categoriesequipement (id INT AUTO_INCREMENT NOT NULL, nomcate VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, cate_id INT DEFAULT NULL, nomeq VARCHAR(255) NOT NULL, etateq TINYINT(1) NOT NULL, dispoeq TINYINT(1) NOT NULL, INDEX IDX_B8B4C6F37D3008E5 (cate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F37D3008E5 FOREIGN KEY (cate_id) REFERENCES categoriesequipement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F37D3008E5');
        $this->addSql('DROP TABLE categoriesequipement');
        $this->addSql('DROP TABLE equipement');
    }
}
