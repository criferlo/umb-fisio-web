<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of diagnostico_controller
 *
 * @author Cristhian
 */
View::template("template_sistema");
Load::models("archivo", "diagnostico","historia");

class DiagnosticoController extends AppController {

    //put your code here

    function index($idhistoria,$page=1) {
        $this->idhistoria = $idhistoria;

        $obj = new Diagnostico();
        $consulta = "historia.id=".$idhistoria;

        if (Input::hasPost("textoBusqueda")) {
            
            $var = Input::post("textoBusqueda");

            if (!empty($var)) {

                if (Input::post("comboBusqueda") == "0") {
                    $consulta .= " and texto like '%" . Input::post("textoBusqueda")."%'";
                }
            }
        }

        $this->arrDiagnosticos = $obj->paginar($consulta, $page);
    }

    function nuevo($idhistoria, $iddicom, $idjpg) {
        $this->idhistoria = $idhistoria;
        $this->iddicom = $iddicom;
        $this->idjpg = $idjpg;

        if (Input::hasPost("oculto")) {

            $diag = new Diagnostico(Input::post("diagnostico"));
            $diag->archivodicom_id = $iddicom;
            $diag->archivojpg_id = $idjpg;
            $diag->historia_id = $idhistoria;
            $diag->texto = Input::post("descripcion");

            if ($diag->save()) {
                Flash::valid("Se grabó correctamente el diagnóstico");
                Router::redirect("diagnostico/index/$idhistoria");
            } else {
                Flash::valid("Ups problemas!");
            }
        }
    }
    
     function eliminar($idhistoria,$id) {
        
        $per = new Diagnostico();
        
        if($per->delete($id)){
            Flash::valid("Se eliminó correctamente");
            Router::redirect("diagnostico/index/$idhistoria");
        }   
    }

}
