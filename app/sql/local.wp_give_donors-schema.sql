/*!40101 SET NAMES binary*/;
/*!40014 SET FOREIGN_KEY_CHECKS=0*/;

CREATE TABLE `wp_give_donors` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` mediumtext NOT NULL,
  `purchase_value` mediumtext NOT NULL,
  `purchase_count` bigint(20) NOT NULL,
  `payment_ids` longtext NOT NULL,
  `notes` longtext NOT NULL,
  `date_created` datetime NOT NULL,
  `token` varchar(255) NOT NULL,
  `verify_key` varchar(255) NOT NULL,
  `verify_throttle` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
