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
        <link type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <style>
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
            border: #000 solid 2px;
            padding: 15px;
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
                <div class="container">
                    <div class="row">
                        <div class="col s12">
                            <div class="card-panel">                          
                                <h5 class="center">{{titulo}}</h5>                            


                              

                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <pre>{{$data}}</pre>
        </div>


        <!-- ***********************************************************-->

        <!-- COMIENZO MAIN  ********************************************-->

        <!-- ***********************************************************-->


        <!--JavaScript at end of body for optimized loading-->    

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <!-- development version, includes helpful console warnings -->
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="<?= base_url() ?>assets/js/materialize.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/js/usuario.js"></script>

    </body>
</html>

