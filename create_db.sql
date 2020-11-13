CREATE DATABASE poll;
USE poll;

CREATE TABLE `poll_main` (
  `poll_id` int(11) NOT NULL,
  `poll_question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `poll_main` (`poll_id`, `poll_question`) VALUES
(1, 'How much weight should i lose');

ALTER TABLE `poll_main`
  ADD PRIMARY KEY (`poll_id`);
ALTER TABLE `poll_main`
  MODIFY `poll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


-- POLL OPTIONS
CREATE TABLE `poll_options` (
  `poll_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `option_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `poll_options` (`poll_id`, `option_id`, `option_text`) VALUES
(1, 1, '300 pounds'),
(1, 2, '500 pounds'),
(1, 3, '700 pounds');

ALTER TABLE `poll_options`
  ADD PRIMARY KEY (`poll_id`,`option_id`);


-- POLL VOTES
CREATE TABLE `poll_votes` (
  `poll_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `poll_votes` (`poll_id`, `option_id`, `user_id`) VALUES
(1, 1, 1),
(1, 2, 2),
(1, 3, 3),
(1, 2, 4),
(1, 1, 5),
(1, 3, 6),
(1, 3, 7),
(1, 2, 8),
(1, 1, 9),
(1, 3, 10);

ALTER TABLE `poll_votes`
  ADD KEY `poll_id` (`poll_id`),
  ADD KEY `option_id` (`option_id`),
  ADD KEY `user_id` (`user_id`);

CREATE TABLE Users(
  userID int PRIMARY KEY AUTO_INCREMENT,
  name varchar(100),
  password varchar(100),
  email varchar(100),
  primary_address varchar(100),
  administrator boolean,
  status varchar(100),
  condoAssociationID int,
  condoClassification varchar(100)
);

INSERT INTO Users VALUES (1,'Max','something6','maxime.mahdavian@gmail.com','123 street',1,'unknown',2,'unknown');
INSERT INTO Users VALUES (2,'John Doe','password','john.doe@gmail.com','124 street',0,'unknown',1,'unknown');

CREATE TABLE post(
  postID int PRIMARY KEY,
  userID int,
  groupID int,
  img varchar(100),
  title varchar(100),
  body text,
  timestamp timestamp
);

CREATE TABLE comments(
  commentID int PRIMARY KEY,
  reply_id int,
  post_id int,
  timestamp timestamp,
  name varchar(255),
  message text
);

