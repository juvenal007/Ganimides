var app = new Vue({
    el: 'main',
    data: {
        titulo: 'Iniciar Sesion',
        path: 'http://localhost/tienda/',
        usuario: '',
        password: '',
        pregunta: '',        
        modalUser: {}
    },
    methods: {
         
        iniciar: function () {
            var url = this.path + 'control/iniciarSesion/';
            param = new FormData();
            param.append('usuario', this.usuario);
            param.append('password', this.password);
            axios.post(url, param).then(res => {
                if (res.data.value === "Usuario no válido") {
                    M.toast({html: res.data.value});

                } else {
                    if (res.data.value === "Activar usuario") {
                        this.modalUser = res.data.user;
                        //this.user = res.data.user;
                        var elems = document.querySelector('.modal');
                        var instance = M.Modal.getInstance(elems);
                        instance.open();
                     //   this.usuario = "";
                     //   this.password = "";
                        //window.location.href = ""
                    } else {
                        window.location.href = res.data.ruta;
                    }
                    o = res.data;
                    M.toast({html: o.value});
                }
            }).catch(e => {
                console.log(e);
                window.location.href = this.path + 'menu-user/';
            });
        },
        activo: function () {
            url = this.path + "control/activo";
            param = new FormData();
            param.append("idusuario", this.modalUser[0].idusuario);
            param.append("pregunta", this.modalUser[0].pregunta);
            if (this.pregunta === "") {
                M.toast({html: "Complete respuesta"});
            } else {
                axios.post(url, param)
                        .then(resp => {
                            if (resp.data.value == "USUARIO ACTIVADO EXITOSAMENTE") {
                                this.iniciar();
                                //window.location.href=resp.data.ruta
                            } else {
                                M.toast({html: resp.data.value});
                            }
                        })
                        .catch(e => {
                            console.log(e);
                        });
            }
        }, // FIN FUNCION activo;

        iniciarEnter: function (event) {
            // who caused it? "event.target.id"
            // console.log('keyup from id: ' + event.target.id)
            // what was pressed?
            let keyMessage = 'keyup: ';
            if (event.key == "Enter") {
                //  console.log("enter"); AL PRESIONAR TECLA EN EL PASSWORD ACTIVA EL METODO 
                this.iniciar();
            }
        },
        iniciarEnter2: function (event) {
            // who caused it? "event.target.id"
            // console.log('keyup from id: ' + event.target.id)
            // what was pressed?
            let keyMessage = 'keyup: ';
            if (event.key == "Enter") {
                //  console.log("enter"); AL PRESIONAR TECLA EN EL PASSWORD ACTIVA EL METODO 
                this.activo();
            }
        }

    },
    created: function () {

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
    }
});





