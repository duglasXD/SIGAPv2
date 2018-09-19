<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');



class Sistema extends CI_Controller {

	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Sistema_model', 'SM',true);
		//$this->load->model('Bitacora_model', 'BM',true);
		//$this->load->model('login_model', 'Login_Model',true);
		
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if(!isset($_SESSION['usuario'])){
			redirect('Main/index');
		}
		$this->load->view('head');

			$menu['menu']=$this->SM->getSubOpciones();
		$this->load->view('top_bar');
		$this->load->view('menu',$menu);
		
		$data['opciones']=$this->SM->getAllOpciones();

		
		$this->load->view('sistema/indexSistema',$data);
		//$this->load->view('switch');
		$this->load->view('footer');
		$this->load->view('scripts');
	}

	public function newOpcion()
	{
	
		$this->load->view('headFormularios');
		$this->load->view('sistema/frmNuevaOpcion');
	}

	public function updateOpcion()
	{
		//$hola='hola';
		$this->load->view('headFormularios');
		
		$data['opcion']=$this->SM->getOpcion($this->input->get('id'));
		$this->load->view('sistema/frmEditOpcion',$data);

	}

	public function viewOpcion()
	{
		$this->load->view('headFormularios');
		
		$data['opcion']=$this->SM->getOpcion($this->input->get('id'));
		$this->load->view('sistema/frmVerOpcion',$data);

	}

	public function cargarDependencias()
	{
		$data=$this->SM->getSubOpciones();
		echo "<option value='-1'>Escoja una dependencia</option>";
		if($this->input->post('tipo')==2){
			foreach ($data as $item) {
			
				echo "<option value='".$item['ID_OPCION_SISTEMA']."'>".$item['NOMBRE_OPCION_SISTEMA']."</option>";
			}
		 	
		}
		else{
			foreach ($data as $item) {
				if($this->SM->comprobarOpcion2($item['ID_OPCION_SISTEMA'],$this->input->post('id'))==1)
				{
					echo "<option selected='selected' value='".$item['ID_OPCION_SISTEMA']."'>".$item['NOMBRE_OPCION_SISTEMA']."</option>";
				}
				else
				{
					echo "<option value='".$item['ID_OPCION_SISTEMA']."'>".$item['NOMBRE_OPCION_SISTEMA']."</option>";
				}
		 	}

		}
		
	}

	public function saveOpcion()
	{
		if($this->input->post('tipo')==2)
		{
				$data = array(
					'nombre' =>  strtoupper($this->input->post('nombreOpcion')), 
					'ruta' => $this->input->post('rutaOpcion'),
					'nivel' => $this->input->post('nivelOpcion'),
					'dependencia' => $this->input->post('dependenciaOpcion'),
					'id' => $this->input->post('idOpcion')
					);
			//	$this->load->model('asociaciones_model', 'AM',true);
				echo $this->SM->editaOpcion($data);
		}
		else{
				$data = array(
					'nombre' =>  strtoupper($this->input->post('nombreOpcion')), 
					'ruta' => $this->input->post('rutaOpcion'),
					'nivel' => $this->input->post('nivelOpcion'),
					'dependencia' => $this->input->post('dependenciaOpcion')
					);
			//	$this->load->model('asociaciones_model', 'AM',true);
				echo $this->SM->guardaOpcion($data);
		}
	}

	

	

}
