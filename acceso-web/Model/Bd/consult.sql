/*arduino*/

/* ---Registro UID--
	se realizara la consulta en de las tarjetas nuevas
	si existe una tarjeta en esta tabla no se podra
	registrar ninguna otra hasta concluir el registro*/
SELECT COUNT(intid_NewCard) AS intNewUid FROM cat_NewCard;
INSERT INTO cat_NewCard VALUES (NULL, UID);

/*sistema web*/

/*--Registro de salas--
	todas las salas nuevas deben ser ingresadas
	como cerradas*/
INSERT INTO cat_Room VALUES(NULL, 'NOMBRE SALA', 0);

/*--Registro de usuarios Uid--
	todos los usuarios deben ser ingresados
	sin acceso a las salas*/

INSERT INTO cat_UidUsers VALUES(NULL, 'NOMBRE User', 
	'APELLIDO User', Ncontrol, UID, 0);	

/*--Asignar accesos--
	se aignaran los usuarios a las salas
	que sean necesarias tener acceso*/
