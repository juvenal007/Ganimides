<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of inventario
 *
 * @author JuvenaL
 */
class inventarios extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Crud');
        $this->load->library('Excel');
    }

    public function eliminarProducto() {

        $id = $this->input->post('id');

        if (isset($id)) {
            $this->Crud->eliminarProducto($id);
            $res = 'Producto eliminado';
        } else {
            $res = 'Error de parametros';
        }

        echo json_encode(array('value' => $res));
    }

    public function insertarCategoria() {

        $nombre = $this->input->post('nombre');
        $detalle = $this->input->post('detalle');

        $nombre = strtoupper($nombre);
        $detalle = strtoupper($detalle);

        if (isset($nombre) && isset($detalle)) {
            $this->Crud->insertarCategoria($nombre, $detalle);
            echo json_encode(array('value' => 'Categoria Agregada!'));
        } else {
            echo json_encode(array('value' => 'Error de datos'));
        }
    }

    public function insertarMarca() {

        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');

        $nombre = strtoupper($nombre);
        $descripcion = strtoupper($descripcion);

        if (isset($nombre) && isset($descripcion)) {
            $this->Crud->insertarMarca($nombre, $descripcion);
            echo json_encode(array('value' => 'Marca Agregada!'));
        } else {
            echo json_encode(array('value' => 'Error de datos'));
        }
    }

    public function agregarStock() {
        $idproducto = $this->input->post('idproducto');
        $stock = $this->input->post('stock');
        $stock_real = $this->Crud->obtenerStock($idproducto);
        if (isset($idproducto) && isset($stock)) {
            $stock = $stock_real[0]->stock + $stock;
            $this->Crud->agregarStock($idproducto, $stock);
            $res = 'Stock Actualizado a ' . $stock;
        } else {
            $res = 'Error de Datos';
        }
        echo json_encode(array('value' => $res));
    }

    public function contarCategorias() {
        $res = $this->Crud->contarCategorias();
        echo json_encode(array('value' => $res));
    }

    public function categoriaList() {
        echo json_encode($this->Crud->categoriaList());
    }

    public function marcaList() {
        echo json_encode($this->Crud->marcaList());
    }

    public function insertarProducto() {


        $nombre = $this->input->post('nombre');
        $stock = $this->input->post('stock');
        $descripcion = $this->input->post('descripcion');
        $p_venta = $this->input->post('p_venta');
        $p_compra = $this->input->post('p_compra');
        $iva = $this->input->post('iva');
        $categoria_idcategoria = $this->input->post('categoria_idcategoria');
        $usuario_idusuario = $this->input->post('usuario_idusuario');
        $marca_idmarca = $this->input->post('marca_idmarca');
        $p_ventaconiva = $this->input->post('p_ventaconiva');

        $nombre = strtoupper($nombre);
        $descripcion = strtoupper($descripcion);


        if (isset($nombre) && isset($categoria_idcategoria) && isset($marca_idmarca)) {

            $this->Crud->insertarProducto($nombre, $stock, $descripcion, $p_venta, $p_compra, $iva, $categoria_idcategoria, $usuario_idusuario, $marca_idmarca, $p_ventaconiva);

            $res = "Producto agregado con exito!";
        } else {
            $res = "Error de parametros";
        }

        echo json_encode(array('value' => $res));
    }

    public function productoList() {

        $producto = $this->Crud->productoList();

        $plist = [];

        foreach ($producto as $p) {
            if ($p->activo == 'si') {
                array_push($plist, $p);
            }
        }

        echo json_encode(array('value' => $plist));
    }

    public function actualizarProducto() {


        $id = $this->input->post('id');
        $nombre = $this->input->post('nombre');
        $stock = $this->input->post('stock');
        $descripcion = $this->input->post('descripcion');
        $p_venta = $this->input->post('p_venta');
        $p_compra = $this->input->post('p_compra');
        $iva = $this->input->post('iva');
        $categoria_idcategoria = $this->input->post('categoria_idcategoria');
        $usuario_idusuario = $this->input->post('usuario_idusuario');
        $marca_idmarca = $this->input->post('marca_idmarca');
        $p_ventaconiva = $this->input->post('p_ventaconiva');
        $nombre = strtoupper($nombre);
        $descripcion = strtoupper($descripcion);

        if (isset($nombre) && isset($categoria_idcategoria) && isset($marca_idmarca)) {

            $this->Crud->actualizarProducto($nombre, $stock, $descripcion, $p_venta, $p_compra, $iva, $categoria_idcategoria, $usuario_idusuario, $marca_idmarca, $p_ventaconiva, $id);

            $res = "Producto agregado con exito!";
        } else {
            $res = "Error de parametros";
        }

        echo json_encode(array('value' => $res));
    }

    public function exportarExcel() {

        $producto = $this->Crud->productoList();
        $nuevoP = [];
        foreach ($producto as $p) {
            if ($p->activo == 'si') {
                array_push($nuevoP, $p);
            }
        }


        if (count($nuevoP) > 0) {
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->setTitle('Inventario');


            $cont = 1;
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(43);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(7);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(7);
            $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(7);
            $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(6);

            $this->excel->getActiveSheet()->getStyle("A{$cont}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("B{$cont}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("C{$cont}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("D{$cont}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("E{$cont}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("F{$cont}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("G{$cont}")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("H{$cont}")->getFont()->setBold(true);

            $this->excel->getActiveSheet()->getStyle("A{$cont}")->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle("B{$cont}")->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle("C{$cont}")->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle("D{$cont}")->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle("E{$cont}")->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle("F{$cont}")->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle("G{$cont}")->getFont()->setSize(9);
            $this->excel->getActiveSheet()->getStyle("H{$cont}")->getFont()->setSize(9);

            //Definimos los títulos de la cabecera.
            $this->excel->getActiveSheet()->setCellValue("A{$cont}", 'ID');
            $this->excel->getActiveSheet()->setCellValue("B{$cont}", 'NOMBRE');
            $this->excel->getActiveSheet()->setCellValue("C{$cont}", 'UNIDAD');
            $this->excel->getActiveSheet()->setCellValue("D{$cont}", 'STOCK');
            $this->excel->getActiveSheet()->setCellValue("E{$cont}", 'VENTA');
            $this->excel->getActiveSheet()->setCellValue("F{$cont}", 'NETO+IVA');
            $this->excel->getActiveSheet()->setCellValue("G{$cont}", 'NETO');
            $this->excel->getActiveSheet()->setCellValue("H{$cont}", 'IVA');


            foreach ($nuevoP as $p) {
                $cont++;

                $this->excel->getActiveSheet()->getStyle("A{$cont}")->getFont()->setSize(9);
                $this->excel->getActiveSheet()->getStyle("B{$cont}")->getFont()->setSize(9);
                $this->excel->getActiveSheet()->getStyle("C{$cont}")->getFont()->setSize(9);
                $this->excel->getActiveSheet()->getStyle("D{$cont}")->getFont()->setSize(9);
                $this->excel->getActiveSheet()->getStyle("E{$cont}")->getFont()->setSize(9);
                $this->excel->getActiveSheet()->getStyle("F{$cont}")->getFont()->setSize(9);
                $this->excel->getActiveSheet()->getStyle("G{$cont}")->getFont()->setSize(9);
                $this->excel->getActiveSheet()->getStyle("H{$cont}")->getFont()->setSize(9);


                $this->excel->getActiveSheet()->getStyle("D{$cont}")->getFont()->setBold(true);

                $this->excel->getActiveSheet()->setCellValue("A{$cont}", $p->idproducto);
                $this->excel->getActiveSheet()->setCellValue("B{$cont}", $p->nombre);
                $this->excel->getActiveSheet()->setCellValue("C{$cont}", $p->descripcion);
                $this->excel->getActiveSheet()->setCellValue("D{$cont}", $p->stock);
                $this->excel->getActiveSheet()->setCellValue("E{$cont}", $p->p_venta);
                $this->excel->getActiveSheet()->setCellValue("F{$cont}", $p->p_ventaconiva);
                $this->excel->getActiveSheet()->setCellValue("G{$cont}", $p->p_compra);
                $this->excel->getActiveSheet()->setCellValue("H{$cont}", $p->iva);
            }
            $hora = strftime("%H:%M:%S", time());
            $fecha = strftime("%Y-%m-%d", time());
            $archivo = "INVENTARIOFecha:{$fecha}Hora:{$hora}.xls";
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $archivo . '"');
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            $objWriter->save('php://output');
        } else {
            echo 'No se han encontrado llamadas';
            exit;
        }
    }

}
