<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210616101321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE posts (id INT AUTO_INCREMENT NOT NULL, forums_id INT DEFAULT NULL, content LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL, brochure_filename VARCHAR(255) NOT NULL, INDEX IDX_885DBAFA618BA34B (forums_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA618BA34B FOREIGN KEY (forums_id) REFERENCES forums (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE post');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, forums_id INT DEFAULT NULL, content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL, brochure_filename VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_5A8A6C8D618BA34B (forums_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D618BA34B FOREIGN KEY (forums_id) REFERENCES forums (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE posts');
    }
}
