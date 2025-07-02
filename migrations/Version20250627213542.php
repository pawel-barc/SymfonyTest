<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250627213542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" ADD lastname VARCHAR(40) NOT NULL DEFAULT 'Unknown'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" ADD roles JSON NOT NULL  DEFAULT '[]'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" RENAME COLUMN name TO firstname
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" DROP lastname
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" DROP roles
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE "user" RENAME COLUMN firstname TO name
        SQL);
    }
}
