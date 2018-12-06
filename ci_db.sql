
CREATE DATABASE /*!32312 IF NOT EXISTS*/`code` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `code`;

/*Table structure for table `tbl_blogs` */

DROP TABLE IF EXISTS `tbl_clientes`;

CREATE TABLE `tbl_clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

