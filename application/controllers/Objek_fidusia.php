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
		$id = $this->uri->segment(3);
		$objek_fidusia = $this->db->query("select*from objek_fidusia of, pbr_fidusia pbf, kategori_objek ko where of.id_pbr_fidusia=pbf.id_pbr_fidusia AND of.id_kategori=ko.id_kategori AND of.id_objek='$id'")->result();
		
		foreach ($objek_fidusia as $of)
		{
			$data['Pemberi'] = $of->pbr_nama;
			$data['Jenis'] = $of->jenis_kategori;
			$data['Nama'] = $of->merk_objek;
			$data['Tipe'] = $of->tipe_objek;
			$data['Tahun'] = $of->tahun_objek;
			$data['Norak'] = $of->norak_objek;
			$data['Nomes'] = $of->nomes_objek;
			$data['Warna'] = $of->warna_objek;
			$data['Bukti'] = $of->bukti_objek;
			$data['Nilai'] = $of->nilai_objek;
			$data['Penjaminan'] = $of->nilai_penjaminan;
			$data['Waktu'] = $of->jangka_waktu;
			$data['Keterangan'] = $of->Keterangan;
			$data['id'] = $id;
			
            $this->load->view('objek_fidusia/header');
            $this->load->view('objek_fidusia/objek_fidusia_read', $data);
            $this->load->view('objek_fidusia/footer');
        }
    }
	
	function create()
	{
		$data['pbr_fidusia'] = $this->Objek_fidusia_model->get_data('pbr_fidusia')->result();
		$data['kategori_objek'] = $this->Objek_fidusia_model->get_data('kategori_objek')->result();
		$data['objek_fidusia'] = $this->Objek_fidusia_model->get_data('objek_fidusia')->result();
        $this->load->view('objek_fidusia/header');
        $this->load->view('objek_fidusia/objek_fidusia_form', $data);
        $this->load->view('objek_fidusia/footer');
	}
	
	function create_action()
	{
		$id_pbr_fidusia = $this->input->post('id_pbr_fidusia');
		$id_kategori = $this->input->post('id_kategori');
		$merk_objek = $this->input->post('merk_objek');
		$tipe_objek = $this->input->post('tipe_objek');
		$tahun_objek = $this->input->post('tahun_objek');
		$norak_objek = $this->input->post('norak_objek');
		$nomes_objek = $this->input->post('nomes_objek');
		$warna_objek = $this->input->post('warna_objek');
		$nilai_objek = $this->input->post('nilai_objek');
		$nilai_penjaminan = $this->input->post('nilai_penjaminan');
		$jangka_waktu = $this->input->post('jangka_waktu');
		$Keterangan = $this->input->post('Keterangan');
		$this->form_validation->set_rules('id_pbr_fidusia', 'id pbr fidusia', 'trim|required');
		$this->form_validation->set_rules('id_kategori', 'id kategori', 'trim|required');
		$this->form_validation->set_rules('nilai_objek', 'nilai objek', 'trim|required');
		$this->form_validation->set_rules('nilai_penjaminan', 'nilai penjaminan', 'trim|required');
		$this->form_validation->set_rules('jangka_waktu', 'jangka waktu', 'trim|required');
		$this->form_validation->set_rules('Keterangan', 'keterangan', 'trim|required');
		if($this->form_validation->run() !=FALSE)
		{
			//configurasi upload gambar
			$config['upload_path'] = './assets/upload/objek/';
			$config['allowed_types'] = 'jpeg|png|gif|jpg';
			$config['max_size'] = '3072';
			$config['encrypt_name'] = TRUE;
			$new_name = time().$_FILES["userfiles"]['name'];
			$config['file_name'] = $new_name;
		
			$this->load->library('upload',$config);
		
		if($this->upload->do_upload('bukti_objek'))
		{
			$bukti_objek=$this->upload->data();
			
			$data = array(
				'id_pbr_fidusia' => $id_pbr_fidusia,
				'id_kategori' => $id_kategori,
				'merk_objek' => $merk_objek,
				'tipe_objek' => $tipe_objek,
				'tahun_objek' => $tahun_objek,
				'norak_objek' => $norak_objek,
				'nomes_objek' => $nomes_objek,
				'warna_objek' => $warna_objek,
				'bukti_objek' => $bukti_objek['file_name'],
				'nilai_objek' => $nilai_objek,
				'nilai_penjaminan' => $nilai_penjaminan,
				'jangka_waktu' => $jangka_waktu,
				'Keterangan' => $Keterangan
				);
			
			$this->Objek_fidusia_model->insert_data($data,'objek_fidusia');
			redirect(base_url().'objek_fidusia');
		}
		else
		{
		if($this->session->set_flashdata('alert','Anda Belum Memilih Foto'));
		}
		}
		else
		{
			$data['pbr_fidusia'] = $this->Objek_fidusia_model->get_data('pbr_fidusia')->result();
			$data['kategori_objek'] = $this->Objek_fidusia_model->get_data('kategori_objek')->result();
			$this->load->view('objek_fidusia/header');
			$this->load->view('objek_fidusia/objek_fidusia_form', $data);
			$this->load->view('objek_fidusia/footer');
		}
	}
    
    public function update($id) 
	{
		$where = array('id_objek' => $id);
		$data['objek_fidusia'] = $this->db->query("select * from objek_fidusia OF, kategori_objek KO, pbr_fidusia PF where OF.id_kategori=KO.id_kategori and OF.id_pbr_fidusia=PF.id_pbr_fidusia and OF.id_objek='$id'")->result();
		$data['pbr_fidusia'] = $this->Objek_fidusia_model->get_data('pbr_fidusia')->result();
		$data['kategori_objek'] = $this->Objek_fidusia_model->get_data('kategori_objek')->result();
		$data['objek_fidusia'] = $this->Objek_fidusia_model->edit_data($where,'objek_fidusia')->result();
        $this->load->view('objek_fidusia/header');
        $this->load->view('objek_fidusia/objek_fidusia_update', $data);
        $this->load->view('objek_fidusia/footer');
	}
    
    public function update_action() 
	{
		$id = $this->input->post('id');
		$id_pbr_fidusia = $this->input->post('id_pbr_fidusia');
		$id_kategori = $this->input->post('id_kategori');
		$merk_objek = $this->input->post('merk_objek');
		$tipe_objek = $this->input->post('tipe_objek');
		$tahun_objek = $this->input->post('tahun_objek');
		$norak_objek = $this->input->post('norak_objek');
		$nomes_objek = $this->input->post('nomes_objek');
		$warna_objek = $this->input->post('warna_objek');
		$nilai_objek = $this->input->post('nilai_objek');
		$nilai_penjaminan = $this->input->post('nilai_penjaminan');
		$jangka_waktu = $this->input->post('jangka_waktu');
		$Keterangan = $this->input->post('Keterangan');
		$this->form_validation->set_rules('nilai_objek', 'nilai objek', 'trim|required');
		$this->form_validation->set_rules('nilai_penjaminan', 'nilai penjaminan', 'trim|required');
		$this->form_validation->set_rules('jangka_waktu', 'jangka waktu', 'trim|required');
		$this->form_validation->set_rules('Keterangan', 'keterangan', 'trim|required');
		if($this->form_validation->run() !=FALSE)
		{
			//configurasi upload gambar
			$config['upload_path'] = './assets/upload/objek/';
			$config['allowed_types'] = 'jpeg|png|gif|jpg';
			$config['max_size'] = '3072';
			$config['file_name'] = time().$_FILES["userfiles"]['name'];
			$config['overwrite'] = true;
			$this->load->library('upload',$config);
		
			$where = array('id_objek' => $id);
			$data = array(
				'id_pbr_fidusia' => $id_pbr_fidusia,
				'id_kategori' => $id_kategori,
				'merk_objek' => $merk_objek,
				'tipe_objek' => $tipe_objek,
				'tahun_objek' => $tahun_objek,
				'norak_objek' => $norak_objek,
				'nomes_objek' => $nomes_objek,
				'warna_objek' => $warna_objek,
				'bukti_objek' => $bukti_objek['file_name'],
				'nilai_objek' => $nilai_objek,
				'nilai_penjaminan' => $nilai_penjaminan,
				'jangka_waktu' => $jangka_waktu,
				'Keterangan' => $Keterangan
				);
		
		if($this->upload->do_upload('bukti_objek'))
		{
			//proses upload gambar
			$bukti_objek=$this->upload->data();
				unlink('./assets/upload/objek/'.$this->input->post('old_pict', TRUE));
			$data['bukti_objek'] = $bukti_objek['file_name'];
				
				$this->Objek_fidusia_model->update_data($where, $data,'objek_fidusia');
		}
		else
		{
				$this->Objek_fidusia_model->update_data($where, $data,'objek_fidusia');
		}
				$this->Objek_fidusia_model->update_data($where, $data,'objek_fidusia');
				redirect(base_url().'objek_fidusia');
		}
		else
		{
		$where = array('id_objek' => $id);
		$data['objek_fidusia'] = $this->db->query("select * from objek_fidusia OF, kategori_objek KO, pbr_fidusia PF where OF.id_kategori=KO.id_kategori and OF.id_pbr_fidusia=PF.id_pbr_fidusia and OF.id_objek='$id'")->result();
		$data['pbr_fidusia'] = $this->Objek_fidusia_model->get_data('pbr_fidusia')->result();
		$data['kategori_objek'] = $this->Objek_fidusia_model->get_data('kategori_objek')->result();
		$data['objek_fidusia'] = $this->Objek_fidusia_model->edit_data($where,'objek_fidusia')->result();
			//$data['peminjaman'] = $this->Objek_fidusia_model->edit_data($where,'peminjaman')->result();
        $this->load->view('objek_fidusia/header');
        $this->load->view('objek_fidusia/objek_fidusia_update', $data);
        $this->load->view('objek_fidusia/footer');
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