-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2020 at 02:35 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bpnm`
--

--
-- Dumping data for table `tbl_functions`
--

INSERT INTO `tbl_functions` (`id`, `function_name`, `function_type`, `tbl_functionscol`, `function_url`, `deleted`) VALUES
(1, 'get_cur_data()', 'EXECUTABLE', 'col', 'url', 0),
(2, 'functionex', 'GETDATA', 'col', 'workflow-execution/functionex', 0);

--
-- Dumping data for table `workflow`
--

INSERT INTO `workflow` (`id`, `workflow_title`, `workflow_description`, `workflow_data`, `workflow_json`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted`) VALUES
(1, 'Workflow-1', 'Workflow with multiple elements', '{\"SEstartEvnet1\":{\"step_no\":\"1\",\"if_fail\":\"continue\",\"next_process\":\"2\",\"keywords\":\"API\",\"api_url\":\"https:\\/\\/mopa.com\",\"api_method\":\"post\",\"api_type\":\"rest\",\"api_headers\":\"headers\",\"function_execute\":\"get_cur_data()\",\"auth_type\":\"both\",\"token_from\":\"token_url\",\"token_url\":\"https:\\/\\/tokenurls.com\",\"username\":\"admin\",\"password\":\"admin\",\"data_source\":\"\",\"get_data_function\":\"\",\"form_data\":\"\"},\"SEstartEvnet2\":{\"step_no\":\"2\",\"if_fail\":\"stop\",\"next_process\":\"3\",\"keywords\":\"API\",\"api_url\":\"https:\\/\\/topology.com\",\"api_method\":\"get\",\"api_type\":\"soap\",\"api_headers\":\"headers\",\"function_execute\":\"get_cur_data()\",\"auth_type\":\"token\",\"token_from\":\"prev_response\",\"token_url\":\"https:\\/\\/tokenurls.com\",\"username\":\"admin\",\"password\":\"admin\",\"data_source\":\"\",\"get_data_function\":\"\",\"form_data\":\"\"}}', '{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":245,\"y\":183,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"},{\"id\":\"startEvnet2\",\"x\":509,\"y\":183,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"}]}', 1588658789, 1588659468, NULL, 2, 0),
(2, 'Workflow-2', 'Workflow-2', '{\"SEstartEvnet1\":{\"step_no\":\"1\",\"if_fail\":\"stop\",\"next_process\":\"2\",\"keywords\":\"NSO\",\"api_url\":\"\",\"api_method\":\"\",\"api_type\":\"\",\"api_headers\":\"\",\"function_execute\":\"\",\"auth_type\":\"\",\"token_from\":\"\",\"token_url\":\"\",\"username\":\"\",\"password\":\"\",\"data_source\":\"form_data\",\"get_data_function\":\"\",\"form_data\":\"NSO JSON\"},\"EEendEvent1\":{\"step_no\":\"2\",\"if_fail\":\"continue\",\"next_process\":\"2\",\"keywords\":\"NSO\",\"api_url\":\"\",\"api_method\":\"\",\"api_type\":\"\",\"api_headers\":\"\",\"function_execute\":\"\",\"auth_type\":\"\",\"token_from\":\"\",\"token_url\":\"\",\"username\":\"\",\"password\":\"\",\"data_source\":\"form_data\",\"get_data_function\":\"\",\"form_data\":\"Form Data\"}}', '{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":243,\"y\":198,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"},{\"id\":\"endEvent1\",\"x\":524,\"y\":184,\"width\":20,\"height\":20,\"type\":\"endEvent\",\"subtype\":\"EndEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":283,\"start_y\":198,\"end_x\":498,\"end_y\":184,\"mid_x\":390.5,\"start_id\":\"startEvnet1\",\"end_id\":\"endEvent1\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":263,\"start_y\":198,\"end_x\":498,\"end_y\":184,\"mid_x\":380.5,\"start_id\":\"startEvnet1\",\"end_id\":\"endEvent1\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":263,\"start_y\":198,\"end_x\":499,\"end_y\":184,\"mid_x\":381,\"start_id\":\"startEvnet1\",\"end_id\":\"endEvent1\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":263,\"start_y\":198,\"end_x\":499,\"end_y\":184,\"mid_x\":381,\"start_id\":\"startEvnet1\",\"end_id\":\"endEvent1\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":263,\"start_y\":198,\"end_x\":499,\"end_y\":184,\"mid_x\":381,\"start_id\":\"startEvnet1\",\"end_id\":\"endEvent1\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":263,\"start_y\":198,\"end_x\":499,\"end_y\":184,\"mid_x\":381,\"start_id\":\"startEvnet1\",\"end_id\":\"endEvent1\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow5\",\"type\":\"flow\",\"start_x\":263,\"start_y\":198,\"end_x\":499,\"end_y\":184,\"mid_x\":381,\"start_id\":\"startEvnet1\",\"end_id\":\"endEvent1\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"}]}', 1588659501, 1588659661, NULL, 2, 0),
(3, 'Workflow-3', 'Workflow with multiple elements', '{\"SEstartEvnet2\":{\"step_no\":\"2\",\"if_fail\":\"stop\",\"next_process\":\"3\",\"keywords\":\"NSO\",\"api_url\":\"\",\"api_method\":\"\",\"api_type\":\"\",\"api_headers\":\"\",\"function_execute\":\"\",\"auth_type\":\"\",\"token_from\":\"\",\"token_url\":\"\",\"username\":\"\",\"password\":\"\",\"data_source\":\"function_name\",\"get_data_function\":\"workflow-execution\\/functionex\",\"form_data\":\"test22\"},\"SEstartEvnet1\":{\"step_no\":\"1\",\"if_fail\":\"continue\",\"next_process\":\"2\",\"keywords\":\"API\",\"api_url\":\"http:\\/\\/localhost\\/bpnm-api\\/getapi.php\",\"api_method\":\"get\",\"api_type\":\"rest\",\"api_headers\":\"no\",\"function_execute\":\"get_cur_data()\",\"auth_type\":\"token\",\"token_from\":\"prev_response\",\"token_url\":\"\",\"username\":\"\",\"password\":\"\",\"data_source\":\"\",\"get_data_function\":\"\",\"form_data\":\"\"},\"SEstartEvnet3\":{\"step_no\":\"3\",\"if_fail\":\"continue\",\"next_process\":\"4\",\"keywords\":\"NSO\",\"api_url\":\"\",\"api_method\":\"\",\"api_type\":\"\",\"api_headers\":\"\",\"function_execute\":\"\",\"auth_type\":\"\",\"token_from\":\"\",\"token_url\":\"\",\"username\":\"\",\"password\":\"\",\"data_source\":\"form_data\",\"get_data_function\":\"\",\"form_data\":\"test3\"},\"SEstartEvnet4\":{\"step_no\":\"4\",\"if_fail\":\"stop\",\"next_process\":\"0\",\"keywords\":\"API\",\"api_url\":\"http:\\/\\/localhost\\/bpnm-api\\/postapi.php\",\"api_method\":\"post\",\"api_type\":\"rest\",\"api_headers\":\"no\",\"function_execute\":\"get_cur_data()\",\"auth_type\":\"token\",\"token_from\":\"prev_response\",\"token_url\":\"\",\"username\":\"\",\"password\":\"\",\"data_source\":\"\",\"get_data_function\":\"\",\"form_data\":\"\"}}', '{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":245,\"y\":183,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"},{\"id\":\"startEvnet2\",\"x\":416.0104064941406,\"y\":184.0104217529297,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"},{\"id\":\"startEvnet3\",\"x\":590,\"y\":187,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"},{\"id\":\"startEvnet4\",\"x\":735,\"y\":186,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":436.01042294022045,\"start_y\":184.01042544096708,\"end_x\":560.0000281333923,\"end_y\":187.00001230769703,\"mid_x\":498.0052255368064,\"start_id\":\"startEvnet2\",\"end_id\":\"startEvnet3\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":705.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":657.5000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow1\",\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":710.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":660.0000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"}]}', 1588658789, 1589459294, NULL, 2, 0);

--
-- Dumping data for table `workflow_execution`
--

INSERT INTO `workflow_execution` (`id`, `instance_id`, `request_params`, `response_params`, `execution_id`, `created_at`, `updated_at`, `executed_by`, `status`) VALUES
(1, 3, '1', '[\"result for the get request api\",\"success\",200]', 'ex5ebd3a55c8fb5', 1589459541, 1589459541, 0, 1),
(2, 3, '2', 'I am the data returned by function call', 'ex5ebd3a55c8fb5', 1589459542, 1589459542, 0, 1),
(3, 3, '3', 'test3', 'ex5ebd3a55c8fb5', 1589459542, 1589459542, 0, 1),
(4, 3, '4', '[[],\"success\",200]', 'ex5ebd3a55c8fb5', 1589459542, 1589459542, 0, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
