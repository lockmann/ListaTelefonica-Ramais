CREATE DATABASE `php_ramal`; 
CREATE TABLE `php_ramal`.`members` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`fname` varchar(255) NOT NULL,
`framal` varchar(255) NOT NULL,
`active` int(11) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;