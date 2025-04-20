<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250420091441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ave_provincia (ave_id INT NOT NULL, provincia_id INT NOT NULL, INDEX IDX_4B69604F91007320 (ave_id), INDEX IDX_4B69604F4E7121AF (provincia_id), PRIMARY KEY(ave_id, provincia_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provincia (id INT AUTO_INCREMENT NOT NULL, codigo INT NOT NULL, nombre VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D39AF21320332D99 (codigo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ave_provincia ADD CONSTRAINT FK_4B69604F91007320 FOREIGN KEY (ave_id) REFERENCES ave (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ave_provincia ADD CONSTRAINT FK_4B69604F4E7121AF FOREIGN KEY (provincia_id) REFERENCES provincia (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE estado_conservacion CHANGE codigo codigo VARCHAR(10) NOT NULL, CHANGE nombre nombre VARCHAR(100) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ave_provincia DROP FOREIGN KEY FK_4B69604F91007320');
        $this->addSql('ALTER TABLE ave_provincia DROP FOREIGN KEY FK_4B69604F4E7121AF');
        $this->addSql('DROP TABLE ave_provincia');
        $this->addSql('DROP TABLE provincia');
        $this->addSql('ALTER TABLE estado_conservacion CHANGE codigo codigo VARCHAR(255) NOT NULL, CHANGE nombre nombre VARCHAR(255) NOT NULL');
    }
}
