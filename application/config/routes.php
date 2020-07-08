<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// INICIO DE SESION
$route['menu-admin'] = 'vista/admin';
$route['menu-user'] = 'vista/user';

//MENU 
$route['header'] = 'vista/header';
$route['logout'] = 'control/logout';


//USUARIOS
$route['nuevo-usuario'] = 'vista/nuevoUser';
$route['lista-usuarios'] = 'usuarios/usuariosList';
$route['eliminar-usuario'] = 'usuarios/eliminarUsuario';


//INVENTARIO
$route['inventario'] = 'vista/inventario';
$route['insertar-categoria'] = 'inventarios/insertarCategoria';
$route['insertar-marca'] = 'inventarios/insertarMarca';
$route['contar-categorias'] = 'inventarios/contarCategorias';
$route['lista-categoria'] = 'inventarios/categoriaList';
$route['lista-marca'] = 'inventarios/marcaList';
$route['insertar-producto'] ='inventarios/insertarProducto';
$route['lista-producto'] = 'inventarios/productoList';
$route['agregar-stock'] = 'inventarios/agregarStock';
$route['eliminar-producto'] = 'inventarios/eliminarProducto';
$route['editar-producto'] = 'inventarios/actualizarProducto';
$route['exportar-excel'] = 'inventarios/exportarExcel';

//PROVEEDOR
$route['proveedor'] = 'vista/proveedor';
$route['insertar-proveedor'] = 'proveedores/insertarProveedor';
$route['lista-proveedores'] = 'proveedores/proveedoresList';
$route['eliminar-proveedor'] = 'proveedores/eliminarProveedor';
$route['editar-proveedor'] = 'proveedores/editarProveedor';
$route['contar-proveedores'] = 'proveedores/contarProveedores';



//CLIENTE
$route['cliente'] = 'vista/cliente';
$route['insertar-cliente'] = 'clientes/insertarCliente';
$route['lista-clientes'] = 'clientes/clientesList';
$route['eliminar-cliente'] = 'clientes/eliminarCliente';
$route['editar-cliente'] = 'clientes/editarCliente';
$route['contar-cliente'] = 'clientes/contarClientes';

//COMPRAS
$route['compra'] = 'vista/compra';
$route['insertar-factura'] = 'compras/insertarFactura';
$route['lista-factura'] = 'compras/listaFactura';
$route['detalles-factura'] = 'compras/detallesFactura';
$route['eliminar-factura'] = 'compras/eliminarFactura';
$route['buscar-proveedor-rut'] = 'compras/buscarProveedorRut';
$route['obtener-producto'] = 'compras/obtenerProducto';

// VENTAS
$route['venta'] = 'vista/venta';
$route['insertar-boleta'] = 'ventas/insertarVentaBoleta';
$route['id-boleta'] = 'ventas/getIdBoleta';
$route['terminar-compra-boleta'] = 'ventas/buscarVentasBoleta';
$route['terminar-compra-boleta-detalle'] = 'ventas/buscarVentasBoletaDetalle';
$route['terminar-compra-boleta-detalle2'] = 'ventas/buscarVentasBoletaDetalle2';
$route['finalizar-venta-boleta'] = 'ventas/terminarVentaBoleta';
$route['finalizar-venta-guia'] = 'ventas/terminarVentaGuia';
$route['agregar-guia-sii'] = 'ventas/agregarGuiaSii';
$route['lista-venta-boleta'] = 'ventas/ventaList';
$route['anular-venta-boleta'] = 'ventas/anularVentaBoleta';
$route['contar-productos-detalle'] = 'ventas/totalProductosDetalle';
$route['buscar-ventas-boleta-detalle'] = 'ventas/buscarVentasBoletaDetalle';
$route['buscar-producto'] = 'ventas/buscarProductoNombre';
$route['buscar-cliente-rut'] = 'ventas/buscarClienteRut';
$route['contar-finalizadas'] = 'ventas/contadorFinalizadas';

$route['generarPDF/(:num)'] = 'control/generarPDF/$1';

//INFORMES
$route['informe'] = 'vista/informe';
$route['get-fechas-anual'] = 'informes/getFechaAnual';
$route['get-fechas-mes'] = 'informes/getMes';
$route['get-fechas-dia'] = 'informes/getDia';
$route['get-fechas'] = 'informes/getFecha';
$route['lista-fecha-producto'] = 'informes/getProductosMes';
$route['lista-fecha-producto-dia'] = 'informes/getProductosDia';
$route['buscar-venta-id'] = 'informes/buscarVentaId';
$route['contar-ventas'] = 'informes/contarVentas';
$route['contar-stock'] = 'informes/contarStock';
$route['buscar-factura-id'] = 'informes/buscarFacturaId';
$route['guia-mes'] = 'informes/guiaMes';
$route['guia-mes-rut'] = 'informes/guiaMesRut';
$route['guia-dia'] = 'informes/guiaDia';
$route['guia-dia-rut'] = 'informes/guiaDiaRut';
$route['guia-fecha'] = 'informes/guiaFecha';
$route['guia-fecha-rut'] = 'informes/guiaFechaRut';
$route['obtener-guia'] = 'informes/obtenerGuia';

$route['default_controller'] = 'control';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


