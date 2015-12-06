CREATE TABLE connections 
  ( 
     id       INT auto_increment NOT NULL, 
     port     VARCHAR(255) DEFAULT NULL, 
     value    INT NOT NULL, 
     datetime DATETIME DEFAULT NULL, 
     unitid   INT DEFAULT NULL, 
     PRIMARY KEY(id) 
  ) 
DEFAULT CHARACTER SET utf8 
COLLATE utf8_unicode_ci 
engine = innodb; 

CREATE TABLE events 
  ( 
     id         INT auto_increment NOT NULL, 
     port       VARCHAR(255) DEFAULT NULL, 
     value      INT DEFAULT NULL, 
     unitid     INT DEFAULT NULL, 
     datetime   DATETIME DEFAULT NULL, 
     created_at DATETIME DEFAULT NULL, 
     updated_at DATETIME NOT NULL, 
     PRIMARY KEY(id) 
  ) 
DEFAULT CHARACTER SET utf8 
COLLATE utf8_unicode_ci 
engine = innodb; 

CREATE TABLE monitoring 
  ( 
     id         INT auto_increment NOT NULL, 
     begintime  DATETIME NOT NULL, 
     endtime    DATE DEFAULT NULL, 
     unitid     INT DEFAULT NULL, 
     type       VARCHAR(255) DEFAULT NULL, 
     min        NUMERIC(10, 0) DEFAULT NULL, 
     max        NUMERIC(10, 0) DEFAULT NULL, 
     sum        NUMERIC(10, 0) DEFAULT NULL, 
     created_at DATETIME DEFAULT NULL, 
     updated_at DATETIME DEFAULT NULL, 
     enabled    TINYINT(1) NOT NULL, 
     PRIMARY KEY(id) 
  ) 
DEFAULT CHARACTER SET utf8 
COLLATE utf8_unicode_ci 
engine = innodb; 

CREATE TABLE positions 
  ( 
     id             INT auto_increment NOT NULL, 
     unitid         INT DEFAULT NULL, 
     rdx            NUMERIC(10, 0) DEFAULT NULL, 
     rdy            NUMERIC(10, 0) DEFAULT NULL, 
     speed          NUMERIC(10, 0) DEFAULT NULL, 
     course         NUMERIC(10, 0) DEFAULT NULL, 
     numsattellites INT DEFAULT NULL, 
     hdop           INT NOT NULL, 
     quality        VARCHAR(255) NOT NULL, 
     datetime       DATETIME DEFAULT NULL, 
     created_at     DATETIME NOT NULL, 
     updated_at     DATETIME NOT NULL, 
     PRIMARY KEY(id) 
  ) 
DEFAULT CHARACTER SET utf8 
COLLATE utf8_unicode_ci 
engine = innodb; 