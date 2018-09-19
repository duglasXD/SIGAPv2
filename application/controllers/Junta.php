<?PHP 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/El_Salvador');

	class Junta extends CI_Controller {
		function __construct(){
			parent::__construct();
			
			$this->load->library('session');
	
		
		}
		public function index()
		{
			$this->load->helper('url');
			if(!$this->session->userdata('usuario')){
				redirect('Main/principal');
			}
			$this->load->helper('url');
			$this->load->model('Junta_model', 'JM',true);
			$this->load->model('Sistema_model', 'SM',true);
				$menu['menu']=$this->SM->getSubOpciones();
			$this->load->view('head');
			$this->load->view('top_bar');
			$this->load->view('menu',$menu);
			$id=$this->SM->getIdModulo('Junta');
			$data['consultar']=$this->SM->getPermiso($id,1);
			$data['editar']=$this->SM->getPermiso($id,4);
			$data['agregar']=$this->SM->getPermiso($id,2);
			$data['juntas']=$this->JM->getAllJuntas();
	//
		
			$this->load->view('juntas/indexJuntas',$data);
			//$this->load->view('switch');
			$this->load->view('footer');
			$this->load->view('scripts');
			//$this->load->view('graficasDashboard');
		}

		public function newJunta()
		{
			$this->load->helper('url');
			if(!$this->session->userdata('usuario')){
				redirect('Main/principal');
			}
			$this->load->helper('url');
			$this->load->model('Asociacion_model', 'AM',true);
			//$hola='hola';
			$this->load->view('headFormularios');
			
			$data['asociaciones']=$this->AM->getAllAsociaciones();
		
			$this->load->view('juntas/frmNuevaJunta',$data);
		}

		public function saveJunta()
		{
			$this->load->model('Junta_model', 'JM',true);
			$this->load->helper('url');
			if(!$this->session->userdata('usuario')){
				redirect('Main/principal');
			}
			$secretarias= array();
			for($i=1; $i<$this->input->post('contador');$i++)
			{
				$secretarias[$i][0]=$this->input->post('secretariaJunta'.$i);
				$secretarias[$i][1]=$this->input->post('representanteJunta'.$i);

			}


			$data = array(
				'asociacionJunta' => $this->input->post('asociacionJunta'), 
				'fechaEleccionJunta' => $this->input->post('fechaEleccionJunta'),
				'fechaPosesionJunta' => $this->input->post('fechaPosesionJunta'),
				'fechaFinJunta' => $this->input->post('fechaFinJunta'),
				'fechaAutoJunta' => $this->input->post('fechaAutoJunta'),
				'oficioJunta' => strtoupper(trim($this->input->post('oficioJunta'))),
				'carneJunta' => $this->input->post('carneJunta'),
				'libroJunta' => strtoupper(trim($this->input->post('libroJunta'))), 
				'convocatoriaJunta' => strtoupper(trim($this->input->post('convocatoriaJunta'))),
				'antelacionJunta' => strtoupper(trim($this->input->post('antelacionJunta'))),
				'agendaJunta' => strtoupper(trim($this->input->post('agendaJunta'))),
				'representacionJunta' => strtoupper(trim($this->input->post('representacionJunta'))),
				'quorumJunta' => trim($this->input->post('quorumJunta')),
				'votacionJunta' => strtoupper(trim($this->input->post('votacionJunta'))),
				'asistenciaJunta' => strtoupper(trim($this->input->post('asistenciaJunta'))), 
				'presentacionJunta' => trim($this->input->post('presentacionJunta')),
				'horaJunta' => trim($this->input->post('horaJunta')),
				'presentadoPorJunta' => strtoupper(trim($this->input->post('presentadoPorJunta'))),
				'estadoJunta' => 'Activo',
				'hombresJunta' => trim($this->input->post('hombresJunta')),
				'mujeresJunta' => trim($this->input->post('mujeresJunta')),
				'folioJunta' => strtoupper(trim($this->input->post('folioJunta'))),
				'regJunta' => strtoupper(trim($this->input->post('regJunta'))),
				'articuloJunta' => strtoupper(trim($this->input->post('articuloJunta'))),
				'contador' => $this->input->post('contador')
				);
				
				echo $this->JM->guardaJunta($data,$secretarias);
		}
	}
?>