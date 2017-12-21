<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Calendario_model extends CI_MODEL
{

    public function __construct()
    {
        $this->load->database('default');
    }
     public function dameHoras($ciudad,$especialidad,$fecha='')
    {
        $array = $query1 = $query2 = array();
       
        $prestadores  = $this->db->select('id')
                        ->from('prestador')
                        ->where('especialidad',$especialidad)
                        ->get()
                        ->result();
        //die(var_dump($prestadores));
        
         IF(!empty($fecha)){
            $horaInicio = $fecha.' 00:00:00';
            $horaFin = $fecha.' 23:00:00';
         }ELSE {
             $fecha = date('Y-m-d H:i:s',strtotime ( '+1 day' ));
             $horaInicio = $fecha;
             $horaFin = date('Y-m-d H:i:s',strtotime ( '+90 day' ));
         }
         
        FOREACH($prestadores as $item){//echo $item->id;
            
            $horas  = $this->db->select('hora_prestador.id,hora_prestador.ciudad,hora_prestador.hora,prestador,prestador.nombres,prestador.apellidoPaterno,prestador.apellidoMaterno,prestador.descripcion')
                            ->from('hora_prestador')
                            ->join('prestador','prestador.id=hora_prestador.prestador')
                            ->where('ciudad',$ciudad)
                            ->where('prestador',$item->id)
                            ->where('hora >= "'.$horaInicio.'"')
                            ->where('hora <= "'.$horaFin.'"')
                            ->get()
                            ->result();
          IF(!empty($horas)){$query1 = array_merge($query1,$horas); }
        }
        //die(var_dump($query1));
        FOREACH ($query1 as $item){
            //echo $item->ciudad.'ciudad'.$item->hora.'hora'.$item->prestador;
            $hora  = $this->db->select('id,hora,prestador')
                        ->from('hora')
                        ->where('ciudad',$item->ciudad)
                        ->where('hora',$item->hora)
                        ->where('prestador',$item->prestador)
                        ->where('paciente is  NOT NULL')
                        ->get()
                        ->result();
           //echo var_dump($hora);
            IF(empty($hora)){ 
                $array = '';
                array_push($query2,array ('id'=>$item->id,'hora'=>$item->hora,'nombres'=>$item->nombres,'apellidoPaterno'=>$item->apellidoPaterno,'apellidoMaterno'=>$item->apellidoMaterno,'descripcion'=>$item->descripcion) ) ;}
            
        }
        //die(var_dump($query2));
        return  $query2;
    }
    
    
    public function dameHorasCalendario($ciudad,$especialidad)
    {
        $array = $query1 = $query2 = array();
       
        $prestadores  = $this->db->select('id')
                        ->from('prestador')
                        ->where('especialidad',$especialidad)
                        ->get()
                        ->result();
        //die(var_dump($prestadores));
        
         IF(!empty($fecha)){
            $horaInicio = $fecha.' 00:00:00';
            $horaFin = $fecha.' 23:00:00';
         }ELSE {
             $fecha = date('Y-m-d H:i:s',strtotime ( '+1 day' ));
             $horaInicio = $fecha;
             $horaFin = date('Y-m-d H:i:s',strtotime ( '+90 day' ));
             
         }
         
        FOREACH($prestadores as $item){
            
            $horas  = $this->db->select('hora_prestador.id,hora_prestador.ciudad,hora_prestador.hora,prestador')
                            ->from('hora_prestador')
                            ->join('prestador','prestador.id=hora_prestador.prestador')
                            ->where('ciudad',$ciudad)
                            ->where('prestador',$item->id)
                            ->where('hora >= "'.$horaInicio.'"')
                            ->where('hora <= "'.$horaFin.'"')
                            //->order_by('dia','asc')
                            //->group_by('ano,mes,dia')
                            ->get()
                            ->result();
          IF(!empty($horas)){$query1 = array_merge($query1,$horas); }
        }
        asort($query1);
        //die(var_dump($query1));
        FOREACH ($query1 as $item){
            
                $hora  = $this->db->select('id,hora,prestador')
                        ->from('hora')
                        ->where('ciudad',$item->ciudad)
                        ->where('hora',$item->hora)
                        ->where('prestador',$item->prestador)
                        ->where('paciente is  NOT NULL')
                        ->get()
                        ->result();
           
                IF(empty($hora)){ 
                    $array = '';
                    array_push($query2,array ('hora'=>$item->hora,'estado'=>'disponible') ) ;
                }ELSE {
                    $array = '';
              //      array_push($query2,array ('hora'=>$item->hora,'estado'=>'reservada') ) ;
                }
            
               
        }
        asort($query2);
        //die(var_dump($query2));
        return  $query2;
    }
    
    public function dameHorasPrestador($prestador,$ciudad)
    {
        $array = $query1 = $query2 = array();
       //$prestador=239;
                
             $fecha = date('Y-m-d H:i:s',strtotime ( '+1 day' ));
             $horaInicio = $fecha;
             $horaFin = date('Y-m-d H:i:s',strtotime ( '+90 day' ));
        
         
       
            
            $horas  = $this->db->select('hora_prestador.id,hora_prestador.ciudad,hora_prestador.hora,prestador,prestador.nombres,prestador.apellidoPaterno,prestador.apellidoMaterno,prestador.descripcion,prestador.especialidad,e.especialidad as espNombre')
                            ->from('hora_prestador')
                            ->join('prestador','prestador.id=hora_prestador.prestador')
                            ->join('especialidad e','e.id=prestador.especialidad')
                          //  ->where('ciudad',$ciudad)
                            ->where('prestador',$prestador)
                            ->where('hora >= "'.$horaInicio.'"')
                            ->where('hora <= "'.$horaFin.'"')
                            ->order_by('hora_prestador.hora','asc')
                            ->get()
                            ->result();
         // IF(!empty($horas)){$query1 = array_merge($query1,$horas); }
        
      //  die(var_dump($horas));
        FOREACH ($horas as $item){
            //echo $item->ciudad.'ciudad'.$item->hora.'hora'.$item->prestador;
            $hora  = $this->db->select('id,hora,prestador')
                        ->from('hora')
                        ->where('ciudad',$item->ciudad)
                        ->where('hora',$item->hora)
                        ->where('prestador',$item->prestador)
                        ->where('paciente is  NOT NULL')
                        ->get()
                        ->result();
           //echo var_dump($hora);
            IF(empty($hora)){ 
                $array = '';
                array_push($query2,array ('id'=>$item->id,'hora'=>$item->hora,'nombres'=>$item->nombres,'apellidoPaterno'=>$item->apellidoPaterno,'apellidoMaterno'=>$item->apellidoMaterno,'descripcion'=>$item->descripcion,'especialidad'=>$item->especialidad,'espNombre'=>$item->espNombre) ) ;
            }
            
        }
        //die(var_dump($query2));
        return  $query2;
    }

}
