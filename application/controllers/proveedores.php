<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of proveedores
 *
 * @author JuvenaL
 */
class proveedores extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Crud');
    }

    public function insertarProveedor() {

        $rut = $this->input->post('rut');
        $nombre = $this->input->post('nombre');
        $apellido_pat = $this->input->post('apellido_pat');
        $apellido_mat = $this->input->post('apellido_mat');
        $empresa = $this->input->post('empresa');
        $direccion = $this->input->post('direccion');
        $ciudad = $this->input->post('ciudad');
        $rut_empresa = $this->input->post('rut_empresa');
        $telefono1 = $this->input->post('telefono1');
        $telefono2 = $this->input->post('telefono2');
        $giro = $this->input->post('giro');

        if (isset($rut) && isset($nombre) && isset($ciudad)) {

            $rut = str_replace(' ', '', $rut);
            $sub = str_replace('.', '', $rut);

            $this->Crud->insertarProveedor($sub, $nombre, $apellido_pat, $apellido_mat, $empresa, $direccion, $ciudad, $rut_empresa, $telefono1, $telefono2, $giro);
            echo json_encode(array('value' => 'Proveedor agregado con exito'));
        } else {
            echo json_encode(array('value' => 'Error de datos'));
        }
    }

    public function editarProveedor() {

        $idproveedor = $this->input->post('idproveedor');
        $rut = $this->input->post('rut');
        $nombre = $this->input->post('nombre');
        $apellido_pat = $this->input->post('apellido_pat');
        $apellido_mat = $this->input->post('apellido_mat');
        $empresa = $this->input->post('empresa');
        $direccion = $this->input->post('direccion');
        $ciudad = $this->input->post('ciudad');
        $rut_empresa = $this->input->post('rut_empresa');
        $telefono1 = $this->input->post('telefono1');
        $telefono2 = $this->input->post('telefono2');
        $giro = $this->input->post('giro');

        if (isset($idproveedor)) {
            $this->Crud->editarProveedor($idproveedor, $rut, $nombre, $apellido_pat, $apellido_mat, $empresa, $direccion, $ciudad, $rut_empresa, $telefono1, $telefono2, $giro);
            $value = "Proveedor actualizado";
        } else {
            $value = "Error de parametros";
        }

        echo json_encode(array('value' => $value));
    }

    public function proveedoresList() {

        $proveedor = $this->Crud->proveedoresList();
        $nuevoP = [];
        foreach ($proveedor as $p) {
            if ($p->activo == 'si') {
                array_push($nuevoP, $p);
            }
        }
        echo json_encode(array('value' => $nuevoP));
    }

    public function contarProveedores() {
        $res = $this->Crud->contarProveedores();
        echo json_encode(array('value' => $res));
    }

    public function eliminarProveedor() {
        $idproveedor = $this->input->post('idproveedor');
        if (isset($idproveedor)) {
            $proveedor = $this->Crud->eliminarProveedores($idproveedor);

            echo json_encode(array('value' => 'Proveedor eliminado'));
        } else {
            echo json_encode(array('value' => 'Error de datos'));
        }
    }

}
