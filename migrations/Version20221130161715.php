<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130161715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fm (id INT AUTO_INCREMENT NOT NULL, materijal_id INT DEFAULT NULL, format_id INT DEFAULT NULL, price INT NOT NULL, INDEX IDX_417DC33BA0B2BAFB (materijal_id), INDEX IDX_417DC33BD629F605 (format_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fm ADD CONSTRAINT FK_417DC33BA0B2BAFB FOREIGN KEY (materijal_id) REFERENCES materijal (id)');
        $this->addSql('ALTER TABLE fm ADD CONSTRAINT FK_417DC33BD629F605 FOREIGN KEY (format_id) REFERENCES format (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fm DROP FOREIGN KEY FK_417DC33BA0B2BAFB');
        $this->addSql('ALTER TABLE fm DROP FOREIGN KEY FK_417DC33BD629F605');
        $this->addSql('DROP TABLE fm');
    }
}
