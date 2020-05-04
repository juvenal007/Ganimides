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
        <!-- CARGAR MENU DE ARRIBA Y LOADER -->

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
            margin-top: 10px;   
        }
        .margen-arriba2{
            margin-top: 15px;
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
        .negra{
            font-weight: bold;   
        }
        .entramite{

            background-color: rgba(255, 0, 0, 0.45);   
        }
        .finalizada{

            background-color: rgba(0, 255, 0, 0.45);   
        }


    </style>

    <body>


        <!-- ********************************************************-->

        <!-- BARRA IZQUIERDA ########################################-->

        <!-- ********************************************************-->
        <div id='newapp'>

            <?php $this->load->view('templates/header'); ?>

            <br>

            <main>

                <!-- ********************************************************-->

                <!-- MODAL DETALLE VENTA    #################################-->

                <!-- ********************************************************-->

                <div id="detalle" class="modal">
                    <div class="modal-content">                    
                        <h5 class="center">Detalle Venta: {{detallesModal.idventa}}</h5>
                        <div class="divider"></div> 

                        <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Vendedor</th>
                                    <th>Rut</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Cantidad P</th>
                                    <th>Cantidad U</th>
                                    <th>Tipo</th>
                                    <th v-if='nuevoDetalle.tipo_venta == "Guia"'>N° Guia</th>

                                    <th>Estado</th>                                                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='p in detallesModal'>
                                    <td>{{p.idventa}}</td>
                                    <td>{{p.nombre}} {{p.apellido_pat}}</td>
                                    <td>{{p.rut}}</td>
                                    <td>{{p.fecha}}</td>
                                    <td>{{p.hora}}</td>
                                    <td>{{p.cantidadP}}</td>
                                    <td>{{p.cantidadU}}</td>
                                    <td>{{p.tipo_venta}}</td>
                                    <td v-show='nuevoDetalle.tipo_venta == "Guia"'>{{p.nguia}}</td>
<!--                                    <td v-show='detallesModal[0].tipo == "Guia"'>{{p.}}</td>-->
                                    <td v-if="p.estado == 'En Tramite'" class="entramite center" >{{p.estado}}</td>
                                    <td v-if="p.estado == 'FINALIZADA'" class="finalizada center" >{{p.estado}}</td>
                                    <td v-if="p.estado == 'ANULADA'" class="yellow center" >{{p.estado}}</td>

                                </tr>
                            </tbody>
                        </table>

                        <div class="row">

                            <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Total</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for='p in detalleProductosModal'>
                                        <td>{{p.codigo}}</td>
                                        <td>{{p.nombre}}</td>
                                        <td>{{p.cantidad}}</td>
                                        <td>${{p.p_venta}}</td>
                                        <td>${{p.total}}</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>                       

                        <div class="row no-margen">
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
                        </div>
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

                <!-- MODAL TERMINO VENTA CAJA ###############################-->

                <!-- ********************************************************-->

                <div id="venta" class="modal">
                    <div class="modal-content">                   

                        <div class="divider"></div> 

                        <div class="row">

                            <div class="col s12 center">
                                <h4 class="center negra">CODIGO: {{codVenta}}</h4>
                                <h4 class="center negra red-text">VENTA COMPLETADA CON EXITO!</h4>
                                <button class="btn white-text green" @click="cerrarModalVenta()">ACEPTAR</button>
                            </div>

                        </div>                       
                        <div class="divider"></div> 
                    </div>
                </div>



                <!-- ********************************************************-->

                <!-- MODAL CODIGO GENERADO #################################-->

                <!-- ********************************************************-->

                <div id="codigo" class="modal">
                    <div class="modal-content">                   

                        <div class="divider"></div> 

                        <div class="row">

                            <div class="col s12 center">
                                <h4 class="center negra">CODIGO: {{idventa}}</h4>
                                <h4 class="center negra red-text">VENTA REALIZADA CON EXITO!</h4>
                                <button class="btn white-text green" @click="cerrarModalCodigo()">ACEPTAR</button>
                            </div>

                        </div>                       
                        <div class="divider"></div> 
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
                                <input type="text" placeholder="Buscar por nombre, precio" v-model='name' id='buscar'>
                                <label class="active" for="buscar">Buscar</label>
                            </div>
                            <table class="bordered zui-table zui-table-horizontal zui-table-highlight centered">
                                <thead>
                                    <tr>   
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Desc</th>
                                        <th>Stock</th>
                                        <th>Costo Neto </th>
                                        <th>IVA</th>
                                        <th>Precio Compra + IVA</th>
                                        <th>Precio Venta</th> 
                                        <th>Agregar</th>                                        
                                    </tr>
                                </thead>
                                <tbody v-for='(p, i) in buscarUsuario'>
                                    <tr>
                                        <td>{{p.idproducto}}</td>
                                        <td>{{p.nombre}}</td>
                                        <td>{{p.descripcion}}</td>                                        
                                        <td v-if="p.stock >= 1">{{p.stock}}</td>
                                        <td v-if="p.stock == 0" class="red">{{p.stock}}</td>                                                  
                                        <td>${{p.p_compra}}</td>
                                        <td>{{p.iva}}</td>
                                        <td>{{p.p_ventaconiva}}</td>
                                        <td class="teal lighten-5">${{p.p_venta}}</td>

                                        <td><button class="btn-floating btn-small waves-effect waves-light white-text green" @click='agregarProductoFactura(p)' ><i class="material-icons">add</i></button></td>

                                    </tr>
                                </tbody>
                            </table> 

                            <br>

                            <div class="center">                                
                                <button class="btn white-text black" @click="cerrarModal()">CANCELAR</button>
                            </div>   

<!--                            <pre>{{$data}}</pre>-->
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
                                    <button type="submit" class="btn waves-effect waves-light  blue darken-3" @click='cambiarOpc(1)'>VENDER BOLETA</button>
                                    <!--                                    <button type="submit" class="btn waves-effect waves-light  brown darken-3" @click='cambiarOpc(2)'>VENDER FACTURA</button>-->
                                    <button v-if="sesion[0].tipo == 'admin' || sesion[0].tipo == 'caja'"type="submit" class="btn waves-effect waves-light  red darken-3" @click='cambiarOpc(3)'>COMPLETAR VENTA CAJA</button>
                                    <button type="submit" class="btn waves-effect waves-light  blue darken-3" @click='cambiarOpc(4)'>ESTADO VENTAS</button>
                                    <div class="divider"></div> 
                                </div>

                                <!-- BUSCAR VENTAS BTN #########################################-->


                                <div v-show="opc == 1" class="row borde-padding">
                                    <div class="row no-margen">
                                        <div class="input-field col s6">
                                            <h5 class="center no-margen">Tipo : </h5> 
                                        </div>

                                        <div class="input-field col s6">

                                            <center>
                                                <p>                                               
                                                    <label>
                                                        <input checked name="grupo" type="radio" @click='limpiarGuia()' v-model="tipoVenta" value="boleta"/>
                                                        <span>Boleta</span>
                                                    </label>

                                                    <label>
                                                        <input name="grupo" type="radio" @click='limpiarGuia()' v-model="tipoVenta" value="guia"/>
                                                        <span>Guia Despacho</span>
                                                    </label>
                                                    <label>
                                                        <input name="grupo" type="radio" @click='limpiarGuia()' v-model="tipoVenta" value="bBoleta"/>
                                                        <span>Buscar Boletas</span>
                                                    </label>
                                                </p>
                                            </center>
                                        </div>

                                        <div v-if="tipoVenta == 'guia'">
                                            <div class="input-field col s6 no-margen">
                                                <h5 class="center no-margen">Ingrese N° Guia de Despacho</h5>                             
                                            </div>
                                            <div class="input-field col s6 no-margen">
                                                <input type="number" id="guia" v-model="codigoGuia">
                                                <label for="guia" class="active" >N° Guia</label>                                           
                                            </div>
                                        </div>
                                        <div v-if="tipoVenta == 'bBoleta'">
                                            <div class="input-field col s6">
                                                <h5 class="center no-margen">{{titulo2}}</h5> 
                                            </div>
                                            <div class="input-field col s4">
                                                <input type="number" id="busc" v-model="codigoBoletaBuscar">
                                                <label for="busc" class="active" >Buscar</label>                                        
                                            </div>
                                            <div class="input-field col s2">
                                                <button class="btn red" @click="buscarCodigoVentaBoleta()">Buscar</button>                                      
                                            </div>
                                        </div>


                                    </div>
                                    <div class="divider"></div>  


                                    <!-- AGREGAR PRODUCTOS BTN #########################################-->


                                    <div class="row no-margen">

                                        <div v-if='tipoVenta == "guia"'>

                                            <div class="col s12">
                                                <div class="row no-margen">
                                                    <div class="input-field col s8">
                                                        <p class="no-margen">Ingrese Rut sin puntos y con guion al final: 12345678-9 </p>
                                                        <input type="text" placeholder="12345678-9" v-model="rutCliente">
                                                    </div>
                                                    <div class="input-field col s4 margen-ariba">
                                                        <button class="btn margen-arriba2 blue accent-2 ancho-total" @click="cargarCliente()" >Buscar Cliente</button>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row no-margen">
                                                <div class="input-field col s3">                                                
                                                    <input disabled="" type="text" id="nomP" v-model="clienteCargar.nombre" >
                                                </div> 
                                                <div class="input-field col s3">
                                                    <input disabled="" type="text" id="apellido_patP" v-model="clienteCargar.apellido_pat" >                                                                                
                                                </div> 
                                                <div class="input-field col s3">
                                                    <input disabled="" type="text" id="apellido_matP" v-model="clienteCargar.apellido_mat" >

                                                </div> 
                                                <div class="input-field col s3">
                                                    <input disabled="" type="text" id="rutP" v-model="clienteCargar.rut" >

                                                </div>
                                            </div>


                                            <div class="input-field col s6">
                                                <input disabled="" type="text" id="dire" v-model="clienteCargar.direccion" >

                                            </div>
                                            <div class="input-field col s3">
                                                <input disabled="" type="text" id="telefono1P" v-model="clienteCargar.telefono" >

                                            </div> 
                                            <div class="input-field col s3">
                                                <input disabled="" type="text" id="telefono2P" v-model="clienteCargar.ciudad" >

                                            </div> 
                                            <div class="input-field col s12">
                                                <input disabled="" type="text" id="giro" v-model='clienteCargar.giro'>

                                            </div> 
                                        </div>

                                        <div class="col s4">
                                            <h5 class='center-align'>Productos</h5>
                                        </div>
                                        <div class="col s4 margen-medio-arriba center">                                        
                                            <input type="text" id="productoBus" v-model='buscarProducto'>
                                            <label class="active" for="productoBus">Buscar Producto Nombre</label> 
                                        </div>
                                        <div class="col s4 margen-medio-arriba center">                                        
                                            <button class="btn blue accent-2" @click='cargarModalProducto()'>BUSCAR PRODUCTO</button>
                                        </div>



                                    </div>
                                    <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Precio Unitario</th>
                                                <th>Total</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for='p in productosAgregados'>
                                                <td>{{p.codigo}}</td>
                                                <td>{{p.nombre}}</td>
                                                <td>{{p.cantidad}}</td>
                                                <td>${{p.p_venta}}</td>
                                                <td>${{p.total}}</td>
                                                <td><button class="btn-floating btn-small waves-effect waves-light white-text red" @click='eliminarProductoAgregado(p)' ><i class="material-icons">close</i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div v-if="sesion[0].tipo == 'admin'" class="divider"></div>
                                    <div v-if="sesion[0].tipo == 'admin'" class="row no-margen">
                                        <div class="input-field col s9">
                                            <p class="no-margen">Descuento</p>
                                            <input type="number" id="descuen" v-model="descuento">

                                        </div>
                                        <div class="row no-margen">                                            
                                            <div class="input-field col s3">
                                                <button class="btn margen-ariba ancho-total blue accent-2" @click='calcularDescuento()'>DESCUENTO</button>                            
                                            </div>
                                        </div>   
                                    </div>
                                    <div class="row no-margen">
                                        <div class="divider"></div>
                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen">TOTAL</h6>                             
                                        </div> 
                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen center negra">${{total2}}</h6>                             
                                        </div>

                                        <div v-if="sesion[0].tipo == 'admin'" class="divider"></div>
                                        <div v-if="sesion[0].tipo == 'admin'" class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen">DESCUENTO({{descuento}}%)</h6>                             
                                        </div> 
                                        <div v-if="sesion[0].tipo == 'admin'"  class="input-field col s6 no-marge-top">
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
                                        <div class="input-field col s6 no-marge-top">
                                            <p class="negra">DESCRIPCION</p>                           
                                        </div> 
                                        <div class="input-field col s6 no-margen">
                                            <input type="text" v-model="descripcion" id="descripcion">
                                            
                                        </div>
                                    </div>






                                    <div class="center">
                                        <button class="btn white-text green ancho margen-ariba" @click="insertarVentaBoleta()">VENDER</button>
                                    </div>  


                                </div>

                                <!-- ********************************************************-->

                                <!-- VENDER FACTURAAA   #####################################-->

                                <!-- ********************************************************-->



                                <div v-show="opc == 2" class="row borde-padding">

                                    <h5 class="center no-margen">{{titulo2}}</h5> 
                                    <div class="divider"></div>  



                                    <div class="col s4">
                                        <h5 class='center-align'>ProductosSSS</h5>
                                    </div>
                                    <div class="col s8 margen-medio-arriba center">
                                        <button class="btn blue accent-2" @click='cargarModalProducto()'> AGREGAR PRODUCTOS</button>
                                    </div>

                                    <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Precio Unitario</th>
                                                <th>Total</th>
                                                <th>Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for='p in productosAgregados'>
                                                <td>{{p.codigo}}</td>
                                                <td>{{p.nombre}}</td>
                                                <td>{{p.cantidad}}</td>
                                                <td>${{p.p_venta}}</td>
                                                <td>${{p.total}}</td>
                                                <td><button class="btn-floating btn-small waves-effect waves-light white-text red" @click='' ><i class="material-icons">close</i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="divider"></div>
                                    <div class="row no-margen">
                                        <div class="input-field col s9">
                                            <input type="number" id="desc" v-model="descuento">
                                            <label class="active" for="desc">Descuento</label>                                
                                        </div>
                                        <div class="row no-margen">                                            
                                            <div class="input-field col s3">
                                                <button class="btn margen-ariba ancho-total blue accent-2" @click='calcularDescuento()'>DESCUENTO</button>                            
                                            </div>
                                        </div>   
                                    </div>
                                    <div class="row no-margen">
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
                                            <h6 class="no-margen center negra">${{descuentoRealizado}}</h6>                             
                                        </div>
                                        <div class="divider"></div>
                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen negra">TOTAL FINAL</h6>                             
                                        </div> 
                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen center negra">${{totalConDescuento}}</h6>                             
                                        </div>
                                        <div class="divider"></div>
                                    </div>




                                    <div class="center">
                                        <button class="btn white-text green ancho" @click="insertarVentaBoleta()">VENDER</button>
                                    </div>  


                                </div>  <!-- FIN CAJA -->

                                <!-- ********************************************************-->

                                <!-- COMPLETAR VENTA CAJA  ##################################-->

                                <!-- ********************************************************-->



                                <div v-show="opc == 3" class="row borde-padding">

                                    <h5 class="center no-margen">{{titulo2}}</h5> 
                                    <div class="divider"></div>  

                                    <div class="row no-margen">
                                        <div class="input-field col s9">
                                            <p class="no-margen">Codigo Venta</p>
                                            <input type="number" id="vent" v-model="codVenta">

                                        </div>
                                        <div class="row no-margen">                                            
                                            <div class="input-field col s3">
                                                <button class="btn margen-ariba ancho-total red darken-3" @click='buscarCodigoVenta()'>BUSCAR</button>                            
                                            </div>
                                        </div>   
                                    </div>

                                    <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Precio Unitario</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for='p in productosVenta'>
                                                <td>{{p.idproducto}}</td>
                                                <td>{{p.nombre}}</td>
                                                <td>{{p.cantidad}}</td>
                                                <td>${{p.p_venta}}</td>
                                                <td>${{p.total}}</td>
                                            </tr>
                                        </tbody>
                                    </table>


                                    <div class="row no-margen">
                                        <div class="divider"></div>
                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen">TOTAL</h6>                             
                                        </div> 
                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen center negra">${{total_caja}}</h6>                             
                                        </div>
                                        <div class="divider"></div>
                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen">DESCUENTO({{descuento_caja}}%)</h6>                             
                                        </div> 
                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen center negra">${{descuentoRealizado_caja}}</h6>                             
                                        </div>
                                        <div class="divider"></div>
                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen negra">TOTAL FINAL</h6>                             
                                        </div> 
                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen center negra">${{totalConDescuento_caja}}</h6>                             
                                        </div>
                                        <div class="divider"></div>                                        


                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen negra">MONTO</h6>                             
                                        </div>                              
                                        <div class="input-field col s3 no-marge-top">
                                            <input class="number" id="monto" v-model="monto">
                                            <label for="monto" class="active" >Monto</label>
                                        </div>
                                        <div class="input-field col s3 no-marge-top center">                                            
                                            <button class="btn blue accent-2" @click="calcularVuelto()">Calcular</button>
                                        </div>                                       



                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen  negra">VUELTO</h6>                             
                                        </div>

                                        <div class="input-field col s6 no-marge-top">                                            
                                            <h6 class="no-margen center negra">${{vuelto}}</h6>     
                                        </div>
                                    </div>






                                    <div class="center">
                                        <button class="btn white-text green ancho" @click="finalizarVentaBoleta()">FINALIZAR VENTA</button>
                                    </div>  


                                </div>  <!-- FIN CAJA -->




                                <!-- ********************************************************-->

                                <!-- ESTADO VENTAS         ##################################-->

                                <!-- ********************************************************-->



                                <div v-show="opc == 4" class="row borde-padding">

                                    <h5 class="center no-margen">{{titulo2}}</h5> 
                                    <div class="divider"></div>  
                                    <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Vendedor</th>
                                                <th>Total</th>
                                                <th>Fecha</th>
                                                <th>Hora</th>
                                                <th>Tipo</th>
                                                <th>N° Guia</th>
                                                <th>Descripcion</th>
                                                <th>Estado</th>
                                                <th>Anular</th>
                                                <th>Detalles</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for='p in estadoVentasBoleta'>
                                                <td>{{p.idventa}}</td>
                                                <td>{{p.nombre}} {{p.apellido_pat}}</td>
                                                <td>${{p.total}}</td>
                                                <td>{{p.fecha}}</td>
                                                <td>{{p.hora}}</td>
                                                <td>{{p.tipo_venta}}</td>
                                                <td v-if='p.nguia != null'>{{p.nguia}}</td>
                                                <td v-if="p.tipo_venta == 'Boleta'">...</td>
                                                <td v-if='p.descripcion != ""'>{{p.descripcion}}</td>
                                                <td v-if='p.descripcion == ""'>...</td>                                                  
                                                <td v-if="p.estado == 'En Tramite'" class="entramite center" >{{p.estado}}</td>
                                                <td v-if="p.estado == 'FINALIZADA'" class="finalizada center" >{{p.estado}}</td>
                                                <td v-if="p.estado == 'ANULADA'" class="yellow center" >{{p.estado}}</td>
                                                <td class="center"><button class="btn-floating btn-small waves-effect waves-light white-text red darken-3" @click='anularBoleta(p)'><i class="material-icons">close</i></button></td></td>
                                                <td class="center"><button class="btn-floating btn-small waves-effect waves-light white-text blue darken-3" @click='cargarModalDetalle(p)'><i class="material-icons">event_note</i></button></td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>  <!-- FIN CAJA -->

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
        <script src="<?= base_url() ?>assets/js/materialize.min.js" async></script>
        <script type="text/javascript" charset="utf8" src="<?= base_url() ?>assets/js/datatables.js" async></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/js/venta.js" async></script>
    </body>
</html>