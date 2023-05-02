CREATE TABLE `movie` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
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

CREATE UNIQUE INDEX idx_movie_id ON movie(id);
CREATE UNIQUE INDEX idx_feedback_id ON feedback(id);
CREATE INDEX idx_feedback_movie_id ON feedback(movie_id);



insert into movie(name,description,img) values('The Final','When it comes to final.... what would be the humanity\'s last hope.','');
insert into movie(name,description,img) values('The best day','Here it comes the best day when...','6.webp');
insert into movie(name,description,img) values('Untitled','This is an untitiled movie. As its name, it is just untitled','');
insert into movie(name,description,img) values('Infinity sky','A sky that loop infinitely, loop infinitely,loop infinitely,loop infinitely,loop infinitely,loop infinitely,loop infinitely,loop infinitely,loop infinitely,loop infinitely,loop infinitely,loop infinitely,loop infinitely,loop infinitely,loop infinitely,loop infinitely,loop infinitely,loop infinitely,loop infinitely,loop infinitely,loop infinitely,loop infinitely,loop infinitely','4.webp');
insert into movie(name,description,img) values('Holiday Mood','A man in holiday','1.webp');
insert into movie(name,description,img) values('The fireman','Detective Harry Hole investigates the disappearance of a woman whose scarf is found wrapped around an ominous-looking fireman.','8.webp');
insert into movie(name,description,img) values('Super Unnatural','Two brothers follow their father\'s footsteps as hunters, fighting evil supernatural beings of many kinds, including monsters, demons, and gods that roam the earth.','7.webp');
insert into movie(name,description,img) values('The Girls','A group of vigilantes set out to take down corrupt superheroes who abuse their superpowers.','3.webp');
insert into movie(name,description,img) values('The Last of Me','After a global pandemic destroys civilization, a hardened survivor takes charge of a 14-year-old girl who may be humanity\'s last hope.','2.webp');
insert into movie(name,description,img) values('FlyMan','With FlyMan\'s identity now revealed, Peter asks Doctor Strange for help. When a spell goes wrong, dangerous foes from other worlds start to appear, forcing Peter to discover what it truly means to be FlyMan.','5.webp');

insert into feedback(movie_id,name,rating,comment) values(10,'Mr Bean',8,'Good Movie!');
insert into feedback(movie_id,name,rating,comment) values(10,'Robo',5,'Not bad');
insert into feedback(movie_id,name,rating,comment) values(10,'Mary',1,'Rubbish');
insert into feedback(movie_id,name,rating,comment) values(10,'Peter',10,'Excellent! This is the best movie I have ever watched. I hope there will be similar movie coming soon. I will never forget this movie.');

insert into feedback(movie_id,name,rating,comment) values(8,'Paul',5,'Not bad');
insert into feedback(movie_id,name,rating,comment) values(6,'Someone',7,'Nice!');
insert into feedback(movie_id,name,rating,comment) values(6,'Bob',2,'This movie is terrible');
