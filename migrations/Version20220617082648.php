<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617082648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE capitulos_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE fases_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE lista_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tipo_lista_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE capitulos (id INT NOT NULL, fases_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6622F4586289A506 ON capitulos (fases_id)');
        $this->addSql('CREATE TABLE fases (id INT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE lista (id INT NOT NULL, capitulos_id INT DEFAULT NULL, tipo_lista_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, estado BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FB9FEEEDA15EDF03 ON lista (capitulos_id)');
        $this->addSql('CREATE INDEX IDX_FB9FEEEDB1F38C46 ON lista (tipo_lista_id)');
        $this->addSql('CREATE TABLE tipo_lista (id INT NOT NULL, capitulos_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FD237425A15EDF03 ON tipo_lista (capitulos_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE capitulos ADD CONSTRAINT FK_6622F4586289A506 FOREIGN KEY (fases_id) REFERENCES fases (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lista ADD CONSTRAINT FK_FB9FEEEDA15EDF03 FOREIGN KEY (capitulos_id) REFERENCES capitulos (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lista ADD CONSTRAINT FK_FB9FEEEDB1F38C46 FOREIGN KEY (tipo_lista_id) REFERENCES tipo_lista (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tipo_lista ADD CONSTRAINT FK_FD237425A15EDF03 FOREIGN KEY (capitulos_id) REFERENCES capitulos (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE lista DROP CONSTRAINT FK_FB9FEEEDA15EDF03');
        $this->addSql('ALTER TABLE tipo_lista DROP CONSTRAINT FK_FD237425A15EDF03');
        $this->addSql('ALTER TABLE capitulos DROP CONSTRAINT FK_6622F4586289A506');
        $this->addSql('ALTER TABLE lista DROP CONSTRAINT FK_FB9FEEEDB1F38C46');
        $this->addSql('DROP SEQUENCE capitulos_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE fases_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE lista_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tipo_lista_id_seq CASCADE');
        $this->addSql('DROP TABLE capitulos');
        $this->addSql('DROP TABLE fases');
        $this->addSql('DROP TABLE lista');
        $this->addSql('DROP TABLE tipo_lista');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
