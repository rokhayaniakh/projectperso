<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190725155230 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utilisateurs ADD idpartenaire_id INT NOT NULL');
        $this->addSql('ALTER TABLE utilisateurs ADD CONSTRAINT FK_497B315EE1440477 FOREIGN KEY (idpartenaire_id) REFERENCES partenaire (id)');
        $this->addSql('CREATE INDEX IDX_497B315EE1440477 ON utilisateurs (idpartenaire_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utilisateurs DROP FOREIGN KEY FK_497B315EE1440477');
        $this->addSql('DROP INDEX IDX_497B315EE1440477 ON utilisateurs');
        $this->addSql('ALTER TABLE utilisateurs DROP idpartenaire_id');
    }
}
