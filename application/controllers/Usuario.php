<?php




class Usuario extends CI_Controller {

	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	
		
	}
		
		
		//$this->load->model('Bitacora_model', 'BM',true);
		//$this->load->model('login_model', 'Login_Model',true);
		

	
	public function index()
	{
	
		$this->load->model('Usuario_model', 'UM',true);
		$this->load->model('Rol_model', 'RM',true);
		$this->load->model('Sistema_model', 'SM',true);
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$this->load->view('head');
		$this->load->view('top_bar');
		
			$menu['menu']=$this->SM->getSubOpciones();
		$this->load->view('menu',$menu);
		
		$data['usuario']=$this->UM->getAllUsuarios();
		$id=$this->SM->getIdModulo('/Usuario');
		$data['consultar']=$this->SM->getPermiso($id,1);
		$data['editar']=$this->SM->getPermiso($id,4);
		$data['agregar']=$this->SM->getPermiso($id,2);
		
		$this->load->view('usuario/indexUsuario',$data);
		//$this->load->view('switch');
		$this->load->view('footer');
		$this->load->view('scripts');
	}

	public function newUsuario()
	{
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$this->load->helper('url');
		$this->load->view('headFormularios');
		$this->load->view('usuario/frmNuevoUsuario');
	}

	public function updateUsuario()
	{
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$this->load->helper('url');
		$this->load->view('headFormularios');
		$this->load->model('Usuario_model', 'UM',true);
	//	$this->load->model('asociaciones_model', 'AM',true);
		
		$data['usuario']=$this->UM->getUsuario($this->input->get('id'));
		$this->load->view('usuario/frmEditUsuario',$data);

	}

	public function viewUsuario()
	{
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$this->load->helper('url');
		$this->load->view('headFormularios');
		$this->load->model('Usuario_model', 'UM',true);
	//	$this->load->model('asociaciones_model', 'AM',true);
		
		$data['usuario']=$this->UM->getUsuario($this->input->get('id'));
		$this->load->view('usuario/frmViewUsuario',$data);

	}

	public function viewRol()
	{
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$this->load->view('headFormularios');
		$data['rol']=$this->RM->getRol($this->input->get('id'));
		$this->load->view('roles/frmVerRol',$data);

	}

	public function cargarOpciones()
	{
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
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

	public function saveUsuario()
	{
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$this->load->model('Usuario_model', 'UM',true);
		//$x = $_POST['asociacionUsuario'];
		
		if($this->input->post('tipo')==1)
		{
			$data = array(
			'id' =>  $this->input->post('idUsuario'), 
			'nombre' => strtoupper($this->input->post('nombreUsuario')),
			'tipo' => 'Externo',
			'pass' =>  md5($this->input->post('passUsuario')), 
			'estado' => $this->input->post('estadoUsuario'),
			'rol' => 69,
			'asociacion' => $this->input->post('asociacionUsuario')
			);
			echo $this->UM->guardaUsuario($data);
		}
		else
		{
			$data = array(
			'id' =>  $this->input->post('idAux'), 
			'nombre' => strtoupper($this->input->post('nombreUsuario')),
			'tipo' => 'Externo',
			'pass' =>  md5($this->input->post('passUsuario')), 
			'estado' => $this->input->post('estadoUsuario'),
			'rol' => 69,
			'asociacion' => $this->input->post('asociacionUsuario')
			);
			echo $this->UM->editaUsuario($data);
		}
	}

	public function validaId()
	{
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$this->load->model('Usuario_model', 'UM',true);
		echo $this->UM->validateId($this->input->post('id'));
	}



	

	

}
