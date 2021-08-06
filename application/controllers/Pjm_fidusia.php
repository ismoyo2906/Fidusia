<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pjm_fidusia extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pjm_fidusia_model');
        $this->load->model('Progress_model');
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
		$id = $this->uri->segment(3);
		$pjm_fidusia = $this->db->query("select*from pjm_fidusia pjf, pbr_fidusia pbf, objek_fidusia of, pnr_fidusia pnf where pjf.id_pbr_fidusia=pbf.id_pbr_fidusia AND pjf.id_objek=of.id_objek AND pjf.id_pnr_fidusia=pnf.id_pnr_fidusia AND pjf.id_pjm_fidusia='$id'")->result();
		
		foreach ($pjm_fidusia as $pjf)
		{
			$data['pemberi'] = $pjf->pbr_nama;
			$data['objek'] = $pjf->merk_objek;
			$data['penerima'] = $pjf->pnr_nama;
			$data['tanggal'] = $pjf->tanggal_buat;
			$data['status'] = $pjf->status;
			$data['id'] = $id;
			
            $this->load->view('pjm_fidusia/header');
            $this->load->view('pjm_fidusia/pjm_fidusia_read', $data);
            $this->load->view('pjm_fidusia/footer');
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pjm_fidusia/create_action'),
	    'id_pjm_fidusia' => $this->Pjm_fidusia_model->kode_otomatis_pjm(),
	    'id_pjm_fidusia' => $this->Progress_model->kode_otomatis_progress(),
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
		'id_pjm_fidusia' => $this->input->post('id_pjm_fidusia',TRUE),
		'id' => $this->input->post('groups',TRUE),
		'id_pbr_fidusia' => $this->input->post('groups1',TRUE),
		'id_objek' => $this->input->post('groups2',TRUE),
		'id_pnr_fidusia' => $this->input->post('groups3',TRUE),
		'tanggal_buat' => $this->input->post('tanggal_buat',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );
            $this->Pjm_fidusia_model->insert($data);
			
        $data1 = array(
		'id_pjm_fidusia' => $this->input->post('id_pjm_fidusia',TRUE),
		'id' => $this->input->post('groups',TRUE),
		'id_pjm_fidusia' => $this->input->post('id_pjm_fidusia',TRUE),
		'id_pbr_fidusia' => $this->input->post('groups1',TRUE),
		'id_pnr_fidusia' => $this->input->post('groups3',TRUE),
		'tanggal_buat' => $this->input->post('tanggal_buat',TRUE),
	    );
		$this->Progress_model->insert($data1);
		
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pjm_fidusia'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pjm_fidusia_model->get_by_id($id);
        if ($row) {
			//$progress = $this->Progress_model->get_by_id($id);
            $data = array(
                'button' => 'Update',
                'action' => site_url('pjm_fidusia/update_action'),
		'id_pjm_fidusia' => set_value('id_pjm_fidusia', $row->id_pjm_fidusia),
		'id_pjm_fidusia' => set_value('id_pjm_fidusia', $row->id_pjm_fidusia),
	    'groups' => $this->Pjm_fidusia_model->AllUser(),
	    'groups1' => $this->Pjm_fidusia_model->AllPbr(),
	    'groups2' => $this->Pjm_fidusia_model->AllObjek(),
	    'groups3' => $this->Pjm_fidusia_model->AllPnr(),
		'tanggal_buat' => set_value('tanggal_buat', $row->tanggal_buat),
		'status' => set_value('status', $row->status),
	    );
        $this->load->view('pjm_fidusia/header');
		$this->load->view('pjm_fidusia/pjm_fidusia_form_update', $data);
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
            $this->update($this->input->post('id_progress', TRUE));
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
			
        $data1 = array(
		'id' => $this->input->post('groups',TRUE),
		'id_pjm_fidusia' => $this->input->post('id_pjm_fidusia', TRUE),
		'id_pbr_fidusia' => $this->input->post('groups1',TRUE),
		'id_pnr_fidusia' => $this->input->post('groups3',TRUE),
		'tanggal_buat' => $this->input->post('tanggal_buat',TRUE),
	    );
		$this->Progress_model->update($this->input->post('id_pjm_fidusia', TRUE), $data1);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pjm_fidusia'));
        }
    }
    
    public function delete($id) 
    {
		$w = array('id_pjm_fidusia' => $id);
		//$data1 = $this->Progress_model->edit_data($w,'pjm_fidusia')->row();
		//$data2 = $this->Progress_model->edit_data($w,'progress')->row();
		$this->Progress_model->delete_data($w, 'progress');
		$this->Pjm_fidusia_model->delete_data($w, 'pjm_fidusia');
		$this->session->set_flashdata('message', 'Delete Record Success');
		redirect(base_url().'pjm_fidusia');
		
        //$row = $this->Pjm_fidusia_model->get_by_id($id);
		//$row = $this->Progress_model->get_by_id($id);
        //if ($row) {
        //  $this->Pjm_fidusia_model->delete($id);
		//	$this->Progress_model->delete($id);
        //  $this->session->set_flashdata('message', 'Delete Record Success');
        //  redirect(site_url('pjm_fidusia'));
        //} else {
        //    $this->session->set_flashdata('message', 'Record Not Found');
        //    redirect(site_url('pjm_fidusia'));
        //}
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
	$this->form_validation->set_rules('id_progress', 'id_progress', 'trim');
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