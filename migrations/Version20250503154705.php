<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250503154705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE voto (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, foto_id INT DEFAULT NULL, fecha DATETIME NOT NULL, INDEX IDX_BAC56C7ADB38439E (usuario_id), INDEX IDX_BAC56C7A7ABFA656 (foto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE voto ADD CONSTRAINT FK_BAC56C7ADB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE voto ADD CONSTRAINT FK_BAC56C7A7ABFA656 FOREIGN KEY (foto_id) REFERENCES foto (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voto DROP FOREIGN KEY FK_BAC56C7ADB38439E');
        $this->addSql('ALTER TABLE voto DROP FOREIGN KEY FK_BAC56C7A7ABFA656');
        $this->addSql('DROP TABLE voto');
    }
}
