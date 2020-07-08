<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of crud
 *
 * @author root
 */
class Crud extends CI_Model {

    public $venta, $detalle_venta;

    public function __construct() {
        parent::__construct();
        $this->venta = "venta";
        $this->detalle_venta = "detalle_venta";
    }

    // *****************************************************
    // INSERTAR
    // *****************************************************

    public function insertarDetalleVenta($idventa, $idproducto, $cantidad) {
        $fecha = strftime("%Y-%m-%d", time());
        $datos = array(
            'detalle_fecha' => $fecha,
            'cantidad' => $cantidad,
            'producto_idproducto' => $idproducto,
            'venta_idventa' => $idventa
        );

        return $this->db->insert('detalle_venta', $datos);
    }

    public function getDetalleVenta($venta_idventa) {
        $this->db->where('venta_idventa', $venta_idventa);
        return $this->db->get('detalle_venta')->result();
    }

    public function insertarUsuario($rut, $nombre, $apellido_pat, $apellido_mat, $direccion, $telefono1, $telefono2, $usuario, $password, $tipo) {
        $fecha = strftime("%Y-%m-%d %H:%M:%S", time());
        $datos = array(
            'rut' => $rut,
            'nombre' => $nombre,
            'apellido_pat' => $apellido_pat,
            'apellido_mat' => $apellido_mat,
            'direccion' => $direccion,
            'telefono1' => $telefono1,
            'telefono2' => $telefono2,
            'usuario' => $usuario,
            'password' => $password,
            'pregunta' => "pregunta",
            'tipo' => $tipo,
            'fecha_creacion' => date($fecha),
            'activo' => "no",
        );
        return $this->db->insert('usuario', $datos);
    }

    public function insertarProveedor($rut, $nombre, $apellido_pat, $apellido_mat, $empresa, $direccion, $ciudad, $rut_empresa, $telefono1, $telefono2, $giro) {

        $activo = 'si';

        $datos = array(
            'rut' => $rut,
            'nombre' => $nombre,
            'apellido_pat' => $apellido_pat,
            'apellido_mat' => $apellido_mat,
            'empresa' => $empresa,
            'direccion' => $direccion,
            'ciudad' => $ciudad,
            'rut_empresa' => $rut_empresa,
            'telefono1' => $telefono1,
            'telefono2' => $telefono2,
            'giro' => $giro,
            'activo' => $activo
        );

        return $this->db->insert('proveedor', $datos);
    }

    public function insertarCliente($rut, $nombre, $apellido_pat, $apellido_mat, $direccion, $ciudad, $telefono, $giro) {

        $datos = array(
            'nombre' => $nombre,
            'apellido_pat' => $apellido_pat,
            'apellido_mat' => $apellido_mat,
            'direccion' => $direccion,
            'ciudad' => $ciudad,
            'telefono' => $telefono,
            'rut' => $rut,
            'giro' => $giro,
            'activo' => 'si'
        );

        return $this->db->insert('cliente', $datos);
    }

    public function insertarCategoria($nombre, $detalle) {
        $datos = array(
            'nombre' => $nombre,
            'detalle' => $detalle
        );

        return $this->db->insert('categoria', $datos);
    }

    public function insertarMarca($nombre, $descripcion) {
        $datos = array(
            'nombre' => $nombre,
            'descripcion' => $descripcion
        );

        return $this->db->insert('marca', $datos);
    }

    public function insertarProducto($nombre, $stock, $descripcion, $p_venta, $p_compra, $iva, $categoria_idcategoria, $usuario_idusuario, $marca_idmarca, $p_ventaconiva) {
        $fecha = strftime("%Y-%m-%d", time());
        $datos = array(
            'codigo' => '',
            'codigo_interno' => '',
            'nombre' => $nombre,
            'stock' => $stock,
            'descripcion' => $descripcion,
            'p_venta' => $p_venta,
            'p_compra' => $p_compra,
            'activo' => 'si',            
            'iva' => $iva,
            'fecha_ingreso' => $fecha,
            'categoria_idcategoria' => $categoria_idcategoria,
            'usuario_idusuario' => $usuario_idusuario,
            'marca_idmarca' => $marca_idmarca,
            'p_ventaconiva' => $p_ventaconiva
        );

        return $this->db->insert('producto', $datos);
    }

