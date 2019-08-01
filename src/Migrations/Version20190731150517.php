<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190731150517 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, idpartenaire_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nomcomplet VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, tel INT DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), INDEX IDX_8D93D649E1440477 (idpartenaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partenaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, rs VARCHAR(255) NOT NULL, ninea INT NOT NULL, adresse VARCHAR(255) NOT NULL, statut VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, idpartenaire_id INT DEFAULT NULL, solde INT NOT NULL, numbcompte INT DEFAULT NULL, INDEX IDX_CFF65260E1440477 (idpartenaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depot (id INT AUTO_INCREMENT NOT NULL, idcompte_id INT DEFAULT NULL, montant INT DEFAULT NULL, date DATETIME NOT NULL, INDEX IDX_47948BBC8CDECFD5 (idcompte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E1440477 FOREIGN KEY (idpartenaire_id) REFERENCES partenaire (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260E1440477 FOREIGN KEY (idpartenaire_id) REFERENCES partenaire (id)');
        $this->addSql('ALTER TABLE depot ADD CONSTRAINT FK_47948BBC8CDECFD5 FOREIGN KEY (idcompte_id) REFERENCES compte (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E1440477');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260E1440477');
        $this->addSql('ALTER TABLE depot DROP FOREIGN KEY FK_47948BBC8CDECFD5');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE depot');
    }
}
