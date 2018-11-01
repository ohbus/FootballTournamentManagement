DROP TABLE IF EXISTS `matches`;
CREATE TABLE `matches` (
  `match_id` int(11) NOT NULL,
  `team1` varchar(255) NOT NULL,
  `team2` varchar(255) NOT NULL,
  `score1` int(11) DEFAULT NULL,
  `score2` int(11) DEFAULT NULL,
  `played` tinyint(1) NOT NULL
)


INSERT INTO `matches` (`match_id`, `team1`, `team2`, `score1`, `score2`, `played`) VALUES
(1, 'FC Barcelona', 'Atletico Madrid', 0, 0, 0),
(2, 'Bayern Munich', 'Real Madrid', 0, 0, 0),
(3, 'Atletico Madrid', 'Bayern Munich', 0, 0, 0),
(4, 'Real Madrid', 'FC Barcelona', 0, 0, 0),
(5, 'Atletico Madrid', 'Real Madrid', 0, 0, 0),
(6, 'Bayern Munich', 'FC Barcelona', 0, 0, 0);


DROP TABLE IF EXISTS `teams`;
CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `home_stadium` varchar(255) NOT NULL,
  `player_no` int(11) NOT NULL,
  `played` int(11) DEFAULT NULL,
  `won` int(11) DEFAULT NULL,
  `lost` int(11) DEFAULT NULL,
  `tie` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL
) E



INSERT INTO `teams` (`team_id`, `team_name`, `home_stadium`, `player_no`, `played`, `won`, `lost`, `tie`, `points`) VALUES
(1, 'FC Barcelona', 'Camp Nou', 23, 0, 0, 0, 0, 0),
(2, 'Real Madrid', 'Santiago Barnabeu', 22, 0, 0, 0, 0, 0),
(3, 'Bayern Munich', 'Alienz Arena', 22, 0, 0, 0, 0, 0),
(4, 'Atletico Madrid', 'Wanda Metropolitano', 21, 0, 0, 0, 0, 0);


ALTER TABLE `matches`
  ADD PRIMARY KEY (`match_id`);


ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`),
  ADD UNIQUE KEY `team_name` (`team_name`),
  ADD UNIQUE KEY `home_stadium` (`home_stadium`);

ALTER TABLE `matches`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;
