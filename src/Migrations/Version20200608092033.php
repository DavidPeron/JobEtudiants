<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200608092033 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Ajout des relations entre Offre -> Employeur et Demande -> Etudiant';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE demande ADD etudiant_id INT NOT NULL');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('CREATE INDEX IDX_2694D7A5DDEAB1A3 ON demande (etudiant_id)');
        $this->addSql('ALTER TABLE offre ADD employeur_id INT NOT NULL');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F5D7C53EC FOREIGN KEY (employeur_id) REFERENCES employeur (id)');
        $this->addSql('CREATE INDEX IDX_AF86866F5D7C53EC ON offre (employeur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5DDEAB1A3');
        $this->addSql('DROP INDEX IDX_2694D7A5DDEAB1A3 ON demande');
        $this->addSql('ALTER TABLE demande DROP etudiant_id');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F5D7C53EC');
        $this->addSql('DROP INDEX IDX_AF86866F5D7C53EC ON offre');
        $this->addSql('ALTER TABLE offre DROP employeur_id');
    }
}