    public function insertarFactura($codigo, $iva, $iva_adicional, $total, $neto, $proveedor_idproveedor, $usuario_idusuario) {
        $fecha = strftime("%Y-%m-%d", time());
        $hora = strftime("%H:%M:%S", time());



        $datos = array(
            'codigo' => $codigo,
            'fecha' => $fecha,
            'hora' => $hora,
            'iva' => $iva,
            'iva_adicional' => $iva_adicional,
            'total' => $total,
            'activo' => 'si',
            'neto' => $neto,
            'proveedor_idproveedor' => $proveedor_idproveedor,
            'usuario_idusuario' => $usuario_idusuario
        );
        return $this->db->insert('factura', $datos);
    }

    public function insertarVentaBoleta($total, $descuento, $idusuario, $tipo, $descripcion) {
        $fecha = strftime("%Y-%m-%d", time());
        $hora = strftime("%H:%M:%S", time());
        $medio_pago = 'MEDIO PAGO';
        $estado = 'En Tramite';



        $datos = array(
            'total' => $total,
            'fecha' => $fecha,
            'hora' => $hora,
            'estado' => $estado,
            'medio_pago' => "MEDIO PAGO",
            'descuento' => $descuento,
            'usuario_idusuario' => $idusuario,
            'tipo' => $tipo,
            'descripcion' => $descripcion
        );
        return $this->db->insert('venta', $datos);
    }

    public function insertarVentaBoletaGuia($total, $descuento, $idusuario, $nguia, $idcliente, $descripcion) {
        $fecha = strftime("%Y-%m-%d", time());
        $hora = strftime("%H:%M:%S", time());
        $medio_pago = 'CREDITO';
        $estado = 'En Tramite';
        $boleta = 'GUIA';

        $datos = array(
            'total' => $total,
            'fecha' => $fecha,
            'hora' => $hora,
            'estado' => $estado,
            'medio_pago' => $medio_pago,
            'descuento' => $descuento,
            'usuario_idusuario' => $idusuario,
            'tipo' => $boleta,
            'nguia' => $nguia,
            'cliente_idcliente' => $idcliente,
            'descripcion' => $descripcion
        );
        return $this->db->insert('venta', $datos);
    }

    public function buscarFactura($codigo) {
        $this->db->where('codigo', $codigo);
        return $this->db->get('factura')->result();
    }

    public function insertarProductoFactura($idfactura, $idproducto, $codigo, $cantidad) {
        $fecha = strftime("%Y-%m-%d", time());
        $datos = array(
            'factura_idfactura' => $idfactura,
            'producto_idproducto' => $idproducto,
            'producto_factura_fecha' => $fecha,
            'codigo_factura' => $codigo,
            'cantidad' => $cantidad
        );

        return $this->db->insert('producto_factura', $datos);
    }

    // *****************************************************
    // EDITAR
    // *****************************************************

    public function stockVenderBoleta($idproducto, $nuevoStock) {
        $datos = array(
            'stock' => $nuevoStock
        );
        $this->db->where('idproducto', $idproducto);
        $this->db->update('producto', $datos);
    }

    public function editarProveedor($idproveedor, $rut, $nombre, $apellido_pat, $apellido_mat, $empresa, $direccion, $ciudad, $rut_empresa, $telefono1, $telefono2, $giro) {

        $datos = array(
            'rut' => $rut,
            'nombre' => $nombre,
            'apellido_pat' => $apellido_pat,
            'apellido_mat' => $apellido_mat,
            'empresa' => $empresa,
            'direccion' => $direccion,
            'ciudad' => $ciudad,
            'rut_empresa' => $rut_empresa,
            'telefono1' => $telefono1,
            'telefono2' => $telefono2,
            'giro' => $giro
        );
        $this->db->where('idproveedor', $idproveedor);
        return $this->db->update('proveedor', $datos);
    }

    public function editarCliente($idcliente, $rut, $nombre, $apellido_pat, $apellido_mat, $direccion, $ciudad, $telefono, $giro) {

        $datos = array(
            'rut' => $rut,
            'nombre' => $nombre,
            'apellido_pat' => $apellido_pat,
            'apellido_mat' => $apellido_mat,
            'direccion' => $direccion,
            'ciudad' => $ciudad,
            'telefono' => $telefono,
            'giro' => $giro
        );
        $this->db->where('idcliente', $idcliente);
        return $this->db->update('cliente', $datos);
    }

