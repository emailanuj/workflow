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
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,'Test','test','Testing Article',1586496267,1586496267,2,2),(2,'te','te','te',1586515966,1586515966,2,2);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tbl_commands`
--

LOCK TABLES `tbl_commands` WRITE;
/*!40000 ALTER TABLE `tbl_commands` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_commands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tbl_keywords`
--

LOCK TABLES `tbl_keywords` WRITE;
/*!40000 ALTER TABLE `tbl_keywords` DISABLE KEYS */;
INSERT INTO `tbl_keywords` VALUES (1,'Precheck',0,'0000-00-00 00:00:00','0','0000-00-00 00:00:00','0'),(2,'Postcheck',0,'0000-00-00 00:00:00','0','0000-00-00 00:00:00','0'),(3,'NSO',0,'0000-00-00 00:00:00','0','0000-00-00 00:00:00','0');
/*!40000 ALTER TABLE `tbl_keywords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','admin','key-1','token-1'),(2,'anuj','$2y$13$aGwst9A4/fslv.bvrzm80./D/36VNTGsRwC5PoFXpWuc7rIyl03mW','nTrmGmxsQvyZoAJCMEh6LDx-8NhfK0Vh','KCYSJlVCbTCMy4HyhTSJcCdOR5I_Kcm9'),(3,'test','$2y$13$yjQefpGFpf/rzeA4RhlUJO2nEAOWmng7aujGdVCwWmmLBw5KHIbwS','Ih6AMMFuQyUtgQzXWfWwiI1gLeCF2y43','klpxmGIikz_TBQNv2MKVlF4PaAXirLTn');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `workflow`
--

LOCK TABLES `workflow` WRITE;
/*!40000 ALTER TABLE `workflow` DISABLE KEYS */;
INSERT INTO `workflow` VALUES (1,'Workflow-','Workflow-1 Updated Anuj','{\"SEstartEvnet1\":{\"0\":{\"selectedId\":\"SEstartEvnet1\",\"elementType\":\"StartEvent\",\"elementSubType\":\"StartEvent\",\"keywordname0\":\"1\",\"stepno0\":\"1\",\"nextprocess0\":\"1\",\"functiontoperform0\":\"1\",\"functiontogetdata0\":\"1\",\"responseformat0\":\"1\",\"keyword0\":\"keyword-1\",\"command0\":\"command-1\",\"functionname0\":\"functionname-1\",\"responseoutput0\":\"1\",\"inputtype0\":\"inputtype-1\",\"inputformat0\":\"1\"},\"1\":{\"selectedId\":\"SEstartEvnet1\",\"elementType\":\"StartEvent\",\"elementSubType\":\"StartEvent\",\"keywordname1\":\"2\",\"stepno1\":\"2\",\"nextprocess1\":\"2\",\"functiontoperform1\":\"2\",\"functiontogetdata1\":\"2\",\"responseformat1\":\"2\",\"keyword1\":\"keyword-2\",\"command1\":\"command-2\",\"functionname1\":\"functionname-2\",\"responseoutput1\":\"2\",\"inputtype1\":\"inputtype-2\",\"inputformat1\":\"2\"}},\"TSEstartEvnet2\":{\"0\":{\"selectedId\":\"TSEstartEvnet2\",\"elementType\":\"StartEvent\",\"elementSubType\":\"TimeStartEvent\",\"keywordname0\":\"1\",\"stepno0\":\"1\",\"nextprocess0\":\"1\",\"functiontoperform0\":\"1\",\"functiontogetdata0\":\"1\",\"responseformat0\":\"1\",\"keyword0\":\"keyword-1\",\"command0\":\"command-1\",\"functionname0\":\"functionname-1\",\"responseoutput0\":\"1\",\"inputtype0\":\"inputtype-1\",\"inputformat0\":\"1\"},\"1\":{\"selectedId\":\"TSEstartEvnet2\",\"elementType\":\"StartEvent\",\"elementSubType\":\"TimeStartEvent\",\"keywordname1\":\"2\",\"stepno1\":\"2\",\"nextprocess1\":\"2\",\"functiontoperform1\":\"2\",\"functiontogetdata1\":\"2\",\"responseformat1\":\"2\",\"keyword1\":\"keyword-2\",\"command1\":\"command-2\",\"functionname1\":\"functionname-2\",\"responseoutput1\":\"2\",\"inputtype1\":\"inputtype-2\",\"inputformat1\":\"2\"}}}','{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":203,\"y\":213,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"},{\"id\":\"startEvnet2\",\"x\":405,\"y\":239,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"TimeStartEvent\"}]}',NULL,NULL,NULL,NULL),(2,'One','One Updated','{\"SEstartEvnet1\":{\"0\":{\"selectedId\":\"SEstartEvnet1\",\"elementType\":\"StartEvent\",\"elementSubType\":\"StartEvent\",\"keywordname0\":\"1\",\"stepno0\":\"1\",\"nextprocess0\":\"1\",\"functiontoperform0\":\"1\",\"functiontogetdata0\":\"1\",\"responseformat0\":\"1\",\"keyword0\":\"keyword-1\",\"command0\":\"command-1\",\"functionname0\":\"functionname-1\",\"responseoutput0\":\"1\",\"inputtype0\":\"inputtype-1\",\"inputformat0\":\"1\"},\"1\":{\"selectedId\":\"SEstartEvnet1\",\"elementType\":\"StartEvent\",\"elementSubType\":\"StartEvent\",\"keywordname1\":\"2\",\"stepno1\":\"2\",\"nextprocess1\":\"2\",\"functiontoperform1\":\"2\",\"functiontogetdata1\":\"2\",\"responseformat1\":\"2\",\"keyword1\":\"keyword-2\",\"command1\":\"command-2\",\"functionname1\":\"functionname-2\",\"responseoutput1\":\"2\",\"inputtype1\":\"inputtype-2\",\"inputformat1\":\"2\"}}}','{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":326,\"y\":204,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"},{\"id\":\"startEvnet2\",\"x\":657,\"y\":229,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"}]}',NULL,NULL,NULL,NULL),(3,'Testing 17 APR','Testing By Anuj','{\"SEstartEvnet1\":{\"0\":{\"selectedId\":\"SEstartEvnet1\",\"elementType\":\"StartEvent\",\"elementSubType\":\"StartEvent\",\"keywordname0\":\"1\",\"stepno0\":\"1\",\"nextprocess0\":\"1\",\"functiontoperform0\":\"1\",\"functiontogetdata0\":\"1\",\"responseformat0\":\"1\",\"keyword0\":\"keyword-1\",\"command0\":\"command-1\",\"functionname0\":\"functionname-1\",\"responseoutput0\":\"1\",\"inputtype0\":\"inputtype-1\",\"inputformat0\":\"Testing\"}}}','{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":255,\"y\":168,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"},{\"id\":\"startEvnet2\",\"x\":481,\"y\":429,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"}]}',NULL,NULL,NULL,NULL),(4,'Workflow 20 APR','Workflow 20 APR Updated','{\"SEstartEvnet1\":{\"0\":{\"selectedId\":\"SEstartEvnet1\",\"elementType\":\"StartEvent\",\"elementSubType\":\"StartEvent\",\"keywordname0\":\"1\",\"stepno0\":\"1\",\"nextprocess0\":\"1\",\"functiontoperform0\":\"1\",\"functiontogetdata0\":\"1\",\"responseformat0\":\"1\",\"keyword0\":\"keyword-1\",\"command0\":\"command-1\",\"functionname0\":\"functionname-1\",\"responseoutput0\":\"1\",\"inputtype0\":\"inputtype-1\",\"inputformat0\":\"1\"}}}','{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":245,\"y\":170,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"},{\"id\":\"startEvnet2\",\"x\":504,\"y\":208,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"}]}',NULL,NULL,NULL,NULL),(5,'Testing Workflow','Testing Workflow By Anuj','{\"SEstartEvnet1\":{\"0\":{\"selectedId\":\"SEstartEvnet1\",\"elementType\":\"StartEvent\",\"elementSubType\":\"StartEvent\",\"keywordname0\":\"1\",\"stepno0\":\"1\",\"nextprocess0\":\"1\",\"functiontoperform0\":\"1\",\"functiontogetdata0\":\"1\",\"responseformat0\":\"1\",\"keyword0\":\"keyword-1\",\"command0\":\"command-1\",\"functionname0\":\"functionname-1\",\"responseoutput0\":\"1\",\"inputtype0\":\"inputtype-1\",\"inputformat0\":\"12345\"}}}','{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":273,\"y\":222,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"}]}',NULL,NULL,NULL,NULL),(6,'Workflow 21 Apr','Workflow 21 Apr Desc Updated','{\"SEstartEvnet1\":{\"0\":{\"selectedId\":\"SEstartEvnet1\",\"elementType\":\"StartEvent\",\"elementSubType\":\"StartEvent\",\"keywordname0\":\"1\",\"stepno0\":\"1\",\"nextprocess0\":\"1\",\"functiontoperform0\":\"1\",\"functiontogetdata0\":\"1\",\"responseformat0\":\"1\",\"keyword0\":\"Precheck\",\"command0\":\"command-1\",\"functionname0\":\"functionname-1\",\"responseoutput0\":\"Response+Output\",\"inputtype0\":\"inputtype-1\",\"inputformat0\":\"Input+Format\"}}}','{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":247,\"y\":168,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"}]}',NULL,NULL,NULL,NULL);
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

-- Dump completed on 2020-04-21 15:43:13
