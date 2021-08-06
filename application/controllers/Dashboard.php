<?php
 
class Dashboard extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
			$this->load->model('dashboard_model');
			$this->load->model('Progress_model');
				$this->cek_status(); //cek session login
    }
 
    public function index()
    {
	$data['user'] = $this->Progress_model->edit_data(array('id' => $this->session->userdata('id_user')),'user')->result();
	$where = $this->session->userdata('id_user');
	$data['progress']= 
	$this->db->query("select*from pjm_fidusia pjm, pbr_fidusia pbr, pnr_fidusia pnr, user u 
	where pbr.id_pbr_fidusia=pjm.id_pbr_fidusia and pnr.id_pnr_fidusia=pjm.id_pnr_fidusia and u.id=pjm.id")->result();
	$d=$this->Progress_model->edit_data(array('id' => $this->session->userdata('id_user')),'progress')->num_rows();
        //$data['t_akte'] = $this->dashboard_model->get('t_akte')->result();
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/index');
        $this->load->view('dashboard/footer');
    }
}
?>