    public function agregarStock($idproducto, $stock) {
        $datos = array(
            'stock' => $stock
        );
        $this->db->where('idproducto', $idproducto);
        return $this->db->update('producto', $datos);
    }

    public function obtenerStock($idproducto) {
        $this->db->where('idproducto', $idproducto);
        return $this->db->get('producto')->result();
    }

    public function obtenerFactura($idFactura) {
        $this->db->where('idfactura', $idFactura);
        return $this->db->get('factura')->result();
    }

//    public function obtenerProducto($idproducto) {
//        $this->db->where('idproducto', $idproducto);
//        return $this->db->get('producto')->result();
//    }

    public function obtenerProductoNombre($nombreProducto) {
        $query = ('SELECT * FROM producto WHERE nombre LIKE "%' . $nombreProducto . '%";');
        $res = $this->db->query($query);
        return $res->result();
    }

    public function terminarVentaBoleta($codigo) {
        $datos = array(
            'estado' => 'FINALIZADA'
        );
        $this->db->where('idventa', $codigo);
        return $this->db->update('venta', $datos);
    }

    public function terminarVentaGuia($codigo) {
        $datos = array(
            'estado' => 'En Tramite'
        );
        $this->db->where('idventa', $codigo);
        return $this->db->update('venta', $datos);
    }

    public function anularVentaBoleta($codigo) {
        $datos = array(
            'estado' => 'ANULADA'
        );
        $this->db->where('idventa', $codigo);
        return $this->db->update('venta', $datos);
    }

    public function iniciarSesion($usuario, $password) {
        $this->db->where("usuario", $usuario);
        $this->db->where("password", $password);
        return $this->db->get("usuario")->result();
    }

    public function activo($idusuario, $pregunta) {
        $datos = array(
            'pregunta' => $pregunta,
            'activo' => 'si'
        );
        //     $this->db->select('*');
        //    $this->db->from('usuario');
        $this->db->where('idusuario', $idusuario);
        return $this->db->update('usuario', $datos);
    }

    public function usuarios() {
        $this->db->where('activo', 'si');
        return $this->db->get('usuario')->result();
    }

    public function proveedoresList() {
        return $this->db->get('proveedor')->result();
    }

    public function clientesList() {
        return $this->db->get('cliente')->result();
    }

    public function categoriaList() {
        return $this->db->get('categoria')->result();
    }

    public function marcaList() {
        return $this->db->get('marca')->result();
    }

    public function ventaList() {
        $query = ('SELECT *, venta.tipo AS tipo_venta FROM venta INNER JOIN usuario on venta.usuario_idusuario = usuario.idusuario ORDER BY idventa DESC LIMIT 30');
        $res = $this->db->query($query);
        return $res->result();
    }

    public function contarCategorias() {
        $query = 'SELECT * FROM categoria;';
        $res = $this->db->query($query);
        $cont = $res->result();
        return count($cont);
    }

    public function contarProductosDetalle($idventa) {
        $this->db->where('venta_idventa', $idventa);
        $cont = $this->db->get('detalle_venta')->result();
        return count($cont);
    }

    public function eliminarProveedores($idproveedor) {
        $datos = array(
            'activo' => 'no'
        );
        $this->db->where('idproveedor', $idproveedor);
        return $this->db->update('proveedor', $datos);
    }

    public function eliminarCliente($idcliente) {

        $datos = array(
            'activo' => 'no'
        );

        $this->db->where('idcliente', $idcliente);
        return $this->db->update('cliente', $datos);
    }

    public function eliminarProducto($id) {

        $datos = array(
            'activo' => 'no'
        );

        $this->db->where('idproducto', $id);
        return $this->db->update('producto', $datos);
    }

    public function actualizarProducto($nombre, $stock, $descripcion, $p_venta, $p_compra, $iva, $categoria_idcategoria, $usuario_idusuario, $marca_idmarca, $p_ventaconiva, $id) {


        $datos = array(
            'codigo' => '',
            'codigo_interno' => '',
            'nombre' => $nombre,
            'stock' => $stock,
            'descripcion' => $descripcion,
            'p_venta' => $p_venta,
            'p_compra' => $p_compra,
            'iva' => $iva,           
            'categoria_idcategoria' => $categoria_idcategoria,
            'usuario_idusuario' => $usuario_idusuario,
            'marca_idmarca' => $marca_idmarca,
            'p_ventaconiva' => $p_ventaconiva
        );

        $this->db->where('idproducto', $id);
        return $this->db->update('producto', $datos);
    }

