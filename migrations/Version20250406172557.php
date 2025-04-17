<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250406172557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ave (id INT AUTO_INCREMENT NOT NULL, nombre_comun VARCHAR(255) NOT NULL, nombre_cientifico VARCHAR(255) NOT NULL, descripcion LONGTEXT DEFAULT NULL, orden VARCHAR(100) NOT NULL, familia VARCHAR(100) NOT NULL, longitud_minima DOUBLE PRECISION NOT NULL, longitud_maxima DOUBLE PRECISION NOT NULL, envergadura_minima DOUBLE PRECISION NOT NULL, envergadura_maxima DOUBLE PRECISION NOT NULL, imagen_general LONGBLOB DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ave');
    }
}
