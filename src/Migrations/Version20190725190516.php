<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190725190516 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partenaire ADD idsuperadmin_id INT NOT NULL, ADD idcompte_id INT NOT NULL');
        $this->addSql('ALTER TABLE partenaire ADD CONSTRAINT FK_32FFA373DB899C1A FOREIGN KEY (idsuperadmin_id) REFERENCES superadmin (id)');
        $this->addSql('ALTER TABLE partenaire ADD CONSTRAINT FK_32FFA3738CDECFD5 FOREIGN KEY (idcompte_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_32FFA373DB899C1A ON partenaire (idsuperadmin_id)');
        $this->addSql('CREATE INDEX IDX_32FFA3738CDECFD5 ON partenaire (idcompte_id)');
        $this->addSql('ALTER TABLE utilisateurs ADD username VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partenaire DROP FOREIGN KEY FK_32FFA373DB899C1A');
        $this->addSql('ALTER TABLE partenaire DROP FOREIGN KEY FK_32FFA3738CDECFD5');
        $this->addSql('DROP INDEX IDX_32FFA373DB899C1A ON partenaire');
        $this->addSql('DROP INDEX IDX_32FFA3738CDECFD5 ON partenaire');
        $this->addSql('ALTER TABLE partenaire DROP idsuperadmin_id, DROP idcompte_id');
        $this->addSql('ALTER TABLE utilisateurs DROP username, DROP password');
    }
}
