
--
-- Table structure for table `workflow_templates`
--

CREATE TABLE `workflow_templates` (
  `id` int(11) NOT NULL,
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

INSERT INTO `workflow_templates` (`id`, `workflow_template_title`, `workflow_template_description`, `is_deleted`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(2, 'hello33', 'hello33', 0, 1, 1587978645, 1587978660, NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;
