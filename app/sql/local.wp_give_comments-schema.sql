/*!40101 SET NAMES binary*/;
/*!40014 SET FOREIGN_KEY_CHECKS=0*/;

CREATE TABLE `wp_give_comments` (
  `comment_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `comment_content` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_parent` mediumtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_type` mediumtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment_date_gmt` datetime NOT NULL,
  PRIMARY KEY (`comment_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
