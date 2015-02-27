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
Load::models("Archivo","Diagnostico");
class DiagnosticoController extends AppController {
    //put your code here
    
    function index($idhistoria){
        $this->idhistoria = $idhistoria;
    }
    
    function nuevo($idhistoria,$iddicom,$idjpg){
        $this->idhistoria = $idhistoria;
        $this->iddicom = $iddicom;
        $this->idjpg = $idjpg;
        
        if(Input::hasPost("oculto")){
            
            $diag = new Diagnostico();
            $diag->archivodicom_id=$iddicom;
            $diag->archivojpg_id = $idjpg;
            $diag->historia_id=$idhistoria;
            $diag->texto = Input::post("descripcion");
            
            $opcion1= Input::post("switch-field-1");
            $opcion2= Input::post("switch-field-2");
            $opcion3= Input::post("switch-field-3");
            $opcion4= Input::post("switch-field-4");
            
            if(isset($opcion1)){
                $diag->opcion1="1";
            }
            else{
                $diag->opcion1="0";
            }
            
            if(isset($opcion2)){
                $diag->opcion2="1";
            }
            else{
                $diag->opcion2="0";
            }
            
             if(isset($opcion3)){
                $diag->opcion3="1";
            }
            else{
                $diag->opcion3="0";
            }
            
            if($diag->save()){
                Flash::valid("Se grabó correctamente el diagnóstico");
                Router::redirect("diagnostico/index/$idhistoria");
                
            }
            else{
                Flash::valid("Ups problemas!");
            }
        }
    }
}
