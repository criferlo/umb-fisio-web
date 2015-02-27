<?php

//info
//http://deanvaughan.org/wordpress/2013/07/dicom-sample-images/
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dicom_controller
 *
 * @author Cristhian
 */
Load::lib("class_dicom");
View::template("template_sistema");
Load::models("Archivo");

class DicomController extends AppController {

    //put your code here
    function index($idhistoria) {

        $this->idhistoria = $idhistoria;
        
        if (Input::hasPost("oculto")) {

            $archivo = Upload::factory("archivodicom");
            if ($archivo->isUploaded()) {

                $arc = new Archivo();
                $arc->nombre = $archivo->saveRandom();
                $arc->save();

                $file = APP_PATH . "../public/files/upload/" . $arc->nombre;

                $d = new dicom_convert;
                $d->file = $file;
                $d->dcm_to_jpg();

                $arcj = new Archivo();
                $arcj->nombre = $arc->nombre . ".jpg";
                $arcj->save();

                //$d->dcm_to_tn(); // CONVERT TO JPEG AND A JPEG THUMBNAIL
            }

            $archivojpg = Upload::factory("archivojpg");

            if ($archivojpg->isUploaded()) {
                $arcjp = new Archivo();
                $arcjp->nombre = $archivojpg->saveRandom();
                $arcjp->save();
            }
            //envia al diagnostico las imagenes
            Router::redirect("diagnostico/nuevo/$idhistoria/$arcj->id/$arcjp->id");
        }
    }

}