    public function obtenerProducto($idproducto) {
        $this->db->where('idproducto', $idproducto);
        return $this->db->get('producto')->result();
    }

    public function contarProveedores() {
        $query = 'SELECT * FROM proveedor;';
        $res = $this->db->query($query);
        $cont = $res->result();
        return count($cont);
    }

    public function contarVentas() {
        $query = 'SELECT * FROM venta;';
        $res = $this->db->query($query);
        $cont = $res->result();
        return count($cont);
    }

    public function contarStock() {
        $query = 'SELECT * FROM producto;';
        $res = $this->db->query($query);
        $cont = $res->result();
        return count($cont);
    }

    public function productoList() {
        return $this->db->get('producto')->result();
    }

    public function estadoVentasBoleta() {
        return $this->db->get('producto')->result();
    }

    public function ultimaVentaBoleta() {
        $query = 'SELECT * FROM venta order by idventa desc limit 1';
        $res = $this->db->query($query);
        return $res->result();
    }

    public function buscarVentasBoleta($idventa) {
        $this->db->where('idventa', $idventa);
        return $this->db->get("venta")->result();
    }

    public function buscarVentasGuia($nguia) {
        $this->db->where('nguia', $nguia);
        return $this->db->get("venta")->result();
    }

    public function buscarDetalleVenta($idventa) {
        $this->db->where('venta_idventa', $idventa);
        return $this->db->get("detalle_venta")->result();
    }

    public function buscarDetalleFactura($idfactura) {
        $this->db->where('factura_idfactura', $idfactura);
        return $this->db->get("producto_factura")->result();
    }

    public function getFechaAnual($ano) {
        $query = 'SELECT *, venta.tipo AS ventaTipo FROM venta INNER JOIN usuario on venta.usuario_idusuario = usuario.idusuario WHERE (fecha BETWEEN"' . $ano . '0101" AND "' . $ano . '1231") AND (estado = "FINALIZADA") AND (hora BETWEEN "000000" AND "595959") ORDER BY idventa desc';
        // $query = 'SELECT * FROM venta WHERE (fecha BETWEEN "20190101" AND "20191231")';
        $res = $this->db->query($query);
        return $res->result();
    }

    public function getProductosMes($ano, $mes, $idproducto) {
        $query = 'SELECT * FROM detalle_venta INNER JOIN producto on detalle_venta.producto_idproducto = producto.idproducto INNER JOIN venta on detalle_venta.venta_idventa = venta.idventa WHERE (detalle_fecha BETWEEN"' . $ano . $mes . '01" AND "' . $ano . $mes . '31") AND (producto_idproducto = "' . $idproducto . '") AND (estado = "FINALIZADA")  ORDER BY detalle_fecha desc';
        $res = $this->db->query($query);
        return $res->result();
    }

    public function getProductosDias($ano, $mes, $dia, $idproducto) {
        $query = 'SELECT * FROM detalle_venta INNER JOIN producto on detalle_venta.producto_idproducto = producto.idproducto INNER JOIN venta on detalle_venta.venta_idventa = venta.idventa WHERE (detalle_fecha BETWEEN"' . $ano . $mes . $dia . '" AND "' . $ano . $mes . $dia . '") AND (producto_idproducto = "' . $idproducto . '") AND (estado = "FINALIZADA") ORDER BY detalle_fecha desc';
        $res = $this->db->query($query);
        return $res->result();
    }

    public function getFechaAnualContar($ano) {
        $query = 'SELECT * FROM venta INNER JOIN usuario on venta.usuario_idusuario = usuario.idusuario WHERE (fecha BETWEEN"' . $ano . '0101" AND "' . $ano . '1231") AND (estado = "FINALIZADA") AND (hora BETWEEN "000000" AND "235959") ORDER BY idventa desc';
        // $query = 'SELECT * FROM venta WHERE (fecha BETWEEN "20190101" AND "20191231")';
        $res = $this->db->query($query);
        $cont = $res->result();
        return count($cont);
    }

