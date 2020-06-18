-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2020 at 02:43 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_workflow`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1591449443);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1591448988, 1591448988),
('/admin/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/assignment/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/assignment/assign', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/assignment/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/assignment/view', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/default/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/default/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/menu/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/menu/create', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/menu/delete', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/menu/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/menu/update', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/menu/view', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/permission/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/permission/assign', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/permission/create', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/permission/delete', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/permission/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/permission/remove', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/permission/update', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/permission/view', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/role/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/role/assign', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/role/create', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/role/delete', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/role/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/role/remove', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/role/update', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/role/view', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/route/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/route/assign', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/route/create', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/route/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/route/refresh', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/route/remove', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/rule/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/rule/create', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/rule/delete', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/rule/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/rule/update', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/rule/view', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/user/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/user/activate', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/user/change-password', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/user/delete', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/user/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/user/login', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/user/logout', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/user/reset-password', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/user/signup', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/admin/user/view', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/debug/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/debug/default/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/debug/default/db-explain', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/debug/default/download-mail', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/debug/default/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/debug/default/toolbar', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/debug/default/view', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/debug/user/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/debug/user/reset-identity', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/debug/user/set-identity', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/gii/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/gii/default/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/gii/default/action', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/gii/default/diff', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/gii/default/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/gii/default/preview', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/gii/default/view', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/gridview/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/gridview/export/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/gridview/export/download', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/site/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/site/about', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/site/captcha', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/site/contact', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/site/error', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/site/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/site/login', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/site/logout', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/site/register', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/threshold/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/threshold/default/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/threshold/default/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/threshold/service-threshold/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/threshold/service-threshold/create', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/threshold/service-threshold/delete', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/threshold/service-threshold/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/threshold/service-threshold/update', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/threshold/service-threshold/view', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/default/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/default/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/tbl-commands/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/tbl-commands/create', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/tbl-commands/delete', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/tbl-commands/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/tbl-commands/update', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/tbl-commands/view', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/tbl-keywords/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/tbl-keywords/create', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/tbl-keywords/delete', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/tbl-keywords/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/tbl-keywords/update', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/tbl-keywords/view', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/workflow-execution-reports/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/workflow-execution-reports/get-workflow-executed-detai', 2, NULL, NULL, NULL, 1591449379, 1591449379),
('/workflow/workflow-execution-reports/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/workflow-execution/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/workflow-execution/execute-running-process', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/workflow-execution/get-running-process', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/workflow-execution/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/workflow/*', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/workflow/create', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/workflow/create-workflow', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/workflow/create-workflow-clone', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/workflow/delete', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/workflow/get-ajax-form', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/workflow/index', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/workflow/mongo-create', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/workflow/save-workflow', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/workflow/update', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('/workflow/workflow/view', 2, NULL, NULL, NULL, 1591448996, 1591448996),
('admin', 1, NULL, NULL, NULL, 1591449327, 1591449327),
('super user', 2, NULL, NULL, NULL, 1591449483, 1591449483);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', '/*'),
('admin', '/admin/*'),
('admin', '/admin/assignment/*'),
('admin', '/admin/assignment/assign'),
('admin', '/admin/assignment/index'),
('admin', '/admin/assignment/revoke'),
('admin', '/admin/assignment/view'),
('admin', '/admin/default/*'),
('admin', '/admin/default/index'),
('admin', '/admin/menu/*'),
('admin', '/admin/menu/create'),
('admin', '/admin/menu/delete'),
('admin', '/admin/menu/index'),
('admin', '/admin/menu/update'),
('admin', '/admin/menu/view'),
('admin', '/admin/permission/*'),
('admin', '/admin/permission/assign'),
('admin', '/admin/permission/create'),
('admin', '/admin/permission/delete'),
('admin', '/admin/permission/index'),
('admin', '/admin/permission/remove'),
('admin', '/admin/permission/update'),
('admin', '/admin/permission/view'),
('admin', '/admin/role/*'),
('admin', '/admin/role/assign'),
('admin', '/admin/role/create'),
('admin', '/admin/role/delete'),
('admin', '/admin/role/index'),
('admin', '/admin/role/remove'),
('admin', '/admin/role/update'),
('admin', '/admin/role/view'),
('admin', '/admin/route/*'),
('admin', '/admin/route/assign'),
('admin', '/admin/route/create'),
('admin', '/admin/route/index'),
('admin', '/admin/route/refresh'),
('admin', '/admin/route/remove'),
('admin', '/admin/rule/*'),
('admin', '/admin/rule/create'),
('admin', '/admin/rule/delete'),
('admin', '/admin/rule/index'),
('admin', '/admin/rule/update'),
('admin', '/admin/rule/view'),
('admin', '/admin/user/*'),
('admin', '/admin/user/activate'),
('admin', '/admin/user/change-password'),
('admin', '/admin/user/delete'),
('admin', '/admin/user/index'),
('admin', '/admin/user/login'),
('admin', '/admin/user/logout'),
('admin', '/admin/user/request-password-reset'),
('admin', '/admin/user/reset-password'),
('admin', '/admin/user/signup'),
('admin', '/admin/user/view'),
('admin', '/debug/*'),
('admin', '/debug/default/*'),
('admin', '/debug/default/db-explain'),
('admin', '/debug/default/download-mail'),
('admin', '/debug/default/index'),
('admin', '/debug/default/toolbar'),
('admin', '/debug/default/view'),
('admin', '/debug/user/*'),
('admin', '/debug/user/reset-identity'),
('admin', '/debug/user/set-identity'),
('admin', '/gii/*'),
('admin', '/gii/default/*'),
('admin', '/gii/default/action'),
('admin', '/gii/default/diff'),
('admin', '/gii/default/index'),
('admin', '/gii/default/preview'),
('admin', '/gii/default/view'),
('admin', '/gridview/*'),
('admin', '/gridview/export/*'),
('admin', '/gridview/export/download'),
('admin', '/site/*'),
('admin', '/site/about'),
('admin', '/site/captcha'),
('admin', '/site/contact'),
('admin', '/site/error'),
('admin', '/site/index'),
('admin', '/site/login'),
('admin', '/site/logout'),
('admin', '/site/register'),
('admin', '/threshold/*'),
('admin', '/threshold/default/*'),
('admin', '/threshold/default/index'),
('admin', '/threshold/service-threshold/*'),
('admin', '/threshold/service-threshold/create'),
('admin', '/threshold/service-threshold/delete'),
('admin', '/threshold/service-threshold/index'),
('admin', '/threshold/service-threshold/update'),
('admin', '/threshold/service-threshold/view'),
('admin', '/workflow/*'),
('admin', '/workflow/default/*'),
('admin', '/workflow/default/index'),
('admin', '/workflow/tbl-commands/*'),
('admin', '/workflow/tbl-commands/create'),
('admin', '/workflow/tbl-commands/delete'),
('admin', '/workflow/tbl-commands/index'),
('admin', '/workflow/tbl-commands/update'),
('admin', '/workflow/tbl-commands/view'),
('admin', '/workflow/tbl-keywords/*'),
('admin', '/workflow/tbl-keywords/create'),
('admin', '/workflow/tbl-keywords/delete'),
('admin', '/workflow/tbl-keywords/index'),
('admin', '/workflow/tbl-keywords/update'),
('admin', '/workflow/tbl-keywords/view'),
('admin', '/workflow/workflow-execution-reports/*'),
('admin', '/workflow/workflow-execution-reports/index'),
('admin', '/workflow/workflow-execution/*'),
('admin', '/workflow/workflow-execution/execute-running-process'),
('admin', '/workflow/workflow-execution/get-running-process'),
('admin', '/workflow/workflow-execution/index'),
('admin', '/workflow/workflow/*'),
('admin', '/workflow/workflow/create'),
('admin', '/workflow/workflow/create-workflow'),
('admin', '/workflow/workflow/create-workflow-clone'),
('admin', '/workflow/workflow/delete'),
('admin', '/workflow/workflow/get-ajax-form'),
('admin', '/workflow/workflow/index'),
('admin', '/workflow/workflow/mongo-create'),
('admin', '/workflow/workflow/save-workflow'),
('admin', '/workflow/workflow/update'),
('admin', '/workflow/workflow/view'),
('super user', '/*'),
('super user', '/admin/*'),
('super user', '/admin/assignment/*'),
('super user', '/admin/assignment/assign'),
('super user', '/admin/assignment/index'),
('super user', '/admin/assignment/revoke'),
('super user', '/admin/assignment/view'),
('super user', '/admin/default/*'),
('super user', '/admin/default/index'),
('super user', '/admin/menu/*'),
('super user', '/admin/menu/create'),
('super user', '/admin/menu/delete'),
('super user', '/admin/menu/index'),
('super user', '/admin/menu/update'),
('super user', '/admin/menu/view'),
('super user', '/admin/permission/*'),
('super user', '/admin/permission/assign'),
('super user', '/admin/permission/create'),
('super user', '/admin/permission/delete'),
('super user', '/admin/permission/index'),
('super user', '/admin/permission/remove'),
('super user', '/admin/permission/update'),
('super user', '/admin/permission/view'),
('super user', '/admin/role/*'),
('super user', '/admin/role/assign'),
('super user', '/admin/role/create'),
('super user', '/admin/role/delete'),
('super user', '/admin/role/index'),
('super user', '/admin/role/remove'),
('super user', '/admin/role/update'),
('super user', '/admin/role/view'),
('super user', '/admin/route/*'),
('super user', '/admin/route/assign'),
('super user', '/admin/route/create'),
('super user', '/admin/route/index'),
('super user', '/admin/route/refresh'),
('super user', '/admin/route/remove'),
('super user', '/admin/rule/*'),
('super user', '/admin/rule/create'),
('super user', '/admin/rule/delete'),
('super user', '/admin/rule/index'),
('super user', '/admin/rule/update'),
('super user', '/admin/rule/view'),
('super user', '/admin/user/*'),
('super user', '/admin/user/activate'),
('super user', '/admin/user/change-password'),
('super user', '/admin/user/delete'),
('super user', '/admin/user/index'),
('super user', '/admin/user/login'),
('super user', '/admin/user/logout'),
('super user', '/admin/user/request-password-reset'),
('super user', '/admin/user/reset-password'),
('super user', '/admin/user/signup'),
('super user', '/admin/user/view'),
('super user', '/debug/*'),
('super user', '/debug/default/*'),
('super user', '/debug/default/db-explain'),
('super user', '/debug/default/download-mail'),
('super user', '/debug/default/index'),
('super user', '/debug/default/toolbar'),
('super user', '/debug/default/view'),
('super user', '/debug/user/*'),
('super user', '/debug/user/reset-identity'),
('super user', '/debug/user/set-identity'),
('super user', '/gii/*'),
('super user', '/gii/default/*'),
('super user', '/gii/default/action'),
('super user', '/gii/default/diff'),
('super user', '/gii/default/index'),
('super user', '/gii/default/preview'),
('super user', '/gii/default/view'),
('super user', '/gridview/*'),
('super user', '/gridview/export/*'),
('super user', '/gridview/export/download'),
('super user', '/site/*'),
('super user', '/site/about'),
('super user', '/site/captcha'),
('super user', '/site/contact'),
('super user', '/site/error'),
('super user', '/site/index'),
('super user', '/site/login'),
('super user', '/site/logout'),
('super user', '/site/register'),
('super user', '/threshold/*'),
('super user', '/threshold/default/*'),
('super user', '/threshold/default/index'),
('super user', '/threshold/service-threshold/*'),
('super user', '/threshold/service-threshold/create'),
('super user', '/threshold/service-threshold/delete'),
('super user', '/threshold/service-threshold/index'),
('super user', '/threshold/service-threshold/update'),
('super user', '/threshold/service-threshold/view'),
('super user', '/workflow/*'),
('super user', '/workflow/default/*'),
('super user', '/workflow/default/index'),
('super user', '/workflow/tbl-commands/*'),
('super user', '/workflow/tbl-commands/create'),
('super user', '/workflow/tbl-commands/delete'),
('super user', '/workflow/tbl-commands/index'),
('super user', '/workflow/tbl-commands/update'),
('super user', '/workflow/tbl-commands/view'),
('super user', '/workflow/tbl-keywords/*'),
('super user', '/workflow/tbl-keywords/create'),
('super user', '/workflow/tbl-keywords/delete'),
('super user', '/workflow/tbl-keywords/index'),
('super user', '/workflow/tbl-keywords/update'),
('super user', '/workflow/tbl-keywords/view'),
('super user', '/workflow/workflow-execution-reports/*'),
('super user', '/workflow/workflow-execution-reports/get-workflow-executed-detai'),
('super user', '/workflow/workflow-execution-reports/index'),
('super user', '/workflow/workflow-execution/*'),
('super user', '/workflow/workflow-execution/execute-running-process'),
('super user', '/workflow/workflow-execution/get-running-process'),
('super user', '/workflow/workflow-execution/index'),
('super user', '/workflow/workflow/*'),
('super user', '/workflow/workflow/create'),
('super user', '/workflow/workflow/create-workflow'),
('super user', '/workflow/workflow/create-workflow-clone'),
('super user', '/workflow/workflow/delete'),
('super user', '/workflow/workflow/get-ajax-form'),
('super user', '/workflow/workflow/index'),
('super user', '/workflow/workflow/mongo-create'),
('super user', '/workflow/workflow/save-workflow'),
('super user', '/workflow/workflow/update'),
('super user', '/workflow/workflow/view');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1591448268),
('m140506_102106_rbac_init', 1591448866),
('m140602_111327_create_menu_table', 1591448331),
('m160312_050000_create_user', 1591448331),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1591448866),
('m180523_151638_rbac_updates_indexes_without_prefix', 1591448866),
('m200409_110543_rbac_update_mssql_trigger', 1591448867),
('m200521_175100_create_tbl_commands_table', 1591448280),
('m200521_175115_create_tbl_functions_table', 1591448280),
('m200521_175129_create_tbl_keywords_table', 1591448281),
('m200521_175149_create_tbl_workflow_table', 1591448281),
('m200521_175204_create_tbl_workflow_execution_table', 1591448281),
('m200606_085219_create_tbl_service_threshold_table', 1591448281);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_commands`
--

