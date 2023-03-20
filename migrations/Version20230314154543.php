<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230314154543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, responsable_rh_id INT NOT NULL, nom_annonce VARCHAR(255) NOT NULL, poste_apromouvoir VARCHAR(255) NOT NULL, salaire_de_base INT NOT NULL, qualification VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_F65593E54333A21E (responsable_rh_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, email VARCHAR(150) NOT NULL, INDEX IDX_6AB5B4718805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, sujet VARCHAR(100) NOT NULL, commentaire LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE developpeur (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE developpeur_equipe (developpeur_id INT NOT NULL, equipe_id INT NOT NULL, INDEX IDX_8727D5CF84E66085 (developpeur_id), INDEX IDX_8727D5CF6D861B89 (equipe_id), PRIMARY KEY(developpeur_id, equipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (id INT NOT NULL, rib VARCHAR(27) DEFAULT NULL, nombre_heures INT DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, sexe VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, nom_equipe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, equipe_id INT DEFAULT NULL, nom_projet VARCHAR(255) NOT NULL, cout_total_estime INT NOT NULL, cout_reel INT NOT NULL, UNIQUE INDEX UNIQ_50159CA96D861B89 (equipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE responsable_rh (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tache (id INT AUTO_INCREMENT NOT NULL, developpeur_id INT DEFAULT NULL, projet_id INT DEFAULT NULL, nom_tache VARCHAR(255) NOT NULL, est_faite TINYINT(1) NOT NULL, INDEX IDX_9387207584E66085 (developpeur_id), INDEX IDX_93872075C18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E54333A21E FOREIGN KEY (responsable_rh_id) REFERENCES responsable_rh (id)');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B4718805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE developpeur ADD CONSTRAINT FK_22F0C0C7BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE developpeur_equipe ADD CONSTRAINT FK_8727D5CF84E66085 FOREIGN KEY (developpeur_id) REFERENCES developpeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE developpeur_equipe ADD CONSTRAINT FK_8727D5CF6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA96D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE responsable_rh ADD CONSTRAINT FK_F3451AC3BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_9387207584E66085 FOREIGN KEY (developpeur_id) REFERENCES developpeur (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E54333A21E');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B4718805AB2F');
        $this->addSql('ALTER TABLE developpeur DROP FOREIGN KEY FK_22F0C0C7BF396750');
        $this->addSql('ALTER TABLE developpeur_equipe DROP FOREIGN KEY FK_8727D5CF84E66085');
        $this->addSql('ALTER TABLE developpeur_equipe DROP FOREIGN KEY FK_8727D5CF6D861B89');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9BF396750');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA96D861B89');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE responsable_rh DROP FOREIGN KEY FK_F3451AC3BF396750');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_9387207584E66085');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075C18272');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE developpeur');
        $this->addSql('DROP TABLE developpeur_equipe');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE responsable_rh');
        $this->addSql('DROP TABLE tache');
        $this->addSql('DROP TABLE user');
    }
}
