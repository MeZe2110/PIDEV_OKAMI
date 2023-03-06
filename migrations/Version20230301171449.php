<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230301171449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2D3F9CF094');
        $this->addSql('ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2D3F9CF094 FOREIGN KEY (catv_id) REFERENCES categoriesvehicules (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicules DROP FOREIGN KEY FK_78218C2D3F9CF094');
        $this->addSql('ALTER TABLE vehicules ADD CONSTRAINT FK_78218C2D3F9CF094 FOREIGN KEY (catv_id) REFERENCES categoriesvehicules (id) ON DELETE CASCADE');
    }
}
