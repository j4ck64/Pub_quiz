-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'user'
-- 
-- ---

DROP TABLE IF EXISTS `user`;
		
CREATE TABLE `user` (
  `id` INTEGER NOT NULL AUTO_INCREMENT DEFAULT NULL,
  `team_name` VARCHAR(30) NOT NULL DEFAULT 'NULL',
  `password` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'questions'
-- 
-- ---

DROP TABLE IF EXISTS `questions`;
		
CREATE TABLE `questions` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `q1` VARCHAR(300) NOT NULL,
  `q2` VARCHAR(300) NOT NULL,
  `q3` VARCHAR(300) NOT NULL,
  `q4` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'answers'
-- 
-- ---

DROP TABLE IF EXISTS `answers`;
		
CREATE TABLE `answers` (
  `id` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `questions_id` INTEGER(200) NOT NULL DEFAULT 1,
  `a1` VARCHAR(300) NOT NULL,
  `a2` VARCHAR(300) NOT NULL,
  `a3` VARCHAR(300) NOT NULL,
  `a4` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `answers` ADD FOREIGN KEY (questions_id) REFERENCES `questions` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `user` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `questions` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `answers` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---
INSERT INTO `user` (`id`,`team_name`,`password`) VALUES
('','test','test');

INSERT INTO `questions` (`id`,`q1`,`q2`,`q3`,`q4`) VALUES
('','1+1','2+2','3+3','4++4');

INSERT INTO `answers` (`id`,`questions_id`,`a1`,`a2`,`a3`,`a4`) VALUES
('1','1','2','4','6','8');

-- INSERT INTO `user` (`id`,`team_name`,`password`) VALUES
-- ('','','');
-- INSERT INTO `questions` (`id`,`q1`,`q2`,`q3`,`q4`) VALUES
-- ('','','','','');
-- INSERT INTO `answers` (`id`,`questions_id`,`a1`,`a2`,`a3`,`a4`) VALUES
-- ('','','','','','');