BEGIN TRANSACTION;
CREATE TABLE "estado" (
	`idestado`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`sigla_estado`	TEXT NOT NULL,
	`nome_estado`	TEXT NOT NULL,
	`idadmin`	INTEGER NOT NULL
);
CREATE TABLE "cidade" (
	`idcidade`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`idestado`	INTEGER NOT NULL,
	`idadmin`	INTEGER NOT NULL,
	`nome_cidade`	TEXT NOT NULL,
	`populacao`	INTEGER NOT NULL
);
CREATE TABLE `admin` (
	`idadmin`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`nome`	TEXT NOT NULL,
	`email`	TEXT NOT NULL,
	`senha`	TEXT NOT NULL,
	`papel`	INTEGER NOT NULL
);
COMMIT;
