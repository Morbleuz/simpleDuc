<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221003124422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe ADD email VARCHAR(180) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD password VARCHAR(255) NOT NULL, ADD nom VARCHAR(100) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD is_verified TINYINT(1) NOT NULL, DROP date_embauche');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F804D3B9E7927C74 ON employe (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_F804D3B9E7927C74 ON employe');
        $this->addSql('ALTER TABLE employe ADD date_embauche DATE DEFAULT NULL, DROP email, DROP roles, DROP password, DROP nom, DROP prenom, DROP is_verified');
    }
}
