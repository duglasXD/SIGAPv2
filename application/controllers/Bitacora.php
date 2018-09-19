<?php
session_start();
  function __construct()

  {

 

  $this->load->database();

  }

  class Bitacora extends CI_Controller {

    public function index()
    {
      $this->load->helper('url');
      $this->load->model('Bitacora_model', 'BM',true);
     // $this->load->model('Rol_model', 'RM',true);
      $this->load->model('Sistema_model', 'SM',true);
      if(!isset($_SESSION['usuario'])){
        redirect('Main/index');
      }
      $this->load->view('head');
      $this->load->view('top_bar');
      $menu['menu']=$this->SM->getSubOpciones();
      $this->load->view('menu',$menu);
      $data['bitacora']=$this->BM->getAllBitacora();   
      $this->load->view('bitacora/indexBitacora',$data);
      //$this->load->view('switch');
      $this->load->view('footer');
      $this->load->view('scripts');
    }

    

  }
?>