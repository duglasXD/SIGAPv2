<?PHP 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/El_Salvador');

class Asociacion extends CI_Controller {
	function __construct(){
		parent::__construct();
		//$this->load->helper('url');
		$this->load->library('session');
	
		
	}
	public function index()
	{
		$this->load->helper('url');
		$this->load->library('session');
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
	
		$this->load->model('Asociacion_model', 'AM',true);
		$this->load->model('Sistema_model', 'SM',true);
			$menu['menu']=$this->SM->getSubOpciones();
		$this->load->view('head');
		$this->load->view('top_bar');
		$this->load->view('menu',$menu);
		
		$data['asociaciones']=$this->AM->getAllAsociaciones();
		$id=$this->SM->getIdModulo('Asociacion');
		$data['consultar']=$this->SM->getPermiso($id,1);
		$data['editar']=$this->SM->getPermiso($id,4);
		$data['agregar']=$this->SM->getPermiso($id,2);
		$data['estado']=$this->SM->getPermiso($id,3);

	
		$this->load->view('asociaciones/indexAsociacion',$data);
		//$this->load->view('switch');
		$this->load->view('footer');
		$this->load->view('scripts');
		//$this->load->view('graficasDashboard');
	}

	public function accesoPublico()
	{
		$this->load->helper('url');
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		
		$this->load->model('Asociacion_model', 'AM',true);
		$this->load->model('Sistema_model', 'SM',true);
		$this->load->model('Usuario_model', 'UM',true);
		$menu['menu']=$this->SM->getSubOpciones();
		$this->load->view('head');
		$this->load->view('top_bar');
		$this->load->view('menu',$menu);
		$idAsociacion=$this->UM->getAsocByUsuario($this->session->userdata('usuario'));
		$data['asociaciones']=$this->AM->getAsociacion($idAsociacion);
		$this->load->view('asociaciones/indexAsociacionPublico',$data);
		//$this->load->view('switch');
		$this->load->view('footer');
		$this->load->view('scripts');
		//$this->load->view('graficasDashboard');
	}
	public function newSapAsociacion()
	{
		$this->load->helper('url');
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$this->load->helper('url');
		$this->load->model('Asociacion_model', 'AM',true);
		//$hola='hola';
		$this->load->view('headFormularios');
		
		$data['sector']=$this->AM->getAllSectorAsociacion();
		$data['deptos']=$this->AM->getAllDeptos();
		$data['tipos']=$this->AM->getAllTipoAsociacion();


		$this->load->view('asociaciones/frmNuevaAsociacion',$data);
		//$this->load->view('switch');
		//$this->load->view('footer');
		//$this->load->view('scripts');
		//$this->load->view('graficasDashboard');
	}

	public function cargarAsociaciones()
	{
		$this->load->helper('url');
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		
		$this->load->model('Asociacion_model', 'AM',true);
		$this->load->model('Usuario_model', 'UM',true);
		$data=$this->AM->getAllAsociaciones();
		echo "<option  value='-1'>Seleccione una asociación</option>";
		if($this->input->post('id')==1)
		{
			foreach ($data as $item) {
				echo "<option value='".$item['ID_ASOCIACION']."'>".$item['NOMBRE_ASOCIACION']."</option>";
			}
		}
		else
		{
			foreach ($data as $item) {
				if($item['ID_ASOCIACION']==$this->UM->getAsocByUsuario($this->input->post('id')))
				{
					echo "<option selected='selected' value='".$item['ID_ASOCIACION']."'>".$item['NOMBRE_ASOCIACION']."</option>";
				}
				else
				{
					echo "<option value='".$item['ID_ASOCIACION']."'>".$item['NOMBRE_ASOCIACION']."</option>";
				}
			}
		}
	}

