<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20190227110356 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('UPDATE joining SET country="FR" WHERE country="France"');
        $this->addSql('UPDATE donation SET country="FR" WHERE country="France"');
        $this->addSql('ALTER TABLE joining ADD nationality VARCHAR(2) NOT NULL, CHANGE country country VARCHAR(2) NOT NULL');
        $this->addSql('ALTER TABLE donation ADD nationality VARCHAR(2) NOT NULL, CHANGE country country VARCHAR(2) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donation DROP nationality, CHANGE country country VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE joining DROP nationality, CHANGE country country VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('UPDATE joining SET country="France" WHERE country="FR"');
        $this->addSql('UPDATE donation SET country="France" WHERE country="FR"');
    }
}
