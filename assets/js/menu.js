var app = new Vue({
    el: '#newapp',
    data: {
        path: 'http://localhost/tienda/',
        contarProveedores: '',
        contarCategorias: '',
        contarVentas: '',
        contarStock: '',
        sesion: []
    },
    methods: {
        abrirSide: function () {
            var elem = document.querySelector('.sidenav');
            var instance = M.Sidenav.init(elem);
            instance.open();
        },
        getSession: function () {
            url = this.path + 'control/getSession/';
            axios.post(url).then(res => {
                this.sesion = res.data;
            }).catch(e => {
                console.log(e);
            });
        },
        contarP: function () {
            url = this.path + 'contar-proveedores';
            axios.post(url).then(res => {
                this.contarProveedores = res.data.value;
                //   M.toast({html: this.contarProveedores[0]});
            }).catch(e => {
                console.log(e);
            })
        },
        contarC: function () {
            url = this.path + 'contar-cliente';
            axios.post(url).then(res => {
                this.contarCategorias = res.data.value;
                //  M.toast({html: this.contarCategorias[0]});
            }).catch(e => {
                console.log(e);
            });
        },

        contarV: function () {
            url = this.path + 'contar-finalizadas';
            axios.post(url).then(res => {
                this.contarVentas = res.data.value;
                //  M.toast({html: this.contarCategorias[0]});
            }).catch(e => {
                console.log(e);
            });

        },

        contarS: function () {
            url = this.path + 'contar-stock';
            axios.post(url).then(res => {
                this.contarStock = res.data;
                // M.toast({html: this.contarCategorias[0]});
            }).catch(e => {
                console.log(e);
            });
        }


    },
    created: function () {
        this.getSession();
        this.contarP();
        this.contarC();
        this.contarV();
        this.contarS();
    },
    mounted: function () {

        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.collapsible');
            var instances = M.Collapsible.init(elems);

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

