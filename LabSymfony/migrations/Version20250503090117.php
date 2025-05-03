<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250503090117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE appointment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, patient_id INTEGER DEFAULT NULL, doctor_id INTEGER DEFAULT NULL, appointment_time DATETIME NOT NULL, CONSTRAINT FK_FE38F8446B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_FE38F84487F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FE38F8446B899279 ON appointment (patient_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_FE38F84487F4FB17 ON appointment (doctor_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE diagnosis (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, appointment_id INTEGER DEFAULT NULL, description CLOB NOT NULL, CONSTRAINT FK_7ED10F3DE5B533F9 FOREIGN KEY (appointment_id) REFERENCES appointment (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7ED10F3DE5B533F9 ON diagnosis (appointment_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE doctor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, specialization VARCHAR(255) NOT NULL, phone VARCHAR(20) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE patient (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, gender VARCHAR(10) NOT NULL, phone VARCHAR(20) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE treatment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, diagnosis_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, instructions CLOB DEFAULT NULL, CONSTRAINT FK_98013C313CBE4D00 FOREIGN KEY (diagnosis_id) REFERENCES diagnosis (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_98013C313CBE4D00 ON treatment (diagnosis_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
            )
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE appointment
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE diagnosis
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE doctor
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE patient
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE treatment
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
