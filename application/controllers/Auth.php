<?php
 
class Auth extends CI_Controller
 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }
 
    public function index()
    {
        $this->load->view('auth/header');
        $this->load->view('auth/login');
        $this->load->view('auth/footer');
    }
 
    public function loginForm()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
 
        if ($this->form_validation->run() == FALSE) {
 
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('input', $this->input->post());
            redirect('index.php/auth');
         
        } else {
 
            $username = htmlspecialchars ($this->input->post('username'));
            $pass = $this->input->post('password');
            $cek_login = $this->auth_model->cek_login($username);  
 
            if($cek_login == FALSE)
            {
 
                $this->session->set_flashdata('error_login', 'username yang Anda masukan tidak terdaftar.');
                redirect('index.php/auth');
 
            } else {
 
                if(password_verify($pass, $cek_login->password)){
                    $this->session->set_userdata('id', $cek_login->id);
                    $this->session->set_userdata('nama_user', $cek_login->nama_user);
                    $this->session->set_userdata('username', $cek_login->username);
                    $this->session->set_userdata('role', $cek_login->role); 
 
                    redirect('home');
 
                } else {
 
                    $this->session->set_flashdata('error_login', 'username atau password yang Anda masukan salah.');
                    redirect('auth');
 
                }
            }
        }
    }
 
    public function register()
    {
 
        $this->load->view('auth/header');
        $this->load->view('auth/register');
        $this->load->view('auth/footer');
 
    }
 
    public function registerForm()
 
    {
 
        $this->form_validation->set_rules('nama_user', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'username', 'required|callback_check_username_exists');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('confrim_password', 'Konfirmasi Password', 'required|trim|matches[password]');
        $this->form_validation->set_rules('role', 'role', 'required');
 
        if ($this->form_validation->run() == FALSE) {
 
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('input', $this->input->post());
            redirect('auth/register');
 
        } else {
 
            $nama_user = $this->input->post('nama_user');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $role = $this->input->post('role');
 
            $data = [
                'nama_user' => $nama_user,
                'username' => $username,
                'password' => $pass,
                'role' => $role
            ];
 
            $insert = $this->auth_model->register("user", $data);
 
            if($insert){
 
                $this->session->set_flashdata('success_login', 'Sukses, Anda berhasil register. Silahkan login sekarang.');
                redirect('auth');
 
            }
        }
    }
	
	public function check_username_exists($username)
	{
		$this->form_validation->set_message('check_username_exists', 'Username tidak tersedia. Silahkan gunakan username lain');
		if($this->auth_model->check_username_exists($username))
		{
			return true;
		} else
		{
			return false;
		}
	}
	
    public function logout()
    {
        $this->session->sess_destroy();
        echo '<script>
            alert("Sukses! Anda berhasil logout."); 
            window.location.href="'.base_url('company').'";
            </script>';
    }
}
?>