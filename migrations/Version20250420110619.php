<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250420110619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ave_provincia_periodo (id INT AUTO_INCREMENT NOT NULL, ave_id INT NOT NULL, provincia_id INT NOT NULL, periodo_id INT NOT NULL, INDEX IDX_7C8D8EFE91007320 (ave_id), INDEX IDX_7C8D8EFE4E7121AF (provincia_id), INDEX IDX_7C8D8EFE9C3921AB (periodo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mes (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE periodo (id INT AUTO_INCREMENT NOT NULL, tipo VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE periodo_mes (periodo_id INT NOT NULL, mes_id INT NOT NULL, INDEX IDX_448415D79C3921AB (periodo_id), INDEX IDX_448415D7B4F0564A (mes_id), PRIMARY KEY(periodo_id, mes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ave_provincia_periodo ADD CONSTRAINT FK_7C8D8EFE91007320 FOREIGN KEY (ave_id) REFERENCES ave (id)');
        $this->addSql('ALTER TABLE ave_provincia_periodo ADD CONSTRAINT FK_7C8D8EFE4E7121AF FOREIGN KEY (provincia_id) REFERENCES provincia (id)');
        $this->addSql('ALTER TABLE ave_provincia_periodo ADD CONSTRAINT FK_7C8D8EFE9C3921AB FOREIGN KEY (periodo_id) REFERENCES periodo (id)');
        $this->addSql('ALTER TABLE periodo_mes ADD CONSTRAINT FK_448415D79C3921AB FOREIGN KEY (periodo_id) REFERENCES periodo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE periodo_mes ADD CONSTRAINT FK_448415D7B4F0564A FOREIGN KEY (mes_id) REFERENCES mes (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_D39AF21320332D99 ON provincia');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ave_provincia_periodo DROP FOREIGN KEY FK_7C8D8EFE91007320');
        $this->addSql('ALTER TABLE ave_provincia_periodo DROP FOREIGN KEY FK_7C8D8EFE4E7121AF');
        $this->addSql('ALTER TABLE ave_provincia_periodo DROP FOREIGN KEY FK_7C8D8EFE9C3921AB');
        $this->addSql('ALTER TABLE periodo_mes DROP FOREIGN KEY FK_448415D79C3921AB');
        $this->addSql('ALTER TABLE periodo_mes DROP FOREIGN KEY FK_448415D7B4F0564A');
        $this->addSql('DROP TABLE ave_provincia_periodo');
        $this->addSql('DROP TABLE mes');
        $this->addSql('DROP TABLE periodo');
        $this->addSql('DROP TABLE periodo_mes');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D39AF21320332D99 ON provincia (codigo)');
    }
}
