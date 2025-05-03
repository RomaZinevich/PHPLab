<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250503094209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE doctor_patient (patient_id INTEGER NOT NULL, doctor_id INTEGER NOT NULL, PRIMARY KEY(patient_id, doctor_id), CONSTRAINT FK_8977B4466B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8977B44687F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8977B4466B899279 ON doctor_patient (patient_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8977B44687F4FB17 ON doctor_patient (doctor_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE doctor_patient
        SQL);
    }
}
