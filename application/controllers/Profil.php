<?php
 
class Profil extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
			$this->load->model('profil_model');
				$this->cek_status(); //cek session login
    }
 
    public function index()
    {
        //$data['t_akte'] = $this->profil_model->get('t_akte')->result();
        $this->load->view('profil/header');
        $this->load->view('profil/index');
        $this->load->view('profil/footer');
    }
}
?>