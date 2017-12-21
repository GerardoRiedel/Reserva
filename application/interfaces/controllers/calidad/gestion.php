<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class gestion extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();


        $this->load->helper(array('download', 'file', 'url', 'html', 'form'));
        $this->load->helper('layout');
        
        $this->folder = 'uploads/';
        $this->load->model("sugerencia_model");
        $this->load->model("reclamo_model");
        $this->load->model("comunas_model");
        $this->load->model("parametros_model");
    }
    public function index()
    {
        $data['title']           = '';
        Layout_Helper::cargaVista($this,'inicio',$data,'ingresos');   
    }
    public function listar_felicitaciones()
    {
        $data['felicitaciones'] = $this->sugerencia_model->dameTodo();
        $data['menu']       = "listar";
        $data['submenu']    = "felicitaciones";
        $data['title']           = 'Listado de Sugerencias y Felicitaciones';
        Layout_Helper::cargaVista($this,'listar_felicitaciones',$data,'ingresos');   
    }
     public function listar_reclamos()
    {
        $data['reclamos'] = $this->reclamo_model->dameTodo();
        $data['menu']       = "listar";
        $data['submenu']    = "reclamos";
        $data['title']           = 'Listado de Reclamos';
        Layout_Helper::cargaVista($this,'listar_reclamos',$data,'ingresos');   
    }



    
    public function felicitacion()
    {    
        $data['comuna']  = $this->comunas_model->dameTodo();
        $data['title']           = "Felicitaciones o Sugerencias";
        $data['menu']       = "gestion";
        $data['submenu']    = "felicitacion";
        Layout_Helper::cargaVista($this,'felicitacion',$data,'ingresos');   
    }
    public function guardarSugerencia()
    {
        $rut        = str_replace(array(".","-"), "", $this->input->post('rut'));
        $letra      = substr($rut,0,1);if ($letra === "1" || $letra === "2"){$rut = substr($rut, 0, 8);}else {$rut = substr($rut, 0, 7);}
        
        $this->sugerencia_model->sugFecha         = date('Y-m-d H:i:s');
        $this->sugerencia_model->sugRut               = $rut;
        $this->sugerencia_model->sugNombre      = $this->input->post('nombre');
        $this->sugerencia_model->sugApePat        = $this->input->post('apePat');
        $this->sugerencia_model->sugApeMat        = $this->input->post('apeMat');
        $this->sugerencia_model->sugDomicilio    = $this->input->post('domicilio');
        $this->sugerencia_model->sugComuna     = $this->input->post('comuna');
        $this->sugerencia_model->sugTelefono     = $this->input->post('telefono');
        $this->sugerencia_model->sugEmail           = $this->input->post('email');
        $this->sugerencia_model->sugHechos       = $this->input->post('hechos');
        $this->sugerencia_model->sugUsuario       = $this->session->userdata('id_usuario');
        $this->sugerencia_model->guardar();
        
        $sugerencia = $this->sugerencia_model->dameUltimo($rut);
        
        $this->envioSugerencia($sugerencia->sugId);
    }
    
     public function reclamo()
    {   
        $data['comuna']  = $this->comunas_model->dameTodo();
        $data['unidad']    = $this->parametros_model->dameUnidades();
        $data['title']      = "Reclamos";
        $data['menu']       = "gestion";
        $data['submenu']    = "reclamo";
        Layout_Helper::cargaVista($this,'reclamo',$data,'ingresos');   
    }
    public function cargarReclamo($id)
    {   
        $data['comuna']  = $this->comunas_model->dameTodo();
        $data['unidad']    = $this->parametros_model->dameUnidades();
        $envio = $this->reclamo_model->dameUno($id);
        $data['reclamo'] = $envio[0];
        $data['unidadReclamo']   = $envio[1][0];
        $data['title']      = "Reclamos";
        $data['menu']       = "gestion";
        $data['submenu']    = "reclamo";
        Layout_Helper::cargaVista($this,'reclamo',$data,'ingresos');   
    }
    public function guardarReclamo()
    {
        $rut        = str_replace(array(".","-"), "", $this->input->post('rut'));
        $letra      = substr($rut,0,1);if ($letra === "1" || $letra === "2"){$rut = substr($rut, 0, 8);}else {$rut = substr($rut, 0, 7);}
        
        $recId=$this->input->post('recId');
        IF(!empty($recId)){$this->reclamo_model->recId = $recId;}
        $this->reclamo_model->recFecha         = date('Y-m-d H:i:s');
        $this->reclamo_model->recRut               = $rut;
        $this->reclamo_model->recNombre      = $this->input->post('nombre');
        $this->reclamo_model->recApePat        = $this->input->post('apePat');
        $this->reclamo_model->recApeMat        = $this->input->post('apeMat');
        $this->reclamo_model->recArea             = $this->input->post('area');
        $this->reclamo_model->recDomicilio    = $this->input->post('domicilio');
        $this->reclamo_model->recComuna     = $this->input->post('comuna');
        $this->reclamo_model->recTelefono     = $this->input->post('telefono');
        $this->reclamo_model->recEmail           = $this->input->post('email');
        $this->reclamo_model->recRespuesta = $this->input->post('respuesta');
        $this->reclamo_model->recHechos       = $this->input->post('hechos');
        $this->reclamo_model->recPeticion       = $this->input->post('peticion');
        $this->reclamo_model->recUsuario       = $this->session->userdata('id_usuario');
        
        $apoRut = $this->input->post('apoRut');
        IF(!empty($apoRut)){
            $apoRut        = str_replace(array(".","-"), "",$apoRut);
            $letra      = substr($apoRut,0,1);if ($letra === "1" || $letra === "2"){$apoRut = substr($apoRut, 0, 8);}else {$apoRut = substr($apoRut, 0, 7);}
                
            $this->reclamo_model->recApoRut              = $apoRut;
            $this->reclamo_model->recApoNombre      = $this->input->post('apoNombre');
            $this->reclamo_model->recApoApePat        = $this->input->post('apoApePat');
            $this->reclamo_model->recApoApeMat       = $this->input->post('apoApeMat');
            $this->reclamo_model->recApoVinculo       = $this->input->post('vinculo');
            $this->reclamo_model->recApoDomicilio   = $this->input->post('apoDomicilio');
            $this->reclamo_model->recApoComuna     = $this->input->post('apoComuna');
            $this->reclamo_model->recApoTelefono     = $this->input->post('apoTelefono');
            $this->reclamo_model->recApoEmail          = $this->input->post('apoEmail');
            $this->reclamo_model->recApoRespuesta = $this->input->post('apoRespuesta');
        }
        $this->reclamo_model->guardar();
        IF(!empty($recId)){
            $this->listar_reclamos();
        }
        ELSE {
            $reclamo = $this->reclamo_model->dameUltimo($rut);
            $this->envioReclamo($reclamo->recId);
        }
    }
    
    public function envioSugerencia($id)
    {
        $sugerencia = $this->sugerencia_model->dameUno($id);
        
        $mail = 'calidad@cetep.cl';//DESDE
        $header = 'From: ' . $mail . " \r\n";
        $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
        $header .= "Mime-Version: 1.0 \r\n";
        $header .= "Content-Type: text/html";
        
        $fecha = new DateTime($sugerencia->sugFecha);
        $fecha = $fecha->format('d-m-Y');
        $nombre = strtoupper($sugerencia->sugNombre)." ".strtoupper($sugerencia->sugApePat)." ".strtoupper($sugerencia->sugApeMat);
        $domicilio = strtoupper($sugerencia->sugDomicilio);
        $comuna = strtoupper($sugerencia->comNombre);
        $telefono = $sugerencia->sugTelefono;
        $email = strtoupper($sugerencia->sugEmail);
        $hecho = strtoupper($sugerencia->sugHechos);
        $resumen="
        <table border='0' style='width:700px'>
            <tr>
                <td>
                    <img style='width: 20%; ' src='".base_url()."../assets/img/logo_vertical_cetep.png' >
                    <img style='width: 35%; ' src='".base_url()."../assets/img/mirAndes.png' >
                </td>
                <td style='border-left:none' align='right'>Fecha ".$fecha."</td>
                
            </tr>
        </table>
        
        <table border='1' style='width:700px'>
            <tr>
                <td colspan='2'>Paciente</td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td>".$nombre."</td>
            </tr>
            <tr>
                <td>Rut</td>
                <td>".$sugerencia->sugRut."</td>
            </tr>
            <tr>
                <td>Domicilio</td>
                <td>".$domicilio."</td>
            </tr>
            <tr>
                <td>Comuna</td>
                <td>".$comuna."</td>
            </tr>
            <tr>
                <td>Telefono</td>
                <td>".$telefono."</td>
            </tr>
            <tr>
                <td>Mail</td>
                <td>".$email."</td>
            </tr>
            <tr>
                <td colspan='2'>Felicitación o Sugerencia</td>
            </tr>
            <tr>
                <td colspan='2'>".$hecho."</td>
            </tr>
        </table>
        <br>
        
        ";

        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
        $headers .= "From: Calidad <calidad@cetep.cl>\r\n"; //dirección del remitente 
        //$headers .= "CCO: calidad@cetep.cl";
        
        
        $asunto = 'Felicitación, sugerencia o reclamo';
        $headers .= "CC: griedel@cetep.cl";
        IF(!empty($email))$destinatario = $email; ELSE $destinatario = '';        

    mail($destinatario,$asunto,$resumen,$headers) ;
    $data = array('recId' => '');$this->session->set_userdata($data);	
    //echo $resumen;die;
    $this->load->view('panel/modals/guardar_exitoso');
    }
    
    public function envioReclamo($id)
    {
        $envio = $this->reclamo_model->dameUno($id);
        $reclamo = $envio[0];
        $unidad   = $envio[1][0];
        //die(var_dump($reclamo));
        $mail = 'calidad@cetep.cl';//DESDE
        $header = 'From: ' . $mail . " \r\n";
        $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
        $header .= "Mime-Version: 1.0 \r\n";
        $header .= "Content-Type: text/html";
        
        $fecha = new DateTime($reclamo->recFecha);
        $fecha = $fecha->format('d-m-Y');
        $nombre = strtoupper($reclamo->recNombre)." ".strtoupper($reclamo->recApePat)." ".strtoupper($reclamo->recApeMat);
        $area = strtoupper($unidad->descripcion);
        $domicilio = strtoupper($reclamo->recDomicilio);
        $comuna = strtoupper($reclamo->comNombre);
        $telefono = $reclamo->recTelefono;
        $email = strtoupper($reclamo->recEmail);
        $respuesta = $reclamo->recRespuesta; IF($respuesta === '1')$respuesta = 'SI'; ELSE $respuesta = 'NO';
        
        $apoNombre = strtoupper($reclamo->recApoNombre)." ".strtoupper($reclamo->recApoApePat)." ".strtoupper($reclamo->recApoApeMat);
        $apoDomicilio = strtoupper($reclamo->recApoDomicilio);
        $apoComuna = strtoupper($reclamo->comApoNombre);
        $apoTelefono = $reclamo->recApoTelefono;
        $apoEmail = strtoupper($reclamo->recApoEmail);
        $vinculo = $reclamo->recApoVinculo; IF($vinculo === '1')$vinculo = 'Rep. Legal'; ELSEIF($vinculo === '2') $vinculo = 'Apoderado'; ELSE $vinculo='';
        $apoRespuesta = $reclamo->recApoRespuesta; IF($apoRespuesta === '1')$apoRespuesta = 'SI'; ELSEIF($apoRespuesta === '2') $apoRespuesta = 'NO'; ELSE $apoRespuesta= '';
        
        
        $hecho = $reclamo->recHechos;
        $peticion = $reclamo->recPeticion;
        
        $resumen="
        <table border='0'>
            <tr>
                <td rowspan='2' style='width:650px'>";
                    
                        IF($area === 'MIRANDES HD y RH' || $area === 'MIRANDES CLINICA ' || $area === 'MIRANDES HD CONCEPCION' || $area === 'MIRANDES HD RANCAGUA' ){

                                    $resumen .= "<img style='width: 20%; ' src='".base_url()."../assets/img/mirAndes.png' >";
                        }ELSE {
                                    $resumen .= "<img style='width: 20%; ' src='".base_url()."../assets/img/logo_vertical_cetep.png' >";
                        }
         $resumen .="
                </td>
                <td style='width:50px'>N°</td>
                <td style='width:100px'>".$reclamo->recId."</td>
            </tr>
            <tr>
                <td>Fecha</td>
                <td>".$fecha."</td>
            </tr>
        </table>
        
        <table border='1' style='width:800px'>
            <tr>
                <td colspan='2'>Paciente</td>
                <td style='border:none'></td>
                <td colspan='2'>Apoderado o Representancte legal según ley N°20.584</td>
            </tr>
            <tr>
                <td style='width:199px'>Nombre y Apellido</td>
                <td style='width:200px'>".$nombre."</td>
                <td style='border:none'></td>
                <td style='width:199px'>Nombre y Apellido</td>
                <td style='width:200px'>".$apoNombre."</td>
            </tr>
            <tr>
                <td>Área o dependencia de atención</td>
                <td>".$area."</td>
                <td style='border:none'></td>
                <td>Vinculo con el paciente</td>
                <td>".$vinculo."</td>
            </tr>
            <tr>
                <td>Rut</td>
                <td>".$reclamo->recRut."</td>
                <td style='border:none'></td>
                <td>Rut</td>
                <td>".$reclamo->recApoRut."</td>
            </tr>
            <tr>
                <td>Domicilio</td>
                <td>".$domicilio."</td>
                <td style='border:none'></td>
                <td>Domicilio</td>
                <td>".$apoDomicilio."</td>
            </tr>
            <tr>
                <td>Comuna</td>
                <td>".$comuna."</td>
                <td style='border:none'></td>
                <td>Comuna</td>
                <td>".$apoComuna."</td>
            </tr>
            <tr>
                <td>Telefono</td>
                <td>".$telefono."</td>
                <td style='border:none'></td>
                <td>Telefono</td>
                <td>".$apoTelefono."</td>
            </tr>
            <tr>
                <td>Mail</td>
                <td>".$email."</td>
                <td style='border:none'></td>
                <td>Mail</td>
                <td>".$apoEmail."</td>
            </tr>
            <tr>
                <td>Autoriza respuesta correo electrónico</td>
                <td>".$respuesta."</td>
                <td style='border:none'></td>
                <td>Autoriza respuesta correo electrónico</td>
                <td>".$apoRespuesta."</td>
            </tr>
            <tr>
                <td colspan='5'><i>Indicación de los hechos que fundamente su reclamo y de la infracción a los derechos que contempla la ley:</i><br> ".$hecho."</td>
            </tr>
            <tr>
                <td colspan='5'><i>Petición concreta:</i> <br> ".$peticion."</td>
            </tr>
            <tr>
                <td colspan='5' style='border:none'><input type='checkbox' checked>Entiendo y acepto que puede ser necesario acceder a la información clínica para la investigación y respuesta de este caso</td>
            </tr>
            <tr>
                <td colspan='5' style='border:none; font-size:9px'>De conformidad a lo señalado en el reglamento del MINSAL sobre procedimientos de reclamo de la ley N°20.584, le informamos su facultad para recurrir ante la Superintendencia de Salud para presentar su reclamo.</td>
            </tr>
        </table>
        <br>
        ";

        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
        $headers .= "From: Calidad <calidad@cetep.cl>\r\n"; //dirección del remitente 
        //$headers .= "CCO: calidad@cetep.cl,".$unidad->mail;
        //$headers .= "CC: griedel@cetep.cl,".$unidad->mail;
        $headers .= "CC: griedel@cetep.cl";
        IF(!empty($email))$destinatario = $email; ELSE $destinatario = '';
        $asunto = 'Felicitación, sugerencia o reclamo';
    mail($destinatario,$asunto,$resumen,$headers) ;
    $data = array('recId' => $id);$this->session->set_userdata($data);	
    //echo $resumen;die;
    $this->load->view('panel/modals/guardar_exitoso');
    }
    
    public function noConforme()
    {
        $colaborador    = $this->parametros_model->dameColaborador($this->session->userdata('id_usuario'));
        $jefe                   = $this->parametros_model->dameJefe($this->session->userdata('id_usuario'));
        IF($jefe->nombre === $colaborador->nombre && $jefe->apellidoPaterno === $colaborador->apellidoPaterno  || $colaborador->id === '57' || $colaborador->id === '64' || $colaborador->id === '285' || $colaborador->id === '38'){
            $data['jefeUnidad'] = 'SI';
        }
        $data['datos']    = $this->parametros_model->dameTodoUnidad($colaborador->idunidad);
        $data['colaborador'] = $colaborador;
        $data['title']           = "Planilla de Producto / Servicio No Conforme";
        $data['menu']       = "planilla";
        $data['submenu']    = "planilla";
        Layout_Helper::cargaVista($this,'noConforme',$data,'ingresos');   
    }
    public function guardarNoConforme()
    {
        $colaborador = $this->parametros_model->dameColaborador($this->session->userdata('id_usuario'));
        
        $fecha = new datetime($this->input->post('fecha'));
        $fecha = $fecha->format('Y-m-d');
        $plaId = $this->input->post('plaId');
        IF(!empty($plaId)){
             $this->parametros_model->plaId = $plaId;
             $this->parametros_model->plaEdithUsuario = $this->session->userdata('id_usuario');
             $this->parametros_model->plaEdithFecha = date('Y-m-d H:i:s');
        }ELSE{
             $this->parametros_model->plaUsuario = $this->session->userdata('id_usuario');
             $this->parametros_model->plaFecha = date('Y-m-d H:i:s');
        }
            
        $this->parametros_model->plaNombre = $colaborador->nombre;
        $this->parametros_model->plaApellido = $colaborador->apellidoPaterno;
        $this->parametros_model->plaUnidad = $colaborador->idunidad;
        $this->parametros_model->plaFechaHecho = $fecha;
        $this->parametros_model->plaMotivo = $this->input->post('motivo');
        $this->parametros_model->plaDescripcion = $this->input->post('descripcion');
        $this->parametros_model->plaAccion = $this->input->post('accion');
        
        $seguimiento = $this->input->post('seguimiento');
        IF(!empty($seguimiento)){
            $this->parametros_model->plaSeguimiento = $seguimiento;
            $this->parametros_model->plaProveedor = $this->input->post('proveedor');
            $this->parametros_model->plaCliente = $this->input->post('cliente');
            $this->parametros_model->plaProfesional = $this->input->post('profesional');
            $this->parametros_model->plaUnidadCheck = $this->input->post('unidadCheck');
            $this->parametros_model->plaNoAplica = $this->input->post('noaplica');
        }
        $this->parametros_model->guardarPlanilla();
        $this->noConforme();
    }
     public function listar_noConforme()
    {
        $data['datos']    = $this->parametros_model->dameTodo();
        $data['title']           = "Lista Planilla de Producto / Servicio No Conforme";
        $data['menu']       = "listar";
        $data['submenu']    = "noConforme";
        Layout_Helper::cargaVista($this,'listar_noConforme',$data,'ingresos');   
    }
    public function modificarNoConforme($id)
    {
        $colaborador    = $this->parametros_model->dameColaborador($this->session->userdata('id_usuario'));
        $jefe                   = $this->parametros_model->dameJefe($this->session->userdata('id_usuario'));
        IF($jefe->nombre === $colaborador->nombre && $jefe->apellidoPaterno === $colaborador->apellidoPaterno  || $colaborador->id === '57' || $colaborador->id === '64' || $colaborador->id === '285' || $colaborador->id === '38'){
            $data['jefeUnidad'] = 'SI';
        }
        $data['datos']    = $this->parametros_model->dameTodoUnidad($colaborador->idunidad);
        $data['planilla']    = $this->parametros_model->dameUno($id);
        $data['colaborador'] = $colaborador;
        $data['title']           = "Planilla de Producto / Servicio No Conforme";
        $data['menu']       = "planilla";
        $data['submenu']    = "planilla";
        Layout_Helper::cargaVista($this,'noConforme',$data,'ingresos');   
    }
    
    
    
    
    public function cargarRespuesta($id)
    {
        $colaborador    = $this->parametros_model->dameColaborador($this->session->userdata('id_usuario'));
        
        IF($colaborador->id === '57' || $colaborador->id === '64' || $colaborador->id === '285' || $colaborador->id === '38'){
            $data['calidad'] = 'SI';
        }
        
        $data['comuna']  = $this->comunas_model->dameTodo();
        $data['unidad']    = $this->parametros_model->dameUnidades();
        $envio = $this->reclamo_model->dameUno($id);
        $data['respuesta'] = $this->reclamo_model->dameRespuesta($id);
        //die(var_dump( $data['respuesta'] ));
        $data['reclamo'] = $envio[0];
        $data['unidadReclamo']   = $envio[1][0];
        $data['title']      = "Respuesta";
        $data['menu']       = "gestion";
        $data['submenu']    = "reclamo";
        Layout_Helper::cargaVista($this,'respuesta',$data,'ingresos');   
    }
    
    public function guardarRespuesta()
    {
        
        $recId = $this->input->post('recId');
        IF(!empty($recId))$this->reclamo_model->resReclamo = $recId;
        $this->reclamo_model->resUsuario = $this->session->userdata('id_usuario');
        $this->reclamo_model->resFecha = date('Y-m-d H:i:s');
        $this->reclamo_model->resHecho = $this->input->post('reclamo');
        $this->reclamo_model->resRespuesta = $this->input->post('respuesta');
        $this->reclamo_model->guardarRespuesta();
        unset($this->reclamo_model->resReclamo,$this->reclamo_model->resUsuario,$this->reclamo_model->resFecha,$this->reclamo_model->resHecho,$this->reclamo_model->resRespuesta);
        
        $enviar = $this->input->post('enviar');
        IF($enviar === 'on' && !empty($recId)){
            $this->reclamo_model->recId = $recId;
            $this->reclamo_model->recEstado = 3;
            
            $this->reclamo_model->guardar();
            $this->enviarRespuesta($recId);
        
            $mail = 'calidad@cetep.cl';//DESDE
            $header = 'From: ' . $mail . " \r\n";
            $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
            $header .= "Mime-Version: 1.0 \r\n";
            $header .= "Content-Type: text/html";
            $resumen=" Estimado departamento de calidad, se ha generado la respuesta a requerimiento N°".$recId.", favor revisar y enviar resolución a paciente.<br><br>"
                    . "Este correo se ha generado automaticamente, favor no responder.<br><br>"
                    . "Atte<br>"
                    . "Cetep";
            $headers = "MIME-Version: 1.0\r\n"; 
            $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
            $headers .= "From: Calidad <calidad@cetep.cl>\r\n"; //dirección del remitente 
            $destinatario = 'gerardo.riedel.c@gmail.com';
            $asunto = 'Respuesta de Reclamo';
            mail($destinatario,$asunto,$resumen,$headers) ;
            
            $this->listar_reclamos();
            
        }ELSE {
        $this->cargarRespuesta($recId);
        }
        
    }
    
    public function enviarRespuesta($id)
    {
        $respuesta = $this->reclamo_model->dameRespuesta($id);
        $envio = $this->reclamo_model->dameUno($id);
        $reclamo = $envio[0];
        $unidad   = $envio[1][0];
        
        //die(var_dump($reclamo));
        $mail = 'calidad@cetep.cl';//DESDE
        $header = 'From: ' . $mail . " \r\n";
        $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
        $header .= "Mime-Version: 1.0 \r\n";
        $header .= "Content-Type: text/html";
        
        $fecha = new DateTime($respuesta->resFecha);
        $fecha = $fecha->format('d-m-Y');
        $fechaReclamo = new DateTime($reclamo->recFecha);
        $fechaReclamo = $fechaReclamo->format('d-m-Y');
        
        $nombre = $reclamo->recNombre." ".$reclamo->recApePat." ".$reclamo->recApeMat;
        $area = strtoupper($unidad->descripcion);
        $domicilio = $reclamo->recDomicilio;
        $comuna = strtoupper($reclamo->comNombre);
        //$telefono = $reclamo->recTelefono;
        $email = strtoupper($reclamo->recEmail);
        
        $respuestaHecho = $respuesta->resHecho;
        $respuestaHechoLargo = strlen($respuestaHecho);
        IF($respuestaHechoLargo<600)$respuestaHechoLargo=125;
        ELSEIF($respuestaHechoLargo<900)$respuestaHechoLargo=250;
        ELSE $respuestaHechoLargo=350;
        
        $respuestaRespuesta = $respuesta->resRespuesta;
        $respuestaRespuestaLargo = strlen($respuestaRespuesta);
         IF($respuestaRespuestaLargo<600)$respuestaRespuestaLargo=125;
        ELSEIF($respuestaRespuestaLargo<900)$respuestaRespuestaLargo=250;
        ELSE $respuestaRespuestaLargo=350;
        
        $apoNombre = strtoupper($reclamo->recApoNombre)." ".strtoupper($reclamo->recApoApePat)." ".strtoupper($reclamo->recApoApeMat);
        $apoDomicilio = strtoupper($reclamo->recApoDomicilio);
        $apoComuna = strtoupper($reclamo->comApoNombre);
        //$apoTelefono = $reclamo->recApoTelefono;
        $apoEmail = strtoupper($reclamo->recApoEmail);
        //$vinculo = $reclamo->recApoVinculo; IF($vinculo === '1')$vinculo = 'Rep. Legal'; ELSEIF($vinculo === '2') $vinculo = 'Apoderado'; ELSE $vinculo='';
        //$apoRespuesta = $reclamo->recApoRespuesta; IF($apoRespuesta === '1')$apoRespuesta = 'SI'; ELSEIF($apoRespuesta === '2') $apoRespuesta = 'NO'; ELSE $apoRespuesta= '';
        
        $director = $this->parametros_model->dameJefeUnidad($unidad->id);
        $directorNombre = $director->Nombre.' '.$director->apellidoPaterno.' '.$director->apellidoMaterno;
        //$hecho = $reclamo->recHechos;
        //$peticion = $reclamo->recPeticion;

        $resumen="
        <table border='0'>
            <tr>
                <td rowspan='2' style='width:650px'>";
                    
                        IF($area === 'MIRANDES HD y RH' || $area === 'MIRANDES CLINICA ' || $area === 'MIRANDES HD CONCEPCION' || $area === 'MIRANDES HD RANCAGUA' ){

                                    $resumen .= "<img style='width: 20%; ' src='".base_url()."../assets/img/mirAndes.png' >";
                        }ELSE {
                                    $resumen .= "<img style='width: 20%; ' src='".base_url()."../assets/img/logo_vertical_cetep.png' >";
                        }
         $resumen .="
                </td>
                <td style='width:50px'></td>
                <td style='width:100px'></td>
            </tr>
            <tr>
                <td>Fecha</td>
                <td>".$fecha."</td>
            </tr>
        </table>
        
        <table style='width:800px; border:none'>
            <tr>
                <td colspan='2' style='border:none'>De nuestra consideración:</td>
                <td style='border:none'></td>
                <td colspan='2' style='border:none'></td>
            </tr>
            <tr>
                <td style='width:100px;border:none'>Estimado(a)</td>
                <td style='width:300px;border:none'>".$nombre."</td>
                <td style='border:none'></td>
                <td style='width:100px;border:none'></td>
                <td style='width:300px;border:none'></td>
            </tr>
            
            
            <tr>
                <td style='border:none'>Domicilio:</td>
                <td style='border:none'>".$domicilio.", ".$comuna."</td>
                <td style='border:none'></td>
                <td style='border:none'></td>
                <td style='border:none'></td>
            </tr>
           
            <tr>
                <td style='border:none' colspan='5'><br></td>
            </tr>
            
            
            <tr>
                <td colspan='5' style='border:none' align='justify' >En respuesta a su reclamo N° <b>".$reclamo->recId."</b> con fecha ".$fechaReclamo.", donde menciona: <br><br> <i><blockquote><textarea style='border:none; width:100%; height:".$respuestaHechoLargo."px'>".$respuestaHecho."</textarea></blockquote></i><br></td>
            </tr>
            <tr>
                <td colspan='5' style='border:none' align='justify' ><br>Lamentamos los inconvenientes que estos hechos pudieran haberle ocasionado y sentimos muy sinceramente el no haber respondido a sus expectativas, su reclamo ha sido registrado y revisado.<br><br></td>
            </tr>
            <tr>
                <td colspan='5' style='border:none'  align='justify' >Habiendo revisado su caso, podemos informar que: <br><br> <i><blockquote><textarea style='border:none; width:100%; height:".$respuestaRespuestaLargo."px'>".$respuestaRespuesta."</textarea></blockquote></i></td>
            </tr>
            <tr>
                <td colspan='5' style='border:none' align='justify' ><br>Agradecemos el que nos haya hecho llegar sus observaciones, esto nos permite poder seguir mejorando en nuestra calidad y servicio a nuestros clientes</td>
            </tr>
            <tr>
                <td colspan='5' style='border:none;' align='justify' ><br><b>De conformidad a lo señalado en el reglamento del MINSAL sobre procedimientos de reclamo de la ley N°20.584, le informamos su facultad para recurrir ante la Superintendencia de Salud para presentar su reclamo.</b></td>
            </tr>
            
            <tr>
                <td colspan='5' style='border:none;' ><blockquote>
                <br><br>_____________________<br>
                ".$directorNombre."<br>Director Médico<br>".$area."
                 </blockquote></td>
            </tr>
        </table>
        <br>
        ";

        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; 
        $headers .= "From: Calidad <calidad@cetep.cl>\r\n"; //dirección del remitente 
        //$headers .= "CCO: calidad@cetep.cl,".$unidad->mail;
        //$headers .= "CC: griedel@cetep.cl,".$unidad->mail;
        $headers .= "CC: griedel@cetep.cl";
        IF(!empty($email))$destinatario = $email; ELSE $destinatario = '';
        $destinatario = 'gerardo.riedel.c@gmail.com';
        $asunto = 'Resolución Reclamo';
    mail($destinatario,$asunto,$resumen,$headers) ;
    //$data = array('recId' => $id);$this->session->set_userdata($data);	
    //echo $resumen;die;
    //$this->load->view('panel/modals/guardar_exitoso');
    }
    
}
