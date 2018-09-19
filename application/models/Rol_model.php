<?php
//session_start();


//parent::__construct();





class Rol_model extends CI_Model {

        public $title;
        public $content;
        public $date;

        public function getAllRoles()
        {
        		$this->load->database();
                $query = $this->db->get('org_rol');
                return $query->result_array();
        }
      

       public function getRol($codigo)
       {
          $this->load->database();
          $this->db->where('id_rol = '.$codigo);
          $query = $this->db->get('org_rol');
          return $query->result_array();
       }

        public function guardaRol($data)
        {
              $this->load->database();
              $this->load->model('Bitacora_model');
              $this->db->trans_begin();
                  $this->db->query("INSERT INTO org_rol (id_rol, nombre_rol, DESCRIPCION_ROL_USUARIO) VALUES (NULL, '".$data["nombre"]."', '".$data["descripcion"]."')");
                  $x=$this->db->insert_id();
                  $aux = count($data["opciones"]);             
                  $opciones=$data["opciones"];
                 $this->Bitacora_model->saveBitacora($_SESSION['usuario'],"Se registró el rol ".$data["nombre"]);
                 
                  for ($i=0; $i <$aux ; $i++) { 
                    $this->db->query("INSERT INTO tab_opcion_por_rol (id_rol, ID_OPCION_SISTEMA) VALUES ('".$x."', '".$opciones[$i]."')");
                    $this->Bitacora_model->saveBitacora($_SESSION['usuario'],"Se asignó la opción ".$opciones[$i]." al rol ".$data["nombre"]);
                  }
                  
                                    
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
        
        public function editaRol($data)
        {
                  $this->load->database();
                  $this->load->model('Bitacora_model');
                  $this->load->model('Sistema_model');
                  $this->db->trans_begin();
                  $this->db->query("UPDATE org_rol SET nombre_rol = '".$data["nombre"]."', DESCRIPCION_ROL_USUARIO = '".$data["descripcion"]."' WHERE id_rol =".$data["id"]);
                  $this->Bitacora_model->saveBitacora($_SESSION['usuario'],"Se editó el rol ".$data["nombre"]);
                  $x=$data["id"];
                  $aux = count($data["opciones"]);
                  $opciones=$data["opciones"];
                  $this->db->query("DELETE FROM tab_opcion_por_rol WHERE id_rol =".$x);
                  $this->Bitacora_model->saveBitacora($_SESSION['usuario'],"Se eliminaron las opciones del sistema asignadas al rol ".$data["nombre"]);
                 
                  for ($i=0; $i <$aux ; $i++) { 
                    $this->db->query("INSERT INTO tab_opcion_por_rol (id_rol, ID_OPCION_SISTEMA) VALUES ('".$x."', '".$opciones[$i]."')");

                    $this->Bitacora_model->saveBitacora($_SESSION['usuario'],"Se asignó la opción ".$this->Sistema_model->verNombreOpcion($opciones[$i])." al rol ".$data["nombre"]);
                  }
                 
                                    
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
        
      public function verNombreRol($codigo)
       {
        $this->load->database();
          
          $query = $this->db->query('select nombre_rol as nombre from org_rol where id_rol ='.$codigo);
           return $query->row()->nombre;
       }


}
?>