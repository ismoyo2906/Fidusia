<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Arsip extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Arsip_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
				$this->cek_status(); //cek session login
    }

    public function index()
    {
        $this->load->view('arsip/header');
        $this->load->view('arsip/arsip_list');
        $this->load->view('arsip/footer');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Arsip_model->json();
    }

    public function read($id) 
    {
		$id = $this->uri->segment(3);
		$arsip = $this->db->query("select*from arsip a, pbr_fidusia pbf, pnr_fidusia pnf where a.id_pbr_fidusia=pbf.id_pbr_fidusia AND a.id_pnr_fidusia=pnf.id_pnr_fidusia AND a.id_arsip='$id'")->result();
		
		foreach ($arsip as $a)
		{
			$data['pemberi'] = $a->pbr_nama;
			$data['penerima'] = $a->pnr_nama;
			$data['nama'] = $a->nama_arsip;
			$data['link'] = $a->link_arsip;
			$data['tanggal'] = $a->tgl_input_arsip;
			$data['id'] = $id;
			
            $this->load->view('arsip/header');
            $this->load->view('arsip/arsip_read', $data);
            $this->load->view('arsip/footer');
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('arsip/create_action'),
		'id_arsip' => set_value('id_arsip'),
	    'groups1' => $this->Arsip_model->AllPbr(),
	    'groups2' => $this->Arsip_model->AllPnr(),
	    'nama_arsip' => set_value('nama_arsip'),
	    'link_arsip' => set_value('link_arsip'),
	    'tgl_input_arsip' => set_value('tgl_input_arsip'),
	);
        $this->load->view('arsip/header');
        $this->load->view('arsip/arsip_form', $data);
        $this->load->view('arsip/footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_pbr_fidusia' => $this->input->post('groups1',TRUE),
		'id_pnr_fidusia' => $this->input->post('groups2',TRUE),
		'nama_arsip' => $this->input->post('nama_arsip',TRUE),
		'link_arsip' => $this->input->post('link_arsip',TRUE),
		'tgl_input_arsip' => $this->input->post('tgl_input_arsip',TRUE),
	    );

            $this->Arsip_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('arsip'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Arsip_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('arsip/update_action'),
		'id_arsip' => set_value('id_arsip', $row->id_arsip),
	    'groups1' => $this->Arsip_model->AllPbr(),
	    'groups2' => $this->Arsip_model->AllPnr(),
		'nama_arsip' => set_value('nama_arsip', $row->nama_arsip),
		'link_arsip' => set_value('link_arsip', $row->link_arsip),
		'tgl_input_arsip' => set_value('tgl_input_arsip', $row->tgl_input_arsip),
	    );
        $this->load->view('arsip/header');
        $this->load->view('arsip/arsip_form', $data);
        $this->load->view('arsip/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arsip'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_arsip', TRUE));
        } else {
            $data = array(
		'id_pbr_fidusia' => $this->input->post('groups1',TRUE),
		'id_pnr_fidusia' => $this->input->post('groups2',TRUE),
		'nama_arsip' => $this->input->post('nama_arsip',TRUE),
		'link_arsip' => $this->input->post('link_arsip',TRUE),
		'tgl_input_arsip' => $this->input->post('tgl_input_arsip',TRUE),
	    );

            $this->Arsip_model->update($this->input->post('id_arsip', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('arsip'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Arsip_model->get_by_id($id);

        if ($row) {
            $this->Arsip_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('arsip'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arsip'));
        }
    }

    public function _rules() 
    {
	//$this->form_validation->set_rules('id_pbr_fidusia', 'id pbr fidusia', 'trim|required');
	//$this->form_validation->set_rules('id_pnr_fidusia', 'id pnr fidusia', 'trim|required');
	$this->form_validation->set_rules('nama_arsip', 'nama arsip', 'trim|required');
	$this->form_validation->set_rules('link_arsip', 'link arsip', 'trim|required');

	$this->form_validation->set_rules('id_arsip', 'id_arsip', 'trim');
	//$this->form_validation->set_rules('tgl_input_arsip', 'tgl_input_arsip', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "arsip.xls";
        $judul = "arsip";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Pbr Fidusia");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Pnr Fidusia");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Arsip");
	xlsWriteLabel($tablehead, $kolomhead++, "Link Arsip");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Input Arsip");

	foreach ($this->Arsip_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_pbr_fidusia);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_pnr_fidusia);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_arsip);
	    xlsWriteLabel($tablebody, $kolombody++, $data->link_arsip);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_input_arsip);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=arsip.doc");

        $data = array(
            'arsip_data' => $this->Arsip_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('arsip/arsip_doc',$data);
    }

}

/* End of file Arsip.php */
/* Location: ./application/controllers/Arsip.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-06-28 19:44:37 */
/* http://harviacode.com */