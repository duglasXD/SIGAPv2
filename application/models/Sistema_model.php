<?php
//session_start();


//parent::__construct();





class Sistema_model extends CI_Model {

        public $title;
        public $content;
        public $date;

        public function getAllOpciones()
        {
        		//$this->load->database();
                $this->db->where("id_sistema=".$this->config->item("id_sistema"));
               $query = $this->db->get('org_modulo');
                return $query->result_array();
        }
        public function getIdModulo($ruta)
        {
                //$this->load->database();
                $this->db->where("url_modulo",$ruta);
               $query = $this->db->get('org_modulo');
                return $query->row()->id_modulo;
        }
         public function getPermiso($id,$permiso)
        {
                $this->load->library('session');
                $this->db->where("id_rol",$this->session->userdata('rol_usuario'));
                $this->db->where("id_modulo",$id);
                $this->db->where("id_permiso",$permiso);
                $this->db->where("estado",1);
               $query = $this->db->count_all_results('org_rol_modulo_permiso');
                if($query>0)
                {
                    return true;
                }
                else
                {
                    return false;
                }
               // return $query->row()->id_modulo;
        }
        public function getSubOpciones()
        {
            //$this->load->database();
           //  $where = "dependencia=NULL";
                $this->db->where("id_sistema=".$this->config->item("id_sistema"));
                $this->db->where("IFNULL(dependencia, 0)=0");
                $query = $this->db->get('org_modulo');
                return $query->result_array();
        }

        public function verDependencia($codigo)
        {
             // $where = "ID_ASOCIACION=".$codigo;
              $query = $this->db->query('select b.NOMBRE_OPCION_SISTEMA as nomDependencia from tab_opcion_sistema a, tab_opcion_sistema b where a.DEPENDENCIA_OPCION_SISTEMA=b.ID_OPCION_SISTEMA AND  a.DEPENDENCIA_OPCION_SISTEMA='.$codigo);
           if ($query->num_rows() > 0) {
                   return $query->row()->nomDependencia;
                }
            return "Sin dependencia";
        }

        public function guardaOpcion($data)
        {

              $this->load->model('Bitacora_model');
              $this->db->trans_begin();
                 
             
                   $this->db->query("INSERT INTO tab_opcion_sistema (ID_OPCION_SISTEMA, NOMBRE_OPCION_SISTEMA, RUTA_OPCION_SISTEMA, NIVEL_OPCION_SISTEMA, DEPENDENCIA_OPCION_SISTEMA) VALUES (NULL, '".$data["nombre"]."', '".$data["ruta"]."', ".$data["nivel"].", ".$data["dependencia"].")");
                     $this->Bitacora_model->saveBitacora($_SESSION['usuario'],"Se registró la opción del sistema: ".$data["nombre"]);
                                    
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
        public function editaOpcion($data)
        {
              $this->load->model('Bitacora_model');
              $this->db->trans_begin();
                 
             
                   $this->db->query("UPDATE tab_opcion_sistema SET NOMBRE_OPCION_SISTEMA = '".$data["nombre"]."', RUTA_OPCION_SISTEMA = '".$data["ruta"]."', NIVEL_OPCION_SISTEMA = ".$data["nivel"].", DEPENDENCIA_OPCION_SISTEMA =  ".$data["dependencia"]." WHERE ID_OPCION_SISTEMA =".$data["id"]);
                     $this->Bitacora_model->saveBitacora($_SESSION['usuario'],"Se editó la opción del sistema: ".$data["nombre"]);
                                    
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
        public function getOpcion($codigo)
        {
            //$this->load->database();
                $where = "ID_OPCION_SISTEMA=".$codigo;
                $this->db->where($where);
                $query = $this->db->get('tab_opcion_sistema');
                return $query->result_array();
        }

         public function getOpcionByDependencia($codigo)
        {
              $where = "DEPENDENCIA_OPCION_SISTEMA=".$codigo;
                $this->db->where($where);
                $query = $this->db->get('tab_opcion_sistema');
                return $query->result_array();
        }

         public function verOpciones($codigo)
        {
             // $where = "ID_ASOCIACION=".$codigo;
              $query = $this->db->query('SELECT NOMBRE_OPCION_SISTEMA FROM tab_opcion_sistema WHERE ID_OPCION_SISTEMA IN (SELECT ID_OPCION_SISTEMA FROM tab_opcion_por_rol WHERE ID_ROL_USUARIO = '.$codigo.')');
           
                   return $query->result_array();
              
        }
        public function comprobarOpcion($codigo,$id)
        {
             $query = $this->db->query('SELECT ID_OPCION_SISTEMA FROM tab_opcion_por_rol WHERE ID_ROL_USUARIO = '.$id.' and ID_OPCION_SISTEMA ='.$codigo);
           
             if ($query->num_rows() > 0) {
                   return 1;
                }
                else{
                  return 0;
                }
        }
        public function verNombreOpcion($codigo)
        {
             // $where = "ID_ASOCIACION=".$codigo;
              $query = $this->db->query('select NOMBRE_OPCION_SISTEMA as nombre from tab_opcion_sistema where ID_OPCION_SISTEMA='.$codigo);
           
              return $query->row()->nombre;
               
        }
        public function comprobarOpcion2($codigo,$id)
        {
             $query = $this->db->query('SELECT ID_OPCION_SISTEMA FROM tab_opcion_sistema WHERE DEPENDENCIA_OPCION_SISTEMA = '.$codigo.' and ID_OPCION_SISTEMA ='.$id);
           
             if ($query->num_rows() > 0) {
                   return 1;
                }
                else{
                  return 0;
                }
        }
        public function getSubOpcionesPorRol($rol,$opcion)
        {
            $query = $this->db->query("SELECT * FROM org_modulo WHERE id_modulo IN (SELECT DISTINCT id_modulo FROM org_rol_modulo_permiso WHERE id_rol=".$rol.") AND dependencia=".$opcion);
             return $query;
        }
        
        


}
?>