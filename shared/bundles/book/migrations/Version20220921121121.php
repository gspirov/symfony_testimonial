<?php

declare(strict_types=1);

namespace App\Shared\Bundles\Book\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220921121121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            <<<SQL
                CREATE SEQUENCE book_id_seq INCREMENT BY 1 MINVALUE 1 START 1;
SQL
        );

        $this->addSql(
            <<<SQL
                CREATE TYPE discriminator_context AS ENUM ('api', 'admin');
SQL
        );

        $this->addSql(
            <<<SQL
                CREATE TABLE book (
                    id INT NOT NULL, 
                    uuid UUID NOT NULL, 
                    discriminator discriminator_context NOT NULL,
                    name VARCHAR(55) NOT NULL, 
                    description VARCHAR(255) NOT NULL, 
                    created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, 
                    updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, 
                    PRIMARY KEY(id)
                );
SQL
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE book_id_seq CASCADE');
        $this->addSql('DROP TABLE book');
    }
}
