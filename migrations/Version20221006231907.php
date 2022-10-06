<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221006231907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD name LONGTEXT NOT NULL, ADD surname LONGTEXT NOT NULL, ADD username VARCHAR(255) NOT NULL, ADD adress VARCHAR(255) NOT NULL, ADD postcode INT NOT NULL, ADD city VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
       
    }
}
