<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221217162819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, fm_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, author LONGTEXT NOT NULL, book_price NUMERIC(10, 0) NOT NULL, about LONGTEXT NOT NULL, nrpage INT NOT NULL, INDEX IDX_CBE5A331801C460C (fm_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331801C460C FOREIGN KEY (fm_id) REFERENCES fm (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sessions (sess_id VARBINARY(128) NOT NULL, sess_data BLOB NOT NULL, sess_lifetime INT UNSIGNED NOT NULL, sess_time INT UNSIGNED NOT NULL, INDEX sessions_sess_lifetime_idx (sess_lifetime), PRIMARY KEY(sess_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_bin` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331801C460C');
        $this->addSql('DROP TABLE book');
    }
}
