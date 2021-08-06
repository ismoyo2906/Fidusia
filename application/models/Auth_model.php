<?php
 
class Auth_model extends CI_Model
{
 
    public function cek_login($username)
    {
 
        $hasil = $this->db->where('username', $username)->limit(1)->get('user');
        if($hasil->num_rows() > 0){
            return $hasil->row();
        } else {
            return array();
        }
    }
 
    public function register($table, $data)
    {
        return $this->db->insert($table, $data);
    }

	public function check_username_exists($username)
	{
		$query = $this->db->get_where('user', array('username' => $username));
		
		if(empty($query->row_array()))
			
		{
			
			return true;
			
		}else
		{
			
			return false;
			
		}
	}
}
?>