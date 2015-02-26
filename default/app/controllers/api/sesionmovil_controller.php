<?

Load::models("historia","sesionmovil");
View::template(null);
class SesionmovilController extends AppController{
    
    /***
     * recibe historia clinica - identificacion
     * proceso graba un historial de entradas al sistema
     * devuelve datos del usuario
     * 
     */
    function login($historia){
          $his = new Historia();
          $his->find_first("identificacion=".$historia);
        
          if($his->identificacion){
              $arr = array(
                           "estado"=>"exitoso-con-resultados",
                           "secuencial"=>$his->id,
                           "historia"=>$his->identificacion,
                           "nombres"=>$his->nombres,
                           "apellidos"=>$his->apellidos, 
                      ); 
              $this->respuesta = json_encode($arr);
              //guardar registro
              $ses = new Sesionmovil();
              $ses->historia_id=$his->id;
              $ses->save();
          }
          else{
              $arr = array("estado"=>"exitoso-sin-resultados"); 
              $this->respuesta = json_encode($arr);
          }
    }
    
    
}


?>