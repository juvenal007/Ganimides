new Vue({
    el: '#newapp',
    data: {
        descripcion: '',
        rutCliente: '',
        buscarProducto: '',
        cliente: '',
        tipoVenta: 'boleta',
        codigoGuia: '',
        monto: '',
        vuelto: 0,
        guia: 'no',
        detallesModal: [],
        codVenta: null,
        cantidad: '',
        opc: 1,
        cantidades: [],
        productoModal: [],
        productosAgregados: [],
        name: '',
        titulo: 'VENTAS',
        titulo2: 'Buscar Boleta',
        path: 'http://localhost/tienda/',
        item: 1,
        proveedor: '',
        codigo: '',
        fecha: '',
        iva: '',
        iva_final: '0',
        iva_adicional: '0',
        total: 0,
        total2: 0,
        neto: '0',
        descuento: '',
        descuentoRealizado: 0,
        descuentoRealizado2: 0,
        totalConDescuento: 0,
        totalConDescuento2: 0,
        idventa: 0,
        sesion: [],
        comboProveedor: [],
        productos: [],
        proveedorCargar: {},
        modalProveedor: {},
        productosVenta: [],
        estadoVentasBoleta: [],
        total_caja: 0,
        descuento_caja: 0,
        descuentoRealizado_caja: 0,
        totalConDescuento_caja: 0,
        codigoBoletaBuscar: 0,
        detalleProductosModal: [],
        totalU: 0,
        clienteCargar: {},
        comboCliente: [],
        nuevoDetalle: {}
    },
    methods: {

        eliminarProductoAgregado: function (p) {


            var formatNumber = {
                separador: ".", // separador para los miles
                sepDecimal: ',', // separador para los decimales
                formatear: function (num) {
                    num += '';
                    var splitStr = num.split('.');
                    var splitLeft = splitStr[0];
                    var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
                    var regx = /(\d+)(\d{3})/;
                    while (regx.test(splitLeft)) {
                        splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
                    }
                    return this.simbol + splitLeft + splitRight;
                },
                new : function (num, simbol) {
                    this.simbol = simbol || '';
                    return this.formatear(num);
                }
            };


            var producto = p;
            for (var i = 0; i < this.productosAgregados.length; i++) {
                if (this.productosAgregados[i].idproducto == producto.idproducto) {
                    this.productosAgregados.splice(i, 1);
                }
            }

            var total = 0;
            var total2 = 0;
            var totaldesc = 0;
            for (var i = 0; i < this.productosAgregados.length; i++) {
                total += this.productosAgregados[i].total;
            }
            console.log(total);
            this.total = total;
            this.total2 = formatNumber.new(total);
            this.totalConDescuento = total;
            this.totalConDescuento2 = formatNumber.new(total);

        },

        cargarCliente: function () {

            if (this.rutCliente == '') {
                M.toast({html: 'Ingrese rut cliente'});
            } else {
                var url = this.path + 'buscar-cliente-rut';
                var param = new FormData();
                param.append('rut', this.rutCliente);
                axios.post(url, param).then(res => {
                    console.log(res.data.value);
                    if (res.data.value == null) {
                        M.toast({html: 'Cliente no encontrado'});
                    } else {
                        this.clienteCargar = res.data.value;
                        this.cliente = this.clienteCargar.idcliente;
                    }


                }).catch(e => {
                    console.log(e);
                });
            }

        },

        getClientes: function () {
            url = this.path + 'lista-clientes';
            axios.post(url).then(res => {
                this.comboCliente = res.data.value;
            }).catch(e => {
                console.log(e);
            });
        },

        calcularVuelto: function () {
            var total = 0;

            var formatNumber = {
                separador: ".", // separador para los miles
                sepDecimal: ',', // separador para los decimales
                formatear: function (num) {
                    num += '';
                    var splitStr = num.split('.');
                    var splitLeft = splitStr[0];
                    var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
                    var regx = /(\d+)(\d{3})/;
                    while (regx.test(splitLeft)) {
                        splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
                    }
                    return this.simbol + splitLeft + splitRight;
                },
                new : function (num, simbol) {
                    this.simbol = simbol || '';
                    return this.formatear(num);
                }
            };


            for (var i = 0; i < this.productosVenta.length; i++) {
                total += this.productosVenta[i].total;
            }
            this.total_caja = total;
            if (this.total_caja == 0) {
                M.toast({html: 'Debe ingresar productos'});
            } else {
                total = this.monto - this.total_caja;
                if (total < 0) {
                    M.toast({html: 'Monto insuficiente'});

                } else {
                    this.vuelto = formatNumber.new(total);
                }
            }

        },

        cargarModalDetalle: function (p) {
            this.detallesModal = [];
            this.detallesModal.push(p);

            var formatNumber = {
                separador: ".", // separador para los miles
                sepDecimal: ',', // separador para los decimales
                formatear: function (num) {
                    num += '';
                    var splitStr = num.split('.');
                    var splitLeft = splitStr[0];
                    var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
                    var regx = /(\d+)(\d{3})/;
                    while (regx.test(splitLeft)) {
                        splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
                    }
                    return this.simbol + splitLeft + splitRight;
                },
                new : function (num, simbol) {
                    this.simbol = simbol || '';
                    return this.formatear(num);
                }
            };

            this.descuento = 0;
            this.descuentoRealizado = 0;
            this.descuentoRealizado2 = 0;
            this.totalConDescuento = 0;
            this.totalConDescuento2 = 0;
            this.total = 0;
            this.total2 = 0;
            this.productosAgregados = [];
            this.detalleProductosModal = [];
            this.totalU = 0;
            url = this.path + 'terminar-compra-boleta-detalle2';
            param = new FormData();
            param.append('codVenta', this.detallesModal[0].idventa);
            axios.post(url, param).then(res => {
                M.toast({html: res.data.value});
                var boleta = res.data.boleta[0];
                var detalle = res.data.detalle;
                var cant = res.data.cant;
                for (var i = 0; i < detalle.length; i++) {
                    console.log(detalle[i][0]);
                    detalle[i][0].cantidad = cant[i].cantidad;
                    detalle[i][0].total = detalle[i][0].cantidad * detalle[i][0].p_venta;
                    this.detalleProductosModal.push(detalle[i][0]);
                    this.total += detalle[i][0].total;
                    this.totalU += parseInt(detalle[i][0].cantidad);
                }
                var largo = this.detalleProductosModal.length;
                this.detallesModal[0].cantidadP = largo;
                this.detallesModal[0].cantidadU = this.totalU;
                this.idventa = this.detallesModal[0].idventa;
                this.nuevoDetalle = this.detallesModal[0];
//                this.totalConDescuento = this.total - ((boleta.descuento / 100) * this.total);
//                
//           
//                this.descuento = 0;
//                this.descuentoRealizado = (boleta.descuento / 100) * this.total;
//                
//                this.totalConDescuento2 = Math.round(this.totalConDescuento);
//                this.total2 = Math.round(this.total);
//                this.descuentoRealizado2 = Math.round(this.descuentoRealizado);
//                console.log(boleta);
//                console.log(cant);
                this.descuento = boleta.descuento;
                if (this.descuento > 0) {
                    var descuento = this.descuento / 100;
                    descuento = this.total * descuento;
                    this.descuentoRealizado = Math.round(descuento);
                    this.descuentoRealizado2 = formatNumber.new(this.descuentoRealizado);
                    this.totalConDescuento = Math.round(this.total - this.descuentoRealizado);
                    this.totalConDescuento2 = formatNumber.new(this.totalConDescuento);

                    this.total = Math.round(this.total);
                    this.total2 = formatNumber.new(this.total);
                } else {
                    this.total2 = formatNumber.new(this.total);
                    this.descuentoRealizado2 = formatNumber.new(this.descuentoRealizado);
                    this.totalConDescuento2 = formatNumber.new(this.total);
                }

                // this.productosVenta = detalle;
            }).catch(e => {
                console.log(e);
            });





            var elems = document.querySelector('#detalle');
            var instance = M.Modal.init(elems);
            instance.open();
        },
        cerrarModalDetalle: function () {
            this.idventa = 0;
            this.detallesModal = [];
            this.detalleProductosModal = [];
            this.descuentoRealizado = 0;
            this.totalConDescuento = 0;
            this.total = 0;
            this.descuentoRealizado2 = 0;
            this.totalConDescuento2 = 0;
            this.total2 = 0;
            this.descuento = 0;
            var elems = document.querySelector('#detalle');
            var instance = M.Modal.getInstance(elems);
            instance.close();
        },

        anularBoleta: function (p) {

            var idventa = p.idventa;

            url = this.path + 'anular-venta-boleta';
            param = new FormData();
            param.append('idventa', idventa);
            axios.post(url, param).then(res => {
                M.toast({html: res.data.value});
                this.listaVentaBoletas();
            }).catch(e => {
                console.log(e);
            });

            console.log(idventa);
        },

        listaVentaBoletas: function () {
            var formatNumber = {
                separador: ".", // separador para los miles
                sepDecimal: ',', // separador para los decimales
                formatear: function (num) {
                    num += '';
                    var splitStr = num.split('.');
                    var splitLeft = splitStr[0];
                    var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
                    var regx = /(\d+)(\d{3})/;
                    while (regx.test(splitLeft)) {
                        splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
                    }

                    return this.simbol + splitLeft + splitRight;
                },
                new : function (num, simbol) {
                    this.simbol = simbol || '';
                    return this.formatear(num);
                }
            }


            url = this.path + 'lista-venta-boleta';
            axios.post(url).then(res => {
                let ventas = res.data;
                let t = 0;
                console.log(this.estadoVentasBoleta);
                for (var i = 0; i < ventas.length; i++) {
                    t = ventas[i].total;
                    t = formatNumber.new(t);
                    ventas[i].total = t;
                    console.log(ventas[i]);
                }
                this.estadoVentasBoleta = ventas;

            }).catch(e => {
                console.log(e);
            });





        },
        cargarProveedor: function () {
            for (var i = 0; i < this.comboProveedor.length; i++) {
                if (this.comboProveedor[i].idproveedor == this.proveedor) {
                    this.proveedorCargar = this.comboProveedor[i];
                }
            }

        },

        finalizarVentaBoleta: function () {


            //   this.codVenta = null;
            url = this.path + 'finalizar-venta-boleta'
            param = new FormData();
            param.append('codigo', this.codVenta);
            if (this.productosVenta.length <= 0) {
                M.toast({html: 'Ingrese Productos'});
                this.productosAgregados = [];
                this.productosVenta = [];
                this.total_caja = 0;
                this.descuento_caja = 0;
                this.totalConDescuento_caja = 0;
                this.descuentoRealizado_caja = 0;
            } else {
                axios.post(url, param).then(res => {
                    if (res.data.value == 'VENTA COMPLETADA') {
                        this.cargarModalFinalizar();
                        this.total_caja = 0;
                        this.monto = 0;
                        this.vuelto = 0;
                        //  this.codVenta = '';
                        this.productosAgregados = [];
                        this.productosVenta = [];
                        this.total_caja = 0;
                        this.descuento_caja = 0;
                        this.totalConDescuento_caja = 0;
                        this.descuentoRealizado_caja = 0;
                    }
                    M.toast({html: res.data.value});

                }).catch(e => {
                    console.log(e);
                });

            }


            //    M.toast({html: 'VENTA FINALIZADA'});
        },

        cambiarOpc: function (o) {
            switch (o) {

                case 1:
                    this.opc = 1;
                    this.titulo2 = 'Buscar Boleta';
                    this.codVenta = '';
                    this.totalConDescuento = 0;
                    this.descuento = 0;
                    this.total = 0;
                    this.descuentoRealizado = 0;
                    this.productosAgregados = [];
                    this.codigoBoletaBuscar = 0;
                    this.totalConDescuento2 = 0;
                    this.total2 = 0;
                    this.descuentoRealizado2 = 0;
                    this.limpiarGuia();
                    this.estadoVentasBoleta = [];
                    this.descripcion = '';
                    break;

                case 2:
                    this.opc = 2;
                    this.titulo2 = 'Ingreso Ventas Factura';
                    this.limpiarGuia();
                    this.estadoVentasBoleta = [];
                    this.descripcion = '';
                    break;

                case 3:
                    this.opc = 3;
                    this.titulo2 = 'Venta Caja';
                    this.codVenta = 0;
                    this.totalConDescuento_caja = 0;
                    this.descuento_caja = 0;
                    this.total_caja = 0;
                    this.descuentoRealizado_caja = 0;
                    this.productosVenta = [];
                    this.total_caja = 0;
                    this.monto = 0;
                    this.vuelto = 0;
                    this.limpiarGuia();
                    this.estadoVentasBoleta = [];
                    this.descripcion = '';
                    break;

                case 4:
                    this.opc = 4;
                    this.titulo2 = 'Estado Ventas';
                    this.listaVentaBoletas();
                    this.limpiarGuia();
                    this.descripcion = '';
                    break;

                default:

            }
            ;

        },
        buscarCodigoVentaBoleta: function () {

            var formatNumber = {
                separador: ".", // separador para los miles
                sepDecimal: ',', // separador para los decimales
                formatear: function (num) {
                    num += '';
                    var splitStr = num.split('.');
                    var splitLeft = splitStr[0];
                    var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
                    var regx = /(\d+)(\d{3})/;
                    while (regx.test(splitLeft)) {
                        splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
                    }
                    return this.simbol + splitLeft + splitRight;
                },
                new : function (num, simbol) {
                    this.simbol = simbol || '';
                    return this.formatear(num);
                }
            };

            this.descuento = 0;
            this.descuentoRealizado = 0;
            this.descuentoRealizado2 = 0;
            this.totalConDescuento = 0;
            this.total = 0;
            this.total2 = 0;
            this.productosAgregados = [];


            url = this.path + 'terminar-compra-boleta';
            param = new FormData();
            param.append('codVenta', this.codigoBoletaBuscar);
            axios.post(url, param).then(res => {
                M.toast({html: res.data.value});
                var boleta = res.data.boleta[0];
                var detalle = res.data.detalle;
                var cant = res.data.cant;
                for (var i = 0; i < detalle.length; i++) {
                    console.log(detalle[i][0]);
                    detalle[i][0].cantidad = cant[i].cantidad;
                    detalle[i][0].total = detalle[i][0].cantidad * detalle[i][0].p_venta;
                    this.productosAgregados.push(detalle[i][0]);
                    this.total += detalle[i][0].total;
                }

//                console.log(boleta);
//                console.log(cant);
                this.descuento = boleta.descuento;
                if (this.descuento > 0) {
                    var descuento = this.descuento / 100;
                    descuento = this.total * descuento;
                    this.descuentoRealizado = Math.round(descuento);
                    this.totalConDescuento2 = Math.round(this.total - this.descuentoRealizado);
                    this.totalConDescuento2 = formatNumber.new(this.totalConDescuento2);
                    this.total2 = Math.round(this.total);
                    this.total2 = formatNumber.new(this.total);
                }

                this.total2 = formatNumber.new(this.total);
                this.descuentoRealizado2 = formatNumber.new(this.descuentoRealizado);
                this.totalConDescuento = this.total;
                this.totalConDescuento2 = formatNumber.new(this.total);
                // this.productosVenta = detalle;
            }).catch(e => {
                console.log(e);

            });



        },
        buscarCodigoCompletarVenta: function () {


            var formatNumber = {
                separador: ".", // separador para los miles
                sepDecimal: ',', // separador para los decimales
                formatear: function (num) {
                    num += '';
                    var splitStr = num.split('.');
                    var splitLeft = splitStr[0];
                    var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
                    var regx = /(\d+)(\d{3})/;
                    while (regx.test(splitLeft)) {
                        splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
                    }
                    return this.simbol + splitLeft + splitRight;
                },
                new : function (num, simbol) {
                    this.simbol = simbol || '';
                    return this.formatear(num);
                }
            };

            this.descuento = 0;
            this.descuentoRealizado = 0;
            this.descuentoRealizado2 = 0;
            this.totalConDescuento = 0;
            this.total = 0;
            this.total2 = 0;
            this.productosAgregados = [];


            url = this.path + 'buscar-ventas-boleta-detalle';
            param = new FormData();
            param.append('codVenta', this.codVenta);
            axios.post(url, param).then(res => {
                M.toast({html: res.data.value});
                var boleta = res.data.boleta[0];
                var detalle = res.data.detalle;
                var cant = res.data.cant;
                for (var i = 0; i < detalle.length; i++) {
                    console.log(detalle[i][0]);
                    detalle[i][0].cantidad = cant[i].cantidad;
                    detalle[i][0].total = detalle[i][0].cantidad * detalle[i][0].p_venta;
                    this.productosAgregados.push(detalle[i][0]);
                    this.total += detalle[i][0].total;
                }

                console.log(boleta);
                console.log(cant);
                this.descuento = boleta.descuento;
                if (this.descuento > 0) {
                    var descuento = this.descuento / 100;
                    descuento = this.total * descuento;
                    this.descuentoRealizado = Math.round(descuento);
                    this.totalConDescuento2 = Math.round(this.total - this.descuentoRealizado);
                    this.totalConDescuento2 = formatNumber.new(this.totalConDescuento2);
                    this.total2 = Math.round(this.total);
                    this.total2 = formatNumber.new(this.total);
                }

                this.total2 = formatNumber.new(this.total);
                this.descuentoRealizado2 = formatNumber.new(this.descuentoRealizado);
                this.totalConDescuento = formatNumber.new(this.total);
                this.totalConDescuento2 = formatNumber.new(this.total);
                // this.productosVenta = detalle;
            }).catch(e => {
                console.log(e);
            });


        },

        buscarCodigoVenta: function () {

            var formatNumber = {
                separador: ".", // separador para los miles
                sepDecimal: ',', // separador para los decimales
                formatear: function (num) {
                    num += '';
                    var splitStr = num.split('.');
                    var splitLeft = splitStr[0];
                    var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
                    var regx = /(\d+)(\d{3})/;
                    while (regx.test(splitLeft)) {
                        splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
                    }
                    return this.simbol + splitLeft + splitRight;
                },
                new : function (num, simbol) {
                    this.simbol = simbol || '';
                    return this.formatear(num);
                }
            };

            this.totalConDescuento_caja = 0;
            this.descuento_caja = 0;
            this.total_caja = 0;
            this.descuentoRealizado_caja = 0;
            this.productosVenta = [];


            url = this.path + 'buscar-ventas-boleta-detalle';
            param = new FormData();
            param.append('codVenta', this.codVenta);
            axios.post(url, param).then(res => {

                if (res.data.value == 'No existe boleta') {
                    M.toast({html: res.data.value});
                    this.codVenta = 0;
                } else {
                    if (res.data.value == 'Boleta finalizada') {
                        M.toast({html: res.data.value});
                        this.codVenta = 0;
                    } else {
                        M.toast({html: res.data.value});
                        var boleta = res.data.boleta[0];
                        var detalle = res.data.detalle;
                        var cant = res.data.cant;

                        for (var i = 0; i < detalle.length; i++) {
                            console.log(detalle[i][0]);
                            detalle[i][0].cantidad = cant[i].cantidad;
                            detalle[i][0].total = detalle[i][0].cantidad * detalle[i][0].p_venta;
                            this.productosVenta.push(detalle[i][0]);
                            this.total_caja += detalle[i][0].total;
                        }

                        this.totalConDescuento_caja = this.total_caja - ((boleta.descuento / 100) * this.total_caja);
                        this.totalConDescuento_caja = formatNumber.new(this.totalConDescuento_caja);
                        this.descuento_caja = boleta.descuento;
                        this.descuento_caja = formatNumber.new(this.descuento_caja);
                        this.descuentoRealizado_caja = (boleta.descuento / 100) * this.total_caja;
                        this.descuentoRealizado_caja = formatNumber.new(this.descuentoRealizado_caja);
                        this.total_caja = formatNumber.new(this.total_caja);
                        console.log(boleta);
                        console.log(cant);
                    }
                }
                // this.productosVenta = detalle;
            }).catch(e => {
                console.log(e);
            });



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
                this.comboProveedor = res.data;
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
            if (this.productosAgregados.length <= 0 && this.tipoVenta === 'bBoleta') {
                M.toast({html: 'Debe cargar boleta'});
            } else {
                if (this.buscarProducto == '') {
                    M.toast({html: 'Debe ingresar Nombre'});
                } else {
                    this.getProductos();
                    var elems = document.querySelector('#agregarProduct');
                    var instance = M.Modal.init(elems);
                    instance.open();
                }
            }


        },

        cargarModalFinalizar: function () {
            var elems = document.querySelector('#venta');
            var instance = M.Modal.init(elems);
            instance.open();
        },
        cargarModalCantidad: function (cantidad) {


            var formatNumber = {
                separador: ".", // separador para los miles
                sepDecimal: ',', // separador para los decimales
                formatear: function (num) {
                    num += '';
                    var splitStr = num.split('.');
                    var splitLeft = splitStr[0];
                    var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
                    var regx = /(\d+)(\d{3})/;
                    while (regx.test(splitLeft)) {
                        splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
                    }
                    return this.simbol + splitLeft + splitRight;
                },
                new : function (num, simbol) {
                    this.simbol = simbol || '';
                    return this.formatear(num);
                }
            };


            if (cantidad <= 0) {
                M.toast({html: 'Debe ingresar Cantidad'});
            } else {

                this.total = 0;
                this.totalConDescuento = 0;
                this.descuentoRealizado = 0;
                var pmodal = this.productoModal[0];

                var validacion = pmodal.stock - cantidad;

                if (validacion < 0) {
                    M.toast({html: 'Cantidad insuficiente en stock'});
                    var elems = document.querySelector('#cantidad');
                    var instance = M.Modal.getInstance(elems);
                    instance.close();
                } else {
                    for (var i = 0; i < this.productosAgregados.length; i++) {
                        if (this.productosAgregados[i].idproducto == pmodal.idproducto) {
                            this.productosAgregados.splice(i, 1);
                            console.log('eliminado' + this.productosAgregados[i]);
                        }
                    }
                    //   console.log(pmodal);
                    pmodal.cantidad = cantidad;
                    pmodal.total = cantidad * pmodal.p_venta;
                    this.productosAgregados.push(pmodal);

                    var t = 0;

                    for (var i = 0; i < this.productosAgregados.length; i++) {

                        t += this.productosAgregados[i].total;

                    }

                    var total_sin = t;
                    this.total = t;
                    this.totalConDescuento = t;

//                    var totalp = parseInt(pmodal.total);
//                    this.total += totalp;
//                    var total_sin = this.total;
//                    this.totalConDescuento = this.total;
                    if (this.descuento > 0) {
                        var descuento = this.descuento / 100;
                        descuento = total_sin * descuento;
                        this.descuentoRealizado = Math.round(descuento);
                        this.totalConDescuento = this.total - this.descuentoRealizado;
                    }
                    this.total2 = formatNumber.new(this.total);
                    this.descuentoRealizado2 = formatNumber.new(this.descuentoRealizado);
                    this.totalConDescuento2 = formatNumber.new(this.totalConDescuento);
                    //    this.productosAgregados[0].cantidad = cantidad;
                    var elems = document.querySelector('#cantidad');
                    var instance = M.Modal.getInstance(elems);
                    instance.close();
                    var elems2 = document.querySelector('#agregarProduct');
                    var instance2 = M.Modal.getInstance(elems2);
                    instance2.close();
                }
            }
        },
        cerrarModal: function () {
            this.productos = [];
            var elems = document.querySelector('#agregarProduct');
            var instance = M.Modal.getInstance(elems);
            instance.close();
        },
        cerrarModalCant: function () {

            var elems = document.querySelector('#cantidad');
            var instance = M.Modal.getInstance(elems);
            instance.close();
            this.productos = [];
        },
        cerrarModalCodigo: function () {
            this.productos = [];
            var elems = document.querySelector('#codigo');
            var instance = M.Modal.getInstance(elems);
            instance.close();
        },
        cerrarModalVenta: function () {
            this.productos = [];
            this.codVenta = '';
            var elems = document.querySelector('#venta');
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
            this.cantidad = 0;
            //   this.productosAgregados[0] = p;
            var prod = this.productoModal[0]
            if (prod.stock <= 0) {
                M.toast({html: 'SIN STOCK'});
            } else {
                var elems = document.querySelector('#cantidad');
                var instance = M.Modal.init(elems);
                instance.open();
                //this.productosAgregados[i].cantidad;
            }


        },

        calcularDescuento: function () {
            var formatNumber = {
                separador: ".", // separador para los miles
                sepDecimal: ',', // separador para los decimales
                formatear: function (num) {
                    num += '';
                    var splitStr = num.split('.');
                    var splitLeft = splitStr[0];
                    var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
                    var regx = /(\d+)(\d{3})/;
                    while (regx.test(splitLeft)) {
                        splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
                    }
                    return this.simbol + splitLeft + splitRight;
                },
                new : function (num, simbol) {
                    this.simbol = simbol || '';
                    return this.formatear(num);
                }
            }
            var total_sin = this.total;
            var descuento = this.descuento / 100;
            descuento = total_sin * descuento;
            this.descuentoRealizado = Math.round(descuento);
            this.totalConDescuento = this.total - this.descuentoRealizado;
            this.descuentoRealizado2 = formatNumber.new(this.descuentoRealizado);
            this.totalConDescuento2 = formatNumber.new(this.totalConDescuento);
        },

        insertarVentaBoleta: function () {

            if (this.productosAgregados.length <= 0) {
                M.toast({html: 'Debe ingresar productos'});
            } else {

                if (this.clienteCargar.length <= 0 && this.tipoVenta == "guia") {
                    M.toast({html: 'Debe ingresar cliente'});
                } else {
                    if ((this.codigoGuia == '' || this.codigoGuia == 0) && this.tipoVenta === 'guia') {
                        M.toast({html: 'Debe ingresar N° Guia'});
                    } else {
                        let cadena = '';
                        for (var i = 0; i < this.productosAgregados.length; i++) {
                            cadena += this.productosAgregados[i].idproducto + '-';
                        }
                        console.log(cadena);
                        let divisor = cadena.split('-');
                        for (var i = 0; i < divisor.length; i++) {
                            console.log(divisor[i]);
                        }
                        divisor.pop();
                        // console.log(divisor);



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
                        //  console.log(divisor2);



                        url = this.path + 'insertar-boleta';
                        param = new FormData();
                        param.append('total', this.totalConDescuento);
                        console.log(this.totalConDescuento);
                        param.append('descuento', this.descuento);
                        console.log(this.descuento);
                        param.append('usuario_idusuario', this.sesion[0].idusuario);
                        console.log(this.sesion[0].idusuario);
                        param.append('productosAgregados', cadena);
                        param.append('cantidad', cadena2);
                        param.append('codigoBoletaBuscar', this.codigoBoletaBuscar);
                        param.append('codigoGuia', this.codigoGuia);
                        param.append('idcliente', this.cliente);
                        param.append('descripcion', this.descripcion);
                        console.log(cadena);
                        axios.post(url, param).then(res => {
                            if (res.data.value == 'Debe Anular Boleta') {
                                M.toast({html: res.data.value});
                            } else {


                                M.toast({html: res.data.value});
                                console.log(res.data);
                                this.productosAgregados = [];
                                this.total = 0;
                                this.descuento = 0;
                                this.totalConDescuento = 0;
                                this.descuentoRealizado = 0;
                                this.total2 = 0;
                                this.totalConDescuento2 = 0;
                                this.descuentoRealizado2 = 0;

                                this.limpiarGuia();


                                var elems = document.querySelector('#codigo');
                                var instance = M.Modal.init(elems);
                                instance.open();

                                url = this.path + 'id-boleta';
                                axios.post(url).then(res => {
                                    this.idventa = res.data[0].idventa;
                                }).catch(e => {
                                    console.log(e);
                                });
                            }
                        }).catch(e => {
                            console.log(e);
                        });
                    }

                }
            }
        },

        limpiarGuia: function () {

            this.codigoBoletaBuscar = '';
            this.codigoGuia = '';
            this.productos = [];
            this.total = 0;
            this.descuento = 0;
            this.totalConDescuento = 0;
            this.descuentoRealizado = 0;
            this.total2 = 0;
            this.cliente = '';
            this.totalConDescuento2 = 0;
            this.descuentoRealizado2 = 0;
            this.clienteCargar = '';
            this.buscarProducto = '';
            this.productosAgregados = [];
            this.productosVenta = [];
            this.rutCliente = '';
            this.codVenta = null;
            this.descripcion = '';
        },

        abrirSide: function () {
            var elem = document.querySelector('.sidenav');
            var instance = M.Sidenav.init(elem);
            instance.open();
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
        // this.getClientes();
        //  this.getProductos();
        //this.agregarCantidad();

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
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelector('.sidenav');
            var instances = M.Sidenav.init(elems);
        });

    }
});