<?php defined('BASEPATH') OR exit('No direct script access allowed');

class reserva extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('download', 'file','url', 'html', 'form'));
        $this->load->library(array('session','form_validation'));
        $this->load->helper('layout');
        $this->load->model("reserva_model");
        $this->load->model('calendario_model');
        $this->load->model('paciente_model');
        
        
        $this->folder = 'uploads/';
        
    }
    public function inicio()
    {  
        $data['especialidad']   = $this->reserva_model->dameEspecialidades();
        $data['prestador']   = $this->reserva_model->damePrestadores();
       // $data['menu']       = "gestion";
        Layout_Helper::cargaVista($this,'inicio',$data,'visita');   
    }
    
    public function buscar()
    {  
        $rut = $this->input->post('rut');
        $rut  = str_replace(array(".","-"), "", $rut);
        $letra   = substr($rut,0,1);if ($letra === "1" || $letra === "2"){$rut = substr($rut, 0, 8);}else {$rut = substr($rut, 0, 7);}
       
        ////BUSCAR HORA ANTERIOR DEL PACIENTE
        $paciente = $this->paciente_model->dameUno($rut);
        IF(!empty($paciente)){$horaAnterior = $this->reserva_model->dameHoraAnterior($paciente->id);}
        IF(!empty($horaAnterior) && $horaAnterior->contar >'0')$tipoHora = 'Control';
        ELSE $tipoHora = 'Nuevo';
        $especialidad = $this->input->post('especialidad');
        $prestador = $this->input->post('prestador');
        $centro = $this->input->post('centro');
        
        $data['especialidad']= $especialidad;
        $data['centro']= $centro;
        $data['rut']= $rut;
  //      $respuesta = $this->calendario_model->dameHorasCalendario($centro,$especialidad,$tipoHora);

        
        
        IF($prestador != 'Seleccionar Prestador' && $especialidad === 'Seleccionar Área Médica'){
                $datos = $this->calendario_model->dameHorasPrestador($prestador,$centro);
                $especialidad = $datos[0]['especialidad'];
                $data['especialidad']= $especialidad;
                $data['data'] = $datos;
                $respuesta = $this->calendario_model->dameHorasCalendario($centro,$especialidad,$tipoHora);
                IF(empty($data['data'])) {echo '<script>alert("Sin horas disponibles para el prestador seleccionado");</script>';$this->inicio();}
                ELSE Layout_Helper::cargaVista($this,'buscar',$data,'visita');  
        }
        ELSE {
                $respuesta = $this->calendario_model->dameHorasCalendario($centro,$especialidad,$tipoHora);
                IF(empty($respuesta)) {echo '<script>alert("Sin horas disponibles para la especialidad seleccionada");</script>';$this->inicio();}
                ELSE Layout_Helper::cargaVista($this,'buscar',$data,'visita');  
        }
    }
    
    public function detalleDia($item){
        $item = explode('_',$item);
        $fecha = $item[0];
        $rut = $item[1];
        $rut  = str_replace(array(".","-"), "", $rut);
        //$letra = substr($rut,0,1);if ($letra === "1" || $letra === "2"){$rut = substr($rut, 0, 8);}else {$rut = substr($rut, 0, 7);}
        $especialidad = $item[2];
        $centro = $item[3];
        
        
         ////BUSCAR HORA ANTERIOR DEL PACIENTE
        $paciente = $this->paciente_model->dameUno($rut);
        IF(!empty($paciente)){$horaAnterior = $this->reserva_model->dameHoraAnterior($paciente->id);}
        IF(!empty($horaAnterior) && $horaAnterior->contar >'0')$tipoHora = 'Control';
        ELSE $tipoHora = 'Nuevo';
        
        $data['data'] = $this->calendario_model->dameHoras($centro,$especialidad,$fecha,$tipoHora);
        $data['fecha']= $fecha;
        $data['especialidad']= $especialidad;
        $data['centro']= $centro;
        $data['rut']= $rut;
        Layout_Helper::cargaVista($this,'detalleDia',$data,'visita');   
    }
    public function confirmarReserva($item){
        $item = explode('_',$item);
        $hora_prestador = $item[0];
        $rut    = $item[1];
        $this->load->model('reserva_model');
        $this->load->model('paciente_model');
        $data['paciente'] = $this->paciente_model->dameUno($rut);
        $data['rut']= $rut;
        $data['data'] = $this->reserva_model->dameHora($hora_prestador);
        Layout_Helper::cargaVista($this,'confirmarReserva',$data,'visita');   
    }
    public function guardarReserva(){
        
        $rut = $this->input->post('rut');$rut  = str_replace(array(".","-"), "", $rut);$letra = substr($rut,0,1);if ($letra === "1" || $letra === "2"){$rut = substr($rut, 0, 8);}else {$rut = substr($rut, 0, 7);}
        $this->load->model('paciente_model');
        $paciente = $this->paciente_model->dameUno($rut);
        IF(!empty($paciente->id)) {$this->paciente_model->id = $paciente->id;}
        $this->paciente_model->rut = $rut;
        $this->paciente_model->nombres = $this->input->post('nombre');
        $this->paciente_model->apellidoPaterno = $this->input->post('apellidoPaterno');
        $this->paciente_model->apellidoMaterno = $this->input->post('apellidoMaterno');
        $this->paciente_model->telefono = $this->input->post('telefonoFijo');
        $this->paciente_model->celular = $this->input->post('telefonoCelular');
        $this->paciente_model->email = $this->input->post('email');
        $this->paciente_model->guardar();
        
        $this->load->model('reserva_model');
        IF(empty($paciente->id)) {$paciente = $this->paciente_model->dameUno($rut);}
        
        ////BUSCAR HORA ANTERIOR DEL PACIENTE
        $horaAnterior = $this->reserva_model->dameHoraAnterior($paciente->id);
        IF(!empty($horaAnterior) && $horaAnterior->contar >'0')$this->reserva_model->tipoHora = 'Control';
        ELSE $this->reserva_model->tipoHora = 'Nuevo';

        $hora = $this->reserva_model->dameHora($this->input->post('hora'));
        
        $idHora = $this->input->post('hora');
        IF(!empty($idHora)){
            //$this->reserva_model->idmodalidad = 1;
            $this->reserva_model->id = $idHora;
            $this->reserva_model->usuario = 10;
            //$this->reserva_model->hora = $hora->hora;
            //$this->reserva_model->prestador = $hora->prestador;
            //$this->reserva_model->ciudad = $hora->ciudad;
            $this->reserva_model->paciente = $paciente->id;      
            //$this->reserva_model->especialidad = $hora->espId;    
            $this->reserva_model->fecha_agendamiento = date('Y-m-d H:i:s');
            $this->reserva_model->guardar();
        }ELSE {die('error sin identificador');}
        
        
        $horaReserva = $this->reserva_model->dameHoraReserva($paciente->id,$hora->ciudad,$hora->prestador,$hora->hora);      
        //$data['horaReserva'] = $horaReserva;
        //Layout_Helper::cargaVista($this,'emailreservaHora',$data,'visita');   
        
        //die(var_dump($horaReserva));
        $this->emailreservaHora($horaReserva);
        $this->load->view('panel/modals/guardar_exitoso');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
/////////////////////////ENVIAR MAIL////////////////////////////
    public function emailreservaHora($horaReserva){

$idpaciente = $horaReserva->paciente;

$date = new DateTime($horaReserva->hora);
$fechareserva = $date->format('d-m-Y');
$horareserva  = $date->format('H:i');
    
    $mensaje = "
    <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    </head>
    <body>
    <p>
    Estimado(a):
    El Centro M&eacute;dico CETEP, le recuerda que tiene la siguiente hora reservada :
    
    
    <table class='table table-responsive' >
      <tr>
        <td>Nombre del Paciente: </td>
        <td style=\"padding-left: 5px\">".$horaReserva->nombres." ".$horaReserva->apellidoPaterno." ".$horaReserva->apellidoMaterno."</td>
      </tr>
      <tr>
        <td>Fecha de la reserva: </td>
        <td style=\"padding-left: 5px\">".$fechareserva."</td>
      </tr>
      <tr>
        <td>Hora de la reserva: </td>
        <td style=\"padding-left: 5px\">".$horareserva."</td>
      </tr>
      <tr>
        <td>Prestaci&oacute;n: </td>
        <td style=\"padding-left: 5px\">".$horaReserva->especialidad."</td>
      </tr>
      <tr>
        <td>Nombre del Profesional: </td>
        <td style=\"padding-left: 5px\">
        ".$horaReserva->preNombre." ".$horaReserva->preApePat." ".$horaReserva->preApeMat." 
        </td>
      </tr>
      <tr>
        <td>Direcci&oacute;n Consulta: </td>
        <td style=\"padding-left: 5px\">
        San P&iacute;o X 2460 of. 1506. Providencia 
        </td>
      </tr>
    </table>
    <br>
    <br>
    <p>
    <u>Para confirmar o anular su hora, le agradecemos nos cont&aacute;cte al 22604 4040 &oacute; al 22604 4041.</u>
    <br>
    <br>
    <strong>Le recordamos llegar 15 minutos antes, para realizar los tr&aacute;mites administrativos</strong>
    <br>
    <br>
    
    <u> En el caso que venga atrasado(a) a su hora le agradecemos avisar telef&oacute;nicamente al 22604 4040 &oacute;  al 22604 4041  y preguntar si su tratante lo podr&aacute; atender.</u>
    <br>
    <br>
    
    
    Si usted tiene seguro complementario le recordamos traer el formulario correspondiente y entreg&aacute;rselo al tratante una vez ingresado al box. 
    Nuestra direcci&oacute;n es San P&iacute;o X 2460 of. 1506. Providencia.
    <br>
    <br>
    
    <a href='http://www.cetep.cl/web/?page_id=39' >M&aacute;s informaci&oacute;n sobre nuestros servicios</a>


       
    <br>
    <br>
            Atentamente,
            <br>
            <br><img style='width: 20%; ' src='".base_url()."../assets/img/logo_vertical_cetep.png' >
            <br>
            Centro Médico Cetep
            
             
     </p>

</body> ";

    
    


        $destinatario=$horaReserva->email;
        $asunto = 'Reserva de horas Clínicas. IMPORTANTE: Este correo es informativo y automatizado, favor no responder. ';
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
     //   $headers .= "From: Calidad <calidad@cetep.cl>\r\n"; //dirección del remitente 
        $headers .= "From: Cetep Centro Medico <reservas@cetep.cl>\r\n"; //dirección del remitente 
    //    $headers .= "bcc: griedel@cetep.cl";
                $headers .= "bcc: dti@cetep.cl,reservas@cetep.cl";

        
        
     

    try {

        mail($destinatario,$asunto,$mensaje,$headers) ;
        return 'OK';
        $resp = 'Mensaje enviado con &eacutexito<br> ';
        echo $resp;
        } catch (phpmailerException $e) {
            $resp = 'Se produjo un error al enviar e-mail con destino ';
            $resp = '¡¡Error!! : '.$e->errorMessage();
            return 'ERROR';
        }



    
    }
    
    
    
    
    
    
    
    
}
