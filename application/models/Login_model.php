<?php 




class Login_model extends CI_Model {
  function __construct()
  {

  parent::__construct();

  $this->load->database();

  }

        public function getEstadoUsuario($user)
        {
        		//$this->load->database();
                $query = $this->db->query("
                      SELECT 
                            estado
                        AS estado 
                       FROM org_usuario 
                       WHERE id_usuario = '".$user."'
                       ");
                if ($query->num_rows() > 0) {
                   return $query->row()->estado;
                }else{
                  $query = $this->db->query("
                                          SELECT 
                                                ESTADO_USUARIO
                                            AS estado 
                                           FROM sap_usuario_asociacion
                                           WHERE ID_USUARIO = '".$user."'
                                           ");
                  if($query->num_rows() > 0){
                     
                  }else{
                    return 0;
                  }
                }
               // return $query;
        }

        public function getTipoUsuario($user)
        {
            //$this->load->database();
                $query = $this->db->query("
                      SELECT 
                            TIPO_USUARIO 
                            AS tipo 
                       FROM org_usuario 
                       WHERE id_usuario = '".$user."'
                       ");
                if ($query->num_rows() > 0) {
                   return $query->row()->tipo;
                }else{
                  return 0;
                }
               // return $query;
        }

        public function autenticaExterno($user,$pass)
        {
          $pass = md5($pass);
          $query = $this->db->query("
                      SELECT *
                       FROM sap_usuario_asociacion 
                       WHERE id_usuario = '".$user."' and PASSWORD_USUARIO = '".$pass."'
                       ");
     
                   return $query;
                

        }

    public function autenticaInterno($user,$pass){
      //echo $user.'  '.$pass;
        if($this->verificar_pass($user))
        {
                $pass = md5($pass);
                $query = $this->db->query("
                            SELECT *
                             FROM org_usuario 
                             WHERE usuario = '".$user."' and password = '".$pass."'
                             ");
                if($query->num_rows()>0)
                {
                  return 'login';
                }
                else
                {
                  return "error";
                }
        }
        else
        {
            error_reporting(0); $ldaprdn = $user.'@trabajo.local'; $ldappass = $pass; $ds = 'trabajo.local'; $dn = 'dc=trabajo,dc=local'; $puertoldap = 389; $ldapconn = @ldap_connect($ds,$puertoldap);
            if ($ldapconn){ 
              ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION,3); ldap_set_option($ldapconn, LDAP_OPT_REFERRALS,0); 
              $ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);
              if ($ldapbind){  return "login";
              }else{ return $this->ldap2_login($user,$pass); } 
            }else{ 
              return $this->ldap2_login($user,$pass);
            }
            ldap_close($ldapconn);
        }
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
            
    public function getDatosUsuario($user)
        {
         // $pass = sha1($pass);
          $query = $this->db->query("
                      SELECT 
                           *
                       FROM sap_usuario_asociacion 
                       WHERE ID_USUARIO = '".$user."'
                       ");
     
                   return $query;
                
           // return $query;
        }
    public function verificar_usuario($data){
        $query = $this->db->query("SELECT * FROM org_usuario WHERE usuario = '".$data['usuario']."'");
        if($query->num_rows() > 0){
          return "interno";
        }else{
          $query = $this->db->query("SELECT * FROM sap_usuario_asociacion WHERE ID_USUARIO  = '".$data['usuario']."'");
          if($query->num_rows() > 0){
              return "externo";
            }
            else{
              return "no";
            }
        }
      }

  public function get_data_user($data){
    $query = $this->db->query("SELECT * FROM org_usuario WHERE usuario = '".$data['usuario']."' AND estado = 1");
    return $query;
  }

  public function verificar_estado($data){
    $query = $this->db->query("SELECT * FROM org_usuario WHERE usuario = '".$data['usuario']."' AND estado = 1");
    if($query->num_rows() > 0){
      return "activo";
    }
    else
    {
     $query = $this->db->query("SELECT * FROM sap_usuario_asociacion WHERE ID_USUARIO = '".$data['usuario']."' AND ESTADO_USUARIO = 1");
      if($query->num_rows() > 0){
           return "activo";
        }
        else
        {
          return "inactivo";
        }
    }
  }

  public function getRol($user)
  {
      $query = $this->db->query("SELECT id_rol FROM org_usuario_rol WHERE id_usuario =".$user);
      return $query->row()->id_rol;
  }

  public function verificar_pass($user){
  //  echo "SELECT password FROM org_usuario WHERE usuario ='".$user."'";
      $query = $this->db->query("SELECT password FROM org_usuario WHERE usuario ='".$user."'");

    //  echo $query->row()->password;
      if($query->row()->password==NULL||$query->row()->password=='')
      {
          return false;
      }
      else
      {
          return true;
      }

  }

}
?>