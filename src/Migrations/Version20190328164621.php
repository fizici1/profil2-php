<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190328164621 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE resultat (id INT AUTO_INCREMENT NOT NULL, eval_id INT NOT NULL, eleve_id INT NOT NULL, competence_id INT NOT NULL, note INT NOT NULL, INDEX IDX_E7DB5DE2D53B5884 (eval_id), INDEX IDX_E7DB5DE2A6CC7B2 (eleve_id), INDEX IDX_E7DB5DE215761DAB (competence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE2D53B5884 FOREIGN KEY (eval_id) REFERENCES evaluation (id)');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE2A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE215761DAB FOREIGN KEY (competence_id) REFERENCES competence (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE resultat');
    }
}
