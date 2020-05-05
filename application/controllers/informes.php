<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ventas
 *
 * @author JuvenaL
 */
class informes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Crud');
    }

    public function contarVentas() {
        echo json_encode($this->Crud->contarVentas());
    }

    public function contarStock() {
        echo json_encode($this->Crud->contarStock());
    }

    public function getFechaAnual() {

        $ano = $this->input->post('fecha');
        $fechas = $this->Crud->getFechaAnual($ano);
        $cont = $this->Crud->getFechaAnualContar($ano);


        $producto = $this->Crud->detalleVentaProductoAno($ano);


        echo json_encode(array('value' => $fechas,
            'count' => $cont,
            'detalle' => $producto));
    }

    public function getMes() {

        $mes = $this->input->post('mes');
        $ano = strftime("%Y", time());

        if (isset($mes)) {
            $meses = $this->Crud->getMes($ano, $mes);
            $cont = $this->Crud->getMesContar($ano, $mes);
            $res = $meses;

            $producto = $this->Crud->detalleVentaProductoMes($ano, $mes);
        } else {
            $res = 'Error de datos';
        }

        echo json_encode(array('value' => $res,
            'count' => $cont,
            'detalle' => $producto));
    }

    public function getDia() {

        $dia = $this->input->post('dia');
        $ano = strftime("%Y", time());
        $mes = strftime("%m", time());

        if (isset($dia)) {
            $meses = $this->Crud->getDia($ano, $mes, $dia);
            $contar = $this->Crud->contarVentasDia($ano, $mes, $dia);
            $res = $meses;

            $producto = $this->Crud->detalleVentaProducto($ano, $mes, $dia);
        } else {
            $res = 'Error de datos';
        }
        echo json_encode(array('value' => $meses,
            'count' => $contar,
            'detalle' => $producto));
    }

    public function getFecha() {
        
        $fecha1 = $this->input->post('fecha1');
        $fecha2 = $this->input->post('fecha2');

        if (isset($fecha1) && isset($fecha2)) {
            list($ano1, $mes1, $dia1) = explode('-', $fecha1);
            list($ano2, $mes2, $dia2) = explode('-', $fecha2);

            $res = $this->Crud->getFecha($ano1, $mes1, $dia1, $ano2, $mes2, $dia2);
            $contar = $this->Crud->getFechaContar($ano1, $mes1, $dia1, $ano2, $mes2, $dia2);

            $producto = $this->Crud->detalleVentaProductoFecha($ano1, $mes1, $dia1, $ano2, $mes2, $dia2);
        }



        echo json_encode(array('value' => $res,
            'count' => $contar,
            'detalle' => $producto));
    }

    public function getProductosMes() {

        $mes = $this->input->post('mes');
        $idproducto = $this->input->post('idproducto');
        $ano = strftime("%Y", time());

        $producto = [];
        $productoMes = [];
        if (isset($mes) && isset($idproducto)) {
            $productoMes = $this->Crud->getProductosMes($ano, $mes, $idproducto);
            $producto = $this->Crud->obtenerProducto($idproducto);
            $res = 'Datos obtenidos';
        } else {
            $res = 'Error de datos';
        }

        echo json_encode(array('value' => $res,
            'productomes' => $productoMes,
            'producto' => $producto));
    }

    public function getProductosDia() {

        $idproducto = $this->input->post('idproducto');
        $dia = $this->input->post('dia');

        $mes = strftime("%m", time());
        $ano = strftime("%Y", time());

        $producto = [];
        $productoMes = [];
        if (isset($mes) && isset($idproducto)) {
            $productoMes = $this->Crud->getProductosDias($ano, $mes, $dia, $idproducto);
            $producto = $this->Crud->obtenerProducto($idproducto);
            $res = 'Datos obtenidos';
        } else {
            $res = 'Error de datos';
        }

        echo json_encode(array('value' => $res,
            'productomes' => $productoMes,
            'producto' => $producto));
    }

    public function buscarVentaId() {
        $idventa = $this->input->post('idventa');

        if (isset($idventa)) {
            $venta = $this->Crud->buscarVenta($idventa);
            $detalle_venta = $this->Crud->buscarVentaUser($venta[0]->idventa);
        } else {
            $res = 'Error de datos';
        }

        echo json_encode(array('value' => $venta,
            'detalle' => $detalle_venta));
    }

    public function buscarFacturaId() {
        $idfactura = $this->input->post('idfactura');

        if (isset($idfactura)) {
            
            $facturaID = $this->Crud->getFacturaId($idfactura);
            $factura = $this->Crud->buscarFacturaId($idfactura);
            $detalle = $this->Crud->buscarFacturaDetalleId($factura[0]->idfactura);
        } else {
            $res = 'Error de datos';
        }

        echo json_encode(array('value' => $factura,
            'detalle' => $detalle));
    }

    public function guiaMes() {

        $mes = $this->input->post('mes');
        $ano = strftime("%Y", time());
        $res = '';
        if (isset($mes)) {
            $guiasMes = $this->Crud->getMesGuia($ano, $mes);
            $res = $guiasMes;
        } else {
            $res = 'Error de datos';
        }
        echo json_encode(array('value' => $res));
    }

    public function guiaMesRut() {

        $mes = $this->input->post('mes');
        $idcliente = $this->input->post('idcliente');
        $ano = strftime("%Y", time());
        $res = '';
        if (isset($mes)) {
            $guiasMes = $this->Crud->getMesGuiaRut($ano, $mes, $idcliente);
            $res = $guiasMes;
        } else {
            $res = 'Error de datos';
        }
        echo json_encode(array('value' => $res));
    }

    public function guiaDia() {

        $dia = $this->input->post('dia');
        $mes = strftime("%m", time());
        $ano = strftime("%Y", time());
        $res = '';
        if (isset($dia)) {
            $guiasDia = $this->Crud->getDiaGuia($ano, $mes, $dia);
            $res = $guiasDia;
        } else {
            $res = 'Error de datos';
        }
        echo json_encode(array('value' => $res));
    }

    public function guiaDiaRut() {
        $dia = $this->input->post('dia');
        $idcliente = $this->input->post('idcliente');
        $mes = strftime("%m", time());
        $ano = strftime("%Y", time());
        $res = '';
        if (isset($dia)) {
            $guiasDia = $this->Crud->getDiaGuiaRut($ano, $mes, $dia, $idcliente);
            $res = $guiasDia;
        } else {
            $res = 'Error de datos';
        }
        echo json_encode(array('value' => $res));
    }
    
       public function guiaFecha() {
        
        $fecha1 = $this->input->post('fecha1');
        $fecha2 = $this->input->post('fecha2');

        if (isset($fecha1) && isset($fecha2)) {
            list($ano1, $mes1, $dia1) = explode('-', $fecha1);
            list($ano2, $mes2, $dia2) = explode('-', $fecha2);

            $res = $this->Crud->getGuiaFecha($ano1, $mes1, $dia1, $ano2, $mes2, $dia2);
            $contar = $this->Crud->getFechaContar($ano1, $mes1, $dia1, $ano2, $mes2, $dia2);

            $producto = $this->Crud->detalleVentaProductoFecha($ano1, $mes1, $dia1, $ano2, $mes2, $dia2);
        }else{
            $res = 'error de datos';
        }

        echo json_encode(array('value' => $res,
            'count' => $contar,
            'detalle' => $producto
                ));
    }
    
           public function guiaFechaRut() {
        $idcliente = $this->input->post('idcliente');
        $fecha1 = $this->input->post('fecha1');
        $fecha2 = $this->input->post('fecha2');

        if (isset($fecha1) && isset($fecha2)) {
            list($ano1, $mes1, $dia1) = explode('-', $fecha1);
            list($ano2, $mes2, $dia2) = explode('-', $fecha2);

            $res = $this->Crud->getGuiaFechaRut($ano1, $mes1, $dia1, $ano2, $mes2, $dia2, $idcliente);

         
            
        }else{
            $res = 'error de datos';
        }

        echo json_encode(array('value' => $res
//            'count' => $contar,
//            'detalle' => $producto
                ));
    }
    
    public function obtenerGuia (){
        
        $idguia = $this->input->post('idguia');
        
        if (isset($idguia)) {
            $guia = $this->Crud->buscarVentasGuia($idguia);
            $res = $guia[0];
        }else{
            $res = 'Error de datos';
        }
        echo json_encode(array('value' => $res));
    }

}
