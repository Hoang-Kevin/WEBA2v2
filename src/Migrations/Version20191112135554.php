<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191112135554 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stocker (id INT AUTO_INCREMENT NOT NULL, id_produit_id INT DEFAULT NULL, id_commande_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_AD495DAABEFE2C (id_produit_id), INDEX IDX_AD495D9AF8E3A3 (id_commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscrire (id INT AUTO_INCREMENT NOT NULL, id_activite_id INT NOT NULL, id_personne_id INT NOT NULL, INDEX IDX_84CA37A8831D4546 (id_activite_id), INDEX IDX_84CA37A8BA091CE5 (id_personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, id_categorie_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_29A5EC279F34925F (id_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activite (id INT AUTO_INCREMENT NOT NULL, id_personne_id INT NOT NULL, id_photo_id INT NOT NULL, description VARCHAR(255) NOT NULL, date DATE NOT NULL, cout TINYINT(1) NOT NULL, recurrence TINYINT(1) NOT NULL, valide TINYINT(1) NOT NULL, INDEX IDX_B8755515BA091CE5 (id_personne_id), INDEX IDX_B87555152E45A019 (id_photo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, id_personne_id INT NOT NULL, id_activite_id INT NOT NULL, urlphoto VARCHAR(255) NOT NULL, INDEX IDX_14B78418BA091CE5 (id_personne_id), INDEX IDX_14B78418831D4546 (id_activite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, id_personne_id INT NOT NULL, valide TINYINT(1) NOT NULL, INDEX IDX_6EEAA67DBA091CE5 (id_personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voter (id INT AUTO_INCREMENT NOT NULL, id_activite_id INT DEFAULT NULL, id_personne_id INT NOT NULL, INDEX IDX_268C4A59831D4546 (id_activite_id), INDEX IDX_268C4A59BA091CE5 (id_personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, id_role_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, campus VARCHAR(255) NOT NULL, adressemail VARCHAR(255) NOT NULL, motdepasse VARCHAR(255) NOT NULL, INDEX IDX_FCEC9EF89E8BDC (id_role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commenter (id INT AUTO_INCREMENT NOT NULL, id_personne_id INT NOT NULL, commentaire VARCHAR(255) NOT NULL, INDEX IDX_AB751D0ABA091CE5 (id_personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stocker ADD CONSTRAINT FK_AD495DAABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE stocker ADD CONSTRAINT FK_AD495D9AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE inscrire ADD CONSTRAINT FK_84CA37A8831D4546 FOREIGN KEY (id_activite_id) REFERENCES activite (id)');
        $this->addSql('ALTER TABLE inscrire ADD CONSTRAINT FK_84CA37A8BA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC279F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B8755515BA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B87555152E45A019 FOREIGN KEY (id_photo_id) REFERENCES photo (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418BA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418831D4546 FOREIGN KEY (id_activite_id) REFERENCES activite (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DBA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE voter ADD CONSTRAINT FK_268C4A59831D4546 FOREIGN KEY (id_activite_id) REFERENCES activite (id)');
        $this->addSql('ALTER TABLE voter ADD CONSTRAINT FK_268C4A59BA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF89E8BDC FOREIGN KEY (id_role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE commenter ADD CONSTRAINT FK_AB751D0ABA091CE5 FOREIGN KEY (id_personne_id) REFERENCES personne (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC279F34925F');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF89E8BDC');
        $this->addSql('ALTER TABLE stocker DROP FOREIGN KEY FK_AD495DAABEFE2C');
        $this->addSql('ALTER TABLE inscrire DROP FOREIGN KEY FK_84CA37A8831D4546');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418831D4546');
        $this->addSql('ALTER TABLE voter DROP FOREIGN KEY FK_268C4A59831D4546');
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B87555152E45A019');
        $this->addSql('ALTER TABLE stocker DROP FOREIGN KEY FK_AD495D9AF8E3A3');
        $this->addSql('ALTER TABLE inscrire DROP FOREIGN KEY FK_84CA37A8BA091CE5');
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B8755515BA091CE5');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418BA091CE5');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DBA091CE5');
        $this->addSql('ALTER TABLE voter DROP FOREIGN KEY FK_268C4A59BA091CE5');
        $this->addSql('ALTER TABLE commenter DROP FOREIGN KEY FK_AB751D0ABA091CE5');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE stocker');
        $this->addSql('DROP TABLE inscrire');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE activite');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE voter');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE commenter');
    }
}
