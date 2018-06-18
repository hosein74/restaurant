DROP TABLE listrequest;

CREATE TABLE `listrequest` (
  `request_id` int(6) NOT NULL,
  `product_id` int(6) NOT NULL,
  `listrequest_num` int(4) NOT NULL,
  PRIMARY KEY (`request_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

INSERT INTO listrequest VALUES("5","51","1");
INSERT INTO listrequest VALUES("5","50","1");
INSERT INTO listrequest VALUES("5","52","1");



DROP TABLE product;

CREATE TABLE `product` (
  `product_id` int(6) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `product_cost` int(10) NOT NULL,
  `product_picture` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

INSERT INTO product VALUES("49","میگو","25000","pics/meygo.jpg");
INSERT INTO product VALUES("50","ماهی قزل آلا","20000","pics/fish.jpg");
INSERT INTO product VALUES("51","کیک تولد","30000","pics/cake.jpg");
INSERT INTO product VALUES("52","دسر توت فرنگی","15000","pics/deser.jpg");
INSERT INTO product VALUES("53","جوجه کباب","15000","pics/jooje.jpg");



DROP TABLE request;

CREATE TABLE `request` (
  `request_id` int(6) NOT NULL AUTO_INCREMENT,
  `request_date` date NOT NULL,
  `request_address` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `user_id` int(6) NOT NULL,
  `request_type` int(5) NOT NULL,
  PRIMARY KEY (`request_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

INSERT INTO request VALUES("5","2018-06-18","عجب شیر","2","1");



DROP TABLE user;

CREATE TABLE `user` (
  `user_id` int(6) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `user_family` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `user_username` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `user_password` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `user_phone` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `user_address` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `user_email` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `user_type` int(2) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_username` (`user_username`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

INSERT INTO user VALUES("1","sasan","keivannejad","ادمین","admin","09134567895","جوزدان","","1");
INSERT INTO user VALUES("2","حسین","زنده دل","حسین74","123","09146703067","عجب شیر","","2");
INSERT INTO user VALUES("3","واحد","غلامیان","vgh315","123","09164567852","پارس آباد","","2");



