new Vue({
    el: '#newapp',
    data: {
        rutProveedor: '',
        buscarProducto: '',
        cantidad: '',
        cantidades: [],
        productoModal: [],
        productosAgregados: [],
        name: '',
        titulo: 'COMPRAS',
        titulo2: 'Ingreso Facturas',
        path: 'http://localhost/tienda/',
        item: 1,
        opc: 1,
        proveedor: '',
        codigo: '',
        fecha: '',
        iva: '',
        iva_final: 0,
        iva_adicional: 0,
        total: 0,
        neto: 0,
        sesion: [],
        productos: [],
        proveedorCargar: {},
        modalProveedor: {},
        listaFactura: [],
        factura: [],
        productosDetalle: [],
        editarP: {},
        comboCategoria: [],
        comboMarca: [],
        stock: '',
        p_compra: '',
        p_iva: '',
        p_ventaconiva: '',
        p_venta: '',
        p_ventaTotal: '',
        p_ganancia: '',
        nombre: '',
        descripcion: '',
        ganancia: ''
    },
    methods: {
         abrirSide: function () {
            var elem = document.querySelector('.sidenav');
            var instance = M.Sidenav.init(elem);
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
                        this.editarP.nombre == '' || this.p_ventaconiva == '' || this.editarP.descripcion == '') {
                    M.toast({html: 'Faltan datos o debe calcular precios'});
                } else {
                    M.toast({html: res.data.value});


                    var productos = this.productosAgregados;
                    var productoM = this.editarP;

                    var url = this.path + 'obtener-producto';
                    var param = new FormData();
                    var productoB = '';
                    param.append('idprod', productoM.idproducto);
                    axios.post(url, param).then(res => {
                        console.log(res.data.value);
                        productoB = res.data.value;
                    }).catch(e => {
                        console.log(e);
                    });

                    for (var i = 0; i < productos.length; i++) {
                        if (productos[i].idproducto == productoB.idproducto) {
                            productos.splice(i, 1);
                            productos.push(productoB[0]);
                        }
                    }                    
                    var total = 0;
                    var cantidad = 0;
                    for (var i = 0; i < productos.length; i++) {
                        cantidad = parseInt(productos[i].cantidad);
                        total = cantidad * parseInt(productos[i].p_compra);
                        productos[i].total = total;
                    }
                    
                    this.productosAgregados = productos;
                    this.calcularNetoTotal();

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

        modalEditarProducto: function (p) {
            this.editarP = p;
            var elems = document.querySelector('#editarp');
            var instance = M.Modal.init(elems);
            instance.open();
        },

        editarProducto: function (p) {

            var producto = p;




        },
        eliminarFacturaProducto: function (p) {

            var producto = p;
            for (var i = 0; i < this.productosAgregados.length; i++) {
                if (this.productosAgregados[i].idproducto == producto.idproducto) {
                    this.productosAgregados.splice(i, 1);
                }
            }

            this.calcularNetoTotal();

        },

        eliminarFactura: function (p) {
            var factura = p;
            var url = this.path + 'eliminar-factura';
            var param = new FormData();
            param.append('idfactura', factura.idfactura);
            if (confirm("Esta seguro que desea eliminar N° Factura " + factura.codigo + " Fecha: " + p.fecha)) {
                axios.post(url, param).then(res => {
                    //   console.log(res.data.value);
                    this.getFactura();
                }).catch(e => {
                    console.log(e);
                });
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

        detallesFactura: function (p) {
            this.factura = [];
            var factura2 = p;
            this.factura.push(factura2);
            console.log(factura2);
            var idfactura = factura2.idfactura;
            console.log(idfactura);

            var url = this.path + 'detalles-factura';
            var param = new FormData();
            param.append('idfactura', idfactura);
            axios.post(url, param).then(res => {
                this.productosDetalle = res.data.value;
                var total = 0;
                var cantidad = 0;
                for (var i = 0; i < this.productosDetalle.length; i++) {
                    cantidad = parseInt(this.productosDetalle[i].cantidad);
                    total = cantidad * parseInt(this.productosDetalle[i].p_ventaconiva);
                    this.productosDetalle[i].total = total;
                }
            }).catch(e => {
                console.log(e);
            });



            var elems = document.querySelector('#detalle');
            var instance = M.Modal.init(elems);
            instance.open();
        },

        getFactura: function () {

            var url = this.path + 'lista-factura';

            axios.post(url).then(res => {
                this.listaFactura = res.data.value;
            }).catch(e => {
                console.log(e);
            })
        },

        limpiar: function () {

            this.rutProveedor = '';
            this.cantidad = '';
            this.productoModal = [];
            this.productosAgregados = [];
            this.proveedor = '';
            this.codigo = '';
            this.iva_final = 0;
            this.iva_adicional = 0;
            this.total = 0;
            this.neto = 0;
            this.productosAgregados = [];
            this.productoModal = [];
            this.productos = [];
            this.proveedor = '';
            this.iva = '';
            this.proveedorCargar = {};
            this.buscarProducto = '';

        },

        opcItem: function (o) {

            switch (o) {
                case 1:
                    this.opc = 1;
                    this.limpiar();
                    break;
                case 2:
                    this.opc = 2;
                    this.getFactura();
                    this.limpiar();
                    break;

                default:
            }
        },

        eliminarProducto: function (p) {
            var producto = p;
            for (var i = 0; i < this.productosAgregados.length; i++) {
                if (this.productosAgregados[i].idproducto == producto.idproducto) {
                    this.productosAgregados.splice(i, 1);
                }
            }

        },
        cargarProveedor: function () {
//            for (var i = 0; i < this.comboProveedor.length; i++) {
//                if (this.comboProveedor[i].idproveedor == this.proveedor) {
//                    this.proveedorCargar = this.comboProveedor[i];
//                }
//            }

            if (this.rutProveedor === '') {
                M.toast({html: 'Ingrese rut Proveedor'});
            } else {
                var url = this.path + 'buscar-proveedor-rut';
                var param = new FormData();
                param.append('rut', this.rutProveedor);
                axios.post(url, param).then(res => {
                    console.log(res.data.value);
                    if (res.data.value == null) {
                        M.toast({html: 'Proveedor no encontrado'});
                    } else {
                        this.proveedorCargar = res.data.value;
                        this.proveedor = this.proveedorCargar.idproveedor;
                    }

                }).catch(e => {
                    console.log(e);
                });
            }


        },

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
            axios.post(url, param).then(res => {
                M.toast({html: res.data.value});
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
                this.comboProveedor = res.data.value;
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
        cargarModalProducto: function () {
            if (this.buscarProducto != '' || this.productos === '') {
                this.getProductos();
                var elems = document.querySelector('#agregarProduct');
                var instance = M.Modal.init(elems);
                instance.open();
            } else {
                M.toast({html: 'Ingrese Producto'})
            }

        },
        cargarModalCantidad: function (cantidad) {

            if (cantidad == 0) {
                M.toast({html: 'Debe ingresar valor'});
            } else {
                var pmodal = this.productoModal[0];
                //   console.log(pmodal);
                pmodal.cantidad = cantidad;
                pmodal.total = cantidad * pmodal.p_compra;

                for (var i = 0; i < this.productosAgregados.length; i++) {
                    if (this.productosAgregados[i].idproducto == pmodal.idproducto) {
                        this.productosAgregados.splice(i, 1);
                    }
                }


                var total = parseInt(pmodal.p_compra) * parseInt(pmodal.cantidad);
                pmodal.total = total;
                this.productosAgregados.push(pmodal);
                this.cantidad = 0;
                this.name = '';
                //    this.productosAgregados[0].cantidad = cantidad;
                var elems = document.querySelector('#cantidad');
                var instance = M.Modal.getInstance(elems);
                instance.close();

                var elemss = document.querySelector('#agregarProduct');
                var instances = M.Modal.getInstance(elemss);
                instances.close();
                this.calcularNetoTotal();
            }
        },
        cerrarModal: function () {
            var elems = document.querySelector('#agregarProduct');
            var instance = M.Modal.getInstance(elems);
            instance.close();
            this.productos = [];
        },
        cerrarModalCant: function () {
            var elems = document.querySelector('#cantidad');
            var instance = M.Modal.getInstance(elems);
            instance.close();

        },
        cerrarModalDetalle: function () {
            var elems = document.querySelector('#detalle');
            var instance = M.Modal.getInstance(elems);
            instance.close();
        },
        getProductos: function () {
            url = this.path + 'buscar-producto';
            param = new FormData();
            param.append('nombreProducto', this.buscarProducto);
            axios.post(url, param).then(res => {
                this.productos = res.data.value;
                this.buscarProducto = '';
            }).catch(e => {
                console.log(e);
            });
            this.buscarProducto = '';
        },

        agregarProductoFactura: function (p) {

            this.productoModal[0] = p;
            //   this.productosAgregados[0] = p;

            var elems = document.querySelector('#cantidad');
            var instance = M.Modal.init(elems);
            instance.open();
            //this.productosAgregados[i].cantidad;

        },
        calcularNetoTotal: function () {

            let iva_int = parseInt(this.iva);
            let iva_adicional_int = parseInt(this.iva_adicional);

            let totalFinal = 0;
            let totalIVA = 0;
            let totalIVA_add = 0;
            let IVA_total = 0;
            let total = 0;
            let neto = 0;
            for (var i = 0; i < this.productosAgregados.length; i++) {
                total += parseInt(this.productosAgregados[i].p_compra * this.productosAgregados[i].cantidad);
                neto += parseInt(this.productosAgregados[i].p_compra);

            }
            console.log(total);
            if (iva_int > 0 || iva_int > '0') {
                let iva = (iva_int / 100);
                totalIVA = total * iva;
                console.log('IVA1: ' + totalIVA);

            }
            if (iva_adicional_int > 0 || iva_adicional_int > '0') {
                let iva = (iva_adicional_int / 100);
                totalIVA_add = total * iva;
                console.log('IVA2: ' + totalIVA_add);
            }


            IVA_total = Math.round(totalIVA) + Math.round(totalIVA_add);
            //neto = total + IVA_total;
            this.iva_final = Math.round(IVA_total);
            this.total = Math.round(total + IVA_total);
            this.neto = Math.round(total);
            console.log(IVA_total);

        },

        insertarFactura: function () {

            let cadena = '';

            if (this.proveedor == '' || this.productosAgregados.length == 0 || this.codigo == '' ||
                    this.iva_final == 0 || this.total == 0) {
                M.toast({html: 'Faltan Datos'});
            } else {

                for (var i = 0; i < this.productosAgregados.length; i++) {
                    cadena += this.productosAgregados[i].idproducto + '-';
                }
                console.log(cadena);
                let divisor = cadena.split('-');
                for (var i = 0; i < divisor.length; i++) {
                    console.log(divisor[i]);
                }
                divisor.pop();
                console.log(divisor);

                let cadena2 = '';
                for (var i = 0; i < this.productosAgregados.length; i++) {
                    cadena2 += this.productosAgregados[i].cantidad + '-';
                }
                console.log(cadena2);
                let divisor2 = cadena2.split('-');
                for (var i = 0; i < divisor2.length; i++) {
                    console.log(divisor2[i]);
                }
                divisor2.pop();


                url = this.path + 'insertar-factura';
                param = new FormData();
                param.append('codigo', this.codigo);
                param.append('iva', this.iva_final);
                param.append('iva_adicional', this.iva_adicional);
                param.append('total', this.total);
                param.append('cantidad', cadena2);
                param.append('neto', this.neto);
                param.append('proveedor_idproveedor', this.proveedor);
                param.append('usuario_idusuario', this.sesion[0].idusuario);
                param.append('productos', cadena);
                axios.post(url, param).then(res => {
                    M.toast({html: res.data.value});

                    this.codigo = '';
                    this.iva_final = 0;
                    this.iva_adicional = 0;
                    this.total = 0;
                    this.neto = 0;
                    this.productosAgregados = [];
                    this.productoModal = [];
                    this.productos = [];
                    this.proveedor = '';
                    this.iva = '';
                    this.proveedorCargar = {};
                    this.rutProveedor = '';
                    console.log(res.data);
                }).catch(e => {
                    M.toast({html: 'Codigo ya ingresado'});
                    console.log(e);
                });
            }

        }


    },
    computed: {
        buscarUsuario: function () {
            return this.productos.filter((p) => p.nombre.toLowerCase().includes(this.name)
                        || p.nombre.includes(this.name) || p.nombre.toUpperCase().includes(this.name)
                        || p.codigo.includes(this.name) || p.codigo_interno.includes(this.name) ||
                        p.p_compra.includes(this.name) || p.p_venta.includes(this.name));
        }
    },
    created: function () {
        this.getSession();
        this.getMarca();
        this.getCategoria();
        // this.getProveedores();
        //     this.getProductos();
        //     this.agregarCantidad();

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