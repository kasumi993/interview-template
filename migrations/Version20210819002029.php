<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210819002029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ideas (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, idea_author_id INTEGER NOT NULL, idea_title VARCHAR(50) NOT NULL, idea_content VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_1DB2F1DE44B2D1F6 ON ideas (idea_author_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, pseudo VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL)');
        $this->addSql('CREATE TABLE votes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, idea_ref_id INTEGER NOT NULL, voter_ref_id INTEGER NOT NULL, vote_type BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_518B7ACFD74FA0C1 ON votes (idea_ref_id)');
        $this->addSql('CREATE INDEX IDX_518B7ACF31458E35 ON votes (voter_ref_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ideas');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE votes');
    }
}
