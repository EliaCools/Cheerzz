-- MySQL dump 10.13  Distrib 8.0.25, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: drinky
-- ------------------------------------------------------
-- Server version	8.0.25-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `quantity` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=499 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
INSERT INTO `product` VALUES (12,'Vodka',10,700),(13,'Gin',10,700),(14,'Rum',10,700),(15,'Tequila',10,700),(16,'Scotch',10,700),(17,'Absolut Kurant',10,700),(18,'Absolut Peppar',10,700),(19,'Absolut Vodka',10,700),(20,'Advocaat',10,700),(21,'Aejo Rum',10,700),(22,'Aftershock',10,700),(23,'Agave Syrup',10,700),(24,'Ale',10,700),(25,'Allspice',10,700),(26,'Almond Flavoring',10,700),(27,'Almond',10,700),(28,'Amaretto',10,700),(29,'Angelica Root',10,700),(30,'Angostura Bitters',10,700),(31,'Anis',10,700),(32,'Anise',10,700),(33,'Anisette',10,700),(34,'Aperol',10,700),(35,'Apfelkorn',10,700),(36,'Apple Brandy',10,700),(37,'Apple Cider',10,700),(38,'Apple Juice',10,700),(39,'Apple Schnapps',10,700),(40,'Apple',10,700),(41,'Applejack',10,700),(42,'Apricot Brandy',10,700),(43,'Apricot Nectar',10,700),(44,'Apricot',10,700),(45,'Aquavit',10,700),(46,'Asafoetida',10,700),(47,'Añejo Rum',10,700),(48,'Bacardi Limon',10,700),(49,'Bacardi',10,700),(50,'Baileys Irish Cream',10,700),(51,'Banana Liqueur',10,700),(52,'Banana Rum',10,700),(53,'Banana Syrup',10,700),(54,'Banana',10,700),(55,'Barenjager',10,700),(56,'Basil',10,700),(57,'Beef Stock',10,700),(58,'Beer',10,700),(59,'Benedictine',10,700),(60,'Berries',10,700),(61,'Bitter lemon',10,700),(62,'Bitters',10,700),(63,'Black Pepper',10,700),(64,'Black Rum',10,700),(65,'Black Sambuca',10,700),(66,'Blackberries',10,700),(67,'Blackberry Brandy',10,700),(68,'Blackberry Schnapps',10,700),(69,'Blackcurrant Cordial',10,700),(70,'Blackcurrant Schnapps',10,700),(71,'Blackcurrant Squash',10,700),(72,'Blended Whiskey',10,700),(73,'Blue Curacao',10,700),(74,'Blue Maui',10,700),(75,'Blueberries',10,700),(76,'Blueberry Schnapps',10,700),(77,'Bourbon',10,700),(78,'Brandy',10,700),(79,'Brown Sugar',10,700),(80,'Butter',10,700),(81,'Butterscotch Schnapps',10,700),(82,'Cachaca',10,700),(83,'Calvados',10,700),(84,'Campari',10,700),(85,'Canadian Whisky',10,700),(86,'Candy',10,700),(87,'Cantaloupe',10,700),(88,'Caramel Coloring',10,700),(89,'Carbonated Soft Drink',10,700),(90,'Carbonated Water',10,700),(91,'Cardamom',10,700),(92,'Cayenne Pepper',10,700),(93,'Celery Salt',10,700),(94,'Celery',10,700),(95,'Chambord Raspberry Liqueur',10,700),(96,'Champagne',10,700),(97,'Cherries',10,700),(98,'Cherry Brandy',10,700),(99,'Cherry Cola',10,700),(100,'Cherry Grenadine',10,700),(101,'Cherry Heering',10,700),(102,'Cherry Juice',10,700),(103,'Cherry Liqueur',10,700),(104,'Cherry',10,700),(105,'Chocolate Ice-cream',10,700),(106,'Chocolate Liqueur',10,700),(107,'Chocolate Milk',10,700),(108,'Chocolate Syrup',10,700),(109,'Chocolate',10,700),(110,'Cider',10,700),(111,'Cinnamon Schnapps',10,700),(112,'Cinnamon',10,700),(113,'Citrus Vodka',10,700),(114,'Clamato Juice',10,700),(115,'Cloves',10,700),(116,'Club Soda',10,700),(117,'Coca-Cola',10,700),(118,'Cocktail Onion',10,700),(119,'Cocoa Powder',10,700),(120,'Coconut Cream',10,700),(121,'Coconut Liqueur',10,700),(122,'Coconut Milk',10,700),(123,'Coconut Rum',10,700),(124,'Coconut Syrup',10,700),(125,'Coffee Brandy',10,700),(126,'Coffee Liqueur',10,700),(127,'Coffee',10,700),(128,'Cognac',10,700),(129,'Cointreau',10,700),(130,'Cola',10,700),(131,'Cold Water',10,700),(132,'Condensed Milk',10,700),(133,'Coriander',10,700),(134,'Corn Syrup',10,700),(135,'Cornstarch',10,700),(136,'Corona',10,700),(137,'Cranberries',10,700),(138,'Cranberry Juice',10,700),(139,'Cranberry Liqueur',10,700),(140,'Cranberry Vodka',10,700),(141,'Cream of Coconut',10,700),(142,'Cream Sherry',10,700),(143,'Cream Soda',10,700),(144,'Cream',10,700),(145,'Creme De Almond',10,700),(146,'Creme De Banane',10,700),(147,'Creme De Cacao',10,700),(148,'Creme De Cassis',10,700),(149,'Creme De Noyaux',10,700),(150,'Creme Fraiche',10,700),(151,'Crown Royal',10,700),(152,'Crystal Light',10,700),(153,'Cucumber',10,700),(154,'Cumin Powder',10,700),(155,'Cumin Seed',10,700),(156,'Curacao',10,700),(157,'Cynar',10,700),(158,'Daiquiri Mix',10,700),(159,'Dark Chocolate',10,700),(160,'Dark Creme De Cacao',10,700),(161,'Dark Rum',10,700),(162,'Dark Soy Sauce',10,700),(163,'Demerara Sugar',10,700),(164,'Dr. Pepper',10,700),(165,'Drambuie',10,700),(166,'Dried Oregano',10,700),(167,'Dry Vermouth',10,700),(168,'Dubonnet Blanc',10,700),(169,'Dubonnet Rouge',10,700),(170,'Egg White',10,700),(171,'Egg Yolk',10,700),(172,'Egg',10,700),(173,'Eggnog',10,700),(174,'Erin Cream',10,700),(175,'Espresso',10,700),(176,'Everclear',10,700),(177,'Fanta',10,700),(178,'Fennel Seeds',10,700),(179,'Firewater',10,700),(180,'Flaked Almonds',10,700),(181,'Food Coloring',10,700),(182,'Forbidden Fruit',10,700),(183,'Frangelico',10,700),(184,'Fresca',10,700),(185,'Fresh Basil',10,700),(186,'Fresh Lemon Juice',10,700),(187,'Fruit Juice',10,700),(188,'Fruit Punch',10,700),(189,'Fruit',10,700),(190,'Galliano',10,700),(191,'Garlic Sauce',10,700),(192,'Gatorade',10,700),(193,'Ginger Ale',10,700),(194,'Ginger Beer',10,700),(195,'Ginger',10,700),(196,'Glycerine',10,700),(197,'Godiva Liqueur',10,700),(198,'Gold rum',10,700),(199,'Gold Tequila',10,700),(200,'Goldschlager',10,700),(201,'Grain Alcohol',10,700),(202,'Grand Marnier',10,700),(203,'Granulated Sugar',10,700),(204,'Grape juice',10,700),(205,'Grape soda',10,700),(206,'Grapefruit Juice',10,700),(207,'Grapes',10,700),(208,'Green Chartreuse',10,700),(209,'Green Creme de Menthe',10,700),(210,'Green Ginger Wine',10,700),(211,'Green Olives',10,700),(212,'Grenadine',10,700),(213,'Ground Ginger',10,700),(214,'Guava juice',10,700),(215,'Guinness stout',10,700),(216,'Guinness',10,700),(217,'Half-and-half',10,700),(218,'Hawaiian punch',10,700),(219,'Hazelnut liqueur',10,700),(220,'Heavy cream',10,700),(221,'Honey',10,700),(222,'Hooch',10,700),(223,'Hot Chocolate',10,700),(224,'Hot Damn',10,700),(225,'Hot Sauce',10,700),(226,'Hpnotiq',10,700),(227,'Ice-Cream',10,700),(228,'Ice',10,700),(229,'Iced tea',10,700),(230,'Irish cream',10,700),(231,'Irish Whiskey',10,700),(232,'Jack Daniels',10,700),(233,'Jello',10,700),(234,'Jelly',10,700),(235,'Jagermeister',10,700),(236,'Jim Beam',10,700),(237,'Johnnie Walker',10,700),(238,'Kahlua',10,700),(239,'Key Largo Schnapps',10,700),(240,'Kirschwasser',10,700),(241,'Kiwi liqueur',10,700),(242,'Kiwi',10,700),(243,'Kool-Aid',10,700),(244,'Kummel',10,700),(245,'Lager',10,700),(246,'Lemon Juice',10,700),(247,'Lemon Peel',10,700),(248,'Lemon soda',10,700),(249,'Lemon vodka',10,700),(250,'Lemon-lime soda',10,700),(251,'lemon-lime',10,700),(252,'lemon',10,700),(253,'Lemonade',10,700),(254,'Licorice Root',10,700),(255,'Light Cream',10,700),(256,'Light Rum',10,700),(257,'Lillet',10,700),(258,'Lime juice cordial',10,700),(259,'Lime Juice',10,700),(260,'Lime liqueur',10,700),(261,'Lime Peel',10,700),(262,'Lime vodka',10,700),(263,'Lime',10,700),(264,'Limeade',10,700),(265,'Madeira',10,700),(266,'Malibu Rum',10,700),(267,'Mandarin',10,700),(268,'Mandarine napoleon',10,700),(269,'Mango',10,700),(270,'Maple syrup',10,700),(271,'Maraschino cherry juice',10,700),(272,'Maraschino Cherry',10,700),(273,'Maraschino Liqueur',10,700),(274,'Margarita mix',10,700),(275,'Marjoram leaves',10,700),(276,'Marshmallows',10,700),(277,'Maui',10,700),(278,'Melon Liqueur',10,700),(279,'Melon Vodka',10,700),(280,'Mezcal',10,700),(281,'Midori Melon Liqueur',10,700),(282,'Midori',10,700),(283,'Milk',10,700),(284,'Mint syrup',10,700),(285,'Mint',10,700),(286,'Mountain Dew',10,700),(287,'Nutmeg',10,700),(288,'Olive Oil',10,700),(289,'Olive',10,700),(290,'Onion',10,700),(291,'Orange Bitters',10,700),(292,'Orange Curacao',10,700),(293,'Orange Juice',10,700),(294,'Orange liqueur',10,700),(295,'Orange Peel',10,700),(296,'Orange rum',10,700),(297,'Orange Soda',10,700),(298,'Orange spiral',10,700),(299,'Orange vodka',10,700),(300,'Orange',10,700),(301,'Oreo cookie',10,700),(302,'Orgeat Syrup',10,700),(303,'Ouzo',10,700),(304,'Oyster Sauce',10,700),(305,'Papaya juice',10,700),(306,'Papaya',10,700),(307,'Parfait amour',10,700),(308,'Passion fruit juice',10,700),(309,'Passion fruit syrup',10,700),(310,'Passoa',10,700),(311,'Peach brandy',10,700),(312,'Peach juice',10,700),(313,'Peach liqueur',10,700),(314,'Peach Nectar',10,700),(315,'Peach Schnapps',10,700),(316,'Peach Vodka',10,700),(317,'Peach',10,700),(318,'Peachtree schnapps',10,700),(319,'Peanut Oil',10,700),(320,'Pepper',10,700),(321,'Peppermint extract',10,700),(322,'Peppermint Schnapps',10,700),(323,'Pepsi Cola',10,700),(324,'Pernod',10,700),(325,'Peychaud bitters',10,700),(326,'Pina colada mix',10,700),(327,'Pineapple Juice',10,700),(328,'Pineapple rum',10,700),(329,'Pineapple vodka',10,700),(330,'Pineapple-orange-banana juice',10,700),(331,'Pineapple',10,700),(332,'Pink lemonade',10,700),(333,'Pisang Ambon',10,700),(334,'Pisco',10,700),(335,'Plain Chocolate',10,700),(336,'Plain Flour',10,700),(337,'Plums',10,700),(338,'Port',10,700),(339,'Powdered Sugar',10,700),(340,'Purple passion',10,700),(341,'Raisins',10,700),(342,'Raspberry cordial',10,700),(343,'Raspberry Jam',10,700),(344,'Raspberry Juice',10,700),(345,'Raspberry Liqueur',10,700),(346,'Raspberry schnapps',10,700),(347,'Raspberry syrup',10,700),(348,'Raspberry Vodka',10,700),(349,'Red Chile Flakes',10,700),(350,'Red Chili Flakes',10,700),(351,'Red Hot Chili Flakes',10,700),(352,'Red Wine',10,700),(353,'Rhubarb',10,700),(354,'Ricard',10,700),(355,'Rock Salt',10,700),(356,'Root beer schnapps',10,700),(357,'Root beer',10,700),(358,'Roses sweetened lime juice',10,700),(359,'Rosewater',10,700),(360,'Rumple Minze',10,700),(361,'Rye Whiskey',10,700),(362,'Sake',10,700),(363,'Salt',10,700),(364,'Sambuca',10,700),(365,'Sarsaparilla',10,700),(366,'Schnapps',10,700),(367,'Schweppes Lemon',10,700),(368,'Schweppes Russchian',10,700),(369,'Sherbet',10,700),(370,'Sherry',10,700),(371,'Sirup of roses',10,700),(372,'Sloe Gin',10,700),(373,'Soda Water',10,700),(374,'Sour Apple Pucker',10,700),(375,'Sour Mix',10,700),(376,'Southern Comfort',10,700),(377,'Soy Milk',10,700),(378,'Soy Sauce',10,700),(379,'Soya Milk',10,700),(380,'Soya Sauce',10,700),(381,'Spiced Rum',10,700),(382,'Sprite',10,700),(383,'Squeezed Orange',10,700),(384,'Squirt',10,700),(385,'Strawberries',10,700),(386,'Strawberry juice',10,700),(387,'Strawberry liqueur',10,700),(388,'Strawberry Schnapps',10,700),(389,'Strawberry syrup',10,700),(390,'Sugar Syrup',10,700),(391,'Sugar',10,700),(392,'Sunny delight',10,700),(393,'Surge',10,700),(394,'Swedish punsch',10,700),(395,'Sweet and Sour',10,700),(396,'Sweet Cream',10,700),(397,'Sweet Vermouth',10,700),(398,'Tabasco Sauce',10,700),(399,'Tang',10,700),(400,'Tawny port',10,700),(401,'Tea',10,700),(402,'Tennessee whiskey',10,700),(403,'Tequila rose',10,700),(404,'Tia Maria',10,700),(405,'Tomato Juice',10,700),(406,'Tomato',10,700),(407,'Tonic Water',10,700),(408,'Triple Sec',10,700),(409,'Tropicana',10,700),(410,'Tuaca',10,700),(411,'Vanilla extract',10,700),(412,'Vanilla Ice-Cream',10,700),(413,'Vanilla liqueur',10,700),(414,'Vanilla schnapps',10,700),(415,'Vanilla syrup',10,700),(416,'Vanilla vodka',10,700),(417,'Vanilla',10,700),(418,'Vermouth',10,700),(419,'Vinegar',10,700),(420,'Water',10,700),(421,'Watermelon schnapps',10,700),(422,'Whipped Cream',10,700),(423,'Whipping Cream',10,700),(424,'White chocolate liqueur',10,700),(425,'White Creme de Menthe',10,700),(426,'White grape juice',10,700),(427,'White port',10,700),(428,'White Rum',10,700),(429,'White Vinegar',10,700),(430,'White Wine',10,700),(431,'Wild Turkey',10,700),(432,'Wildberry schnapps',10,700),(433,'Wine',10,700),(434,'Worcestershire Sauce',10,700),(435,'Wormwood',10,700),(436,'Yeast',10,700),(437,'Yellow Chartreuse',10,700),(438,'Yoghurt',10,700),(439,'Yukon Jack',10,700),(440,'Zima',10,700),(441,'Caramel Sauce',10,700),(442,'Chocolate Sauce',10,700),(443,'Lillet Blanc',10,700),(444,'Peach Bitters',10,700),(445,'Mini-snickers bars',10,700),(446,'Prosecco',10,700),(447,'Salted Chocolate',10,700),(448,'Martini Rosso',10,700),(449,'Martini Bianco',10,700),(450,'Martini Extra Dry',10,700),(451,'Fresh Lime Juice',10,700),(452,'Fresh Mint',10,700),(453,'Rosemary',10,700),(454,'Habanero Peppers',10,700),(455,'Ilegal Joven mezcal',10,700),(456,'Elderflower cordial',10,700),(457,'Rosso Vermouth',10,700),(458,'Creme de Violette',10,700),(459,'Cocchi Americano',10,700),(460,'White Vermouth',10,700),(461,'Dry Curacao',10,700),(462,'Nocino',10,700),(463,'Averna',10,700),(464,'Ramazzotti',10,700),(465,'Fernet-Branca',10,700),(466,'Allspice Dram',10,700),(467,'Falernum',10,700),(468,'Singani',10,700),(469,'Arrack',10,700),(470,'Blackstrap rum',10,700),(471,'Ginger Syrup',10,700),(472,'Honey syrup',10,700),(473,'Blended Scotch',10,700),(474,'Islay single malt Scotch',10,700),(475,'151 proof rum',10,700),(476,'7-up',10,700),(477,'Absinthe',10,700),(478,'Absolut citron',10,700),(479,'Creme de Mure',10,700),(480,'Olive Brine',10,700),(481,'Pineapple Syrup',10,700),(482,'St. Germain',10,700),(483,'Lavender',10,700),(484,'Whiskey',10,700),(485,'Whisky',10,700),(486,'Pomegranate juice',10,700),(487,'Watermelon',10,700),(488,'Chareau',10,700),(489,'Cinnamon Whisky',10,700),(490,'Red Bull',10,700),(491,'Diet Coke',10,700),(492,'Rosemary Syrup',10,700),(493,'Figs',10,700),(494,'Thyme',10,700),(495,'Orange Slice',10,700),(496,'Blood Orange',10,700),(497,'Amaro Montenegro',10,700),(498,'Ruby Port',10,700);
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-21 11:48:13
