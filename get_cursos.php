*/+ <?php
function get_cursos()
{
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    set_time_limit(0);
   
    require_once('ripcord/ripcord.php'); //download from here https://code.google.com/p/ripcord/ 
    $datos_conexion = array(
             'host' => 'isoges.isonor.es',
             'database' => 'isonor',
             'user' => 'web_formanor_acceso_cursos_publicos',
             'password' => 'ooK3Aeboc3&faeXe3iz9u');

    //login         
    $common = ripcord::client('https://' . $datos_conexion['host'] . '/xmlrpc/2/common');
    $uid = $common->authenticate($datos_conexion['database'], $datos_conexion['user'], $datos_conexion['password'], array());

    $models = ripcord::client('https://' . $datos_conexion['host'] . "/xmlrpc/2/object");
    
    //buscando cursos
    $cursos= $models->execute_kw($datos_conexion['database'], $uid, $datos_conexion['password'], 'iso_iso_formation.calendar_event', 'search', array(array(array(1, '=', 1))), array('limit'=>7));
    $data = $models->execute_kw($datos_conexion['database'], $uid, $datos_conexion['password'], 'iso_iso_formation.calendar_event', 'read', array($cursos), array('fields'=>array( 'date_start', 'date_end', 'mode', 'aula', 'name', 'teacher_calendar_config_id', 'calendar_config_id', 'company_id', 'analytic_tag_id' ) ));

    return $data;
}

