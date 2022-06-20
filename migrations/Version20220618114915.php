<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220618114915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE capitulos (id INT AUTO_INCREMENT NOT NULL, fases_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_6622F4586289A506 (fases_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fases (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lista (id INT AUTO_INCREMENT NOT NULL, capitulos_id INT DEFAULT NULL, tipo_lista_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, estado TINYINT(1) DEFAULT NULL, INDEX IDX_FB9FEEEDA15EDF03 (capitulos_id), INDEX IDX_FB9FEEEDB1F38C46 (tipo_lista_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_lista (id INT AUTO_INCREMENT NOT NULL, capitulos_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, INDEX IDX_FD237425A15EDF03 (capitulos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE capitulos ADD CONSTRAINT FK_6622F4586289A506 FOREIGN KEY (fases_id) REFERENCES fases (id)');
        $this->addSql('ALTER TABLE lista ADD CONSTRAINT FK_FB9FEEEDA15EDF03 FOREIGN KEY (capitulos_id) REFERENCES capitulos (id)');
        $this->addSql('ALTER TABLE lista ADD CONSTRAINT FK_FB9FEEEDB1F38C46 FOREIGN KEY (tipo_lista_id) REFERENCES tipo_lista (id)');
        $this->addSql('ALTER TABLE tipo_lista ADD CONSTRAINT FK_FD237425A15EDF03 FOREIGN KEY (capitulos_id) REFERENCES capitulos (id)');
       
               
             
   
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lista DROP FOREIGN KEY FK_FB9FEEEDA15EDF03');
        $this->addSql('ALTER TABLE tipo_lista DROP FOREIGN KEY FK_FD237425A15EDF03');
        $this->addSql('ALTER TABLE capitulos DROP FOREIGN KEY FK_6622F4586289A506');
        $this->addSql('ALTER TABLE lista DROP FOREIGN KEY FK_FB9FEEEDB1F38C46');
        $this->addSql('DROP TABLE capitulos');
        $this->addSql('DROP TABLE fases');
        $this->addSql('DROP TABLE lista');
        $this->addSql('DROP TABLE tipo_lista');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
