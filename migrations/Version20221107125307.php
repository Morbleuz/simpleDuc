<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221107125307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache ADD developpeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_9387207584E66085 FOREIGN KEY (developpeur_id) REFERENCES developpeur (id)');
        $this->addSql('CREATE INDEX IDX_9387207584E66085 ON tache (developpeur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_9387207584E66085');
        $this->addSql('DROP INDEX IDX_9387207584E66085 ON tache');
        $this->addSql('ALTER TABLE tache DROP developpeur_id');
    }
}
