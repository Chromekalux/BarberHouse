<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220828101436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agenda (id INT AUTO_INCREMENT NOT NULL, owner_type VARCHAR(255) NOT NULL, owner_id INT DEFAULT NULL, INDEX IDX_2CEDC8777E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE agenda_event (agenda_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_6B965E39EA67784A (agenda_id), INDEX IDX_6B965E3971F7E88B (event_id), PRIMARY KEY(agenda_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, description VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_image (article_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_B28A764E7294869C (article_id), INDEX IDX_B28A764E3DA5256D (image_id), PRIMARY KEY(article_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE catalogue (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE catalogue_image (catalogue_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_DD2176EE4A7843DC (catalogue_id), INDEX IDX_DD2176EE3DA5256D (image_id), PRIMARY KEY(catalogue_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE catalogue_article (catalogue_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_41EF99934A7843DC (catalogue_id), INDEX IDX_41EF99937294869C (article_id), PRIMARY KEY(catalogue_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, user_id INT NOT NULL, text VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9474526C4B89032C (post_id), INDEX IDX_9474526CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, occurs_on DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', details VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, salon_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_5A8A6C8DA76ED395 (user_id), INDEX IDX_5A8A6C8D4C91BDE4 (salon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_image (post_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_522688B04B89032C (post_id), INDEX IDX_522688B03DA5256D (image_id), PRIMARY KEY(post_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salon (id INT AUTO_INCREMENT NOT NULL, catalogue_id INT DEFAULT NULL, owner_id INT NOT NULL, agenda_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slogan VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, country VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, created_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', UNIQUE INDEX UNIQ_F268F4174A7843DC (catalogue_id), INDEX IDX_F268F4177E3C61F9 (owner_id), UNIQUE INDEX UNIQ_F268F417EA67784A (agenda_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription_plan (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, duration VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\', price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transfer (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, receiver_id INT NOT NULL, amount DOUBLE PRECISION NOT NULL, currency VARCHAR(255) NOT NULL, payment_method VARCHAR(255) NOT NULL, message VARCHAR(255) DEFAULT NULL, INDEX IDX_4034A3C0F624B39D (sender_id), INDEX IDX_4034A3C0CD53EDB6 (receiver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transfer_account (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, owner_salon_id INT DEFAULT NULL, provider VARCHAR(255) NOT NULL, identifier VARCHAR(255) NOT NULL, INDEX IDX_C28324EF7E3C61F9 (owner_id), INDEX IDX_C28324EF5A710427 (owner_salon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, profile_photo_id INT DEFAULT NULL, managed_salon_id INT DEFAULT NULL, working_salon_id INT DEFAULT NULL, subscription_plan_id INT NOT NULL, agenda_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone INT DEFAULT NULL, country VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, city VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', born_on DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', role VARCHAR(255) NOT NULL, subscription_payment_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), INDEX IDX_8D93D64987F42D3D (profile_photo_id), INDEX IDX_8D93D649924B342F (managed_salon_id), INDEX IDX_8D93D6493A938CD6 (working_salon_id), INDEX IDX_8D93D6499B8CE200 (subscription_plan_id), UNIQUE INDEX UNIQ_8D93D649EA67784A (agenda_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agenda_event ADD CONSTRAINT FK_6B965E39EA67784A FOREIGN KEY (agenda_id) REFERENCES agenda (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE agenda_event ADD CONSTRAINT FK_6B965E3971F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_image ADD CONSTRAINT FK_B28A764E7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_image ADD CONSTRAINT FK_B28A764E3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE catalogue_image ADD CONSTRAINT FK_DD2176EE4A7843DC FOREIGN KEY (catalogue_id) REFERENCES catalogue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE catalogue_image ADD CONSTRAINT FK_DD2176EE3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE catalogue_article ADD CONSTRAINT FK_41EF99934A7843DC FOREIGN KEY (catalogue_id) REFERENCES catalogue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE catalogue_article ADD CONSTRAINT FK_41EF99937294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D4C91BDE4 FOREIGN KEY (salon_id) REFERENCES salon (id)');
        $this->addSql('ALTER TABLE post_image ADD CONSTRAINT FK_522688B04B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_image ADD CONSTRAINT FK_522688B03DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salon ADD CONSTRAINT FK_F268F4174A7843DC FOREIGN KEY (catalogue_id) REFERENCES catalogue (id)');
        $this->addSql('ALTER TABLE salon ADD CONSTRAINT FK_F268F4177E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE salon ADD CONSTRAINT FK_F268F417EA67784A FOREIGN KEY (agenda_id) REFERENCES agenda (id)');
        $this->addSql('ALTER TABLE transfer ADD CONSTRAINT FK_4034A3C0F624B39D FOREIGN KEY (sender_id) REFERENCES transfer_account (id)');
        $this->addSql('ALTER TABLE transfer ADD CONSTRAINT FK_4034A3C0CD53EDB6 FOREIGN KEY (receiver_id) REFERENCES transfer_account (id)');
        $this->addSql('ALTER TABLE transfer_account ADD CONSTRAINT FK_C28324EF7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transfer_account ADD CONSTRAINT FK_C28324EF5A710427 FOREIGN KEY (owner_salon_id) REFERENCES salon (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64987F42D3D FOREIGN KEY (profile_photo_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649924B342F FOREIGN KEY (managed_salon_id) REFERENCES salon (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493A938CD6 FOREIGN KEY (working_salon_id) REFERENCES salon (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499B8CE200 FOREIGN KEY (subscription_plan_id) REFERENCES subscription_plan (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649EA67784A FOREIGN KEY (agenda_id) REFERENCES agenda (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agenda_event DROP FOREIGN KEY FK_6B965E39EA67784A');
        $this->addSql('ALTER TABLE agenda_event DROP FOREIGN KEY FK_6B965E3971F7E88B');
        $this->addSql('ALTER TABLE article_image DROP FOREIGN KEY FK_B28A764E7294869C');
        $this->addSql('ALTER TABLE article_image DROP FOREIGN KEY FK_B28A764E3DA5256D');
        $this->addSql('ALTER TABLE catalogue_image DROP FOREIGN KEY FK_DD2176EE4A7843DC');
        $this->addSql('ALTER TABLE catalogue_image DROP FOREIGN KEY FK_DD2176EE3DA5256D');
        $this->addSql('ALTER TABLE catalogue_article DROP FOREIGN KEY FK_41EF99934A7843DC');
        $this->addSql('ALTER TABLE catalogue_article DROP FOREIGN KEY FK_41EF99937294869C');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4B89032C');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA76ED395');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D4C91BDE4');
        $this->addSql('ALTER TABLE post_image DROP FOREIGN KEY FK_522688B04B89032C');
        $this->addSql('ALTER TABLE post_image DROP FOREIGN KEY FK_522688B03DA5256D');
        $this->addSql('ALTER TABLE salon DROP FOREIGN KEY FK_F268F4174A7843DC');
        $this->addSql('ALTER TABLE salon DROP FOREIGN KEY FK_F268F4177E3C61F9');
        $this->addSql('ALTER TABLE salon DROP FOREIGN KEY FK_F268F417EA67784A');
        $this->addSql('ALTER TABLE transfer DROP FOREIGN KEY FK_4034A3C0F624B39D');
        $this->addSql('ALTER TABLE transfer DROP FOREIGN KEY FK_4034A3C0CD53EDB6');
        $this->addSql('ALTER TABLE transfer_account DROP FOREIGN KEY FK_C28324EF7E3C61F9');
        $this->addSql('ALTER TABLE transfer_account DROP FOREIGN KEY FK_C28324EF5A710427');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64987F42D3D');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649924B342F');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493A938CD6');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499B8CE200');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649EA67784A');
        $this->addSql('DROP TABLE agenda');
        $this->addSql('DROP TABLE agenda_event');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_image');
        $this->addSql('DROP TABLE catalogue');
        $this->addSql('DROP TABLE catalogue_image');
        $this->addSql('DROP TABLE catalogue_article');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE post_image');
        $this->addSql('DROP TABLE salon');
        $this->addSql('DROP TABLE subscription_plan');
        $this->addSql('DROP TABLE transfer');
        $this->addSql('DROP TABLE transfer_account');
        $this->addSql('DROP TABLE user');
    }
}
