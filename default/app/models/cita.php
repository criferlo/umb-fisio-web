<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cita
 *
 * @author equipo1
 */
class Cita extends ActiveRecord {
    //put your code here
    public function paginar($pagina = 1) {
        return $this->paginate("page: $pagina");
    }
}

?>
