<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200608090238 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Ajout de champs supplémentaires dans les deux tables Offre et Demande ';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE demande ADD telephone VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD code_postal VARCHAR(255) NOT NULL, ADD creat_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE offre ADD localisation VARCHAR(255) NOT NULL, ADD type_contrat VARCHAR(255) NOT NULL, ADD domaine VARCHAR(255) NOT NULL, ADD code_postal VARCHAR(255) NOT NULL, ADD create_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE demande DROP telephone, DROP email, DROP code_postal, DROP creat_at');
        $this->addSql('ALTER TABLE offre DROP localisation, DROP type_contrat, DROP domaine, DROP code_postal, DROP create_at');
    }
}
