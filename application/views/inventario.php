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
            margin-top: 10px;
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
        .colortabla{

            background-color: rgba(25, 200, 120, 0.45);   
        }
        .ancho-boton {
            width: 100%;
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

            <!-- MODAL AGREGAR PRODUCTOS#################################-->

            <!-- ********************************************************-->

            <div id="agregarProduct" class="modal">
                <div class="modal-content">                    
                    <h5 class="center">Consultar Productos</h5>
                    <div class="divider"></div> 
                    <div class="row">

                        <div class="input-field col s12">
                            <input type="text" placeholder="Buscar por nombre o precio Compra neto" v-model='name' id='buscar'>
                            <label class="active" for="buscar">Buscar</label>
                        </div>
                        <table class="bordered zui-table zui-table-horizontal zui-table-highlight centered">
                            <thead>
                                <tr>                                                                        
                                    <th>Nombre</th>
                                    <th>Desc</th>
                                    <th>Stock</th>
                                    <th>P. Compra Neto</th>
                                    <th>IVA</th>
                                    <th>P. Venta C/ IVA</th>                                         
                                    <th>P. Venta S/ IVA</th>

                                </tr>
                            </thead>
                            <tbody v-for='(p, i) in buscarUsuario'>
                                <tr>                                                                       
                                    <td class="teal lighten-5">{{p.nombre}}</td>
                                    <td>{{p.descripcion}}</td>
                                    <td>{{p.stock}}</td>
                                    <td>${{p.p_compra}}</td>
                                    <td>${{p.iva}}</td>
                                    <td class="teal lighten-5">${{p.p_venta}}</td> 
                                    <td>${{p.p_ventaconiva}}</td>                                   

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

            <!-- MODAL AGREGAAR STOCK ##########################################-->

            <!-- ********************************************************-->

            <div id="editarProducto" class="modal">
                <div class="modal-content">                    
                    <h5 class="center">Agregar Stock</h5>
                    <div class="divider"></div> 
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="number" id="stock" v-model="stockAgregar" class="center" >
                            <label class="active" for="stock">Stock</label>                                
                        </div>

                        <div class="center">
                            <button class="btn white-text red" @click="agregarStock()">ACTUALIZAR</button>
                            <button class="btn white-text green" @click="cerrarModalEditarProducto()">CANCELAR</button>
                        </div>                         
                    </div>                       

                </div>
            </div>




            <!-- ********************************************************-->

            <!-- MODAL AGREGAR CATEGORIA ################################-->

            <!-- ********************************************************-->

            <div id="agregarCategoria" class="modal">
                <div class="modal-content">                    
                    <h5 class="center">CREAR CATEGORIA</h5>
                    <div class="divider"></div> 
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="nombre" v-model="nombreCat" >
                            <label for="nombre">Nombre Categoria</label>                                
                        </div>

                        <div class="input-field col s6">
                            <input type="text" id="detalle" v-model="detalleCat" >
                            <label for="detalle">Detalle Categoria</label>                                
                        </div>

                        <div class="center">
                            <button class="btn white-text red" @click="crearCategoria()">CREAR</button>
                            <button class="btn white-text green" @click="cerrarModal()">CANCELAR</button>
                        </div>                         
                    </div>                       

                </div>
            </div>

            <!-- ********************************************************-->

            <!-- MODAL AGREGAR MARCA ################################-->

            <!-- ********************************************************-->

            <div id="agregarMarca" class="modal">
                <div class="modal-content">                    
                    <h5 class="center">CREAR MARCA</h5>
                    <div class="divider"></div> 
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="nombrem" v-model="nombreMar" >
                            <label for="nombrem">Nombre Marca</label>                                
                        </div>

                        <div class="input-field col s6">
                            <input type="text" id="descripcionm" v-model="descripcionMar" >
                            <label for="descripcionm">Detalle Marca</label>                                
                        </div>

                        <div class="center">
                            <button class="btn white-text red" @click="crearMarca()">CREAR</button>
                            <button class="btn white-text green" @click="cerrarModal()">CANCELAR</button>
                        </div>                         
                    </div>                            

                </div>
            </div>

            <!-- ********************************************************-->

            <!-- INICIO MAIN ##########################################-->

            <!-- ********************************************************-->


            <main>
            
                    <div class="row">
                        <div class="col s12">
                            <div class="card-panel">      
                                <div class="center">
                                    <h5 class="center">{{titulo}}</h5>                                        
                                    <div class="divider"></div>                                   
                                    <button v-if="sesion[0].tipo == 'admin'" type="submit" class="btn waves-effect waves-light  blue darken-3" @click='cambiarOpc(1)'>AGREGAR PRODUCTOS</button>
                                    <button v-if="sesion[0].tipo == 'admin'"type="submit" class="btn waves-effect waves-light  blue darken-3" @click='modalCategoria()'>AGREGAR CATEGORIAS</button>
                                    <button v-if="sesion[0].tipo == 'admin'"type="submit" class="btn waves-effect waves-light  blue darken-3" @click='modalMarca()'>AGREGAR MARCAS</button>
                                    <button type="submit" class="btn waves-effect waves-light  blue darken-3" @click='cambiarOpc(2)'>LISTA PRODUCTOS</button>
                                    <button type="submit" class="btn waves-effect waves-light  blue darken-3" @click='enviar()'>EXPORTAR A EXCEL</button>
                                    <div class="divider"></div>
                                </div>

                                <div v-show="opc == 1" class="row borde">


                                    <div class="input-field col s5">
                                        <input type="text" id="nombre" v-model="nombre">
                                        <label class="active" for="nombre">Nombre</label>                                
                                    </div>
                                    <div class="input-field col s2">
                                        <button class="btn ancho-boton green" @click='consultarNombre()'>Consultar</button>
                                    </div>
                                    <div class="input-field col s5">
                                        <input type="text" id="stock" v-model="stock">
                                        <label class="active" for="stock">Stock</label>                                
                                    </div>
                                    <div class="input-field col s6">
                                        <input type="text" id="desc" v-model="descripcion">
                                        <label class="active" for="desc">Descripción</label>                                
                                    </div>
                                    <div class="input-field col s2">
                                        <input type="number" id="p_compra" v-model="p_compra" >
                                        <label class="active" for="p_compra">Precio Compra</label>                                
                                    </div>  
                                    <div class=" input-field col s2">
                                        <input type="number" id="ganancia" v-model="ganancia">
                                        <label class="active" for="ganancia">% Ganancia</label>    
                                    </div>
                                    <div class="input-field col s2">
                                        <button class="btn green" @click='calcularGanancia()'>Calcular</button>
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
                                        <select id="cat" class="browser-default borde" v-model="categoria">      
                                            <option value="" disabled="">Seleccione</option>
                                            <option v-for="c in comboCategoria" v-bind:value="c.idcategoria">{{c.nombre}}</option>
                                        </select>
                                        <label class="active" for="cat">Categoria</label>  
                                    </div>
                                    <div class="input-field col s6">
                                        <select id="marca" class="browser-default borde" v-model="marca">    
                                            <option value="" disabled="">Seleccione</option>                                            
                                            <option v-for="m in comboMarca" v-bind:value="m.idmarca">{{m.nombre}}</option>
                                        </select>
                                        <label class="active" for="marca">Marca</label>   
                                    </div>


                                    <div class="row center no-margen">
                                        <div class="col s12">
                                            <button class="btn white-text green" @click="insertarProducto()">AGREGAR</button>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div v-show="opc == 2" class="row">
                                    <div class="input-field col s12">
                                        <input type="text" placeholder="Buscar por nombre, Precio" v-model='name' id='buscar'>
                                        <label class="active" for="buscar">Buscar</label>
                                    </div>
                                    <table class="bordered zui-table zui-table-horizontal zui-table-highlight centered">
                                        <thead>
                                            <tr>                                               
                                                <th>Nombre</th>
                                                <th>Desc</th>
                                                <th>Stock</th>
                                                <th>Costo Neto </th>
                                                <th>IVA</th>
                                                <th>Precio Compra + IVA</th>
                                                <th>Precio Venta</th>
                                                <th v-if="sesion[0].tipo == 'admin'">Eliminar</th>
                                                <th v-if="sesion[0].tipo == 'admin'">Agregar Stock</th>
                                                <th v-if="sesion[0].tipo == 'admin'">Editar</th>
<!--                                                <th v-if="sesion[0].tipo == 'admin'">Detalles</th>-->
                                            </tr>
                                        </thead>
                                        <tbody v-for='p in buscarUsuario'>
                                            <tr>                                                
                                                <td>{{p.nombre}}</td>
                                                <td>{{p.descripcion}}</td>

                                                <td v-if="p.stock >= 6 && p.stock <= 1000000" class="green lighten-2">{{p.stock}}</td>
                                                <td v-if="p.stock >= 1 && p.stock <= 5" class="yellow darken-2">{{p.stock}}</td>
                                                <td v-if="p.stock == 0" class="red">{{p.stock}}</td>                                                
                                                <td>${{p.p_compra}}</td>
                                                <td>{{p.iva}}</td>
                                                <td>{{p.p_ventaconiva}}</td>
                                                <td class="teal lighten-5">${{p.p_venta}}</td>
                                                <td v-if="sesion[0].tipo == 'admin'"><button class="btn-floating btn-small waves-effect waves-light white-text red" @click='eliminarProducto(p)' ><i class="material-icons">close</i></button></td>
                                                <td v-if="sesion[0].tipo == 'admin'"><button class="btn-floating btn-small waves-effect waves-light white-text yellow darken-3" @click='cargarModalEditar(p)'><i class="material-icons">add</i></button></td>
                                                <td v-if="sesion[0].tipo == 'admin'"><button class="btn-floating btn-small waves-effect waves-light white-text teal darken-3" @click='modalEditarProducto(p)'><i class="material-icons">edit</i></button></td>
<!--                                                <td v-if="sesion[0].tipo == 'admin'"><button class="btn-floating btn-small waves-effect waves-light white-text blue accent-2" @click='' ><i class="material-icons">event_note</i></button></td>-->
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


        <!-- ***********************************************************-->

        <!-- COMIENZO MAIN  ********************************************-->

        <!-- ***********************************************************-->


        <!--JavaScript at end of body for optimized loading-->    

<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-3.2.1.min.js" ></script> 
        <script type="text/javascript" src="<?= base_url() ?>assets/js/axios.min.js" ></script>       
        <!-- development version, includes helpful console warnings -->
        <script type="text/javascript" src="<?= base_url() ?>assets/js/vue.js" ></script>  
        <script src="<?= base_url() ?>assets/js/materialize.min.js"></script>
        <script type="text/javascript" charset="utf8" src="<?= base_url() ?>assets/js/datatables.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/js/inventario.js"></script>

    </body>
</html>
