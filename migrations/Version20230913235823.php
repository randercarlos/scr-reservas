<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230913235823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tb_hospede (id_hospede INT AUTO_INCREMENT NOT NULL, nm_titulo VARCHAR(10) NOT NULL, nm_hospede VARCHAR(100) NOT NULL, de_email VARCHAR(100) NOT NULL, de_endereco VARCHAR(250) NOT NULL, de_cep VARCHAR(8) NOT NULL, de_cidade VARCHAR(100) NOT NULL, de_estado VARCHAR(2) NOT NULL, UNIQUE INDEX UNIQ_458B2ED34652321 (de_email), PRIMARY KEY(id_hospede)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tb_quarto (id_quarto INT AUTO_INCREMENT NOT NULL, nm_quarto VARCHAR(20) NOT NULL, de_andar VARCHAR(15) NOT NULL, de_quarto VARCHAR(200) DEFAULT NULL, UNIQUE INDEX UNIQ_BFE8E5575F263F14 (nm_quarto), PRIMARY KEY(id_quarto)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tb_reserva (id_reserva INT AUTO_INCREMENT NOT NULL, fk_quarto INT DEFAULT NULL, dt_entrada DATE NOT NULL, dt_saida DATE NOT NULL, INDEX IDX_675AF4992291948B (fk_quarto), PRIMARY KEY(id_reserva)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tb_reserva ADD CONSTRAINT FK_675AF4992291948B FOREIGN KEY (fk_quarto) REFERENCES tb_quarto (id_quarto)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tb_reserva DROP FOREIGN KEY FK_675AF4992291948B');
        $this->addSql('DROP TABLE tb_hospede');
        $this->addSql('DROP TABLE tb_quarto');
        $this->addSql('DROP TABLE tb_reserva');
    }
}
