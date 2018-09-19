<?php


class Documento_model extends CI_Model {
      function __construct()
          {

          //parent::__construct();

          //$this->load->database();
          $this->load->library('session');

          }
        public $title;
        public $content;
        public $date;

        public function getAllDocs()
        {
        		$this->load->database();
                $query = $this->db->get('sap_documento');
                return $query->result_array();
        }
      

       public function getDocumento($codigo)
       {
          $this->load->database();
          $this->db->where('ID_DOCUMENTO = '.$codigo);
          $query = $this->db->get('sap_documento');
          return $query->result_array();
       }

        public function guardaDocumento($data)
        {
              $this->load->database();
              $ruta = $data["ruta"];
              $this->load->model('Bitacora_model');
             
              $this->db->trans_begin();

                  $this->db->query("INSERT INTO sap_documento (ID_DOCUMENTO, NOMBRE_DOCUMENTO, TIPO_DOCUMENTO, RUTA_DOCUMENTO, ESTADO_DOCUMENTO, ACCESO_DOCUMENTO) VALUES (NULL, '".$data["nombre"]."', '".$data["tipo"]."', '".$ruta."', ".$data["estado"].", ".$data["acceso"].")");
                 
              //   $this->Bitacora_model->saveBitacora($_SESSION['usuario'],"Se creo el documento ".$data["nombre"]." en la ruta: ".$ruta);
                 
                   $this->Bitacora_model->bitacora(array( 'descripcion' => "El usuario ".$this->session->userdata('usuario')." creó el documento ".$data["nombre"]." en la ruta: ".$ruta, 'id_accion' => "3"));
                                    
               if ($this->db->trans_status() === FALSE)
                {
                        $this->db->trans_rollback();
                         return 'fracaso';
                }
                else
                {
                        $this->db->trans_commit();
                         return 'exito';
                }

        }
        
        public function editaDocumento($data)
        {
              $this->load->database();
              $ruta = $data["ruta"];
              $this->load->model('Bitacora_model');
             
              $this->db->trans_begin();

                  $this->db->query("UPDATE sap_documento SET NOMBRE_DOCUMENTO = '".$data["nombre"]."', TIPO_DOCUMENTO = '".$data["tipo"]."', RUTA_DOCUMENTO = '".$ruta."', ESTADO_DOCUMENTO = ".$data["estado"].", ACCESO_DOCUMENTO = ".$data["acceso"]." WHERE ID_DOCUMENTO =".$data["id"]);
                 
                 //$this->Bitacora_model->saveBitacora($_SESSION['usuario'],"Se edito el documento ".$data["nombre"]." en la ruta: ".$ruta);
                 
                 $this->Bitacora_model->bitacora(array( 'descripcion' => "El usuario ".$this->session->userdata('usuario')." editó el documento ".$data["nombre"]." en la ruta: ".$ruta, 'id_accion' => "4"));
                                    
               if ($this->db->trans_status() === FALSE)
                {
                        $this->db->trans_rollback();
                         return 'fracaso';
                }
                else
                {
                        $this->db->trans_commit();
                         return 'exito';
                }
        }
        
    

        public function getAllExternos()
       {
        $this->load->database();
          
          $query = $this->db->query('select *  from sap_documento where ESTADO_DOCUMENTO = 1 and ACCESO_DOCUMENTO = 2');
          return $query->result_array();
       }

       public function getAllInternos()
       {
        $this->load->database();
          
          $query = $this->db->query('select *  from sap_documento where ESTADO_DOCUMENTO = 1 and ACCESO_DOCUMENTO = 1');
          return $query->result_array();
       }

       public function getAllPublicos()
       {
        $this->load->database();
          
          $query = $this->db->query('select *  from sap_documento where ESTADO_DOCUMENTO = 1 and ACCESO_DOCUMENTO = 3');
          return $query->result_array();
       }


}
?>