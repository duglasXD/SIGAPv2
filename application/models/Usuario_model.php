<?php
//session_start();


class Usuario_model extends CI_Model {

        public $title;
        public $content;
        public $date;

        public function getAllUsuarios()
        {
        		$this->load->database();
                $query = $this->db->get('sap_usuario_asociacion');
                return $query->result_array();
        }
        

       public function validateId($codigo)
       {
        $this->load->database();
          $this->db->where('ID_USUARIO = "'.$codigo.'"');
          $query = $this->db->get('sap_usuario_asociacion');
         if ($query->num_rows() > 0) {
                   return 'fail';
                }
                else{
                  return 'exito';
                }
       }

        public function guardaUsuario($data)
        {
          $this->load->database();
              $this->load->model('Bitacora_model');
              $this->db->trans_begin();
              if($data['tipo']==1){
                  $this->db->query("INSERT INTO sap_usuario_asociacion (ID_USUARIO, NOMBRE_USUARIO, PASSWORD_USUARIO, TIPO_USUARIO, ESTADO_USUARIO, ID_ROL_USUARIO, ID_ASOCIACION_USUARIO) VALUES ('".$data['id']."', '".$data['nombre']."', NULL, ".$data['tipo'].", ".$data['estado'].", ".$data['rol'].", NULL)");
              }else{
                  if($data['asociacion']==-1)
                  {
                    $this->db->query("INSERT INTO sap_usuario_asociacion (ID_USUARIO, NOMBRE_USUARIO, PASSWORD_USUARIO, TIPO_USUARIO, ESTADO_USUARIO, ID_ROL_USUARIO, ID_ASOCIACION_USUARIO) VALUES ('".$data['id']."', '".$data['nombre']."', '".$data['pass']."', ".$data['tipo'].", ".$data['estado'].", ".$data['rol'].", NULL)");
                  }
                  
                  else
                  {
                    $this->db->query("INSERT INTO sap_usuario_asociacion (ID_USUARIO, NOMBRE_USUARIO, PASSWORD_USUARIO, TIPO_USUARIO, ESTADO_USUARIO, ID_ROL_USUARIO, ID_ASOCIACION_USUARIO) VALUES ('".$data['id']."', '".$data['nombre']."', '".$data['pass']."', ".$data['tipo'].", ".$data['estado'].", ".$data['rol'].", ".$data['asociacion'].")");
                  } 
              }
                                 
              $this->Bitacora_model->saveBitacora($_SESSION['usuario'],"Se registró el Usuario ".$data["nombre"]);                
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
        
        public function editaUsuario($data)
        {
          $this->load->database();
                  $this->load->model('Bitacora_model');
              $this->db->trans_begin();
              if($data['tipo']==1){
                 $this->db->query("UPDATE sap_usuario_asociacion SET  NOMBRE_USUARIO = '".$data['nombre']."', PASSWORD_USUARIO = NULL, TIPO_USUARIO = ".$data['tipo'].", ESTADO_USUARIO = ".$data['estado'].", ID_ROL_USUARIO = ".$data['rol'].", ID_ASOCIACION_USUARIO = NULL WHERE ID_USUARIO = '".$data['id']."' ");
              }
              else{
                  if($data['asociacion']==-1)
                  {
                     $this->db->query("UPDATE sap_usuario_asociacion SET  NOMBRE_USUARIO = '".$data['nombre']."', PASSWORD_USUARIO = '".$data['pass']."', TIPO_USUARIO = ".$data['tipo'].", ESTADO_USUARIO = ".$data['estado'].", ID_ROL_USUARIO = ".$data['rol'].", ID_ASOCIACION_USUARIO = NULL WHERE ID_USUARIO = '".$data['id']."' ");
                  }
                  else
                  {
                     $this->db->query("UPDATE sap_usuario_asociacion SET  NOMBRE_USUARIO = '".$data['nombre']."', PASSWORD_USUARIO = '".$data['pass']."', TIPO_USUARIO = ".$data['tipo'].", ESTADO_USUARIO = ".$data['estado'].", ID_ROL_USUARIO = ".$data['rol'].", ID_ASOCIACION_USUARIO = ".$data['asociacion']." WHERE ID_USUARIO = '".$data['id']."' ");
                  } 
              }
                                 
              $this->Bitacora_model->saveBitacora($_SESSION['usuario'],"Se editó el Usuario ".$data["nombre"]);                
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

      public function getUsuario($codigo)
       {
          $this->load->database();
          $this->db->where('ID_USUARIO = "'.$codigo.'"');
          $query = $this->db->get('sap_usuario_asociacion');
          return $query->result_array();
       }

       public function getAsocByUsuario($codigo)
       {
          $query = $this->db->query('select ID_ASOCIACION_USUARIO as asociacion from sap_usuario_asociacion  where  ID_USUARIO="'.$codigo.'"');
           if ($query->num_rows() > 0) {
                   return $query->row()->asociacion;
                }
       }


        
        


}
?>