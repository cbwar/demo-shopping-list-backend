<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221217191530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial migration';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shopping_list (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shopping_list_item (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, list_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_4FB1C2244584665A (product_id), INDEX IDX_4FB1C2243DAE168B (list_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shopping_list_item ADD CONSTRAINT FK_4FB1C2244584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE shopping_list_item ADD CONSTRAINT FK_4FB1C2243DAE168B FOREIGN KEY (list_id) REFERENCES shopping_list (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE shopping_list_item DROP FOREIGN KEY FK_4FB1C2244584665A');
        $this->addSql('ALTER TABLE shopping_list_item DROP FOREIGN KEY FK_4FB1C2243DAE168B');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE shopping_list');
        $this->addSql('DROP TABLE shopping_list_item');
    }
}
