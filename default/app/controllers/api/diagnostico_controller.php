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
View::template(null);
Load::models("diagnostico");
class DiagnosticoController extends AppController {
    //put your code here
    function obtenerDiagnostico($idhistoria){
        $di = new Diagnostico();
        $arrDiagnostico = array();
        $arrDiagnostico = $di->find("historia_id=$idhistoria");
                
        if($arrDiagnostico){
            
            $arrTotal = array();
            
            foreach($arrDiagnostico as $obj){
                $arr = array(
                    "estado"=>"exitoso-con-resultados",
                    "secuencial"=>$obj->id,
                    "texto"=>$obj->texto,
                    "historia_id"=>$obj->historia_id,
                    "creado_at"=>$obj->creado_at,
                    );
                $arrTotal[]=$arr;
            }
            $this->respuesta = json_encode($arrTotal);
        }
        else{
             $arr = array("estado"=>"exitoso-sin-resultados"); 
             $this->respuesta = json_encode($arr);
        }
    }
}
