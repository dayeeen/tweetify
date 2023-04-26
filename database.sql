CREATE DATABASE 'TwitterClone';

CREATE TABLE `Users` (
  `id` integer PRIMARY KEY auto_increment,
  `username` varchar(255),
  `first_name` varchar(255),
  `last_name` varchar(255),
  `email` varchar(255),
  `password` varchar(255),
  `profil_pic` varchar(255),
  `bio` varchar(255),
  `location` varchar(255),
  `birthdate` DATE,
  `followers` integer,
  `following` integer,
  `join_date` DATE
);

CREATE TABLE `Followers` (
  `id_followers` integer PRIMARY KEY auto_increment,
  `id_user` int
);

CREATE TABLE `Following` (
  `id_following` integer PRIMARY KEY auto_increment,
  `id_user` int
);

CREATE TABLE `Tweets` (
  `id_tweet` integer PRIMARY KEY auto_increment,
  `id_user` int,
  `tweet` TEXT,
  `tweet_date` DATETIME,
  `retweet_count` integer,
  `like_count` integer
);

CREATE TABLE `Mentions` (
    `id_mention` integer PRIMARY KEY auto_increment,
  `id_tweet` integer ,
  `target` integer,
  `source` integer
);

CREATE TABLE `Replies` (
  `id_reply` integer PRIMARY KEY,
  `id_user` integer,
  `id_tweet` integer,
  `reply` TEXT,
  `reply_date` DATETIME,
  `reply_to_tweet_id` integer
);

CREATE TABLE `DM` (
    `id_dm` integer PRIMARY KEY auto_increment,
  `message` TEXT,
  `sender` integer,
  `receiver` integer,
  `dm_date` DATETIME
);

ALTER TABLE `Followers` ADD FOREIGN KEY (`id_user`) REFERENCES `Users` (`id`);

ALTER TABLE `Following` ADD FOREIGN KEY (`id_user`) REFERENCES `Users` (`id`);

ALTER TABLE `Tweets` ADD FOREIGN KEY (`id_user`) REFERENCES `Users` (`id`);

ALTER TABLE `Mentions` ADD FOREIGN KEY (`id_tweet`) REFERENCES `Tweets` (`id_tweet`);

ALTER TABLE `Mentions` ADD FOREIGN KEY (`target`) REFERENCES `Users` (`id`);

ALTER TABLE `Mentions` ADD FOREIGN KEY (`source`) REFERENCES `Tweets` (`id_user`);

ALTER TABLE `Replies` ADD FOREIGN KEY (`id_user`) REFERENCES `Users` (`id`);

ALTER TABLE `Replies` ADD FOREIGN KEY (`id_tweet`) REFERENCES `Tweets` (`id_tweet`);

ALTER TABLE `Replies` ADD FOREIGN KEY (`reply_to_tweet_id`) REFERENCES `Tweets` (`id_tweet`);

ALTER TABLE `DM` ADD FOREIGN KEY (`sender`) REFERENCES `Users` (`id`);

ALTER TABLE `DM` ADD FOREIGN KEY (`receiver`) REFERENCES `Users` (`id`);



INSERT INTO `Users` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `profil_pic`, `bio`, `location`, `birthdate`, `followers`, `following`, `join_date`) VALUES
(1, 'john_doe', 'John', 'Doe', 'john_doe@example.com', 'password1', 'profile_pic_1.jpg', 'Lorem ipsum dolor sit amet', 'New York', '1990-01-01', 500, 300, '2021-01-01'),
(2, 'jane_doe', 'Jane', 'Doe', 'jane_doe@example.com', 'password2', 'profile_pic_2.jpg', 'Consectetur adipiscing elit', 'Los Angeles', '1992-05-15', 1000, 600, '2020-12-15'),
(3, 'bob_smith', 'Bob', 'Smith', 'bob_smith@example.com', 'password3', 'profile_pic_3.jpg', 'Sed do eiusmod tempor incididunt', 'Chicago', '1985-08-10', 800, 400, '2021-02-20'),
(4, 'joe_black', 'Joe', 'Black', 'joe_black@example.com', 'password4', 'profile_pic_4.jpg', 'Ut enim ad minim veniam', 'San Francisco', '1988-11-20', 1200, 900, '2020-11-01'),
(5, 'sara_jones', 'Sara', 'Jones', 'sara_jones@example.com', 'password5', 'profile_pic_5.jpg', 'Duis aute irure dolor in reprehenderit', 'Miami', '1995-03-22', 700, 500, '2021-04-01'),
(6, 'david_brown', 'David', 'Brown', 'david_brown@example.com', 'password6', 'profile_pic_6.jpg', 'Excepteur sint occaecat cupidatat non proident', 'Seattle', '1982-06-05', 1500, 1200, '2021-03-10'),
(7, 'jessica_green', 'Jessica', 'Green', 'jessica_green@example.com', 'password7', 'profile_pic_7.jpg', 'Sunt in culpa qui officia deserunt mollit anim', 'Dallas', '1991-09-12', 300, 200, '2020-10-05'),
(8, 'steve_adams', 'Steve', 'Adams', 'steve_adams@example.com', 'password8', 'profile_pic_8.jpg', 'Amet consectetur adipiscing elit', 'Philadelphia', '1987-04-17', 2000, 1500, '2021-05-20'),
(9, 'emily_white', 'Emily', 'White', 'emily_white@example.com', 'password9', 'profile_pic_9.jpg', 'Sed ut perspiciatis unde omnis iste', 'Houston', '1994-07-18', 400, 300, '2020-12-10'),
(10, 'kevin_chen', 'Kevin', 'Chen', 'kevin_chen@example.com', 'password10', 'profile_pic_10.jpg', 'Nemo enim ipsam voluptatem', 'Boston', '1989-02-28', 100, 50, '2021-01-15')
;

INSERT INTO `Users` (`id`, `username`, `first_name`, `last_name`, `email`, `password`) VALUES
('', 'dayen', 'Dian', 'Saputra', 'dian@gmail.com', '123')
;

-- menambahkan data lewat mysqli query
