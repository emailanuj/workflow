
CREATE TABLE `workflow_templates` (
  `id` int(11) NOT NULL,
  `workflow_id` int(11) UNSIGNED NOT NULL,
  `workflow_template_title` varchar(100) DEFAULT NULL,
  `workflow_template_description` varchar(200) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workflow_templates`
--

INSERT INTO `workflow_templates` (`id`, `workflow_id`, `workflow_template_title`, `workflow_template_description`, `is_deleted`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 0, 't1', 't1', 0, 1, 1587994376, 1587994376, NULL, NULL),
(2, 0, 't2', 't2', 0, 1, 1587994472, 1587994472, NULL, NULL),
(3, 0, 't3', 't3', 0, 1, 1587996708, 1587996708, NULL, NULL),
(4, 0, 't4', 't4', 0, 1, 1587996882, 1587996882, NULL, NULL),
(5, 6, 't4', 't4', 0, 1, 1587996905, 1587996906, NULL, NULL),
(6, 7, 't5', 't5', 0, 1, 1587997193, 1587997193, NULL, NULL),
(7, 8, 't9', 't9', 0, 1, 1587998152, 1587998153, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `workflow_templates`
--
ALTER TABLE `workflow_templates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `workflow_templates`
--
ALTER TABLE `workflow_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;
