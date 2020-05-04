new Vue({
    el: '#newapp',
    data: {
        ope: 2,
        titulo: 'PROVEEDORES',
        path: 'http://localhost/tienda/',
        rut: '',
        nombre: '',
        apellido_pat: '',
        apellido_mat: '',
        empresa: '',
        rutEmpresa: '',
        tel1: '',
        tel2: '',
        ciudad: '',
        direccion: '',
        giro: '',
        proveedor: [],
        sesion: [],
        modalProveedor: {}
    },
    methods: {

        agregarProveedor: function () {
            url = this.path + 'insertar-proveedor';
            param = new FormData();
            param.append('rut', this.rut);
            param.append('nombre', this.nombre);
            param.append('apellido_pat', this.apellido_pat);
            param.append('apellido_mat', this.apellido_mat);
            param.append('rut_empresa', this.rutEmpresa);
            param.append('empresa', this.empresa);
            param.append('telefono1', this.tel1);
            param.append('telefono2', this.tel2);
            param.append('ciudad', this.ciudad);
            param.append('direccion', this.direccion);
            param.append('giro', this.giro);
            axios.post(url, param).then(res => {
                M.toast({html: res.data.value});
                this.rut = '';
                this.nombre = '';
                this.apellido_pat = '';
                this.apellido_mat = '';
                this.rutEmpresa = '';
                this.direccion = '';
                this.empresa = '';
                this.tel1 = '';
                this.tel2 = '';
                this.ciudad = '';
                this.giro = '';

            }).catch(e => {
                console.log(e);
            });

        },

        eliminarProveedor: function (p) {

            url = this.path + 'eliminar-proveedor/';
            param = new FormData();
            param.append('idproveedor', p.idproveedor);
            if (confirm("Esta seguro que desea eliminar a " + p.nombre + " Rut: " + p.rut)) {
                axios.post(url, param).then(res => {
                    M.toast({html: res.data.value});
                    this.getProveedores();
                }).catch(e => {
                    console.log(e);
                });
            }

        },

        actualizarProveedor: function () {
            url = this.path + 'editar-proveedor';
            param = new FormData();
            param.append('idproveedor', this.modalProveedor.idproveedor);
            param.append('rut', this.modalProveedor.rut);
            param.append('nombre', this.modalProveedor.nombre);
            param.append('apellido_pat', this.modalProveedor.apellido_pat);
            param.append('apellido_mat', this.modalProveedor.apellido_mat);
            param.append('empresa', this.modalProveedor.empresa);
            param.append('direccion', this.modalProveedor.direccion);
            param.append('ciudad', this.modalProveedor.ciudad);
            param.append('rut_empresa', this.modalProveedor.rut_empresa);
            param.append('telefono1', this.modalProveedor.telefono1);
            param.append('telefono2', this.modalProveedor.telefono2);
            param.append('giro', this.modalProveedor.giro);
            axios.post(url, param).then(res => {
                if (res.data.value == "Proveedor actualizado") {
                    M.toast({html: res.data.value});
                    var elems = document.querySelector('.modal');
                    var instance = M.Modal.init(elems);
                    this.getProveedores();
                    instance.close();
                }

            }).catch(e => {
                console.log(e);
            });


        },
        getProveedores: function () {
            url = this.path + 'lista-proveedores/',
                    axios.post(url).then(res => {
                this.proveedor = res.data.value;
                console.log(res.data.value);
            }).catch(e => {
                console.log(e);
            });

        },
        getSession: function () {
            url = this.path + 'control/getSession/';
            axios.post(url).then(res => {
                this.sesion = res.data;
            }).catch(e => {
                console.log(e);
            });
        },

        limpiar: function () {
            this.rut = '';
            this.nombre = '';
            this.apellido_pat = '';
            this.apellido_mat = '';
            this.rutEmpresa = '';
            this.empres = '';
            this.tel1 = '';
            this.tel2 = '';
            this.ciudad = '';
            this.direccion = '';


        },

        opc: function (o) {

            switch (o) {

                case 1:
                    this.ope = 1;
                    this.limpiar();

                    break;

                case 2:
                    this.ope = 2;
                    this.getProveedores();
                    break;

                default:

            }


        },
        mostrarAgr: function () {
            this.rut = '';
            this.nombre = '';
            this.apellido_pat = '';
            this.apellido_mat = '';
            this.rutEmpresa = '';
            this.empres = '';
            this.tel1 = '';
            this.tel2 = '';
            this.ciudad = '';
            this.direccion = '';


            this.lista = false;
            this.agregar = true;
        },
        mostrarLis: function () {
            this.getProveedores();
            this.agregar = false;
            this.lista = true;
        },
        cargarModalEditar: function (p) {
            this.modalProveedor = p;
            var elems = document.querySelector('.editar');
            var instance = M.Modal.init(elems);
            instance.open();
        },
        cargarModalDetalle: function (p) {
            this.modalProveedor = p;
            var elems = document.querySelector('.detalle');
            var instance = M.Modal.init(elems);
            instance.open();
        },
        cerrarModal: function () {
            var elems = document.querySelector('.modal');
            var instance = M.Modal.init(elems);
            this.getProveedores();
            instance.close();
        },
        abrirSide: function () {
            var elem = document.querySelector('.sidenav');
            var instance = M.Sidenav.init(elem);
            instance.open();
        },

    },
    created: function () {
        this.getSession();
        this.getProveedores();

    },
    mounted: function () {
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelector('.modal');
            var instances = M.Modal.init(elems);
        });
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelector('.select');
            var instances = M.FormSelect.init(elems);
        });
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelector('.sidenav');
            var instances = M.Sidenav.init(elems);
        });

        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelector('.collapsible');
            var instances = M.Collapsible.init(elems);
        });


    }
});