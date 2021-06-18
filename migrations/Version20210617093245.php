<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617093245 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE forums ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE forums ADD CONSTRAINT FK_FE5E5AB8A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_FE5E5AB8A76ED395 ON forums (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE forums DROP FOREIGN KEY FK_FE5E5AB8A76ED395');
        $this->addSql('DROP INDEX IDX_FE5E5AB8A76ED395 ON forums');
        $this->addSql('ALTER TABLE forums DROP user_id');
    }
}
