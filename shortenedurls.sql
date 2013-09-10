-- 
-- Table structure for table `shortenedurls`
-- 

CREATE TABLE shortenedurls (
  id int(10) unsigned NOT NULL,
  url varchar(255) NOT NULL,
  shortened varchar(10) NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY url (url)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
