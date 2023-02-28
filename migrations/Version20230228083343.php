<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230228083343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8DC304035');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8C54C8C93');
        $this->addSql('DROP INDEX IDX_C09A9BA8DC304035 ON rendezvous');
        $this->addSql('DROP INDEX IDX_C09A9BA8C54C8C93 ON rendezvous');
        $this->addSql('ALTER TABLE rendezvous ADD Salle INT DEFAULT NULL, ADD Type INT DEFAULT NULL, DROP salle_id, DROP type_id');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA88F565158 FOREIGN KEY (Salle) REFERENCES salle (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA82CECF817 FOREIGN KEY (Type) REFERENCES rendezvous_type (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_C09A9BA88F565158 ON rendezvous (Salle)');
        $this->addSql('CREATE INDEX IDX_C09A9BA82CECF817 ON rendezvous (Type)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA88F565158');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA82CECF817');
        $this->addSql('DROP INDEX IDX_C09A9BA88F565158 ON rendezvous');
        $this->addSql('DROP INDEX IDX_C09A9BA82CECF817 ON rendezvous');
        $this->addSql('ALTER TABLE rendezvous ADD salle_id INT DEFAULT NULL, ADD type_id INT DEFAULT NULL, DROP Salle, DROP Type');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8C54C8C93 FOREIGN KEY (type_id) REFERENCES rendezvous_type (id)');
        $this->addSql('CREATE INDEX IDX_C09A9BA8DC304035 ON rendezvous (salle_id)');
        $this->addSql('CREATE INDEX IDX_C09A9BA8C54C8C93 ON rendezvous (type_id)');
    }
}
