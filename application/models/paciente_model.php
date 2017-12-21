<?php

/**
 * Created by Netbeans.
 * User: Gerardo Riedel
 * Date: 22/06/17
 * Time: 09:22
 */
class Paciente_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database('default');
    }
    
     public function guardar()
    {
        if(isset($this->id))
            $this->db->update('paciente', $this, array('id' => $this->id));
        else
            $this->db->insert('paciente', $this);
    }
    
    public function dameUno($rut)
    {
        return $this->db->select('*')
                        ->from('paciente')
                        ->where('rut',$rut)
                        ->order_by('id','desc')
                        ->get()
                        ->row();
    }
    
}