<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Calendario_model extends CI_MODEL
{

    public function __construct()
    {
        $this->load->database('default');
    }
     public function dameHoras($ciudad,$especialidad,$fecha='',$tipoHora)
    {
        $array = $query1 = $query2 = array();
       
     //  die($especialidad);
         IF(!empty($fecha)){
            $horaInicio = $fecha.' 00:00:00';
            $horaFin = $fecha.' 23:00:00';
         }ELSE {
             $fecha = date('Y-m-d H:i:s',strtotime ( '+1 day' ));
             $horaInicio = $fecha;
             $horaFin = date('Y-m-d H:i:s',strtotime ( '+90 day' ));
             
         }
         
            $horas  = $this->db->select('h.id,h.ciudad,h.hora,h.prestador,h.paciente,prestador.nombres,prestador.apellidoPaterno,prestador.apellidoMaterno,prestador.descripcion')
                             ->from('hora h')
                            ->join('prestador','prestador.id=h.prestador','inner')
                            ->join('prestador_especialidad e','prestador.id=e.idprestador','inner')
                            ->where('h.ciudad',$ciudad)
                        //    ->where('h.especialidad',$especialidad)
                            ->where('e.idespecialidad',$especialidad)
                            ->where('h.hora >= "'.$horaInicio.'"')
                            ->where('h.hora <= "'.$horaFin.'"')
                            ->where('h.paciente is NULL')
                            ->where('h.idmodalidad',1)
                            ->where('e.modalidad',1)
            //                ->where('h.tipoHora',$tipoHora)
                            ->get()
                            ->result();

      //   die(var_dump($horas));
            FOREACH ($horas as $item){
            
                $hora  = $this->db->select('e.id')
                        ->from('horas_eliminadas e')
                        ->where('e.idHora',$item->id)
                        ->where('e.paciente',$item->paciente)
                        ->get()
                        ->row();
           
            IF(empty($hora)){ 
                $array = '';
                array_push($query2,array ('id'=>$item->id,'hora'=>$item->hora,'nombres'=>$item->nombres,'apellidoPaterno'=>$item->apellidoPaterno,'apellidoMaterno'=>$item->apellidoMaterno,'descripcion'=>$item->descripcion) ) ;}
            
        }
      //  die(var_dump($query2));
        return  $query2;
    }
    
    
    public function dameHorasCalendario($ciudad,$especialidad,$tipoHora)
    {
        $array = $query1 = $query2 = array();
       
    //   die($especialidad);
         IF(!empty($fecha)){
            $horaInicio = $fecha.' 00:00:00';
            $horaFin = $fecha.' 23:00:00';
         }ELSE {
             $fecha = date('Y-m-d H:i:s',strtotime ( '+1 day' ));
             $horaInicio = $fecha;
             $horaFin = date('Y-m-d H:i:s',strtotime ( '+90 day' ));
             
         }
         
      
            $horas  = $this->db->select('h.id,h.ciudad,h.hora,h.paciente,prestador,DAY(h.hora) as dia,MONTH(h.hora) as mes')
                            ->from('hora h')
                            ->join('prestador','prestador.id=h.prestador','inner')
                            ->join('prestador_especialidad e','prestador.id=e.idprestador','inner')
                            ->where('h.ciudad',$ciudad)
                    //        ->where('h.tipoHora',$tipoHora)
                    //        ->where('h.especialidad',$especialidad)
                            ->where('h.hora >= "'.$horaInicio.'"')
                            ->where('h.hora <= "'.$horaFin.'"')
                            ->where('h.paciente is NULL')
                            ->where('h.idmodalidad',1)
                            ->where('e.modalidad',1)
                            ->where('e.idespecialidad',$especialidad)
                            ->GROUP_BY ( 'dia','mes')
                            ->get()
                            ->result();
         
   // die(var_dump($horas));
        FOREACH ($horas as $item){
            
                $hora  = $this->db->select('e.id')
                        ->from('horas_eliminadas e')
                        ->where('e.idHora',$item->id)
                        ->where('e.paciente',$item->paciente)
                        ->get()
                        ->row();
           
                IF(empty($hora)){ 
                    $array = '';
                    array_push($query2,array ('id'=>$item->id,'hora'=>$item->hora,'estado'=>'disponible') ) ;
                }ELSE {
                  //  die(var_dump($hora));
                    $array = '';
              //      array_push($query2,array ('hora'=>$item->hora,'estado'=>'reservada') ) ;
                }
            $hora= '';
               
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
        
         
       
            
            $horas  = $this->db->select('h.id,h.ciudad,h.hora,h.prestador,prestador.nombres,prestador.apellidoPaterno,prestador.apellidoMaterno,prestador.descripcion,e.idespecialidad as especialidad,s.especialidad as espNombre')
                            ->from('hora h')
                            ->join('prestador','prestador.id=h.prestador')
                            ->where('h.paciente is NULL')
                            ->join('prestador_especialidad e','prestador.id=e.idprestador','inner')
                            ->join('especialidad s','s.id=e.idespecialidad')
                            //  ->where('ciudad',$ciudad)
                            ->where('prestador',$prestador)
                            ->where('hora >= "'.$horaInicio.'"')
                            ->where('hora <= "'.$horaFin.'"')
                            ->where('h.idmodalidad',1)
                            ->order_by('h.hora','asc')
                            ->get()
                            ->result();
         // IF(!empty($horas)){$query1 = array_merge($query1,$horas); }
        
      //  die(var_dump($horas));
        FOREACH ($horas as $item){
            
                $hora  = $this->db->select('e.id')
                        ->from('horas_eliminadas e')
                        ->where('e.idHora',$item->id)
                        ->get()
                        ->row();
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
