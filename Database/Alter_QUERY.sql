/*  alter query 28 april 2020 */

ALTER TABLE `workflow` ADD `is_instance` TINYINT(1) NOT NULL DEFAULT '0' AFTER `workflow_template_id`;


/* alter query 28 april 2020 */


DROP TABLE IF EXISTS `tbl_keywords`;
CREATE TABLE `tbl_keywords` (
  `id` int(11) NOT NULL,
  `keyword_name` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_keywords` VALUES (1,'Precheck',0,'0000-00-00 00:00:00','0','0000-00-00 00:00:00','0'),(2,'Postcheck',0,'0000-00-00 00:00:00','0','0000-00-00 00:00:00','0'),(3,'NSO',0,'0000-00-00 00:00:00','0','0000-00-00 00:00:00','0'),(4,'API',0,'2020-04-25 13:24:35','0','2020-04-25 13:24:35','0'),(5,'Command Execution',0,'2020-04-25 13:25:58','0','2020-04-25 13:25:58','0'),(6,'Config Push',0,'2020-04-25 13:25:58','0','2020-04-25 13:25:58','0');


CREATE TABLE `project`.`tbl_functions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `function_name` VARCHAR(50) NULL,
  `function_type` ENUM('EXECUTABLE', 'GETDATA') NULL,
  `deleted` INT NULL DEFAULT 0,
  PRIMARY KEY (`id`));

INSERT INTO `tbl_functions` VALUES (1,'execute_curl_json','EXECUTABLE',0),(2,'fil_get_contents','EXECUTABLE',0),(3,'execute_curl_xml','EXECUTABLE',0);


#######################################


ALTER TABLE `tbl_commands` CHANGE `created_at` `created_at` INT(11) NOT NULL
ALTER TABLE `tbl_commands` CHANGE `created_by` `created_by` INT(11) NOT NULL
ALTER TABLE `tbl_commands` CHANGE `updated_at` `updated_at` INT(11) NOT NULL
ALTER TABLE `tbl_commands` CHANGE `updated_by` `updated_by` INT(11) NOT NULL


truncate workflow;
truncate workflow_templates;

ALTER TABLE `workflow` 
ADD COLUMN `workflow_template_id` INT(11) NOT NULL AFTER `updated_by`;

  ALTER TABLE workflow
ADD CONSTRAINT FK_WORKFLOW_TEMPLATE_ID
FOREIGN KEY (workflow_template_id) REFERENCES workflow_templates(id);

INSERT INTO `tbl_functions` (`id`, `function_name`, `function_type`, `deleted`) VALUES ('4', 'get_data', 'GETDATA', '0');
INSERT INTO `tbl_functions` (`id`, `function_name`, `function_type`, `deleted`) VALUES ('5', 'get_nso_data', 'GETDATA', '0');






