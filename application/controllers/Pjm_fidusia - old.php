<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pjm_fidusia extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pjm_fidusia_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
				$this->cek_status(); //cek session login
    }

    public function index()
    {
        $this->load->view('pjm_fidusia/header');
        $this->load->view('pjm_fidusia/pjm_fidusia_list');
        $this->load->view('pjm_fidusia/footer');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Pjm_fidusia_model->json();
    }

    public function read($id) 
    {
        $row = $this->Pjm_fidusia_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pjm_fidusia' => $row->id_pjm_fidusia,
		'id_pbr_fidusia' => $row->id_pbr_fidusia,
		'id_objek' => $row->id_objek,
		'id_pnr_fidusia' => $row->id_pnr_fidusia,
		'tanggal_buat' => $row->tanggal_buat,
		'status' => $row->status,
	    );
            $this->load->view('pjm_fidusia/header');
            $this->load->view('pjm_fidusia/pjm_fidusia_read', $data);
            $this->load->view('pjm_fidusia/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pjm_fidusia'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pjm_fidusia/create_action'),
	    'id_pjm_fidusia' => set_value('id_pjm_fidusia'),
	    'groups' => $this->Pjm_fidusia_model->AllUser(),
	    'groups1' => $this->Pjm_fidusia_model->AllPbr(),
	    'groups2' => $this->Pjm_fidusia_model->AllObjek(),
	    'groups3' => $this->Pjm_fidusia_model->AllPnr(),
	    'tanggal_buat' => set_value('tanggal_buat'),
	    'status' => set_value('status'),
	);
        $this->load->view('pjm_fidusia/header');
		$this->load->view('pjm_fidusia/pjm_fidusia_form', $data);
		$this->load->view('pjm_fidusia/footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id' => $this->input->post('groups',TRUE),
		'id_pbr_fidusia' => $this->input->post('groups1',TRUE),
		'id_objek' => $this->input->post('groups2',TRUE),
		'id_pnr_fidusia' => $this->input->post('groups3',TRUE),
		'tanggal_buat' => $this->input->post('tanggal_buat',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Pjm_fidusia_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pjm_fidusia'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pjm_fidusia_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pjm_fidusia/update_action'),
		'id_pjm_fidusia' => set_value('id_pjm_fidusia', $row->id_pjm_fidusia),
	    'groups' => $this->Pjm_fidusia_model->AllUser(),
	    'groups1' => $this->Pjm_fidusia_model->AllPbr(),
	    'groups2' => $this->Pjm_fidusia_model->AllObjek(),
	    'groups3' => $this->Pjm_fidusia_model->AllPnr(),
		'tanggal_buat' => set_value('tanggal_buat', $row->tanggal_buat),
		'status' => set_value('status', $row->status),
	    );
        $this->load->view('pjm_fidusia/header');
		$this->load->view('pjm_fidusia/pjm_fidusia_form', $data);
		$this->load->view('pjm_fidusia/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pjm_fidusia'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pjm_fidusia', TRUE));
        } else {
            $data = array(
		'id' => $this->input->post('groups',TRUE),
		'id_pbr_fidusia' => $this->input->post('groups1',TRUE),
		'id_objek' => $this->input->post('groups2',TRUE),
		'id_pnr_fidusia' => $this->input->post('groups3',TRUE),
		'tanggal_buat' => $this->input->post('tanggal_buat',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Pjm_fidusia_model->update($this->input->post('id_pjm_fidusia', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pjm_fidusia'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pjm_fidusia_model->get_by_id($id);

        if ($row) {
            $this->Pjm_fidusia_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pjm_fidusia'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pjm_fidusia'));
        }
    }

    public function _rules() 
    {
	//$this->form_validation->set_rules('id', 'id', 'trim|required');
	//$this->form_validation->set_rules('id_pbr_fidusia', 'id pbr fidusia', 'trim|required');
	//$this->form_validation->set_rules('id_objek', 'id objek', 'trim|required');
	//$this->form_validation->set_rules('id_pnr_fidusia', 'id pnr fidusia', 'trim|required');
	//$this->form_validation->set_rules('tanggal_buat', 'tanggal buat', 'trim|required');
	//$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id_pjm_fidusia', 'id_pjm_fidusia', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pjm_fidusia.xls";
        $judul = "pjm_fidusia";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Pbr Fidusia");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Objek");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Pnr Fidusia");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Buat");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");

	foreach ($this->Pjm_fidusia_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_pbr_fidusia);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_objek);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_pnr_fidusia);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_buat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=pjm_fidusia.doc");

        $data = array(
            'pjm_fidusia_data' => $this->Pjm_fidusia_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('pjm_fidusia/pjm_fidusia_doc',$data);
    }

}

/* End of file Pjm_fidusia.php */
/* Location: ./application/controllers/Pjm_fidusia.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-06-28 15:51:03 */
/* http://harviacode.com */