new Vue({
    el: '#newapp',
    data: {
        name: '',
        titulo: 'INVENTARIO PRODUCTOS',
        path: 'http://localhost/tienda/',
        opc: 2,
        nombreCat: '',
        detalleCat: '',
        nombreMar: '',
        descripcionMar: '',
        codigo: '',
        codigo_interno: '',
        nombre: '',
        stock: '',
        descripcion: '',
        p_venta: '',
        p_compra: '',
        p_ventaconiva: '',
        ganancia: '',
        categoria: '',
        marca: '',
        p_ventaTotal: '',
        p_iva: '',
        p_ganancia: '',
        comboCategoria: [],
        comboMarca: [],
        productos: [],
        sesion: [],
        modalProducto: [],
        stockAgregar: 0,
        editarP: {}
    },
    methods: {
        abrirSide: function () {
            var elem = document.querySelector('.sidenav');
            var instance = M.Sidenav.init(elem);
            instance.open();
        },

        enviar: function () {


            var url = this.path + 'exportar-excel';
            document.location.target = "_blank";
            document.location.href = url;
            M.toast({html: 'Exportando Excel...'})
        },
        modalEditarProducto: function (p) {
            this.editarP = p;
            var elems = document.querySelector('#editarp');
            var instance = M.Modal.init(elems);
            instance.open();
        },
        actualizarProducto: function () {

            var url = this.path + 'editar-producto';
            var param = new FormData();
            param.append('id', this.editarP.idproducto);
            param.append('nombre', this.editarP.nombre);
            param.append('stock', this.editarP.stock);
            param.append('descripcion', this.editarP.descripcion);
            param.append('p_venta', this.p_venta);
            param.append('p_compra', this.p_compra);
            param.append('iva', this.p_iva);
            param.append('categoria_idcategoria', this.editarP.categoria_idcategoria);
            param.append('usuario_idusuario', this.sesion[0].idusuario);
            param.append('marca_idmarca', this.editarP.marca_idmarca);
            param.append('p_ventaconiva', this.p_ventaconiva);
            axios.post(url, param).then(res => {
                if (this.p_compra == '' || this.p_venta == '' ||
                        this.editarP.nombre == '' || this.editarP.stock == 0 || this.editarP.stock == ''
                        || this.p_ventaconiva == '' || this.editarP.descripcion == '') {
                    M.toast({html: 'Faltan datos o debe calcular precios'});
                } else {
                    M.toast({html: res.data.value});
                    this.nombre = '';
                    this.stock = '';
                    this.descripcion = '';
                    this.p_compra = '';
                    this.ganancia = '';
                    this.p_ventaconiva = '';
                    this.p_iva = '';
                    this.p_venta = '';
                    this.p_ganancia = '';
                    this.p_ventaTotal = '';
                    this.getProductos();
                    var elems = document.querySelector('#editarp');
                    var instance = M.Modal.getInstance(elems);
                    instance.close();
                }

            }).catch(e => {
                console.log(e);
            });
        },
        calcularGananciaEditar: function () {

            if (this.editarP.p_compra == '' || this.editarP.p_compra == 0) {
                M.toast({html: 'Ingrese precio compra'});
            } else {
                this.stock = this.editarP.stock;
                this.p_compra = this.editarP.p_compra;
                this.p_iva = Math.round(this.p_compra * 0.19);
                this.p_ventaconiva = Math.round(parseInt(this.p_compra) + this.p_iva);
                this.p_venta = parseInt(this.p_ventaconiva) + parseInt(this.p_ventaconiva * (this.ganancia / 100));
                this.p_ventaTotal = parseInt(this.p_venta * this.stock);
                this.p_ganancia = parseInt(this.p_ventaconiva * (this.ganancia / 100));
            }

        },
        formatNumber: function (num) {
            var separador = "."; // separador para los miles
            var sepDecimal = ','; // separador para los decimales            
            num += '';
            var splitStr = num.split('.');
            var splitLeft = splitStr[0];
            var splitRight = splitStr.length > 1 ? sepDecimal + splitStr[1] : '';
            var regx = /(\d+)(\d{3})/;
            while (regx.test(splitLeft)) {
                splitLeft = splitLeft.replace(regx, '$1' + separador + '$2');
            }
            return splitLeft + splitRight;
        },
        eliminarProducto: function (p) {
            url = this.path + 'eliminar-producto/';
            param = new FormData();
            param.append('id', p.idproducto);
            if (confirm("Esta seguro que desea eliminar a " + p.nombre + " Stock: " + p.stock)) {
                axios.post(url, param).then(res => {
                    M.toast({html: res.data.value});
                    this.getProductos();
                }).catch(e => {
                    console.log(e);
                });
            }

        },
        agregarStock: function () {
            url = this.path + 'agregar-stock';
            param = new FormData();
            if (this.stockAgregar <= 0) {
                M.toast({html: 'Stock demaciado bajo'});
            } else {
                param.append('idproducto', this.modalProducto.idproducto);
                param.append('stock', this.stockAgregar);
                axios.post(url, param).then(res => {
                    this.getProductos();
                    M.toast({html: res.data.value});
                    var elems = document.querySelector('#editarProducto');
                    var instance = M.Modal.getInstance(elems);
                    instance.close();
                }).catch(e => {

                });
                this.getProductos();
            }


        },
        insertarProducto: function () {



            if (this.nombre == '' || this.stock == '' || this.descripcion == '' ||
                    this.p_venta == '' || this.categoria_idcategoria == '' ||
                    this.marca_idmarca == '') {
                M.toast({html: 'Faltan datos'});
            } else {
                url = this.path + 'insertar-producto';
                param = new FormData();
                param.append('codigo', this.codigo);
                param.append('codigo_interno', this.codigo_interno);
                param.append('nombre', this.nombre);
                param.append('stock', this.stock);
                param.append('descripcion', this.descripcion);
                param.append('p_venta', this.p_venta);
                param.append('p_compra', this.p_compra);
                param.append('iva', this.p_iva);
                param.append('categoria_idcategoria', this.categoria);
                param.append('usuario_idusuario', this.sesion[0].idusuario);
                param.append('marca_idmarca', this.marca);
                param.append('p_ventaconiva', this.p_ventaconiva);
                axios.post(url, param).then(res => {
                    M.toast({html: res.data.value});
                    this.nombre = '';
                    this.stock = '';
                    this.descripcion = '';
                    this.p_compra = '';
                    this.ganancia = '';
                    this.p_ventaconiva = '';
                    this.p_iva = '';
                    this.p_venta = '';
                    this.p_ganancia = '';
                    this.p_ventaTotal = '';
                }).catch(e => {
                    console.log(e);
                });

            }

        },
        getSession: function () {
            url = this.path + 'control/getSession/';
            axios.post(url).then(res => {
                this.sesion = res.data;
            }).catch(e => {
                console.log(e);
            });
        },
        modalCategoria: function () {
            this.nombreCat = "";
            this.detalleCat = "";
            var elems = document.querySelector('#agregarCategoria');
            var instance = M.Modal.init(elems);
            instance.open();
        },
        modalMarca: function () {
            this.nombreMar = "";
            this.descripcionMar = "";
            var elems = document.querySelector('#agregarMarca');
            var instance = M.Modal.init(elems);
            instance.open();
        },
        crearCategoria: function () {

            if (this.nombreCat == '') {
                M.toast({html: 'Faltan Datos'});
            } else {
                url = this.path + 'insertar-categoria';
                param = new FormData();
                param.append('nombre', this.nombreCat);
                param.append('detalle', this.detalleCat);
                axios.post(url, param).then(res => {

                    M.toast({html: res.data.value});
                    this.nombreCat = "";
                    this.detalleCat = "";
                    var elems = document.querySelector('#agregarCategoria');
                    var instance = M.Modal.getInstance(elems);
                    this.getCategoria();
                    instance.close();
                }).catch(e => {
                    console.log(e);
                });
            }



        },
        cargarModalEditar: function (p) {
            this.modalProducto = p;
            var elems = document.querySelector('#editarProducto');
            var instance = M.Modal.init(elems);
            instance.open();
        },
        cerrarModalEditarProducto: function () {

            var elemsMar = document.querySelector('#editarProducto');
            var instanceMar = M.Modal.getInstance(elemsMar);
            instanceMar.close();
        },
        crearMarca: function () {

            if (this.nombreMar == '') {
                M.toast({html: 'Faltan Datos'});
            } else {
                url = this.path + 'insertar-marca';
                param = new FormData();
                param.append('nombre', this.nombreMar);
                param.append('descripcion', this.descripcionMar);
                axios.post(url, param).then(res => {

                    M.toast({html: res.data.value});
                    this.nombreMar = "";
                    this.descripcionMar = "";
                    var elems = document.querySelector('#agregarMarca');
                    var instance = M.Modal.getInstance(elems);
                    this.getMarca();
                    instance.close();
                }).catch(e => {
                    console.log(e);
                });
            }

        },
        cerrarModal: function () {

            var elemsCat = document.querySelector('#agregarCategoria');
            var instanceCat = M.Modal.getInstance(elemsCat);
            if (instanceCat != null) {
                this.nombreCat = "";
                this.detalleCat = "";
                instanceCat.close();
            }


            var elemsMar = document.querySelector('#agregarMarca');
            var instanceMar = M.Modal.getInstance(elemsMar);
            if (instanceMar != null) {
                this.nombreMar = "";
                this.descripcionMar = "";
                instanceMar.close();
            }


            var elemsagg = document.querySelector('#agregarProduct');
            var instanceagg = M.Modal.getInstance(elemsagg);
            if (instanceagg != null) {
                instanceagg.close();
                this.productos = [];
            }

        },
        cerrarModalEditarP: function () {
            var elems = document.querySelector('#editarp');
            var instance = M.Modal.getInstance(elems);
            instance.close();
        },
        cambiarOpc: function (e) {
            switch (e) {
                case 1:
                    this.opc = 1;
                    this.nombre = '';
                    this.stock = '';
                    this.descripcion = '';
                    this.p_compra = '';
                    this.ganancia = '';
                    this.p_ventaconiva = '';
                    this.p_iva = '';
                    this.p_venta = '';
                    this.p_ganancia = '';
                    this.p_ventaTotal = '';
                    this.productos = [];
                    break;
                case 2:
                    this.opc = 2;
                    this.getProductos();
                    break;
                default:
            }
        },
        getCategoria: function () {
            url = this.path + 'lista-categoria';
            axios.post(url).then(res => {
                this.comboCategoria = res.data;
            }).catch(e => {
                console.log(e);
            });
        },
        getMarca: function () {
            url = this.path + 'lista-marca';
            axios.post(url).then(res => {
                this.comboMarca = res.data;
            }).catch(e => {
                console.log(e);
            });
        },
        getProductos: function () {
            url = this.path + 'lista-producto';
            axios.post(url).then(res => {
                this.productos = res.data.value;
            }).catch(e => {
                console.log(e);
            });
        },
        calcularGanancia: function () {
            if (this.p_compra == '' || this.p_compra == 0) {
                M.toast({html: 'Ingrese precio compra'});
            } else {
                this.p_iva = Math.round(this.p_compra * 0.19);
                this.p_ventaconiva = Math.round(parseInt(this.p_compra) + this.p_iva);
                this.p_venta = parseInt(this.p_ventaconiva) + parseInt(this.p_ventaconiva * (this.ganancia / 100));
                this.p_ventaTotal = parseInt(this.p_venta * this.stock);
                this.p_ganancia = parseInt(this.p_ventaconiva * (this.ganancia / 100));
            }

        },
        consultarNombre: function () {
            if (this.nombre === '' && this.opc === 1) {
                M.toast({html: 'Debe ingresar Nombre'});
            } else {

                url = this.path + 'buscar-producto';
                param = new FormData();
                param.append('nombreProducto', this.nombre);
                axios.post(url, param).then(res => {
                    this.productos = res.data.value;

                }).catch(e => {
                    console.log(e);
                });

                var elems = document.querySelector('#agregarProduct');
                var instance = M.Modal.init(elems);
                instance.open();
            }
        }

    },
    computed: {
        buscarUsuario: function () {
            return this.productos.filter((p) => p.nombre.toLowerCase().includes(this.name)
                        || p.nombre.includes(this.name) || p.nombre.toUpperCase().includes(this.name)
                        || p.p_compra.includes(this.name));
        }
    },
    created: function () {
        this.getSession();
        this.getCategoria();
        this.getMarca();
        // this.getProductos();
    },
    mounted: function () {
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
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelector('.sidenav');
            var instances = M.Sidenav.init(elems);
        });
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelector('.modal');
            var instances = M.Modal.init(elems);
        });
    }
});
