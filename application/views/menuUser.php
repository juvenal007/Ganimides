<!-- LLAMAR A LA SESION ADMIN -->
<?php
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

        .sidenav-fixed {          
            width: 250px !important;
        }
        .side-nav {
            transform: translateX(0%) !important;
        }

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
        /*        .sidenav{         
                    width: 250px !important;
                }*/
        nav{
            padding-left: 15px;   
        }
        td, h5{
            font-weight: bold;             
        }

        .hvr-bubble-bottom {
            display: inline-block;
            vertical-align: middle;
            -webkit-transform: perspective(1px) translateZ(0);
            transform: perspective(1px) translateZ(0);
            box-shadow: 0 0 1px rgba(0, 0, 0, 0);
            position: relative;
        }
        .hvr-bubble-bottom:before {
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
            border-color: green transparent transparent transparent;
        }
        .hvr-bubble-bottom:hover:before, .hvr-bubble-bottom:focus:before, .hvr-bubble-bottom:active:before {
            -webkit-transform: translateY(10px);
            transform: translateY(10px);
        }

        .no-padding-bottom {
            padding-bottom:0px !important;
            padding-top: 0px !important;
            margin: 0px !important;
        }
        .padding-card{
            padding-top: 10px !important;
            padding-bottom: 0px !important;
        }
        .margen{
            padding-bottom: 5px !important;
        }
        .divider{
            padding: 2px;
            margin: 1px;
            background-color: rgba(227, 242, 253, 0.7);
        }
        .divider-lateral{
            padding: 1px !important;
            margin: 1px !important;
            background-color: rgba(4, 7, 25, 0.7);
        }
        .color-texto{
            color: #e3f2fd;             
        }
        .color-numero{
            color: #e3f2fd; 
            padding-bottom: 10px;
            text-shadow: 2px 2px 6px black;

        }
        .color-icon{
            color: #e3f2fd; 
        }
        .sombra{
            -webkit-box-shadow: 5px 6px 13px -2px rgba(0,0,0,0.97) !important;
            -moz-box-shadow: 5px 6px 13px -2px rgba(0,0,0,0.97) !important;
            box-shadow: 5px 6px 13px -2px rgba(0,0,0,0.97) !important;   
            border-radius: 30px 5px 24px 5px !important;
            -moz-border-radius: 30px 5px 24px 5px !important;
            -webkit-border-radius: 30px 5px 24px 5px !important;
            border: 0px solid #000000 !important;
        }

    </style>

    <body>
        <!-- CARGAR MENU DE ARRIBA Y LOADER -->


        <!-- ********************************************************-->

        <!-- BARRA IZQUIERDA ########################################-->

        <!-- ********************************************************-->
        <div id='newapp'>

            <?php $this->load->view('templates/header'); ?>

            <main>
                <br>

                <div class="row no-padding-bottom">
                    <div class="col s12 m6 l3">
                        <div class="card-panel blue sombra accent-3 no-padding-bottom padding-card">
                            <div class="row center-align margen">
                                <div class="col s7">
                                    <h3 class="color-numero">{{contarVentas}}</h3>
                                </div>
                                <div class="col s5">
                                    <i class="medium material-icons color-icon">add_shopping_cart</i>
                                </div>
                                <div class="divider"></div>
                                <strong class="color-texto">VENTAS</strong>
                            </div>   
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card-panel red sombra accent-3 no-padding-bottom padding-card z-depth-4">
                            <div class="row center-align margen">
                                <div class="col s7">
                                    <h3 class="color-numero">{{contarProveedores}}</h3>
                                </div>
                                <div class="col s5">
                                    <i class="medium material-icons color-icon">account_box</i>
                                </div>
                                <div class="divider"></div>
                                <strong class="color-texto">PROVEEDOR</strong>
                            </div>   
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card-panel green sombra no-padding-bottom padding-card">
                            <div class="row center-align margen">
                                <div class="col s7">
                                    <h3 class="color-numero">{{contarStock}}</h3>
                                </div>
                                <div class="col s5">
                                    <i class="medium material-icons color-icon">dashboard</i>
                                </div>
                                <div class="divider"></div>
                                <strong class="color-texto">STOCK</strong>
                            </div>   
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <div class="card-panel brown sombra darken-2 no-padding-bottom padding-card">
                            <div class="row center-align margen">
                                <div class="col s7">
                                    <h3 class="color-numero">{{contarCategorias}}</h3>
                                </div>
                                <div class="col s5">
                                    <i class="medium material-icons color-icon">face</i>
                                </div>
                                <div class="divider"></div>
                                <strong class="color-texto">CLIENTES</strong>
                            </div>   
                        </div>
                    </div>


                </div>
               
                    <div class="row">                    
                        <div class="col s12 m12 l12">
                            <div class="card-panel z-depth-4">
                                <h5 class="center-align bold">COMERCIAL "JJ"</h5>
                                <table class="bordered strong highlight">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Giro</td>
                                            <td>COMERCIALIZACIÓN DE INSUMOS FORESTALES Y FERRETERIA.</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Rut</td>
                                            <td>10.507.299-6.</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Nombre</td>
                                            <td>Comercial JJ.</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Dirección</td>
                                            <td>Pobl. Terrazas del Maule, Loncomilla N° 815.</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Telefonos</td>
                                            <td>Cel. +56 962495417 - Fono. 71 2671147.</td>
                                            <td>CONSTITUCION.</td>
                                        </tr>
                                        <tr>
                                            <td>Administrador</td>
                                            <td>JUAN FRANCISCO JAUREGUI.</td>
                                            <td></td>
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

        <!-- TABLA FIN  ************************************************-->


        <!--JavaScript at end of body for optimized loading-->    

        <    <!--JavaScript at end of body for optimized loading-->    
        <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-3.2.1.min.js" ></script> 
        <script type="text/javascript" src="<?= base_url() ?>assets/js/axios.min.js" ></script>       
        <!-- development version, includes helpful console warnings -->
        <script type="text/javascript" src="<?= base_url() ?>assets/js/vue.js" ></script> 
        <script src="<?= base_url() ?>assets/js/materialize.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/js/menu.js"></script>

    </body>
</html>
