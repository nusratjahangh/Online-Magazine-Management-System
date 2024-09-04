
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `pass` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin` (`id`, `email`, `pass`) VALUES
(1, 'admin2022@gmail.com', '123');

CREATE TABLE `magazine` (
  `id` int(11) NOT NULL,
  `magazinepic` varchar(25) NOT NULL,
  `magazinename` varchar(25) NOT NULL,
  `magazinedetail` varchar(110) NOT NULL,
  `magazineaudor` varchar(25) NOT NULL,
  `magazinepub` varchar(25) NOT NULL,
  `magazinecategory` varchar(110) NOT NULL,
  `magazineprice` varchar(25) NOT NULL,
  `magazinequantity` varchar(25) NOT NULL,
  `magazineava` int(11) NOT NULL,
  `magazinerent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `magazine`
--

INSERT INTO `magazine` (`id`, `magazinepic`, `magazinename`, `magazinedetail`, `magazineaudor`, `magazinepub`, `magazinecategory`, `magazineprice`, `magazinequantity`, `magazineava`, `magazinerent`) VALUES
(4, 'arrow.jpg', 'Scott Gallagher', '1st edition', 'no idea', 'Suscipit', 'it', '756', '20', 16, 4),
(5, 'logo.png', 'Ferris Mclaughlin', 'Qui ex dolor fugiat ', 'Est voluptates offi', 'Dolorem earum accusa', 'electrical', '264', '157', 157, 0),
(6, 'arrow.png', 'harry', 'Ea quas nulla ration', 'Ut dolorem culpa ex', 'Eum proident quidem', 'it', '76', '3', 2, 1),
(7, 'vogue.jpg', 'Vogue', 'null', 'Anna Wintour', 'Vogue Publication', '', '200', '1', 1, 0),
(9, 'ok.jpg', 'Children Magazine', 'Null', 'J.K.Rowling', 'Rowling Publication Ltd', 'other', '140', '1', 0, 1),
(15, 'PIN2.PNG', 'Business Magazine', 'American Business', 'Black Ox', 'national ltd', 'other', '50', '1', 0, 1),
(16, 'OK3.PNG', 'The Best Recipe', 'Cooking Magazine', 'Maile Carpenter', 'Fine Cooking Recipe Ltd', 'BSSE', '20', '1', 0, 1),
(17, 'vogue.jpg', 'Vogue', 'fashionmgazines', 'J.K.Rowling', 'Rowling Publication Ltd', '', '80', '1', 1, 0),
(18, 'mg1.jpg', 'Article 90', 'null', 'Anna Wintour', 'Getty Publication', 'BusinessMagazines', '100', '2', 2, 0),
(25, 'vogue.jpg', 'Vogue', 'fashionmgazines', 'Emma Watson', 'Vogue Publication', 'CommercialMagazines', '250', '5', 4, 1);


CREATE TABLE `purchasemagazine` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `purchasename` varchar(25) NOT NULL,
  `purchasemagazine` varchar(25) NOT NULL,
  `purchasetype` varchar(25) NOT NULL,
  `purchasedays` int(11) NOT NULL,
  `purchasedate` varchar(25) NOT NULL,
  `purchasereturn` varchar(25) NOT NULL,
  `fine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `purchasemagazine` (`id`, `userid`, `purchasename`, `purchasemagazine`, `purchasetype`, `purchasedays`, `purchasedate`, `purchasereturn`, `fine`) VALUES
(13, 7, 'xyz', 'Children Magazine', 'VIP', 0, '18/08/2022', '19/08/2022', 0),
(14, 13, 'Amber Scott', 'The Best Recipe', 'GENERAL', 0, '18/08/2022', '19/08/2022', 0),
(15, 15, 'wert', 'Vogue', 'VIP', 0, '19/08/2022', '20/08/2022', 0);


CREATE TABLE `requestmagazine` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `magazineid` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `usertype` varchar(25) NOT NULL,
  `magazinename` varchar(25) NOT NULL,
  `purchasedays` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `requestmagazine` (`id`, `userid`, `magazineid`, `username`, `usertype`, `magazinename`, `purchasedays`) VALUES
(7, 8, 18, 'Anna Wintour', 'author', 'Article 90', '7'),
(8, 8, 18, 'Anna Wintour', 'author', 'Article 90', '7');




CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `pass` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `userdata` (`id`, `name`, `email`, `pass`, `type`) VALUES
(7, 'xyz', 'njdhgd@gmail.com', '123hvhv', 'VIP'),
(8, 'Anna Wintour', 'anna@gmail.com', '1234', 'VIP'),
(9, 'J.K.Rowling', 'rowling@gmail.com', '1234', 'VIP'),
(10, 'swedish', 'swed@gmail.com', '1234', 'VIP'),
(11, 'Black Ox', 'bo@gmail.com', '1234', 'VIP'),
(12, 'Maile Carpenter', 'mcarpenter@yahoo.com', '1234', 'VIP'),
(13, 'Amber Scott', 'a.scott@gmail.com', '1234', 'GENERAL'),
(14, 'rubert', 'rub@y.com', '1234', 'VIP'),
(15, 'wert', 'rowling@gmail.com', '1234', 'VIP'),
(16, 'Emma', 'emma@yahoo.com', '1234', 'VIP'),
(17, 'NUSRAT JAHAN', 'nj@gmail.com', '1234', 'VIP'),
(18, 'Melissa', 'melissa@yahoo.com', '1234', 'NEWCUSTOMER');


ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `magazine`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `purchasemagazine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pk_fk` (`userid`);


ALTER TABLE `requestmagazine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pk_fk_magazine` (`magazineid`),
  ADD KEY `pk_fk_users` (`userid`);


ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `magazine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;


ALTER TABLE `purchasemagazine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;


ALTER TABLE `requestmagazine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

ALTER TABLE `purchasemagazine`
  ADD CONSTRAINT `pk_fk` FOREIGN KEY (`userid`) REFERENCES `userdata` (`id`);


ALTER TABLE `requestmagazine`
  ADD CONSTRAINT `pk_fk_users` FOREIGN KEY (`userid`) REFERENCES `userdata` (`id`);
COMMIT;