CREATE TABLE `tbl_commands` (
  `id` int(11) NOT NULL,
  `command_name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_functions`
--

CREATE TABLE `tbl_functions` (
  `id` int(11) NOT NULL,
  `function_name` varchar(255) NOT NULL,
  `function_type` varchar(50) NOT NULL,
  `tbl_functionscol` varchar(45) NOT NULL,
  `function_url` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_functions`
--

INSERT INTO `tbl_functions` (`id`, `function_name`, `function_type`, `tbl_functionscol`, `function_url`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`) VALUES
(1, 'get_cur_data()', 'EXECUTABLE', 'col', 'url', 2147483647, NULL, 2147483647, NULL, 0),
(2, 'get_nso_data()', 'EXECUTABLE', 'col', 'url', 2147483647, NULL, 2147483647, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keywords`
--

CREATE TABLE `tbl_keywords` (
  `id` int(11) NOT NULL,
  `keyword_name` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_keywords`
--

INSERT INTO `tbl_keywords` (`id`, `keyword_name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`) VALUES
(1, 'Precheck', 2147483647, NULL, 2147483647, NULL, 0),
(2, 'Postcheck', 2147483647, NULL, 2147483647, NULL, 0),
(3, 'NSO', 2147483647, NULL, 2147483647, NULL, 0),
(4, 'API', 2147483647, NULL, 2147483647, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_threshold`
--

CREATE TABLE `tbl_service_threshold` (
  `id` int(11) NOT NULL,
  `service_type` varchar(255) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `threshold_for_peak_in_last_15days` int(11) NOT NULL,
  `threshold_for_current_utilisation` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_workflow`
--

CREATE TABLE `tbl_workflow` (
  `id` int(11) NOT NULL,
  `workflow_title` varchar(100) NOT NULL,
  `workflow_description` varchar(200) DEFAULT NULL,
  `workflow_data` longtext DEFAULT NULL,
  `workflow_json` longtext DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_workflow`
--

INSERT INTO `tbl_workflow` (`id`, `workflow_title`, `workflow_description`, `workflow_data`, `workflow_json`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`) VALUES
(1, 'Workflow-3', 'Workflow with multiple elements', '{\"SEstartEvnet2\":{\"step_no\":\"2\",\"if_fail\":\"stop\",\"next_process\":\"3\",\"keywords\":\"NSO\",\"api_url\":\"\",\"api_method\":\"\",\"api_type\":\"\",\"api_headers\":\"\",\"function_execute\":\"\",\"auth_type\":\"\",\"token_from\":\"\",\"token_url\":\"\",\"username\":\"\",\"password\":\"\",\"data_source\":\"function_name\",\"get_data_function\":\"workflow-execution/functionex\",\"form_data\":\"test22\"},\"SEstartEvnet1\":{\"step_no\":\"1\",\"if_fail\":\"continue\",\"next_process\":\"2\",\"keywords\":\"API\",\"api_url\":\"http://localhost/bpnm-api/getapi.php\",\"api_method\":\"get\",\"api_type\":\"rest\",\"api_headers\":\"no\",\"function_execute\":\"get_cur_data()\",\"auth_type\":\"token\",\"token_from\":\"prev_response\",\"token_url\":\"\",\"username\":\"\",\"password\":\"\",\"data_source\":\"\",\"get_data_function\":\"\",\"form_data\":\"\"},\"SEstartEvnet3\":{\"step_no\":\"3\",\"if_fail\":\"continue\",\"next_process\":\"4\",\"keywords\":\"NSO\",\"api_url\":\"\",\"api_method\":\"\",\"api_type\":\"\",\"api_headers\":\"\",\"function_execute\":\"\",\"auth_type\":\"\",\"token_from\":\"\",\"token_url\":\"\",\"username\":\"\",\"password\":\"\",\"data_source\":\"form_data\",\"get_data_function\":\"\",\"form_data\":\"test3\"},\"SEstartEvnet4\":{\"step_no\":\"4\",\"if_fail\":\"stop\",\"next_process\":\"0\",\"keywords\":\"API\",\"api_url\":\"http://localhost/bpnm-api/postapi.php\",\"api_method\":\"post\",\"api_type\":\"rest\",\"api_headers\":\"no\",\"function_execute\":\"get_cur_data()\",\"auth_type\":\"token\",\"token_from\":\"prev_response\",\"token_url\":\"\",\"username\":\"\",\"password\":\"\",\"data_source\":\"\",\"get_data_function\":\"\",\"form_data\":\"\"}}', '{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":245,\"y\":183,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":\"1\"},{\"id\":\"startEvnet2\",\"x\":416.0104064941406,\"y\":184.0104217529297,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":\"1\"},{\"id\":\"startEvnet3\",\"x\":590,\"y\":187,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":\"1\"},{\"id\":\"startEvnet4\",\"x\":735,\"y\":186,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":\"1\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":436.01042294022045,\"start_y\":184.01042544096708,\"end_x\":560.0000281333923,\"end_y\":187.00001230769703,\"mid_x\":498.0052255368064,\"start_id\":\"startEvnet2\",\"end_id\":\"startEvnet3\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow1\",\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":710.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":660.0000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"}]}', 2147483647, NULL, 1592476350, 1, 0),
(2, 'Workflow-1', 'test', '', '', 1592213482, NULL, 1592213644, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_workflow_execution`
--

CREATE TABLE `tbl_workflow_execution` (
  `id` int(11) NOT NULL,
  `instance_id` int(11) NOT NULL,
  `execution_id` varchar(100) DEFAULT NULL,
  `request_params` longtext DEFAULT NULL,
  `next_step` int(11) DEFAULT NULL,
  `response_params` longtext DEFAULT NULL,
  `api_domain` varchar(255) DEFAULT NULL,
  `auth_token` varchar(255) DEFAULT NULL,
  `workflow_diagram` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `executed_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_workflow_execution`
--

INSERT INTO `tbl_workflow_execution` (`id`, `instance_id`, `execution_id`, `request_params`, `next_step`, `response_params`, `api_domain`, `auth_token`, `workflow_diagram`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `executed_by`, `is_deleted`) VALUES
(1, 1, 'ex5edb9defda29d', 'SEstartEvnet1', 2, '<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\"\"http://www.w3.org/TR/html4/strict.dtd\">\r\n<HTML><HEAD><TITLE>Not Found</TITLE>\r\n<META HTTP-EQUIV=\"Content-Type\" Content=\"text/html; charset=us-ascii\"></HEAD>\r\n<BODY><h2>Not Found</h2>\r\n<hr><p>HTTP Error 404. The requested resource is not found.</p>\r\n</BODY></HTML>\r\n', '', '', '{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":245,\"y\":183,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet2\",\"x\":416.0104064941406,\"y\":184.0104217529297,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet3\",\"x\":590,\"y\":187,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet4\",\"x\":735,\"y\":186,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":\"1\"},{\"id\":0,\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":436.01042294022045,\"start_y\":184.01042544096708,\"end_x\":560.0000281333923,\"end_y\":187.00001230769703,\"mid_x\":498.0052255368064,\"start_id\":\"startEvnet2\",\"end_id\":\"startEvnet3\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":705.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":657.5000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow1\",\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":710.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":660.0000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"}]}', 2, 1591451119, NULL, 1591451121, NULL, NULL, 0),
(2, 1, 'ex5edb9defda29d', 'SEstartEvnet2', 3, 'I am the data returned by function call', NULL, NULL, '{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":245,\"y\":183,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet2\",\"x\":416.0104064941406,\"y\":184.0104217529297,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet3\",\"x\":590,\"y\":187,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet4\",\"x\":735,\"y\":186,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":\"1\"},{\"id\":0,\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":436.01042294022045,\"start_y\":184.01042544096708,\"end_x\":560.0000281333923,\"end_y\":187.00001230769703,\"mid_x\":498.0052255368064,\"start_id\":\"startEvnet2\",\"end_id\":\"startEvnet3\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":705.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":657.5000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow1\",\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":710.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":660.0000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"}]}', 2, 1591451119, NULL, 1591451122, NULL, NULL, 0),
(3, 1, 'ex5edb9defda29d', 'SEstartEvnet3', 4, 'test3', NULL, NULL, '{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":245,\"y\":183,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet2\",\"x\":416.0104064941406,\"y\":184.0104217529297,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet3\",\"x\":590,\"y\":187,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet4\",\"x\":735,\"y\":186,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":\"1\"},{\"id\":0,\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":436.01042294022045,\"start_y\":184.01042544096708,\"end_x\":560.0000281333923,\"end_y\":187.00001230769703,\"mid_x\":498.0052255368064,\"start_id\":\"startEvnet2\",\"end_id\":\"startEvnet3\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":705.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":657.5000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow1\",\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":710.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":660.0000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"}]}', 2, 1591451119, NULL, 1591451122, NULL, NULL, 0),
(4, 1, 'ex5edb9defda29d', 'SEstartEvnet4', NULL, NULL, NULL, NULL, '{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":245,\"y\":183,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet2\",\"x\":416.0104064941406,\"y\":184.0104217529297,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet3\",\"x\":590,\"y\":187,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet4\",\"x\":735,\"y\":186,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":\"1\"},{\"id\":0,\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":436.01042294022045,\"start_y\":184.01042544096708,\"end_x\":560.0000281333923,\"end_y\":187.00001230769703,\"mid_x\":498.0052255368064,\"start_id\":\"startEvnet2\",\"end_id\":\"startEvnet3\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":705.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":657.5000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow1\",\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":710.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":660.0000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"}]}', 1, 1591451119, NULL, NULL, NULL, NULL, 0),
(5, 1, 'ex5ee330d140c98', 'SEstartEvnet1', 2, '<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\"\"http://www.w3.org/TR/html4/strict.dtd\">\r\n<HTML><HEAD><TITLE>Not Found</TITLE>\r\n<META HTTP-EQUIV=\"Content-Type\" Content=\"text/html; charset=us-ascii\"></HEAD>\r\n<BODY><h2>Not Found</h2>\r\n<hr><p>HTTP Error 404. The requested resource is not found.</p>\r\n</BODY></HTML>\r\n', '', '', '{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":245,\"y\":183,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet2\",\"x\":416.0104064941406,\"y\":184.0104217529297,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet3\",\"x\":590,\"y\":187,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet4\",\"x\":735,\"y\":186,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":\"1\"},{\"id\":0,\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":436.01042294022045,\"start_y\":184.01042544096708,\"end_x\":560.0000281333923,\"end_y\":187.00001230769703,\"mid_x\":498.0052255368064,\"start_id\":\"startEvnet2\",\"end_id\":\"startEvnet3\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":705.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":657.5000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow1\",\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":710.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":660.0000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"}]}', 2, 1591947473, NULL, 1591947473, NULL, NULL, 0),
(6, 1, 'ex5ee330d140c98', 'SEstartEvnet2', 3, 'I am the data returned by function call', NULL, NULL, '{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":245,\"y\":183,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet2\",\"x\":416.0104064941406,\"y\":184.0104217529297,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet3\",\"x\":590,\"y\":187,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet4\",\"x\":735,\"y\":186,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":\"1\"},{\"id\":0,\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":436.01042294022045,\"start_y\":184.01042544096708,\"end_x\":560.0000281333923,\"end_y\":187.00001230769703,\"mid_x\":498.0052255368064,\"start_id\":\"startEvnet2\",\"end_id\":\"startEvnet3\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":705.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":657.5000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow1\",\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":710.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":660.0000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"}]}', 2, 1591947473, NULL, 1591947474, NULL, NULL, 0),
(7, 1, 'ex5ee330d140c98', 'SEstartEvnet3', 4, 'test3', NULL, NULL, '{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":245,\"y\":183,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet2\",\"x\":416.0104064941406,\"y\":184.0104217529297,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet3\",\"x\":590,\"y\":187,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet4\",\"x\":735,\"y\":186,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":\"1\"},{\"id\":0,\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":436.01042294022045,\"start_y\":184.01042544096708,\"end_x\":560.0000281333923,\"end_y\":187.00001230769703,\"mid_x\":498.0052255368064,\"start_id\":\"startEvnet2\",\"end_id\":\"startEvnet3\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":705.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":657.5000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow1\",\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":710.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":660.0000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"}]}', 2, 1591947473, NULL, 1591947474, NULL, NULL, 0),
(8, 1, 'ex5ee330d140c98', 'SEstartEvnet4', NULL, NULL, NULL, NULL, '{\"bpmn\":[{\"id\":\"startEvnet1\",\"x\":245,\"y\":183,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet2\",\"x\":416.0104064941406,\"y\":184.0104217529297,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet3\",\"x\":590,\"y\":187,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":2},{\"id\":\"startEvnet4\",\"x\":735,\"y\":186,\"width\":20,\"height\":20,\"type\":\"startEvnet\",\"subtype\":\"StartEvent\",\"status\":\"1\"},{\"id\":0,\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":436.01042294022045,\"start_y\":184.01042544096708,\"end_x\":560.0000281333923,\"end_y\":187.00001230769703,\"mid_x\":498.0052255368064,\"start_id\":\"startEvnet2\",\"end_id\":\"startEvnet3\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":705.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":657.5000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":0,\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow1\",\"type\":\"flow\",\"start_x\":265.0000116825104,\"start_y\":183.00000533527782,\"end_x\":386.01042294022045,\"end_y\":184.01042544096708,\"mid_x\":325.5052173113654,\"start_id\":\"startEvnet1\",\"end_id\":\"startEvnet2\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"},{\"id\":\"flow2\",\"type\":\"flow\",\"start_x\":610.0000281333923,\"start_y\":187.00001230769703,\"end_x\":710.0000350475311,\"end_y\":186.0000020874868,\"mid_x\":660.0000315904617,\"start_id\":\"startEvnet3\",\"end_id\":\"startEvnet4\",\"start_type\":\"startEvent\",\"end_type\":\"endEvent\"}]}', 1, 1591947473, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `threshold_settings`
--

CREATE TABLE `threshold_settings` (
  `id` int(11) NOT NULL,
  `threshold_name` varchar(255) NOT NULL,
  `threshold_condition` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threshold_settings`
--

INSERT INTO `threshold_settings` (`id`, `threshold_name`, `threshold_condition`, `value`, `is_deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'CCSM', 'less_than_equal', '80', 0, 1, 1, 1592483576, 1592483576),
(2, 'BPA', 'less_than_equal', '70', 0, 1, 1, 1592483592, 1592483592),
(3, 'SRA', 'less_than_equal', '80', 0, 1, 1, 1592483605, 1592483605);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'ylloJbHqb_cIZWwsqqIuqisdsMCRUwqn', '$2y$13$W1elUw0TLihhBQ.RxfQaFeQrjGpzfsLt.kTNM.GUjnd5KuLR0aeYK', NULL, 'admin@test.com', 10, 1591449220, 1591449220);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `tbl_commands`
--
ALTER TABLE `tbl_commands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `command_name` (`command_name`);

--
-- Indexes for table `tbl_functions`
--
ALTER TABLE `tbl_functions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_keywords`
--
ALTER TABLE `tbl_keywords`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `keyword_name` (`keyword_name`);

--
-- Indexes for table `tbl_service_threshold`
--
ALTER TABLE `tbl_service_threshold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_workflow`
--
ALTER TABLE `tbl_workflow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_workflow_execution`
--
ALTER TABLE `tbl_workflow_execution`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-tbl_workflow_execution-instance_id` (`instance_id`);

--
-- Indexes for table `threshold_settings`
--
ALTER TABLE `threshold_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_commands`
--
ALTER TABLE `tbl_commands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_functions`
--
ALTER TABLE `tbl_functions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_keywords`
--
ALTER TABLE `tbl_keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_service_threshold`
--
ALTER TABLE `tbl_service_threshold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_workflow`
--
ALTER TABLE `tbl_workflow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_workflow_execution`
--
ALTER TABLE `tbl_workflow_execution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `threshold_settings`
--
ALTER TABLE `threshold_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_workflow_execution`
--
ALTER TABLE `tbl_workflow_execution`
  ADD CONSTRAINT `fk-tbl_workflow_execution-instance_id` FOREIGN KEY (`instance_id`) REFERENCES `tbl_workflow` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
