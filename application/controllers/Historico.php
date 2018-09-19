<?php

date_default_timezone_set('America/El_Salvador');
defined('BASEPATH') OR exit('No direct script access allowed');



class Historico extends CI_Controller {

	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
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
		if(!$this->session->userdata('usuario')){
			redirect('Main/index');
		}
		$this->load->model('Sistema_model', 'SM',true);
			$menu['menu']=$this->SM->getSubOpciones();
		$this->load->view('head');
		$this->load->view('headFormularios');
		$this->load->view('top_bar');
		$this->load->view('menu',$menu);
		
		$data['documento']=$this->DM->getAllDocs();

		
		$this->load->view('historico/indexHistorico');
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
	if(!$this->session->userdata('usuario')){
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
	
public function saveHistorico()
	{
		  $config['upload_path'] = './assets/docs/';
		        
		       //Tipos de ficheros permitidos
		        $config['allowed_types'] = 'xls|xlsx';
		         
		       //Se pueden configurar aun mas parámetros.
		       //Cargamos la librería de subida y le pasamos la configuración 

		        $this->load->library('upload', $config);
		      if(!$this->upload->do_upload()){
            /*Si al subirse hay algún error lo meto en un array para pasárselo a la vista*/
                $error= $this->upload->display_errors();
                echo $error;
       			 }
		         $datos=$this->upload->data();
			//obtenemos el archivo subido mediante el formulario
		    $file = $datos['full_path'];
		 
		    //comprobamos si existe un directorio para subir el excel
		    //si no es así, lo creamos
		    if(!is_dir("./assets/docs/")) 
		      mkdir("./assets/docs/", 0777);
		 
		    //comprobamos si el archivo ha subido para poder utilizarlo
		    if ($file==$file)
		    {
		 
		  
		 
		      /** archivos necesarios */
		      require_once APPPATH . 'libraries/Classes/PHPExcel.php';
		      require_once APPPATH . 'libraries/Classes/PHPExcel/Reader/Excel2007.php';
		 
		      //creamos el objeto que debe leer el excel
		      $objReader = new PHPExcel_Reader_Excel2007();
		      $objPHPExcel = $objReader->load($file);
		 
		      //número de filas del archivo excel
		      $rows = $objPHPExcel->getActiveSheet()->getHighestRow();   
		 
	
		      //inicializamos sql como un array
		      $asociacion = array();
		      $junta=array();
		      $secretaria=array();
		 
		      //array con las letras de la cabecera de un archivo excel
		      $letras = array(
		        "A","B","C","D","E","F","G",
		        "H","I","J","Q","L","M","N",
		        "O","P","Q","R","S","T","U",
		        "V","W","X","Y","Z"
		      );
		 		 $this->load->model('Asociacion_model', 'AM',true);
		 		 $this->load->model('Junta_model', 'JM',true);
		 		 if($this->input->post('sectorAsociacion')==1)
		 		 {
		 		 	$asociacion['ID_SECTOR_ASOCIACION']=$this->input->post('sectorAsociacion');
		 		 	$asociacion['ID_CLASE_ASOCIACION']=6;
		 		 }
		 		 else{
		 		 	$asociacion['ID_SECTOR_ASOCIACION']=$this->input->post('sectorAsociacion');
		 		 	$asociacion['ID_CLASE_ASOCIACION']=1;
		 		 }
		 		 

		 		 switch ($this->input->post('tipoAsociacion')) {
		 		 	case '1':
		 		 		$asociacion['ID_TIPO_ASOCIACION']=1;
		 		 		 for($i = 2;$i <= $rows; $i++)
						      {
						        //ahora recorremos los campos del formulario para ir creando el array de forma dinámica
						       
						        	if($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()!=''&&$objPHPExcel->getActiveSheet()->getCell('Q'.$i)->getCalculatedValue()!=''&&$objPHPExcel->getActiveSheet()->getCell('R'.$i)->getCalculatedValue()!='')
						        		{
						        			 $asociacion['NUMERO_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue());
									          $asociacion['ESTADO_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue());
									          $asociacion['FECHA_CONSTITUCION_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue());
									          $asociacion['AFILIACION_ID_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue());
									           $asociacion['NOMBRE_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue());
									           $asociacion['DIRECCION_ASOCIACION']= trim($objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue());
									           $asociacion['TELEFONO_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue());
									         
									         $idAsociacion=$this->AM->guardaFederacionExcel($asociacion);
									         if($idAsociacion=="fracaso")
									         {
									         	echo "Ocurrio un error al ingresar la asociacion";
									         	break;
									         }
									         //echo $idAsociacion;
									          $junta['FECHA_POSESION_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue());
									          $junta['FECHA_FIN_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue());
									          $junta['HOMBRES_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue());
									          $junta['MUJERES_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue());
									          $junta['LIBRO_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('N'.$i)->getCalculatedValue());
									          $junta['FOLIO_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('O'.$i)->getCalculatedValue());
									          $junta['REGISTRO_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('P'.$i)->getCalculatedValue());
									          $junta['ARTICULO_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('S'.$i)->getCalculatedValue());
									          $junta['ESTADO_JUNTA']=$asociacion['ESTADO_ASOCIACION'];
									          $junta['ID_ASOCIACION_JUNTA']=trim($idAsociacion);
									          $idJunta=$this->JM->guardaJuntaExcel($junta);
									          if($idJunta=="fracaso")
									         {
									         	echo "Ocurrio un error al ingresar la junta";
									         	break;
									         }
									          $z=$i;
									         // $x=0;
									          $contador=0;
									          while($objPHPExcel->getActiveSheet()->getCell('Q'.$z)->getCalculatedValue()!=''&&$objPHPExcel->getActiveSheet()->getCell('R'.$z)->getCalculatedValue()!='')
									          {
									          	 $secretaria['NOMBRE_SECRETARIA_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('Q'.$z)->getCalculatedValue());
							 		          	 $secretaria['REPRESENTANTE_SECRETARIA_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('R'.$z)->getCalculatedValue());
							 		          	 $secretaria['ID_JUNTA']=$idJunta;
							 		          	 $xy=$this->JM->guardaSecretariaExcel($secretaria);
							 		          	 $z++;
							 		          	// $x++;
							 		          	 if($xy=='fracaso')
							 		          	 {
							 		          	 	$contador++;
							 		          	 }

									          }
						        		}
						        
						      }  
						       if($contador==0)
						      {
						      	echo 'exito';
						      }   
		 		 		break;
		 		 	case '2':
		 		 		$asociacion['ID_TIPO_ASOCIACION']=2;
		 		 		 for($i = 2;$i <= $rows; $i++)
						      {
						        //ahora recorremos los campos del formulario para ir creando el array de forma dinámica
						       
						        	if($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()!=''&&$objPHPExcel->getActiveSheet()->getCell('Q'.$i)->getCalculatedValue()!=''&&$objPHPExcel->getActiveSheet()->getCell('R'.$i)->getCalculatedValue()!='')
						        		{
						        			 $asociacion['NUMERO_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue());
									          $asociacion['ESTADO_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue());
									          $asociacion['FECHA_CONSTITUCION_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue());
									          $asociacion['AFILIACION_ID_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue());
									           $asociacion['NOMBRE_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue());
									           $asociacion['DIRECCION_ASOCIACION']= trim($objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue());
									           $asociacion['TELEFONO_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue());
									         
									         $idAsociacion=$this->AM->guardaFederacionExcel($asociacion);
									         if($idAsociacion=="fracaso")
									         {
									         	echo "Ocurrio un error al ingresar la asociacion";
									         	break;
									         }
									        // echo $idAsociacion;
									          $junta['FECHA_POSESION_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue());
									          $junta['FECHA_FIN_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue());
									          $junta['HOMBRES_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue());
									          $junta['MUJERES_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue());
									          $junta['LIBRO_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('N'.$i)->getCalculatedValue());
									          $junta['FOLIO_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('O'.$i)->getCalculatedValue());
									          $junta['REGISTRO_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('P'.$i)->getCalculatedValue());
									          $junta['ARTICULO_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('S'.$i)->getCalculatedValue());
									          $junta['ESTADO_JUNTA']=$asociacion['ESTADO_ASOCIACION'];
									          $junta['ID_ASOCIACION_JUNTA']=trim($idAsociacion);
									          $idJunta=$this->JM->guardaJuntaExcel($junta);
									          if($idJunta=="fracaso")
									         {
									         	echo "Ocurrio un error al ingresar la junta";
									         	break;
									         }
									          $z=$i;
									         // $x=0;
									          $contador=0;
									          while($objPHPExcel->getActiveSheet()->getCell('Q'.$z)->getCalculatedValue()!=''&&$objPHPExcel->getActiveSheet()->getCell('R'.$z)->getCalculatedValue()!='')
									          {
									          	 $secretaria['NOMBRE_SECRETARIA_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('Q'.$z)->getCalculatedValue());
							 		          	 $secretaria['REPRESENTANTE_SECRETARIA_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('R'.$z)->getCalculatedValue());
							 		          	 $secretaria['ID_JUNTA']=$idJunta;
							 		          	 $xy=$this->JM->guardaSecretariaExcel($secretaria);
							 		          	 $z++;
							 		          	// $x++;
							 		          	 if($xy=='fracaso')
							 		          	 {
							 		          	 	$contador++;
							 		          	 }

									          }
						        		}
						        
						      }   
						       if($contador==0)
						      {
						      	echo 'exito';
						      }  
		 		 		break;
		 		 	case '3':
		 		 			$asociacion['ID_TIPO_ASOCIACION']=3;
		 		 			 for($i = 3;$i <= $rows; $i++)
						      {
						        //ahora recorremos los campos del formulario para ir creando el array de forma dinámica
						       
						        	if($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()!=''&&$objPHPExcel->getActiveSheet()->getCell('U'.$i)->getCalculatedValue()!=''&&$objPHPExcel->getActiveSheet()->getCell('V'.$i)->getCalculatedValue()!='')
						        		{
						        			 $asociacion['NUMERO_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue());
									          $asociacion['ESTADO_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue());
									          $asociacion['FECHA_CONSTITUCION_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue());
									          $asociacion['FECHA_RESOLUCION_FINAL_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue());
									          $asociacion['AFILIACION_ID_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue());
									          $asociacion['NOMBRE_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue());
									          $asociacion['DIRECCION_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue());
									          $asociacion['TELEFONO_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue());
									          $asociacion['ID_CLASE_ASOCIACION'] = $this->AM->verIdClase($objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue());
									          $asociacion['HOMBRES_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue());
									          $asociacion['MUJERES_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('M'.$i)->getCalculatedValue());
									         $idAsociacion=$this->AM->guardaAsociacionExcel($asociacion);
									         if($idAsociacion=="fracaso")
									         {
									         	echo "Ocurrio un error al ingresar la asociacion";
									         	break;
									         }
									         //echo $idAsociacion;
									          $junta['FECHA_POSESION_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue());
									          $junta['FECHA_FIN_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue());
									          $junta['HOMBRES_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('O'.$i)->getCalculatedValue());
									          $junta['MUJERES_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('P'.$i)->getCalculatedValue());
									          $junta['LIBRO_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('R'.$i)->getCalculatedValue());
									          $junta['FOLIO_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('S'.$i)->getCalculatedValue());
									          $junta['REGISTRO_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('T'.$i)->getCalculatedValue());
									          $junta['ARTICULO_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('W'.$i)->getCalculatedValue());
									          $junta['ESTADO_JUNTA']=$asociacion['ESTADO_ASOCIACION'];
									          $junta['ID_ASOCIACION_JUNTA']=trim($idAsociacion);
									          $idJunta=$this->JM->guardaJuntaExcel($junta);
									          if($idJunta=="fracaso")
									         {
									         	echo "Ocurrio un error al ingresar la junta";
									         	break;
									         }
									          $z=$i;
									         // $x=0;
									          $contador=0;
									          while($objPHPExcel->getActiveSheet()->getCell('U'.$z)->getCalculatedValue()!=''&&$objPHPExcel->getActiveSheet()->getCell('V'.$z)->getCalculatedValue()!='')
									          {
									          	 $secretaria['NOMBRE_SECRETARIA_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('U'.$z)->getCalculatedValue());
							 		          	 $secretaria['REPRESENTANTE_SECRETARIA_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('V'.$z)->getCalculatedValue());
							 		          	 $secretaria['ID_JUNTA']=$idJunta;
							 		          	 $xy=$this->JM->guardaSecretariaExcel($secretaria);
							 		          	 $z++;
							 		          	// $x++;
							 		          	 if($xy=='fracaso')
							 		          	 {
							 		          	 	$contador++;
							 		          	 }
									          }
						        		}
						        
						      }
						      if($contador==0)
						      {
						      	echo 'exito';
						      }    
		 		 		break;
		 		 	case '4':
		 		 		$asociacion['ID_TIPO_ASOCIACION']=4;
		 		 		$asociacion['ID_TIPO_ASOCIACION']=3;
		 		 			 for($i = 3;$i <= $rows; $i++)
						      {
						        //ahora recorremos los campos del formulario para ir creando el array de forma dinámica
						       
						        	if($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()!=''&&$objPHPExcel->getActiveSheet()->getCell('U'.$i)->getCalculatedValue()!=''&&$objPHPExcel->getActiveSheet()->getCell('V'.$i)->getCalculatedValue()!='')
						        		{
						        			 $asociacion['NUMERO_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue());
									          $asociacion['ESTADO_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue());
									          $asociacion['FECHA_CONSTITUCION_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue());
									          $asociacion['FECHA_RESOLUCION_FINAL_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue());
									          $asociacion['AFILIACION_ID_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue());
									          $asociacion['NOMBRE_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue());
									          $asociacion['DIRECCION_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue());
									          $asociacion['TELEFONO_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue());
									          $asociacion['ID_CLASE_ASOCIACION'] = $this->AM->verIdClase($objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue());
									          $asociacion['HOMBRES_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue());
									          $asociacion['MUJERES_ASOCIACION'] = trim($objPHPExcel->getActiveSheet()->getCell('M'.$i)->getCalculatedValue());
									         $idAsociacion=$this->AM->guardaAsociacionExcel($asociacion);
									         if($idAsociacion=="fracaso")
									         {
									         	echo "Ocurrio un error al ingresar la asociacion";
									         	break;
									         }
									         //echo $idAsociacion;
									          $junta['FECHA_POSESION_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue());
									          $junta['FECHA_FIN_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue());
									          $junta['HOMBRES_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('O'.$i)->getCalculatedValue());
									          $junta['MUJERES_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('P'.$i)->getCalculatedValue());
									          $junta['LIBRO_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('R'.$i)->getCalculatedValue());
									          $junta['FOLIO_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('S'.$i)->getCalculatedValue());
									          $junta['REGISTRO_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('T'.$i)->getCalculatedValue());
									          $junta['ARTICULO_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('W'.$i)->getCalculatedValue());
									          $junta['ESTADO_JUNTA']=$asociacion['ESTADO_ASOCIACION'];
									          $junta['ID_ASOCIACION_JUNTA']=trim($idAsociacion);
									          $idJunta=$this->JM->guardaJuntaExcel($junta);
									          if($idJunta=="fracaso")
									         {
									         	echo "Ocurrio un error al ingresar la junta";
									         	break;
									         }
									          $z=$i;
									         // $x=0;
									          $contador=0;
									          while($objPHPExcel->getActiveSheet()->getCell('U'.$z)->getCalculatedValue()!=''&&$objPHPExcel->getActiveSheet()->getCell('V'.$z)->getCalculatedValue()!='')
									          {
									          	 $secretaria['NOMBRE_SECRETARIA_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('U'.$z)->getCalculatedValue());
							 		          	 $secretaria['REPRESENTANTE_SECRETARIA_JUNTA']=trim($objPHPExcel->getActiveSheet()->getCell('V'.$z)->getCalculatedValue());
							 		          	 $secretaria['ID_JUNTA']=$idJunta;
							 		          	 $xy=$this->JM->guardaSecretariaExcel($secretaria);
							 		          	 $z++;
							 		          	 if($xy=='fracaso')
							 		          	 {
							 		          	 	$contador++;
							 		          	 }
							 		          	// $x++;

									          }
						        		}
						        
						      }  
						      if($contador==0)
						      {
						      	echo 'exito';
						      } 
		 		 		break;
		 		 	
		 		 	
		 		 }
		      //recorremos el excel y creamos un array para después insertarlo en la base de datos
		     
		 
		      /*echo "<pre>";
		     
		      */
		  		//echo var_dump($asociacion); 
		      //cargamos el modelo
		    $this->load->model('Asociacion_model', 'AM',true);
		    $i=$i-1;
		      //insertamos los datos del excel en la base de datos
		     // $import_excel = $this->AM->excel($table_name,$sql,$i,$this->input->post('idAsociacion'));
		      
		      //comprobamos si se ha guardado bien
		     
		 
		      //finalmente, eliminamos el archivo pase lo que pase
		      //unlink("./docs/".$file);
		 
		    }else{
		      echo "Debes subir un archivo";
		    }
		  
	}
	

}
