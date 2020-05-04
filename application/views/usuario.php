<!-- LLAMAR A LA SESION ADMIN -->
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
        .divider-lateral{
            padding: 1px !important;
            margin: 1px !important;
            background-color: rgba(4, 7, 25, 0.7);
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
            border: #000 solid 2px;
            padding: 15px;
        }
        .borde-at{            
            margin-top: 10px;
            margin-bottom: 10px;

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
             
                    <div class="row">
                        <div class="col s12">
                            <div class="card-panel">                          

                                <div class="center">
                                    <h5 class="center">{{titulo}}</h5>                                        
                                    <div class="divider"></div>                                   
                                    <button v-if="sesion[0].tipo == 'admin' || sesion[0].tipo == 'caja'" type="submit" class="borde-at hvr-bubble-bottom-blue btn blue darken-3" @click='opc(1)'>AGREGAR USUARIO</button>
                                    <button type="submit" class="borde-at hvr-bubble-bottom-blue btn blue darken-3" @click="opc(2)" >LISTA USUARIOS</button>
                                    <div class="divider"></div>
                                </div>

                                <div v-if='ope == 1'>

                                    <div class="row" id="borde">
                                        <div class="input-field col s6">
                                            <input type="text" id="rut" v-model="rut">
                                            <label class="active" for="rut">Rut</label>                                
                                        </div>
                                        <div class="input-field col s6">
                                            <input type="text" id="nom" v-model="nombre">
                                            <label class='active' for="nom">Nombre</label>                                
                                        </div>
                                        <div class="input-field col s6">
                                            <input type="text" id="ape_pat" v-model="apellido_pat">
                                            <label class='active' for="ape_pat">Apellido Paterno</label>                                
                                        </div>
                                        <div class="input-field col s6">
                                            <input type="text" id="ape_mat" v-model="apellido_mat">
                                            <label class='active' for="ape_mat">Apellido Materno</label>                                
                                        </div>
                                        <div class="input-field col s6">
                                            <input autocomplete="off" type="text" id="usuario" v-model="usuario" >
                                            <label class='active' for="usuario">Nombre usuario</label>                                
                                        </div>
                                        <div class="input-field col s6">
                                            <input autocomplete="new-password" type="password" id="pass" v-model="password" >
                                            <label class='active' for="pass">Password</label>                                
                                        </div>
                                        <div class="input-field col s6">
                                            <input type="text" id="direccion" v-model="direccion">
                                            <label class='active' for="direccion">Direccion</label>                                
                                        </div>
                                        <div class="input-field col s6">
                                            <input type="number" id="tel1" v-model="tel1">
                                            <label class='active' for="tel1">Telefono 1</label>                                
                                        </div>

                                        <div class="input-field col s6">
                                            <input type="number" id="tel2" v-model="tel2">
                                            <label class='active' for="tel2">Telefono 2</label>                                
                                        </div>
                                        <div class="input-field col s6">                                        
                                            <select class="browser-default" v-model="tipo">  
                                                <option value="" disabled="">Seleccione</option>
                                                <option value="user">Usuari@</option>
                                                <option value="admin">Admin</option>
                                                <option value="caja">Cajer@</option>
                                            </select>                                       
                                        </div>    

                                    </div>
                                    <div class="center">
                                        <button class="btn white-text green" @click="insertar()">Guardar</button>
                                    </div>
                                </div>


                                <div v-if='ope == 2'>


                                    <table class="zui-table zui-table-horizontal zui-table-highlight">
                                        <thead>
                                            <tr>
                                                <th>Rut</th>
                                                <th>Nombre</th>
                                                <th>Direccion</th>
                                                <th>Telefono</th>
                                                <th>Usuario</th>
                                                <th v-if="sesion[0].tipo == 'admin'">Eliminar</th>  
                                            </tr>
                                        </thead>
                                        <tbody v-for='p in usuarios'>
                                            <tr>
                                                <td>{{p.rut}}</td>
                                                <td>{{p.nombre}} {{p.apellido_pat}}</td>
                                                <td>{{p.direccion}}</td>
                                                <td>{{p.telefono1}}</td>
                                                <td>{{p.usuario}}</td>
                                                <td v-if="sesion[0].tipo == 'admin'"><button class="btn-floating btn-small waves-effect waves-light white-text red" @click='eliminarUsuario(p)' ><i class="material-icons">close</i></button></td>                                                
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
        <script type="text/javascript" src="<?= base_url() ?>assets/js/usuario.js"></script>

    </body>
</html>

