<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210618070748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE home_brew (id INT AUTO_INCREMENT NOT NULL, made_by_id INT NOT NULL, name VARCHAR(255) NOT NULL, glass VARCHAR(255) NOT NULL, instructions VARCHAR(255) NOT NULL, ingredients_and_measurements LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_10D3961890B9D269 (made_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE home_brew ADD CONSTRAINT FK_10D3961890B9D269 FOREIGN KEY (made_by_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE home_brew');
    }
}
