<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250503163127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articulo (id INT AUTO_INCREMENT NOT NULL, autor_id INT DEFAULT NULL, titulo VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, contenido LONGTEXT NOT NULL, imagen VARCHAR(255) DEFAULT NULL, fecha_publicacion DATETIME NOT NULL, INDEX IDX_69E94E9114D45BBE (autor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articulo ADD CONSTRAINT FK_69E94E9114D45BBE FOREIGN KEY (autor_id) REFERENCES usuario (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articulo DROP FOREIGN KEY FK_69E94E9114D45BBE');
        $this->addSql('DROP TABLE articulo');
    }
}
