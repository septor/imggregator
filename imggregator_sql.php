CREATE TABLE hooks (
	`hook_id` int(10) unsigned NOT NULL auto_increment,
	`hook_name` varchar(255) default NULL,
	`hook_tokens` varchar(255) NOT NULL,
	PRIMARY KEY (`hook_id`)
) ENGINE=MyISAM;
