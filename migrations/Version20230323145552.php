<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230323145552 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet ADD nomProjet VARCHAR(50) NOT NULL, DROP nom_projet');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_50159CA97779E996 ON projet (nomProjet)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_50159CA97779E996 ON projet');
        $this->addSql('ALTER TABLE projet ADD nom_projet VARCHAR(255) NOT NULL, DROP nomProjet');
    }
}