    public function getMes($ano, $mes) {
        $query = 'SELECT *, venta.tipo AS ventaTipo FROM venta INNER JOIN usuario on venta.usuario_idusuario = usuario.idusuario WHERE (fecha BETWEEN"' . $ano . $mes . '01" AND "' . $ano . $mes . '31") AND (estado = "FINALIZADA") AND (hora BETWEEN "000000" AND "235959") ORDER BY idventa desc';
        // $query = 'SELECT * FROM venta WHERE (fecha BETWEEN "20190101" AND "20191231")';
        $res = $this->db->query($query);
        return $res->result();
    }

    public function getMesContar($ano, $mes) {
        $query = 'SELECT * FROM venta INNER JOIN usuario on venta.usuario_idusuario = usuario.idusuario WHERE (fecha BETWEEN"' . $ano . $mes . '01" AND "' . $ano . $mes . '31") AND (estado = "FINALIZADA") AND (hora BETWEEN "000000" AND "235959") ORDER BY idventa desc';
        // $query = 'SELECT * FROM venta WHERE (fecha BETWEEN "20190101" AND "20191231")';
        $res = $this->db->query($query);
        $cont = $res->result();
        return count($cont);
    }

    public function getDia($ano, $mes, $dia) {
        $query = 'SELECT *, venta.tipo AS ventaTipo FROM venta INNER JOIN usuario on venta.usuario_idusuario = usuario.idusuario WHERE (fecha BETWEEN"' . $ano . $mes . $dia . '" AND "' . $ano . $mes . $dia . '") AND (estado = "FINALIZADA") AND (hora BETWEEN "000000" AND "235959") ORDER BY idventa desc';
        // $query = 'SELECT * FROM venta WHERE (fecha BETWEEN "20190101" AND "20191231")';
        $res = $this->db->query($query);
        return $res->result();
    }

    public function contarVentasDia($ano, $mes, $dia) {
        $query = 'SELECT * FROM venta INNER JOIN usuario on venta.usuario_idusuario = usuario.idusuario WHERE (fecha BETWEEN"' . $ano . $mes . $dia . '" AND "' . $ano . $mes . $dia . '") AND (estado = "FINALIZADA") AND (hora BETWEEN "000000" AND "235959") ORDER BY idventa desc';
        // $query = 'SELECT * FROM venta WHERE (fecha BETWEEN "20190101" AND "20191231")';
        $res = $this->db->query($query);
        $cont = $res->result();
        return count($cont);
    }

    public function getFecha($ano1, $mes1, $dia1, $ano2, $mes2, $dia2) {
        $query = 'SELECT *, venta.tipo AS ventaTipo FROM venta INNER JOIN usuario on venta.usuario_idusuario = usuario.idusuario WHERE fecha BETWEEN"' . $ano1 . $mes1 . $dia1 . '" AND "' . $ano2 . $mes2 . $dia2 . '" AND (estado = "FINALIZADA") AND (hora BETWEEN "000000" AND "235959") ORDER BY idventa desc';
        // $query = 'SELECT * FROM venta WHERE (fecha BETWEEN "20190101" AND "20191231")';
        $res = $this->db->query($query);
        return $res->result();
    }

    public function getFechaContar($ano1, $mes1, $dia1, $ano2, $mes2, $dia2) {
        $query = 'SELECT * FROM venta INNER JOIN usuario on venta.usuario_idusuario = usuario.idusuario WHERE fecha BETWEEN"' . $ano1 . $mes1 . $dia1 . '" AND "' . $ano2 . $mes2 . $dia2 . '" AND (estado = "FINALIZADA") AND (hora BETWEEN "000000" AND "235959") ORDER BY idventa desc';
        // $query = 'SELECT * FROM venta WHERE (fecha BETWEEN "20190101" AND "20191231")';
        $res = $this->db->query($query);
        $cont = $res->result();
        return count($cont);
    }

    public function detalleVentaProducto($ano, $mes, $dia) {
        $query = 'SELECT * FROM detalle_venta INNER JOIN producto on detalle_venta.producto_idproducto = producto.idproducto INNER JOIN venta on detalle_venta.venta_idventa = venta.idventa WHERE (estado = "FINALIZADA") AND (detalle_fecha BETWEEN"' . $ano . $mes . $dia . '" AND "' . $ano . $mes . $dia . '") ORDER BY detalle_fecha desc';
        $res = $this->db->query($query);
        return $res->result();
    }

