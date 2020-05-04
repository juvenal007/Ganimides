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
    </style>
    <body>
        <main>
            <div id="modal" class="modal">
                <div class="modal-content">                    
                    <h4 class="center">Activar Usuario</h4>
                    <p>Pregunta secreta</p>
                                        
                    <button class="btn waves-effect waves-light blue darken-2">Activar</button> 

                </div>
            </div>


            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <div class="card-panel">
                            <h4>{{titulo}}</h4>
                            <input type="text">                           

                            <button class="btn" @click="cargarModal()">Cargarmodal</button>

                        </div>
<!--                        <pre>{{$data}}</pre>-->
                    </div>
                </div>
            </div>           
        </main>

   <script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-3.2.1.min.js" ></script> 
        <script type="text/javascript" src="<?= base_url() ?>assets/js/axios.min.js" ></script>       
        <!-- development version, includes helpful console warnings -->
        <script type="text/javascript" src="<?= base_url() ?>assets/js/vue.js" ></script> 
        <!-- Compiled and minified JavaScript -->
        <script type="text/javascript" src="<?= base_url() ?>assets/js/materialize.min.js"></script>
        <script type="text/javascript" src="<?= base_url() ?>assets/js/proveedor.js"></script> 

    </body>

</html>