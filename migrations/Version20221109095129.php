<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109095129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce ADD responsable_rh_id INT NOT NULL');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E54333A21E FOREIGN KEY (responsable_rh_id) REFERENCES responsable_rh (id)');
        $this->addSql('CREATE INDEX IDX_F65593E54333A21E ON annonce (responsable_rh_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E54333A21E');
        $this->addSql('DROP INDEX IDX_F65593E54333A21E ON annonce');
        $this->addSql('ALTER TABLE annonce DROP responsable_rh_id');
    }
}
