<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
if("192.168.1.200" == $_SERVER['SERVER_NAME']){
	define("SERVER_MTPS","192.168.1.200");
}else{
	define("SERVER_MTPS","localhost");
}


class Rol extends CI_Controller {

	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Rol_model', 'RM',true);
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
		$this->load->model('Sistema_model', 'SM',true);
			$menu['menu']=$this->SM->getSubOpciones();
		$this->load->view('head');
		$this->load->view('top_bar');
		$this->load->view('menu',$menu);
		
		$data['rol']=$this->RM->getAllRoles();

		
		$this->load->view('roles/indexRol',$data);
		//$this->load->view('switch');
		$this->load->view('footer');
		$this->load->view('scripts');
	}

	public function newRol()
	{
	
		$this->load->view('headFormularios');
		$this->load->view('roles/frmNuevoRol');
	}

	public function updateRol()
	{
		//$hola='hola';
		$this->load->view('headFormularios');
	//	$this->load->model('asociaciones_model', 'AM',true);
		
		$data['rol']=$this->RM->getRol($this->input->get('id'));
		$this->load->view('roles/frmEditRol',$data);

	}

	public function viewRol()
	{
		$this->load->view('headFormularios');
		$data['rol']=$this->RM->getRol($this->input->get('id'));
		$this->load->view('roles/frmVerRol',$data);

	}

	public function cargarOpciones()
	{
		$data=$this->SM->getSubOpciones();
		if($this->input->post('id')>0){
				foreach ($data as $item) {
					echo "<optgroup  label ='".$item['NOMBRE_OPCION_SISTEMA']."' >";
					$aux=$this->SM->getOpcionByDependencia($item['ID_OPCION_SISTEMA']);
	                foreach ($aux as $item2) {
	                	if($this->SM->comprobarOpcion($item2['ID_OPCION_SISTEMA'],$this->input->post('id'))==1){
	                		echo "<option selected='selected' value='".$item2['ID_OPCION_SISTEMA']."'>".$item2['NOMBRE_OPCION_SISTEMA']."</option>";
	                	}else{
	                		echo "<option value='".$item2['ID_OPCION_SISTEMA']."'>".$item2['NOMBRE_OPCION_SISTEMA']."</option>";
	                	}
			 			
			 		}
			 		echo "</optgroup>";
			 	}
			
		}
		else
		{
			foreach ($data as $item) {
				echo "<optgroup  label ='".$item['NOMBRE_OPCION_SISTEMA']."' >";
				$aux=$this->SM->getOpcionByDependencia($item['ID_OPCION_SISTEMA']);
                foreach ($aux as $item2) {
		 			echo "<option value='".$item2['ID_OPCION_SISTEMA']."'>".$item2['NOMBRE_OPCION_SISTEMA']."</option>";
		 		}
		 		echo "</optgroup>";
		 	}
		}
		
	}

	public function saveRol()
	{
		
		if($this->input->post('tipo')==1)
		{
			$data = array(
			'nombre' =>  strtoupper($this->input->post('nombreRol')), 
			'descripcion' => strtoupper($this->input->post('descripcionRol')),
			'opciones' => $this->input->post('opcionesRol')
			);
			echo $this->RM->guardaRol($data);
		}
		else
		{
			$data = array(
			'nombre' =>  strtoupper($this->input->post('nombreRol')), 
			'descripcion' => strtoupper($this->input->post('descripcionRol')),
			'opciones' => $this->input->post('opcionesRol'),
			'id' => $this->input->post('idRol')
			);
			echo $this->RM->editaRol($data);
		}
	}
	public function cargarRoles()
	{
		$data=$this->RM->getAllRoles();
		foreach ($data as $item) {
				
		 			echo "<option value='".$item['ID_ROL_USUARIO']."'>".$item['NOMBRE_ROL_USUARIO']."</option>";
		 		
		 	}

	}
	

	

}
