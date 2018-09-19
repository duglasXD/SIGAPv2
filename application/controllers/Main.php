<?php
//session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/El_Salvador');



class Main extends CI_Controller {

	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	
		
	}
	
	public function index()
	{
		if($this->session->userdata('usuario'))
		{
			redirect('Main/principal');
		}

		$this->load->model('Documento_model', 'DM',true);
		$data['documento']=$this->DM->getAllPublicos();
		$this->load->view('head');
		$this->load->view('topBarLogin');
		//$this->load->view('menu_login');
		//$this->load->model('dashboard_model', 'DM',true);
		//$totalAsociaciones['total']=$this->DM->getTotalAsociaciones();
		//$totalAsociaciones['publicas']=$this->DM->getTotalAsociacionesPorTipo(1);
		//$totalAsociaciones['privadas']=$this->DM->getTotalAsociacionesPorTipo(2);
		//$totalAsociaciones['afiliados']=$this->DM->getTotalAsociadosPorEstado('A');
		//$totalAsociaciones['tipos']=$this->DM->getTotalAsociacionesPrivadasPorTipo();
		//$totalAsociaciones['solicitudes']=$this->DM->getTotalSolicitudesPorTipo();
		// $totalAsociaciones['colores']= array();
		//$this->load->view('dashboard',$totalAsociaciones);
		$this->load->view('login',$data);

		//$this->load->view('footer');
		$this->load->view('scripts');
		$this->verificarJuntas();
		//$this->load->view('graficasDashboard');
	}

	public function principal()
	{
		//$hola='hola';
		if(!$this->session->userdata('usuario'))
		{
			redirect('Main/principal');
		}
		$this->load->model('Sistema_model', 'SM',true);
			$menu['menu']=$this->SM->getSubOpciones();
			$this->load->view('head');
			$this->load->view('top_bar');
			$this->load->view('menu',$menu);
			$this->load->model('Dashboard_model', 'DM',true);

			$totalAsociaciones['total']=$this->DM->getTotalAsociaciones();
			$totalAsociaciones['publicas']=$this->DM->getTotalAsociacionesPorTipo(1);
			$totalAsociaciones['privadas']=$this->DM->getTotalAsociacionesPorTipo(2);
			$totalAsociaciones['afiliados']=$this->DM->getTotalAsociadosPorEstado(1);
			$totalAsociaciones['Empresa']=$this->DM->getTotalAsociacionesPrivadasPorTipo(1);
			$totalAsociaciones['Gremio']=$this->DM->getTotalAsociacionesPrivadasPorTipo(2);
			$totalAsociaciones['Autonoma']=$this->DM->getTotalAsociacionesPrivadasPorTipo(3);
			$totalAsociaciones['Independiente']=$this->DM->getTotalAsociacionesPrivadasPorTipo(4);
			$totalAsociaciones['Industria']=$this->DM->getTotalAsociacionesPrivadasPorTipo(5);
			//$totalAsociaciones['solicitudes']=$this->DM->getTotalSolicitudesPorTipo();
			$totalAsociaciones['solicitudes']=array(
				'nombre'=>'a','total'=>3);
			 $totalAsociaciones['colores']= array();
			$this->load->view('dashboard',$totalAsociaciones);
			//$this->load->view('switch');
			$this->load->view('footer');
			$this->load->view('scripts');
			$this->load->view('graficasDashboard');
		
		
	}

	public function loguear()
	{
		
		$this->load->model('Bitacora_model');
		$this->load->model('Login_model');
		$user=$this->input->post('user');
		$pass=$this->input->post('password');
		$data = array( 'usuario' => $this->input->post('user'), 'password' => $this->input->post('password') );
		$usuario = $this->Login_model->verificar_usuario($data);
		//echo $usuario;
		switch ($usuario) {
			case 'interno':
					$estado = $this->Login_model->verificar_estado($data);
					//echo $estado;
					if($estado=='activo')
					{
						$resultado=$this->Login_model->autenticaInterno($user,$pass);
						//echo $this->Login_model->autenticaInterno($user,$pass);
						if($resultado=='login')
						{
							$resultado2=$this->Login_model->get_data_user($data);

		 					   if($resultado2->num_rows() > 0){
									foreach ($resultado2->result() as $fila) {
									}
									$usuario_data = array(
						               'id_usuario' => $fila->id_usuario,
						               'usuario' => $fila->usuario,
						               'nombre_usuario' => $fila->nombre_completo,
						               'rol_usuario' => $this->Login_model->getRol($fila->id_usuario),
						               'sesion' => TRUE
						            );
									$this->session->set_userdata($usuario_data);
									$this->Bitacora_model->bitacora(array( 'descripcion' => "El usuario ".$this->input->post('usuario')." inició sesión", 'id_accion' => "1"));
									 echo 1;
								}else{
									echo "sesion"; $this->session->sess_destroy();
								}
		 				}else
		 				{
		 					echo 0;
		 					//$this->index();//no se pudo no coincide
		 				}
					}
					else
					{
						echo 2;
					}
				break;
			case 'externo':
				$estado = $this->Login_model->verificar_estado($data);
					//echo $estado;
					if($estado=='activo')
					{
						$resultado=$this->Login_model->autenticaExterno($user,$pass);
						//echo $this->autenticaInterno($user,$pass);
						if($resultado->num_rows() > 0)
						{
							$resultado2=$this->Login_model->getDatosUsuario($user);

		 					   if($resultado2->num_rows() > 0){
									foreach ($resultado2->result() as $fila) {
									}
									$usuario_data = array(
						               	'id_usuario' => $fila->ID_USUARIO,
						               	'usuario' => $fila->ID_USUARIO,
						            	'nombre_usuario' => $fila->NOMBRE_USUARIO,
						            	'rol_usuario' => $fila->ID_ROL_USUARIO,
						            	'asociacion_usuario' => $fila->ID_ASOCIACION_USUARIO,
						            	'sesion' => TRUE
						            );
									$this->session->set_userdata($usuario_data);
									$this->Bitacora_model->bitacora(array( 'descripcion' => "El usuario ".$user." inició sesión", 'id_accion' => "1"));
									 echo 1;
								}else{
									echo "sesion"; $this->session->sess_destroy();
								}
		 				}
		 				else
		 				{
		 					echo 0;
		 					//$this->index();//no se pudo no coincide
		 				}
					}
					else
					{
						echo 2;
					}
				break;
			case 'no':
				 echo 3;
				break;
		}


	}

