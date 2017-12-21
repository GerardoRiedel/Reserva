<?php

class DB_Helper
{
    /**
     * Agrega la condicion 'where' de acuerdo con el objecto relleno
     * @version 1.0.0
     * @author Gerardo Riedel <gerardo.riedel.c@gmail.com>
     * @param &$obj object Objeto de la clase
     * @return void
     */
    static function filtrar(&$obj){
        foreach($obj as $property => $value) {
            if($value !== NULL){
                if(is_array($value))
                {
                    if($value["type"] = "between")
                    {
                        $obj->db->where("$property >=", $value["values"][0]);
                        $obj->db->where("$property <=", $value["values"][1]);
                    }
                }
                else
                    $obj->db->where($property,$value);
            }
        }
    }
}