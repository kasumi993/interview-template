<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210821121550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_1DB2F1DE44B2D1F6');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ideas AS SELECT id, idea_author_id, idea_title, idea_content, created_at FROM ideas');
        $this->addSql('DROP TABLE ideas');
        $this->addSql('CREATE TABLE ideas (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, idea_author_id INTEGER NOT NULL, idea_title VARCHAR(50) NOT NULL COLLATE BINARY, idea_content VARCHAR(255) NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_1DB2F1DE44B2D1F6 FOREIGN KEY (idea_author_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ideas (id, idea_author_id, idea_title, idea_content, created_at) SELECT id, idea_author_id, idea_title, idea_content, created_at FROM __temp__ideas');
        $this->addSql('DROP TABLE __temp__ideas');
        $this->addSql('CREATE INDEX IDX_1DB2F1DE44B2D1F6 ON ideas (idea_author_id)');
        $this->addSql('DROP INDEX IDX_518B7ACF31458E35');
        $this->addSql('DROP INDEX IDX_518B7ACFD74FA0C1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__votes AS SELECT id, idea_ref_id, voter_ref_id, vote_type FROM votes');
        $this->addSql('DROP TABLE votes');
        $this->addSql('CREATE TABLE votes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, idea_ref_id INTEGER NOT NULL, voter_ref_id INTEGER NOT NULL, vote_type BOOLEAN NOT NULL, CONSTRAINT FK_518B7ACFD74FA0C1 FOREIGN KEY (idea_ref_id) REFERENCES ideas (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_518B7ACF31458E35 FOREIGN KEY (voter_ref_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO votes (id, idea_ref_id, voter_ref_id, vote_type) SELECT id, idea_ref_id, voter_ref_id, vote_type FROM __temp__votes');
        $this->addSql('DROP TABLE __temp__votes');
        $this->addSql('CREATE INDEX IDX_518B7ACF31458E35 ON votes (voter_ref_id)');
        $this->addSql('CREATE INDEX IDX_518B7ACFD74FA0C1 ON votes (idea_ref_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_1DB2F1DE44B2D1F6');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ideas AS SELECT id, idea_author_id, idea_title, idea_content, created_at FROM ideas');
        $this->addSql('DROP TABLE ideas');
        $this->addSql('CREATE TABLE ideas (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, idea_author_id INTEGER NOT NULL, idea_title VARCHAR(50) NOT NULL, idea_content VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO ideas (id, idea_author_id, idea_title, idea_content, created_at) SELECT id, idea_author_id, idea_title, idea_content, created_at FROM __temp__ideas');
        $this->addSql('DROP TABLE __temp__ideas');
        $this->addSql('CREATE INDEX IDX_1DB2F1DE44B2D1F6 ON ideas (idea_author_id)');
        $this->addSql('DROP INDEX IDX_518B7ACFD74FA0C1');
        $this->addSql('DROP INDEX IDX_518B7ACF31458E35');
        $this->addSql('CREATE TEMPORARY TABLE __temp__votes AS SELECT id, idea_ref_id, voter_ref_id, vote_type FROM votes');
        $this->addSql('DROP TABLE votes');
        $this->addSql('CREATE TABLE votes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, idea_ref_id INTEGER NOT NULL, voter_ref_id INTEGER NOT NULL, vote_type BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO votes (id, idea_ref_id, voter_ref_id, vote_type) SELECT id, idea_ref_id, voter_ref_id, vote_type FROM __temp__votes');
        $this->addSql('DROP TABLE __temp__votes');
        $this->addSql('CREATE INDEX IDX_518B7ACFD74FA0C1 ON votes (idea_ref_id)');
        $this->addSql('CREATE INDEX IDX_518B7ACF31458E35 ON votes (voter_ref_id)');
    }
}
