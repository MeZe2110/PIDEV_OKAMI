<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230304210915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendezvous ADD end_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE daterv daterv DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE rendezvous_utilisateur DROP FOREIGN KEY FK_A9237ED3FB88E14F');
        $this->addSql('ALTER TABLE rendezvous_utilisateur DROP FOREIGN KEY FK_A9237ED33345E0A3');
        $this->addSql('ALTER TABLE rendezvous_utilisateur ADD CONSTRAINT FK_A9237ED33345E0A3 FOREIGN KEY (rendezvous_id) REFERENCES rendezvous (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rendezvous_utilisateur ADD CONSTRAINT FK_A9237ED3FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendezvous DROP end_at, CHANGE daterv daterv DATETIME NOT NULL');
        $this->addSql('ALTER TABLE rendezvous_utilisateur DROP FOREIGN KEY FK_A9237ED3FB88E14F');
        $this->addSql('ALTER TABLE rendezvous_utilisateur DROP FOREIGN KEY FK_A9237ED33345E0A3');
        $this->addSql('ALTER TABLE rendezvous_utilisateur ADD CONSTRAINT FK_A9237ED33345E0A3 FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
    }
}
