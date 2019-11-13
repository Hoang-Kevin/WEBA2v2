<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191113082935 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, id_categorie_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_BE2DDF8C9F34925F (id_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activites (id INT AUTO_INCREMENT NOT NULL, id_personne_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, date DATE NOT NULL, cout TINYINT(1) NOT NULL, recurrence TINYINT(1) NOT NULL, valide TINYINT(1) NOT NULL, INDEX IDX_766B5EB5BA091CE5 (id_personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commenters (id INT AUTO_INCREMENT NOT NULL, id_photo_id INT DEFAULT NULL, id_personne_id INT DEFAULT NULL, commentaire VARCHAR(255) NOT NULL, INDEX IDX_FB7053082E45A019 (id_photo_id), INDEX IDX_FB705308BA091CE5 (id_personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscrires (id INT AUTO_INCREMENT NOT NULL, id_activite_id INT DEFAULT NULL, id_personne_id INT DEFAULT NULL, INDEX IDX_C3872EE6831D4546 (id_activite_id), INDEX IDX_C3872EE6BA091CE5 (id_personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, id_personne_id INT DEFAULT NULL, valide TINYINT(1) NOT NULL, INDEX IDX_35D4282CBA091CE5 (id_personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stockers (id INT AUTO_INCREMENT NOT NULL, id_produit_id INT DEFAULT NULL, id_commande_id INT DEFAULT NULL, quantite INT NOT NULL, INDEX IDX_ED44F0BAABEFE2C (id_produit_id), INDEX IDX_ED44F0B9AF8E3A3 (id_commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnes (id INT AUTO_INCREMENT NOT NULL, id_role_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, campus VARCHAR(255) NOT NULL, adressemail VARCHAR(255) NOT NULL, motdepasse VARCHAR(255) NOT NULL, INDEX IDX_2BB4FE2B89E8BDC (id_role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photos (id INT AUTO_INCREMENT NOT NULL, id_activite_id INT DEFAULT NULL, id_personne_id INT DEFAULT NULL, INDEX IDX_876E0D9831D4546 (id_activite_id), INDEX IDX_876E0D9BA091CE5 (id_personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voters (id INT AUTO_INCREMENT NOT NULL, id_activite_id INT DEFAULT NULL, id_personne_id INT DEFAULT NULL, INDEX IDX_99FAA11831D4546 (id_activite_id), INDEX IDX_99FAA11BA091CE5 (id_personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C9F34925F FOREIGN KEY (id_categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE activites ADD CONSTRAINT FK_766B5EB5BA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personnes (id)');
        $this->addSql('ALTER TABLE commenters ADD CONSTRAINT FK_FB7053082E45A019 FOREIGN KEY (id_photo_id) REFERENCES photos (id)');
        $this->addSql('ALTER TABLE commenters ADD CONSTRAINT FK_FB705308BA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personnes (id)');
        $this->addSql('ALTER TABLE inscrires ADD CONSTRAINT FK_C3872EE6831D4546 FOREIGN KEY (id_activite_id) REFERENCES activites (id)');
        $this->addSql('ALTER TABLE inscrires ADD CONSTRAINT FK_C3872EE6BA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personnes (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CBA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personnes (id)');
        $this->addSql('ALTER TABLE stockers ADD CONSTRAINT FK_ED44F0BAABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE stockers ADD CONSTRAINT FK_ED44F0B9AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE personnes ADD CONSTRAINT FK_2BB4FE2B89E8BDC FOREIGN KEY (id_role_id) REFERENCES roles (id)');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D9831D4546 FOREIGN KEY (id_activite_id) REFERENCES activites (id)');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D9BA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personnes (id)');
        $this->addSql('ALTER TABLE voters ADD CONSTRAINT FK_99FAA11831D4546 FOREIGN KEY (id_activite_id) REFERENCES activites (id)');
        $this->addSql('ALTER TABLE voters ADD CONSTRAINT FK_99FAA11BA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personnes (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE stockers DROP FOREIGN KEY FK_ED44F0BAABEFE2C');
        $this->addSql('ALTER TABLE personnes DROP FOREIGN KEY FK_2BB4FE2B89E8BDC');
        $this->addSql('ALTER TABLE inscrires DROP FOREIGN KEY FK_C3872EE6831D4546');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D9831D4546');
        $this->addSql('ALTER TABLE voters DROP FOREIGN KEY FK_99FAA11831D4546');
        $this->addSql('ALTER TABLE stockers DROP FOREIGN KEY FK_ED44F0B9AF8E3A3');
        $this->addSql('ALTER TABLE activites DROP FOREIGN KEY FK_766B5EB5BA091CE5');
        $this->addSql('ALTER TABLE commenters DROP FOREIGN KEY FK_FB705308BA091CE5');
        $this->addSql('ALTER TABLE inscrires DROP FOREIGN KEY FK_C3872EE6BA091CE5');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CBA091CE5');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D9BA091CE5');
        $this->addSql('ALTER TABLE voters DROP FOREIGN KEY FK_99FAA11BA091CE5');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C9F34925F');
        $this->addSql('ALTER TABLE commenters DROP FOREIGN KEY FK_FB7053082E45A019');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE activites');
        $this->addSql('DROP TABLE commenters');
        $this->addSql('DROP TABLE inscrires');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE stockers');
        $this->addSql('DROP TABLE personnes');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE photos');
        $this->addSql('DROP TABLE voters');
    }
}
