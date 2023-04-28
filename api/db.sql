CREATE TABLE `movie` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `movie_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `category` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

insert into movie(cat_id,name,description,img) values(1,'Test','Desc','test.jpg');
insert into movie(cat_id,name,description,img) values(1,'Test2','Desc2','');
insert into feedback(movie_id,name,rating,comment) values(1,'Tester',8,'test comment');
insert into feedback(movie_id,name,rating,comment) values(1,'Tester2',4,'test comment 2');

insert into category(name) values('2023');