function get_cursor_mysql($cursos)
{
    require_once('../wp-config.php');
	global $wpdb;
	$table = $wpdb->prefix.'fmn_posts';
	$format = array('%s','%d');

	foreach($cursos as $value)
	{	
		echo "<br>";echo "<br>";
		
		$nombre_cursos = $value['calendar_config_id'][1];
		$id_cursos = $value['id'];
		$fecha_inicio = $value['date_end'];
		$fecha_cierre = $value['date_start'];
		$date = new DateTime();
		$delegacion = $value['analytic_tag_id'][1];
	
		//seleccionando de la base de datos los cursos para saber si se encuentra en la tabla
		$fontaneria = $wpdb->get_row('SELECT * from fmn_posts WHERE ID>280 && ID<288', OBJECT,0);
		$reciclaje = $wpdb->get_row('SELECT * from fmn_posts WHERE ID>280 && ID<288', OBJECT,1);
		$albanileria = $wpdb->get_row('SELECT * from fmn_posts WHERE ID>280 && ID<288', OBJECT,2);
		$escayola = $wpdb->get_row('SELECT * from fmn_posts WHERE ID>280 && ID<288', OBJECT,3);
		$electricidad = $wpdb->get_row('SELECT * from fmn_posts WHERE ID>280 && ID<288', OBJECT,4);
		$prevencion1 = $wpdb->get_row('SELECT * from fmn_posts WHERE ID>280 && ID<288', OBJECT,5);
		$prevencion2 = $wpdb->get_row('SELECT * from fmn_posts WHERE ID>280 && ID<288', OBJECT,6);

		//condicional para el curso de FONTANERIA/////////////////////////////////////////////////////////// 1
		if($fontaneria->post_title =="CURSO ESPECIFICO DE FONTANERIA E INSTALACIONES DE CLIMATIZACION en PREVISONOR Ourense de 2019-10-19 a 2019-10-19" && $id_cursos == 14)
		{
			print_r("El 'CURSO ESPECIFICO DE FONTANERIA E INSTALACIONES DE CLIMATIZACION' se encuentra en la base de datos.");
		}else{
			if($fontaneria->post_title == NULL && $id_cursos == 14){
				print_r("Realizando el INSERT INTO fmn_post:'CURSO ESPECIFICO DE FONTANERIA E INSTALACIONES DE CLIMATIZACION'.");
				$wpdb->insert("fmn_posts",  array('post_author' => 1, 'post_date' =>$fecha_inicio,'post_date' => $fecha_cierre,'post_content' => 'Esto sería el cuerpo de texto de la descripción del curso. Usado también para el extracto cuando este no existe' ,'post_title' => $nombre_cursos, 'post_excerpt' => 'Esto sería un extracto para el curso ' ,'post_date ' => $fecha_inicio, 'post_date_gmt' => $fecha_cierre, 'post_type' => 'tribe_events', 'delegation' => $$delegacion, 'id_cursos' => $id_cursos));
				//UPDATE para cambiar el ID del curso luego de que este sea insertado
				$wpdb->update("fmn_posts", array("ID"=>"281"),array("post_title" => "CURSO ESPECIFICO DE FONTANERIA E INSTALACIONES DE CLIMATIZACION en PREVISONOR Ourense de 2019-10-19 a 2019-10-19" ));
			}
		}
		
		//condicional para el curso de RECICLAJE////////////////////////////////////////////////////////////// 2
		if($reciclaje->post_title =="RECICLAJE -INSTALACIONES, REPARACIONES, MONTAJES, ESTRUCTURAS METALICAS, CERRAJERIA Y CARPINTERIA METALICA 4H en PREVISONOR Ourense de 2019-10-25 a 2019-10-25" && $id_cursos == 15)
		{
			print_r("El curso de 'RECICLAJE -INSTALACIONES, REPARACIONES, MONTAJES, ESTRUCTURAS METALICAS, CERRAJERIA Y CARPINTERIA METALICA' se encuentra en la base de datos.");
		}else{
			if($reciclaje->post_title == NULL && $id_cursos == 15){
				print_r("Realizando el INSERT INTO fmn_post:'RECICLAJE -INSTALACIONES, REPARACIONES, MONTAJES, ESTRUCTURAS METALICAS, CERRAJERIA Y CARPINTERIA METALICA'.");
				$wpdb->insert("fmn_posts",  array('post_author' => 1, 'post_date' =>$fecha_inicio,'post_date' => $fecha_cierre,'post_content' => 'Esto sería el cuerpo de texto de la descripción del curso. Usado también para el extracto cuando este no existe' ,'post_title' => $nombre_cursos, 'post_excerpt' => 'Esto sería un extracto para el curso ' ,'post_date ' => $fecha_inicio, 'post_date_gmt' => $fecha_cierre, 'post_type' => 'tribe_events', 'delegation' => $$delegacion, 'id_cursos' => $id_cursos));
				//UPDATE para cambiar el ID del curso luego de que este sea insertado
				$wpdb->update("fmn_posts", array("ID"=>"282"),array("post_title" => "RECICLAJE -INSTALACIONES, REPARACIONES, MONTAJES, ESTRUCTURAS METALICAS, CERRAJERIA Y CARPINTERIA METALICA 4H en PREVISONOR Ourense de 2019-10-25 a 2019-10-25" ));
			}
		}		
		
		//condicional para el curso de ALBAÑILERIA///////////////////////////////////////// 3
		if($albanileria->post_title =="CURSO ESPECIFICO PARA ALBAÑILERIA en PREVISONOR Ourense de 2019-11-08 a 2019-11-08" && $id_cursos == 16){
			print_r("El 'CURSO ESPECIFICO PARA ALBAÑILERIA' se encuentra en la base de datos.");
		}else{
			if($albanileria->post_title == NULL && $id_cursos == 16){
				print_r("Realizando el INSERT INTO fmn_post:'CURSO ESPECIFICO PARA ALBAÑILERIA'.");
				$wpdb->insert("fmn_posts",  array('post_author' => 1, 'post_date' =>$fecha_inicio,'post_date' => $fecha_cierre,'post_content' => 'Esto sería el cuerpo de texto de la descripción del curso. Usado también para el extracto cuando este no existe' ,'post_title' => $nombre_cursos, 'post_excerpt' => 'Esto sería un extracto para el curso ' ,'post_date ' => $fecha_inicio, 'post_date_gmt' => $fecha_cierre, 'post_type' => 'tribe_events', 'delegation' => $$delegacion, 'id_cursos' => $id_cursos));
				//UPDATE para cambiar el ID del curso luego de que este sea insertado
				$wpdb->update("fmn_posts", array("ID"=>"283"),array("post_title" => "CURSO ESPECIFICO PARA ALBAÑILERIA en PREVISONOR Ourense de 2019-11-08 a 2019-11-08"));
			}
		}	
		
		//condicional para el curso de ESCAYOLA///////////////////////////////////////// 4
 		if($escayola->post_title =="CURSO ESPECIFICO DE MONTADOR DE ESCAYOLA, PLACAS DE YESO LAMINADO Y ASIMILADOS en PREVISONOR Ourense de 2019-11-16 a 2019-11-16" && $id_cursos == 17){
			print_r("El 'CURSO ESPECIFICO DE MONTADOR DE ESCAYOLA, PLACAS DE YESO LAMINADO Y ASIMILADOS' se encuentra en la base de datos.");
		}else{
			if($escayola->post_title == NULL && $id_cursos == 17){
				print_r("Realizando el INSERT INTO fmn_post:'CURSO ESPECIFICO DE MONTADOR DE ESCAYOLA, PLACAS DE YESO LAMINADO Y ASIMILADOS'.");
				$wpdb->insert("fmn_posts",  array('post_author' => 1, 'post_date' =>$fecha_inicio,'post_date' => $fecha_cierre,'post_content' => 'Esto sería el cuerpo de texto de la descripción del curso. Usado también para el extracto cuando este no existe' ,'post_title' => $nombre_cursos, 'post_excerpt' => 'Esto sería un extracto para el curso ' ,'post_date ' => $fecha_inicio, 'post_date_gmt' => $fecha_cierre, 'post_type' => 'tribe_events', 'delegation' => $$delegacion, 'id_cursos' => $id_cursos));
				//UPDATE para cambiar el ID del curso luego de que este sea insertado
				$wpdb->update("fmn_posts", array("ID"=>"284"),array("post_title" => "CURSO ESPECIFICO DE MONTADOR DE ESCAYOLA, PLACAS DE YESO LAMINADO Y ASIMILADOS en PREVISONOR Ourense de 2019-11-16 a 2019-11-16"));
			}
		}
		
		//condicional para el curso de ELECTRICIDAD///////////////////////////////////////// 5
		if($electricidad->post_title =="CURSO ESPECIFICO PARA ELECTRICIDAD en PREVISONOR Ourense de 2019-12-21 a 2019-12-21" && $id_cursos == 19){
			print_r("El 'CURSO ESPECIFICO PARA ELECTRICIDAD' se encuentra en la base de datos.");
		}else{
			if($electricidad->post_title == NULL && $id_cursos == 19){
				print_r("Realizando el INSERT INTO fmn_post:'CURSO ESPECIFICO PARA ELECTRICIDAD'.");
				$wpdb->insert("fmn_posts",  array('post_author' => 1, 'post_date' =>$fecha_inicio,'post_date' => $fecha_cierre,'post_content' => 'Esto sería el cuerpo de texto de la descripción del curso. Usado también para el extracto cuando este no existe' ,'post_title' => $nombre_cursos, 'post_excerpt' => 'Esto sería un extracto para el curso ' ,'post_date ' => $fecha_inicio, 'post_date_gmt' => $fecha_cierre, 'post_type' => 'tribe_events', 'delegation' => $$delegacion, 'id_cursos' => $id_cursos));
				//UPDATE para cambiar el ID del curso luego de que este sea insertado
				$wpdb->update("fmn_posts", array("ID"=>"285"),array("post_title" => "CURSO ESPECIFICO PARA ELECTRICIDAD en PREVISONOR Ourense de 2019-12-21 a 2019-12-21"));
			}
		}
		
		//condicional para el curso de PREVENCION1///////////////////////////////////////// 6
		if($prevencion1->post_title =="NIVEL BASICO DE PREVENCION 20P+40O en PREVISONOR Ourense y Aula Formanor de 2019-11-23 a 2019-12-23" && $id_cursos == 45){
			print_r("El 'CURSO NIVEL BASICO DE PREVENCION 20P+40O' se encuentra en la base de datos.");
		}else{
			if($prevencion1->post_title == NULL && $id_cursos == 45){
				print_r("Realizando el INSERT INTO fmn_post:'CURSO NIVEL BASICO DE PREVENCION 20P+40O'.");
				$wpdb->insert("fmn_posts",  array('post_author' => 1, 'post_date' =>$fecha_inicio,'post_date' => $fecha_cierre,'post_content' => 'Esto sería el cuerpo de texto de la descripción del curso. Usado también para el extracto cuando este no existe' ,'post_title' => $nombre_cursos, 'post_excerpt' => 'Esto sería un extracto para el curso ' ,'post_date ' => $fecha_inicio, 'post_date_gmt' => $fecha_cierre, 'post_type' => 'tribe_events', 'delegation' => $$delegacion, 'id_cursos' => $id_cursos));
				//UPDATE para cambiar el ID del curso luego de que este sea insertado
				$wpdb->update("fmn_posts", array("ID"=>"286"),array("guid" => "http://formanoreven.clientes.grupoisonor.es/?p=286"));
			}
		}
		
		//condicional para el curso de PREVENCION2///////////////////////////////////////// 7
		if($prevencion2->post_title =="NIVEL BASICO DE PREVENCION 20P+40O en PREVISONOR Ourense y Aula Formanor de 2019-11-23 a 2019-12-23" && $id_cursos == 46){
			print_r("El 'CURSO NIVEL BASICO DE PREVENCION 20P+40O (2)' se encuentra en la base de datos.");
		}else{
			if($prevencion2->post_title == NULL && $id_cursos == 46){
				print_r("Realizando el INSERT INTO fmn_post:'CURSO NIVEL BASICO DE PREVENCION 20P+40O (2)'.");
				$wpdb->insert("fmn_posts",  array('post_author' => 1, 'post_date' =>$fecha_inicio,'post_date' => $fecha_cierre,'post_content' => 'Esto sería el cuerpo de texto de la descripción del curso. Usado también para el extracto cuando este no existe' ,'post_title' => $nombre_cursos, 'post_excerpt' => 'Esto sería un extracto para el curso ' ,'post_date ' => $fecha_inicio, 'post_date_gmt' => $fecha_cierre, 'post_type' => 'tribe_events', 'delegation' => $$delegacion, 'id_cursos' => $id_cursos));
				//UPDATE para cambiar el ID del curso luego de que este sea insertado
				$wpdb->update("fmn_posts", array("ID"=>"286"),array("guid" => "http://formanoreven.clientes.grupoisonor.es/?p=287" ));
			}
		}
		/*DELETE-----------
		$wpdb->delete('fmn_po->sts', array('ID'=>));*/
	}
}
$cursos = get_cursos();
echo 'Tenemos '.count($cursos).' cursos.';
print_r($cursos);

$cr = get_cursor_mysql($cursos);

?>


