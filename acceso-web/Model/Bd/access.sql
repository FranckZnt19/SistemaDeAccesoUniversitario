CREATE TABLE IF NOT EXISTS cat_NewCard(
	intid_NewCard int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	intUidCard int NOT NULL
);

CREATE TABLE IF NOT EXISTS cat_Room(
	intid_Room int NOT NULL  AUTO_INCREMENT PRIMARY KEY,
	strNameRoom VARCHAR(10) NOT NULL,
	boolEstRoom	BOOLEAN NOT NULL
);

CREATE TABLE IF NOT EXISTS cat_UidUsers(
	intid_UidUser int NOT NULL  AUTO_INCREMENT PRIMARY KEY,
	strNameUser VARCHAR(50) NOT NULL,
	strLastNameUser VARCHAR(50) NOT NULL,
	intNumConUser int (8) NOT NULL,
	intfkUidUser int NOT NULL,
	boolEstUser	BOOLEAN NOT NULL
);

CREATE TABLE IF NOT EXISTS access(
	intid_Access int NOT NULL  AUTO_INCREMENT PRIMARY KEY,
	intfk_Room int NOT NULL,
	intfk_UidUsers int NOT NULL
);
ALTER TABLE access ADD FOREIGN KEY (intfk_Room) REFERENCES cat_Room(intid_Room);
ALTER TABLE access ADD FOREIGN KEY (intfk_UidUsers) REFERENCES cat_UidUsers(intid_UidUser);

CREATE TABLE IF NOT EXISTS historyOpen(
	intid_Open int NOT NULL  AUTO_INCREMENT PRIMARY KEY,
	intfk_Access int NOT NULL,
	dtm_DaTi DateTime NOT NULL
);

CREATE TABLE IF NOT EXISTS historyClose(
	intid_Open int NOT NULL  AUTO_INCREMENT PRIMARY KEY,
	intfk_Access int NOT NULL,
	dtm_DaTi DateTime NOT NULL
);

CREATE TABLE IF NOT EXISTS sessionUser(
	intid_SesUser int NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
	intNumConSesUser int (4) NOT NULL,
	strPswSesUser VARCHAR(60) NOT NULL
);