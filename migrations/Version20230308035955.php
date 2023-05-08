<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308035955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql(" INSERT INTO `rendezvous_user` (`rendezvous_id`, `user_id`) VALUES 
        ('1', '1'), 
        ('1', '7'), 
        ('2', '4'), 
        ('2', '3'), 
        ('2', '5'), 
        ('3', '7'), 
        ('3', '3'), 
        ('4', '6'), 
        ('4', '5'), 
        ('5', '3'), 
        ('5', '1'), 
        ('5', '7'), 
        ('5', '5'), 
        ('5', '4'), 
        ('6', '1'), 
        ('6', '7'), 
        ('7', '5'), 
        ('7', '2'), 
        ('7', '6'), 
        ('8', '1'), 
        ('8', '7'), 
        ('8', '4'), 
        ('9', '7'), 
        ('9', '3'), 
        ('10', '7'), 
        ('10', '3'), 
        ('11', '1'), 
        ('11', '6'), 
        ('12', '1'), 
        ('12', '4'), 
        ('12', '7'); ");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
