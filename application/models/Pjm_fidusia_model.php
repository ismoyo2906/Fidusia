<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pjm_fidusia_model extends CI_Model
{

    public $table = 'pjm_fidusia';
    public $id = 'id_pjm_fidusia';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_pjm_fidusia,nama_user,pbr_nama,merk_objek,pnr_nama,tanggal_buat,status');
        $this->datatables->from('pjm_fidusia');
        //add this line for join
        $this->datatables->join('user', 'pjm_fidusia.id = user.id');
        $this->datatables->join('pbr_fidusia', 'pjm_fidusia.id_pbr_fidusia = pbr_fidusia.id_pbr_fidusia');
        $this->datatables->join('objek_fidusia', 'pjm_fidusia.id_objek = objek_fidusia.id_objek');
        $this->datatables->join('pnr_fidusia', 'pjm_fidusia.id_pnr_fidusia = pnr_fidusia.id_pnr_fidusia');
        //$this->datatables->join('progress', 'pjm_fidusia.id_pjm_fidusia = progress.id_pjm_fidusia');
        $this->datatables->add_column('action', anchor(site_url('pjm_fidusia/read/$1'),'Read')." | ".anchor(site_url('pjm_fidusia/update/$1'),'Update')." | ".anchor(site_url('pjm_fidusia/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_pjm_fidusia');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_pjm_fidusia', $q);
	$this->db->or_like('id', $q);
	$this->db->or_like('id_pbr_fidusia', $q);
	$this->db->or_like('id_objek', $q);
	$this->db->or_like('id_pnr_fidusia', $q);
	$this->db->or_like('tanggal_buat', $q);
	$this->db->or_like('status', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_pjm_fidusia', $q);
	$this->db->or_like('id', $q);
	$this->db->or_like('id_pbr_fidusia', $q);
	$this->db->or_like('id_objek', $q);
	$this->db->or_like('id_pnr_fidusia', $q);
	$this->db->or_like('tanggal_buat', $q);
	$this->db->or_like('status', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
	
    function AllUser()
    {
        
        //$query = $this->db->get('user');
		/*
        foreach ($query->result() as $row)
        {
            echo $row->description;
        }*/

		$query = $this->db->get_where('user',array('role'=>'User'));
        return $query->result();

        //echo 'Total Results: ' . $query->num_rows();
    }
	
    function AllPbr()
    {
        
        $query = $this->db->get('pbr_fidusia');
		/*
        foreach ($query->result() as $row)
        {
            echo $row->description;
        }*/

		//$query = $this->db->get_where('pbr_fidusia',array('role'=>'User'));
        return $query->result();

        //echo 'Total Results: ' . $query->num_rows();
    }
    function AllObjek()
    {
        $query = $this->db->get('objek_fidusia');
		/*
        foreach ($query->result() as $row)
        {
            echo $row->description;
        }*/

		//$query = $this->db->get_where('pbr_fidusia',array('role'=>'User'));
        return $query->result();

        //echo 'Total Results: ' . $query->num_rows();
    }
	
    function AllPnr()
    {
        
        $query = $this->db->get('pnr_fidusia');
		/*
        foreach ($query->result() as $row)
        {
            echo $row->description;
        }*/

		//$query = $this->db->get_where('pbr_fidusia',array('role'=>'User'));
        return $query->result();

        //echo 'Total Results: ' . $query->num_rows();
    }
	
 	function kode_otomatis_pjm(){
 		$this->db->select('right(id_pjm_fidusia ,4) as kode', false);
 		$this->db->order_by('id_pjm_fidusia' ,'desc');
 		$this->db->limit(100);
 		$query=$this->db->get('pjm_fidusia');
 		if($query->num_rows()<>0){
 			$data=$query->row();
 			$kode=intval($data->kode)+1;
 		}else{
 			$kode=1;
 		}

 		$kodemax=str_pad($kode,4,"0", STR_PAD_LEFT);
 		$kodejadi='PJMF'.$kodemax;

 		return $kodejadi;
 	}
	
	function edit_data($where,$table){
		return $this->db->get_where($table,$where);
 	}
	
 	function delete_data($where,$table){
 		$this->db->where($where);
 		$this->db->delete($table);
 	}
}

/* End of file Pjm_fidusia_model.php */
/* Location: ./application/models/Pjm_fidusia_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-06-28 15:51:03 */
/* http://harviacode.com */