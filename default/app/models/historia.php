<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of historia
 *
 * @author cristhianlombana
 */
class Historia extends ActiveRecord {
    //put your code here
    
    //put your code here
    public function paginar($consulta=null,$page = 1) {
        return $this->paginate($consulta,"per_page: 5","page: $page","order: creado_at desc");
    }
    
    
}

?>
