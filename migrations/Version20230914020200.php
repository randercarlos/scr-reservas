<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230914020200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tb_reserva ADD fk_hospede INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tb_reserva ADD CONSTRAINT FK_675AF4998BA05563 FOREIGN KEY (fk_hospede) REFERENCES tb_hospede (id_hospede)');
        $this->addSql('CREATE INDEX IDX_675AF4998BA05563 ON tb_reserva (fk_hospede)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tb_reserva DROP FOREIGN KEY FK_675AF4998BA05563');
        $this->addSql('DROP INDEX IDX_675AF4998BA05563 ON tb_reserva');
        $this->addSql('ALTER TABLE tb_reserva DROP fk_hospede');
    }
}
