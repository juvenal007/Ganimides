<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Crud');
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

}
