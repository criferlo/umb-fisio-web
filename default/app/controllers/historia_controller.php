<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of historia_controller
 *
 * @author cristhianlombana
 */
View::template("template_sistema");
Load::models("historia");

class HistoriaController extends AppController {

    //put your code here
    function index($page = 1) {

        $obj = new Historia();

        $consulta = null;

        if (!isset(Input::post("textoBusqueda"))) {

            if (Input::post("comboBusqueda") == "0") {
                $consulta = "identificacion=" . Input::post("textoBusqueda");
            } else if (Input::post("comboBusqueda") == "1") {
                $consulta = "apellidos like '%" . Input::post("textoBusqueda") . "%'";
            }
        }

        $this->historias = $obj->paginar($consulta, $page);
    }

    function nuevo() {
        

        if (Input::hasPost("tipoidentificacion")) {

            $ti = Input::post("tipoidentificacion");
            $tp = Input::post("tipoprograma");
            $te = Input::post("tipoeps");
            $tr = Input::post("tiporegimen");
            $tg = Input::post("tipogenero");
            $tec = Input::post("tipoestadocivil");
            $tz = Input::post("tipozona");

            $his = new Historia(Input::post("historia"));


            $his->tipoidentificacion_id = $ti["tipoidentificacion_id"];
            $his->tipoprograma_id = $tp["tipoprograma_id"];
            $his->tipoeps_id = $te["tipoeps_id"];
            $his->tiporegimen_id = $tr["tiporegimen_id"];
            $his->tipogenero_id = $tg["tipogenero_id"];
            $his->tipoestadocivil_id = $tec["tipoestadocivil_id"];
            $his->tipozona_id = $tz["tipozona_id"];

            if ($his->save()) {
                Flash::valid("Registro exitoso.");
                Router::redirect("historia/index");
            } else {
                Flash::error("No se puede grabar...");
            }
        }
    }

    function editar($id) {
       
        $this->obj = new Historia();
        $this->obj->find_first($id);
        $this->id = $id;

        if (Input::hasPost("tipoidentificacion")) {

            $ti = Input::post("tipoidentificacion");
            $tp = Input::post("tipoprograma");
            $te = Input::post("tipoeps");
            $tr = Input::post("tiporegimen");
            $tg = Input::post("tipogenero");
            $tec = Input::post("tipoestadocivil");
            $tz = Input::post("tipozona");

            $his = new Historia(Input::post("historia"));
            $his->id = $id;
            $his->tipoidentificacion_id = $ti["tipoidentificacion_id"];
            $his->tipoprograma_id = $tp["tipoprograma_id"];
            $his->tipoeps_id = $te["tipoeps_id"];
            $his->tiporegimen_id = $tr["tiporegimen_id"];
            $his->tipogenero_id = $tg["tipogenero_id"];
            $his->tipoestadocivil_id = $tec["tipoestadocivil_id"];
            $his->tipozona_id = $tz["tipozona_id"];

            if ($his->update()) {
                $this->obj = new Historia();
                $this->obj->find_first($id);
                Flash::valid("Modificación exitosa");
                Router::redirect("historia/index");
            } else {
                Flash::error("No se puede actualizar..");
            }
        }
    }

    function eliminar($idhistoria) {
        
        $per = new Historia();
        
        if($per->delete($idhistoria)){
            Flash::valid("Se eliminó correctamente");
            Router::redirect("historia/index");
        }   
    }

}

?>
