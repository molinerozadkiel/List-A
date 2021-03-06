<?php

// ABREVIATION DATA:
// arc = archived  (boolean 0 = elemento visible, 1 = elemento archivado)
// bse = base
// clr = color
// del = deleted   (boolean 0 = por defecto,      1 = el elemento ha sido eliminado)
// epk = element primary key
// onf = on or off
// pbt = primary button
// pky = primary key
// ppk = parent  primary key
// pty = priority
// stc = structure
// tck = ticked
// tpk = tag     primary key
// trk = traking
// tsp = time stamp
// txt = texto
// upk = user    primary key

// DATOS DE BASE DE DATOS
// user = list-a_master
// pass = 2epOrRrPEvXHjYG6

// DATOS DE USUARIO
// user = Zack
// pass = ltGeQSSjPU9dDpfl


// TODO: estructura de datos inicial de cada usuario segun siguiente lista:
// {
// TODO: hacer que los elementos de stc=0 tengan bse=pky
// 		BASE---------->id: 0
// 		----HOME     ->id: 1
//	 	----FAVORITES->id: 2
//	 	----GROUPS   ->id: 3
//	 	----FRIENDS  ->id: 4
//	 	----INBOX    ->id: 5
//	 	----PUBLIC   ->id: 6
// }

// ----------------------- Database changes for update: -----------------------
// ALTER TABLE `elements` CHANGE `pbt` `pbt` INT(4) NOT NULL DEFAULT '0';
// UPDATE elements SET pbt = 0
// ALTER TABLE `elements` CHANGE `chd` `stc` INT(4) NULL DEFAULT NULL;
// ALTER TABLE `elements` CHANGE `fvt` `upk` INT(32) NULL DEFAULT NULL;
// ALTER TABLE `elements` ADD `bse` INT(128) NOT NULL AFTER `dte`;

// delimiter |
// CREATE TRIGGER createStructure1 AFTER INSERT ON users
//   FOR EACH ROW
//   BEGIN
// 		INSERT INTO elements (txt, stc, upk, bse) VALUES ('base','0', NEW.pky, '0'));
// 		INSERT INTO elements (txt, stc, upk) VALUES ('home',     '1', NEW.pky);
// 		INSERT INTO elements (txt, stc, upk) VALUES ('favorites','2', NEW.pky);
// 		INSERT INTO elements (txt, stc, upk, pbt) VALUES ('groups',   '3', NEW.pky, '1');
// 		INSERT INTO elements (txt, stc, upk) VALUES ('friends',  '4', NEW.pky);
// 		INSERT INTO elements (txt, stc, upk) VALUES ('inbox',    '5', NEW.pky);
// 		INSERT INTO elements (txt, stc, upk) VALUES ('public',   '6', NEW.pky);
//   END;
// |


// delimiter |
// CREATE TRIGGER createStructure2 BEFORE INSERT ON elements
// 	FOR EACH ROW
//  BEGIN
//  	IF (NEW.stc) THEN
//  		SET NEW.bse = (SELECT pky FROM elements WHERE upk = NEW.upk AND stc = 0);
//  	END IF;
//  	IF (NEW.bse = 0) THEN
//  		SET NEW.bse = ((SELECT MAX(pky) FROM elements) + 1);
//  	END IF;
//  END;
// |
// CREATE TRIGGER createStructure3 BEFORE INSERT ON elements FOR EACH ROW BEGIN IF (NEW.stc = 1 OR NEW.stc = 2 OR NEW.stc = 3) THEN SET NEW.bse = (SELECT pky FROM elements WHERE upk = NEW.upk AND stc = 0); END IF; END;

// delimiter |
// CREATE TRIGGER createStructure3 AFTER INSERT ON elements
// 	FOR EACH ROW
// 	BEGIN
// 		IF (NEW.stc) THEN
// 			INSERT INTO elementparent (ppk, epk) VALUES (
// 				(SELECT pky FROM elements WHERE upk = NEW.upk AND stc = 0),
// 				NEW.pky
// 			);
// 		END IF;
// 		IF (NEW.stc IS NULL AND NEW.bse != NEW.pky) THEN
// 			INSERT INTO elementparent (ppk, epk) VALUES (NEW.bse, NEW.pky);
// 		END IF;
// 	END;
// |
// CREATE TRIGGER createStructure2 AFTER INSERT ON elements FOR EACH ROW BEGIN IF NEW.stc = 1 THEN INSERT INTO elementparent (ppk, epk) VALUES ( (SELECT pky FROM elements WHERE upk = NEW.upk AND stc = 0) , NEW.pky); END IF; END;

// TODO: agregar automatizacion para vincular usuario y estructura (aunque medio que ya esta)







// TODO: Sistema de permisos con el dato del permiso otorgado en bytes como estte ejemplo:
// "[Flags]
// public enum Permission
// {
//     VIEWUSERS     =  1, // 2^0 // 0000 0001
//     EDITUSERS     =  2, // 2^1 // 0000 0010
//     VIEWPRODUCTS  =  4, // 2^2 // 0000 0100
//     EDITPRODUCTS  =  8, // 2^3 // 0000 1000
//     VIEWCLIENTS   = 16, // 2^4 // 0001 0000
//     EDITCLIENTS   = 32, // 2^5 // 0010 0000
//     DELETECLIENTS = 64, // 2^6 // 0100 0000
// }"


