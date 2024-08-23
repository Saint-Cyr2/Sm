<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240821142606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item_movement (item_id INTEGER NOT NULL, movement_id INTEGER NOT NULL, PRIMARY KEY(item_id, movement_id), CONSTRAINT FK_98D05D3C126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_98D05D3C229E70A7 FOREIGN KEY (movement_id) REFERENCES movement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_98D05D3C126F525E ON item_movement (item_id)');
        $this->addSql('CREATE INDEX IDX_98D05D3C229E70A7 ON item_movement (movement_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__item AS SELECT id, name, created_at FROM item');
        $this->addSql('DROP TABLE item');
        $this->addSql('CREATE TABLE item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, item_type_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_1F1B251ECE11AAC7 FOREIGN KEY (item_type_id) REFERENCES item_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO item (id, name, created_at) SELECT id, name, created_at FROM __temp__item');
        $this->addSql('DROP TABLE __temp__item');
        $this->addSql('CREATE INDEX IDX_1F1B251ECE11AAC7 ON item (item_type_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__item_type AS SELECT id, name, serial_number FROM item_type');
        $this->addSql('DROP TABLE item_type');
        $this->addSql('CREATE TABLE item_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, asset_category_id INTEGER DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, serial_number VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_44EE13D2993EC4EB FOREIGN KEY (asset_category_id) REFERENCES asset_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO item_type (id, name, serial_number) SELECT id, name, serial_number FROM __temp__item_type');
        $this->addSql('DROP TABLE __temp__item_type');
        $this->addSql('CREATE INDEX IDX_44EE13D2993EC4EB ON item_type (asset_category_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__item_type_quantity AS SELECT id, value, created_at, updated_at FROM item_type_quantity');
        $this->addSql('DROP TABLE item_type_quantity');
        $this->addSql('CREATE TABLE item_type_quantity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, item_type_id INTEGER DEFAULT NULL, ware_house_id INTEGER DEFAULT NULL, value INTEGER NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_BEA09911CE11AAC7 FOREIGN KEY (item_type_id) REFERENCES item_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BEA0991149FA2CE4 FOREIGN KEY (ware_house_id) REFERENCES ware_house (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO item_type_quantity (id, value, created_at, updated_at) SELECT id, value, created_at, updated_at FROM __temp__item_type_quantity');
        $this->addSql('DROP TABLE __temp__item_type_quantity');
        $this->addSql('CREATE INDEX IDX_BEA09911CE11AAC7 ON item_type_quantity (item_type_id)');
        $this->addSql('CREATE INDEX IDX_BEA0991149FA2CE4 ON item_type_quantity (ware_house_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__item_use AS SELECT id, sr, docu_sign_number, created_at FROM item_use');
        $this->addSql('DROP TABLE item_use');
        $this->addSql('CREATE TABLE item_use (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, site_id INTEGER DEFAULT NULL, sr VARCHAR(255) DEFAULT NULL, docu_sign_number VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, CONSTRAINT FK_73A4B779F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO item_use (id, sr, docu_sign_number, created_at) SELECT id, sr, docu_sign_number, created_at FROM __temp__item_use');
        $this->addSql('DROP TABLE __temp__item_use');
        $this->addSql('CREATE INDEX IDX_73A4B779F6BD1646 ON item_use (site_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE item_movement');
        $this->addSql('CREATE TEMPORARY TABLE __temp__item AS SELECT id, name, created_at FROM item');
        $this->addSql('DROP TABLE item');
        $this->addSql('CREATE TABLE item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO item (id, name, created_at) SELECT id, name, created_at FROM __temp__item');
        $this->addSql('DROP TABLE __temp__item');
        $this->addSql('CREATE TEMPORARY TABLE __temp__item_type AS SELECT id, name, serial_number FROM item_type');
        $this->addSql('DROP TABLE item_type');
        $this->addSql('CREATE TABLE item_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, serial_number VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO item_type (id, name, serial_number) SELECT id, name, serial_number FROM __temp__item_type');
        $this->addSql('DROP TABLE __temp__item_type');
        $this->addSql('CREATE TEMPORARY TABLE __temp__item_type_quantity AS SELECT id, value, created_at, updated_at FROM item_type_quantity');
        $this->addSql('DROP TABLE item_type_quantity');
        $this->addSql('CREATE TABLE item_type_quantity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, value INTEGER NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO item_type_quantity (id, value, created_at, updated_at) SELECT id, value, created_at, updated_at FROM __temp__item_type_quantity');
        $this->addSql('DROP TABLE __temp__item_type_quantity');
        $this->addSql('CREATE TEMPORARY TABLE __temp__item_use AS SELECT id, sr, docu_sign_number, created_at FROM item_use');
        $this->addSql('DROP TABLE item_use');
        $this->addSql('CREATE TABLE item_use (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, sr VARCHAR(255) DEFAULT NULL, docu_sign_number VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO item_use (id, sr, docu_sign_number, created_at) SELECT id, sr, docu_sign_number, created_at FROM __temp__item_use');
        $this->addSql('DROP TABLE __temp__item_use');
    }
}
