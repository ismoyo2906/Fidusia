<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Progress extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Progress_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
				$this->cek_status(); //cek session login
    }

    public function index()
    {
        $this->load->view('progress/header');
        $this->load->view('progress/progress_list');
        $this->load->view('progress/footer');
    } 
	
    public function progress_user()
    {
	$where = $this->session->userdata('id_user');
	$d = $this->Progress_model->find($where, 'progress');
	$data['user'] = $this->Progress_model->edit_data(array('id' => $this->session->userdata('id')),'user')->result();
	$data['pjm_fidusia']= $this->db->query("select*from pjm_fidusia pjm, pbr_fidusia pbr, pnr_fidusia pnr, progress p 
	where pbr.id_pbr_fidusia=p.id_pbr_fidusia and pnr.id_pnr_fidusia=p.id_pnr_fidusia and pjm.id_pjm_fidusia=p.id_pjm_fidusia and p.id='$where'")->result();
	//if($d > 0){
        $this->load->view('progress/header');
        $this->load->view('progress/progress_list_user', $data);
        $this->load->view('progress/footer');
	//}else{redirect('home');}
 }
	
    public function json() {
        header('Content-Type: application/json');
        echo $this->Progress_model->json();
    }

    public function read($id) 
    {
        $row = $this->Progress_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_progress' => $row->id_progress,
		'id' => $row->id,
		'id_pjm_fidusia' => $row->id_pjm_fidusia,
		'id_pbr_fidusia' => $row->id_pbr_fidusia,
		'id_pnr_fidusia' => $row->id_pnr_fidusia,
		'tanggal_input' => $row->tanggal_input,
	    );
            $this->load->view('progress/progress_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('progress'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('progress/create_action'),
	    'id_progress' => set_value('id_progress'),
	    'id' => set_value('id'),
	    'id_pjm_fidusia' => set_value('id_pjm_fidusia'),
	    'id_pbr_fidusia' => set_value('id_pbr_fidusia'),
	    'id_pnr_fidusia' => set_value('id_pnr_fidusia'),
	    'tanggal_input' => set_value('tanggal_input'),
	);
        $this->load->view('progress/progress_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id' => $this->input->post('id',TRUE),
		'id_pjm_fidusia' => $this->input->post('id_pjm_fidusia',TRUE),
		'id_pbr_fidusia' => $this->input->post('id_pbr_fidusia',TRUE),
		'id_pnr_fidusia' => $this->input->post('id_pnr_fidusia',TRUE),
		'tanggal_input' => $this->input->post('tanggal_input',TRUE),
	    );

            $this->Progress_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('progress'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Progress_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('progress/update_action'),
		'id_progress' => set_value('id_progress', $row->id_progress),
		'id' => set_value('id', $row->id),
		'id_pjm_fidusia' => set_value('id_pjm_fidusia', $row->id_pjm_fidusia),
		'id_pbr_fidusia' => set_value('id_pbr_fidusia', $row->id_pbr_fidusia),
		'id_pnr_fidusia' => set_value('id_pnr_fidusia', $row->id_pnr_fidusia),
		'tanggal_input' => set_value('tanggal_input', $row->tanggal_input),
	    );
            $this->load->view('progress/progress_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('progress'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_progress', TRUE));
        } else {
            $data = array(
		'id' => $this->input->post('id',TRUE),
		'id_pjm_fidusia' => $this->input->post('id_pjm_fidusia',TRUE),
		'id_pbr_fidusia' => $this->input->post('id_pbr_fidusia',TRUE),
		'id_pnr_fidusia' => $this->input->post('id_pnr_fidusia',TRUE),
		'tanggal_input' => $this->input->post('tanggal_input',TRUE),
	    );

            $this->Progress_model->update($this->input->post('id_progress', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('progress'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Progress_model->get_by_id($id);

        if ($row) {
            $this->Progress_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('progress'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('progress'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id', 'id', 'trim|required');
	$this->form_validation->set_rules('id_pjm_fidusia', 'id pjm fidusia', 'trim|required');
	$this->form_validation->set_rules('id_pbr_fidusia', 'id pbr fidusia', 'trim|required');
	$this->form_validation->set_rules('id_pnr_fidusia', 'id pnr fidusia', 'trim|required');
	$this->form_validation->set_rules('tanggal_input', 'tanggal input', 'trim|required');

	$this->form_validation->set_rules('id_progress', 'id_progress', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Progress.php */
/* Location: ./application/controllers/Progress.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-05 18:33:11 */
/* http://harviacode.com */