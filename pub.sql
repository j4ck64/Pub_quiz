-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'question'
-- 
-- ---

DROP TABLE IF EXISTS `question`;
		
CREATE TABLE `question` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `question` VARCHAR(300) NOT NULL,
  `slug` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'user_answer'
-- 
-- ---

DROP TABLE IF EXISTS `user_answer`;
		
CREATE TABLE `user_answer` (
  `id` INTEGER NOT NULL AUTO_INCREMENT DEFAULT NULL,
  `answer` VARCHAR(300) NULL DEFAULT NULL,
  `user_id` INTEGER NULL DEFAULT NULL,
  `question_id` INTEGER(100) NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'user'
-- 
-- ---

DROP TABLE IF EXISTS `user`;
		
CREATE TABLE `user` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `email` VARCHAR(40) NOT NULL,
  `password` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'answer'
-- 
-- ---

DROP TABLE IF EXISTS `answer`;
		
CREATE TABLE `answer` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `answer` VARCHAR(300) NULL DEFAULT NULL,
  `question_id` INTEGER NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `user_answer` ADD FOREIGN KEY (user_id) REFERENCES `user` (`id`);
ALTER TABLE `user_answer` ADD FOREIGN KEY (question_id) REFERENCES `question` (`id`);
ALTER TABLE `answer` ADD FOREIGN KEY (question_id) REFERENCES `question` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `question` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `user_answer` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `user` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `answer` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---
INSERT INTO `user` (`id`, `email`, `password`) VALUES 
(NULL, 'test', 'test');

INSERT INTO `question` (`id`,`question`,`slug`) VALUES
(NULL,'1+1','q-1');
INSERT INTO `question` (`id`,`question`,`slug`) VALUES
(NULL,'2+2','q-2');

INSERT INTO `answer` (`id`, `answer`, `question_id`) VALUES (NULL, '2', '1');
INSERT INTO `answer` (`id`, `answer`, `question_id`) VALUES (NULL, '4', '2')



-- INSERT INTO `user` (`id`,`email`,`password`) VALUES
-- ('','','');

-- INSERT INTO `question` (`id`,`question`,`slug`) VALUES
-- ('','','');

-- INSERT INTO `answer` (`id`,`answer`,`question_id`) VALUES
-- ('','','');

-- INSERT INTO `user_answer` (`id`,`answer`,`user_id`,`question_id`) VALUES
-- ('','','','');

