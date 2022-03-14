<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220314080029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accounts (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, account_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orderdetail (id INT AUTO_INCREMENT NOT NULL, id_order_id INT NOT NULL, id_product_id INT NOT NULL, price INT NOT NULL, quantity INT NOT NULL, total INT NOT NULL, INDEX IDX_27A0E7F2DD4481AD (id_order_id), INDEX IDX_27A0E7F2E00EE68D (id_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, id_account_id INT NOT NULL, date DATE NOT NULL, delivery VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, total INT NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_E52FFDEE3EE1DF6D (id_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, product_name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, images VARCHAR(255) NOT NULL, price INT NOT NULL, quantity INT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profiles (id INT AUTO_INCREMENT NOT NULL, id_account_id INT NOT NULL, fullname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, dob DATE NOT NULL, UNIQUE INDEX UNIQ_8B3085303EE1DF6D (id_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orderdetail ADD CONSTRAINT FK_27A0E7F2DD4481AD FOREIGN KEY (id_order_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orderdetail ADD CONSTRAINT FK_27A0E7F2E00EE68D FOREIGN KEY (id_product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE3EE1DF6D FOREIGN KEY (id_account_id) REFERENCES accounts (id)');
        $this->addSql('ALTER TABLE profiles ADD CONSTRAINT FK_8B3085303EE1DF6D FOREIGN KEY (id_account_id) REFERENCES accounts (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE3EE1DF6D');
        $this->addSql('ALTER TABLE profiles DROP FOREIGN KEY FK_8B3085303EE1DF6D');
        $this->addSql('ALTER TABLE orderdetail DROP FOREIGN KEY FK_27A0E7F2DD4481AD');
        $this->addSql('ALTER TABLE orderdetail DROP FOREIGN KEY FK_27A0E7F2E00EE68D');
        $this->addSql('DROP TABLE accounts');
        $this->addSql('DROP TABLE orderdetail');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE profiles');
    }
}
