<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pbr_fidusia extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Pbr_fidusia_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
				$this->cek_status(); //cek session login
    }

    public function index()
    {
        $this->load->view('pbr_fidusia/header');
        $this->load->view('pbr_fidusia/pbr_fidusia_list');
        $this->load->view('pbr_fidusia/footer');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Pbr_fidusia_model->json();
    }

    public function read($id) 
    {
        $row = $this->Pbr_fidusia_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pbr_fidusia' => $row->id_pbr_fidusia,
		'id' => $row->id,
		'pbr_nama' => $row->pbr_nama,
		'pbr_alamat' => $row->pbr_alamat,
		'pbr_nik' => $row->pbr_nik,
		'pbr_jengkel' => $row->pbr_jengkel,
		'pbr_nmr_kontak' => $row->pbr_nmr_kontak,
	    );
            $this->load->view('pbr_fidusia/header');
            $this->load->view('pbr_fidusia/pbr_fidusia_read', $data);
            $this->load->view('pbr_fidusia/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pbr_fidusia'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pbr_fidusia/create_action'),
	    'id_pbr_fidusia' => set_value('id_pbr_fidusia'),
	    'groups' => $this->Pbr_fidusia_model->getAllGroups(),
		'pbr_nama' => set_value('pbr_nama'),
	    'pbr_alamat' => set_value('pbr_alamat'),
	    'pbr_nik' => set_value('pbr_nik'),
	    'pbr_jengkel' => set_value('pbr_jengkel'),
	    'pbr_nmr_kontak' => set_value('pbr_nmr_kontak'),
	);
        $this->load->view('pbr_fidusia/header');
        $this->load->view('pbr_fidusia/pbr_fidusia_form', $data);
        $this->load->view('pbr_fidusia/footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id' => $this->input->post('groups',TRUE),
		'pbr_nama' => $this->input->post('pbr_nama',TRUE),
		'pbr_alamat' => $this->input->post('pbr_alamat',TRUE),
		'pbr_nik' => $this->input->post('pbr_nik',TRUE),
		'pbr_jengkel' => $this->input->post('pbr_jengkel',TRUE),
		'pbr_nmr_kontak' => $this->input->post('pbr_nmr_kontak',TRUE),
	    );

            $this->Pbr_fidusia_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pbr_fidusia'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pbr_fidusia_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pbr_fidusia/update_action'),
		'id_pbr_fidusia' => set_value('id_pbr_fidusia', $row->id_pbr_fidusia),
		'groups' => $this->Pbr_fidusia_model->getAllGroups(),
		'pbr_nama' => set_value('pbr_nama', $row->pbr_nama),
		'pbr_alamat' => set_value('pbr_alamat', $row->pbr_alamat),
		'pbr_nik' => set_value('pbr_nik', $row->pbr_nik),
		'pbr_jengkel' => set_value('pbr_jengkel', $row->pbr_jengkel),
		'pbr_nmr_kontak' => set_value('pbr_nmr_kontak', $row->pbr_nmr_kontak),
	    );
        $this->load->view('pbr_fidusia/header');
        $this->load->view('pbr_fidusia/pbr_fidusia_form', $data);
        $this->load->view('pbr_fidusia/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pbr_fidusia'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pbr_fidusia', TRUE));
        } else {
            $data = array(
		'id' => $this->input->post('groups',TRUE),
		'pbr_nama' => $this->input->post('pbr_nama',TRUE),
		'pbr_alamat' => $this->input->post('pbr_alamat',TRUE),
		'pbr_nik' => $this->input->post('pbr_nik',TRUE),
		'pbr_jengkel' => $this->input->post('pbr_jengkel',TRUE),
		'pbr_nmr_kontak' => $this->input->post('pbr_nmr_kontak',TRUE),
	    );

            $this->Pbr_fidusia_model->update($this->input->post('id_pbr_fidusia', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pbr_fidusia'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pbr_fidusia_model->get_by_id($id);

        if ($row) {
            $this->Pbr_fidusia_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pbr_fidusia'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pbr_fidusia'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('pbr_nama', 'Nama', 'trim|required');
	$this->form_validation->set_rules('pbr_alamat', 'Alamat', 'trim|required');
	$this->form_validation->set_rules('pbr_nik', 'NIK', 'trim|required');
	$this->form_validation->set_rules('pbr_jengkel', 'pbr_jengkel', 'trim|required');
	$this->form_validation->set_rules('pbr_nmr_kontak', 'No Tlpn', 'trim|required');

	$this->form_validation->set_rules('id_pbr_fidusia', 'id_pbr_fidusia', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pbr_fidusia.xls";
        $judul = "pbr_fidusia";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Pbr Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Pbr Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Pbr Nik");
	xlsWriteLabel($tablehead, $kolomhead++, "Pbr Jengkel");
	xlsWriteLabel($tablehead, $kolomhead++, "Pbr Nmr Kontak");

	foreach ($this->Pbr_fidusia_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pbr_nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pbr_alamat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->pbr_nik);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pbr_jengkel);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pbr_nmr_kontak);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=pbr_fidusia.doc");

        $data = array(
            'pbr_fidusia_data' => $this->Pbr_fidusia_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('pbr_fidusia/pbr_fidusia_doc',$data);
    }

}

/* End of file Pbr_fidusia.php */
/* Location: ./application/controllers/Pbr_fidusia.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-06-28 15:50:58 */
/* http://harviacode.com */