<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pnr_fidusia_model extends CI_Model
{

    public $table = 'pnr_fidusia';
    public $id = 'id_pnr_fidusia';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_pnr_fidusia,pnr_nama,pnr_alamat,pnr_nik,pnr_jengkel,pnr_nmr_kontak');
        $this->datatables->from('pnr_fidusia');
        //add this line for join
        //$this->datatables->join('table2', 'pnr_fidusia.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('pnr_fidusia/read/$1'),'Read')." | ".anchor(site_url('pnr_fidusia/update/$1'),'Update')." | ".anchor(site_url('pnr_fidusia/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_pnr_fidusia');
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
        $this->db->like('id_pnr_fidusia', $q);
	$this->db->or_like('pnr_nama', $q);
	$this->db->or_like('pnr_alamat', $q);
	$this->db->or_like('pnr_nik', $q);
	$this->db->or_like('pnr_jengkel', $q);
	$this->db->or_like('pnr_nmr_kontak', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_pnr_fidusia', $q);
	$this->db->or_like('pnr_nama', $q);
	$this->db->or_like('pnr_alamat', $q);
	$this->db->or_like('pnr_nik', $q);
	$this->db->or_like('pnr_jengkel', $q);
	$this->db->or_like('pnr_nmr_kontak', $q);
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

}

/* End of file Pnr_fidusia_model.php */
/* Location: ./application/models/Pnr_fidusia_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-06-28 15:51:09 */
/* http://harviacode.com */