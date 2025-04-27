<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250423190332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE foto (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, ave_id INT NOT NULL, nombre_archivo VARCHAR(255) DEFAULT NULL, descripcion LONGTEXT DEFAULT NULL, fecha_subida DATETIME NOT NULL, INDEX IDX_EADC3BE5DB38439E (usuario_id), INDEX IDX_EADC3BE591007320 (ave_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE foto ADD CONSTRAINT FK_EADC3BE5DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE foto ADD CONSTRAINT FK_EADC3BE591007320 FOREIGN KEY (ave_id) REFERENCES ave (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE foto DROP FOREIGN KEY FK_EADC3BE5DB38439E');
        $this->addSql('ALTER TABLE foto DROP FOREIGN KEY FK_EADC3BE591007320');
        $this->addSql('DROP TABLE foto');
    }
}
