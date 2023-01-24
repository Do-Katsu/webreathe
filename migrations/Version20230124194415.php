<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124194415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consommations (id INT AUTO_INCREMENT NOT NULL, mesure_id INT DEFAULT NULL, valeur DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_232F9E3F43AB22FA (mesure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mesures (id INT AUTO_INCREMENT NOT NULL, modules_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_4B54A55960D6DC42 (modules_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modules (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE positions (id INT AUTO_INCREMENT NOT NULL, mesure_id INT DEFAULT NULL, lat NUMERIC(8, 4) NOT NULL, lng NUMERIC(9, 4) NOT NULL, UNIQUE INDEX UNIQ_D69FE57C43AB22FA (mesure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tempratures (id INT AUTO_INCREMENT NOT NULL, mesure_id INT DEFAULT NULL, valeur DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_7DD1A0CC43AB22FA (mesure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE uptime (id INT AUTO_INCREMENT NOT NULL, modules_id INT DEFAULT NULL, date_value DATETIME NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_5D2F9A4760D6DC42 (modules_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vitesses (id INT AUTO_INCREMENT NOT NULL, mesure_id INT DEFAULT NULL, valeur DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_2EE99FBD43AB22FA (mesure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consommations ADD CONSTRAINT FK_232F9E3F43AB22FA FOREIGN KEY (mesure_id) REFERENCES mesures (id)');
        $this->addSql('ALTER TABLE mesures ADD CONSTRAINT FK_4B54A55960D6DC42 FOREIGN KEY (modules_id) REFERENCES modules (id)');
        $this->addSql('ALTER TABLE positions ADD CONSTRAINT FK_D69FE57C43AB22FA FOREIGN KEY (mesure_id) REFERENCES mesures (id)');
        $this->addSql('ALTER TABLE tempratures ADD CONSTRAINT FK_7DD1A0CC43AB22FA FOREIGN KEY (mesure_id) REFERENCES mesures (id)');
        $this->addSql('ALTER TABLE uptime ADD CONSTRAINT FK_5D2F9A4760D6DC42 FOREIGN KEY (modules_id) REFERENCES modules (id)');
        $this->addSql('ALTER TABLE vitesses ADD CONSTRAINT FK_2EE99FBD43AB22FA FOREIGN KEY (mesure_id) REFERENCES mesures (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consommations DROP FOREIGN KEY FK_232F9E3F43AB22FA');
        $this->addSql('ALTER TABLE mesures DROP FOREIGN KEY FK_4B54A55960D6DC42');
        $this->addSql('ALTER TABLE positions DROP FOREIGN KEY FK_D69FE57C43AB22FA');
        $this->addSql('ALTER TABLE tempratures DROP FOREIGN KEY FK_7DD1A0CC43AB22FA');
        $this->addSql('ALTER TABLE uptime DROP FOREIGN KEY FK_5D2F9A4760D6DC42');
        $this->addSql('ALTER TABLE vitesses DROP FOREIGN KEY FK_2EE99FBD43AB22FA');
        $this->addSql('DROP TABLE consommations');
        $this->addSql('DROP TABLE mesures');
        $this->addSql('DROP TABLE modules');
        $this->addSql('DROP TABLE positions');
        $this->addSql('DROP TABLE tempratures');
        $this->addSql('DROP TABLE uptime');
        $this->addSql('DROP TABLE vitesses');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