    public function detalleVentaProductoMes($ano, $mes) {
        $query = 'SELECT * FROM detalle_venta INNER JOIN producto on detalle_venta.producto_idproducto = producto.idproducto INNER JOIN venta on detalle_venta.venta_idventa = venta.idventa WHERE (estado = "FINALIZADA") AND (detalle_fecha BETWEEN"' . $ano . $mes . '01" AND "' . $ano . $mes . '31") ORDER BY detalle_fecha desc';
        $res = $this->db->query($query);
        return $res->result();
    }

    public function detalleVentaProductoAno($ano) {
        $query = 'SELECT * FROM detalle_venta INNER JOIN producto on detalle_venta.producto_idproducto = producto.idproducto INNER JOIN venta on detalle_venta.venta_idventa = venta.idventa WHERE (estado = "FINALIZADA") AND (detalle_fecha BETWEEN"' . $ano . '0101" AND "' . $ano . '1231") ORDER BY detalle_fecha desc';
        $res = $this->db->query($query);
        return $res->result();
    }

    public function detalleVentaProductoFecha($ano1, $mes1, $dia1, $ano2, $mes2, $dia2) {
        $query = 'SELECT * FROM detalle_venta INNER JOIN producto on detalle_venta.producto_idproducto = producto.idproducto INNER JOIN venta on detalle_venta.venta_idventa = venta.idventa WHERE (estado = "FINALIZADA") AND (detalle_fecha BETWEEN"' . $ano1 . $mes1 . $dia1 . '" AND "' . $ano2 . $mes2 . $dia2 . '") ORDER BY detalle_fecha desc';
        $res = $this->db->query($query);
        return $res->result();
    }

    public function buscarVenta($idventa) {
        $query = 'SELECT * FROM detalle_venta INNER JOIN producto on detalle_venta.producto_idproducto = producto.idproducto INNER JOIN venta on detalle_venta.venta_idventa = venta.idventa WHERE (estado = "FINALIZADA") AND (venta_idventa = "' . $idventa . '") ORDER BY detalle_fecha desc';
        $res = $this->db->query($query);
        return $res->result();
    }

    public function buscarVentaUser($idventa) {
        $query = ('SELECT * FROM venta INNER JOIN usuario on venta.usuario_idusuario = usuario.idusuario WHERE idventa = "' . $idventa . '"');
        $res = $this->db->query($query);
        return $res->result();
    }

    public function facturaList() {
        $query = ('SELECT * FROM factura INNER JOIN proveedor on factura.proveedor_idproveedor = proveedor.idproveedor WHERE factura.activo = "si" ORDER BY idfactura DESC LIMIT 30');
        $res = $this->db->query($query);
        return $res->result();
    }

    public function detallesFactura($idfactura) {
        $query = ('SELECT * FROM producto_factura INNER JOIN producto ON producto_factura.producto_idproducto = producto.idproducto WHERE factura_idfactura = "' . $idfactura . '"');
        $res = $this->db->query($query);
        return $res->result();
    }

    public function eliminarBoletaDetalle($idventa) {
        $this->db->where('venta_idventa', $idventa);
        return $this->db->delete('detalle_venta');
    }

    public function eliminarBoleta($idventa) {
        $this->db->where('idventa', $idventa);
        return $this->db->delete('venta');
    }

    public function eliminarFacturaDetalle($idfactura) {
        $this->db->where('factura_idfactura', $idfactura);
        return $this->db->delete('producto_factura');
    }

    public function eliminarFactura($idfactura) {
        $this->db->where('idfactura', $idfactura);
        return $this->db->delete('factura');
    }

    public function buscarFacturaId($idfactura) {
        $query = ('SELECT * FROM factura INNER JOIN proveedor on factura.proveedor_idproveedor = proveedor.idproveedor WHERE (factura.activo = "si") AND (codigo = "' . $idfactura . '")');
        $res = $this->db->query($query);
        return $res->result();
    }

    public function getFacturaId($idfactura) {
        $this->db->where('codigo', $idfactura);
        return $this->db->get("factura")->result();
    }

