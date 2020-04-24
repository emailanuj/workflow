-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: project
-- ------------------------------------------------------
-- Server version	5.7.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1024) DEFAULT NULL,
  `slug` varchar(1024) DEFAULT NULL,
  `body` longtext NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `article_user_created_by_fk` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,'Test','test','Testing Article',1586496267,1586496267,2,2),(2,'te','te','te',1586515966,1586515966,2,2);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_commands`
--

DROP TABLE IF EXISTS `tbl_commands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_commands` (
  `id` int(11) NOT NULL,
  `command_name` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_commands`
--

LOCK TABLES `tbl_commands` WRITE;
/*!40000 ALTER TABLE `tbl_commands` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_commands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_keywords`
--

DROP TABLE IF EXISTS `tbl_keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_keywords` (
  `id` int(11) NOT NULL,
  `keyword_name` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_keywords`
--

LOCK TABLES `tbl_keywords` WRITE;
/*!40000 ALTER TABLE `tbl_keywords` DISABLE KEYS */;
INSERT INTO `tbl_keywords` VALUES (1,'Precheck',0,'0000-00-00 00:00:00','0','0000-00-00 00:00:00','0'),(2,'Postcheck',0,'0000-00-00 00:00:00','0','0000-00-00 00:00:00','0'),(3,'NSO',0,'0000-00-00 00:00:00','0','0000-00-00 00:00:00','0');
/*!40000 ALTER TABLE `tbl_keywords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `auth_key` varchar(100) DEFAULT NULL,
  `access_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','admin','key-1','token-1'),(2,'anuj','$2y$13$aGwst9A4/fslv.bvrzm80./D/36VNTGsRwC5PoFXpWuc7rIyl03mW','nTrmGmxsQvyZoAJCMEh6LDx-8NhfK0Vh','KCYSJlVCbTCMy4HyhTSJcCdOR5I_Kcm9'),(3,'test','$2y$13$yjQefpGFpf/rzeA4RhlUJO2nEAOWmng7aujGdVCwWmmLBw5KHIbwS','Ih6AMMFuQyUtgQzXWfWwiI1gLeCF2y43','klpxmGIikz_TBQNv2MKVlF4PaAXirLTn');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workflow`
--

DROP TABLE IF EXISTS `workflow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workflow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `workflow_title` varchar(100) DEFAULT NULL,
  `workflow_description` varchar(200) DEFAULT NULL,
  `workflow_data` longtext,
  `workflow_json` longtext,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workflow`
--

LOCK TABLES `workflow` WRITE;
/*!40000 ALTER TABLE `workflow` DISABLE KEYS */;
INSERT INTO `workflow` VALUES (1,'Workflow- In Progress','Workflow-1 In Progress','{\"SEstartEvnet1\":{\"0\":{\"selectedId\":\"SEstartEvnet1\",\"elementType\":\"StartEvent\",\"elementSubType\":\"StartEvent\",\"keywordname0\":\"1\",\"stepno0\":\"1\",\"nextprocess0\":\"1\",\"functiontoperform0\":\"1\",\"functiontogetdata0\":\"1\",\"responseformat0\":\"1\",\"keyword0\":\"keyword-1\",\"command0\":\"command-1\",\"functionname0\":\"functionname-1\",\"responseoutput0\":\"1\",\"inputtype0\":\"inputtype-1\",\"inputformat0\":\"1\"},\"1\":{\"selectedId\":\"SEstartEvnet1\",\"elementType\":\"StartEvent\",\"elementSubType\":\"StartEvent\",\"keywordname1\":\"2\",\"stepno1\":\"2\",\"nextprocess1\":\"2\",\"functiontoperform1\":\"2\",\"functiontogetdata1\":\"2\",\"responseformat1\":\"2\",\"keyword1\":\"keyword-2\",\"command1\":\"command-2\",\"functionname1\":\"functionname-2\",\"responseoutput1\":\"2\",\"inputtype1\":\"inputtype-2\",\"inputformat1\":\"2\"}},\"TSEstartEvnet2\":{\"0\":{\"selectedId\":\"TSEstartEvnet2\",\"elementType\":\"StartEvent\",\"elementSubType\":\"TimeStartEvent\",\"keywordname0\":\"1\",\"stepno0\":\"1\",\"nextprocess0\":\"1\",\"functiontoperform0\":\"1\",\"functiontogetdata0\":\"1\",\"responseformat0\":\"1\",\"keyword0\":\"keyword-1\",\"command0\":\"command-1\",\"functionname0\":\"functionname-1\",\"responseoutput0\":\"1\",\"inputtype0\":\"inputtype-1\",\"inputformat0\":\"1\"},\"1\":{\"selectedId\":\"TSEstartEvnet2\",\"elementType\":\"StartEvent\",\"elementSubType\":\"TimeStartEvent\",\"keywordname1\":\"2\",\"stepno1\":\"2\",\"nextprocess1\":\"2\",\"functiontoperform1\":\"2\",\"functiontogetdata1\":\"2\",\"responseformat1\":\"2\",\"keyword1\":\"keyword-2\",\"command1\":\"command-2\",\"functionname1\":\"functionname-2\",\"responseoutput1\":\"2\",\"inputtype1\":\"inputtype-2\",\"inputformat1\":\"2\"}}}','{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":203,\"y\":213,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"},{\"id\":\"startEvnet2\",\"x\":405,\"y\":239,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"TimeStartEvent\"}]}',NULL,NULL,NULL,NULL),(2,'One','One Updated','{\"SEstartEvnet1\":{\"0\":{\"selectedId\":\"SEstartEvnet1\",\"elementType\":\"StartEvent\",\"elementSubType\":\"StartEvent\",\"keywordname0\":\"1\",\"stepno0\":\"1\",\"nextprocess0\":\"1\",\"functiontoperform0\":\"1\",\"functiontogetdata0\":\"1\",\"responseformat0\":\"1\",\"keyword0\":\"keyword-1\",\"command0\":\"command-1\",\"functionname0\":\"functionname-1\",\"responseoutput0\":\"1\",\"inputtype0\":\"inputtype-1\",\"inputformat0\":\"1\"},\"1\":{\"selectedId\":\"SEstartEvnet1\",\"elementType\":\"StartEvent\",\"elementSubType\":\"StartEvent\",\"keywordname1\":\"2\",\"stepno1\":\"2\",\"nextprocess1\":\"2\",\"functiontoperform1\":\"2\",\"functiontogetdata1\":\"2\",\"responseformat1\":\"2\",\"keyword1\":\"keyword-2\",\"command1\":\"command-2\",\"functionname1\":\"functionname-2\",\"responseoutput1\":\"2\",\"inputtype1\":\"inputtype-2\",\"inputformat1\":\"2\"}}}','{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":326,\"y\":204,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"},{\"id\":\"startEvnet2\",\"x\":657,\"y\":229,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"}]}',NULL,NULL,NULL,NULL),(3,'Testing 17 APR','Testing By Anuj','{\"SEstartEvnet1\":{\"0\":{\"selectedId\":\"SEstartEvnet1\",\"elementType\":\"StartEvent\",\"elementSubType\":\"StartEvent\",\"keywordname0\":\"1\",\"stepno0\":\"1\",\"nextprocess0\":\"1\",\"functiontoperform0\":\"1\",\"functiontogetdata0\":\"1\",\"responseformat0\":\"1\",\"keyword0\":\"keyword-1\",\"command0\":\"command-1\",\"functionname0\":\"functionname-1\",\"responseoutput0\":\"1\",\"inputtype0\":\"inputtype-1\",\"inputformat0\":\"Testing\"}}}','{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":255,\"y\":168,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"},{\"id\":\"startEvnet2\",\"x\":481,\"y\":429,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"}]}',NULL,NULL,NULL,NULL),(4,'Workflow 20 APR','Workflow 20 APR Updated','{\"SEstartEvnet1\":{\"0\":{\"selectedId\":\"SEstartEvnet1\",\"elementType\":\"StartEvent\",\"elementSubType\":\"StartEvent\",\"keywordname0\":\"1\",\"stepno0\":\"1\",\"nextprocess0\":\"1\",\"functiontoperform0\":\"1\",\"functiontogetdata0\":\"1\",\"responseformat0\":\"1\",\"keyword0\":\"keyword-1\",\"command0\":\"command-1\",\"functionname0\":\"functionname-1\",\"responseoutput0\":\"1\",\"inputtype0\":\"inputtype-1\",\"inputformat0\":\"1\"}}}','{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":245,\"y\":170,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"},{\"id\":\"startEvnet2\",\"x\":504,\"y\":208,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"}]}',NULL,NULL,NULL,NULL),(5,'Testing Workflow','Testing Workflow By Anuj','{\"SEstartEvnet1\":{\"0\":{\"selectedId\":\"SEstartEvnet1\",\"elementType\":\"StartEvent\",\"elementSubType\":\"StartEvent\",\"keywordname0\":\"1\",\"stepno0\":\"1\",\"nextprocess0\":\"1\",\"functiontoperform0\":\"1\",\"functiontogetdata0\":\"1\",\"responseformat0\":\"1\",\"keyword0\":\"keyword-1\",\"command0\":\"command-1\",\"functionname0\":\"functionname-1\",\"responseoutput0\":\"1\",\"inputtype0\":\"inputtype-1\",\"inputformat0\":\"12345\"}}}','{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":273,\"y\":222,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"}]}',NULL,NULL,NULL,NULL),(6,'Workflow 21 Apr','Workflow 21 Apr Desc Updated','{\"SEstartEvnet1\":{\"0\":{\"selectedId\":\"SEstartEvnet1\",\"elementType\":\"StartEvent\",\"elementSubType\":\"StartEvent\",\"keywordname0\":\"1\",\"stepno0\":\"1\",\"nextprocess0\":\"1\",\"functiontoperform0\":\"1\",\"functiontogetdata0\":\"1\",\"responseformat0\":\"1\",\"keyword0\":\"Precheck\",\"command0\":\"command-1\",\"functionname0\":\"functionname-1\",\"responseoutput0\":\"Response+Output\",\"inputtype0\":\"inputtype-1\",\"inputformat0\":\"Input+Format\"}}}','{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":247,\"y\":168,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"}]}',NULL,NULL,NULL,NULL),(7,'Workflow- In Progress','Workflow-1 In Progress','{\"SEstartEvnet1\":{\"0\":{\"selectedId\":\"SEstartEvnet1\",\"elementType\":\"StartEvent\",\"elementSubType\":\"StartEvent\",\"stepno0\":\"1\",\"iffail0\":\"\",\"nextprocess0\":\"1\",\"datasource0\":\"\",\"apiurl0\":\"\",\"apitype0\":\"\",\"accesstype0\":\"\",\"inputformat0\":\"1\",\"outputtype0\":\"\",\"expectedresponse0\":\"\"},\"1\":{\"selectedId\":\"SEstartEvnet1\",\"elementType\":\"StartEvent\",\"elementSubType\":\"StartEvent\",\"keywordname1\":\"\",\"stepno1\":\"2\",\"nextprocess1\":\"2\",\"functiontoperform1\":\"\",\"functiontogetdata1\":\"\",\"responseformat1\":\"\",\"command1\":\"\",\"functionname1\":\"\",\"responseoutput1\":\"\",\"inputtype1\":\"inputtype-2\",\"inputformat1\":\"2\"}}}','{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":277,\"y\":224,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"},{\"id\":\"task1\",\"x\":415,\"y\":182,\"width\":120,\"height\":80,\"text\":\"sample\",\"type\":\"task\",\"subtype\":\"UserTask\"},{\"id\":\"task2\",\"x\":695,\"y\":196,\"width\":120,\"height\":80,\"text\":\"sample\",\"type\":\"task\",\"subtype\":\"UserTask\"},{\"id\":\"gateway1\",\"x\":907,\"y\":288,\"width\":120,\"height\":80,\"type\":\"gateway\",\"subtype\":\"parallel\"},{\"id\":\"task3\",\"x\":995,\"y\":199,\"width\":120,\"height\":80,\"text\":\"sample\",\"type\":\"task\",\"subtype\":\"UserTask\"},{\"id\":\"gateway2\",\"x\":1052,\"y\":343,\"width\":120,\"height\":80,\"type\":\"gateway\",\"subtype\":\"parallel\"},{\"id\":\"task4\",\"x\":992,\"y\":437,\"width\":120,\"height\":80,\"text\":\"sample\",\"type\":\"task\",\"subtype\":\"UserTask\"},{\"id\":\"endEvent1\",\"x\":1034,\"y\":575,\"width\":20,\"height\":20,\"type\":\"endEvent\",\"subtype\":\"EndEvent\"},{\"id\":\"flow1\",\"type\":\"flow\",\"start_x\":277,\"start_y\":224,\"end_x\":0,\"end_y\":0,\"mid_x\":501,\"start_id\":\"startEvnet1\",\"end_id\":0,\"start_type\":\"startEvent\",\"end_type\":\"\"}]}',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `workflow` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-24 11:57:13
