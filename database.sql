CREATE TABLE `user`
( `user_id` INT(6) AUTO_INCREMENT NOT NULL ,
  `user_name` VARCHAR(20) NOT NULL ,
  `user_family` VARCHAR(40) NOT NULL ,
  `user_username` VARCHAR(20) NOT NULL ,
  `user_password` VARCHAR(20) NOT NULL ,
  `user_phone` VARCHAR(11) NOT NULL ,
  `user_address` VARCHAR(100) NOT NULL ,
  `user_email` VARCHAR(100) NOT NULL ,
  `user_type` INT(2) NOT NULL ,
  PRIMARY KEY (`user_id`),
  UNIQUE `user_username` (`user_username`));

CREATE TABLE `request`
( `request_id` INT(6) AUTO_INCREMENT NOT NULL ,
  `request_date` DATE NOT NULL ,
  `request_address` VARCHAR(100) NOT NULL ,
  `user_id` INT(6) NOT NULL ,
  `request_type` int(5) NOT NULL ,
  PRIMARY KEY (`request_id`),
  FOREIGN KEY(user_id) references user(user_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE);

CREATE TABLE `product`
( `product_id` INT(6) AUTO_INCREMENT NOT NULL ,
  `product_name` VARCHAR(20) NOT NULL ,
  `product_cost` INT(10) NOT NULL ,
  `product_picture` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`product_id`));


CREATE TABLE `listrequest`
( `request_id` INT(6) NOT NULL ,
  `product_id` INT(6) NOT NULL ,
  `listrequest_num` INT(4) NOT NULL ,
  PRIMARY KEY (`request_id`,`product_id`),
  FOREIGN KEY(request_id) references request(request_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY(product_id) references product(product_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE);