    public function buscarFacturaDetalleId($idfactura) {
        $query = ('SELECT * FROM producto_factura INNER JOIN producto on producto_factura.producto_idproducto = producto.idproducto WHERE (producto.activo = "si") AND (factura_idfactura = "' . $idfactura . '")');
        $res = $this->db->query($query);
        return $res->result();
    }

    public function buscarProductoLike($nombre) {
        $query = ('SELECT * FROM producto WHERE (nombre like "%' . $nombre . '%") AND (activo = "si")');
        $res = $this->db->query($query);
        return $res->result();
    }

    public function buscarClienteRut($rut) {
        $this->db->where('rut', $rut);
        $this->db->where('activo', 'si');
        return $this->db->get('cliente')->result();
    }

    public function buscarProveedorRut($rut) {
        $this->db->where('rut', $rut);
        $this->db->where('activo', 'si');
        return $this->db->get('proveedor')->result();
    }

    public function ventasFinalizadas() {
        $this->db->where('estado', 'FINALIZADA');
        $cont = $this->db->get('venta')->result();
        return count($cont);
    }

    public function eliminarUsuario($id) {
        $this->db->where('idusuario', $id);
        $dato = array(
            'activo' => 'no'
        );
        return $this->db->update('usuario', $dato);
    }

    public function getMesGuia($ano, $mes) {
        $query = 'SELECT *, usuario.nombre AS usuario_nombre, usuario.rut AS usuario_rut, usuario.apellido_pat AS usuario_apellido_pat, venta.tipo AS venta_tipo, cliente.nombre AS cliente_nombre, cliente.apellido_pat AS cliente_apellido_pat, cliente.direccion AS cliente_direccion, cliente.telefono AS cliente_telefono, cliente.rut AS cliente_rut FROM venta INNER JOIN cliente on venta.cliente_idcliente = cliente.idcliente INNER JOIN usuario on venta.usuario_idusuario = usuario.idusuario WHERE (fecha BETWEEN"' . $ano . $mes . '01" AND "' . $ano . $mes . '31") AND (hora BETWEEN "000000" AND "235959") AND (venta.tipo = "GUIA") ORDER BY idventa desc';
        // $query = 'SELECT * FROM venta WHERE (fecha BETWEEN "20190101" AND "20191231")';
        $res = $this->db->query($query);
        return $res->result();
    }

    public function getMesGuiaRut($ano, $mes, $idcliente) {
        $query = 'SELECT *, usuario.nombre AS usuario_nombre, usuario.rut AS usuario_rut, usuario.apellido_pat AS usuario_apellido_pat, venta.tipo AS venta_tipo, cliente.nombre AS cliente_nombre, cliente.apellido_pat AS cliente_apellido_pat, cliente.direccion AS cliente_direccion, cliente.telefono AS cliente_telefono, cliente.rut AS cliente_rut FROM venta INNER JOIN cliente on venta.cliente_idcliente = cliente.idcliente INNER JOIN usuario on venta.usuario_idusuario = usuario.idusuario WHERE (fecha BETWEEN"' . $ano . $mes . '01" AND "' . $ano . $mes . '31") AND (hora BETWEEN "000000" AND "235959") AND (venta.tipo = "GUIA") AND (cliente.rut = "' . $idcliente . '")ORDER BY idventa desc';
        // $query = 'SELECT * FROM venta WHERE (fecha BETWEEN "20190101" AND "20191231")';
        $res = $this->db->query($query);
        return $res->result();
    }

    public function getDiaGuia($ano, $mes, $dia) {
        $query = 'SELECT *, usuario.nombre AS usuario_nombre, usuario.rut AS usuario_rut, usuario.apellido_pat AS usuario_apellido_pat, venta.tipo AS venta_tipo, cliente.nombre AS cliente_nombre, cliente.apellido_pat AS cliente_apellido_pat, cliente.direccion AS cliente_direccion, cliente.telefono AS cliente_telefono, cliente.rut AS cliente_rut FROM venta INNER JOIN cliente on venta.cliente_idcliente = cliente.idcliente INNER JOIN usuario on venta.usuario_idusuario = usuario.idusuario WHERE (fecha BETWEEN"' . $ano . $mes . $dia . '" AND "' . $ano . $mes . $dia . '") AND (hora BETWEEN "000000" AND "235959") AND (venta.tipo = "GUIA") ORDER BY idventa desc';
        // $query = 'SELECT * FROM venta WHERE (fecha BETWEEN "20190101" AND "20191231")';
        $res = $this->db->query($query);
        return $res->result();
    }

