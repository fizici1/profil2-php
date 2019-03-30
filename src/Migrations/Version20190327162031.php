<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190327162031 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation_competence (evaluation_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_7ED32F8D456C5646 (evaluation_id), INDEX IDX_7ED32F8D15761DAB (competence_id), PRIMARY KEY(evaluation_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evaluation_competence ADD CONSTRAINT FK_7ED32F8D456C5646 FOREIGN KEY (evaluation_id) REFERENCES evaluation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evaluation_competence ADD CONSTRAINT FK_7ED32F8D15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evaluation_competence DROP FOREIGN KEY FK_7ED32F8D15761DAB');
        $this->addSql('ALTER TABLE evaluation_competence DROP FOREIGN KEY FK_7ED32F8D456C5646');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('DROP TABLE evaluation_competence');
    }
}
