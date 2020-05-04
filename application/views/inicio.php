<?php
if (isset($_SESSION)) {
    $this->session->sess_destroy();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <!--Import Google Icon Font-->

        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="<?= base_url() ?>assets/css/materialize.min.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
        #borde{
            border: #000 solid 2px;
            padding: 15px;
        }  
        /* label focus color */
        .input-field input[type=text]:focus + label {
            color: #795548 !important;
        }
        .input-field input[type=text]:focus {
            border-bottom: 1px solid #795548 !important;
            box-shadow: 0 1px 0 0 #795548 !important;
        }
        .input-field input[type=password]:focus {
            border-bottom: 1px solid #795548 !important;
            box-shadow: 0 1px 0 0 #795548 !important;
        }
        html{
            display: flex;
            flex-flow: row nowrap;  
            justify-content: center;
            align-content: center;
            align-items: center;
            height:100%;
            margin: 0;
            padding: 0;     
        }
        body {
            margin: 0;
            flex: 0 1 auto;
            align-self: auto;            
            width: 100%;
            max-width: 100%;
            height: 100%;
            max-height: 600px;
            background: url(<?= base_url() ?>assets/img/textura1.png) center center fixed;
            background-color: #4ec3e6;
        }
        .input-field > .btn {
            width: 100%;
        }
        
        .pad-left{
         margin-left: 15px;   
         margin-bottom: 15px
            
        }
    </style>
    <body>
        <main>
            <!-- Modal Trigger -->
            <div id="modal" class="modal">
                <div class="modal-content">                    
                    <h4 class="center">Activar Usuario</h4>
                    <p>Pregunta secreta</p>
                    <select class="browser-default">  
                        <option value="" disabled="">Seleccione</option>
                        <option>Mejor amigo de la infancia</option>
                        <option>Nombre primera mascota</option>
                        <option>Nombre de la madre</option>
                    </select>                   
                    <input @keyup="iniciarEnter2" type="text" placeholder="Respuesta" v-model="pregunta">                     
                    <button class="btn waves-effect waves-light blue darken-2" @click='activo()'>Activar</button> 

                </div>
            </div>

            <br>
            <div class="container">
                <div class="row">
                    <div class="col s10 m8 l6 center-align z-depth-6 offset-l3 offset-m2 offset-s1">
                        <div class="card z-depth-4">
                            <div class="card-content center-align">
                                <img src="<?= base_url() ?>assets/img/comercial.jpg" width="400">
                                <h5>{{titulo}}</h5>                                
                                <div class="input-field" >
                                    <i class="prefix left material-icons small red-text">person</i>
                                    <input type="text" placeholder="Usuario" v-model="usuario" id="usuario" requiered autofocus>
                                </div>
                                <div class="input-field">          
                                    <i class="prefix left material-icons small green-text">vpn_key</i>
                                    <input @keyup="iniciarEnter" autocomplete="new-Password" placeholder="password" type="password"  v-model="password" id="password">
                                </div>                                                                
<!--                                <a href="htto://localhost/tienda/">¿HAS OLVIDADO TU CONTRASEÑA?</a>-->
                                  
                                <div class="input-field">
                                    <button type="submit" class="btn waves-effect waves-light  blue darken-3" @click='iniciar()'>Acceder</button>
                                </div>    
                                <p class="right-align">Ver. 1.0</p>    
                            </div>
                        </div>
<!--                        <pre>{{$data}}</pre>-->
                    </div>
                </div>
            </div>           
        </main>
        <script type="text/javascript" src="<?= base_url() ?>assets/js/axios.min.js"></script>       
        <!-- development version, includes helpful console warnings -->
        <script type="text/javascript" src="<?= base_url() ?>assets/js/vue.js"></script>      
        <!--JavaScript at end of body for optimized loading-->
        <script type="text/javascript" src="<?= base_url() ?>assets/js/materialize.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/js/control.js"></script>
    </body>

</html>
