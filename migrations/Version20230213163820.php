<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213163820 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock ADD quantites INT NOT NULL, CHANGE etatst description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE stockcategories MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON stockcategories');
        $this->addSql('ALTER TABLE stockcategories ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE stock DROP quantites, CHANGE description etatst VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE stockcategories MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON stockcategories');
        $this->addSql('ALTER TABLE stockcategories ADD PRIMARY KEY (id, typecat)');
    }
}
