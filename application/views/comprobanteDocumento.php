<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>RepoEstado</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->

        <!-- Toastr -->




    </head>   <!-- SweetAlert2 -->
    <style type="text/css">
        @import url(plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css);
        .titulo{
            font-family: Arial, Helvetica, sans-serif;
        }
        .centro{
            border-color:#000000;text-align:center;vertical-align:top
        }
        .pad-top{
            padding-top: 20px;
        }

        .img-left{
            position: absolute;
            text-align: left;
        }
        .right {
            float: right;
        }
        .textoJustificado {
            text-align: justify;
        }
        html{
            font-family: sans-serif;
        }
        padd{
            padding-top: 250px;
        }
        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
               overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
               font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}


        .tg .tg-ub5w{border-color:inherit;font-size:36px;text-align:center;vertical-align:middle}
        .tg .tg-9wq8{border-color:inherit;text-align:center;vertical-align:middle}
        .tg .tg-h9cx{border-color:inherit;font-size:xx-large;text-align:center;vertical-align:middle}
        .tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
        .tg .tg-7btt{border-color:inherit;font-weight:bold;text-align:center;vertical-align:top}

        .tg .tg-xwva{border-color:#000000;font-size:15px;font-weight:bold;text-align:center;vertical-align:top}
        .tg .tg-wp8o{border-color:#000000;text-align:center;vertical-align:top}
        .tg .tg-mqa1{border-color:#000000;font-weight:bold;text-align:center;vertical-align:top}

        .tg .tg-73oq{border-color:#000000;text-align:center;vertical-align:top;font-size:24px}


    </STYLE>
</style>
<body>
    <main>
        <div class="wrapper">

            <div class="content-wrapper">


                <!-- Main content -->

                <section class="content">
                    <div class="container-fluid">
                        <!--      <div class="row centro">
                               <div><img class="centro" height="120" src="http://localhost/tienda/assets/img/comercial.jpg" />
                               </div>
                               <div class="right"><img height="100" src="http://192.168.1.35/repoEstado/assets/img/logo_pencahue.png" />
                               </div>
                              </div>    -->
                        <table class="tg" style="width: 100%;">
                            <tr>
                                <th class="tg-ub5w" colspan="2">COMERCIAL "JJ"</th>
                                <th class="tg-9wq8"><img class="centro" height="80" src="http://localhost/tienda/assets/img/logoChico.png" /></th>
                                <th class="tg-h9cx" colspan="4"><?php echo $venta->idventa; ?></th>
                            </tr>
                            <tr>
                                <td class="tg-c3ow" colspan="3">Comercialización de Insumos Forestales y Ferretería</td>
                                <td class="tg-7btt" colspan="4">Codigo</td>
                            </tr>
                            <tr>
                                <td class="tg-c3ow">Cel. +56 962495417 </td>
                                <td class="tg-c3ow">Tel. 71 - 2671147</td>
                                <td class="tg-c3ow" colspan="5">CONSTITUCIÓN</td>
                            </tr>
                        </table>

                        <table class="tg" style="width: 100%;">
                            <tr>
                                <th class="tg-73oq centro" colspan="7">COMPRA</th>
                            </tr>
                            <tr>
                                <th class="tg-xwva">Id Venta</th>
                                <th class="tg-mqa1">Fecha</th>
                                <th class="tg-mqa1">Hora</th>
                                <th class="tg-mqa1">Estado</th>
                                <th class="tg-mqa1">Tipo</th>
                                <th class="tg-mqa1">N° Guia</th>
                                <th class="tg-mqa1">Total</th>
                            </tr>
                            <tr>
                                <td class="tg-wp8o"><?php echo $venta->idventa; ?></td>
                                <td class="tg-wp8o"><?php echo $venta->fecha; ?></td>
                                <td class="tg-wp8o"><?php echo $venta->hora; ?></td>
                                <td class="tg-wp8o"><?php echo $venta->estado; ?></td>
                                <td class="tg-wp8o"><?php echo $venta->tipo; ?></td>
                                <td class="tg-wp8o"><?php echo $venta->nguia; ?></td>
                                <td class="tg-wp8o"><?php echo $venta->total; ?></td>
                            </tr>
                        </table>

                        <table class="tg" style="width: 100%;">
                            <tr>
                                <th class="tg-73oq centro" colspan="3">DETALLE DE PRODUCTOS</th>
                            </tr>
                            <tr>
                                <td class="tg-xwva">Codigo</td>
                                <td class="tg-mqa1">Nombre</td>
                                <td class="tg-mqa1">Cantidad</td>
                            </tr>
                            <?php
                            $size = sizeof($productos);
                            $cantidad = 0;
                            foreach ($productos as $producto) {
                                $cantidad = $cantidad + $producto->cantidad;
                                print('<tr>');
                                print('<td class="tg-wp8o">');
                                echo $producto->idproducto;
                                print('</td>');
                                print('<td class="tg-wp8o">');
                                echo $producto->nombre;
                                print('</td>');
                                print('<td class="tg-wp8o">');
                                echo $producto->cantidad;
                                print('</td>');
                                print('</tr>');
                            }
                            ?>     
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                          
                            <tr>
                               
                           <td class="tg-wp8o"></td>
                           <td class="tg-mqa1">CANTIDAD TOTAL</td>
                            <td class="tg-mqa1"><?php echo $cantidad; ?></td>
                            </tr>
                        </table>
                       
          



                    </div>


                </section>

            </div>

        </div>

    </div>

</main>




</body>
</html>


