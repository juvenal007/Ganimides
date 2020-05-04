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
class ventas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Crud');
    }

    public function insertarVentaBoleta() {

        $codigoBoletaBuscar = $this->input->post('codigoBoletaBuscar');
        $total = $this->input->post('total');
        $descuento = $this->input->post('descuento');
        $idusuario = $this->input->post('usuario_idusuario');
        $productosAgregados = $this->input->post('productosAgregados');
        $cantidad = $this->input->post('cantidad');
        $idventa = '';
        $codigoGuia = $this->input->post('codigoGuia');
        $idcliente = $this->input->post('idcliente');
        $descripcion = $this->input->post('descripcion');

        $venta = $this->Crud->buscarVentasBoleta($codigoBoletaBuscar);

        $tipo = 'Boleta';

        if (count($venta) > 0) {
            if ($venta[0]->estado != 'ANULADA') {
                $res = 'Debe Anular Boleta';
            } else {
                if (isset($total) && isset($idusuario) && isset($productosAgregados)) {

                    $this->Crud->insertarVentaBoleta($total, $descuento, $idusuario, $tipo, $descripcion);
                    $ventaBoleta = $this->Crud->ultimaVentaBoleta();
                    if (count($ventaBoleta) > 0) {
                        $idventa = $ventaBoleta[0]->idventa;
                        $productosArr = explode('-', $productosAgregados); // HACEMOS UN SPLIT AL ARRAY {1-2-3-} --> {"1","2","3"," "}
                        array_pop($productosArr); //BORRAMOS EL ULTIMO ELEMENTO DE LA producto {"1","2","3"," "} ->{"1","2","3"}
                        $largo = sizeof($productosArr); // BUSCAMOS EL TAMAÑO DEL ARREGLO, DEVUELVE 3;
                        $res = $productosArr;

                        $cantidad = explode('-', $cantidad);
                        array_pop($cantidad);

                        for ($i = 0; $i < $largo; $i++) {
                            $this->Crud->insertarDetalleVenta($idventa, $productosArr[$i], $cantidad[$i]);
                            $producto = $this->Crud->obtenerProducto($productosArr[$i]);
                            $stockProducto = $producto[0]->stock;
                            if ($stockProducto <= 0) {
                                $res = 'Sin stock';
                            } else {
                                $nuevoStock = (int) $stockProducto - $cantidad[$i];
                                $idproducto = (int) $productosArr[$i];
                                //  $res = gettype($nuevoStock);
                                $this->Crud->stockVenderBoleta($idproducto, $nuevoStock);
                            }
                        }
                        $res = 'Venta realizada con exito';
                    }
                } else {
                    $res = 'Error de datos';
                }
            }
        } else {

            if (isset($total) && isset($idusuario) && isset($productosAgregados)) {

                if ($codigoGuia != '' || $idcliente != '') {
                    $this->Crud->insertarVentaBoletaGuia($total, $descuento, $idusuario, $codigoGuia, $idcliente, $descripcion);
                } else {
                    $this->Crud->insertarVentaBoleta($total, $descuento, $idusuario, $tipo, $descripcion);
                }


                $ventaBoleta = $this->Crud->ultimaVentaBoleta();
                if (count($ventaBoleta) > 0) {
                    $idventa = $ventaBoleta[0]->idventa;
                    $productosArr = explode('-', $productosAgregados); // HACEMOS UN SPLIT AL ARRAY {1-2-3-} --> {"1","2","3"," "}
                    array_pop($productosArr); //BORRAMOS EL ULTIMO ELEMENTO DE LA producto {"1","2","3"," "} ->{"1","2","3"}
                    $largo = sizeof($productosArr); // BUSCAMOS EL TAMAÑO DEL ARREGLO, DEVUELVE 3;
                    $res = $productosArr;

                    $cantidad = explode('-', $cantidad);
                    array_pop($cantidad);

                    for ($i = 0; $i < $largo; $i++) {
                        $this->Crud->insertarDetalleVenta($idventa, $productosArr[$i], $cantidad[$i]);
                        $producto = $this->Crud->obtenerProducto($productosArr[$i]);
                        $stockProducto = $producto[0]->stock;
                        if ($stockProducto <= 0) {
                            $res = 'Sin stock';
                        } else {
                            $nuevoStock = (int) $stockProducto - $cantidad[$i];
                            $idproducto = (int) $productosArr[$i];
                            //  $res = gettype($nuevoStock);
                            $this->Crud->stockVenderBoleta($idproducto, $nuevoStock);
                        }
                    }
                    $res = 'Venta realizada con exito';
                }
            } else {
                $res = 'Error de datos';
            }
        }
        echo json_encode(array('value' => $res));
    }

    public function getIdBoleta() {
        echo json_encode($this->Crud->ultimaVentaBoleta());
    }

    public function buscarVentasBoleta() {

        $idventa = $this->input->post('codVenta');

        if (isset($idventa)) {
            $bol = $this->Crud->buscarVentasBoleta($idventa);
            $prod = $this->Crud->buscarDetalleVenta($idventa);
            $largo = sizeof($prod);
            if ($bol[0]->estado == 'FINALIZADA' || $bol[0]->estado == 'En Tramite') {
                $res = 'Boleta terminada o debe ser anulada';
                $producto = '';
                $prod = '';
                $boleta = '';
            } else {
                $producto = array();
                for ($i = 0; $i < $largo; $i++) {
                    array_push($producto, $this->Crud->obtenerProducto($prod[$i]->producto_idproducto));
                }
//            $producto['id'] = $prod[0]->producto_idproducto;
//            $producto['cant'] = 5;
                //       $producto = $prod;
                $res = 'Cargando...';
            }
        } else {
            $res = 'Error de datos';
        }
        //  $prod = $prod[0]->producto_idproducto;
        echo json_encode(array(
            'value' => $res,
            'detalle' => $producto,
            'cant' => $prod,
            'boleta' => $bol));
    }

    public function buscarVentasBoletaDetalle() {

        $idventa = $this->input->post('codVenta');

        if (isset($idventa)) {
            $bol = $this->Crud->buscarVentasBoleta($idventa);

            if (count($bol) > 0) {

                if ($bol[0]->estado == 'FINALIZADA' || $bol[0]->estado == 'ANULADA') {
                    $res = 'Boleta finalizada o anulada';
                    $producto = '';
                    $prod = '';
                    $boleta = '';
                } else {

                    $prod = $this->Crud->buscarDetalleVenta($idventa);
                    $largo = sizeof($prod);
                    $producto = array();
                    for ($i = 0; $i < $largo; $i++) {
                        array_push($producto, $this->Crud->obtenerProducto($prod[$i]->producto_idproducto));
                    }
//            $producto['id'] = $prod[0]->producto_idproducto;
//            $producto['cant'] = 5;
                    //       $producto = $prod;
                    $res = 'Cargando...';
                }
            } else {
                $res = 'No existe boleta';
                $producto = '';
                $prod = '';
                $boleta = '';
            }
            //  $prod = $prod[0]->producto_idproducto;
        } else {
            $res = 'Error de datos';
        }
        echo json_encode(array(
            'value' => $res,
            'detalle' => $producto,
            'cant' => $prod,
            'boleta' => $bol));
    }

    public function buscarVentasBoletaDetalle2() {

        $idventa = $this->input->post('codVenta');

        if (isset($idventa)) {
            $bol = $this->Crud->buscarVentasBoleta($idventa);

            if (count($bol) > 0) {
                $prod = $this->Crud->buscarDetalleVenta($idventa);
                $largo = sizeof($prod);
                $producto = array();
                for ($i = 0; $i < $largo; $i++) {
                    array_push($producto, $this->Crud->obtenerProducto($prod[$i]->producto_idproducto));

//            $producto['id'] = $prod[0]->producto_idproducto;
//            $producto['cant'] = 5;
                    //       $producto = $prod;
                    $res = 'Cargando...';
                }
            } else {
                $res = 'No existe boleta';
                $producto = '';
                $prod = '';
                $boleta = '';
            }
            //  $prod = $prod[0]->producto_idproducto;
        } else {
            $res = 'Error de datos';
        }
        echo json_encode(array(
            'value' => $res,
            'detalle' => $producto,
            'cant' => $prod,
            'boleta' => $bol));
    }

    public function terminarVentaBoleta() {
        $codigo = $this->input->post('codigo');

        $venta = $this->Crud->buscarVentasBoleta($codigo);
        $estado = $venta[0]->estado;
        $hora = strftime("%H:%M:%S", time());
//        $res = $hora;
        if ($estado == 'FINALIZADA') {
            $res = 'ERROR VENTA YA PROCESADA';
        } else {
            if (isset($codigo)) {
                $this->Crud->terminarVentaBoleta($codigo);
                $res = 'VENTA COMPLETADA';
            } else {
                $res = 'Error de datos';
            }
        }
        echo json_encode(array('value' => $res));
    }

    public function ventaList() {
        echo json_encode($this->Crud->ventaList());
    }

    public function anularVentaBoleta() {

        $idventa = $this->input->post('idventa');

        if (isset($idventa)) {
            $ventaBoleta = $this->Crud->buscarVentasBoleta($idventa);
            $detalle_venta = $this->Crud->getDetalleVenta($idventa);
            $largo = sizeof($detalle_venta);
            if ($ventaBoleta[0]->estado == 'En Tramite') {
                for ($i = 0; $i < $largo; $i++) {
                    $idproducto = $detalle_venta[$i]->producto_idproducto;
                    $cantidad = $detalle_venta[$i]->cantidad;
                    $producto = $this->Crud->obtenerProducto($idproducto);
                    $stockProducto = $producto[0]->stock;
                    $stockTotal = $cantidad + $stockProducto;
                    $this->Crud->agregarStock($idproducto, $stockTotal);
                }
                $this->Crud->anularVentaBoleta($idventa);
                $res = 'Stock Devuelto con exito';
            } else {
                $res = 'Boleta debe estar en tramite';
            }
        } else {
            $res = 'Error de datos';
        }
        echo json_encode(array('value' => $res));
    }

    public function clientesList() {
        $res = $this->Crud->clientesList();
        echo json_encode(array('value' => $res));
    }

    public function buscarProductoNombre() {

        $nombre = $this->input->post('nombreProducto');

        $productos = $this->Crud->buscarProductoLike($nombre);

        if (isset($nombre)) {
            $res = $productos;
        } else {
            $res = 'Error de datos';
        }

        echo json_encode(array('value' => $res));
    }
    
    public function buscarClienteRut(){
        
        $rut = $this->input->post('rut');
        
        if (isset($rut)) {
            
//            $rut = str_replace(' ', '', $rut);            
//            $sub = str_replace('.', '', $rut);  
            
            $res = $this->Crud->buscarClienteRut($rut);
            echo json_encode(array('value' => $res[0]));  
        }else{
            $res = 'Datos incorrectos';
            echo json_encode(array('value' => $res));  
        }        
              
    }
    
    public function contadorFinalizadas(){
        
        $res = $this->Crud->ventasFinalizadas();
        
        echo json_encode(array('value' => $res));
    }

}
