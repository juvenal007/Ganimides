<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of compras
 *
 * @author JuvenaL
 */
class compras extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Crud');
    }

    public function insertarFactura() {

        $codigo = $this->input->post('codigo');
        $iva = $this->input->post('iva');
        $iva_adicional = $this->input->post('iva_adicional');
        $total = $this->input->post('total');
        $neto = $this->input->post('neto');
        $proveedor_idproveedor = $this->input->post('proveedor_idproveedor');
        $usuario_idusuario = $this->input->post('usuario_idusuario');
        $productos = $this->input->post('productos');
        $cantidad = $this->input->post('cantidad');
        $factura = '';
        if (isset($codigo) && isset($iva)) {
            $this->Crud->insertarFactura($codigo, $iva, $iva_adicional, $total, $neto, $proveedor_idproveedor, $usuario_idusuario);
            $factura = $this->Crud->buscarFactura($codigo);
            if (count($factura) > 0) {
                $id = $factura[0]->idfactura;

                $productosArr = explode('-', $productos); // HACEMOS UN SPLIT AL ARRAY {1-2-3-} --> {"1","2","3"," "}
                array_pop($productosArr); //BORRAMOS EL ULTIMO ELEMENTO DE LA FACTURA {"1","2","3"," "} ->{"1","2","3"}
                $largo = sizeof($productosArr); // BUSCAMOS EL TAMAÑO DEL ARREGLO, DEVUELVE 3;

                $cantidadArr = explode('-', $cantidad);
                array_pop($cantidadArr);

                for ($i = 0; $i < $largo; $i++) {
                    $this->Crud->insertarProductoFactura($id, $productosArr[$i], $codigo, $cantidadArr[$i]);
                    $producto = $this->Crud->obtenerProducto($productosArr[$i]);
                    $stockProducto = $producto[0]->stock;
                    $nuevoStock = (int) $stockProducto + $cantidadArr[$i];
                    $this->Crud->agregarStock($productosArr[$i], $nuevoStock);
                }
                $res = 'Factura ingresada con exito';
            }
        } else {
            $res = 'Error de datos';
        }

        echo json_encode(array('value' => $res));
    }

    public function listaFactura() {
        $res = $this->Crud->facturaList();
        echo json_encode(array('value' => $res));
    }

    public function detallesFactura() {
        $idfactura = $this->input->post('idfactura');
        if (isset($idfactura)) {
            $res = $this->Crud->detallesFactura($idfactura);
        } else {
            $res = 'Error de datos';
        }
        echo json_encode(array('value' => $res));
    }

    public function eliminarFactura() {
        $idfactura = $this->input->post('idfactura');

        if (isset($idfactura)) {
            $this->Crud->eliminarFactura($idfactura);
        } else {
            $res = 'error de datos';
        }

        echo json_encode(array('value' => $res));
    }

    public function buscarProveedorRut() {

        $rut = $this->input->post('rut');

        if (isset($rut)) {

            $rut = str_replace(' ', '', $rut);
            $sub = str_replace('.', '', $rut);
            $res = $this->Crud->buscarProveedorRut($sub);
        } else {
            $res = 'Error de datos';
        }

        echo json_encode(array('value' => $res[0]));
    }
    public function obtenerProducto(){
        
        $idprod = $this->input->post('idprod');
        
        if (isset($idprod)) {
            $producto = $this->Crud->obtenerProducto($idprod);
            $res = $producto[0];
        }else{
            $res = 'Error de datos';
        }
        
       echo json_encode(array('value' => $res));
        
        
    }

}
