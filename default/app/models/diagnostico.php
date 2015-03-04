<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of diagnostico
 *
 * @author Cristhian
 */
class Diagnostico extends ActiveRecord {
    //put your code here
    //put your code here
    public function paginar($consulta=null,$page = 1) {
        return $this->paginate($consulta,"columns: diagnostico.*,diagnostico.id as diagnostico_id,historia.id,historia.identificacion","join: inner join historia on diagnostico.historia_id=historia.id","per_page: 5","page: $page","order: creado_at desc");
    }
}
