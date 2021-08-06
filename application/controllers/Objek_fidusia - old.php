<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Objek_fidusia extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Objek_fidusia_model');
        $this->load->model('Kategori_objek_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
				$this->cek_status(); //cek session login
    }

    public function index()
    {
        $this->load->view('objek_fidusia/header');
        $this->load->view('objek_fidusia/objek_fidusia_list');
        $this->load->view('objek_fidusia/footer');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        //echo $this->Kategori_objek_model->json();
        echo $this->Objek_fidusia_model->json();
    }

    public function read($id) 
    {
        $row = $this->Objek_fidusia_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_objek' => $row->id_objek,
		'id_pbr_fidusia' => $row->id_pbr_fidusia,
		'id_kategori' => $row->id_kategori,
		'merk_objek' => $row->merk_objek,
		'tipe_objek' => $row->tipe_objek,
		'tahun_objek' => $row->tahun_objek,
		'norak_objek' => $row->norak_objek,
		'nomes_objek' => $row->nomes_objek,
		'warna_objek' => $row->warna_objek,
		'bukti_objek' => $row->bukti_objek,
		'nilai_objek' => $row->nilai_objek,
		'nilai_penjaminan' => $row->nilai_penjaminan,
		'jangka_waktu' => $row->jangka_waktu,
		'Keterangan' => $row->Keterangan,
	    );
            $this->load->view('objek_fidusia/header');
            $this->load->view('objek_fidusia/objek_fidusia_read', $data);
            $this->load->view('objek_fidusia/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('objek_fidusia'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('objek_fidusia/create_action'),
	    'id_objek' => set_value('id_objek'),
	    'id_pbr_fidusia' => set_value('id_pbr_fidusia'),
	    'groups1' => $this->Objek_fidusia_model->getAllPbr(),
	    'groups2' => $this->Objek_fidusia_model->getAllGroups(),
	    'merk_objek' => set_value('merk_objek'),
	    'tipe_objek' => set_value('tipe_objek'),
	    'tahun_objek' => set_value('tahun_objek'),
	    'norak_objek' => set_value('norak_objek'),
	    'nomes_objek' => set_value('nomes_objek'),
	    'warna_objek' => set_value('warna_objek'),
		'bukti_objek' => set_value('bukti_objek'),
	    'nilai_objek' => set_value('nilai_objek'),
	    'nilai_penjaminan' => set_value('nilai_penjaminan'),
	    'jangka_waktu' => set_value('jangka_waktu'),
	    'Keterangan' => set_value('Keterangan'),
	);
        $this->load->view('objek_fidusia/header');
        $this->load->view('objek_fidusia/objek_fidusia_form', $data);
        $this->load->view('objek_fidusia/footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
			//configurasi upload gambar
			$config['upload_path'] = './assets/upload/objek/';
			$config['allowed_types'] = 'jpg|png|gif|bmp';
			$config['max_size'] = '1024';
			$config['file_name'] = 'bukti_objek'.'time';
		
			$this->load->library('upload',$config);
		
			$this->upload->do_upload('bukti_objek')
		
			$bukti_objek = $this->upload->data();
            $data = array(
		'id_pbr_fidusia' => $this->input->post('groups1',TRUE),
		'id_kategori' => $this->input->post('groups2',TRUE),
		'merk_objek' => $this->input->post('merk_objek',TRUE),
		'tipe_objek' => $this->input->post('tipe_objek',TRUE),
		'tahun_objek' => $this->input->post('tahun_objek',TRUE),
		'norak_objek' => $this->input->post('norak_objek',TRUE),
		'nomes_objek' => $this->input->post('nomes_objek',TRUE),
		'warna_objek' => $this->input->post('warna_objek',TRUE),
		'bukti_objek' => $this->input->post('bukti_objek',TRUE),
		'nilai_objek' => $this->input->post('nilai_objek',TRUE),
		'nilai_penjaminan' => $this->input->post('nilai_penjaminan',TRUE),
		'jangka_waktu' => $this->input->post('jangka_waktu',TRUE),
		'Keterangan' => $this->input->post('Keterangan',TRUE),
	    );
            $this->Objek_fidusia_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('objek'));
		}
    }
    
    public function update($id) 
    {
        $row = $this->Objek_fidusia_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('objek_fidusia/update_action'),
		'id_objek' => set_value('id_objek', $row->id_objek),
	    'groups1' => $this->Objek_fidusia_model->getAllPbr(),
	    'groups2' => $this->Objek_fidusia_model->getAllGroups(),
		'merk_objek' => set_value('merk_objek', $row->merk_objek),
		'tipe_objek' => set_value('tipe_objek', $row->tipe_objek),
		'tahun_objek' => set_value('tahun_objek', $row->tahun_objek),
		'norak_objek' => set_value('norak_objek', $row->norak_objek),
		'nomes_objek' => set_value('nomes_objek', $row->nomes_objek),
		'warna_objek' => set_value('warna_objek', $row->warna_objek),
		'bukti_objek' => set_value('bukti_objek', $row->bukti_objek),
		'nilai_objek' => set_value('nilai_objek', $row->nilai_objek),
		'nilai_penjaminan' => set_value('nilai_penjaminan', $row->nilai_penjaminan),
		'jangka_waktu' => set_value('jangka_waktu', $row->jangka_waktu),
		'Keterangan' => set_value('Keterangan', $row->Keterangan),
	    );
            $this->load->view('objek_fidusia/header');
            $this->load->view('objek_fidusia/objek_fidusia_form', $data);
            $this->load->view('objek_fidusia/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('objek_fidusia'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_objek', TRUE));
        } else {
            $data = array(
		'id_pbr_fidusia' => $this->input->post('groups1',TRUE),
		'id_kategori' => $this->input->post('groups2',TRUE),
		'merk_objek' => $this->input->post('merk_objek',TRUE),
		'tipe_objek' => $this->input->post('tipe_objek',TRUE),
		'tahun_objek' => $this->input->post('tahun_objek',TRUE),
		'norak_objek' => $this->input->post('norak_objek',TRUE),
		'nomes_objek' => $this->input->post('nomes_objek',TRUE),
		'warna_objek' => $this->input->post('warna_objek',TRUE),
		'bukti_objek' => $this->input->post('bukti_objek',TRUE),
		'nilai_objek' => $this->input->post('nilai_objek',TRUE),
		'nilai_penjaminan' => $this->input->post('nilai_penjaminan',TRUE),
		'jangka_waktu' => $this->input->post('jangka_waktu',TRUE),
		'Keterangan' => $this->input->post('Keterangan',TRUE),
	    );

            $this->Objek_fidusia_model->update($this->input->post('id_objek', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('objek_fidusia'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Objek_fidusia_model->get_by_id($id);

        if ($row) {
            $this->Objek_fidusia_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('objek_fidusia'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('objek_fidusia'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_pbr_fidusia', 'id pbr fidusia', 'trim|required');
	$this->form_validation->set_rules('id_kategori', 'id kategori', 'trim|required');
	$this->form_validation->set_rules('bukti_objek', 'bukti objek', 'trim|required');
	$this->form_validation->set_rules('nilai_objek', 'nilai objek', 'trim|required');
	$this->form_validation->set_rules('nilai_penjaminan', 'nilai penjaminan', 'trim|required');
	$this->form_validation->set_rules('jangka_waktu', 'jangka waktu', 'trim|required');
	$this->form_validation->set_rules('Keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('id_objek', 'id_objek', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "objek_fidusia.xls";
        $judul = "objek_fidusia";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id Kategori");
	xlsWriteLabel($tablehead, $kolomhead++, "Merk Objek");
	xlsWriteLabel($tablehead, $kolomhead++, "Tipe Objek");
	xlsWriteLabel($tablehead, $kolomhead++, "Tahun Objek");
	xlsWriteLabel($tablehead, $kolomhead++, "Norak Objek");
	xlsWriteLabel($tablehead, $kolomhead++, "Nomes Objek");
	xlsWriteLabel($tablehead, $kolomhead++, "Warna Objek");
	xlsWriteLabel($tablehead, $kolomhead++, "Bukti Objek");
	xlsWriteLabel($tablehead, $kolomhead++, "Nilai Objek");
	xlsWriteLabel($tablehead, $kolomhead++, "Nilai Penjaminan");
	xlsWriteLabel($tablehead, $kolomhead++, "Jangka Waktu");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

	foreach ($this->Objek_fidusia_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_pbr_fidusia);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_kategori);
	    xlsWriteLabel($tablebody, $kolombody++, $data->merk_objek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tipe_objek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tahun_objek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->norak_objek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomes_objek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->warna_objek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->bukti_objek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nilai_objek);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nilai_penjaminan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jangka_waktu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Keterangan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=objek_fidusia.doc");

        $data = array(
            'objek_fidusia_data' => $this->Objek_fidusia_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('objek_fidusia/objek_fidusia_doc',$data);
    }
}

/* End of file Objek_fidusia.php */
/* Location: ./application/controllers/Objek_fidusia.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-06-28 15:50:53 */
/* http://harviacode.com */