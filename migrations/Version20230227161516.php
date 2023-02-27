<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230227161516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_A9237ED39B80EC64 ON rendezvous_utilisateur');
        $this->addSql('DROP INDEX `primary` ON rendezvous_utilisateur');
        $this->addSql('ALTER TABLE rendezvous_utilisateur CHANGE Utilisateur rendezvous_id INT NOT NULL');
        $this->addSql('ALTER TABLE rendezvous_utilisateur ADD CONSTRAINT FK_A9237ED33345E0A3 FOREIGN KEY (rendezvous_id) REFERENCES rendezvous (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rendezvous_utilisateur ADD CONSTRAINT FK_A9237ED3FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_A9237ED33345E0A3 ON rendezvous_utilisateur (rendezvous_id)');
        $this->addSql('ALTER TABLE rendezvous_utilisateur ADD PRIMARY KEY (rendezvous_id, utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendezvous_utilisateur DROP FOREIGN KEY FK_A9237ED33345E0A3');
        $this->addSql('ALTER TABLE rendezvous_utilisateur DROP FOREIGN KEY FK_A9237ED3FB88E14F');
        $this->addSql('DROP INDEX IDX_A9237ED33345E0A3 ON rendezvous_utilisateur');
        $this->addSql('DROP INDEX `PRIMARY` ON rendezvous_utilisateur');
        $this->addSql('ALTER TABLE rendezvous_utilisateur CHANGE rendezvous_id Utilisateur INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_A9237ED39B80EC64 ON rendezvous_utilisateur (Utilisateur)');
        $this->addSql('ALTER TABLE rendezvous_utilisateur ADD PRIMARY KEY (Utilisateur, utilisateur_id)');
    }
}
