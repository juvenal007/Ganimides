new Vue({
    el: '#newapp',
    data: {
        titulo: 'Registro de usuarios',
        rut: '',
        nombre: '',
        path: 'http://localhost/tienda/',
        apellido_pat: '',
        apellido_mat: '',
        direccion: '',
        tel1: '',
        tel2: '',
        usuario: '',
        password: '',
        tipo: '',
        sesion: [],
        datos: [],
        ope: 1,
        usuarios: []
    },
    methods: {
        abrirSide: function () {
            var elem = document.querySelector('.sidenav');
            var instance = M.Sidenav.init(elem);
            instance.open();
        },
        eliminarUsuario: function(p){
            
            var usuario = p;            
            var url = this.path + 'eliminar-usuario';
            var param = new FormData();
            param.append('id', usuario.idusuario);
            console.log(usuario.id);
            if (confirm("Esta seguro que desea eliminar a "+usuario.nombre+"?")) {
                axios.post(url, param).then(res =>{
                console.log(res.data.value);
                this.getUsuario();
            }).catch(e =>{
               console.log(e); 
            });   
            }   
        },        
            opc: function (o) {
            switch (o) {
                case 1:
                    this.ope = 1;       
                    break;
                case 2:
                    this.ope = 2;
                    this.getUsuario();
                    break;
                default:
            }
        },
        
        getUsuario: function (){
          
            var url = this.path + 'lista-usuarios';
            axios.post(url).then(res =>{
                console.log(res.data);
                this.usuarios = res.data;
            }).catch(e => {
               console.log(e); 
            });
        },
        
        insertar: function () {

            if (this.nombre == '' || this.rut == '' || this.direccion == '' ||
                    this.tel1 == '' || this.usuario == '' || this.password == '') {
                M.toast({html: 'Faltan Datos'});
            } else {
                url = this.path + 'control/insertarUsuario/';
                param = new FormData();
                param.append('rut', this.rut);
                param.append('nombre', this.nombre);
                param.append('apellido_pat', this.apellido_pat);
                param.append('apellido_mat', this.apellido_mat);
                param.append('direccion', this.direccion);
                param.append('telefono1', this.tel1);
                param.append('telefono2', this.tel2);
                param.append('usuario', this.usuario);
                param.append('password', this.password);
                param.append('tipo', this.tipo);
                axios.post(url, param).then(res => {
                    o = res.data;
                    M.toast({html: o.value});
                    
                    this.nombre = '';
                    this.rut = '';
                    this.apellido_pat = '';
                    this.apellido_mat = '';
                    this.direccion = '';
                    this.tel1 = '';
                    this.tel2 = '';
                    this.usuario = '';
                    this.password = '';
                    this.tipo = '';
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
        }
    },
    created: function () {
        this.getSession();
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
    }
});