	public function saveAsociacion()
	{
		$this->load->helper('url');
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$numero=$this->cargarCorrelativo2($this->input->post('tipoAsociacion'),$this->input->post('sectorAsociacion'),$this->input->post('dependenciaAsociacion'));
		$data = array(
			'nombre' => trim($this->input->post('nombreAsociacion')), 
			'numero' => $numero,
			'siglas' => trim(strtoupper($this->input->post('siglasAsociacion'))),
			'tipo' => $this->input->post('tipoAsociacion'),
			'hombres' => $this->input->post('hombresAsociacion'),
			'mujeres' => $this->input->post('mujeresAsociacion'),
			'institucion' => trim($this->input->post('institucionAsociacion')),
			'dependencia' => $this->input->post('dependenciaAsociacion'),
			'municipio' => $this->input->post('municipioAsociacion'),
			'sector' => trim($this->input->post('sectorAsociacion')),
			'libro' => trim($this->input->post('numeroLibro')),
			'clase' => trim($this->input->post('claseAsociacion')),
			'folio' => trim($this->input->post('folioAsociacion')),
			'constitucion' => $this->input->post('fechaConstitucionAsociacion'),
			'resolucion' => $this->input->post('resolucionFinal'),
			'email' => trim($this->input->post('emailAsociacion')),
			'telefono' => $this->input->post('telefonoAsociacion'),
			'direccion' => trim(strtoupper($this->input->post('direccionAsociacion'))),
			'estado' => $this->input->post('estadoAsociacion'),
			'reg' => trim($this->input->post('regAsociacion')),
			'art' => trim($this->input->post('articuloAsociacion'))
			);
			$this->load->model('Asociacion_model', 'AM',true);
			echo $this->AM->guardaAsociacion($data);
	}
	public function editAsociacion()
	{
		$this->load->helper('url');
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$data = array(
			'nombre' => $this->input->post('nombreAsociacion'), 
			'numero' => trim($this->input->post('num')),
			'siglas' => trim(strtoupper($this->input->post('siglasAsociacion'))),
			'tipo' => $this->input->post('tipoAsociacion'),
			'institucion' => trim($this->input->post('institucionAsociacion')),
			'dependencia' => $this->input->post('dependenciaAsociacion'),
			'municipio' => $this->input->post('municipioAsociacion'),
			'sector' => $this->input->post('sectorAsociacion'),
			'libro' => trim($this->input->post('numeroLibro')),
			'clase' => trim($this->input->post('claseAsociacion')),
			'folio' => trim($this->input->post('folioAsociacion')),
			'constitucion' => trim($this->input->post('fechaConstitucionAsociacion')),
			'resolucion' => $this->input->post('resolucionFinal'),
			'email' => trim($this->input->post('emailAsociacion')),
			'telefono' => $this->input->post('telefonoAsociacion'),
			'direccion' => trim(strtoupper($this->input->post('direccionAsociacion'))),
			'hombres' => $this->input->post('hombresAsociacion'),
			'mujeres' => $this->input->post('mujeresAsociacion'),
			'reg' => trim($this->input->post('regAsociacion')),
			'art' => trim($this->input->post('articuloAsociacion'))
			);
			$this->load->model('Asociacion_model', 'AM',true);
			echo $this->AM->editaAsociacion($data);
	}
	public function editEstado()
	{
		$this->load->helper('url');
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$data = array(
			'id' => $this->input->post('idAsociacion'), 
			'estado' => $this->input->post('estadoAsociacion'),
			'nombre' => $this->input->post('nombreAsoc') 
			);
			$this->load->model('Asociacion_model', 'AM',true);
			echo $this->AM->editaEstado($data);
	}
	public function updateAsociacion()
	{
		$this->load->helper('url');
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$this->load->view('headFormularios');
		$this->load->model('Asociacion_model', 'AM',true);
		$data['sector']=$this->AM->getAllSectorAsociacion();
		$data['deptos']=$this->AM->getAllDeptos();
		$data['tipos']=$this->AM->getAllTipoAsociacion();
		$data['asociacion']=$this->AM->getAsociacion($this->input->get('id'));
		$this->load->view('asociaciones/frmEditAsociacion',$data);

	}

