<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180611193452 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE joining (id INT AUTO_INCREMENT NOT NULL, isRenewed TINYINT(1) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, gender VARCHAR(1) NOT NULL, address VARCHAR(255) NOT NULL, postal_code VARCHAR(10) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) DEFAULT NULL, department VARCHAR(255) DEFAULT NULL, local_comitee VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, phonenumber VARCHAR(100) DEFAULT NULL, mobilephone VARCHAR(100) DEFAULT NULL, job VARCHAR(255) DEFAULT NULL, elective_mandate VARCHAR(255) DEFAULT NULL, mandate_location VARCHAR(255) DEFAULT NULL, trade_union_commitment VARCHAR(255) DEFAULT NULL, associative_commitment VARCHAR(255) DEFAULT NULL, responsabilities VARCHAR(255) DEFAULT NULL, membership_fee SMALLINT NOT NULL, comments LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE joining');
    }
}
