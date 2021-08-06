<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategori_objek extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_objek_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
				$this->cek_status(); //cek session login
    }

    public function index()
    {
        $this->load->view('kategori_objek/header');
        $this->load->view('kategori_objek/kategori_objek_list');
        $this->load->view('kategori_objek/footer');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Kategori_objek_model->json();
    }

    public function read($id) 
    {
        $row = $this->Kategori_objek_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kategori' => $row->id_kategori,
		'kategori' => $row->kategori,
		'jenis_kategori' => $row->jenis_kategori,
	    );
            $this->load->view('kategori_objek/header');
            $this->load->view('kategori_objek/kategori_objek_read', $data);
            $this->load->view('kategori_objek/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategori_objek'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kategori_objek/create_action'),
	    'id_kategori' => set_value('id_kategori'),
	    'kategori' => set_value('kategori'),
	    'jenis_kategori' => set_value('jenis_kategori'),
	);
        $this->load->view('kategori_objek/header');
        $this->load->view('kategori_objek/kategori_objek_form',$data);
        $this->load->view('kategori_objek/footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kategori' => $this->input->post('kategori',TRUE),
		'jenis_kategori' => $this->input->post('jenis_kategori',TRUE),
	    );

            $this->Kategori_objek_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('objek'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kategori_objek_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kategori_objek/update_action'),
		'id_kategori' => set_value('id_kategori', $row->id_kategori),
		'kategori' => set_value('kategori', $row->kategori),
		'jenis_kategori' => set_value('jenis_kategori', $row->jenis_kategori),
	    );
        $this->load->view('kategori_objek/header');
        $this->load->view('kategori_objek/kategori_objek_form',$data);
        $this->load->view('kategori_objek/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategori_objek'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kategori', TRUE));
        } else {
            $data = array(
		'kategori' => $this->input->post('kategori',TRUE),
		'jenis_kategori' => $this->input->post('jenis_kategori',TRUE),
	    );

            $this->Kategori_objek_model->update($this->input->post('id_kategori', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('objek'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kategori_objek_model->get_by_id($id);

        if ($row) {
            $this->Kategori_objek_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kategori_objek'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategori_objek'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
	$this->form_validation->set_rules('jenis_kategori', 'jenis kategori', 'trim|required');

	$this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "kategori_objek.xls";
        $judul = "kategori_objek";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kategori");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kategori");

	foreach ($this->Kategori_objek_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kategori);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kategori);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=kategori_objek.doc");

        $data = array(
            'kategori_objek_data' => $this->Kategori_objek_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('kategori_objek/kategori_objek_doc',$data);
    }

}

/* End of file Kategori_objek.php */
/* Location: ./application/controllers/Kategori_objek.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-06-28 15:50:48 */
/* http://harviacode.com */