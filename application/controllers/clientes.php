<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clientes
 *
 * @author JuvenaL
 */
class clientes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Crud');
    }

    public function insertarCliente() {

        $rut = $this->input->post('rut');
        $nombre = $this->input->post('nombre');
        $apellido_pat = $this->input->post('apellido_pat');
        $apellido_mat = $this->input->post('apellido_mat');
        $direccion = $this->input->post('direccion');
        $ciudad = $this->input->post('ciudad');
        $telefono = $this->input->post('telefono');
        $giro = $this->input->post('giro');


        if (isset($rut) && isset($nombre) && isset($ciudad)) {    

            $rut = str_replace(' ', '', $rut);            
            $sub = str_replace('.', '', $rut);          
            
            
            $this->Crud->insertarCliente($sub, $nombre, $apellido_pat, $apellido_mat, $direccion, $ciudad, $telefono, $giro);
            echo json_encode(array('value' => 'Cliente agregado con exito'));
        } else {
            echo json_encode(array('value' => 'Error de datos'));
        }
    }

    public function editarCliente() {

        $idproveedor = $this->input->post('idcliente');
        $rut = $this->input->post('rut');
        $nombre = $this->input->post('nombre');
        $apellido_pat = $this->input->post('apellido_pat');
        $apellido_mat = $this->input->post('apellido_mat');
        $direccion = $this->input->post('direccion');
        $ciudad = $this->input->post('ciudad');
        $telefono = $this->input->post('telefono');
        $giro = $this->input->post('giro');

        if (isset($idproveedor)) {
            $this->Crud->editarCliente($idproveedor, $rut, $nombre, $apellido_pat, $apellido_mat, $direccion, $ciudad, $telefono, $giro);
            $value = "Cliente actualizado";
        } else {
            $value = "Error de parametros";
        }

        echo json_encode(array('value' => $value));
    }

    public function clientesList() {

        $clientes = $this->Crud->clientesList();
        $activos = [];
        if (count($clientes) > 0) {
            foreach ($clientes as $c) {
                if ($c->activo == 'si') {
                    array_push($activos, $c);
                }
            }
        }

        echo json_encode(array('value' => $activos));
    }

    public function contarClientes() {
        $res = $this->Crud->contarProveedores();
        echo json_encode(array('value' => $res));
    }

    public function eliminarCliente() {
        $idcliente = $this->input->post('idcliente');
        if (isset($idcliente)) {
            $this->Crud->eliminarCliente($idcliente);
            echo json_encode(array('value' => 'Cliente eliminado'));
        } else {
            echo json_encode(array('value' => 'Error de datos'));
        }
    }

}
