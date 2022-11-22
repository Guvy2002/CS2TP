CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `size` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `imgPath` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `logins` (
  `uid` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `RecoveryHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;