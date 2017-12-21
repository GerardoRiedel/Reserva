<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('login_model','usuarios_panel_log_model','parametros_model'));
        $this->load->library(array('session','form_validation'));
        $this->load->helper(array('url','form','security','layout'));
    }
	
        public function index()
        { 
            //$this->session->sess_destroy();
            //$data = array('is_logged_in'     =>  FALSE);
            //$this->session->set_userdata($data);	
           //die($this->session->userdata('is_logged_in'));
           //die($_GET['var']);
            //die($this->session->userdata('acceso_ok') );
                if($this->session->userdata('acceso_ok') === 'OK' ){
            echo $this->session->userdata('acceso_ok') ; echo $this->session->userdata('perfil'); 
//die('aca');
                    $agente = $_SERVER['HTTP_USER_AGENT'];
                  //echo $agente; echo '<br>';
                  // $agente = preg_match('/Chrome/i',$agente);
                  //die($agente.'s');
                   if(preg_match('/Chrome/i',$agente)){
                    $nav = "Chrome";}
                    else {$nav = "";}
                    $alert = "alert('Su navegador no se encuentra optimizado, algunas funcionalidades podrian no estar disponibles. Le recomendamos utilizar Google Chrome.');";

                    //Guarda Log
                    $this->usuarios_panel_log_model->uplFecha    = date('Y-m-d H:i:s');
                    $this->usuarios_panel_log_model->uplPerfil      = $this->session->userdata('perfil');
                    $this->usuarios_panel_log_model->uplUsuario = $this->session->userdata('id_usuario');
                    $this->usuarios_panel_log_model->uplDescripcion = "Acceso a panel de control";
                    $this->usuarios_panel_log_model->guardarLog();

                    if($this->session->userdata('perfil') == '1'){
                        IF($nav != 'Chrome'){
                        echo "<script>".$alert."window.location.href='".base_url()."calidad/planilla/noConforme';</script>";}
                        ELSE {redirect(base_url().'calidad/planilla/noConforme');}
                    }
                    elseif($this->session->userdata('perfil') == '2'){
                        //IF($nav != 'Chrome'){
                        //echo "<script>".$alert."window.location.href='".base_url()."calidad/sugerencia/felicitacion';</script>";}
                        //ELSE {
                            redirect(base_url().'calidad/sugerencia/felicitacion');
                            
                        //}
                    }
                    elseif($this->session->userdata('perfil') == '3'){
                        IF($nav != 'Chrome'){
                        echo "<script>".$alert."window.location.href='".base_url()."calidad/gestion';</script>";}
                        ELSE {redirect(base_url().'calidad/gestion');}
                    }
                    else{
                        echo "<script>alert('Usuario o password mal ingresados.');</script>";
                    }

                }elseif(!empty($_GET['var'])){//die('var vacia');
                    $this->nuevo($_GET['var']);
                }else{//die('ultimo');
                    $this->visita();
                }
        }
        
        public function visita()
        {
                //die('visita');
                $data = array(
                                    'acceso_ok'     =>  'OK',
                                    'id_usuario'         =>  10,
                                    'perfil'                    =>  '2',
                                    'reloj'                     =>  date('Y-m-d H:i:s',strtotime ( '+60 minutes' )),
                                );	
                $this->session->set_userdata($data);	
                $this->index();
        }
        
        public function nuevo($id)
        {
            die('nuevo');
                $colaborador = $this->parametros_model->dameColaborador($id);
                IF(!empty($colaborador->idunidad)){
                            IF($id === '57' || $id === '64' || $id === '285' || $id === '38'){
                                $data = array(
                                                    'acceso_ok'     =>  'OK',
                                                    'id_usuario'         =>  $id,
                                                    'perfil'                    =>  '3',
                                                    'reloj'                     =>  date('Y-m-d H:i:s',strtotime ( '+60 minutes' )),
                                                    );	
                            } ELSE {
                                $data = array(
                                                    'acceso_ok'     =>  'OK',
                                                    'id_usuario'         =>  $id,
                                                    'perfil'                    =>  '1',
                                                    'reloj'                     =>  date('Y-m-d H:i:s',strtotime ( '+60 minutes' )),
                                                    );	
                            }
                            $this->session->set_userdata($data);
                            $this->index();
                }ELSE{
                    $this->visita();
                }
            
        }
        
        public function salir()
        {
                $this->session->sess_destroy();
                //$data = array('is_logged_in'     =>  FALSE);
                //$this->session->set_userdata($data);	
                //header('location: http://localhost/calidad');
                header('location: http://www.cetep.cl');
        }
         public function salirIntranet()
        {
                $data = array('acceso_ok'     =>  '');
                $this->session->set_userdata($data);	
                header('location: http://www.cetep.cl/intracetep');
        }
        
        
        
        
        
        
        
        
        
        
        
        
 
	public function new_user()
	{
            
		if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token'))
		{
                                        $this->form_validation->set_rules('username', 'E-mail', 'required|trim|min_length[2]|max_length[150]');
                                        $this->form_validation->set_rules('password', 'Contraseña', 'required|trim|min_length[5]|max_length[150]');

			if($this->form_validation->run() === false)
			{   
                                                                echo "<script>alert('Usuario o password mal ingresados.');
                                                                window.location.href='".base_url()."';</script>";
                                
			}elseif($this->form_validation->run() === true){
				$username = $this->input->post('username',TRUE);
                                                                           $username = str_replace('-', '', $username);
				$password = md5($this->input->post('password',TRUE));
				$check_user = $this->login_model->loginUsuario($username,$password);
				
				if($check_user == TRUE)
				{

                                                                                    $data = array(
                                                                                        'is_logged_in'     =>  TRUE,
                                                                                        'id_usuario'         =>  $check_user->uspId,
                                                                                        'perfil'                    =>  $check_user->uspPerfil,
                                                                                        'username'          =>  $check_user->uspEmail,
                                                                                        'rut'                         =>  $check_user->uspRut,
                                                                                        'nombre_completo'   =>  $check_user->uspNombre." ".$check_user->uspApellidoP,
                                                                                        'reloj'                     =>  date('Y-m-d H:i:s',strtotime ( '+60 minutes' )),
                                                                                    );	

                                                                                $this->session->set_userdata($data);	

                                                                                //Guarda Log
                                                                                $this->usuarios_panel_log_model->uplFecha = date('Y-m-d H:i:s');
                                                                                $this->usuarios_panel_log_model->uplUsuario = $check_user->uspId;
                                                                                $this->usuarios_panel_log_model->uplDescripcion = "Acceso a panel de control";
                                                                                $this->usuarios_panel_log_model->guardarLog();

                                                                                $this->index();

				} 
                                else {
                                    
                                    echo "<script>alert('Usuario o password mal ingresados.');
                                    window.location.href='".base_url()."';</script>";
                                    
                                    //echo "<script>window.location.href='".base_url()."';</script>";
                                    //redirect(base_url());
                                }
			}else die('aca');
                        
		}else{
			echo "<script>
                            window.location.href='".base_url()."';</script>";
		}
	}
	
	public function token()
	{
		$token = md5(uniqid(rand(),true));
		$this->session->set_userdata('token',$token);
		return $token;
	}
	
	
    
    
    public function forget()
	{
		if (isset($_GET['info'])) {
               $data['info'] = $_GET['info'];
              }
		if (isset($_GET['error'])) {
              $data['error'] = $_GET['error'];
              }
		$data['token'] = $this->token();
                $data['recuperar'] = 1;
		$data['titulo'] = 'Login con roles de usuario en codeigniter';
		$this->load->view('login_view',$data);
	} 
    public function doforget()
	{
                $data['recuperar'] = 1;
		$email= $_POST['email'];
		$q = $this->login_model->enviarEmail($email);
                
		if (!empty($q->uspEmail)) {
                    $this->reiniciaClave($q);
                    $info= "Se ha reseteado la contraseña, y ha sido enviada a: ". $email;
                    $data['info'] = $info;
                    $this->load->view('login_view',$data);
                }
                else {
                    $error = "El email ingresado no se encuentra registrado.";
                    $data['info'] = $error;
                    $this->load->view('login_view',$data);
                }
		
	} 
    private function reiniciaClave($user)
	{
		$password= random_string('alnum', 6);
                //echo $password;
                $this->login_model->uspId = $user->uspId;
                $this->login_model->uspPassword = MD5($password);
                $this->login_model->guardar();
                
                
                $config = array(
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		); 
 
		//cargamos la configuración para enviar
		
                
		$this->load->library('email');
                $this->email->initialize($config);
		$this->email->from('cetep@cetep.cl', 'Cetep');
		$this->email->to($user->uspEmail);
                $this->email->bcc('dti@cetep.cl');  	
		$this->email->subject('Reseteo de Contraseña');
		$this->email->message('Usted ha solicitado una nueva contraseña de ingreso para el usuario <b>"'.$user->uspUsuario.'"</b>, al panel de control de la Clínica MirAndes.<br>La nueva contraseña de acceso es: '.$password.'<br><br>Atentamente,<br>Equipo DTI');	
		$this->email->send();
        //echo $this->email->print_debugger();
	} 
	
	

	
	
}



?>