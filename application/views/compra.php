<!-- LLAMAR A LA SESION  -->
<?php
if (!isset($_SESSION)) {
    redirect('control');
}
$user = $this->session->userdata('user');
$admin = $this->session->userdata('admin');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Title -->
        <title>SYSTEMSALES V1.0</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/datatables.min.css"/>
        <link type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/css/materialize.min.css"/>
        <!--JavaScript at end of body for optimized loading-->    


    </head>
    <style>


        @font-face {
            font-family: 'Material Icons';
            font-style: normal;
            font-weight: 400;
            src: url(<?= base_url() ?>assets/iconfont/MaterialIcons-Regular.eot); /* For IE6-8 */
            src: local('Material Icons'),
                local('MaterialIcons-Regular'),
                url(<?= base_url() ?>assets/iconfont/MaterialIcons-Regular.woff2) format('woff2'),
                url(<?= base_url() ?>assets/iconfont/MaterialIcons-Regular.woff) format('woff'),
                url(<?= base_url() ?>assets/iconfont/MaterialIcons-Regular.ttf) format('truetype');
        }

        .material-icons {
            font-family: 'Material Icons';
            font-weight: normal;
            font-style: normal;
            font-size: 24px;  /* Preferred icon size */
            display: inline-block;
            line-height: 1;
            text-transform: none;
            letter-spacing: normal;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;

            /* Support for all WebKit browsers. */
            -webkit-font-smoothing: antialiased;
            /* Support for Safari and Chrome. */
            text-rendering: optimizeLegibility;

            /* Support for Firefox. */
            -moz-osx-font-smoothing: grayscale;

            /* Support for IE. */
            font-feature-settings: 'liga';
        }
        
        .margen-arriba2{
            
         margin-top: 10px;
            
        }

        body {
            background: url(<?= base_url() ?>assets/img/textura1.png) center center fixed;
            background-color: #4ec3e6;
            padding-left: 250px;
        }
        @media only screen and (max-width : 992px) {
            header, main, footer, body, main{
                padding-left: 0;
            }
        }
        .sidenav{
            width: 250px !important;
        }
        nav{
            padding-left: 15px;   
        }
        td, h5{
            font-weight: bold;             
        }
        .borde{
            border: #000 solid 1px;
            margin-top: 5px;
        }

        .borde-padding{
            border: #000 solid 1px;
            margin: 5px;
            padding: 10px;
        }
        .ancho-total{
            width: 100% !important;   
        }
        .divider{
            padding: 1px;
            margin: 10px;
        }
        .divider-lateral{
            padding: 1px !important;
            margin: 1px !important;
            background-color: rgba(4, 7, 25, 0.7);
        }
        .no-margen{
            margin: 0px !important;
        }
        .margen-ariba{
            margin-top: 18px;   
        }
        .margen-medio-arriba{
            margin-top: 12px;
            margin-bottom: 10px;
        }
        .ancho {
            width: 100%;
            margin-bottom: 5px;
        }
        .zui-table {
            border: solid 1px #DDEEEE;
            border-collapse: collapse;
            border-spacing: 0;
            font: normal 13px Arial, sans-serif;
        }
        .zui-table thead th {
            background-color: #DDEFEF;
            border: solid 1px #DDEEEE;
            color: #336B6B;
            padding: 10px;
            text-align: left;
            text-shadow: 1px 1px 1px #fff;
        }
        .zui-table tbody td {
            border: solid 1px #DDEEEE;
            color: #333;
            padding: 10px;
            text-shadow: 1px 1px 1px #fff;
        }
        .zui-table-highlight tbody tr:hover {
            background-color: #CCE7E7;
        }
        .zui-table-horizontal tbody td {
            border-left: none;
            border-right: none;
        }
        .no-marge-top{          
            margin-top: 5px;
        }


    </style>

    <body>
        <!-- CARGAR MENU DE ARRIBA Y LOADER -->


        <!-- ********************************************************-->

        <!-- BARRA IZQUIERDA ########################################-->

        <!-- ********************************************************-->
        <div id='newapp'>

            <?php $this->load->view('templates/header'); ?>

            <br>

            <main>
                
                 <!-- ********************************************************-->

            <!-- MODAL EDITAR ##########################################-->

            <!-- ********************************************************-->

            <div id="editarp" class="modal editar">
                <div class="modal-content">                    
                    <h5 class="center">Editar Producto</h5>
                    <div class="divider"></div> 
                    <div class="row">



                        <div class="input-field col s7">
                            <input type="text" id="nombre" v-model="editarP.nombre">
                            <label class="active" for="nombre">Nombre</label>                                
                        </div>
                        
                        <div class="input-field col s5">
                            <input type="text" id="stock" v-model="editarP.stock">
                            <label class="active" for="stock">Stock</label>                                
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id="desc" v-model="editarP.descripcion">
                            <label class="active" for="desc">Descripción</label>                                
                        </div>
                        <div class="input-field col s2">
                            <input type="number" id="p_compra" v-model="editarP.p_compra">
                            <label class="active" for="p_compra">Precio Compra</label>                                
                        </div>  
                        <div class=" input-field col s2">
                            <input type="number" id="ganancia" v-model="ganancia">
                            <label class="active" for="ganancia">% Ganancia</label>    
                        </div>
                        <div class="input-field col s2">
                            <button class="btn" @click='calcularGananciaEditar()'>Calcular</button>
                        </div>

                        <div class="row no-margen">
                            <div class="input-field col s3">
                                <input disabled="" type="number" id="p_ventac" v-model="p_ventaconiva">
                                <label class="active" for="p_ventac">P. Venta Con IVA</label>                                
                            </div>
                            <div class="input-field col s2">
                                <input disabled="" type="number" id="p_iva" v-model="p_iva">
                                <label class="active" for="p_iva">IVA</label>                                
                            </div>
                            <div class="input-field col s2">
                                <input disabled="" type="number" id="p_venta" v-model="p_venta">
                                <label class="active" for="p_venta">P. Venta Unidad</label>                                
                            </div>
                            <div class="input-field col s2">
                                <input disabled="" type="number" id="gananc" v-model="p_ganancia">
                                <label class="active" for="gananc">Ganancia al {{ganancia}}%</label>                                
                            </div>
                            <div class="input-field col s3">
                                <input disabled="" type="number" id="p_ventaT" v-model="p_ventaTotal">
                                <label class="active" for="p_ventaT">P. Venta Total</label>                                
                            </div>     
                        </div>



                        <div class="input-field col s6">
                            <select id="cat" class="browser-default borde" v-model="editarP.categoria_idcategoria">      
                                <option value="" disabled="">Seleccione</option>
                                <option v-for="c in comboCategoria" v-bind:value="c.idcategoria">{{c.nombre}}</option>
                            </select>
                            <label class="active" for="cat">Categoria</label>  
                        </div>
                        <div class="input-field col s6">
                            <select id="marca" class="browser-default borde" v-model="editarP.marca_idmarca">    
                                <option value="" disabled="">Seleccione</option>                                            
                                <option v-for="m in comboMarca" v-bind:value="m.idmarca">{{m.nombre}}</option>
                            </select>
                            <label class="active" for="marca">Marca</label>   
                        </div>



                        <div class="center">
                            <button class="btn white-text red" @click="actualizarProducto()">ACTUALIZAR</button>
                            <button class="btn white-text green" @click="cerrarModalEditarP()">CANCELAR</button>
                        </div>  



                    </div>                       

                </div>
            </div>


                <!-- ********************************************************-->

                <!-- MODAL DETALLE FACTURA #################################-->

                <!-- ********************************************************-->


                <div id="detalle" class="modal">
                    <div class="modal-content">                    
                        <h5 class="center">Detalle Factura: </h5>
                        <div class="divider"></div> 
                        <div class="row no-margen">
                            <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Codigo</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>                                    
                                        <th>Proveedor</th>
                                        <th>Empresa</th>
                                        <th>rut_empresa</th>
                                        <th>Telefono</th>
                                        <th>Ciudad</th>
                                        <th>giro</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for='p in factura'>
                                        <td>{{p.idfactura}}</td>
                                        <td>{{p.codigo}}</td>
                                        <td>{{p.fecha}}</td>
                                        <td>{{p.hora}}</td>
                                        <td>{{p.nombre}} {{p.apellido_pat}}</td>
                                        <td>{{p.empresa}}</td>
                                        <td>{{p.rut_empresa}}</td>
                                        <td>{{p.telefono1}}</td>
                                        <td>{{p.ciudad}}</td>
                                        <td>{{p.giro}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">

                            <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>N° Factura</th>
                                        <th>Fecha</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Cantidad</th>
                                        <th>P. Venta+iva</th>
                                        <th>Total</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for='p in productosDetalle'>
                                        <td>{{p.factura_idfactura}}</td>
                                        <td>{{p.codigo_factura}}</td>
                                        <td>{{p.producto_factura_fecha}}</td>
                                        <td>{{p.nombre}}</td>
                                        <td>{{p.descripcion}}</td>
                                        <td>{{p.cantidad}}</td>
                                        <td>${{p.p_ventaconiva}}</td>
                                        <td>${{p.total}}</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>                       

                        <!--                        <div class="row no-margen">
                                                    <div class="divider"></div>
                                                    <div class="input-field col s6 no-marge-top">
                                                        <h6 class="no-margen">TOTAL</h6>                             
                                                    </div> 
                                                    <div class="input-field col s6 no-marge-top">
                                                        <h6 class="no-margen center negra">${{total2}}</h6>                             
                                                    </div>
                                                    <div class="divider"></div>
                                                    <div class="input-field col s6 no-marge-top">
                                                        <h6 class="no-margen">DESCUENTO({{descuento}}%)</h6>                             
                                                    </div> 
                                                    <div class="input-field col s6 no-marge-top">
                                                        <h6 class="no-margen center negra">${{descuentoRealizado2}}</h6>                             
                                                    </div>
                                                    <div class="divider"></div>
                                                    <div class="input-field col s6 no-marge-top">
                                                        <h6 class="no-margen negra">TOTAL FINAL</h6>                             
                                                    </div> 
                                                    <div class="input-field col s6 no-marge-top">
                                                        <h6 class="no-margen center negra">${{totalConDescuento2}}</h6>                             
                                                    </div>
                                                    <div class="divider"></div>
                                                </div>-->
                        <div class="center">
                            <button class="btn black" @click="cerrarModalDetalle()">cerrar</button>
                        </div>
                    </div>
                </div>

                <!-- ********************************************************-->

                <!-- MODAL AGREGAR CANTIDAD #################################-->

                <!-- ********************************************************-->

                <div id="cantidad" class="modal">
                    <div class="modal-content">                    
                        <h5 class="center">CANTIDAD</h5>
                        <div class="divider"></div> 
                        <div class="center">                
                            <div class="divider"></div>              

                        </div>
                        <div class="row">

                            <div class="col s12 center">
                                <div class="input-field">
                                    <input class="center" id='cantidad' type="number" size="5" v-model='cantidad'>
                                    <label class="active" for="cantidad">Cantidad</label>
                                </div>         
                                <button class="btn white-text green left" @click="cargarModalCantidad(cantidad)">ACEPTAR</button>
                                <button class="btn white-text black right" @click="cerrarModalCant()">CANCELAR</button>

                            </div>

                        </div>                       

                    </div>
                </div>



                <!-- ********************************************************-->

                <!-- MODAL AGREGAR PRODUCTOS#################################-->

                <!-- ********************************************************-->

                <div id="agregarProduct" class="modal">
                    <div class="modal-content">                    
                        <h5 class="center">Agregar Productos</h5>
                        <div class="divider"></div> 
                        <div class="row">

                            <div class="input-field col s12">
                                <input type="text" placeholder="Buscar por nombre,costo" v-model='name' id='buscar'>
                                <label class="active" for="buscar">Buscar</label>
                            </div>
                            <table class="bordered zui-table zui-table-horizontal zui-table-highlight centered">
                                <thead>
                                    <tr>
                                        <th>ID</th>                                        
                                        <th>Nombre</th>
                                        <th>Desc</th>
                                        <th>Stock</th>
                                        <th>Costo S/ IVA</th>
                                        <th>IVA</th>
                                        <th>Precio C/ IVA</th>                                         

                                        <th v-if="sesion[0].tipo == 'admin'">Agregar</th>                                        
                                    </tr>
                                </thead>
                                <tbody v-for='(p, i) in buscarUsuario'>
                                    <tr>
                                        <td>{{p.idproducto}}</td>                                        
                                        <td>{{p.nombre}}</td>
                                        <td>{{p.descripcion}}</td>
                                        <td>{{p.stock}}</td>
                                        <td>${{p.p_compra}}</td>
                                        <td>${{p.iva}}</td>
                                        <td>${{p.p_ventaconiva}}</td> 

                                        <td v-if="sesion[0].tipo == 'admin'"><button class="btn-floating btn-small waves-effect waves-light white-text blue" @click='agregarProductoFactura(p)' ><i class="material-icons">add</i></button></td>

                                    </tr>
                                </tbody>
                            </table> 

                            <br>

                            <div class="center">                                
                                <button class="btn white-text black" @click="cerrarModal()">CANCELAR</button>
                            </div>   
                            <!--
                                                        <pre>{{$data}}</pre>-->
                        </div>                       

                    </div>
                </div>

                <!-- ********************************************************-->

                <!-- MCOMIENZO MAIN #########################################-->

                <!-- ********************************************************-->                

             
                    <div class="row">
                        <div class="col s12">
                            <div class="card-panel">      
                                <div class="center">
                                    <h5 class="center no-margen">{{titulo}}</h5>                                        
                                    <div class="divider"></div>                                   
                                    <button type="submit" class="btn waves-effect waves-light  blue darken-3" @click='opcItem(1)'>INGRESAR FACTURA</button>                               
                                    <button type="submit" class="btn waves-effect waves-light  blue darken-3" @click='opcItem(2)'>LISTA FACTURAS</button>
                                    <div class="divider"></div>              

                                </div>

                                <div v-show='opc == 1' >
                                    <div class="row borde-padding">
                                        <h5 class="center no-margen">{{titulo2}}</h5> 
                                        <div class="divider"></div>  
                                        <div class="input-field col s12">
                                            <input type="text" id="cod" v-model="codigo">
                                            <label class='active' for="cod">N° Factura</label>                                
                                        </div>


                                        <!-- AGREGAR PRODUCTOS BTN #########################################-->


                                        <div class="col s4">
                                            <h5 class='center-align'>Productos</h5>
                                        </div>
                                        <div class="col s4 margen-medio-arriba center">                                        
                                            <input type="text" id="productoBus" v-model='buscarProducto'>
                                            <label class="active" for="productoBus">Buscar Producto Nombre</label> 
                                        </div>
                                        <div class="col s4 margen-medio-arriba">
                                            <button class="btn ancho blue accent-2" @click='cargarModalProducto()'> AGREGAR PRODUCTOS</button>
                                        </div>

                                        <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio </th>                                                
                                                    <th>Total</th>
<!--                                                    <th>Eliminar</th>-->
                                                    <th>Modificar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for='p in productosAgregados'>
                                                    <td>{{p.idproducto}}</td>
                                                    <td>{{p.nombre}}</td>
                                                    <td>{{p.cantidad}}</td>
                                                    <td>${{p.p_compra}}</td>                                                
                                                    <td>${{p.total}}</td>
<!--                                                    <td v-if="sesion[0].tipo == 'admin'"><button class="btn-floating btn-small waves-effect waves-light white-text red" @click='eliminarFacturaProducto(p)' ><i class="material-icons">close</i></button></td>-->
                                                    <td v-if="sesion[0].tipo == 'admin'"><button class="btn-floating btn-small waves-effect waves-light white-text blue" @click='modalEditarProducto(p)' ><i class="material-icons">edit</i></button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="row no-margen">
                                            <div class="input-field col s6">
                                                <input type="number" id="iva" v-model="iva">
                                                <label for="iva">IVA</label>                                
                                            </div>
                                            <div class="row no-margen">
                                                <div class="input-field col s3">
                                                    <input type="number" id="iva_adi" v-model="iva_adicional">
                                                    <label class="active" for="iva_adi">Iva adicional</label>                                
                                                </div>
                                                <div class="input-field col s3">
                                                    <button class="btn margen-ariba ancho-total blue accent-2" @click='calcularNetoTotal()'>Calcular</button>                            
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">NETO</h6>                                
                                            </div>
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center">${{neto}}</h6>                                
                                            </div>
                                            <div class="divider"></div>
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">IVA({{iva}}%)</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center">${{iva_final}}</h6>                             
                                            </div>
                                            <div class="divider"></div>
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">TOTAL</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center">${{total}}</h6>                             
                                            </div>
                                            <div class="divider"></div>
                                        </div>


                                        <div class="col s12">
                                            <div class="row no-margen">
                                                <div class="input-field col s8">
                                                    <p class="no-margen">Ingrese Rut sin puntos y con guion al final: 12345678-9 </p>
                                                    <input type="text" placeholder="12345678-9" v-model="rutProveedor">
                                                </div>
                                                <div class="input-field col s4 margen-ariba">
                                                    <button class="btn margen-arriba2 blue accent-2 ancho-total" @click="cargarProveedor()" >Buscar Proveedor</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-field col s3">
                                            <input disabled="" type="text" id="nomP" v-model="proveedorCargar.nombre" >
                                            <label class="active" for="nomP">Nombre</label>                                
                                        </div> 
                                        <div class="input-field col s3">
                                            <input disabled="" type="text" id="apellido_patP" v-model="proveedorCargar.apellido_pat" >
                                            <label class="active" for="apellido_patP">Apellido Paterno</label>                                
                                        </div> 
                                        <div class="input-field col s3">
                                            <input disabled="" type="text" id="apellido_matP" v-model="proveedorCargar.apellido_mat" >
                                            <label class="active" for="apellido_matP">Apellido Materno</label>                                
                                        </div> 
                                        <div class="input-field col s3">
                                            <input disabled="" type="text" id="rutP" v-model="proveedorCargar.rut" >
                                            <label class="active" for="rutP">Rut</label>                                
                                        </div>
                                        <div class="input-field col s6">
                                            <input disabled="" type="text" id="dire" v-model="proveedorCargar.direccion" >
                                            <label class="active" for="dire">Direccion</label>                                
                                        </div>
                                        <div class="input-field col s3">
                                            <input disabled="" type="text" id="telefono1P" v-model="proveedorCargar.telefono1" >
                                            <label class="active" for="telefono1P">Telefono 1</label>                                
                                        </div> 
                                        <div class="input-field col s3">
                                            <input disabled="" type="text" id="telefono2P" v-model="proveedorCargar.telefono2" >
                                            <label class="active" for="telefono2P">Telefono 2</label>                                
                                        </div> 
                                        <div class="input-field col s12">
                                            <input disabled="" type="text" id="giro" v-model="proveedorCargar.giro" >
                                            <label class="active" for="giro">Giro</label>                                
                                        </div> 

                                        <div class="center">
                                            <button class="btn white-text green" @click="insertarFactura()">AGREGAR</button>
                                        </div>                                  
                                    </div>
                                </div>
                                <!-- ********************************************************-->

                                <!-- ROW REALIZAR COMPRA#####################################-->

                                <!-- ********************************************************-->
                                <div v-show='opc == 2'>

                                    <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Codigo</th>
                                                <th>Fecha</th>
                                                <th>Hora </th>                                                
                                                <th>Neto</th>
                                                <th>IVA</th>
                                                <th>Total</th>
                                                <th v-if="sesion[0].tipo == 'admin'">Eliminar</th>
                                                <th >Detalles</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for='p in listaFactura'>
                                                <td>{{p.idfactura}}</td>
                                                <td>{{p.codigo}}</td>
                                                <td>{{p.fecha}}</td>
                                                <td>{{p.hora}}</td>
                                                <td>${{p.neto}}</td>
                                                <td>${{p.iva}}</td>
                                                <td>${{p.total}}</td>
                                                <td v-if="sesion[0].tipo == 'admin'"><button class="btn-floating btn-small waves-effect waves-light white-text red" @click='eliminarFactura(p)' ><i class="material-icons">close</i></button></td>
                                                <td v-if="sesion[0].tipo == 'admin' || sesion[0].tipo == 'caja'"><button class="btn-floating btn-small waves-effect waves-light white-text blue" @click='detallesFactura(p)' ><i class="material-icons">event_note</i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>
           
            </main>

<!--            <pre>{{$data}}</pre>-->
        </div>



        <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-3.2.1.min.js" ></script> 
        <script type="text/javascript" src="<?= base_url() ?>assets/js/axios.min.js" ></script>       
        <!-- development version, includes helpful console warnings -->
        <script type="text/javascript" src="<?= base_url() ?>assets/js/vue.js" ></script>  
        <script src="<?= base_url() ?>assets/js/materialize.min.js" ></script>
        <script type="text/javascript" charset="utf8" src="<?= base_url() ?>assets/js/datatables.js" ></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/js/compra.js" ></script>


    </body>
</html>
