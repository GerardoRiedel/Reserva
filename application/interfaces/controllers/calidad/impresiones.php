<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Impresiones extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('download', 'file', 'url', 'html', 'form'));
        $this->load->helper('layout');
        $this->load->database('default');
        $this->folder = 'uploads/';
        
        $this->load->model("sugerencia_model");
        $this->load->model("reclamo_model");
        $this->load->model("comunas_model");
        $this->load->model("parametros_model");
    }
    
    public function imprimirSugerencia($id)
    {
        $data['sugerencia'] = $this->sugerencia_model->dameUno($id);
        $data['title']      = "";
        Layout_Helper::cargaVista($this,'imprimirSugerencia',$data,'ingresos');   
    }
    public function imprimirReclamo($id)
    {
        $datos = $this->reclamo_model->dameUno($id);
        $data['reclamo'] = $datos[0];
        $data['unidad']   = $datos[1];
        $data['title']      = "";
        Layout_Helper::cargaVista($this,'imprimirReclamo',$data,'ingresos');   
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