// en el editor manual poner esto como contenido del trigger 'CREATE TRIGGER createStructure1 AFTER INSERT ON users'
// BEGIN
// 	INSERT INTO elements ( txt, stc, upk, bse ) VALUES ( 'base'      , 0 , NEW.pky, 0 );
// 	INSERT INTO elements ( txt, stc, upk )      VALUES ( 'home'      , 1 , NEW.pky    );
// 	INSERT INTO elements ( txt, stc, upk )      VALUES ( 'favorites' , 2 , NEW.pky    );
// 	INSERT INTO elements ( txt, stc, upk , pbt) VALUES ( 'groups'    , 3 , NEW.pky, 1 );
// 	INSERT INTO elements ( txt, stc, upk )      VALUES ( 'friends'   , 4 , NEW.pky    );
// 	INSERT INTO elements ( txt, stc, upk )      VALUES ( 'inbox'     , 5 , NEW.pky    );
// 	INSERT INTO elements ( txt, stc, upk )      VALUES ( 'public'    , 6 , NEW.pky    );
// END




// CREATE TRIGGER createStructure2 BEFORE INSERT ON elements FOR EACH ROW BEGIN IF (NEW.stc) THEN SET NEW.bse = (SELECT pky FROM elements WHERE upk = NEW.upk AND stc = 0); END IF; IF (NEW.bse = 0) THEN SET NEW.bse = ((SELECT MAX(pky) FROM elements) + 1); END IF; END;
// CREATE TRIGGER createStructure3 AFTER INSERT ON elements FOR EACH ROW BEGIN IF (NEW.stc) THEN INSERT INTO elementparent (ppk, epk) VALUES ( (SELECT pky FROM elements WHERE upk = NEW.upk AND stc = 0), NEW.pky ); END IF; IF (NEW.stc IS NULL) THEN INSERT INTO elementparent (ppk, epk) VALUES (NEW.bse, NEW.pky); END IF; END;


// TODO: Templates





session_start();
include 'dbh.inc.php';

// $uid = mysqli_real_escape_string($conn, $_POST['uid']);
// $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
$log = $_POST['log'];
$pwd = $_POST['pwd'];
$respuesta = array();

// Error handlers
// Check if inputs are empty
if (empty($log) || empty($pwd)) {
	// echo "login empty";
	$respuesta['title'] = 'Error';
	$respuesta['message'] = 'Empty fields are not valid';
	echo json_encode($respuesta);
	// $_SESSION['status'] = "login empty";
	// echo json_encode($_SESSION);
	exit();
} else {
	$sql = "SELECT * FROM users WHERE uid='$log' OR eml='$log'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if ($resultCheck < 1) {
		// echo "login nodata";
		// $_SESSION['status'] = "login nodata";
		// echo json_encode($_SESSION);
		$respuesta['title'] = 'Error';
		$respuesta['message'] = 'Try again...';
		echo json_encode($respuesta);
		exit();
	} else {
		if ($row = mysqli_fetch_assoc($result)) {
			// De-hashing the password
			$hashedPwdCheck = password_verify($pwd, $row['pwd']);
			if ($hashedPwdCheck == false) {
				// echo "login error";
				// $_SESSION['status'] = "login error";
				// echo json_encode($_SESSION);
				$respuesta['title'] = 'Error';
				$respuesta['message'] = 'User and/or pass are WRONG!';
				echo json_encode($respuesta);
				exit();
			} elseif ($hashedPwdCheck == true) {
				// Log in the user here
				$upk = $row['pky'];
				$_SESSION['status'] = "ok";

				$_SESSION['data'] =  array(
					'pky' => $row['pky'],
					'nick_name' => $row['uid'],
					'first_name' => $row['fst'],
					'last_name' => $row['lst'],
					'email' => $row['eml'],
				);
				// $_SESSION['u_pky'] = $row['pky'];
				// $_SESSION['u_uid'] = $row['uid'];
				// $_SESSION['u_fst'] = $row['fst'];
				// $_SESSION['u_lst'] = $row['lst'];
				// $_SESSION['u_eml'] = $row['eml'];
				$respuesta['data'] = array(
					'pky' => $row['pky'],
					'nick_name' => $row['uid'],
					'first_name' => $row['fst'],
					'last_name' => $row['lst'],
					'email' => $row['eml'],
				);
				// $sql = "SELECT * FROM elements WHERE ( (stc = '0' OR stc = '1' OR stc = '2' OR stc = '3') AND upk = $pky);";
				// $sql = "SELECT pky FROM elements WHERE uid=$row['pky'] AND stc=0;";

				// $sql = "SELECT * FROM elements WHERE (stc = 0 AND upk = $pky);";
				// $result = mysqli_query($conn, $sql);
				// $row = mysqli_fetch_assoc($result);
				// $_SESSION['u_base'] = $row['pky'];

				// $_SESSION['u_bse'] = $bse['pky'];
				$bse = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM elements WHERE upk = $upk;"));
				$_SESSION['base'] = json_encode($bse);
				$respuesta['base'] = json_encode($bse);

				$home = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM elements WHERE (upk = $upk AND stc = 1);"));
				$_SESSION['home']  = json_encode($home);
				$respuesta['home'] = json_encode($home);

				$favorites = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM elements WHERE (upk = $upk AND stc = 2);"));
				$_SESSION['favorites']  = json_encode($favorites);
				$respuesta['favorites'] = json_encode($favorites);

				$groups = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM elements WHERE (upk = $upk AND stc = 3);"));
				$_SESSION['groups']  = json_encode($groups);
				$respuesta['groups'] = json_encode($groups);

				$friends = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM elements WHERE (upk = $upk AND stc = 4);"));
				$_SESSION['friends']  = json_encode($friends);
				$respuesta['friends'] = json_encode($friends);


				$respuesta['title'] = 'Success';
				$respuesta['message'] = 'inicio de sesion correcto';
				echo json_encode($respuesta);


				// echo json_encode($_SESSION);

				exit();
			}
		}
	}
}
