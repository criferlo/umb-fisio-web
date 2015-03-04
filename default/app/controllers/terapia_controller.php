<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of terapia_controller
 *
 * @author Cristhian
 */
View::template("template_sistema");
Load::models("terapia","diagnostico");
class TerapiaController extends AppController {
    //put your code here
    function index($iddiagnostico,$page=1){
        $this->iddiagnostico=$iddiagnostico;
        $diag = new Diagnostico();
        $diag->find_first($iddiagnostico);
        $this->idhis = $diag->historia_id;
        $obj = new Terapia();
        $consulta = "diagnostico_id=".$iddiagnostico;
        $this->arrTerapias = $obj->paginar($consulta, $page);
    }
    
    function nuevo($iddiagnostico){
        $this->iddiagnostico = $iddiagnostico;
        if(Input::hasPost("terapia")){
            $terapia = new Terapia(Input::post("terapia"));
            $terapia->diagnostico_id = $iddiagnostico;
            if($terapia->save()){
                Flash::valid("Se grabó correctamente la terapia");
                Router::redirect("terapia/index/$iddiagnostico");
            }
            else{
                Flash::valid("No se puede grabar");
                
            }
        }
    }
    
    function editar($id){
        $this->per = new Terapia();
        $this->per->find_first($id);
        $this->id = $id;
        
        if(Input::hasPost("terapia")){
            $terapia = new Terapia(Input::post("terapia"));
            
            $terapia->id = $id;
            if($terapia->update()){
                Flash::valid("Se modificó correctamente la terapia");
                Router::redirect("terapia/index/$terapia->diagnostico_id");
            }
            else{
                Flash::valid("No se puede grabar");
                
            }
        }
    }
    
    function eliminar($id) {
        
        $per = new Terapia();
        $per->find_first($id);
        if($per->delete($id)){
            Flash::valid("Se eliminó correctamente");
            Router::redirect("terapia/index/$per->diagnostico_id");
        }   
    }
}
