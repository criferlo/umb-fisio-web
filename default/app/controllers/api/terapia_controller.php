<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of terapia
 *
 * @author Cristhian
 */
View::template(null);
Load::models("terapia");

class TerapiaController extends AppController {

    //put your code here
    function obtenerTerapia($iddiagnostico) {
        $di = new Terapia();
        $arrTerapia = array();
        $arrTerapia = $di->find("diagnostico_id=$iddiagnostico");

        if ($arrTerapia) {

            $arrTotal = array();

            foreach ($arrTerapia as $obj) {
                $arr = array(
                    "estado" => "exitoso-con-resultados",
                    "secuencial" => $obj->id,
                    "diagnostico_id" => $obj->diagnostico_id,
                    "ems_frecuencia" => $obj->ems_frecuencia,
                    "ems_tiempocontraccion" => $obj->ems_tiempocontraccion,
                    "ems_tiemporeposo" => $obj->ems_tiemporeposo,
                    "ems_amplitudimpulso" => $obj->ems_amplitudimpulso,
                    "ems_tiempoaplicacion" => $obj->ems_tiempoaplicacion,
                    "calor_tiempo" => $obj->calor_tiempo,
                    "ionto_porcentajelidocaina" => $obj->ionto_porcentajelidocaina,
                    "tens_modo" => $obj->tens_modo,
                    "tens_frecuencia" => $obj->tens_frecuencia,
                    "tens_amplitud" => $obj->tens_amplitud,
                    "tens_intensidad" => $obj->tens_intensidad,
                    "tens_tiempo" => $obj->tens_tiempo,
                    "creado_at" => $obj->creado_at,
                    "realizada" => $obj->realizada,
                );
                $arrTotal[] = $arr;
            }
            $this->respuesta = json_encode($arrTotal);
        } else {
            $arr = array("estado" => "exitoso-sin-resultados");
            $this->respuesta = json_encode($arr);
        }
    }

    //coloca realizada si el paciente realizó la terapia
    function realizarTerapia($idterapia) {


        try {

            $te = new Terapia();
            $te->find($idterapia);
            
            if($te->id){
                 $te->realizada = "1";
                 $te->update();
                 $arr = array("estado" => "operacion-exitosa");
                 $this->respuesta = json_encode($arr);
            }
            else{
                $arr = array("estado" => "operacion-fracasada","mensaje"=>"secuencial-no-encontrado");
                $this->respuesta = json_encode($arr);
            }
           
        } catch (Exception $e) {
            $arr = array("estado" => "operacion-fracasada","mensaje"=>$e->getMessage());
            $this->respuesta = json_encode($arr);
        }
    }

}
