/*!40101 SET NAMES binary*/;
/*!40014 SET FOREIGN_KEY_CHECKS=0*/;

CREATE TABLE `wp_give_logs` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `log_title` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `log_content` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `log_parent` bigint(20) NOT NULL,
  `log_type` mediumtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `log_date` datetime NOT NULL,
  `log_date_gmt` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
