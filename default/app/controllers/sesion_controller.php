<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sesion_controller
 *
 * @author Cristhian
 */
View::template("template_sesion");

class SesionController extends AppController {
    //put your code here
    function index(){
        if(Input::hasPost("cedula")){
            
            $ced = Input::post("cedula");
            $cla = Input::post("clave");
            
            $auth = new Auth("model", "class: Usuario", "cedula: $ced", "clave: $cla");
            if($auth->authenticate()){
                Router::redirect("sistema/index");
            }
            else{
                Router::redirect("sesion/invalido");
            }
        }
    }
    
    function invalido(){
        
    }
    
    function cerrar(){
        Auth::destroy_identity();
        Router::redirect("sesion/index");
    }
}
