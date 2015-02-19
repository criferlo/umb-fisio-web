<?
View::template("template_sistema");

//controlador de inicio de sistema
class SistemaController extends AppController{


	//pantalla de bienvenida al sistema arduis
	function index(){
                if(!Auth::is_valid()){
                    Router::redirect("sesion/index");
                }
                               
		Flash::info("DISEÑO DE UN EQUIPO PARA DIAGNÓSTICO, TRATAMIENTO Y MONITOREO AUTOMATIZADO DE ARTROSIS, A PARTOR DEL ANÁLISIS ELECTROMIOGRÁFICO Y DE IMÁGENES RADIOLÓGICAS CON APLICACIÓN PARA SMARTPHONE COMO INTERFAZ DE USUARIO INALÁMBRICA");
	}

}

?>