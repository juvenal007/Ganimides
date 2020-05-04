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
        #borde{
            border: #000 solid 1px;
            padding: 15px;
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

        .hvr-bubble-bottom-green {
            display: inline-block;
            vertical-align: middle;
            -webkit-transform: perspective(1px) translateZ(0);
            transform: perspective(1px) translateZ(0);
            box-shadow: 0 0 1px rgba(0, 0, 0, 0);
            position: relative;
        }
        .hvr-bubble-bottom-green:before {
            pointer-events: none;
            position: absolute;
            z-index: -1;
            content: '';
            border-style: solid;
            -webkit-transition-duration: 0.3s;
            transition-duration: 0.3s;
            -webkit-transition-property: transform;
            transition-property: transform;
            left: calc(50% - 10px);
            bottom: 0;
            border-width: 10px 10px 0 10px;
            border-color: #2e7d32 transparent transparent transparent;
        }
        .hvr-bubble-bottom-green:hover:before, .hvr-bubble-bottom-green:focus:before, .hvr-bubble-bottom-green:active:before {
            -webkit-transform: translateY(10px);
            transform: translateY(10px);
        }
        .hvr-bubble-bottom-blue {
            display: inline-block;
            vertical-align: middle;
            -webkit-transform: perspective(1px) translateZ(0);
            transform: perspective(1px) translateZ(0);
            box-shadow: 0 0 1px rgba(0, 0, 0, 0);
            position: relative;
        }
        .hvr-bubble-bottom-blue:before {
            pointer-events: none;
            position: absolute;
            z-index: -1;
            content: '';
            border-style: solid;
            -webkit-transition-duration: 0.3s;
            transition-duration: 0.3s;
            -webkit-transition-property: transform;
            transition-property: transform;
            left: calc(50% - 10px);
            bottom: 0;
            border-width: 10px 10px 0 10px;
            border-color: #1565c0  transparent transparent transparent;
        }
        .hvr-bubble-bottom-blue:hover:before, .hvr-bubble-bottom-blue:focus:before, .hvr-bubble-bottom-blue:active:before {
            -webkit-transform: translateY(10px);
            transform: translateY(10px);
        }
        strong{
            font-size: 18px;
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

                <div id="editar" class="modal editar">
                    <div class="modal-content">                    
                        <h5 class="center">Editar Proveedor</h5>
                        <div class="divider"></div> 
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" id="rut" v-model="modalProveedor.rut" >
                                <label class="active" for="rut">Rut</label>                                
                            </div>
                            <div class="input-field col s6">
                                <input type="text" id="nom2" v-model="modalProveedor.nombre">
                                <label class='active' for="nom2">Nombre</label>                                
                            </div>
                            <div class="input-field col s6">
                                <input type="text" id="ape_pat2" v-model="modalProveedor.apellido_pat">
                                <label class='active' for="ape_pat2">Apellido Paterno</label>                                
                            </div>
                            <div class="input-field col s6">
                                <input type="text" id="ape_mat2" v-model="modalProveedor.apellido_mat">
                                <label class='active' for="ape_mat2">Apellido Materno</label>                                
                            </div>
                            <div class="input-field col s6">
                                <input type="text" id="rut_empresa2" v-model="modalProveedor.rut_empresa">
                                <label class='active' for="rut_empresa2">Rut Empresa</label>                                
                            </div>
                            <div class="input-field col s6">
                                <input type="text" id="empresa2" v-model="modalProveedor.empresa" >
                                <label class="active" for="empresa2">Nombre Empresa</label>                                
                            </div>                                    
                            <div class="input-field col s6">
                                <input type="number" id="tel12" v-model="modalProveedor.telefono1">
                                <label class="active" for="tel12">Telefono 1</label>                                
                            </div>

                            <div class="input-field col s6">
                                <input type="number" id="tel22" v-model="modalProveedor.telefono2">
                                <label class="active" for="tel22">Telefono 2</label>                                
                            </div>
                            <div class="input-field col s6">
                                <input type="text" id="ciudad2" v-model="modalProveedor.ciudad">
                                <label class="active" for="ciudad2">Ciudad</label>                                
                            </div>      
                            <div class="input-field col s6">
                                <input type="text" id="direccion2" v-model="modalProveedor.direccion">
                                <label class="active" for="direccion2">Direccion</label>                                
                            </div>   
                            <div class="input-field col s12">
                                <input type="text" id="gir2" v-model="modalProveedor.giro">
                                <label class="active" for="gir2">Giro</label>                                
                            </div> 
                            <div class="center">
                                <button class="btn white-text red" @click="actualizarProveedor()">ACTUALIZAR</button>
                                <button class="btn white-text green" @click="cerrarModal()">CANCELAR</button>
                            </div>                         
                        </div>                       

                    </div>
                </div>


                <!-- ********************************************************-->

                <!-- MODAL DETALLES #########################################-->

                <!-- ********************************************************-->


                <div id="detalles" class="modal detalle">
                    <div class="modal-content">                    
                        <h5 class="center">DETALLE PROVEEDOR</h5>
                        <div class="divider"></div> 
                        <div class="row">
                            <div class="card-panel">
                                <div class="row">
                                    <div class="col s4 m5 l4">
                                        <strong>ID</strong><br> 
                                        <strong>Rut</strong><br> 
                                        <strong>Nombre</strong><br> 
                                        <strong>Apellido Paterno</strong><br>
                                        <strong>Apellido Materno</strong><br>
                                        <strong>Telefono 1</strong><br>
                                        <strong>Telefono 2</strong><br>
                                        <strong>Rut Empresa</strong><br>
                                        <strong>Nombre Empresa</strong><br>
                                        <strong>Ciudad</strong><br>
                                        <strong>Dirección</strong><br>
                                        <strong>Giro</strong><br>

                                    </div>
                                    <div class="col s1 m1 l1">
                                        <strong>:</strong><br> 
                                        <strong>:</strong><br> 
                                        <strong>:</strong><br> 
                                        <strong>:</strong><br>
                                        <strong>:</strong><br> 
                                        <strong>:</strong><br> 
                                        <strong>:</strong><br> 
                                        <strong>:</strong><br>
                                        <strong>:</strong><br> 
                                        <strong>:</strong><br> 
                                        <strong>:</strong><br>   
                                        <strong>:</strong><br>
                                    </div>
                                    <div class="col s8 m6 l7">
                                        <strong>{{modalProveedor.idproveedor}}</strong><br>
                                        <strong>{{modalProveedor.rut}}</strong><br>
                                        <strong>{{modalProveedor.nombre}}</strong><br>
                                        <strong>{{modalProveedor.apellido_pat}}</strong><br>
                                        <strong>{{modalProveedor.apellido_pat}}</strong><br>
                                        <strong>{{modalProveedor.telefono1}}</strong><br>
                                        <strong>{{modalProveedor.telefono2}}</strong><br>
                                        <strong>{{modalProveedor.rut_empresa}}</strong><br>
                                        <strong>{{modalProveedor.empresa}}</strong><br>
                                        <strong>{{modalProveedor.ciudad}}</strong><br>
                                        <strong>{{modalProveedor.direccion}}</strong><br>
                                        <strong>{{modalProveedor.giro}}</strong><br>
                                    </div>
                                </div>

                            </div>
                        </div>




                    </div>
                </div>


                <!-- ********************************************************-->

                <!-- INICIO CUERPO ##########################################-->

                <!-- ********************************************************-->



                <div class="row">
                    <div class="col s12">
                        <div class="card-panel">      
                            <div class="center">
                                <h5 class="center">{{titulo}}</h5>                                        
                                <div class="divider"></div>                                   
                                <button v-if="sesion[0].tipo == 'admin' || sesion[0].tipo == 'caja'" type="submit" class="hvr-bubble-bottom-blue btn blue darken-3" @click='opc(1)'>AGREGAR PROVEEDOR</button>
                                <button type="submit" class="hvr-bubble-bottom-blue btn blue darken-3" @click="opc(2)" >LISTA PROVEEDORES</button>
                                <div class="divider"></div>
                            </div>

                            <div v-if="ope == 1" class="row" id="borde">
                                <div class="input-field col l6">
                                    <input type="text" id="rut" v-model="rut">
                                    <label class='active' for="rut">Rut</label>                                
                                </div>
                                <div class="input-field col l6">
                                    <input type="text" id="nom" v-model="nombre">
                                    <label class='active' for="nom">Nombre</label>                                
                                </div>
                                <div class="input-field col l6">
                                    <input type="text" id="ape_pat" v-model="apellido_pat">
                                    <label class='active' for="ape_pat">Apellido Paterno</label>                                
                                </div>
                                <div class="input-field col l6">
                                    <input type="text" id="ape_mat" v-model="apellido_mat">
                                    <label class='active' for="ape_mat">Apellido Materno</label>                                
                                </div>
                                <div class="input-field col l6">
                                    <input type="text" id="rut_empresa" v-model="rutEmpresa">
                                    <label class='active' for="rut_empresa">Rut Empresa</label>                                
                                </div>
                                <div class="input-field col l6">
                                    <input type="text" id="empresa" v-model="empresa" >
                                    <label class='active' for="empresa">Nombre Empresa</label>                                
                                </div>                                    
                                <div class="input-field col l6">
                                    <input type="number" id="tel1" v-model="tel1">
                                    <label class='active' for="tel1">Telefono 1</label>                                
                                </div>

                                <div class="input-field col l6">
                                    <input type="number" id="tel2" v-model="tel2">
                                    <label class='active' for="tel2">Telefono 2</label>                                
                                </div>
                                <div class="input-field col l6">
                                    <input type="text" id="ciudad" v-model="ciudad">
                                    <label class='active' for="ciudad">Ciudad</label>                                
                                </div>      
                                <div class="input-field col l6">
                                    <input type="text" id="direccion" v-model="direccion">
                                    <label class='active' for="direccion">Direccion</label>                                
                                </div>  
                                <div class="input-field col l12">
                                    <input type="text" id="gir" v-model="giro">
                                    <label class='active' for="gir">Giro</label>                                
                                </div>
                                <div class="center">
                                    <button class="btn white-text green" @click="agregarProveedor()">AGREGAR</button>
                                </div>                                  
                            </div>

                            <table v-if="ope == 2" class="zui-table zui-table-horizontal zui-table-highlight">
                                <thead>
                                    <tr>
                                        <th>Rut</th>
                                        <th>Nombre</th>
                                        <th>Telefono 1</th>
                                        <th>Giro</th>
                                        <th>Ciudad</th>
                                        <th v-if="sesion[0].tipo == 'admin' || sesion[0].tipo == 'caja'">Eliminar</th>
                                        <th v-if="sesion[0].tipo == 'admin' || sesion[0].tipo == 'caja'">Editar</th>
                                        <th>Detalles</th>
                                    </tr>
                                </thead>
                                <tbody v-for='p in proveedor'>
                                    <tr>
                                        <td>{{p.rut}}</td>
                                        <td>{{p.nombre}}</td>
                                        <td>{{p.telefono1}}</td>
                                        <td>{{p.giro}}</td>
                                        <td>{{p.ciudad}}</td>
                                        <td v-if="sesion[0].tipo == 'admin' || sesion[0].tipo == 'caja'"><button class="btn-floating btn-small waves-effect waves-light white-text red" @click='eliminarProveedor(p)' ><i class="material-icons">close</i></button></td>
                                        <td v-if="sesion[0].tipo == 'admin' || sesion[0].tipo == 'caja'"><button class="btn-floating btn-small waves-effect waves-light white-text yellow darken-3" @click='cargarModalEditar(p)'><i class="material-icons">edit</i></button></td>
                                        <td><button class="btn-floating btn-small waves-effect waves-light white-text blue accent-2" @click='cargarModalDetalle(p)' ><i class="material-icons">event_note</i></button></td>
                                    </tr>
                                </tbody>
                            </table>      


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
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="<?= base_url() ?>assets/js/materialize.min.js" async></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/js/proveedor.js" async></script>


    </body>
</html>