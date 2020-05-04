new Vue({
    el: '#newapp',
    data: {
        titulo: 'CLIENTES',
        path: 'http://localhost/tienda/',
        agregar: false,
        lista: true,
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
         abrirSide: function () {
            var elem = document.querySelector('.sidenav');
            var instance = M.Sidenav.init(elem);
            instance.open();
        },
        agregarCliente: function () {
            url = this.path + 'insertar-cliente';
            param = new FormData();
            param.append('rut', this.rut);
            param.append('nombre', this.nombre);
            param.append('apellido_pat', this.apellido_pat);
            param.append('apellido_mat', this.apellido_mat);
            param.append('telefono', this.tel1);
            param.append('ciudad', this.ciudad);
            param.append('direccion', this.direccion);
            param.append('giro', this.giro);
            axios.post(url, param).then(res => {
                M.toast({html: res.data.value});
                this.rut = '';
                this.nombre = '';
                this.apellido_pat = '';
                this.apellido_mat = '';
                this.tel1 = '';
                this.ciudad = '';
                this.direccion = '';
                this.giro = '';
            }).catch(e => {
                console.log(e);
            });

        },

        eliminarCliente: function (p) {

            url = this.path + 'eliminar-cliente/';
            param = new FormData();
            param.append('idcliente', p.idcliente);
            if (confirm("Esta seguro que desea eliminar a " + p.nombre + " Rut: " + p.rut)) {
                axios.post(url, param).then(res => {
                    M.toast({html: res.data.value});
                    this.getClientes();
                }).catch(e => {
                    console.log(e);
                });
            }

        },

        actualizarCliente: function () {
            url = this.path + 'editar-cliente';
            param = new FormData();
            param.append('idcliente', this.modalProveedor.idcliente);
            param.append('rut', this.modalProveedor.rut);
            param.append('nombre', this.modalProveedor.nombre);
            param.append('apellido_pat', this.modalProveedor.apellido_pat);
            param.append('apellido_mat', this.modalProveedor.apellido_mat);
            param.append('direccion', this.modalProveedor.direccion);
            param.append('ciudad', this.modalProveedor.ciudad);
            param.append('telefono', this.modalProveedor.telefono);
            param.append('giro', this.modalProveedor.giro);
            axios.post(url, param).then(res => {
                if (res.data.value == "Cliente actualizado") {
                    M.toast({html: res.data.value});
                    var elems = document.querySelector('.modal');
                    var instance = M.Modal.init(elems);
                    this.getClientes();
                    instance.close();
                }

            }).catch(e => {
                console.log(e);
            });


        },
        getClientes: function () {
            url = this.path + 'lista-clientes/',
                    axios.post(url).then(res => {
                this.proveedor = res.data.value;
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
            this.giro = '';

            this.lista = false;
            this.agregar = true;
        },
        mostrarLis: function () {
            this.getClientes();
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
        }


    },
    created: function () {
        this.getSession();
        this.getClientes();

    },
    mounted: function () {
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelector('.modal');
            var instances = M.Modal.init(elems);
        });
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelector('select');
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
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelector('.sidenav');
            var instances = M.Sidenav.init(elems);
        });

    }
});