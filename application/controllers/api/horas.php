<?php

/**
 * Created by Netbeans.
 * User: Gerardo Riedel
 * Date: 21/09/2016
 * Time: 14:00
 */
class Horas extends CI_Controller
{

    function __construct(){
        parent::__construct();
        
        //$this->load->helper('validacion');
    }

    
    public function index($item){
        $item = explode('_', $item);
        $especialidad = $item[0];
        $ciudad = $item[1];
        $rut = $item[2];
        
        ////BUSCAR HORA ANTERIOR DEL PACIENTE
        $this->load->model('paciente_model');
        $this->load->model('reserva_model');
        $paciente = $this->paciente_model->dameUno($rut);
        IF(!empty($paciente)){$horaAnterior = $this->reserva_model->dameHoraAnterior($paciente->id);}
        IF(!empty($horaAnterior) && $horaAnterior->contar >'0')$tipoHora = 'Control';
        ELSE $tipoHora = 'Nuevo';
        
        $this->load->model('calendario_model');
        $respuesta = $this->calendario_model->dameHorasCalendario($ciudad,$especialidad,$tipoHora);
        asort($respuesta);
        $events = array();
        FOREACH($respuesta as $res[0]){
            
                $date = new datetime($res[0]['hora']);
                $dia = $date->format('Y-m-d');
                IF(empty($dateANT)){$dateANT = $date->format('Y-m-d 01:00:00');}
                $e = array();
                
                IF($dateANT !==$dia){
                
                    $e['start'] = $dia;

                    IF($res[0]['estado']==='disponible'){
                        $color='green';
                        $e['title'] = ' Ver horas';
                        $e['url'] = "detalleDia/".$dia.'_'.$rut."_".$especialidad."_".$ciudad;
                    }
                    ELSE {
                        $color='red';
                        $e['title'] = ' Sin horas';
                    }

                    $e['backgroundColor'] = $color;
                    array_push($events, $e);
                }
                $dateANT = new datetime($res[0]['hora']);
                $dateANT = $dateANT->format('Y-m-d');
        }
            echo json_encode($events);
    }
    public function existeRut($item){
        $item = explode('_', $item);
        $especialidad = $item[0];
        $ciudad = $item[1];
        $rut = $item[2];
        $largo = strlen($rut)-1;
        $rut = substr($rut, 0, $largo);
        ////BUSCAR HORA FUTURA DEL PACIENTE
        $this->load->model('paciente_model');
        $this->load->model('reserva_model');
        $paciente = $this->paciente_model->dameUno($rut);
        IF(!empty($paciente)){$horaFutura = $this->reserva_model->dameHoraFutura($paciente->id,$ciudad,$especialidad);}
        IF(empty($horaFutura))$horaFutura = 'no';
        //$horaFutura = 'no';
        echo json_encode($horaFutura);
    }
}