
<!-- ********************************************************-->

<!-- CARGAR ###### ######################################### -->

<!-- ********************************************************-->

<header>
    <!-- MENU => NAVBAR/SIDENAV-->

  <nav class="black">
        <div class="nav-wrapper">
            <a href="#" id='boton' @click='abrirSide()' class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <a href="#" class="brand-logo" class="hide-on-med-and-up">COMERCIAL "JJ" v1.0 </a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li v-if="sesion[0].tipo == 'admin'" class="bold"><a href="<?= base_url('nuevo-usuario'); ?>"><i class="material-icons left">mood</i>USUARIOS<i class="material-icons right">keyboard_arrow_right</i></a></li>

            </ul>

        </div>                  
    </nav>
            <ul class="sidenav sidenav-fixed z-depth-4" id='slidenab'>
                <li><div class="user-view">
                        <div class="background">
                            <img src="<?= base_url() ?>assets/img/fondo4.jpg">
                        </div>
                        <img class="circle center-block" src="<?= base_url() ?>assets/img/avatar.png"></a>
                        <span class="white-text name center-align">{{sesion[0].nombre}} {{sesion[0].apellido_pat}}</span></a>
                        <span class="white-text email center-align">{{sesion[0].rut}}</span></a>
                    </div></li>   
                <li class="no-padding">
                    <ul class="collapsible">
                        <li class="bold"><a href="<?= base_url('menu-user'); ?>"class="collapsible-header waves-effect waves-green green-text"><i class="material-icons green-text">home</i>HOME<i class="material-icons right">keyboard_arrow_right</i></a></li>
                        <li><div class="divider divider-lateral"></div></li>
                        <li class="bold"><a href="<?= base_url('venta') ?>" class="collapsible-header waves-effect waves-red red-text"><i class="material-icons red-text">shopping_cart</i>VENTAS<i class="material-icons right">keyboard_arrow_right</i></a></li>
                        <li v-if="sesion[0].tipo == 'admin' || sesion[0].tipo == 'caja'"><div class="divider divider-lateral"></div></li>
                        <li v-if="sesion[0].tipo == 'admin' || sesion[0].tipo == 'caja'" class="bold"><a href="<?= base_url('compra'); ?>"class="collapsible-header waves-effect waves-grey black-text"><i class="material-icons">add_circle</i>COMPRAS<i class="material-icons right">keyboard_arrow_right</i></a></li>
                        <li><div class="divider divider-lateral"></div></li>
                        <li class="bold"><a href="<?= base_url('inventario') ?>"class="collapsible-header waves-effect waves-grey"><i class="material-icons">clear_all</i>INVENTARIO<i class="material-icons right">keyboard_arrow_right</i></a></li>
                        <li v-if="sesion[0].tipo == 'admin'"><div class="divider divider-lateral"></div></li>
                        <li v-if="sesion[0].tipo == 'admin'" class="bold"><a href="<?= base_url('informe') ?>" class="collapsible-header waves-effect waves-grey"><i class="material-icons">content_paste</i>INFORMES<i class="material-icons right">keyboard_arrow_right</i></a></li>
                        <li><div class="divider divider-lateral"></div></li>
                        <li class="bold"><a href="<?= base_url('proveedor'); ?>"class="collapsible-header waves-effect waves-grey"><i class="material-icons">assignment_ind</i>PROVEEDOR<i class="material-icons right">keyboard_arrow_right</i></a></li>
                        <li><div class="divider divider-lateral"></div></li>
                        <li class="bold"><a href="<?= base_url('cliente'); ?>"class="collapsible-header waves-effect waves-grey"><i class="material-icons">face</i>CLIENTE<i class="material-icons right">keyboard_arrow_right</i></a></li>
                        <li><div class="divider divider-lateral"></div></li>
                        <li class="bold"><a href="<?= base_url('logout'); ?>" class="collapsible-header waves-effect waves-grey black-text"><i class="material-icons black-text">close</i>LOGOUT<i class="material-icons right black-text">keyboard_arrow_right</i></a></li>
                    </ul>
                </li>
                <br>                
            </ul>
      
</header>