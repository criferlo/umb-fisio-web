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
class Terapia extends ActiveRecord {
    //put your code here
    //put your code here
    public function paginar($consulta=null,$page = 1) {
        return $this->paginate($consulta,"per_page: 5","page: $page","order: creado_at desc");
    }
}
