<?php
//session_start();


//parent::__construct();





class Junta_model extends CI_Model {

        public $title;
        public $content;
        public $date;

        public function getAllJuntas()
        {
        		$query = $this->db->query("
                      SELECT A.ID_JUNTA AS ID,  A.FECHA_POSESION_JUNTA AS POSESION, A.FECHA_FIN_JUNTA AS FINALIZACION, B.NOMBRE_ASOCIACION AS ASOCIACION, A.HOMBRES_JUNTA AS HOMBRES, A.MUJERES_JUNTA AS MUJERES FROM sap_junta_directiva A, sap_asociacion B WHERE  A.ID_ASOCIACION_JUNTA=B.ID_ASOCIACION
                        ");
                      
                      
          $aux=$query->result_array();
        
                return $aux;
        }
      

       public function getRol($codigo)
       {
          $this->load->database();
          $this->db->where('id_rol = '.$codigo);
          $query = $this->db->get('org_rol');
          return $query->result_array();
       }

        public function guardaJunta($data,$secretaria)
        {
              $this->load->database();
              $this->load->model('Bitacora_model');
              $this->db->trans_begin();
                  $this->db->query("INSERT INTO sap_junta_directiva (ID_JUNTA, ID_ASOCIACION_JUNTA, FECHA_ELECCION_JUNTA, FECHA_POSESION_JUNTA, FECHA_FIN_JUNTA, FECHA_AUTO_JUNTA, OFICIO_JUNTA, CARNES_JUNTA, LIBRO_JUNTA, CONVOCATORIA_JUNTA, ANTELACION_JUNTA, AGENDA_JUNTA, VOTACION_JUNTA, ASISTENCIA_JUNTA, REPRESENTACION_LEGAL_JUNTA, QUORUM_JUNTA, FECHA_PRESENTACION_JUNTA, HORA_PRESENTACION_JUNTA, PRESENTADO_POR_JUNTA, HOMBRES_JUNTA, MUJERES_JUNTA, ESTADO_JUNTA, REGISTRO_JUNTA, FOLIO_JUNTA, ARTICULO_JUNTA) VALUES (NULL, ".$data["asociacionJunta"].", '".$data["fechaEleccionJunta"]."', '".$data["fechaPosesionJunta"]."', '".$data["fechaFinJunta"]."', '".$data["fechaAutoJunta"]."', '".$data["oficioJunta"]."', '".$data["carneJunta"]."', '".$data["libroJunta"]."', '".$data["convocatoriaJunta"]."', '".$data["antelacionJunta"]."', '".$data["agendaJunta"]."', '".$data["votacionJunta"]."', ".$data["asistenciaJunta"].", '".$data["representacionJunta"]."', ".$data["quorumJunta"].", '".$data["presentacionJunta"]."', '".$data["horaJunta"]."', '".$data["presentadoPorJunta"]."', ".$data["hombresJunta"].",  ".$data["mujeresJunta"].", 'Activo','".$data["regJunta"]."', '".$data["folioJunta"]."', '".$data["articuloJunta"]."')");
                  $x=$this->db->insert_id();
               
               //  $this->Bitacora_model->saveBitacora($_SESSION['usuario'],"Se registró la junta directiva de la asociacion: ".$data["asociacionJunta"]);
                 $this->Bitacora_model->bitacora(array( 'descripcion' => "Se registró la junta directiva de la asociacion: ".$data["asociacionJunta"], 'id_accion' => "3"));

                 
                  for ($i=1; $i <$data["contador"]; $i++) { 
                    $this->db->query("INSERT INTO sap_secretaria_junta (ID_JUNTA, NOMBRE_SECRETARIA_JUNTA, REPRESENTANTE_SECRETARIA_JUNTA) VALUES (".$x.", '".$secretaria[$i][0]."', '".$secretaria[$i][1]."')");
                  //  $this->Bitacora_model->saveBitacora($_SESSION['usuario'],"Se agregó la secretaria ".$secretaria[$i][0]." a la junta: ".$x);
                    $this->Bitacora_model->bitacora(array( 'descripcion' => "Se agregó la secretaria ".$secretaria[$i][0]." a la junta: ".$x, 'id_accion' => "3"));
                    
                    $this->load->model('Asociacion_model','AM',true);
                    $datos = array(
                      'id' => $data["asociacionJunta"], 
                      'estado' => 'Activo',
                      'nombre' => $this->AM->getNombreAsociacion($data["asociacionJunta"])
                      );
                       $this->AM->editaEstado($datos);
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
        
        public function guardaJuntaExcel($data)
        {
              $this->load->database();
              $this->load->model('Bitacora_model');
              $this->db->trans_begin();
              $this->db->query("INSERT INTO sap_junta_directiva (ID_ASOCIACION_JUNTA, FECHA_ELECCION_JUNTA, FECHA_POSESION_JUNTA, FECHA_FIN_JUNTA, FECHA_AUTO_JUNTA, OFICIO_JUNTA, CARNES_JUNTA, LIBRO_JUNTA, CONVOCATORIA_JUNTA, ANTELACION_JUNTA, AGENDA_JUNTA, VOTACION_JUNTA, ASISTENCIA_JUNTA, REPRESENTACION_LEGAL_JUNTA, QUORUM_JUNTA, FECHA_PRESENTACION_JUNTA, HORA_PRESENTACION_JUNTA, PRESENTADO_POR_JUNTA, HOMBRES_JUNTA, MUJERES_JUNTA, ESTADO_JUNTA,  REGISTRO_JUNTA, FOLIO_JUNTA, ARTICULO_JUNTA) VALUES (".$data["ID_ASOCIACION_JUNTA"].", '', '".$data["FECHA_POSESION_JUNTA"]."', '".$data["FECHA_FIN_JUNTA"]."', '', '', '', '".$data["LIBRO_JUNTA"]."', '', '', '', '',0, '', 0, '', '', '', ".$data["HOMBRES_JUNTA"].",  ".$data["MUJERES_JUNTA"].", '".$data["ESTADO_JUNTA"]."','".$data["REGISTRO_JUNTA"]."', '".$data["FOLIO_JUNTA"]."', '".$data["ARTICULO_JUNTA"]."')");
                  $x=$this->db->insert_id();
               
                // $this->Bitacora_model->saveBitacora($_SESSION['usuario'],"Se migró la junta directiva de la asociacion: ".$data["ID_ASOCIACION_JUNTA"]);
                  $this->Bitacora_model->bitacora(array( 'descripcion' => "Se migró la junta directiva de la asociacion: ".$data["ID_ASOCIACION_JUNTA"], 'id_accion' => "3"));
                 
                
               if ($this->db->trans_status() === FALSE)
                {
                        $this->db->trans_rollback();
                         return 'fracaso';
                }
                else
                {
                        $this->db->trans_commit();
                         return $x;
                }

        }
        
      public function verNombreRol($codigo)
       {
        $this->load->database();
          
          $query = $this->db->query('select nombre_rol as nombre from org_rol where id_rol='.$codigo);
           return $query->row()->nombre;
       }

     public function guardaSecretariaExcel($data)
       {
      $this->load->model('Bitacora_model');
        $this->db->trans_begin();
                    $this->db->query("INSERT INTO sap_secretaria_junta (ID_JUNTA, NOMBRE_SECRETARIA_JUNTA, REPRESENTANTE_SECRETARIA_JUNTA) VALUES (".$data['ID_JUNTA'].", '".strtoupper($data['NOMBRE_SECRETARIA_JUNTA'])."', '".strtoupper($data['REPRESENTANTE_SECRETARIA_JUNTA'])."')");
                  //  $this->Bitacora_model->saveBitacora($_SESSION['usuario'],"Se agregó la secretaria ".$data['NOMBRE_SECRETARIA_JUNTA']." a la junta: ".$data['ID_JUNTA']);

                  $this->Bitacora_model->bitacora(array( 'descripcion' => "Se migró la secretaria ".$data['NOMBRE_SECRETARIA_JUNTA']." para la junta: ".$data['ID_JUNTA'], 'id_accion' => "3"));

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
        public function cambia_estado($junta)
        {
            $this->db->where('ID_JUNTA',$junta);
            $this->db->set('ESTADO_JUNTA','Acéfalo');
            return $this->db->update('sap_junta_directiva');
        }
        public function juntasVencidas($hoy)
        {
            $this->db->where('ESTADO_JUNTA','Activo');
            $this->db->where('FECHA_FIN_JUNTA<="'.$hoy.'"');
            $result=$this->db->get('sap_junta_directiva'); 
            if($result->num_rows()>0)
            {       
              return $result->result_array();
            }
            else
            {
              return 0;
            }
        }
}
?>