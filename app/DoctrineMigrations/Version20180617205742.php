<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180617205742 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE donation (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, postal_code VARCHAR(10) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, phonenumber VARCHAR(100) DEFAULT NULL, comments LONGTEXT DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, payment_mode VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donation_payments (donation_id INT NOT NULL, payment_id INT NOT NULL, INDEX IDX_AE9984424DC1279C (donation_id), UNIQUE INDEX UNIQ_AE9984424C3A3BB (payment_id), PRIMARY KEY(donation_id, payment_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joining_payments (joining_id INT NOT NULL, payment_id INT NOT NULL, INDEX IDX_C818625584B07AB4 (joining_id), UNIQUE INDEX UNIQ_C81862554C3A3BB (payment_id), PRIMARY KEY(joining_id, payment_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE donation_payments ADD CONSTRAINT FK_AE9984424DC1279C FOREIGN KEY (donation_id) REFERENCES donation (id)');
        $this->addSql('ALTER TABLE donation_payments ADD CONSTRAINT FK_AE9984424C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE joining_payments ADD CONSTRAINT FK_C818625584B07AB4 FOREIGN KEY (joining_id) REFERENCES joining (id)');
        $this->addSql('ALTER TABLE joining_payments ADD CONSTRAINT FK_C81862554C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D7C00DE70');
        $this->addSql('DROP INDEX IDX_6D28840D7C00DE70 ON payment');
        $this->addSql('ALTER TABLE payment DROP attached_joining_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donation_payments DROP FOREIGN KEY FK_AE9984424DC1279C');
        $this->addSql('DROP TABLE donation');
        $this->addSql('DROP TABLE donation_payments');
        $this->addSql('DROP TABLE joining_payments');
        $this->addSql('ALTER TABLE payment ADD attached_joining_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D7C00DE70 FOREIGN KEY (attached_joining_id) REFERENCES joining (id)');
        $this->addSql('CREATE INDEX IDX_6D28840D7C00DE70 ON payment (attached_joining_id)');
    }
}
