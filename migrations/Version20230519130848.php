<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230519130848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bleau_description CHANGE create_date create_date DATETIME NULL');
        $this->addSql('ALTER TABLE route DROP level');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE route ADD level VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE bleau_description CHANGE create_date create_date DATETIME DEFAULT NULL');
    }
}
