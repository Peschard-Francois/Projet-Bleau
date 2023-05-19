<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230519133232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bleau_description CHANGE description_fr description_fr LONGTEXT DEFAULT NULL, CHANGE create_date create_date DATETIME NULL');
        $this->addSql('ALTER TABLE circuit ADD sector_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE circuit ADD CONSTRAINT FK_1325F3A6DE95C867 FOREIGN KEY (sector_id) REFERENCES sector (id)');
        $this->addSql('CREATE INDEX IDX_1325F3A6DE95C867 ON circuit (sector_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bleau_description CHANGE description_fr description_fr LONGTEXT NOT NULL, CHANGE create_date create_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE circuit DROP FOREIGN KEY FK_1325F3A6DE95C867');
        $this->addSql('DROP INDEX IDX_1325F3A6DE95C867 ON circuit');
        $this->addSql('ALTER TABLE circuit DROP sector_id');
    }
}
