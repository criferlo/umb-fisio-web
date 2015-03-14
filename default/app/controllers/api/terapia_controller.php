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

    

    function obtenerTerapiaPorTipo($iddiagnostico) {
        $di = new Terapia();
        $arrTerapia = array();
        $arrTerapia = $di->find("diagnostico_id=$iddiagnostico");

        if ($arrTerapia) {

            $arrTotal = array();

            foreach ($arrTerapia as $obj) {

                $arrEms = array(
                    "ems_frecuencia" => $obj->ems_frecuencia,
                    "ems_tiempocontraccion" => $obj->ems_tiempocontraccion,
                    "ems_tiemporeposo" => $obj->ems_tiemporeposo,
                    "ems_amplitudimpulso" => $obj->ems_amplitudimpulso,
                    "ems_tiempoaplicacion" => $obj->ems_tiempoaplicacion,
                );

                $arrTens = array(
                    "tens_modo" => $obj->tens_modo,
                    "tens_frecuencia" => $obj->tens_frecuencia,
                    "tens_amplitud" => $obj->tens_amplitud,
                    "tens_intensidad" => $obj->tens_intensidad,
                    "tens_tiempo" => $obj->tens_tiempo,
                );

                $arrCalor = array(
                    "calor_tiempo" => $obj->calor_tiempo,
                );

                $arrIonto = array(
                    "ionto_porcentajelidocaina" => $obj->ionto_porcentajelidocaina,
                );

                $arr = array(
                    "estado" => "exitoso-con-resultados",
                    "secuencial" => $obj->id,
                    "diagnostico_id" => $obj->diagnostico_id,
                    "fecha_terapia" => $obj->fecha_terapia,
                    "ems" => $arrEms,
                    "calor" => $arrCalor,
                    "iontoforesis" => $arrIonto,
                    "tens" => $arrTens,
                    "creado_at" => $obj->creado_at,
                    "realizada_ems" => $obj->realizada_ems=="1"?"SI":"NO",
                    "realizada_calor" => $obj->realizada_calor=="1"?"SI":"NO",
                    "realizada_ionto" => $obj->realizada_ionto=="1"?"SI":"NO",
                    "realizada_tens" => $obj->realizada_tens=="1"?"SI":"NO",
                    "realizada_completa" => $obj->realizada_completa=="1"?"SI":"NO",
                );
                $arrTotal[] = $arr;
            }
            $this->respuesta = json_encode($arrTotal);
        } else {

            $arr = array("estado" => "exitoso-sin-resultados");
            $arrTotal = array();
            $arrTotal[] = $arr;
            $this->respuesta = json_encode($arrTotal);
        }
    }

    //coloca realizada si el paciente realizó la terapia
    function realizarTerapia($tipoterapia, $idterapia) {


        try {

            $te = new Terapia();
            $te->find($idterapia);

            if ($te->id) {

                $ban = 0;
                if ($tipoterapia == "EMS") {
                    $te->realizada_ems = "1";
                    $ban = 1;
                } else if ($tipoterapia == "CALOR") {
                    $te->realizada_calor = "1";
                    $ban = 1;
                } else if ($tipoterapia == "IONTO") {
                    $te->realizada_ionto = "1";
                    $ban = 1;
                } else if ($tipoterapia == "TENS") {
                    $te->realizada_tens = "1";
                    $ban = 1;
                } else if ($tipoterapia == "COMPLETA") {
                    $te->realizada_completa = "1";
                    $ban = 1;
                }
                if ($ban == 1) {
                    $te->update();
                    $arr = array("estado" => "operacion-exitosa");
                    $this->respuesta = json_encode($arr);
                }else{
                    $arr = array("estado" => "falta-tipo-terapia");
                    $this->respuesta = json_encode($arr);
                }
            } else {
                $arrTotal = array();
                $arr = array("estado" => "operacion-fracasada", "mensaje" => "secuencial-no-encontrado");
                $arrTotal[] = $arr;
                $this->respuesta = json_encode($arrTotal);
            }
        } catch (Exception $e) {
            $arrTotal = array();
            $arr = array("estado" => "operacion-fracasada", "mensaje" => $e->getMessage());
            $arrTotal[] = $arr;
            $this->respuesta = json_encode($arrTotal);
        }
    }

}
