<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('login_model','usuarios_panel_log_model'));
        $this->load->library(array('session','form_validation'));
        $this->load->helper(array('url','form','security','layout'));
    }
    public function index()
    { 
       redirect(base_url().'reserva/reserva/inicio');
    }
}



?>