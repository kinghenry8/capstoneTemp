
-- 
-- Editor server script for DB table PROPERTY
-- Automatically generated by http://editor.datatables.net/generator
-- 

CREATE TABLE `PROPERTY` (
	`PROPID` int(10) NOT NULL auto_increment,
	`BLOCK` varchar(255) default NULL,
	`LOT` varchar(255) default NULL,
	`WARD` varchar(255) default NULL,
	`ADDRNUM` varchar(255) default NULL,
	`STREET` varchar(255) default NULL,
	`CITY` varchar(255) default NULL,
	`ZIP` varchar(255) default NULL,
	`STATE` varchar(255) default NULL,
	`BOARDED` varchar(255) default NULL,
	`PDESC` varchar(255) default NULL,
	`LCOMMENT` varchar(255) default NULL,
	PRIMARY KEY  (`PROPID`)
);

