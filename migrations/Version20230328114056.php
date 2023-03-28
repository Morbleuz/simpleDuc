<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230328114056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE email (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, receiver_id INT NOT NULL, objet VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, INDEX IDX_E7927C74F624B39D (sender_id), INDEX IDX_E7927C74CD53EDB6 (receiver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, email_id INT DEFAULT NULL, employer_id INT NOT NULL, message LONGTEXT NOT NULL, INDEX IDX_5FB6DEC7A832C1C9 (email_id), INDEX IDX_5FB6DEC741CD9E7A (employer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE email ADD CONSTRAINT FK_E7927C74F624B39D FOREIGN KEY (sender_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE email ADD CONSTRAINT FK_E7927C74CD53EDB6 FOREIGN KEY (receiver_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7A832C1C9 FOREIGN KEY (email_id) REFERENCES email (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC741CD9E7A FOREIGN KEY (employer_id) REFERENCES employe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE email DROP FOREIGN KEY FK_E7927C74F624B39D');
        $this->addSql('ALTER TABLE email DROP FOREIGN KEY FK_E7927C74CD53EDB6');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7A832C1C9');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC741CD9E7A');
        $this->addSql('DROP TABLE email');
        $this->addSql('DROP TABLE reponse');
    }
}
