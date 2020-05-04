var app = new Vue({
    el: 'main',
    data: {
        titulo: 'PROVEEDORES',
        modalProveedor: {}
    },
    methods: {

        cargarModal: function () {
            var elems = document.querySelector('.modal');
            var instance = M.Modal.getInstance(elems);
            instance.open();
        }
    },
    created: function () {

    },
    mounted: function () {
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelector('.modal');
            var instances = M.Modal.init(elems);
        });


    }
});