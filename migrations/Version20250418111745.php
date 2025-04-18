<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250418111745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE estado_conservacion (id INT AUTO_INCREMENT NOT NULL, codigo VARCHAR(255) NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ave ADD estado_conservacion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ave ADD CONSTRAINT FK_F2E933A27E66E1BA FOREIGN KEY (estado_conservacion_id) REFERENCES estado_conservacion (id)');
        $this->addSql('CREATE INDEX IDX_F2E933A27E66E1BA ON ave (estado_conservacion_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ave DROP FOREIGN KEY FK_F2E933A27E66E1BA');
        $this->addSql('DROP TABLE estado_conservacion');
        $this->addSql('DROP INDEX IDX_F2E933A27E66E1BA ON ave');
        $this->addSql('ALTER TABLE ave DROP estado_conservacion_id');
    }
}
