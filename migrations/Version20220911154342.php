<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220911154342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE state (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user DROP name, DROP surname, DROP adress, DROP house_number, DROP post_number, DROP city, DROP state');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE state');
        $this->addSql('ALTER TABLE `user` ADD name VARCHAR(30) DEFAULT NULL, ADD surname VARCHAR(30) NOT NULL, ADD adress VARCHAR(255) NOT NULL, ADD house_number INT NOT NULL, ADD post_number INT NOT NULL, ADD city VARCHAR(255) NOT NULL, ADD state VARCHAR(255) NOT NULL');
    }
}
