<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130105219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users ADD groupe_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E92AE95007 FOREIGN KEY (groupe_id_id) REFERENCES groupes (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E92AE95007 ON users (groupe_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E92AE95007');
        $this->addSql('DROP INDEX IDX_1483A5E92AE95007 ON users');
        $this->addSql('ALTER TABLE users DROP groupe_id_id');
    }
}
