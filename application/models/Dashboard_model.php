<?php


class Dashboard_model extends CI_Model {

        public $title;
        public $content;
        public $date;

        public function getTotalAsociaciones()
        {
        		//$this->load->dasapase();
                $query = $this->db->count_all_results('sap_asociacion');
                return $query;
        }

        public function getTotalAsociacionesPorTipo($tipo)
        {
               	$where = "ID_SECTOR_ASOCIACION=".$tipo;
              	$this->db->where($where);
				 $query = $this->db->count_all_results('sap_asociacion');
				
                return $query;
        }

        public function getTotalAsociadosPorEstado($tipo)
        {
               	$where = "ESTADO_AFILIADO = ".$tipo;
              	$this->db->where($where);
				 $query = $this->db->count_all_results('sap_afiliado_asociacion');
				
                return $query;
        }

        public function getTotalSolicitudesPorTipo()
        {
               //$this->db->select('COUNT(a.ID_CLASE_ASOCIACION) AS TOT, b.NOMBRE_CLASE_ASOCIACION');
				//$this->db->from('sap_asociacion a, sap_clase_asociacion b');
				//$this->db->where('a.ID_CLASE_ASOCIACION = b.ID_CLASE_ASOCIACION AND b.ID_CLASE_ASOCIACION <> 8 GROUP BY b.NOMBRE_CLASE_ASOCIACION');
				$query = $this->db->query("
											SELECT COUNT(ESTADO_SOLICITUD) AS total, ESTADO_SOLICITUD as nombre 
  											FROM sap_SOLICITUD 
  											 GROUP BY ESTADO_SOLICITUD
  											");
				$aux=$query->result_array();
				
                return $aux;
        }

        public function getTotalAsociacionesPrivadasPorTipo($id)
        {
               //$this->db->select('COUNT(a.ID_CLASE_ASOCIACION) AS TOT, b.NOMBRE_CLASE_ASOCIACION');
				//$this->db->from('sap_asociacion a, sap_clase_asociacion b');
				//$this->db->where('a.ID_CLASE_ASOCIACION = b.ID_CLASE_ASOCIACION AND b.ID_CLASE_ASOCIACION <> 8 GROUP BY b.NOMBRE_CLASE_ASOCIACION');
				$query = $this->db->query("
											SELECT COUNT(a.ID_CLASE_ASOCIACION)  as total
  											FROM sap_asociacion a, sap_clase_asociacion b 
  											WHERE a.ID_CLASE_ASOCIACION = b.ID_CLASE_ASOCIACION AND b.ID_CLASE_ASOCIACION = ".$id."");
				$aux=$query->row();
				
                return $aux;
        }

}
?>