<?php

/**
 * Created by Netbeans.
 * User: Gerardo Riedel
 * Date: 21/09/2016
 * Time: 14:00
 */
class Session extends CI_Controller
{
    function __construct(){
        parent::__construct();
        
        //$this->load->helper('validacion');
    }

    
    public function inicio(){
        
        $this->load->model('usuarios_panel_log_model');
        $user = $this->session->userdata('id_usuario');
        IF(!empty($user)){
            $fecha = date('Y-m-d H:i:s',strtotime ( '-60 minutes' ));
            $ahora = date('Y-m-d H:i:s');
            $row = $this->usuarios_panel_log_model->dameUltimoLogin($user);
            IF($fecha > $row){
                echo json_encode('NO');
            }
            ELSE {
                
                $fecha = date('Y-m-d H:i:s',strtotime ( '-56 minutes' ));
                $ahora = date('Y-m-d H:i:s');
                $row = $this->usuarios_panel_log_model->dameUltimoLogin($user);
                IF($fecha > $row){
                    echo json_encode('POR');
                }
                ELSE {
                    echo json_encode('OK');
                }
            }
            
        }
        ELSE {echo json_encode('NO');}
    }
    public function inicioIngreso(){
        
        $this->load->model('usuarios_panel_log_model');
        $user = $this->session->userdata('id_usuario');
        IF(!empty($user)){
            $fecha = date('Y-m-d H:i:s',strtotime ( '-60 minutes' ));
            $ahora = date('Y-m-d H:i:s');
            $row = $this->usuarios_panel_log_model->dameUltimoLogin($user);
            IF($fecha > $row){
                echo json_encode('NO');
            }
            ELSE {
                
                $data = array(
                            'reloj' => date('Y-m-d H:i:s',strtotime ( '+60 minutes' )),
                            );
                $this->session->set_userdata($data);
                
                $this->usuarios_panel_log_model->uplFecha = date('Y-m-d H:i:s');
                $this->usuarios_panel_log_model->uplUsuario = $user;
                $this->usuarios_panel_log_model->uplDescripcion = "Acceso a panel de control";
                $this->usuarios_panel_log_model->guardarLog();
                
                echo json_encode('OK');
            }
            
        }
        ELSE {echo json_encode('NO');}
    }
}

