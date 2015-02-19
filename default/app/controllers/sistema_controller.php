<?php
View::template("template_sistema");

//controlador de inicio de sistema
class SistemaController extends AppController{


	//pantalla de bienvenida al sistema arduis
	function index(){
		Flash::info("hola");
	}

	function devolver(){
		View::template(null);

		$matriz = array();

		$arr = array("title"=>"cristhian","label"=>"123","desc"=>"direccion");

		$matriz[0] = $arr;

		$arr = array("title"=>"jenny","label"=>"456","desc"=>"dir");

		$matriz[1] = $arr;		

		$arr = array("title"=>"jenny","label"=>"456","desc"=>"dir");

		$matriz[2] = $arr;

		$arr = array("title"=>"jenny","label"=>"456","desc"=>"dir");

		$matriz[3] = $arr;

		$arr = array("title"=>"jenny","label"=>"456","desc"=>"dir");

		$matriz[4] = $arr;

		$arr = array("title"=>"jenny","label"=>"456","desc"=>"dir");

		$matriz[5] = $arr;

		$arr = array("title"=>"jenny","label"=>"456","desc"=>"dir");

		$matriz[6] = $arr;

		$arr = array("title"=>"jenny","label"=>"456","desc"=>"dir");

		$matriz[7] = $arr;

		$arr = array("title"=>"jenny","label"=>"456","desc"=>"dir");

		$matriz[8] = $arr;

		$arr = array("title"=>"jenny","label"=>"456","desc"=>"dir");

		$matriz[9] = $arr;

		$arr = array("title"=>"jenny","label"=>"456","desc"=>"dir");

		$matriz[10] = $arr;

		$this->respuesta = json_encode($matriz);

	}
}

?>