public function autenticaInterno($user,$pass){
		error_reporting(0); $ldaprdn = $user.'@trabajo.local'; $ldappass = $pass; $ds = 'trabajo.local'; $dn = 'dc=trabajo,dc=local'; $puertoldap = 389; $ldapconn = @ldap_connect($ds,$puertoldap);
		if ($ldapconn){ 
			ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION,3); ldap_set_option($ldapconn, LDAP_OPT_REFERRALS,0); 
			$ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);
			//echo $ldapbind;
			if ($ldapbind){  return "login";
			}else{ return $this->ldap2_login($user,$pass); } 
		}else{ 
			return $this->ldap2_login($user,$pass);
		}
		ldap_close($ldapconn);
	}

 public function ldap2_login($user,$pass){
		error_reporting(0); $ldaprdn = $user.'@mtps.local'; $ldappass = $pass; $ds = 'mtps.local'; $dn = 'dc=mtps,dc=local'; $puertoldap = 389;  $ldapconn = @ldap_connect($ds,$puertoldap); 
		if ($ldapconn){ 
			ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION,3);  ldap_set_option($ldapconn, LDAP_OPT_REFERRALS,0); 
			$ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);
			if ($ldapbind){  return "login";
			}else{  return "error"; } 
		}else{ 
			return "error";
		}
		ldap_close($ldapconn);
	}

	public function cerrarSesion(){
		/************** Inicio de fragmento bitácora *********************/
		$this->load->model('Bitacora_model');
		
			$this->Bitacora_model->bitacora(array('descripcion' => "El usuario ".$this->session->userdata('usuario')." cerró sesión", 'id_accion' => "2"));
		
		   $this->session->sess_destroy();
			redirect('');
			
	
        /************** Fin de fragmento bitácora *********************/
		
		//$this->index();
	}

	public function verificarJuntas()
	{


		$this->load->model('Junta_model','JM',true);
		$this->load->model('Asociacion_model','AM',true);
		$resultado=$this->JM->juntasVencidas(date("Y-m-d"));
		if($resultado!=0)
		{
			foreach ($resultado as $value) {
					$this->JM->cambia_estado($value['ID_JUNTA']);
					 $datos = array(
                      'id' => $value["ID_ASOCIACION_JUNTA"], 
                      'estado' => 'Acéfalo',
                      'nombre' => $this->AM->getNombreAsociacion($value["ID_ASOCIACION_JUNTA"])
                      );
                      $this->AM->editaEstado($datos);
			}
		}
	}
	

	

}
