<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230214095456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rendezvous_utilisateur (rendezvous_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX IDX_A9237ED33345E0A3 (rendezvous_id), INDEX IDX_A9237ED3FB88E14F (utilisateur_id), PRIMARY KEY(rendezvous_id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rendezvous_utilisateur ADD CONSTRAINT FK_A9237ED33345E0A3 FOREIGN KEY (rendezvous_id) REFERENCES rendezvous (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rendezvous_utilisateur ADD CONSTRAINT FK_A9237ED3FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stock DROP stockcat');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendezvous_utilisateur DROP FOREIGN KEY FK_A9237ED33345E0A3');
        $this->addSql('ALTER TABLE rendezvous_utilisateur DROP FOREIGN KEY FK_A9237ED3FB88E14F');
        $this->addSql('DROP TABLE rendezvous_utilisateur');
        $this->addSql('ALTER TABLE stock ADD stockcat VARCHAR(255) NOT NULL');
    }
}
