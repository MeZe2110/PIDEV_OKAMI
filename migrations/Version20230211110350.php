<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230211110350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock ADD stockcat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660F085592E FOREIGN KEY (stockcat_id) REFERENCES stockcategories (id)');
        $this->addSql('CREATE INDEX IDX_4B365660F085592E ON stock (stockcat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660F085592E');
        $this->addSql('DROP INDEX IDX_4B365660F085592E ON stock');
        $this->addSql('ALTER TABLE stock DROP stockcat_id');
    }
}
