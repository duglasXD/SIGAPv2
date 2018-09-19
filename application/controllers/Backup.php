<?php
session_start();
date_default_timezone_set('America/El_Salvador');
defined('BASEPATH') OR exit('No direct script access allowed');



class Backup extends CI_Controller {

	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	
		$this->load->model('Documento_model', 'DM',true);
		//$this->load->model('Sistema_model', 'SM',true);
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
		
		$data['documento']=$this->DM->getAllDocs();

		
		$this->load->view('backup/indexBackup');
		//$this->load->view('switch');
		$this->load->view('footer');
		$this->load->view('scripts');
	}

	public function newDocumento()
	{
	
		$this->load->view('headFormularios');
		$this->load->view('documentos/frmNuevoDocumento');
	}

	public function updateDocumento()
	{
		//$hola='hola';
		$this->load->view('headFormularios');
	//	$this->load->model('asociaciones_model', 'AM',true);
		
		$data['documento']=$this->DM->getDocumento($this->input->get('id'));
		$this->load->view('documentos/frmEditDocumento',$data);

	}

	public function viewDocumento()
	{
		$this->load->view('headFormularios');
		$data['rol']=$this->RM->getRol($this->input->get('id'));
		$this->load->view('roles/frmVerRol',$data);

	}

	

	public function saveDocumento()
	{
		
		if($this->input->post('tipo')==1)
		{
			  $config['upload_path'] = './docs/';
		        
		       //Tipos de ficheros permitidos
		        $config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|pptx|pdf|gif|jpeg|jpg|png';
		         
		       //Se pueden configurar aun mas parámetros.
		       //Cargamos la librería de subida y le pasamos la configuración 

		        $this->load->library('upload', $config);
		      if(!$this->upload->do_upload()){
            /*Si al subirse hay algún error lo meto en un array para pasárselo a la vista*/
                $error= $this->upload->display_errors();
                echo $error;
       			 }
		         $datos=$this->upload->data();

			$data = array(
			'nombre' =>  strtoupper($this->input->post('nombreDocumento')), 
			'tipo' => $this->input->post('tipoDocumento'),
			'estado' => $this->input->post('estadoDocumento'),
			'acceso' => $this->input->post('accesoDocumento'),
			'ruta' => "docs/".$datos['file_name']
			);
			echo $this->DM->guardaDocumento($data);
		}
		else
		{
			 $config['upload_path'] = './docs/';
		        
		       //Tipos de ficheros permitidos
		        $config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|pptx|pdf|jpg|png';
		         
		       //Se pueden configurar aun mas parámetros.
		       //Cargamos la librería de subida y le pasamos la configuración 

		        $this->load->library('upload', $config);
		      if(!$this->upload->do_upload()){
            /*Si al subirse hay algún error lo meto en un array para pasárselo a la vista*/
                $error= $this->upload->display_errors();
                echo $error;
       			 }
		         $datos=$this->upload->data();

			$data = array(
			'id' => $this->input->post('id'),
			'nombre' =>  strtoupper($this->input->post('nombreDocumento')), 
			'tipo' => $this->input->post('tipoDocumento'),
			'estado' => $this->input->post('estadoDocumento'),
			'acceso' => $this->input->post('accesoDocumento'),
			'ruta' => "docs/".$datos['file_name']
			);
			echo $this->DM->editaDocumento($data);
		}
	}
	public function descargaExternos()
	{
		$data['documento']=$this->DM->getAllExternos();
		$this->load->view('head');
		$this->load->view('topBarLogin');
		$this->load->view('menu_login');
		
		$this->load->view('documentos/frmDescargaExterno',$data);

		$this->load->view('footer');
		$this->load->view('scripts');

	}
	public function generarBackup()
	{
	if(!isset($_SESSION['usuario'])){
			redirect('Main/index');
		}
		$this->load->dbutil();
		$prefs = array(
	           // Array of tables to backup.
	        'ignore'        => array(),                     // List of tables to omit from the backup
	        'format'        => 'txt',                       // gzip, zip, txt
	                   // File name - NEEDED ONLY WITH ZIP FILES
	        'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
	        'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
	        'newline'       => "\n"                         // Newline character used in backup file
		);
		// Backup your entire database and assign it to a variable
		$backup = $this->dbutil->backup($prefs);
		
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		if(write_file('./backup/'.date('d-m-Y').'.sql', $backup))
		{
			echo 'exito';
		}
		else{
			echo 'fracaso';
		}

		// Load the download helper and send the file to your desktop
		//$this->load->helper('download');
		//force_download(date('d-m-Y').'.sql', $backup);
	}
	

	

}
