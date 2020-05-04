<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vista
 *
 * @author JuvenaL
 */
class vista extends CI_Controller {

    public function user() {
        //COMPROBAR SI LA SESSION ES LA CORRECTA HACIA USER
        if ($this->session->userdata('user') || $this->session->userdata('admin')) {
            $this->load->view('menuUser');
        } else {
            redirect('control');
        }
    }    
    public function header() {
        $this->load->view('header');
    }
    
    public function nuevoUser(){
        $this->load->view('usuario');
    }
    public function inventario(){
        $this->load->view('inventario');
    }
    
    public function proveedor(){
        $this->load->view('proveedor');
    }
    
    public function user2(){
        $this->load->view('user');
    }
    public function compra(){
        $this->load->view('compra');
    }
    public function venta(){
        $this->load->view('venta');
    }
    public function informe(){
        $this->load->view('informe');
    }
    public function cliente(){
        $this->load->view('cliente');
    }

}
