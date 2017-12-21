<?php
/**
 * Created by Netbeans.
 * User: Gerardo Riedel
 * Date: 20-09-2016
 * Time: 16:44
 */

class Usuarios_Panel_Log_model extends CI_Model{

    function __construct()
    {
        $this->load->helper('db');
        $this->load->database('default');
    }

    public function dameTodo()
    {
        return $this->db->select('uspId, uspNombre, uspApellidoP, uspApellidoM, uspPerfil, uspEstado, uspRut, uspEmail, uspPassword, uspUsuario')
                        ->from('usuarios_panel')
                        ->where('uspEstado >=',1)
                        ->where('uspPerfil <',11)
                        ->get()
                        ->result();
    }
    public function dameTodoHD()
    {
        return $this->db->select('uspId, uspNombre, uspApellidoP, uspApellidoM, uspPerfil, uspEstado, uspRut, uspEmail, uspPassword, uspUsuario')
                        ->from('usuarios_panel')
                        ->where('uspEstado >=',1)
                        ->where('uspPerfil >=',11)
                        ->get()
                        ->result();
    }
    public function dameUno($id)
    {
        return $this->db->select('uspId, uspNombre, uspApellidoP, uspApellidoM, uspPerfil, uspEstado, uspRut, uspEmail, uspPassword, uspUsuario')
                        ->from('usuarios_panel')
                        ->where('uspId',$id)
                        ->get()
                        ->row();
    }
    public function dameUnoExiste()
    {
        DB_Helper::filtrar($this);
        return $this->db->select('uspId')
                        ->from('usuarios_panel')
                        ->get()
                        ->row();
    }
    
    public function dameTodos()
    {
        DB_Helper::filtrar($this);
        return $this->db->select('uplId, uplFecha, uplDescripcion, uplUsuario')
                        ->from('usuarios_panel_log')
                        ->get()
                        ->result();
    }

    public function dameUltimoLoginUsuario($usuario)
    {
        $row = $this->db->select('max(uplFecha) fecha')
                        ->from('usuarios_panel_log')
                        ->where('uplDescripcion',LogsInterface::LOGIN_PANEL)
                        ->where('uplUsuario',$usuario)
                        ->get()
                        ->row();
        return $row->fecha;
        //return !empty($row->fecha) ? (new DateTime($row->fecha))->format('d/m/Y \a \l\a\s H:i')  : null;
    }
    
    public function dameUltimoLogin($usuario)
    {
        $row = $this->db->select('max(uplFecha) fecha')
                        ->from('usuarios_panel_log')
                        ->where('uplDescripcion','Acceso a panel de control')
                        ->where('uplUsuario',$usuario)
                        ->get()
                        ->row();
        return $row->fecha;
        //return !empty($row->fecha) ? (new DateTime($row->fecha))->format('d/m/Y \a \l\a\s H:i')  : null;
    }

    public function guardar()
    {
        if(isset($this->uspId)){
        $this->db->update('usuarios_panel', $this, array('uspId' => $this->uspId));}
        else{
        $this->db->insert('usuarios_panel', $this);}
    }
    public function guardarLog()
    {
        if(isset($this->uplId)){
        $this->db->update('usuarios_panel_log', $this, array('uplId' => $this->uplId));}
        else{
        $this->db->insert('usuarios_panel_log', $this);}
    }
}