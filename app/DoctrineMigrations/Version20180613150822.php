<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180613150822 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE membership_fee (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, cost DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, attached_joining_id INT DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, method VARCHAR(20) NOT NULL, status VARCHAR(20) NOT NULL, drawer VARCHAR(255) DEFAULT NULL, date DATETIME NOT NULL, account VARCHAR(20) NOT NULL, referenceIdentifierPrefix VARCHAR(100) NOT NULL, paymentIPN LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', payment_type VARCHAR(255) NOT NULL, INDEX IDX_6D28840D7C00DE70 (attached_joining_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D7C00DE70 FOREIGN KEY (attached_joining_id) REFERENCES joining (id)');
        $this->addSql('ALTER TABLE joining ADD membershipfee_id INT DEFAULT NULL, ADD payment_mode VARCHAR(255) DEFAULT NULL, ADD joining_date DATETIME NOT NULL, DROP membership_fee');
        $this->addSql('ALTER TABLE joining ADD CONSTRAINT FK_6B7DA62B2DB0665B FOREIGN KEY (membershipfee_id) REFERENCES membership_fee (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_6B7DA62B2DB0665B ON joining (membershipfee_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE joining DROP FOREIGN KEY FK_6B7DA62B2DB0665B');
        $this->addSql('DROP TABLE membership_fee');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP INDEX IDX_6B7DA62B2DB0665B ON joining');
        $this->addSql('ALTER TABLE joining ADD membership_fee SMALLINT NOT NULL, DROP membershipfee_id, DROP payment_mode, DROP joining_date');
    }
}
