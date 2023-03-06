<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230217082517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rendezvous_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rendezvous ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8C54C8C93 FOREIGN KEY (type_id) REFERENCES rendezvous_type (id)');
        $this->addSql('CREATE INDEX IDX_C09A9BA8C54C8C93 ON rendezvous (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8C54C8C93');
        $this->addSql('DROP TABLE rendezvous_type');
        $this->addSql('DROP INDEX IDX_C09A9BA8C54C8C93 ON rendezvous');
        $this->addSql('ALTER TABLE rendezvous DROP type_id');
    }
}
