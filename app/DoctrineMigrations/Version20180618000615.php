<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180618000615 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql("insert into membership_fee(name, description, cost) values
            ('12€ (revenus inférieurs aux minima sociaux)', '(12€ (revenus inférieurs aux minima sociaux)', 12),
            ('36€ (revenus inférieurs à 1000€)', '(36€ (revenus inférieurs à 1000€)', 36),
            ('60€ (revenus inférieurs à 1500€)', '(60€ (revenus inférieurs à 1500€)', 60),
            ('120€ (revenus inférieurs à 2000€)', '(120€ (revenus inférieurs à 2000€)', 120),
            ('228€ (revenus inférieurs à 2500€)', '(228€ (revenus inférieurs à 2500€)', 228),
            ('336€ (revenus inférieurs à 3000€)', '(336€ (revenus inférieurs à 3000€)', 336),
            ('486€ (revenus inférieurs à 3500€)', '(486€ (revenus inférieurs à 3500€)', 486),
            ('660€ (revenus inférieurs à 4000€)', '(660€ (revenus inférieurs à 4000€)', 660),
            ('8400€ (revenus supérieurs à 4000€)', '(840€ (revenus supérieurs à 4000€)', 840);
        ");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('DELETE FROM membership_fee WHERE cost IN (12, 36, 60, 120, 228, 336, 486, 660, 840);');
    }
}
