<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuarios
 *
 * @author JuvenaL
 */
class usuarios extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Crud');
    }
    
     public function usuariosList() {
        echo json_encode($this->Crud->usuarios());
    }
    
    public function eliminarUsuario(){        
        $id = $this->input->post('id');        
        if (isset($id)) {
            $this->Crud->eliminarUsuario($id);
            $res = 'Usuario Eliminado';
        }else{
            $res = 'Error de datos';
        }        
        echo json_encode(array('value' => $res));
        
    }
    
}
