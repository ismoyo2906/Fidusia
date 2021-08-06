<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pnr_fidusia extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pnr_fidusia_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
				$this->cek_status(); //cek session login
    }

    public function index()
    {
        $this->load->view('pnr_fidusia/header');
        $this->load->view('pnr_fidusia/pnr_fidusia_list');
        $this->load->view('pnr_fidusia/footer');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Pnr_fidusia_model->json();
    }

    public function read($id) 
    {
        $row = $this->Pnr_fidusia_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pnr_fidusia' => $row->id_pnr_fidusia,
		'pnr_nama' => $row->pnr_nama,
		'pnr_alamat' => $row->pnr_alamat,
		'pnr_nik' => $row->pnr_nik,
		'pnr_jengkel' => $row->pnr_jengkel,
		'pnr_nmr_kontak' => $row->pnr_nmr_kontak,
	    );
            $this->load->view('pnr_fidusia/header');
            $this->load->view('pnr_fidusia/pnr_fidusia_read', $data);
            $this->load->view('pnr_fidusia/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pnr_fidusia'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pnr_fidusia/create_action'),
	    'id_pnr_fidusia' => set_value('id_pnr_fidusia'),
	    'pnr_nama' => set_value('pnr_nama'),
	    'pnr_alamat' => set_value('pnr_alamat'),
	    'pnr_nik' => set_value('pnr_nik'),
	    'pnr_jengkel' => set_value('pnr_jengkel'),
	    'pnr_nmr_kontak' => set_value('pnr_nmr_kontak'),
	);
            $this->load->view('pnr_fidusia/header');
            $this->load->view('pnr_fidusia/pnr_fidusia_form', $data);
            $this->load->view('pnr_fidusia/footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'pnr_nama' => $this->input->post('pnr_nama',TRUE),
		'pnr_alamat' => $this->input->post('pnr_alamat',TRUE),
		'pnr_nik' => $this->input->post('pnr_nik',TRUE),
		'pnr_jengkel' => $this->input->post('pnr_jengkel',TRUE),
		'pnr_nmr_kontak' => $this->input->post('pnr_nmr_kontak',TRUE),
	    );
			var_dump();
            $this->Pnr_fidusia_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pnr_fidusia'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pnr_fidusia_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pnr_fidusia/update_action'),
		'id_pnr_fidusia' => set_value('id_pnr_fidusia', $row->id_pnr_fidusia),
		'pnr_nama' => set_value('pnr_nama', $row->pnr_nama),
		'pnr_alamat' => set_value('pnr_alamat', $row->pnr_alamat),
		'pnr_nik' => set_value('pnr_nik', $row->pnr_nik),
		'pnr_jengkel' => set_value('pnr_jengkel', $row->pnr_jengkel),
		'pnr_nmr_kontak' => set_value('pnr_nmr_kontak', $row->pnr_nmr_kontak),
	    );
            $this->load->view('pnr_fidusia/header');
            $this->load->view('pnr_fidusia/pnr_fidusia_form', $data);
            $this->load->view('pnr_fidusia/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pnr_fidusia'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pnr_fidusia', TRUE));
        } else {
            $data = array(
		'pnr_nama' => $this->input->post('pnr_nama',TRUE),
		'pnr_alamat' => $this->input->post('pnr_alamat',TRUE),
		'pnr_nik' => $this->input->post('pnr_nik',TRUE),
		'pnr_jengkel' => $this->input->post('pnr_jengkel',TRUE),
		'pnr_nmr_kontak' => $this->input->post('pnr_nmr_kontak',TRUE),
	    );

            $this->Pnr_fidusia_model->update($this->input->post('id_pnr_fidusia', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pnr_fidusia'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pnr_fidusia_model->get_by_id($id);

        if ($row) {
            $this->Pnr_fidusia_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pnr_fidusia'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pnr_fidusia'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('pnr_nama', 'pnr nama', 'trim|required');
	$this->form_validation->set_rules('pnr_alamat', 'pnr alamat', 'trim|required');
	$this->form_validation->set_rules('pnr_nik', 'pnr nik', 'trim|required');
	$this->form_validation->set_rules('pnr_jengkel', 'pnr jengkel', 'trim|required');
	$this->form_validation->set_rules('pnr_nmr_kontak', 'pnr nmr kontak', 'trim|required');

	$this->form_validation->set_rules('id_pnr_fidusia', 'id_pnr_fidusia', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pnr_fidusia.xls";
        $judul = "pnr_fidusia";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Pnr Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Pnr Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Pnr Nik");
	xlsWriteLabel($tablehead, $kolomhead++, "Pnr Jengkel");
	xlsWriteLabel($tablehead, $kolomhead++, "Pnr Nmr Kontak");

	foreach ($this->Pnr_fidusia_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pnr_nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pnr_alamat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->pnr_nik);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pnr_jengkel);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pnr_nmr_kontak);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=pnr_fidusia.doc");

        $data = array(
            'pnr_fidusia_data' => $this->Pnr_fidusia_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('pnr_fidusia/pnr_fidusia_doc',$data);
    }

}

/* End of file Pnr_fidusia.php */
/* Location: ./application/controllers/Pnr_fidusia.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-06-28 15:51:09 */
/* http://harviacode.com */