    public function getDiaGuiaRut($ano, $mes, $dia, $idcliente) {
        $query = 'SELECT *, usuario.nombre AS usuario_nombre, usuario.rut AS usuario_rut, usuario.apellido_pat AS usuario_apellido_pat, venta.tipo AS venta_tipo, cliente.nombre AS cliente_nombre, cliente.apellido_pat AS cliente_apellido_pat, cliente.direccion AS cliente_direccion, cliente.telefono AS cliente_telefono, cliente.rut AS cliente_rut FROM venta INNER JOIN cliente on venta.cliente_idcliente = cliente.idcliente INNER JOIN usuario on venta.usuario_idusuario = usuario.idusuario WHERE (fecha BETWEEN"' . $ano . $mes . $dia . '" AND "' . $ano . $mes . $dia . '") AND (hora BETWEEN "000000" AND "235959") AND (venta.tipo = "GUIA") AND (cliente.rut = "' . $idcliente . '") ORDER BY idventa desc';
        // $query = 'SELECT * FROM venta WHERE (fecha BETWEEN "20190101" AND "20191231")';
        $res = $this->db->query($query);
        return $res->result();
    }

    public function getGuiaFecha($ano1, $mes1, $dia1, $ano2, $mes2, $dia2) {
        $query = 'SELECT *, usuario.nombre AS usuario_nombre, usuario.rut AS usuario_rut, usuario.apellido_pat AS usuario_apellido_pat, venta.tipo AS venta_tipo, cliente.nombre AS cliente_nombre, cliente.apellido_pat AS cliente_apellido_pat, cliente.direccion AS cliente_direccion, cliente.telefono AS cliente_telefono, cliente.rut AS cliente_rut FROM venta INNER JOIN cliente on venta.cliente_idcliente = cliente.idcliente INNER JOIN usuario on venta.usuario_idusuario = usuario.idusuario WHERE (fecha BETWEEN"' . $ano1 . $mes1 . $dia1 . '" AND "' . $ano2 . $mes2 . $dia2 . '") AND (hora BETWEEN "000000" AND "235959") AND (venta.tipo = "GUIA") ORDER BY idventa desc';
        // $query = 'SELECT * FROM venta WHERE (fecha BETWEEN "20190101" AND "20191231")';
        $res = $this->db->query($query);
        return $res->result();
    }

    public function getGuiaFechaRut($ano1, $mes1, $dia1, $ano2, $mes2, $dia2, $idcliente) {
        $query = 'SELECT *, usuario.nombre AS usuario_nombre, usuario.rut AS usuario_rut, usuario.apellido_pat AS usuario_apellido_pat, venta.tipo AS venta_tipo, cliente.nombre AS cliente_nombre, cliente.apellido_pat AS cliente_apellido_pat, cliente.direccion AS cliente_direccion, cliente.telefono AS cliente_telefono, cliente.rut AS cliente_rut FROM venta INNER JOIN cliente on venta.cliente_idcliente = cliente.idcliente INNER JOIN usuario on venta.usuario_idusuario = usuario.idusuario WHERE (fecha BETWEEN"' . $ano1 . $mes1 . $dia1 . '" AND "' . $ano2 . $mes2 . $dia2 . '") AND (hora BETWEEN "000000" AND "235959") AND (venta.tipo = "GUIA") AND (cliente.rut = "' . $idcliente . '") ORDER BY idventa desc';
        // $query = 'SELECT * FROM venta WHERE (fecha BETWEEN "20190101" AND "20191231")';
        $res = $this->db->query($query);
        return $res->result();
    }

    public function getVenta($idventa) {
        $this->db->where('idventa', $idventa);
        return $this->db->get($this->venta)->result();
    }

    public function getProductos($idventa) {
        $this->db->join('producto', 'producto.idproducto = detalle_venta.producto_idproducto');
        $this->db->where('venta_idventa', $idventa);
        return $this->db->get($this->detalle_venta)->result();
    }
    
    public function agregarGuiaSii($idventa, $nGuiaSii){
          $datos = array(          
            'nguia_sii' => $nGuiaSii            
        );
        $this->db->where('idventa', $idventa);
        return $this->db->update($this->venta, $datos);
    }

}
