<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190726234955 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compte ADD idpartenaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260E1440477 FOREIGN KEY (idpartenaire_id) REFERENCES partenaire (id)');
        $this->addSql('CREATE INDEX IDX_CFF65260E1440477 ON compte (idpartenaire_id)');
        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315E5945798D');
        $this->addSql('DROP INDEX IDX_497B315E5945798D ON utilisateurs');
        $this->addSql('ALTER TABLE utilisateurs ADD username VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD roles VARCHAR(255) NOT NULL, DROP idprofil_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260E1440477');
        $this->addSql('DROP INDEX IDX_CFF65260E1440477 ON compte');
        $this->addSql('ALTER TABLE compte DROP idpartenaire_id');
        $this->addSql('ALTER TABLE utilisateurs ADD idprofil_id INT DEFAULT NULL, DROP username, DROP password, DROP roles');
        $this->addSql('ALTER TABLE utilisateurs ADD CONSTRAINT FK_497B315E5945798D FOREIGN KEY (idprofil_id) REFERENCES profil (id)');
        $this->addSql('CREATE INDEX IDX_497B315E5945798D ON utilisateurs (idprofil_id)');
    }
}
