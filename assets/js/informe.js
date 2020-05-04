new Vue({
    el: '#newapp',
    data: {
        idGuia: '',
        idcliente: '',
        codGuia: '',
        name: '',
        idfactura: '',
        cant: 0,
        idventa: '',
        descuento: 0,
        descuentoRealizado: 0,
        descuentoRealizado2: 0,
        totalConDescuento: 0,
        totalConDescuento2: 0,
        total: 0,
        total2: 0,
        productosAgregados: [],
        detalleProductosModal: [],
        totalU: 0,
        idproducto: '',
        idusuario: 0,
        titulo: 'INFORMES',
        titulo2: 'Informes de ventas',
        path: 'http://localhost/tienda/',
        opc: 1,
        opcVenta: 1,
        ano: 0,
        mes: 0,
        diasContar: 31,
        dia: 0,
        fecha1: 0,
        fecha2: 0,
        buscador: '',
        totalVentas: 0,
        contarVentas: 0,
        ventaConIva: 0,
        gananciaTotal: 0,
        ventas: [],
        productos: [],
        sesion: [],
        productoMes: [],
        producto: [],
        detallesModal: [],
        facturaP: [],
        factura: [],
        guias: [],
        clienteModal: [],
        guia: {}

    },
    methods: {
 abrirSide: function () {
            var elem = document.querySelector('.sidenav');
            var instance = M.Sidenav.init(elem);
            instance.open();
        },
        finalizarGuia: function (p) {

            var venta = p;
            var id = venta.idventa;
            var guiasList = this.guias;
//            console.log(id+'VENTAID');           
            url = this.path + 'finalizar-venta-boleta'
            param = new FormData();
            param.append('codigo', venta.idventa);
            axios.post(url, param).then(res => {
                M.toast({html: res.data.value});

                for (var i = 0; i < guiasList.length; i++) {
                    if (guiasList[i].idventa == id) {
                        guiasList[i].estado = 'FINALIZADA';
                    }
                }
                this.guias = [];
                this.guias = guiasList;
//                console.log(guiasList+'NUEVA LISTA CON FINALIZADA');
                this.calcularTotal(this.guias);
            }).catch(e => {
                console.log(e);
            });
            //    M.toast({html: 'VENTA FINALIZADA'});
        },

        cargarCliente: function (p) {
            var cliente = p;
            this.idcliente = cliente.idcliente;
            var elems = document.querySelector('#buscarCliente');
            var instance = M.Modal.getInstance(elems);
            instance.close();
            this.clienteModal = [];
        },
        cerrarModalCliente: function () {
            var elems = document.querySelector('#buscarCliente');
            var instance = M.Modal.getInstance(elems);
            instance.close();
            this.clienteModal = [];
        },
        modalBuscarGuia: function () {
            var elems = document.querySelector('#buscarGuia');
            var instance = M.Modal.getInstance(elems);
            instance.close();
            this.clienteModal = [];
        },
        cerrarModalBuscarGuia: function () {
            var elems = document.querySelector('#buscarGuia');
            var instance = M.Modal.getInstance(elems);
            instance.close();

        },
        getClientes: function () {
            url = this.path + 'lista-clientes/',
                    axios.post(url).then(res => {
                this.clienteModal = res.data.value;
            }).catch(e => {
                console.log(e);
            });

        },

        modalBuscarCliente: function () {
            this.getClientes();
            var elems = document.querySelector('#buscarCliente');
            var instance = M.Modal.init(elems);
            instance.open();
        },

        calcularTotal: function (g) {

            var guia = g;
            var guiasFinalizadas = [];

            for (var i = 0; i < guia.length; i++) {
                if (guia[i].estado == 'FINALIZADA') {
                    guiasFinalizadas.push(guia[i]);
                }
            }
            var total = 0;

            for (var i = 0; i < guiasFinalizadas.length; i++) {
                total += parseInt(guiasFinalizadas[i].total);
//                console.log(guiasFinalizadas[i].total);
            }
            console.log(guiasFinalizadas);
            this.ventaConIva = total;


        },

        guiaFecha: function () {

            if (this.idcliente != '') {
                var url = this.path + 'guia-fecha-rut';
                var param = new FormData();
                param.append('fecha1', this.fecha1);
                param.append('fecha2', this.fecha2);
                param.append('idcliente', this.idcliente);
                axios.post(url, param).then(res => {
                    console.log(res.data.value);
                    this.guias = res.data.value;
                    var g = this.guias;
//                    console.log(g);
                    this.calcularTotal(g);
                }).catch(e => {
                    console.log(e);
                });
            } else {
                var url = this.path + 'guia-fecha';
                var param = new FormData();
                param.append('fecha1', this.fecha1);
                param.append('fecha2', this.fecha2);
                axios.post(url, param).then(res => {
//                    console.log(res.data.value);
                    this.guias = res.data.value;
                    var g = this.guias;
//                    console.log(g);
                    this.calcularTotal(g);
                    if (this.guias.length === 0) {
                        M.toast({html: 'Sin datos'});
                        this.limpiar();
                    }
                }).catch(e => {
                    console.log(e);
                });
            }
            this.limpiarGuia();
        },

        guiaDia: function () {

            if (this.dia == 1) {
                this.dia = '01'
            } else if (this.dia == 2) {
                this.dia = '02'
            } else if (this.dia == 3) {
                this.dia = '03';
            } else if (this.dia == 4) {
                this.dia = '04'
            } else if (this.dia == 5) {
                this.dia = '05';
            } else if (this.dia == 6) {
                this.dia = '06'
            } else if (this.dia == 7) {
                this.dia = '07';
            } else if (this.dia == 8) {
                this.dia = '08'
            } else if (this.dia == 9) {
                this.dia = '09';
            }


            if (this.idcliente != '') {
                var url = this.path + 'guia-dia-rut';
                var param = new FormData();
                param.append('dia', this.dia);
                param.append('idcliente', this.idcliente);
                axios.post(url, param).then(res => {
                    console.log(res.data.value);
                    this.guias = res.data.value;
                    var g = this.guias;
                    console.log(g);
                    this.calcularTotal(g);
                }).catch(e => {
                    console.log(e);
                });
            } else {
                var url = this.path + 'guia-dia';
                var param = new FormData();
                param.append('dia', this.dia);
                axios.post(url, param).then(res => {
                    console.log(res.data.value);
                    this.guias = res.data.value;
                    var g = this.guias;
                    console.log(g);
                    this.calcularTotal(g);
                    if (this.guias.length === 0) {
                        M.toast({html: 'Sin datos'});
                        this.limpiar();
                    }
                }).catch(e => {
                    console.log(e);
                });
            }
            this.limpiarGuia();




        },
        guiaMes: function () {
            if (this.idcliente != '') {
                var url = this.path + 'guia-mes-rut';
                var param = new FormData();
                param.append('mes', this.mes);
                param.append('idcliente', this.idcliente);
                axios.post(url, param).then(res => {
                    console.log(res.data.value);
                    this.guias = res.data.value;
                    var g = this.guias;
                    console.log(g);
                    this.calcularTotal(g);
                }).catch(e => {
                    console.log(e);
                });
            } else {
                var url = this.path + 'guia-mes';
                var param = new FormData();
                param.append('mes', this.mes);
                axios.post(url, param).then(res => {
                    console.log(res.data.value);
                    this.guias = res.data.value;
                    var g = this.guias;
                    console.log(g);
                    this.calcularTotal(g);
                    if (this.guias.length === 0) {
                        M.toast({html: 'Sin datos'});
                        this.limpiar();
                    }
                }).catch(e => {
                    console.log(e);
                });
            }
            this.limpiarGuia();
        },

        buscarFacturaId: function () {

            var id = this.idfactura;

            if (this.idfactura == '' || this.idfactura == 0) {
                M.toast({html: 'Falta N° Factura'});
            } else {
                url = this.path + 'buscar-factura-id';
                var param = new FormData();
                param.append('idfactura', id);
                axios.post(url, param).then(res => {
                    this.factura = res.data.value;
                    this.facturaP = res.data.detalle;
                    this.factura[0].cantidad = this.facturaP.length;

                    var cant = 0;

                    for (var i = 0; i < this.facturaP.length; i++) {

                        var can = 0;
                        can = parseInt(this.facturaP[i].cantidad);

                        var totalCompra = 0;

                        totalCompra = parseInt(this.facturaP[i].p_ventaconiva) * can;

                        this.facturaP[i].p_totalCompra = totalCompra;

                        cant += parseInt(this.facturaP[i].cantidad);
                    }

                    this.factura[0].cantidadT = cant;

                }).catch(e => {
                    console.log(e);
                });
            }



        },

        buscarVentaId: function () {

            var url = this.path + 'buscar-venta-id';
            var param = new FormData();
            param.append('idventa', this.idventa);
            axios.post(url, param).then(res => {
                this.detallesModal = res.data.detalle;
                this.detalleProductosModal = res.data.value;

                var total = 0;
                var cantidad = 0;
                var cantAcumulada = 0;
                var v1 = 0;
                var v2 = 0;
                var ganancia = 0;
                var totalFinal = 0;
                for (var i = 0; i < this.detalleProductosModal.length; i++) {
                    v1 = parseInt(this.detalleProductosModal[i].p_venta - this.detalleProductosModal[i].p_ventaconiva);
                    cantidad = parseInt(this.detalleProductosModal[i].cantidad);
                    v2 += parseInt(this.detalleProductosModal[i].p_ventaconiva * cantidad);
                    ganancia += (v1 * cantidad);

                    cantAcumulada += parseInt(cantidad);
                    total = parseInt(cantidad * this.detalleProductosModal[i].p_venta);
                    totalFinal += total;
                    this.detalleProductosModal[i].totalProd = total;
                }
                this.contarVentas = cantAcumulada;
                this.gananciaTotal = ganancia;
                this.ventaConIva = v2;
                this.totalVentas = totalFinal;

                this.detallesModal[0].cantidadP = this.detalleProductosModal.length;
                this.detallesModal[0].cantidadU = cantAcumulada;
            }).catch(e => {
                console.log(e);
            });

        },

        cargarGuia: function () {

            
            var id = this.idguia;
            var url = this.path + 'obtener-guia';
            var param = new FormData();
            param.append('idguia', id);
            axios.post(url, param).then(res => {
                this.limpiarGuia();
                console.log(res.data.value);
                this.guia = res.data.value;
                if (this.guia.tipo == 'Guia') {
                   this.modalDetalleFechas(this.guia); 
                }else{
                   M.toast({html: 'Debe ser una guia'}); 
                }
                

            }).catch(e => {
                console.log(e);
                M.toast({html: 'Guia no existe'});
                this.limpiar();
            });


        },

        modalDetalleFechas: function (p) {
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
        getDiasIdProducto: function () {

            if (this.dia == 1) {
                this.dia = '01'
            } else if (this.dia == 2) {
                this.dia = '02'
            } else if (this.dia == 3) {
                this.dia = '03';
            } else if (this.dia == 4) {
                this.dia = '04'
            } else if (this.dia == 5) {
                this.dia = '05';
            } else if (this.dia == 6) {
                this.dia = '06'
            } else if (this.dia == 7) {
                this.dia = '07';
            } else if (this.dia == 8) {
                this.dia = '08'
            } else if (this.dia == 9) {
                this.dia = '09';
            }

            this.productoMes = [];
            this.producto = [];
            this.gananciaTotal = 0;
            this.totalVentas = 0;
            this.contarVentas = 0;
            this.ventaConIva = 0;
            if (this.idproducto == '') {
                M.toast({html: 'Debe ingresar un el ID de un producto'});
            } else {
                var url = this.path + 'lista-fecha-producto-dia';
                var param = new FormData();
                param.append('idproducto', this.idproducto);
                param.append('dia', this.dia);
                axios.post(url, param).then(res => {
                    console.log(res.data.value);
                    this.productoMes = res.data.productomes;
                    this.producto = res.data.producto;
                    if (this.productoMes.length == 0) {
                        M.toast({html: 'SIN DATOS'});
                    } else {
                        var cantidad = 0;
                        var total = 0;
                        var ganancia = 0;
                        var ventaConI = 0;
                        var cantidadTotal = 0;
                        for (var i = 0; i < this.productoMes.length; i++) {
                            cantidad += parseInt(this.productoMes[i].cantidad);
                            cantidadTotal = parseInt(this.productoMes[i].cantidad * this.productoMes[i].p_venta);
                            this.productoMes[i].TotalVentas = cantidadTotal;
                            console.log('cant');
                        }
                        ganancia = parseInt(this.producto[0].p_venta - this.producto[0].p_ventaconiva);
                        ganancia = ganancia * cantidad;
                        total = cantidad * parseInt(this.producto[0].p_venta);
                        ventaConI = cantidad * parseInt(this.producto[0].p_ventaconiva);
                        console.log(cantidad);
                        this.gananciaTotal = ganancia;
                        this.totalVentas = total;
                        this.contarVentas = cantidad;
                        this.ventaConIva = ventaConI;
                        this.idproducto = '';
                    }
                }).catch(e => {
                    console.log(e);
                });
            }



        },
        getMesIdProducto: function () {

            this.productoMes = [];
            this.producto = [];
            this.gananciaTotal = 0;
            this.totalVentas = 0;
            this.contarVentas = 0;
            this.ventaConIva = 0;
            if (this.idproducto == '') {
                M.toast({html: 'Debe ingresar un el ID de un producto'});
            } else {
                var url = this.path + 'lista-fecha-producto';
                var param = new FormData();
                param.append('idproducto', this.idproducto);
                param.append('mes', this.mes);
                axios.post(url, param).then(res => {
                    console.log(res.data.value);
                    this.productoMes = res.data.productomes;
                    this.producto = res.data.producto;
                    if (this.productoMes.length == 0) {
                        M.toast({html: 'SIN DATOS'});
                    } else {
                        var cantidad = 0;
                        var total = 0;
                        var ganancia = 0;
                        var ventaConI = 0;
                        var cantidadTotal = 0;
                        for (var i = 0; i < this.productoMes.length; i++) {
                            cantidad += parseInt(this.productoMes[i].cantidad);
                            cantidadTotal = parseInt(this.productoMes[i].cantidad * this.productoMes[i].p_venta);
                            this.productoMes[i].TotalVentas = cantidadTotal;
                            console.log('cant');
                        }
                        ganancia = parseInt(this.producto[0].p_venta - this.producto[0].p_ventaconiva);
                        ganancia = ganancia * cantidad;
                        total = cantidad * parseInt(this.producto[0].p_venta);
                        ventaConI = cantidad * parseInt(this.producto[0].p_ventaconiva);
                        console.log(cantidad);
                        this.gananciaTotal = ganancia;
                        this.totalVentas = total;
                        this.contarVentas = cantidad;
                        this.ventaConIva = ventaConI;
                        this.idproducto = '';
                    }
                }).catch(e => {
                    console.log(e);
                });
            }



        },
        getFecha: function () {
            url = this.path + 'get-fechas';
            param = new FormData();
            param.append('fecha1', this.fecha1);
            param.append('fecha2', this.fecha2);
            axios.post(url, param).then(res => {
                M.toast({html: 'ok'});
                console.log(res.data.value);
                this.contarVentas = res.data.count;
                this.ventas = res.data.value;
                this.buscador = 'fecha';
                console.log(res.data.detalle);
                this.productoMes = res.data.detalle;


                if (this.productoMes.length == 0) {
                    M.toast({html: 'SIN DATOS'});
                } else {
                    var cantidad = 0;
                    var total = 0;
                    var ganancia = 0;
                    var ventaAcumulada = 0;
                    var cantidadTotal = 0;
                    var v1 = 0;
                    var v2 = 0;
                    var gananciaAcumulada = 0;
                    for (var i = 0; i < this.productoMes.length; i++) {

                        cantidad += parseInt(this.productoMes[i].cantidad);
                        ganancia = parseInt(this.productoMes[i].p_venta - this.productoMes[i].p_ventaconiva)
                        ganancia = ganancia * this.productoMes[i].cantidad;
                        gananciaAcumulada += ganancia;

                        v1 = parseInt(this.productoMes[i].p_ventaconiva * this.productoMes[i].cantidad);
                        ventaAcumulada += v1;

                        cantidadTotal = parseInt(this.productoMes[i].cantidad * this.productoMes[i].p_venta);
                        this.productoMes[i].TotalVentas = cantidadTotal;
                        total += this.productoMes[i].TotalVentas;
                        console.log('cant');
                    }

                    this.gananciaTotal = gananciaAcumulada;
                    this.totalVentas = total;
                    this.contarVentas = cantidad;
                    this.ventaConIva = ventaAcumulada;
                    this.idproducto = '';
                }

            }).catch(e => {
                console.log(e);
            });
        },
        buscarDia: function () {

            if (this.dia == 1) {
                this.dia = '01'
            } else if (this.dia == 2) {
                this.dia = '02'
            } else if (this.dia == 3) {
                this.dia = '03';
            } else if (this.dia == 4) {
                this.dia = '04'
            } else if (this.dia == 5) {
                this.dia = '05';
            } else if (this.dia == 6) {
                this.dia = '06'
            } else if (this.dia == 7) {
                this.dia = '07';
            } else if (this.dia == 8) {
                this.dia = '08'
            } else if (this.dia == 9) {
                this.dia = '09';
            }

            url = this.path + 'get-fechas-dia';
            param = new FormData();
            param.append('dia', this.dia);
            axios.post(url, param).then(res => {
                M.toast({html: 'ok'});
                console.log(res.data.value);
                this.contarVentas = res.data.count;
                this.ventas = res.data.value;
                this.buscador = 'dia';
                console.log(res.data.detalle);
                this.productoMes = res.data.detalle;
                //    this.producto = res.data.producto;

                if (this.productoMes.length == 0) {
                    M.toast({html: 'SIN DATOS'});
                } else {
                    var cantidad = 0;
                    var total = 0;
                    var ganancia = 0;
                    var ventaAcumulada = 0;
                    var cantidadTotal = 0;
                    var v1 = 0;
                    var v2 = 0;
                    var gananciaAcumulada = 0;
                    for (var i = 0; i < this.productoMes.length; i++) {

                        cantidad += parseInt(this.productoMes[i].cantidad);
                        ganancia = parseInt(this.productoMes[i].p_venta - this.productoMes[i].p_ventaconiva)
                        ganancia = ganancia * this.productoMes[i].cantidad;
                        gananciaAcumulada += ganancia;

                        v1 = parseInt(this.productoMes[i].p_ventaconiva * this.productoMes[i].cantidad);
                        ventaAcumulada += v1;

                        cantidadTotal = parseInt(this.productoMes[i].cantidad * this.productoMes[i].p_venta);
                        this.productoMes[i].TotalVentas = cantidadTotal;
                        total += this.productoMes[i].TotalVentas;
                        console.log('cant');
                    }

                    this.gananciaTotal = gananciaAcumulada;
                    this.totalVentas = total;
                    this.contarVentas = cantidad;
                    this.ventaConIva = ventaAcumulada;
                    this.idproducto = '';
                }



//                var total = 0;
//                for (var i = 0; i < this.ventas.length; i++) {
//                    total += parseInt(this.ventas[i].total);
//                }
//                this.totalVentas = this.formatNumber(total);
            }).catch(e => {
                console.log(e);
                ;
            });
        },
        buscarMes: function () {

            this.productoMes = [];
            this.producto = [];
            this.gananciaTotal = 0;
            this.totalVentas = 0;
            this.contarVentas = 0;
            this.ventaConIva = 0;
            url = this.path + 'get-fechas-mes';
            param = new FormData();
            param.append('mes', this.mes);
            axios.post(url, param).then(res => {
                M.toast({html: 'ok'});
                console.log(res.data.value);
                this.contarVentas = res.data.count;
                this.ventas = res.data.value;
                this.buscador = 'mes';
                console.log(res.data.detalle);
                this.productoMes = res.data.detalle;
                //    this.producto = res.data.producto;

                if (this.productoMes.length == 0) {
                    M.toast({html: 'SIN DATOS'});
                } else {
                    var cantidad = 0;
                    var total = 0;
                    var ganancia = 0;
                    var ventaAcumulada = 0;
                    var cantidadTotal = 0;
                    var v1 = 0;
                    var v2 = 0;
                    var gananciaAcumulada = 0;
                    for (var i = 0; i < this.productoMes.length; i++) {

                        cantidad += parseInt(this.productoMes[i].cantidad);
                        ganancia = parseInt(this.productoMes[i].p_venta - this.productoMes[i].p_ventaconiva)
                        ganancia = ganancia * this.productoMes[i].cantidad;
                        gananciaAcumulada += ganancia;

                        v1 = parseInt(this.productoMes[i].p_ventaconiva * this.productoMes[i].cantidad);
                        ventaAcumulada += v1;

                        cantidadTotal = parseInt(this.productoMes[i].cantidad * this.productoMes[i].p_venta);
                        this.productoMes[i].TotalVentas = cantidadTotal;
                        total += this.productoMes[i].TotalVentas;
                        console.log('cant');
                    }

                    this.gananciaTotal = gananciaAcumulada;
                    this.totalVentas = total;
                    this.contarVentas = cantidad;
                    this.ventaConIva = ventaAcumulada;
                    this.idproducto = '';
                }


            }).catch(e => {
                console.log(e);
                ;
            });
        },
        buscarFechaAnual: function () {


            url = this.path + 'get-fechas-anual';
            param = new FormData();
            param.append('fecha', this.ano);
            axios.post(url, param).then(res => {
                M.toast({html: 'ok'});
                console.log(res.data.value);
                this.contarVentas = res.data.count;
                this.ventas = res.data.value;
                this.buscador = 'mes';
                console.log(res.data.detalle);
                this.productoMes = res.data.detalle;
                //    this.producto = res.data.producto;

                if (this.productoMes.length == 0) {
                    M.toast({html: 'SIN DATOS'});
                } else {
                    var cantidad = 0;
                    var total = 0;
                    var ganancia = 0;
                    var ventaAcumulada = 0;
                    var cantidadTotal = 0;
                    var v1 = 0;
                    var v2 = 0;
                    var gananciaAcumulada = 0;
                    for (var i = 0; i < this.productoMes.length; i++) {

                        cantidad += parseInt(this.productoMes[i].cantidad);
                        ganancia = parseInt(this.productoMes[i].p_venta - this.productoMes[i].p_ventaconiva)
                        ganancia = ganancia * this.productoMes[i].cantidad;
                        gananciaAcumulada += ganancia;

                        v1 = parseInt(this.productoMes[i].p_ventaconiva * this.productoMes[i].cantidad);
                        ventaAcumulada += v1;

                        cantidadTotal = parseInt(this.productoMes[i].cantidad * this.productoMes[i].p_venta);
                        this.productoMes[i].TotalVentas = cantidadTotal;
                        total += this.productoMes[i].TotalVentas;
                        console.log('cant');
                    }

                    this.gananciaTotal = gananciaAcumulada;
                    this.totalVentas = total;
                    this.contarVentas = cantidad;
                    this.ventaConIva = ventaAcumulada;
                    this.idproducto = '';
                }

            }).catch(e => {
                console.log(e);
            });
        },
        cambiarOpc: function (o) {
            switch (o) {

                case 1:
                    this.opc = 1;
                    this.titulo2 = 'Informes de ventas';
                    this.limpiar();
                    break;
                case 2:
                    this.opc = 2;
                    this.titulo2 = 'Buscar Facturas Recibidas';
                    this.limpiar();
                    break;
                case 3:
                    this.opc = 3;
                    this.titulo2 = 'Buscar Guias';
                    this.limpiar();
                    break;
                case 4:
                    this.opc = 4;
                    this.titulo2 = 'Estado Ventas';
                    break;
                default:

            }
            ;
        },
        getSession: function () {
            url = this.path + 'control/getSession/';
            axios.post(url).then(res => {
                this.sesion = res.data;
            }).catch(e => {
                console.log(e);
            });
        },
        cargarModal: function () {
            var elems = document.querySelector('#buscarId');
            var instance = M.Modal.init(elems);
            instance.open();
        },
        cargarModalBuscarId: function () {
            this.getProductos();
            var elems = document.querySelector('#buscarId');
            var instance = M.Modal.init(elems);
            instance.open();
        },
        cerrarModal: function () {
            this.productos = [];
            var elems = document.querySelector('#buscarId');
            var instance = M.Modal.getInstance(elems);
            instance.close();
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
        limpiar: function () {
            this.ventas = [];
            this.totalVentas = '';
            this.contarVentas = '';
            this.ano = 0;
            this.mes = 0;
            this.dia = 0;
            this.fecha1 = 0;
            this.fecha2 = 0;
            this.productoMes = [];
            this.producto = [];
            this.gananciaTotal = 0;
            this.totalVentas = 0;
            this.contarVentas = 0;
            this.ventaConIva = 0;
            this.detallesModal = [];
            this.detalleProductosModal = [];
            this.facturaP = [];
            this.factura = [];
            this.idfactura = '';
            this.guias = [];
            this.rutCliente = '';
            this.idcliente = '';
            this.idguia = '';
        },
        limpiarGuia: function () {
            // this.ventas = [];
//            this.totalVentas = '';
//            this.contarVentas = '';
            this.ano = 0;
            this.mes = 0;
            this.dia = 0;
            this.fecha1 = 0;
            this.fecha2 = 0;
//            this.productoMes = [];
//            this.producto = [];
//            this.gananciaTotal = 0;
//            this.totalVentas = 0;
//            this.contarVentas = 0;
//            this.ventaConIva = 0;
//            this.detallesModal = [];
//            this.detalleProductosModal = [];
//            this.facturaP = [];
//            this.factura = [];
            this.idfactura = '';
            this.guias = [];
            this.idcliente = '';
            this.idguia = '';
        },
        getProductos: function () {
            url = this.path + 'lista-producto';
            axios.post(url).then(res => {
                this.productos = res.data.value;

            }).catch(e => {
                console.log(e);
            });
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