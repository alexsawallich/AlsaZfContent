CREATE TABLE IF NOT EXISTS `content` (
  `content_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_body` text NOT NULL,
  `content_name` varchar(255) NOT NULL,
  `content_status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;