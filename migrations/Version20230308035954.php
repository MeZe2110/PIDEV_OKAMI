<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308035954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql(" INSERT INTO `vehicules` (`id`, `nomvh`, `dispovh`, `etatvh`, `descvh`, `imagesvh`, `date`, `Categoriesvehicules`) VALUES
        (DEFAULT, 4, 'Ambulance C.1', 'fonctionnelle', 'Véhicule de catégorie C : Ambulance', '64068c1f7c0d3.jpg', '2023-03-01 13:44:00', 2),
        (DEFAULT, 1, 'Ambulance A.1', 'non fonctionnelle', 'Véhicule de catégorie A : Ambulance de secours et de soins d\'urgence (ASSU)', '64068c4876c96.jpg', '2023-03-02 13:50:00', 1),
        (DEFAULT, 2, 'Ambulance B.1', 'fonctionnelle', 'Véhicule de catégorie B : Voiture de secours aux asphyxiés et blessés (VSAB)', '64068c8968fd4.jpg', '2023-02-27 18:04:00', 2),
        (DEFAULT, 2, 'Ambulance B.2', 'fonctionnelle', 'Véhicule de catégorie B : Voiture de secours aux asphyxiés et blessés (VSAB)', '64068ca3442fa.jpg', '2023-03-01 16:08:00', 2),
        (DEFAULT, 4, 'Ambulance C.2', 'fonctionnelle', 'Véhicule de catégorie C : Ambulance', '64068cb81baf2.jpg', '2023-02-06 00:37:00', 2),
        (DEFAULT, 1, 'Ambulance A.2', 'fonctionnelle', 'Véhicule de catégorie A : Ambulance de secours et de soins d\'urgence (ASSU)', '64068cd5ab0cf.jpg', '2023-03-02 12:20:00', 2),
        (DEFAULT, 1, 'Ambulance A.3', 'fonctionnelle', 'Véhicule de catégorie A : Ambulance de secours et de soins d\'urgence (ASSU)', '64068cec71874.jpg', '2023-03-01 12:57:00', 2),
        (DEFAULT, 1, 'Ambulance A.4', 'fonctionnelle', 'Véhicule de catégorie A : Ambulance de secours et de soins d\'urgence (ASSU)', '64068d147c57b.jpg', '2023-03-03 12:58:00', 2),
        (DEFAULT, 2, 'Ambulance B.3', 'fonctionnelle', 'Véhicule de catégorie B : Voiture de secours aux asphyxiés et blessés (VSAB)', '64068d44c660d.jpg', '2023-03-06 00:32:00', 2),
        (DEFAULT, 4, 'Ambulance C.3', 'non fonctionnelle', 'Véhicule de catégorie C : Ambulance', '64068d59bd02f.jpg', '2023-03-07 00:36:00', 1); ");

        $this->addSql(" INSERT INTO `stock` (`id`, `nomst`, `description`, `dateexpirationst`, `quantites`, `Stockcategories`) VALUES
        (DEFAULT, 'Aspirine', 'utilisé pour réduire la douleur, la fièvre et / ou l’inflammation, et comme antithrombotique. Les conditions inflammatoires spécifiques que l’aspirine est utilisée pour traiter comprennent la maladie de Kawasaki, la péricardite et la fièvre rhumatismale.', '2023-03-04', 5, 3),
        (DEFAULT, 'Omeprazole', 'utilisé en association avec des antibiotiques (par exemple, amoxicilline, clarithromycine) pour traiter les ulcères associés à l’infection causée par la bactérie H. pylori.', '2027-10-13', 251, 4),
        (DEFAULT, 'Simvastatine', 'est utilisée pour abaisser les taux sanguins de « mauvais » cholestérol (lipoprotéines de basse densité, ou LDL), pour augmenter les niveaux de « bon » cholestérol (lipoprotéines de haute densité, ou HDL) et pour abaisser les triglycérides (un type de gr', '2025-06-21', 320, 5),
        (DEFAULT, 'Metformine', 'utilisé avec un régime alimentaire pour abaisser les taux élevés de sucre dans le sang chez les patients atteints de diabète de type 2. La metformine agit en réduisant la quantité de glucose absorbée par les intestins, en diminuant la quantité de glucose', '2027-06-09', 110, 6),
        (DEFAULT, 'Insuline', 'une hormone peptidique contenant deux chaînes réticulées par des ponts disulfures. L’insuline (/ ˈɪn.sjʊ.lɪn /, du latin insula, « île ») est une hormone peptidique produite par les cellules bêta des îlots pancréatiques codées chez l’homme par le gène INS', '2025-10-22', 50, 7),
        (DEFAULT, 'Lévothyroxine', 'est utilisé pour traiter le déficit en hormones thyroïdiennes (hypothyroïdie), y compris une forme sévère connue sous le nom de coma myxœdème. Il peut également être utilisé pour traiter et prévenir certains types de tumeurs thyroïdiennes.', '2024-10-16', 45, 8),
        (DEFAULT, 'Diazépam', 'est utilisé pour traiter le déficit en hormones thyroïdiennes (hypothyroïdie), y compris une forme sévère connue sous le nom de coma myxœdème. Il peut également être utilisé pour traiter et prévenir certains types de tumeurs thyroïdiennes.', '2026-10-21', 781, 9),
        (DEFAULT, 'Céfalexine', 'est un inhibiteur de la pompe à protons qui diminue la quantité d’acide produite dans l’estomac. L’oméprazole est utilisé pour traiter les symptômes du reflux gastro-œsophagien pathologique (RGO) et d’autres affections causées par un excès d’acide gastriq', '2026-10-21', 42, 10),
        (DEFAULT, 'panadol', 'est utilisé pour réduire la fièvre et soulager la douleur, y compris les maux de dents, les maux de tête, la migraine, les douleurs musculaires, la douleur', '2026-06-21', 126, 2),
        (DEFAULT, 'doliprane', 'médicament de douleur', '2023-03-06', 556, 3); ");

        $this->addSql(" INSERT INTO `plannification` (`id`, `salle`, `datepl`, `heuredebutpl`, `heurefinpl`) VALUES 
        (DEFAULT, '1', '2023-03-09', '12:30:00', '15:00:00'), 
        (DEFAULT, '3', '2023-03-10', '12:30:00', '16:00:00'), 
        (DEFAULT, '1', '2023-03-12', '11:00:00', '12:00:00'), 
        (DEFAULT, '7', '2023-03-11', '15:30:00', '17:00:00'), 
        (DEFAULT, '5', '2023-03-20', '10:30:00', '12:00:00'), 
        (DEFAULT, '3', '2023-03-15', '8:30:00', '12:00:00'); ");

        $this->addSql(" INSERT INTO equipement (id, nomeq, etateq, dispoeq, Categoriesequipement) VALUES 
        (DEFAULT, 'Pèse personne mécanique Classe IV', '1', '1', '1'), 
        (DEFAULT, 'Doigtiers', '1', '0', '4'), 
        (DEFAULT, 'Ote-agrafes', '1', '1', '5'), 
        (DEFAULT, 'Sabots', '0', '0', '8'), 
        (DEFAULT, 'Station murale de diagnostic', '0', '1', '2'), 
        (DEFAULT, 'Marchepied', '1', '1', '3'), 
        (DEFAULT, 'Accessoires de diagnostic', '1', '0', '8'), 
        (DEFAULT, 'Désinfection des surfaces', '1', '1', '4'), 
        (DEFAULT, 'Electrocardiographe', '1', '1', '1'), 
        (DEFAULT, 'Tampon alcool 70° injection', '0', '0', '6'); ");

        $this->addSql(" INSERT INTO user (id, role_id, email, password, nom, prenom, is_verified) VALUES 
        (DEFAULT, '1', 'aziz.hannachi@gmail.com', '1234', 'hannachi', 'aziz', '1'), 
        (DEFAULT, '1', 'mahmoud.jebali@gmail.com', '1324', 'jebali', 'mahmoud', '1'), 
        (DEFAULT, '2', 'sana.saadallah@gmail.com', '1234', 'saadallah', 'sana', '1'), 
        (DEFAULT, '2', 'haythem.louati@gmail.com', '1234', 'louati', 'haythem', '1'), 
        (DEFAULT, '3', 'ines.bezine@gmail.com', '1234', 'bezine', 'ines', '1'), 
        (DEFAULT, '3', 'Taher.rejeb@gmail.com', '1342', 'rejeb', 'taher', '0'), 
        (DEFAULT, '3', 'dorra.bejaoui@gmail.com', '1234', 'bejaoui', 'dorra', '0'); ");

        $this->addSql(" INSERT INTO `rendezvous` (`id`, `daterv`, `rappel`, `end_at`, `Salle`, `Type`) VALUES 
        (DEFAULT, '2023-03-09 12:00:00', '1', '2023-03-09 15:00:00', '1', '1'), 
        (DEFAULT, '2023-03-09 12:00:00', '1', '2023-03-09 15:00:00', '2', '1'), 
        (DEFAULT, '2023-03-09 12:00:00', '1', '2023-03-09 16:00:00', '3', '3'), 
        (DEFAULT, '2023-03-09 15:00:00', '1', '2023-03-09 18:00:00', '5', '2'), 
        (DEFAULT, '2023-03-10 08:30:00', '1', '2023-03-10 12:00:00', '7', '1'), 
        (DEFAULT, '2023-03-10 08:30:00', '1', '2023-03-10 09:30:00', '3', '3'), 
        (DEFAULT, '2023-03-10 08:30:00', '1', '2023-03-10 09:30:00', '5', '2'), 
        (DEFAULT, '2023-03-10 09:30:00', '1', '2023-03-10 12:30:00', '4', '3'), 
        (DEFAULT, '2023-03-10 15:00:00', '1', '2023-03-10 17:30:00', '6', '5'), 
        (DEFAULT, '2023-03-12 10:30:00', '1', '2023-03-12 15:00:00', '10', '5'), 
        (DEFAULT, '2023-03-16 12:00:00', '1', '2023-03-16 13:00:00', '1', '4'), 
        (DEFAULT, '2023-03-16 12:00:00', '1', '2023-03-16 15:00:00', '3', '2'); ");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
