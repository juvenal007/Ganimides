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
        <title>SYS GANIMIDES V1.1</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/datatables.min.css"/>
        <link type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/css/materialize.min.css"/>

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
            margin-top: 8px;   
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
        .entramite{

            background-color: rgba(255, 0, 0, 0.45);   
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

            <main v-if="sesion[0].tipo == 'admin'">

                <!-- ********************************************************-->

                <!-- MODAL BUSCAR GUIA X ID #################################-->

                <!-- ********************************************************-->



                <!-- ********************************************************-->

                <!-- MODAL BUSCAR CLIENTE #################################-->

                <!-- ********************************************************-->

                <div id="buscarCliente" class="modal">
                    <div class="modal-content">
                        <table  class="zui-table zui-table-horizontal zui-table-highlight">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Rut</th>
                                    <th>Nombre</th>
                                    <th>Telefono</th>                                            
                                    <th>Ciudad</th>
                                    <th>Giro</th> 
                                    <th>Agregar</th>
                                </tr>
                            </thead>
                            <tbody v-for='p in clienteModal'>
                                <tr>
                                    <td>{{p.idcliente}}</td>
                                    <td>{{p.rut}}</td>
                                    <td>{{p.nombre}} {{p.apellido_pat}} {{p.apellido_mat}}</td>
                                    <td>{{p.telefono}}</td>                                            
                                    <td>{{p.ciudad}}</td>
                                    <td>{{p.giro}}</td>  
                                    <td><button class="btn-floating btn-small waves-effect waves-light white-text green darken-3" @click='cargarCliente(p)'><i class="material-icons">add</i></button></td>
                                </tr>
                            </tbody>
                        </table>   

                        <br>
                        <div class="center">
                            <button class="btn black" @click="cerrarModalCliente()">cerrar</button>
                        </div>

                    </div>
                </div>


                <!-- ********************************************************-->

                <!-- MODAL DETALLE VENTA    #################################-->

                <!-- ********************************************************-->



                <div id="detalle" class="modal">
                    <div class="modal-content">                    
                        <h5 class="center">Detalle Venta: </h5>
                        <div class="divider"></div> 

                        <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                            <thead>
                                <tr>
                                    <th>Codigo</th>        
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Cantidad P</th>
                                    <th>Cantidad U</th>
                                    <th>Estado</th>                                                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='p in detallesModal'>
                                    <td>{{p.idventa}}</td>                                    
                                    <td>{{p.fecha}}</td>
                                    <td>{{p.hora}}</td>
                                    <td>{{p.cantidadP}}</td>
                                    <td>{{p.cantidadU}}</td>
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
                                        <td>{{p.idproducto}}</td>
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
                    
                 <!--   <pre>{{$data}}</pre> -->
                    
                </div>




                <!-- ********************************************************-->

                <!-- MODAL BUSCAR ID PRODUCTOS#################################-->

                <!-- ********************************************************-->

                <div id="buscarId" class="modal">
                    <div class="modal-content">                    
                        <h5 class="center">Consultar ID Producto</h5>
                        <div class="divider"></div> 
                        <div class="row">

                            <div class="input-field col s12">
                                <input type="text" placeholder="Buscar por nombre o precio" v-model='name' id='buscar'>
                                <label class="active" for="buscar">Buscar</label>
                            </div>
                            <table class="bordered zui-table zui-table-horizontal zui-table-highlight centered">
                                <thead>
                                    <tr>            
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Desc</th>
                                        <th>Stock</th>
                                        <th>P. Compra Neto</th>



                                    </tr>
                                </thead>
                                <tbody v-for='(p, i) in buscarUsuario'>
                                    <tr>             
                                        <td class="red lighten-3"> {{p.idproducto}}</td>
                                        <td>{{p.nombre}}</td>
                                        <td>{{p.descripcion}}</td>
                                        <td>{{p.stock}}</td>
                                        <td>${{p.p_compra}}</td>


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

                <!-- COMIENZO MAIN #########################################-->

                <!-- ********************************************************-->                


                <div class="row">
                    <div class="col s12">
                        <div class="card-panel">      
                            <div class="center">
                                <h5 class="center no-margen">{{titulo}}</h5>                                        
                                <div class="divider"></div>                                   
                                <button type="submit" class="btn waves-effect waves-light  blue darken-3" @click='cambiarOpc(1)'>VENTAS</button>
                                <button type="submit" class="btn waves-effect waves-light  blue darken-3" @click='cambiarOpc(2)'>FACTURAS</button>
                                <button type="submit" class="btn waves-effect waves-light  blue darken-3" @click='cambiarOpc(3)'>GUIAS</button>
                                <!--                                    <button type="submit" class="btn waves-effect waves-light  red darken-3" @click='cambiarOpc(3)'>FACTURAS</button>-->
                                <!--                                    <button type="submit" class="btn waves-effect waves-light  brown darken-3" @click='cambiarOpc(2)'>COMPRAS</button>
                                                                    <button type="submit" class="btn waves-effect waves-light  red darken-3" @click='cambiarOpc(3)'>INVENTARIO</button>
                                                                    <button type="submit" class="btn waves-effect waves-light  blue darken-3" @click='cambiarOpc(4)'>ESTADO VENTAS</button>-->
                                <div class="divider"></div> 
                            </div>

                            <!--  VENTAS  #########################################-->

                            <div v-show="opc == 1" class="row borde-padding">

                                <div class="center">                                                                           
                                    <div class="divider"></div>                                   
                                    <div class="input-field col s12 no-margen">
                                        <center>
                                            <p>                                               
                                                <label>
                                                    <input checked name="grupo" type="radio" @click='limpiar()' v-model="opcVenta" value="1"/>
                                                    <span>Fecha</span>
                                                </label>

                                                <label>
                                                    <input name="grupo" type="radio" @click='limpiar()' v-model="opcVenta" value="2"/>
                                                    <span>Producto</span>
                                                </label>
                                                <label>
                                                    <input name="grupo" type="radio" @click='limpiar()' v-model="opcVenta" value="3"/>
                                                    <span>Resumen ID</span>
                                                </label>
                                            </p>
                                        </center>
                                    </div>
                                    <div class="divider"></div> 
                                </div>

                                <div v-show="opcVenta == 1" class="row no-margen">


                                    <div class="row no-margen center">
                                        <div class="input-field col s6">
                                            <h5 class="center no-margen">{{titulo2}}</h5> 

                                        </div>
                                        <div class="input-field col s6">
                                            <button type="submit" class="btn waves-effect waves-light  blue darken-3" @click='limpiar()'>LIMPIAR</button>                                            
                                        </div>
                                    </div>


                                    <div class="row no-margen">
                                        <div class="input-field col s2">
                                            <select id="ano" class="browser-default borde" v-model="ano">      
                                                <option value="0" disabled="">Seleccione</option>
                                                <option value="2019" >2019</option>
                                                <option value="2020" >2020</option>
                                                <option value="2021" >2021</option>
                                                <option value="2022" >2022</option>
                                                <option value="2023" >2023</option>
                                            </select>
                                            <label class="active" for="ano">Año</label>  
                                        </div>
                                        <div class="input-field col s2">
                                            <button class="btn blue ancho-total margen-ariba" @click="buscarFechaAnual()">Anual</button>
                                        </div>  
                                        <div class="input-field col s2">
                                            <select id="mes" class="browser-default borde" v-model="mes">      
                                                <option value="0" disabled="">Seleccione</option>
                                                <option value="01" >Enero</option>
                                                <option value="02" >Febrero</option>
                                                <option value="03" >Marzo</option>
                                                <option value="04" >Abril</option>
                                                <option value="05" >Mayo</option>
                                                <option value="06" >Junio</option>
                                                <option value="07" >Julio</option>
                                                <option value="08" >Agosto</option>
                                                <option value="09" >Septiembre</option>
                                                <option value="10" >Octubre</option>
                                                <option value="11" >Noviembre</option>
                                                <option value="12" >Diciembre</option>
                                            </select>
                                            <label class="active" for="mes">Mes</label>  
                                        </div>
                                        <div class="input-field col s2">
                                            <button class="btn blue ancho-total margen-ariba" @click="buscarMes()">Mensual</button>
                                        </div>  
                                        <div class="input-field col s2">
                                            <select id="dia" class="browser-default borde" v-model="dia">      
                                                <option value="0" disabled="">Seleccione</option>
                                                <option value="1" v-for="(c, index) of diasContar" v-bind:value="index+1" >{{index+1}}</option>

                                            </select>
                                            <label class="active" for="dia">Dia</label>  
                                        </div>
                                        <div class="input-field col s2">
                                            <button class="btn blue ancho-total margen-ariba" @click="buscarDia()">Dia</button>
                                        </div>  

                                    </div>   

                                    <div class="row no-margen">
                                        <div class="input-field col s4">
                                            <input type="date" id="fecha" v-model="fecha1">
                                            <label for="fecha" class="active">Fecha Inicio</label>
                                        </div>
                                        <div class="input-field col s4">
                                            <input type="date" id="fecha" v-model="fecha2">
                                            <label for="fecha" class="active">Fecha Fin</label>
                                        </div>
                                        <div class="input-field col s4">
                                            <button class="btn blue ancho-total margen-ariba" @click="getFecha()">Buscar Fechas</button>
                                        </div>
                                    </div>

                                    <div class="divider"></div>

                                    <!-- ********************************************************-->

                                    <!-- INFORME VENTAS         ##################################-->

                                    <!-- ********************************************************-->


                                    <!-- AÑO      ##################################-->

                                    <div v-show="buscador == 'año'" class="row no-margen">

                                        <div class="row no-margen">  
                                            <div class="divider"></div>

<!--                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">VENTA CON IVA</h6>                             
                                            </div>
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">${{ventaConIva}}</h6>                             
                                            </div> -->
<!--                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">GANANCIA</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">${{gananciaTotal}}</h6>                             
                                            </div> -->
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">CANTIDAD DE PRODUCTOS VENDIDOS</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">N°{{contarVentas}}</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">TOTAL VENDIDO CON IVA</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">${{totalVentas}}</h6>                             
                                            </div> 
                                            <div class="divider"></div>
                                        </div>

                                        <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                                            <thead>
                                                <tr>
                                                    <th>Codigo</th>
                                                    <th>Vendedor</th>
                                                    <th>Total</th>
                                                    <th>Fecha</th>
                                                    <th>Hora</th>
                                                    <th>Descripcion</th>
                                                    <th>Estado</th>                            
                                                    <th>Detalles</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for='p in ventas'>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.idventa}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.nombre}} {{p.apellido_pat}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">${{p.total}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.fecha}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.hora}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.descripcion}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'" class="finalizada center" >{{p.estado}}</td>


                                                    <td v-show="p.estado == 'FINALIZADA'" class="center"><button class="btn-floating btn-small waves-effect waves-light white-text blue darken-3" @click='modalDetalleFechas(p)'><i class="material-icons">event_note</i></button></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                    <!-- MES        ##################################-->

                                    <div v-show="buscador == 'mes'" class="row no-margen">

                                        <div class="row no-margen">  
                                            <div class="divider"></div>

<!--                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">VENTA CON IVA</h6>                             
                                            </div>
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">${{ventaConIva}}</h6>                             
                                            </div> -->
<!--                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">GANANCIA</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">${{gananciaTotal}}</h6>                             
                                            </div> -->
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">CANTIDAD DE PRODUCTOS VENDIDOS</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">N°{{contarVentas}}</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">TOTAL VENDIDO CON IVA</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">${{totalVentas}}</h6>                             
                                            </div> 
                                            <div class="divider"></div>
                                        </div>

                                        <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                                            <thead>
                                                <tr>
                                                    <th>Codigo</th>
                                                    <th>Vendedor</th>
                                                    <th>Total</th>
                                                    <th>Fecha</th>
                                                    <th>Hora</th>
                                                    <th>Descripcion</th>
                                                    <th>Estado</th>                            
                                                    <th>Detalles</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for='p in ventas'>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.idventa}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.nombre}} {{p.apellido_pat}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">${{p.total}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.fecha}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.hora}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.descripcion}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'" class="finalizada center" >{{p.estado}}</td>


                                                    <td v-show="p.estado == 'FINALIZADA'" class="center"><button class="btn-floating btn-small waves-effect waves-light white-text blue darken-3" @click='modalDetalleFechas(p)'><i class="material-icons">event_note</i></button></td></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                    <!-- DIA        ##################################-->

                                    <div v-show="buscador == 'dia'" class="row no-margen">

                                        <div class="row no-margen">  
                                            <div class="divider"></div>

<!--                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">VENTA CON IVA</h6>                             
                                            </div>
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">${{ventaConIva}}</h6>                             
                                            </div> -->
<!--                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">GANANCIA</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">${{gananciaTotal}}</h6>                             
                                            </div> -->
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">CANTIDAD DE PRODUCTOS VENDIDOS</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">N°{{contarVentas}}</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">TOTAL VENDIDO CON IVA</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">${{totalVentas}}</h6>                             
                                            </div> 
                                            <div class="divider"></div>
                                        </div>

                                        <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                                            <thead>
                                                <tr>
                                                    <th>Codigo</th>
                                                    <th>Vendedor</th>
                                                    <th>Total</th>
                                                    <th>Fecha</th>
                                                    <th>Hora</th>
                                                    <th>Descripcion</th>
                                                    <th>Estado</th>                            
                                                    <th>Detalles</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for='p in ventas'>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.idventa}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.nombre}} {{p.apellido_pat}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">${{p.total}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.fecha}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.hora}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.descripcion}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'" class="finalizada center" >{{p.estado}}</td>


                                                    <td v-show="p.estado == 'FINALIZADA'" class="center"><button class="btn-floating btn-small waves-effect waves-light white-text blue darken-3" @click='modalDetalleFechas(p)'><i class="material-icons">event_note</i></button></td></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>



                                    <!-- FECHA        ##################################-->

                                    <div v-show="buscador == 'fecha'" class="row no-margen">

                                        <div class="row no-margen">  
                                            <div class="divider"></div>

<!--                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">VENTA CON IVA</h6>                             
                                            </div>
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">${{ventaConIva}}</h6>                             
                                            </div> -->
<!--                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">GANANCIA</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">${{gananciaTotal}}</h6>                             
                                            </div> -->
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">CANTIDAD DE PRODUCTOS VENDIDOS</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">N°{{contarVentas}}</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">TOTAL VENDIDO CON IVA</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">${{totalVentas}}</h6>                             
                                            </div> 
                                            <div class="divider"></div>
                                        </div>

                                        <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                                            <thead>
                                                <tr>
                                                    <th>Codigo</th>
                                                    <th>Vendedor</th>
                                                    <th>Total</th>
                                                    <th>Fecha</th>
                                                    <th>Hora</th>
                                                    <th>Descripcion</th>
                                                    <th>Estado</th>                            
                                                    <th>Detalles</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for='p in ventas'>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.idventa}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.nombre}} {{p.apellido_pat}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">${{p.total}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.fecha}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.hora}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'">{{p.descripcion}}</td>
                                                    <td v-show="p.estado == 'FINALIZADA'" class="finalizada center" >{{p.estado}}</td>


                                                    <td v-show="p.estado == 'FINALIZADA'" class="center"><button class="btn-floating btn-small waves-effect waves-light white-text blue darken-3" @click='modalDetalleFechas(p)'><i class="material-icons">event_note</i></button></td></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                                <div v-show="opcVenta == 2">
                                    <div class="row no-margen center">
                                        <div class="input-field col s6">
                                            <h5 class="center no-margen">{{titulo2}}</h5> 

                                        </div>
                                        <div class="input-field col s6">
                                            <button type="submit" class="btn waves-effect waves-light  blue darken-3" @click='limpiar()'>LIMPIAR</button>                                            
                                        </div>
                                    </div>
                                    <div class="row no-margen">
                                        <div class="input-field col s6">
                                            <input type="number" id="idprod" v-model="idproducto" />
                                            <label class="active" for="idprod">ID Producto</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <button class="btn blue ancho-total" @click="cargarModalBuscarId()">Buscar ID</button>
                                        </div>
                                    </div>

                                    <div class="row no-margen">
                                        <div class="input-field col s3">
                                            <select id="mes" class="browser-default borde" v-model="mes">      
                                                <option value="0" disabled="">Seleccione</option>
                                                <option value="01" >Enero</option>
                                                <option value="02" >Febrero</option>
                                                <option value="03" >Marzo</option>
                                                <option value="04" >Abril</option>
                                                <option value="05" >Mayo</option>
                                                <option value="06" >Junio</option>
                                                <option value="07" >Julio</option>
                                                <option value="08" >Agosto</option>
                                                <option value="09" >Septiembre</option>
                                                <option value="10" >Octubre</option>
                                                <option value="11" >Noviembre</option>
                                                <option value="12" >Diciembre</option>
                                            </select>
                                            <label class="active" for="mes">Mes</label>  
                                        </div>
                                        <div class="input-field col s3">
                                            <button class="btn blue ancho-total margen-ariba" @click="getMesIdProducto()">Mensual</button>
                                        </div>  
                                        <div class="input-field col s3">
                                            <select id="dia" class="browser-default borde" v-model="dia">      
                                                <option value="0" disabled="">Seleccione</option>
                                                <option value="1" v-for="(c, index) of diasContar" v-bind:value="index+1" >{{index+1}}</option>

                                            </select>
                                            <label class="active" for="dia">Dia</label>  
                                        </div>
                                        <div class="input-field col s3">
                                            <button class="btn blue ancho-total margen-ariba" @click="getDiasIdProducto()">Dia</button>
                                        </div>  
                                    </div>                                        

                                    <div class="row no-margen">  
                                        <div class="divider"></div>

<!--                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen">VENTA CON IVA</h6>                             
                                        </div>
                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen center negra">${{ventaConIva}}</h6>                             
                                        </div> -->
<!--                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen">GANANCIA</h6>                             
                                        </div> 
                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen center negra">${{gananciaTotal}}</h6>                             
                                        </div> -->
                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen">CANTIDAD DE PRODUCTOS VENDIDOS</h6>                             
                                        </div> 
                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen center negra">N°{{contarVentas}}</h6>                             
                                        </div> 
                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen">TOTAL VENDIDO CON IVA</h6>                             
                                        </div> 
                                        <div class="input-field col s6 no-marge-top">
                                            <h6 class="no-margen center negra">${{totalVentas}}</h6>                             
                                        </div> 
                                        <div class="divider"></div>
                                    </div>

                                    <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                                        <thead>
                                            <tr>
                                                <th>ID Venta</th>
                                                <th>Nombre</th>
                                                <th>Detalles</th>
                                                <th>Fecha</th>
                                                <th>cantidad</th>                                                    
                                                <th>Precio Venta</th>
                                                <th>Total</th>                            

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for='p in productoMes'>
                                                <td>{{p.idventa}}</td>
                                                <td>{{p.nombre}}</td>
                                                <td>{{p.descripcion}}</td>
                                                <td>{{p.detalle_fecha}}</td>
                                                <td>{{p.cantidad}}</td>
                                                <td>${{p.p_venta}}</td>
                                                <td>${{p.TotalVentas}}</td>                                  
                                            </tr>
                                        </tbody>
                                    </table>




                                </div> <!-- FIN PRODUCTO MES BLOQUE   -->

                                <div v-show="opcVenta == '3'">
                                    <div class="row no-margen">
                                        <div class="row no-margen center">
                                            <div class="input-field col s6">
                                                <h5 class="center no-margen">{{titulo2}}</h5> 

                                            </div>
                                            <div class="input-field col s6">
                                                <button type="submit" class="btn waves-effect waves-light  blue darken-3" @click='limpiar()'>LIMPIAR</button>                                            
                                            </div>
                                        </div>
                                        <div class="row no-margen">
                                            <div class="input-field col s6">
                                                <input type="number" id="idventa" v-model="idventa" />
                                                <label class="active" for="idventa">ID Venta</label>
                                            </div>
                                            <div class="input-field col s6">
                                                <button class="btn blue ancho-total" @click="buscarVentaId()">Buscar ID</button>
                                            </div>
                                        </div>

                                        <div class="row no-margen">  
                                            <div class="divider"></div>

<!--                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">VENTA CON IVA</h6>                             
                                            </div>
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">${{ventaConIva}}</h6>                             
                                            </div> -->
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">DESCUENTO</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">{{descuentoid}}%</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">CANTIDAD DE PRODUCTOS VENDIDOS</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">N°{{contarVentas}}</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen">TOTAL VENDIDO CON IVA</h6>                             
                                            </div> 
                                            <div class="input-field col s6 no-marge-top">
                                                <h6 class="no-margen center negra">${{totalVentas}}</h6>                             
                                            </div> 
                                            <div class="divider"></div>
                                        </div>


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
                                                    <td v-if="p.estado == 'En Tramite'" class="entramite center" >{{p.estado}}</td>
                                                    <td v-if="p.estado == 'FINALIZADA'" class="finalizada center" >{{p.estado}}</td>
                                                    <td v-if="p.estado == 'ANULADA'" class="yellow center" >{{p.estado}}</td>

                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="row no-margen">

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
                                                        <td>{{p.idproducto}}</td>
                                                        <td>{{p.nombre}}</td>
                                                        <td>{{p.cantidad}}</td>
                                                        <td>${{p.p_venta}}</td>
                                                        <td>${{p.totalProd}}</td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                                <!-- FIN VENTAS BLOQUE   -->
                            </div>








                            <div v-show="opc == 2">

                                <div class="row no-margen">
                                    <div class="row no-margen center">
                                        <div class="input-field col s6">
                                            <h5 class="center no-margen">{{titulo2}}</h5> 

                                        </div>
                                        <div class="input-field col s6">
                                            <button type="submit" class="btn waves-effect waves-light  blue darken-3" @click='limpiar()'>LIMPIAR</button>                                            
                                        </div>
                                    </div>
                                    <div class="row no-margen">
                                        <div class="input-field col s6">
                                            <input type="number" id="idventa" v-model="idfactura" />
                                            <label class="active" for="idventa">N° Factura</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <button class="btn blue ancho-total" @click="buscarFacturaId()">Buscar ID</button>
                                        </div>
                                    </div>                                       


                                    <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>N° Factura</th>
                                                <th>NETO</th>
                                                <th>IVA</th>
                                                <th>TOTAL</th>
                                                <th>Cantidad Pro</th>
                                                <th>Cantidad Uni</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for='p in factura'>
                                                <td>{{p.idfactura}}</td>
                                                <td>{{p.codigo}}</td>
                                                <td>${{p.neto}}</td>
                                                <td>${{p.iva}}</td>
                                                <td>${{p.total}}</td>
                                                <td>{{p.cantidad}}</td>
                                                <td>{{p.cantidadT}}</td>
                                                <td v-if="p.estado == 'En Tramite'" class="entramite center" >{{p.estado}}</td>
                                                <td v-if="p.estado == 'FINALIZADA'" class="finalizada center" >{{p.estado}}</td>
                                                <td v-if="p.estado == 'ANULADA'" class="yellow center" >{{p.estado}}</td>

                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="row no-margen">

                                        <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Cantidad</th>
                                                    <th>Fecha</th>
                                                    <th>P. Neto</th>
                                                    <th>IVA</th>
                                                    <th>P. Venta+IVA</th>
                                                    <td>Total</td>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for='p in facturaP'>
                                                    <td>{{p.idproducto}}</td>
                                                    <td>{{p.nombre}}</td>
                                                    <td>{{p.cantidad}}</td>
                                                    <td>${{p.producto_factura_fecha}}</td>
                                                    <td>${{p.p_compra}}</td>
                                                    <td>${{p.iva}}</td>
                                                    <td>${{p.p_ventaconiva}}</td>
                                                    <td>${{p.p_totalCompra}}</td>    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>

                            <div v-show="opc == 3">       


                                <div class="row no-margen center">
                                    <div class="input-field col s6">
                                        <h5 class="center no-margen">{{titulo2}}</h5> 

                                    </div>
                                    <div class="input-field col s6">
                                        <button type="submit" class="btn waves-effect waves-light  blue darken-3" @click='limpiar()'>LIMPIAR</button>                                            
                                    </div>
                                </div>
                                <div class="divider"></div> 
                                <div class="row no-margen">
                                    <div class="input-field col s6">
                                        <input type="number" id="idventa" v-model="idguia" />
                                        <label class="active" for="idventa">N° Guia</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <button class="btn blue ancho-total" @click="cargarGuia()">Buscar Guia</button>
                                    </div>
                                </div>
                                <div class="row no-margen">
                                    <div class="input-field col s6">
                                        <input type="text" id="idventa" v-model="idcliente" />
                                        <label class="active" for="idventa">Rut cliente</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <button class="btn blue ancho-total" @click="modalBuscarCliente()">Buscar Cliente</button>
                                    </div>
                                </div>  
                                <div class="row no-margen">
                                    <div class="input-field col s3">
                                        <select id="mes" class="browser-default borde" v-model="mes">      
                                            <option value="0" disabled="">Seleccione</option>
                                            <option value="01" >Enero</option>
                                            <option value="02" >Febrero</option>
                                            <option value="03" >Marzo</option>
                                            <option value="04" >Abril</option>
                                            <option value="05" >Mayo</option>
                                            <option value="06" >Junio</option>
                                            <option value="07" >Julio</option>
                                            <option value="08" >Agosto</option>
                                            <option value="09" >Septiembre</option>
                                            <option value="10" >Octubre</option>
                                            <option value="11" >Noviembre</option>
                                            <option value="12" >Diciembre</option>
                                        </select>
                                        <label class="active" for="mes">Mes</label>  
                                    </div>
                                    <div class="input-field col s3">
                                        <button class="btn blue ancho-total margen-ariba" @click="guiaMes()">Mensual</button>
                                    </div>  
                                    <div class="input-field col s3">
                                        <select id="dia" class="browser-default borde" v-model="dia">      
                                            <option value="0" disabled="">Seleccione</option>
                                            <option value="1" v-for="(c, index) of diasContar" v-bind:value="index+1" >{{index+1}}</option>

                                        </select>
                                        <label class="active" for="dia">Dia</label>  
                                    </div>
                                    <div class="input-field col s3">
                                        <button class="btn blue ancho-total margen-ariba" @click="guiaDia()">Dia</button>
                                    </div>  
                                </div>   
                                <div class="row no-margen">
                                    <div class="input-field col s4">
                                        <input type="date" id="fecha" v-model="fecha1">
                                        <label for="fecha" class="active">Fecha Inicio</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <input type="date" id="fecha" v-model="fecha2">
                                        <label for="fecha" class="active">Fecha Fin</label>
                                    </div>
                                    <div class="input-field col s4">
                                        <button class="btn blue ancho-total margen-ariba" @click="guiaFecha()">Buscar Fechas</button>
                                    </div>
                                </div>

                                <div class="row no-margen">  
                                    <div class="divider"></div>

<!--                                    <div class="input-field col s6 no-marge-top">
                                        <h6 class="no-margen">VENTA CON IVA</h6>                             
                                    </div>
                                    <div class="input-field col s6 no-marge-top">
                                        <h6 class="no-margen center negra">${{ventaConIva}}</h6>                             
                                    </div> -->
<!--
                                    <div class="divider"></div>-->
                                </div>

                                <table class="zui-table-highlight zui-table zui-table-horizontal borde-tabla">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Vendedor</th>
                                            <th>Cliente</th>
                                            <th>Rut Cliente</th>
                                            <th>Giro</th>
                                            <th>Total</th>
                                            <th>N° Guia</th>
                                            <th>Fecha</th>
                                            <th>Hora</th>                                                        
                                            <th>Estado</th>                            
                                            <th>Detalles</th>
                                            <th>Finalizar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for='p in guias'>
                                            <td>{{p.idventa}}</td>
                                            <td>{{p.usuario_nombre}} {{p.usuario_apellido_pat}}</td>
                                            <td>{{p.cliente_nombre}} {{p.cliente_apellido_pat}}</td>
                                            <td>{{p.cliente_rut}}</td>
                                            <td>{{p.giro}}</td>
                                            <td>${{p.total}}</td>
                                            <td>{{p.nguia}}</td>
                                            <td>{{p.fecha}}</td>
                                            <td>{{p.hora}}</td>                                                        
                                            <td v-show="p.estado == 'FINALIZADA'" class="finalizada center" >{{p.estado}}</td>
                                            <td v-show="p.estado == 'ANULADA'" class="yellow center" >{{p.estado}}</td>
                                            <td v-show="p.estado == 'En Tramite'" class="entramite center" >{{p.estado}}</td>
                                            <td class="center"><button class="btn-floating btn-small waves-effect waves-light white-text blue darken-3" @click='modalDetalleFechas(p)'><i class="material-icons">event_note</i></button></td>
                                            <td v-if='p.estado == "En Tramite"' class="center"><button class="btn-floating btn-small waves-effect waves-light white-text green " @click='finalizarGuia(p)'><i class="material-icons">check</i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>  <!-- FIN GUIAS -->


                        </div>
                    </div>

            </main>

          <pre>{{$data}}</pre>
        </div>

        <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-3.2.1.min.js" ></script> 
        <script type="text/javascript" src="<?= base_url() ?>assets/js/axios.min.js" ></script>       
        <!-- development version, includes helpful console warnings -->
        <script type="text/javascript" src="<?= base_url() ?>assets/js/vue.js" ></script> 
        <script src="<?= base_url() ?>assets/js/materialize.min.js"></script>
        <script type="text/javascript" charset="utf8" src="<?= base_url() ?>assets/js/datatables.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/js/informe.js"></script>
    </body>
</html>