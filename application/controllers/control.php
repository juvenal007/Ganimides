<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . "/third_party/dompdf/autoload.inc.php";

use Dompdf\Dompdf;
use Dompdf\Options;

class control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Crud');
        $this->load->model('Pdf');
    }

    public function index() {
        $this->load->view('inicio');
    }

    public function crearUsuario() {
        $this->load->view('usuario');
    }

    public function insertarUsuario() {
        $rut = $this->input->post("rut");
        $nombre = $this->input->post("nombre");
        $apellido_pat = $this->input->post("apellido_pat");
        $apellido_mat = $this->input->post("apellido_mat");
        $direccion = $this->input->post("direccion");
        $telefono1 = $this->input->post("telefono1");
        $telefono2 = $this->input->post("telefono2");
        $usuario = $this->input->post("usuario");
        $password = $this->input->post("password");
        $pregunta = $this->input->post("pregunta");
        $tipo = $this->input->post("tipo");

        if (isset($rut) && isset($usuario) && isset($password)) {
            $this->Crud->insertarUsuario($rut, $nombre, $apellido_pat, $apellido_mat, $direccion, $telefono1, $telefono2, $usuario, sha1(md5($password)), $tipo);
            echo json_encode(array('value' => 'Usuario creado con exito'));
        } else {
            echo json_encode(array('value' => 'Error de datos'));
        }
    }

    public function iniciarSesion() {
        $usuario = $this->input->post("usuario");
        $password = $this->input->post("password");
        $ruta = "";
        $user = "";
        if (isset($usuario) && isset($password)) {
            $user = $this->Crud->iniciarSesion($usuario, sha1(md5($password)));
            $resp = "";
            if (count($user) > 0) {
                if ($user[0]->activo == "si") {
                    if ($user[0]->tipo == "admin") {
                        // RUTA DE ADMIN
                        //$this->session->set_userdata("admin", $user);
                        //se envia la ruta a vue
                        $ruta = base_url() . "menu-user";
                        $resp = "Admin Válido";
                        // se crea la sesion llamada admin
                        $this->session->set_userdata("admin", $user);
                    } else {
                        // RUTA DE USER
                        // $this->session->set_userdata("usuario", $user);
                        //se envia la ruta a vue
                        $ruta = base_url() . "menu-user";
                        $resp = "Usuario Válido";
                        // se crea la sesion llamada admin
                        $this->session->set_userdata("user", $user);
                    }
                } else {
                    // ACTIVACION DE USUARIO;
                    $resp = "Activar usuario";
                }
            } else {
                $resp = "Usuario no válido";
            }
        } else {
            $resp = "Error de parametro";
        }
        echo json_encode(array("value" => $resp, "ruta" => $ruta, "user" => $user));
    }

    public function activo() {
        $idusuario = $this->input->post("idusuario");
        $pregunta = $this->input->post("pregunta");
        $ruta = "";
        if (isset($idusuario) && isset($pregunta)) {
            $this->Crud->activo($idusuario, $pregunta);
            $resp = "USUARIO ACTIVADO EXITOSAMENTE";
            $ruta = base_url('menu-user');
        } else {
            $resp = "Ingrese datos";
        }
        echo json_encode(array("value" => $resp, "ruta" => $ruta));
    }

    public function getSession() {

        $iduser = $this->session->userdata('user');
        $idadmin = $this->session->userdata('admin');

        if (isset($iduser)) {
            echo json_encode(array($iduser[0]));
        }
        if (isset($idadmin)) {
            echo json_encode(array($idadmin[0]));
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('control');
    }

    public function generarPDF($idventa) {

        $fecha = new DateTime();

        $fechaDocu = $fecha->format('Y-m-d H:i:s');

        $options = new Options();
        $options->set('isJavascriptEnabled', TRUE);
        $options->set('isRemoteEnabled', TRUE);
        $pdf = new Dompdf($options);

//        echo json_encode(array('documento' => $documento));


    


        $venta = $this->Crud->getVenta($idventa);
        $productos = $this->Crud->getProductos($idventa);
//        $cantidadProductos = $this->Crud->contarProductosDetalle($idventa);
//        $ultimoArchivo = $this->Modelo->getArchivo($documento[0]->iddocumento);
//        $ultimoArchivo = end($ultimoArchivo);
//
//        $docu_tipo = strtoupper($documento[0]->docu_tipo);
//
        $ruta = $venta[0]->tipo . "-" . $venta[0]->idventa;


//        $path = 'http://localhost/repoEstado/Barcode/barcode_generator/Code128b/30/' . $ruta . '/true';
//        $type = pathinfo($path, PATHINFO_EXTENSION);
//        $data = file_get_contents($path);
//        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);


        $data = array(
//            'departamento' => $departamento[0],
              'venta' => $venta[0],
              'productos' => $productos,
//              'cantidadProductos' => $cantidadProductos,
//            'nombreDocumento' => 'MEMORANDO',
//            'archivo' => $ultimoArchivo,
//            'documento' => $documento[0],
//            'base64' => $base64,
//            'codigo' => $ruta
        );
        $this->load->view('comprobanteDocumento', $data);

        $html = $this->output->get_output(['isRemoteEnabled' => true]);
        $this->load->library('Pdf');
        $pdf->loadHtml($html);
        $pdf->setPaper('letter', 'portrait');
        $pdf->render();
        // Output the generated PDF (1 = download and 0 = preview)
        $pdf->stream($ruta . '-' . $fechaDocu, array("Attachment" => 0));
    }

}