	public function viewAsociacion()
	{
		$this->load->helper('url');
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$this->load->view('headFormularios');
		$this->load->model('Asociacion_model', 'AM',true);
		$data['sector']=$this->AM->getAllSectorAsociacion();
		$data['deptos']=$this->AM->getAllDeptos();
		$data['tipos']=$this->AM->getAllTipoAsociacion();
		
		$data['asociacion']=$this->AM->getAsociacion($this->input->get('id'));
		$this->load->view('asociaciones/frmViewAsociacion',$data);

	}

	public function cargarSelect()
	{
		$this->load->helper('url');
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$this->load->model('Asociacion_model', 'AM',true);
		$data=$this->AM->getClasesAsociacion($this->input->post('tipo'));
		foreach ($data as $item) {
		 	echo "<option value='".$item['ID_CLASE_ASOCIACION']."'>".$item['NOMBRE_CLASE_ASOCIACION']."</option>";
		 }
	}
	public function cargarDependencia()
	{
		$this->load->model('Asociacion_model', 'AM',true);
		$this->load->helper('url');
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$tipo = $this->input->post('tipo');
		//$this->load->model('asociaciones_model', 'AM',true);
		$data=$this->AM->getDependencias($tipo);
		if($data==0)
		{
			echo "<option value='0'>No aplica</option>";
		}
		else{
			if($data==-1)
			{
				$tipo--;
				echo "<option value='0'>Ninguna</option>";
				//echo "<option value='0'>No hay ".$this->AM->verTipoAsoc($tipo)."</option>";
			}
			else{
				echo "<option value='0'>Ninguna</option>";
				foreach ($data as $item) {
			 		echo "<option value='".$item['ID_ASOCIACION']."'>".$item['NOMBRE_ASOCIACION']."</option>";
				 }
			}
			
		}

	}
	public function cargarCorrelativo()
	{
		$this->load->helper('url');
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$this->load->model('Asociacion_model', 'AM',true);
		$tipo = $this->input->post('tipo');
		$sector = $this->input->post('sector');
		$afiliacion = $this->input->post('dependencia');
		$data=$this->AM->getCorrelativo($sector,$tipo,$afiliacion);
		echo $data;
		if($data == 0)
		{
			if($sector == 1)
			{			
					switch($tipo)
					{
						case 1:
								$correlativo = 'C.S.P. 1';

							break;

						case 2:
								 $correlativo = 'F.S.P. 1';
								
						break;

						case 3: $correlativo = '1 S.P.';
								
						break;

						case 4:
								if($afiliacion>0)
									{
										$aux = explode(" ", $this->AM->getNumeroAsoc($afiliacion));
										$correlativo = $aux[0].' S-1';
									}else{
										echo 0;
										return 0;
									}
								
						break;
					}	
				 echo $correlativo;
			}
			else {
					switch($tipo)
					{
						case 1:
								$correlativo = 'C-1';
							break;

						case 2:
								 $correlativo = 'F-1';
								
						break;

						case 3: $correlativo = '1';
								 
						break;

						case 4:
								if($afiliacion>0)
									{
										$aux = explode(" ", $this->AM->getNumeroAsoc($afiliacion));
										$correlativo = $aux[0].' S-1';
									}else{
										echo 0;
										return 0;
									}
								
						break;
					}
					 echo $correlativo;	
			}
			

		}
		else{
			if($sector == 1)
			{			
					switch($tipo)
					{
						case 1:
								$aux = explode(" ", $data);
								$correlativo = $aux[0].' '.($aux[1]+1);

							break;

						case 2:
								$aux = explode(" ", $data);
								$correlativo = $aux[0].' '.($aux[1]+1);
								
						break;

						case 3: $aux = explode(" ", $data);
								$correlativo = ($aux[0]+1).' '.$aux[1];
								
						break;

						case 4:
								$aux = explode(" ", $data);
								$aux2=explode("-", $aux[1]);
								$correlativo = ($aux[0]).' '.$aux2[0].'-'.($aux2[1]+1);
								
						break;
					}	
				 echo $correlativo;
			}
			else {
					switch($tipo)
					{
						case 1:
								$aux=explode("-", $data);
								$correlativo = $data[0].'-'.($aux[1]+1);
							break;

						case 2:
								$aux=explode("-", $data);
								$correlativo = $data[0].'-'.($aux[1]+1);
								
						break;

						case 3: $correlativo = $data++;
								 
						break;

						case 4:
								$aux = explode(" ", $data);
								$aux2=explode("-", $aux[1]);
								$correlativo = ($aux[0]).' '.$aux2[0].'-'.($aux2[1]+1);
								
						break;
					}
					 echo $correlativo;	
			}

		}
	}
	public function cargarCorrelativo2($tipo,$sector,$afiliacion)
	{
		$this->load->helper('url');
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$this->load->model('Asociacion_model', 'AM',true);
		
		$data=$this->AM->getCorrelativo($sector,$tipo,$afiliacion);
		//echo $data;
		if($data === 0)
		{
			if($sector == 1)
			{			
					switch($tipo)
					{
						case 1:
								$correlativo = 'C-1 S.P.';

							break;

						case 2:
								 $correlativo = 'F.S.P. 1';
								
						break;

						case 3: $correlativo = '1 S.P.';
								
						break;

						case 4:
								if($afiliacion>0)
									{
										$aux = explode(" ", $this->AM->getNumeroAsoc($afiliacion));
										$correlativo = $aux[0].' S-1';
									}else{
									//	echo 0;
										return 0;
									}
								
						break;
					}	
				 return $correlativo;
			}
			else {
					switch($tipo)
					{
						case 1:
								$correlativo = 'C-1';
							break;

						case 2:
								 $correlativo = 'F-1';
								
						break;

						case 3: $correlativo = '1';
								 
						break;

						case 4:
								if($afiliacion>0)
									{
										$aux = explode(" ", $this->AM->getNumeroAsoc($afiliacion));
										$correlativo = $aux[0].' S-1';
									}else{
										//echo 0;
										return 0;
									}
								
						break;
					}
					 return $correlativo;	
			}
			

		}
		else{
			if($sector == 1)
			{			
					switch($tipo)
					{
						case 1:
								$aux = explode(" ", $data);
								//echo $aux[0];
								$aux2=explode("-", $aux[0]);
								//echo $aux2[1];
								$aux2[1]=$aux2[1]+1;
								//echo $aux2[1];
								$correlativo = $aux2[0].'-'.($aux2[1]).' '.($aux[1]);
								//echo $correlativo;

							break;

						case 2:
								$aux = explode(" ", $data);
								$correlativo = $aux[0].' '.($aux[1]+1);
								
						break;

						case 3: $aux = explode(" ", $data);
								$correlativo = ($aux[0]+1).' '.$aux[1];
								
						break;

						case 4:
								$aux = explode(" ", $data);
								$aux2=explode("-", $aux[1]);
								$correlativo = ($aux[0]).' '.$aux2[0].'-'.($aux2[1]+1);
								
						break;
					}	
				 return $correlativo;
			}
			else {
					switch($tipo)
					{
						case 1:
								$aux=explode("-", $data);
								$correlativo = $data[0].'-'.($aux[1]+1);
							break;

						case 2:
								$aux=explode("-", $data);
								$correlativo = $data[0].'-'.($aux[1]+1);
								
						break;

						case 3: $correlativo = $data+1;
								 
						break;

						case 4:
								$aux = explode(" ", $data);
								$aux2=explode("-", $aux[1]);
								$correlativo = ($aux[0]).' '.$aux2[0].'-'.($aux2[1]+1);
								
						break;
					}
					 return $correlativo;	
			}

		}
	}
	public function agregarAfiliados()
	{
		$this->load->helper('url');
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$this->load->view('headFormularios');
		$this->load->model('Asociacion_model', 'AM',true);
		//$data['sector']=$this->AM->getAllSectorAsociacion();
		//$data['deptos']=$this->AM->getAllDeptos();
		//$data['tipos']=$this->AM->getAllTipoAsociacion();
		$data['asociacion']=$this->AM->getAsociacion($this->input->get('id'));
		$this->load->view('asociaciones/cargarAfiliado',$data);
	}
	public function cambiaEstado()
	{
		$this->load->helper('url');
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
		$this->load->view('headFormularios');
		$this->load->model('Asociacion_model', 'AM',true);
		//$data['sector']=$this->AM->getAllSectorAsociacion();
		//$data['deptos']=$this->AM->getAllDeptos();
		//$data['tipos']=$this->AM->getAllTipoAsociacion();
		$data['asociacion']=$this->AM->getAsociacion($this->input->get('id'));
		$this->load->view('asociaciones/frmCambiaEstadoAsociacion',$data);
	}
	public function saveAfiliado()
	{
		if(!$this->session->userdata('usuario')){
			redirect('Main/principal');
		}
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
		 
		      //queremos obtener la extensión del archivo
		     // $trozos = explode(".", $file);
		 
		      //solo queremos archivos excel
		     // if($trozos[1] != "xlsx" && $trozos[1] != "xls") return;
		 
		      /** archivos necesarios */
		      require_once APPPATH . 'libraries/Classes/PHPExcel.php';
		      require_once APPPATH . 'libraries/Classes/PHPExcel/Reader/Excel2007.php';
		 
		      //creamos el objeto que debe leer el excel
		      $objReader = new PHPExcel_Reader_Excel2007();
		      $objPHPExcel = $objReader->load($file);
		 
		      //número de filas del archivo excel
		      $rows = $objPHPExcel->getActiveSheet()->getHighestRow();   
		 
		      //obtenemos el nombre de la tabla que el usuario quiere insertar el excel
		      $table_name = trim($this->security->xss_clean('sap_afiliado'));  
		 
		      //obtenemos los nombres que el usuario ha introducido en el campo text del formulario,
		      //se supone que deben ser los campos de la tabla de la base de datos.
		      $fields='NOMBRES_AFILIADO,APELLIDOS_AFILIADO,DUI_AFILIADO,SEXO_AFILIADO,MENOR_EDAD_AFILIADO';
		      $fields_table = explode(",", $fields);
		 	
		      //inicializamos sql como un array
		      $sql = array();
		 
		      //array con las letras de la cabecera de un archivo excel
		      $letras = array(
		        "A","B","C","D","E","F","G",
		        "H","I","J","Q","L","M","N",
		        "O","P","Q","R","S","T","U",
		        "V","W","X","Y","Z"
		      );
		 
		      //recorremos el excel y creamos un array para después insertarlo en la base de datos
		      for($i = 9;$i <= $rows; $i++)
		      {
		        //ahora recorremos los campos del formulario para ir creando el array de forma dinámica
		       
		        	if($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue()=='')
		        		{
		        			break;
		        		}
		          $sql[$i]['NOMBRES_AFILIADO'] = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		          $sql[$i]['APELLIDOS_AFILIADO'] = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		          $sql[$i]['DUI_AFILIADO'] = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
		          $sql[$i]['SEXO_AFILIADO'] = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
		          $sql[$i]['MENOR_EDAD_AFILIADO'] = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
		        
		      }   
		 
		      /*echo "<pre>";
		      var_dump($sql); exit();
		      */
		 
		      //cargamos el modelo
		    $this->load->model('Asociacion_model', 'AM',true);
		    $i=$i-1;
		      //insertamos los datos del excel en la base de datos
		      $import_excel = $this->AM->excel($table_name,$sql,$i,$this->input->post('idAsociacion'));
		      
		      //comprobamos si se ha guardado bien
		     
		 
		      //finalmente, eliminamos el archivo pase lo que pase
		      //unlink("./docs/".$file);
		 
		    }else{
		      echo "Debes subir un archivo";
		    }
		  
	}

	
}
